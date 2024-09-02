<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function index()
    {
        $users = User::all(); // Retrieve all users or apply a specific query
        $points = Point::with('user')->get(); // Correct relationship name is 'user'

        return view('point', compact('points','users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|string',  // Adjust the validation rules as needed
            'point' => 'required|integer',
        ]);

        Point::create($data);  // Assumes you have a Point model and table set up correctly

        return response()->json(['success' => 'Point added successfully!']);
    }

}
