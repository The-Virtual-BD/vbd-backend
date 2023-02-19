<?php

namespace App\Http\Controllers\Api;

use App\Models\Notice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notices = Notice::all();

            return response()->json(['data' => $notices ], 200);

        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
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
     * @param  \App\Http\Requests\StoreNoticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeRequest $request)
    {
        $notice = new Notice();
        $notice->title = $request->title;


        if ($request->file('document')) {
            $file = $request->file('document');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/notice/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $notice->document = $fileurl;
        }


        $notice->save();
        return response()->json(['message' => 'Notice saved.'],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        return response()->json(['data' => $notice],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoticeRequest  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->title = $request->title;
        if ($request->file('document')) {

            // Delete old doccument
            if($notice->document) {
                unlink($notice->document);
            }
            $file = $request->file('document');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/notice/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $notice->document = $fileurl;
        }

        $notice->update();
        return response()->json(['message' => 'Notice update.'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $notice = Notice::findOrFail($id);
        // Delete old doccument
        if($notice->document) {
            unlink($notice->document);
        }
        $notice->delete();
        return response()->json(['message' => 'Notice Deleted.'],200);


    }
}
