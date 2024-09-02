<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeeklyPointController extends Controller
{
    public function weeklySummary()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $users = User::with(['points' => function($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }])
        ->get()
        ->map(function ($user) {
            $user->total_points = $user->points->sum('point');
            return $user;
        })
        ->sortByDesc('total_points')
        ->values();

        return view('weekly_point', compact('users'));
    }

    public function resetWeeklyPoints()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Store weekly points in history
        $users = User::with(['points' => function($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }])->get();

        foreach ($users as $user) {
            $totalPoints = $user->points->sum('point');

            DB::table('weekly_points_history')->insert([
                'user_id' => $user->id,
                'total_points' => $totalPoints,
                'week_start' => $startOfWeek->toDateString(),
                'week_end' => $endOfWeek->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Reset points
        DB::table('points')->delete(); // Clear the points table

        return response()->json(['message' => 'Weekly points have been reset successfully.']);
    }
}
