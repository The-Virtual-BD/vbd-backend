<?php

namespace App\Http\Controllers\Api;

use App\Models\NewsSubscriber;
use App\Http\Requests\StoreNewsSubscriberRequest;
use App\Http\Requests\UpdateNewsSubscriberRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NewsSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $newsSubscriber = NewsSubscriber::all();
            return response()->json(['data' => $newsSubscriber], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
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
     * @param  \App\Http\Requests\StoreNewsSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
        ]);


        try {
            $exist = NewsSubscriber::where('email',$request->email)->get();
            if ($exist->count() > 0) {
                return response()->json(['message' => 'This email already subscribed'], 200);
            }else{

                $subscribe = NewsSubscriber::create(['email' => $request->email]);
                return response()->json(['message' => 'Subscribe to newsletter successfully'], 200);
            }
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsSubscriber  $newsSubscriber
     * @return \Illuminate\Http\Response
     */
    public function show(NewsSubscriber $newsSubscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsSubscriber  $newsSubscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsSubscriber $newsSubscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsSubscriberRequest  $request
     * @param  \App\Models\NewsSubscriber  $newsSubscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        try {
            $subscriber = NewsSubscriber::find($id);
            $subscriber->update(['status' => $request->status]);
            return response()->json(['message' => 'Subscriber ' . (($request->status == 1 ? 'activated' : 'de-activated')) . ' successfully !'], 200);
            //code...
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }



    public function toggle($id)
    {
        try {
            $subscriber = NewsSubscriber::findOrFail($id);

            if ($subscriber->status == 1) {
                $subscriber->update(['status' => 2]);

            } else {
                $subscriber->update(['status' => 1]);

            }

            return response()->json(['message' => 'Subscriber ' . (($subscriber->status == 1 ? 'activated' : 'de-activated')) . ' successfully !'], 200);
            //code...
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsSubscriber  $newsSubscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            $subscriber = NewsSubscriber::find($id);
            $subscriber->delete();
            return response()->json(['message' => 'Unsuscribed!'], 200);
            //code...
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }
}
