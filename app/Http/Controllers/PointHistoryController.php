<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointHistoryController extends Controller
{
    public function index(){
        return view('point_history');
    }
    public function getPointsByDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        // Assuming you have a `created_at` field in your `points` table to filter by date
        $points = Point::with('user')
            ->whereDate('created_at', $request->date)
            ->get();

        return response()->json($points);
    }
}
