<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment on a report
    public function store(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:chats,id', // Make sure the report exists
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(), // Get the logged-in user's ID
            'chat_id' => $request->report_id, // Associate the comment with the report (chat)
            'comment' => $request->comment, // Store the comment
        ]);

        return response()->json(['success' => true, 'message' => 'Comment added successfully']);
    }
}

