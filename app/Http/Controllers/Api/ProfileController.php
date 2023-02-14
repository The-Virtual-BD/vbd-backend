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
    public function update(Request $request)
    {
        $user = User::find(auth('sanctum')->user()->id);

        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'birth_date' => 'required',
            'profession' => 'required',
            'phone' => 'required|numeric|unique:users,phone,'. $user->id,
            'nationality' => 'required',
            'bio' => 'nullable|string',
        ]);




        try {

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->birth_date = $request->birth_date;
            $user->profession = $request->profession;
            $user->phone = $request->phone;
            $user->nationality = $request->nationality;

            if ($request->bio) {
                $user->bio = $request->bio;
            }


            if ($request->blogger_name) {
                $user->blogger_name = $request->blogger_name;
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

    // Profile picture
    public function profilePic(Request $request)
    {
        if ($request->file('photo')) {
            try {
                $user = User::find(auth('sanctum')->user()->id);
                if ($request->file('photo')) {
                    $file = $request->file('photo');
                    $filefullname = time().'.'.$file->getClientOriginalExtension();
                    $upload_path = 'files/profilepic/';
                    $fileurl = $upload_path.$filefullname;
                    $success = $file->move($upload_path, $filefullname);
                    $user->photo = $fileurl;
                }
                $user->update();

                // If profile updated successfully
                return response()->json([
                    'user' => $user,
                    'message' => 'Profile Picture Updated !',
                ], 200);
            } catch (\Throwable $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
        }
    }


    // Password Update
    public function passwordup(Request $request){

        try {
            $request->validate([
                'password' => 'required|string|confirmed',
            ]);

            $user = User::find(auth('sanctum')->user()->id);
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
