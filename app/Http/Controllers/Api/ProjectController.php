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
        return response()->json([ 'data' => $projects], 200);
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

        $project->name = $request->name;
        if ($request->client_name) {
            $project->client_name = $request->client_name;
        }

        $project->user_id = $request->user_id;
        $project->service_id = $request->service_id;
        $project->starting_date = $request->starting_date;
        $project->ending_date = $request->ending_date;
        $project->value = $request->value;
        $project->value_paid = $request->value_paid;

        if ($request->value_payable) {
            $project->value_payable = $request->value_payable;
        }


        if ($request->file('documents')) {
            $file = $request->file('documents');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/documents';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->documents = $fileurl;
        }

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->cover = $fileurl;
        }


        $project->progress = $request->progress;
        $project->description = $request->description;
        $project->short_description = $request->short_description;

        if ($request->status) {
            $project->status = $request->status;
        }

        if ($request->protfolio) {
            $project->status = $request->protfolio;
        }


        $project->save();


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
    public function update(Request $request, $id)
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

        $project = Project::findOrFail($id);


        $project->name = $request->name;
        if ($request->client_name) {
            $project->client_name = $request->client_name;
        }

        $project->user_id = $request->user_id;
        $project->service_id = $request->service_id;
        $project->starting_date = $request->starting_date;
        $project->ending_date = $request->ending_date;
        $project->value = $request->value;
        $project->value_paid = $request->value_paid;

        if ($request->value_payable) {
            $project->value_payable = $request->value_payable;
        }


        if ($request->file('documents')) {


            $file = $request->file('documents');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/documents';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->documents = $fileurl;
        }

        if ($request->file('cover')) {
            
            $file = $request->file('cover');
            $filefullname = time().'.'.$file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path.$filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->cover = $fileurl;
        }


        $project->progress = $request->progress;
        $project->description = $request->description;
        $project->short_description = $request->short_description;

        if ($request->status) {
            $project->status = $request->status;
        }

        if ($request->protfolio) {
            $project->status = $request->protfolio;
        }


        $project->update();
        return response()->json(['message' => 'Project Updated.'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $project = Project::findOrFail($id);
        // // Delete old doccument
        // if($project->documents ) {
        //     unlink($project->documents );
        // }
        // // Delete old doccument
        // if($project->cover ) {
        //     unlink($project->cover );
        // }
        $project->delete();
        return response()->json(['message' => 'Project Deleted.'], 200);

    }
}
