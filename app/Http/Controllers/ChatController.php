<?php

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
        // Validate the message and report fields
        $request->validate([
            'message' => 'nullable|string|max:255',
            'report' => 'nullable|string|max:255',
        ]);

        // Only create a new chat entry if either message or report is provided
        if ($request->filled('message') || $request->filled('report')) {
            $chat = new Chat();
            $chat->message = $request->message;
            $chat->report = $request->report; // Save the report
            $chat->user_id = auth()->id();
            $chat->save();

            return response()->json([
                'message' => $chat->message,
                'report' => $chat->report, // Include report in the response
                'user' => $chat->user->username,
                'created_at' => $chat->created_at->diffForHumans(),
            ], 201);
        }

        // Return a response indicating that neither message nor report was sent
        return response()->json(['error' => 'No message or report was provided.'], 400);
    }

    public function poll()
    {
        // Get all chats in ascending order
        $chats = Chat::with('user')->orderBy('created_at', 'asc')->get();

        return response()->json([
            'reports' => $chats->map(function ($chat) {
                return [
                    'id' => $chat->id,
                    'message' => $chat->message,
                    'report' => $chat->report,
                    'user_name' => $chat->user->username,
                    'created_at' => $chat->created_at->diffForHumans(),
                    'user_id' => $chat->user_id,
                ];
            }),
        ]);
    }
}
