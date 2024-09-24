<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        // Fetch the current attendance record if clocked in
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        $isClockedIn = $attendance ? true : false;

        $attendances = Attendance::where('user_id', $userId)
            ->orderBy('clock_in_time', 'desc')
            ->get();

        return view('clockin', compact('isClockedIn', 'attendances'));
    }

    public function toggleClockInOut()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->user()->id;

        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('clock_out_time')
                                ->first();

        if (!$attendance) {
            // Clock In: Create a new record
            Attendance::create([
                'user_id' => $userId,
                'clock_in_time' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Work started']);
        } else {
            // Clock Out: Calculate total time worked and update the record
            $attendance->clock_out_time = Carbon::now();

            // Calculate total hours worked
            $clockIn = Carbon::parse($attendance->clock_in_time);
            $clockOut = Carbon::now();
            $totalTimeWorked = $clockOut->diffInSeconds($clockIn);
            $totalHoursWorked = gmdate("H:i:s", $totalTimeWorked);

            $attendance->total_hours = $totalHoursWorked;
            $attendance->save();

            return response()->json(['success' => 'Work ended', 'total_hours' => $totalHoursWorked]);
        }
    }
}
