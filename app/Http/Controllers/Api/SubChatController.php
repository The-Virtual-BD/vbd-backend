<?php

namespace App\Http\Controllers\Api;

use App\Models\SubChat;
use App\Http\Requests\StoreSubChatRequest;
use App\Http\Requests\UpdateSubChatRequest;
use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubChatRequest $request)
    {
        try {

            $validated = $request->validate([
                'subscription_id' => 'required|string',
                'message' => 'required|string',
                'attachment' => 'nullable',
                'type' => 'nullable',
                'status' => 'nullable',
            ]);

            $sunchat = new SubChat();
            $sunchat->user_id = auth('sanctum')->user()->id;
            $sunchat->subscription_id = $request->subscription_id;
            $sunchat->message = $request->message;

            $sunchat->type = $request->type;

            if ($request->file('attachment')) {
                $file = $request->file('attachment');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'files/sunchats/documents/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $sunchat->attachment = $fileurl;
            }

            $sunchat->save();
            $subscription = Subscription::with(['applicant', 'service','chats'])->findOrFail($request->subscription_id);
            return response()->json(['message' => 'Message Sent', 'data' => $subscription ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function show(SubChat $subChat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function edit(SubChat $subChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubChatRequest  $request
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubChatRequest $request,  $id)
    {
        try {

            $validated = $request->validate([
                'message' => 'nullable|string',
                'attachment' => 'nullable',
                'status' => 'nullable',
            ]);

            $sunchat = SubChat::findOrFail($id);

            if ($request->message) {
                $sunchat->message = $request->message;
            }
            if ($request->status) {
                $sunchat->status = $request->status;
            }

            if ($request->file('attachment')) {
                if ($sunchat->attachment) {
                    unlink($sunchat->attachment);
                }
                $file = $request->file('attachment');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'files/sunchats/documents/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $sunchat->attachment = $fileurl;
            }

            $sunchat->save();
            $subscription = Subscription::with(['applicant', 'service','chats'])->findOrFail($sunchat->subscription_id);

            return response()->json(['message' => 'Message Updated', 'data' => $subscription], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $sunchat = SubChat::findOrFail($id);
            $subscription = Subscription::with(['applicant', 'service','chats'])->findOrFail($sunchat->subscription_id);
            if ($sunchat->attachment) {
                unlink($sunchat->attachment);
            }

            $sunchat->delete();
            return response()->json(['message' => 'Message Deleted', 'data' => $subscription], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
