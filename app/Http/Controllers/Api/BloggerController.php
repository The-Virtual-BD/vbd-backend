<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBloggerRequest;
use App\Models\Blogger;
use App\Models\User;
use Illuminate\Http\Request;

class BloggerController extends Controller
{
    public function index()
    {
        try {
            $bloggers = Blogger::all();
            return response()->json(['status' => true, 'blogger' => $bloggers], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request, $id)
    {
        $user = User::find($id);
        $blogger = Blogger::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'subject' => $request->subject,
            'expertise' => $request->expertise,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Your Applications has been Submitted.'], 200);
    }

    public function show(Blogger $blogger)
    {
        try {
            return response()->json(['status' => true, 'data' => $blogger], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function approve(Blogger $blogger)
    {
        try {
            $buser = User::find($blogger->user_id);
            $buser->blogger_name = $blogger->name;
            $buser->update();
            $buser->assignRole('blogger');
            $blogger->delete();
            return response()->json(['message' =>  'Request accepted !'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function decline(Blogger $blogger)
    {
        try {
            $blogger->status = 3;
            $blogger->update();
            return response()->json(['message' =>  'Request declined !'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function mypendingapplication()
    {
        try {
            $mypendingapplication = Blogger::where('user_id', auth('sanctum')->user()->id)->where('status', 1)->first();
            if ($mypendingapplication) {
                return response()->json(['pending' =>  true], 200);
            } else {
                return response()->json(['pending' =>  false], 200);
            }
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        $blogger = Blogger::findOrFail($id);
        try {
            $blogger->delete();
            return response()->json(['message' => 'Request cancelled'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


}

//
