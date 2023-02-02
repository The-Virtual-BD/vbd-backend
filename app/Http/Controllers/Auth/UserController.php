<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function allUser()
    {
        try {
            $user = User::all();

            return response()->json([
                'user' => $user
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getUser(User $user)
    {
        try {
            return response()->json([
                'user' => $user
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            // validate data
            $data = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'birth_date' => 'required|date',
                'profession' => 'required',
                'phone' => 'required|numeric|unique:users,phone',
                'nationality' => 'required',
                'password' => 'required|string|confirmed',
            ]);

            // Create user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'birth_date' => Carbon::parse($data['birth_date']),
                'profession' => $data['profession'],
                'phone' => $data['phone'],
                'nationality' => $data['nationality'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole('user');
            return response()->json([
                'message' => 'User created Successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            if ($request->email != $user->email) {
                $data = $request->validate([
                    'email' => 'required|email|unique:users,email'
                ]);
            }

            if ($request->phone != $user->phone) {
                $data = $request->validate([
                    'phone' => 'required|numeric|unique:users,phone'
                ]);
            }
            // validate data
            $data = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'birth_date' => 'required|date',
                'profession' => 'required',
                'phone' => 'required|numeric',
                'nationality' => 'required',
                'password' => 'required|string|confirmed',
                'role' => 'required',
            ]);

            // Update user
            $user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'birth_date' => Carbon::parse($data['birth_date']),
                'profession' => $data['profession'],
                'phone' => $data['phone'],
                'nationality' => $data['nationality'],
                'password' => Hash::make($data['password']),
            ]);

            $user->syncRoles($request->role);
            return response()->json([
                'message' => 'User updated Successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
