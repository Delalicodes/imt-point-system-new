<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login page
    public function login()
    {
        return view('auth.login.auth');
    }

    // Handle the login form submission
    public function loginPost(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'username' => 'required|string', // Ensure the username is provided and is a string
            'password' => 'required|string', // Ensure the password is provided and is a string
        ]);

        // Attempt to log the user in with the provided credentials
        $isLoggedIn = Auth::attempt($credentials, $request->filled('remember'));

        if (! $isLoggedIn) {
            // If login attempt fails, return an error response
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username or Password'
            ], 422);
        }

        // If everything is okay, return a success response
        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'redirect' => route('dashboard') // Include the redirect URL if login is successful
        ]);
    }


    public function logout()
    {
        Auth::logout(); // Log the user out

        // Optionally, you can invalidate the session or regenerate the token
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Redirect to the login page or any other page
        return redirect('auth'); // Ensure this matches your login route
    }
}
