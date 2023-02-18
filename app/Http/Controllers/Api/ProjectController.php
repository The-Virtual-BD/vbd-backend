<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::all();
        return response()->json(['message' => 'This is all projects we have.', 'data' => $projects], 200);

    }

    public function myproject()
    {
        $projects = Project::where('user_id', auth('sanctum')->user()->id)->get();
        return response()->json(['message' => 'This is all projects you have.', 'data' => $projects], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'client_name' => 'nullable|string',
            'user_id' => 'nullable|string',
            'service_id' => 'required|string',
            'starting_date' => 'required|string',
            'ending_date' => 'required|string',
            'value' => 'nullable|string',
            'value_paid' => 'nullable|string',
            'value_payable' => 'nullable|string',
            'documents' => 'nullable',
            'cover' => 'nullable',
            'description' => 'required|string',
            'short_description' => 'required|string',
        ]);


        $project = new Project();


        return response()->json(['message' => 'New Project Started', 'data' => $project], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json(['data' => $project]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
