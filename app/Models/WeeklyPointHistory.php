<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyPointHistory extends Model
{
    protected $fillable = [
        'user_id',
        'total_points',
        'week_start',
        'week_end',
    ];

    // Optionally, define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

