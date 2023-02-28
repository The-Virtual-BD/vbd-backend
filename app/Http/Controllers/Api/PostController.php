<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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

    public function activeposts()
    {
        $posts = Post::where('status', 2)->get();
        return response()->json(['data' => $posts], 200);
    }

    // mypost
    public function myposts()
    {
        try {
            $posts = Post::where('user_id',auth('sanctum')->user()->id)->get();

            return response()->json(['data' => $posts ], 200);

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|string',
            'short_description' => 'required|string',
            'descriptions' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->short_description = $request->short_description;
        $post->description = $request->descriptions;
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



        return response()->json([ 'message' => 'Post saved. It will Publish soon.' ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json(['data' => $post ], 200);

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
