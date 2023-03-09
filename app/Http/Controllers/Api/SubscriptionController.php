<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Mail\SubscriptionApprove;
use App\Mail\SubscriptionComplete;
use App\Mail\SubscriptionCreate;
use App\Mail\SubscriptionReject;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function index()
    {
        try {
            $subscriptions = Subscription::with(['applicant', 'service'])->get();
            return response()->json(['data' => $subscriptions], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    // Subscription Application
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'service_id' => 'required|string',
                'subject' => 'required|string',
                'description' => 'required|string',
                'attachment' => 'nullable',
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
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'files/subscriptions/documents/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $subscription->attachment = $fileurl;
            }

            $subscription->save();

            $message = 'Your application for subscription on review . We will contac with you soon.';

            try{
                $sendmail = Mail::to(auth('sanctum')->user()->email)->send(new SubscriptionCreate($message));
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }

            return response()->json(['message' => $message], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $subscription = Subscription::with(['applicant', 'service','chats'])->findOrFail($id);
            return response()->json(['data' => $subscription], 200);
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

    public function approve(Subscription $subscription)
    {
        try {
            $subscription->status = 3;
            $subscription->update();
            $message = 'Your application for subscription is accepted.';

            try{
                $sendmail = Mail::to($subscription->applicant->email)->send(new SubscriptionApprove($message));
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }
            return response()->json(['message' =>  $message], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function decline(Subscription $subscription)
    {
        try {
            $subscription->status = 4;
            $subscription->update();

            $message = 'Your application for subscription is declined.';

            try{
                $sendmail = Mail::to($subscription->applicant->email)->send(new SubscriptionReject($message));
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }
            return response()->json(['message' =>  $message], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function complete(Subscription $subscription)
    {
        try {
            $subscription->status = 5;
            $subscription->update();

            $message = 'Your Project is copleted.';

            try{
                $sendmail = Mail::to($subscription->applicant->email)->send(new SubscriptionComplete($message));
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }
            return response()->json(['message' =>  $message], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Subscription $subscription)
    {
        try {
            if ($subscription->cover) {
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
