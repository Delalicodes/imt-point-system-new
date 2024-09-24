<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Display all the reports (chats)
    public function index()
    {
        // Get all messages for the authenticated user (if needed)
        $reports = Chat::with('user')->orderBy('created_at', 'asc')->get();
        return view('chat', compact('reports'));
    }

    // Store a new report (chat message)
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $report = new Chat();
        $report->message = $request->message;
        $report->user_id = auth()->id(); // Ensure the user is authenticated
        $report->save();

        return response()->json([
            'message' => $report->message,
            'user' => $report->user->name,
            'created_at' => $report->created_at->diffForHumans(),
        ], 201);
    }

    // Poll for new chat messages (return the latest messages)
    public function poll(Request $request)
    {
        $user = auth()->user(); // Get the currently authenticated user
        $registrationTime = $user->created_at; // Get the user's registration time

        // Fetch messages only if they were created after the user's registration time
        $reports = Chat::with('user')
            ->where('created_at', '>', $registrationTime)
            ->orderBy('created_at', 'asc')
            ->get();

        // Check typing status
        $typingUserId = session('typing_user');
        $typingStatus = session('typing_status', false);

        // Format the response for the front-end
        $formattedReports = $reports->map(function ($report) {
            return [
                'user_name' => $report->user->username,
                'message' => $report->message,
                'created_at' => $report->created_at->diffForHumans(),
                'user_id' => $report->user_id,
            ];
        });

        return response()->json([
            'reports' => $formattedReports,
            'typing' => [
                'user_id' => $typingUserId,
                'status' => $typingStatus,
            ],
        ]);
    }

    // public function typing(Request $request)
    // {
    //     $request->validate([
    //         'typing' => 'required|boolean',
    //     ]);

    //     // Store the typing status in the session
    //     session(['typing_user' => auth()->id(), 'typing_status' => $request->typing]);

    //     return response()->json(['status' => 'success']);
    // }
}
