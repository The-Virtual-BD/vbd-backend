<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // validate data
            $data = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'birth_date' => 'required',
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
                'user' => $user,
                'message' => 'User Register Successfully',
                'token' => $user->createToken('AUTH TOKEN')->plainTextToken
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user->hasRole('admin')) {
                if ($this->attempLogin($request->only(['email', 'password']))) {
                    return response()->json([
                        'message' => 'Admin Login successfully',
                        'role'=> 'admin',
                        'token' => $user->createToken('AUTH TOKEN')->plainTextToken
                    ], 200);
                }
            }
            if ($this->attempLogin($request->only(['email', 'password']))) {
                return response()->json([
                    'user' => $user,
                    'message' => 'User Login successfully',
                    'role'=> 'user',
                    'token' => $user->createToken('AUTH TOKEN')->plainTextToken
                ], 200);
            }

            return response()->json([
                'error' => 'Your credentials does not match with our record.'
            ], 401);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function attempLogin($data)
    {
        return Auth::guard()->attempt($data);
    }

    public function logout(Request $request)
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'Logout successfull'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
