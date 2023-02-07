<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    // Profile Update
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'birth_date' => 'required',
                'profession' => 'required',
                'phone' => 'required|numeric|unique:users,phone',
                'nationality' => 'required',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::find($id);

            // If profile updated successfully
            return response()->json([
                'user' => $user,
                'message' => 'Profile Updated successfully !',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    // Password Update
    public function passwordup(Request $request, $id)
    {
        try {
            $request->validate([
                'password' => 'required|string|confirmed',
            ]);

            $user = User::find($id);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // If profile updated successfully
            return response()->json([
                'message' => 'Your password updated !',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
