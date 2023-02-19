<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Comment::all();

            return response()->json([ 'message' => 'This is all Comment we have.', 'data' => $posts ], 200);

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
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' => auth('sanctum')->user()->id,
            'commenter_name' => auth('sanctum')->user()->first_name,
            'commenter_email' => auth('sanctum')->user()->email,
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);


        return response()->json([ 'message' => 'Thanks for your feedback.' ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json([ 'data' => $comment ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->body = $request->body;
        $comment->update();
        return response()->json(['message' => 'Comment Updated !'], 200);
    }

    public function approve(Comment $comment)
    {
        $comment->status = 2;
        $comment->update();
        return response()->json(['message' => 'Comment approved and published !'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfylly !'], 200);
    }
}
