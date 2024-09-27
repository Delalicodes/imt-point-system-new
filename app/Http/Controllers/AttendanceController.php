<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Report;

class AttendanceController extends Controller
{
    // Display attendance records
    public function index()
    {
        $userId = auth()->user()->id;

        // Fetch the current attendance record if clocked in
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        $isClockedIn = $attendance ? true : false;

        // Fetch all attendance records for the user
        $attendances = Attendance::where('user_id', $userId)
            ->orderBy('clock_in_time', 'desc')
            ->get();

        return view('clockin', compact('isClockedIn', 'attendances'));
    }

    // Toggle clock-in and clock-out functionality
    public function toggleClockInOut()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->user()->id;

        // Check if user is already clocked in
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        if (!$attendance) {
            // Clock In: Create a new attendance record
            Attendance::create([
                'user_id' => $userId,
                'clock_in_time' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Work started']);
        } else {
            // Clock Out: Update the existing attendance record
            $attendance->clock_out_time = Carbon::now();

            // Calculate total hours worked
            $clockIn = Carbon::parse($attendance->clock_in_time);
            $totalTimeWorked = Carbon::now()->diffInSeconds($clockIn);
            $attendance->total_hours = gmdate("H:i:s", $totalTimeWorked);
            $attendance->save();

            return response()->json(['success' => 'Work ended', 'total_hours' => $attendance->total_hours]);
        }
    }

    // Submit a report linked to the current attendance record
    public function submitReport(Request $request)
    {
        $request->validate([
            'report' => 'required|string|max:255',
        ]);

        $userId = auth()->user()->id;

        // Fetch the current attendance record
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        if (!$attendance) {
            return response()->json(['error' => 'You must be clocked in to submit a report.'], 400);
        }

        // Save the report
        $report = Report::create([
            'user_id' => $userId,
            'attendance_id' => $attendance->id,
            'report' => $request->input('report'),
            'reported_at' => Carbon::now(),
        ]);

        return response()->json(['success' => 'Report submitted successfully', 'report' => $report]);
    }

    // Check the attendance status
    public function getAttendanceStatus()
    {
        $userId = auth()->user()->id;

        // Check if the user is clocked in
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        $isClockedIn = $attendance ? true : false;

        return response()->json(['isClockedIn' => $isClockedIn]);
    }
}
