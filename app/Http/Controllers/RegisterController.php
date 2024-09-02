<?php
// app/Http/Controllers/RegisterController.php
// app/Http/Controllers/RegisterController.php

// app/Http/Controllers/RegisterController.php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('auth.register.register-step1');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Store data in session or handle as needed
        $request->session()->put('registration_step1', $request->only([
            'full_name', 'username', 'dob', 'phone', 'address'
        ]));

        return response()->json(['success' => true]);
    }

    public function showStep2()
    {
        return view('auth.register.register-step2');
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:registrations',
            'password' => 'required|confirmed|min:8',
        ]);

        // Retrieve Step 1 data from session
        $step1Data = $request->session()->get('registration_step1');

        // Create a new registration record
        $user = DB::table('registrations')->insert([
            'full_name' => $step1Data['full_name'],
            'username' => $step1Data['username'],
            'dob' => $step1Data['dob'],
            'phone' => $step1Data['phone'],
            'address' => $step1Data['address'],
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Clear session data
        $request->session()->forget('registration_step1');

        return response()->json(['success' => true]);
    }
}


