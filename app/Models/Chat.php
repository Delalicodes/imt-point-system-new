<?php

// app/Models/Chat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    // Relationship: A chat can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship: A chat belongs to a user (the one who created the chat)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
