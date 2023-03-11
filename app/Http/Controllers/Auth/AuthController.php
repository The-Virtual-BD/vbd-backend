<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserWelcome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Registering new user
    public function register(Request $request){
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


            $message = 'Welcome to the VirtualBD. Your account has been created.';

            try{
                $sendmail = Mail::to($data['email'])->send(new UserWelcome());
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }

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

    // Loging registerd user
    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            // If this user is admin user
            if ($user->hasRole('admin')) {
                if ($this->attempLogin($request->only(['email', 'password']))) {
                    return response()->json([
                        'user' => $user,
                        'message' => 'Admin Login successfully',
                        'role'=> 'admin',
                        'token' => $user->createToken('AUTH TOKEN')->plainTextToken
                    ], 200);
                }
            }

            // If this user is normal user
            if ($this->attempLogin($request->only(['email', 'password']))) {
                return response()->json([
                    'user' => $user,
                    'message' => 'User Login successfully',
                    'role'=> 'user',
                    'token' => $user->createToken('AUTH TOKEN')->plainTextToken
                ], 200);
            }

            // If credentials didnt match
            return response()->json([
                'error' => 'Your credentials does not match with our record.'
            ], 401);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    // Login attempt
    public function attempLogin($data){
        return Auth::guard()->attempt($data);
    }

    //Loging out and deleting personal access token
    public function logout(Request $request){
        try {
            // Deletion personal access token
            Auth::user()->currentAccessToken()->delete();
            // Returning response if success
            return response()->json([
                'message' => 'Logout successfull'
            ], 200);
        } catch (\Throwable $e) {
            // Returning response if response failed
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
