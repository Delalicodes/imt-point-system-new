<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AutomationController extends Controller
{
    public function resetWeeklyPoints()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Store weekly points in history
        $users = \App\Models\User::with(['points' => function($query) use ($startOfWeek, $endOfWeek) {
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
