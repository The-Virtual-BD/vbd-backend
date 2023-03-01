<?php

namespace App\Http\Controllers\Api;

use App\Models\Quary;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuaryRequest;
use App\Http\Requests\UpdateQuaryRequest;
use Illuminate\Http\Request;

class QuaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $queries = Quary::all();

            return response()->json(['data' => $queries], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
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
     * @param  \App\Http\Requests\StoreQuaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'message' => 'required',
            ]);

            $quary = new Quary();
            $quary->name = $request->name;
            $quary->email = $request->email;
            $quary->phone = $request->phone;
            $quary->message = $request->message;
            $quary->save();

            //
            // email sending code goes here
            //
            return response()->json(['message' => 'Thanks for contacting us. We will get to you soon.'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        try {
            $quary = Quary::findOrFail($id);
            $quary->status = 2;
            $quary->save();
            return response()->json(['data' => $quary], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function replay(Request $request, $id)
    {
        try {
            $quary = Quary::findOrFail($id);
            $msg = $request->msg;
            //
            // email sending code goes here
            //
            $quary->status = 3;
            $quary->save();

            return response()->json(['message' => 'Replay sent'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function edit(Quary $quary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuaryRequest  $request
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuaryRequest $request, Quary $quary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            $quary = Quary::findOrFail($id);
            $quary->delete();
            return response()->json(['message' => 'Querry deletted!'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
