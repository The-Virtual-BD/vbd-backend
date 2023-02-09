<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{




    public function index()
    {
        try {
            $subscriptions = Subscription::all();
            return response()->json(['message' => 'This is all subscription we have.', 'data' => $subscriptions], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'service_id' => 'required|string',
            'subject' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'required|mimes:zip,rar',
            'schedule' => 'required',
        ]);




        $subscription = new Subscription();
        $subscription->user_id = auth('sanctum')->user()->id;
        $subscription->service_id = $request->service_id;
        $subscription->subject = $request->subject;
        $subscription->description = $request->description;
        $subscription->schedule = $request->schedule;


        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'files/subscriptions/documents/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $subscription->attachment = $fileurl;
        }

        $subscription->save();
        return response()->json([ 'message' => 'Applied for subscription. We will contac you soon.' ], 200);
    }

    public function show(Subscription $subscription)
    {
        try {
            return response()->json(['message' => 'This is your desired subscripteion','data' => $subscription], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, Subscription $subscription)
    {
        try {
            // Update subscription
            $subscription->update([
                'schedule' => Carbon::parse($request->schedule),
            ]);

            return response()->json([
                'message' => 'Subscription Confirmed'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy(Subscription $subscription)
    {
        try {
            if($subscription->cover) {
                unlink($subscription->cover);
            }
            $subscription->delete();

            return response()->json(['message' => 'Subscription deleted successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
