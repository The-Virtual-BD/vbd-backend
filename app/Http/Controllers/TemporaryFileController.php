<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use App\Http\Requests\StoreTemporaryFileRequest;
use App\Http\Requests\UpdateTemporaryFileRequest;

class TemporaryFileController extends Controller
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
     * @param  \App\Http\Requests\StoreTemporaryFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemporaryFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemporaryFile  $temporaryFile
     * @return \Illuminate\Http\Response
     */
    public function show(TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TemporaryFile  $temporaryFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemporaryFileRequest  $request
     * @param  \App\Models\TemporaryFile  $temporaryFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemporaryFileRequest $request, TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TemporaryFile  $temporaryFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemporaryFile $temporaryFile)
    {
        //
    }
}
