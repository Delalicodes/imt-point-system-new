<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the top 3 users with the highest total points

        $points = Point::all();
        $users = User::all();
        $topUsers = User::select('users.*')
            ->join('points', 'users.id', '=', 'points.user_id')
            ->selectRaw('SUM(points.point) as total_points')
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->orderBy('total_points', 'desc')
            ->limit(3)
            ->get()->map(function ($value) {
                // dd($value->total_points);
                $value->total_points = CustomHelper::formatPoint($value->total_points);
                return $value;
            });

        return view('dashboard', compact('topUsers', 'points', 'users'));
    }
}
