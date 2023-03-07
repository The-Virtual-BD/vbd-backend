<?php

namespace App\Http\Controllers;

use App\Models\SubChat;
use App\Http\Requests\StoreSubChatRequest;
use App\Http\Requests\UpdateSubChatRequest;

class SubChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSubChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function show(SubChat $subChat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function edit(SubChat $subChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubChatRequest  $request
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubChatRequest $request, SubChat $subChat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubChat  $subChat
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubChat $subChat)
    {
        //
    }
}
