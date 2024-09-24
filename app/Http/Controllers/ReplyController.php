<?php

// app/Http/Controllers/ReplyController.php
namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    // Store a new reply to a comment
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id', // Make sure the comment exists
            'reply' => 'required|string|max:255',
        ]);

        Reply::create([
            'user_id' => Auth::id(), // Get the logged-in user's ID
            'comment_id' => $request->comment_id, // Associate the reply with the comment
            'reply' => $request->reply, // Store the reply
        ]);

        return response()->json(['success' => true, 'message' => 'Reply added successfully']);
    }
}

