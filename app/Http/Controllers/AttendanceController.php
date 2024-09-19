<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller

{

    public function index(){
        return view('clockin');
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

