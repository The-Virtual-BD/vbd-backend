<?php

namespace App\Http\Controllers\Api;

use App\Models\Vaccancy;
use App\Http\Requests\StoreVaccancyRequest;
use App\Http\Requests\UpdateVaccancyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VaccancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vaccancies = Vaccancy::all();
            return response()->json(['data' => $vaccancies], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function activevaccancies()
    {
        try {
            $vaccancies = Vaccancy::where('status', 1)->get();
            return response()->json(['data' => $vaccancies], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
     * @param  \App\Http\Requests\StoreVaccancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'designation' => 'required|string',
            'type' => 'required|string',
            'salary_range' => 'required|string',
            'skills' => 'required|string',
            'description' => 'required',
        ]);


        try {
            $vaccancies = Vaccancy::create($validated);
            return response()->json(['message' => 'New Vacancy Created'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $vaccancies = Vaccancy::findOrFail($id);
            return response()->json(['data' => $vaccancies], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccancy $vaccancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVaccancyRequest  $request
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'designation' => 'required|string',
            'type' => 'required|string',
            'salary_range' => 'required|string',
            'skills' => 'required|string',
            'description' => 'required',
        ]);


        try {
            $vaccancies = Vaccancy::findOrFail($id);
            $vaccancies->update($validated);
            return response()->json(['message' => 'Vaccancy Updated'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $vaccancies = Vaccancy::findOrFail($id);
            $vaccancies->delete();
            return response()->json(['message' => 'Vaccancy deleted'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
