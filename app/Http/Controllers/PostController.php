<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\TemporaryFile;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::all();

            return response()->json([ 'message' => 'This is all possst we have.', 'data' => $posts ], 200);

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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = auth('sanctum')->user()->id;

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/post/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $post->cover = $fileurl;
        }
        $post->save();


        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $post->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('images');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
        }



        return response()->json([ 'message' => 'Post saved. It will Publish soon.', 'data' => $request ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([ 'message' => 'This is your desired post details!', 'data' => $post ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        return response()->json(['message' => 'Post Update successfylly !'], 200);

    }

    public function approve(Post $post)
    {
        $post->status = 2;
        $post->update();
        return response()->json(['message' => 'Post approved and published !'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover) {
            unlink($post->cover);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfylly !'], 200);
    }
}
