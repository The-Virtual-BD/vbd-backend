<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviewes = Review::all();
        return response()->json(['message' => 'This is all review we have!', 'data' => $reviewes], 200);

    }
    public function areviewes()
    {
        $reviewes = Review::where('status', 2)->get();
        return response()->json(['message' => 'This is all review we have!', 'data' => $reviewes], 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $review = Review::create([
            'user_id' => auth('sanctum')->user()->id,
            'project_id' => $request->project_id,
            'quantity' => $request->quantity,
            'body' => $request->body,
        ]);

        return response()->json(['message' => 'Reviewed successfully!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    public function approve(Review $review)
    {
        $review->update(['status' => 2]);
        return response()->json(['message' => 'Review approved and published!'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully!'], 200);
    }
}