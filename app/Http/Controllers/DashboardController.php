<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Parse selected week or default to current week
        $selectedWeek = $request->input('week');
        if ($selectedWeek) {
            $startOfWeek = Carbon::parse($selectedWeek)->startOfWeek();
            $endOfWeek = Carbon::parse($selectedWeek)->endOfWeek();
        } else {
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
        }

        // Fetch top 3 users with points for the selected week, sorting by total points
        $topUsers = User::whereHas('points', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            })
            ->withSum(['points as total_points' => function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            }], 'point')
            ->orderByDesc('total_points')
            ->take(3)
            ->get();

        // Fetch users who are currently clocked in (i.e., active users)
        $activeUsers = User::whereHas('attendance', function ($query) {
            $query->whereNull('clock_out_time');
        })->get();

        return view('dashboard', compact('topUsers', 'activeUsers', 'startOfWeek', 'endOfWeek'));
    }
}
