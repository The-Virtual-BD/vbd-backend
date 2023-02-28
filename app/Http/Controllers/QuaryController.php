<?php

namespace App\Http\Controllers;

use App\Models\Quary;
use App\Http\Requests\StoreQuaryRequest;
use App\Http\Requests\UpdateQuaryRequest;

class QuaryController extends Controller
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
     * @param  \App\Http\Requests\StoreQuaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuaryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function show(Quary $quary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function edit(Quary $quary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuaryRequest  $request
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuaryRequest $request, Quary $quary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quary  $quary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quary $quary)
    {
        //
    }
}
