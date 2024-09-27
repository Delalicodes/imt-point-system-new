<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;

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
        // Check if the user is authenticated
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
            $attendance->total_hours = $totalTimeWorked; // Store total hours as seconds
            $attendance->save(); // Save the updated attendance record

            return response()->json(['success' => 'Work ended', 'total_hours' => gmdate("H:i:s", $totalTimeWorked)]);
        }
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

