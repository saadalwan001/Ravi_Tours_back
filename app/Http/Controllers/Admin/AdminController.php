<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Return all admins (for dropdown in blog creation page)
    public function index()
    {
        $admins = Admin::select('id', 'name')->get();
        return response()->json($admins);
    }

    // Fetch currently logged-in admin profile
    public function getProfile(Request $request)
    {
        $admin = $request->user();
        return response()->json($admin);
    }

    // Update admin profile (name, email, password)
    public function updateProfile(Request $request)
    {
        $admin = auth()->user(); // currently logged-in admin

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin,email,' . $admin->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
        ]);

        // Only update password if new_password is provided
        if (!empty($validated['new_password'])) {
            if (!Hash::check($validated['current_password'], $admin->password)) {
                return response()->json(['message' => 'Current password is incorrect'], 422);
            }
            $admin->password = Hash::make($validated['new_password']); // ensure hashed
        }

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'admin' => $admin
        ]);
    }

    // Admin login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login with default guard
        if (Auth::attempt($validated)) {
            $admin = Auth::user();
            return response()->json([
                'message' => 'Login successful',
                'admin' => $admin
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Admin logout
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
