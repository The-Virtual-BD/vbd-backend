<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    // Profile Update
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->birth_date = $request->birth_date;
            $user->profession = $request->profession;
            $user->phone = $request->phone;
            $user->nationality = $request->nationality;

            if ($request->bio) {
                # code...
                $user->bio = $request->bio;
            }

            $user->update();

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
