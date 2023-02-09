<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Homecontroller extends Controller
{

    public function test()
    {
        $user = User::find(1);
        return view('test',compact('user'));
    }


    public function profileUpdate(Request $request, $id)
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
                $user->bio = $request->bio;
            }


            if ($request->blogger_name) {
                $user->blogger_name = $request->blogger_name;
            }

            $user->update();

            return back()->withSuccess(__('Profile Updated'));
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
            return back()->withErrors(__('Updated Faild'));
        }


    }
}
