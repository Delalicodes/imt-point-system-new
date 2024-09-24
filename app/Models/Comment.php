<?php

// app/Models/Comment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'user_id', 'comment'];

    // Relationship: A comment can have many replies
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // Relationship: A comment belongs to a chat
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // Relationship: A comment belongs to a user (the one who created the comment)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
