<?php

// app/Models/Reply.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'user_id', 'reply'];

    // Relationship: A reply belongs to a comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Relationship: A reply belongs to a user (the one who created the reply)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
