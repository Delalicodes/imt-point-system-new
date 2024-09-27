<?php

// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        // Get the latest attendance record for the user
        $attendance = Attendance::where('user_id', $userId)->latest()->first();
        $isClockedIn = $attendance && !$attendance->clock_out_time;
        $totalHoursWorked = $attendance ? $attendance->total_hours : 'N/A';
        $latestReport = $attendance ? $attendance->latest_report : 'No reports submitted yet.';

        // Pass data to the chat view
        return view('chat', compact('isClockedIn', 'totalHoursWorked', 'latestReport'));
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:255']);

        $chat = new Chat();
        $chat->message = $request->message;
        $chat->user_id = auth()->id();
        $chat->save();

        return response()->json([
            'message' => $chat->message,
            'user' => $chat->user->name,
            'created_at' => $chat->created_at->diffForHumans(),
        ], 201);
    }

    public function poll(Request $request)
    {
        $reports = Chat::with('user')->orderBy('created_at', 'asc')->get();

        $formattedReports = $reports->map(function ($report) {
            return [
                'user_name' => $report->user->username,
                'message' => $report->message,
                'created_at' => $report->created_at->diffForHumans(),
                'user_id' => $report->user_id,
            ];
        });

        return response()->json(['reports' => $formattedReports]);
    }
}

