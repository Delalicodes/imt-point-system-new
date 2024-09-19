<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',       // The user who is clocking in/out
        'clock_in_time', // The time when the user clocks in
        'clock_out_time',// The time when the user clocks out
        'total_hours'    // The total hours worked by the user
    ];
}
