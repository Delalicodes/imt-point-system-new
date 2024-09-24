<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the top 3 users with the highest total points
        $topUsers = User::select('users.*')
            ->join('points', 'users.id', '=', 'points.user_id')
            ->selectRaw('SUM(points.point) as total_points')
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->orderBy('total_points', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($value) {
                $value->total_points = CustomHelper::formatPoint($value->total_points);
                return $value;
            });

        // Fetch users who are currently clocked in
        $activeUsers = User::whereHas('attendance', function ($query) {
            $query->whereNull('clock_out_time');
        })->get();

        return view('dashboard', compact('topUsers', 'activeUsers'));
    }
}
