<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function index()
    {
        $usersWithPoints = User::select('users.id', 'users.first_name', 'users.last_name', DB::raw('SUM(points.point) as total_points'))
            ->leftJoin('points', 'users.id', '=', 'points.user_id')
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->orderByDesc('total_points') // Order by total points in descending order
            ->get();

        return view('summary', compact('usersWithPoints'));
    }
}
