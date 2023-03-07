<?php

namespace App\Http\Controllers\Api;

use App\Models\Newsletter;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $newsletters = Newsletter::all();
            return response()->json(['data' => $newsletters], 200);
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
     * @param  \App\Http\Requests\StoreNewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required',
            'subject' => 'required',
            'image' => 'nullable',
            'link' => 'nullable'
        ]);


        try {
            $newsletter = new Newsletter();
            $newsletter->text = $request->text;
            $newsletter->subject = $request->subject;
            if ($request->link) {
                $newsletter->link = $request->link;
            }
            if ($request->file('image')) {
                $file = $request->file('image');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'imges/newsletter/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $newsletter->image = $fileurl;
            }
            $newsletter->save();
            return response()->json(['message' => 'Newsletter Saved'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Sending the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $newsletter = Newsletter::findOrFail($id);
            return response()->json(['data' => $newsletter], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        try {
            // Need to send newsletter mail
            $newsletter = Newsletter::findOrFail($id);
            return response()->json(['data' => $newsletter], 200);
            return response()->json(['message' => 'Newsletter Send'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsletterRequest  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'text' => 'required',
            'subject' => 'required',
            'image' => 'nullable',
            'link' => 'nullable'
        ]);



        try {
            $newsletter = Newsletter::findOrFail($id);
            $newsletter->text = $request->text;
            $newsletter->subject = $request->subject;
            if ($request->link) {
                $newsletter->link = $request->link;
            }
            if ($request->file('image')) {
                if ($newsletter->image) {
                    unlink($newsletter->image);
                } //If newsletter already have a image
                $file = $request->file('image');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'imges/newsletter/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $newsletter->image = $fileurl;
            }

            $newsletter->save();
            return response()->json(['message' => 'Newsletter Updated'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $newsletter = Newsletter::findOrFail($id); //Finding the ezxact newsletter
            if ($newsletter->image) {
                unlink($newsletter->image);
            } //deletting newsletter image first
            $newsletter->delete(); //deleting newsletter
            return response()->json(['message' => 'Newsletter deleted'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }
}
