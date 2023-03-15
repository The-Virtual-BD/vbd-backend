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
        return response()->json(['data' => $projects], 200);
    }



    public function activeprojects()
    {
        $projects = Project::where('status', 1)->get();
        return response()->json(['data' => $projects], 200);
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
            'cover' => 'nullable',
            'short_description' => 'required|string',
            'client_name' => 'nullable|string',
            'client_type' => 'nullable|string',
            'client_origin' => 'nullable|string',
            'image_1' => 'nullable',
            'image_2' => 'nullable',
            'image_3' => 'nullable',
            'video' => 'nullable',
            'description' => 'required|string',
            'service_id' => 'required|string',
        ]);


        $project = new Project();

        $project->name = $request->name;

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->cover = $fileurl;
        }
        $project->short_description = $request->short_description;


        // Client informations
        if ($request->client_name) {
            $project->client_name = $request->client_name;
        }
        if ($request->client_type) {
            $project->client_type = $request->client_type;
        }
        if ($request->client_origin) {
            $project->client_origin = $request->client_origin;
        }

        if ($request->file('image_1')) {
            $file = $request->file('image_1');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_1 = $fileurl;
        }
        if ($request->file('image_2')) {
            $file = $request->file('image_2');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_2 = $fileurl;
        }
        if ($request->file('image_3')) {
            $file = $request->file('image_3');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_3 = $fileurl;
        }

        if ($request->video) {
            $project->video = $request->video;
        }
        $project->description = $request->description;
        $project->service_id = $request->service_id;
        $project->save();


        return response()->json(['message' => 'New Project Added', 'data' => $project], 200);
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
            'cover' => 'nullable',
            'short_description' => 'required|string',
            'client_name' => 'nullable|string',
            'client_type' => 'nullable|string',
            'client_origin' => 'nullable|string',
            'image_1' => 'nullable',
            'image_2' => 'nullable',
            'image_3' => 'nullable',
            'video' => 'nullable',
            'description' => 'required|string',
            'service_id' => 'required|string',
        ]);


        $project = Project::findOrFail($id);


        $project->name = $request->name;

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->cover = $fileurl;
        }
        $project->short_description = $request->short_description;


        // Client informations
        if ($request->client_name) {
            $project->client_name = $request->client_name;
        }
        if ($request->client_type) {
            $project->client_type = $request->client_type;
        }
        if ($request->client_origin) {
            $project->client_origin = $request->client_origin;
        }

        if ($request->file('image_1')) {
            $file = $request->file('image_1');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_1 = $fileurl;
        }
        if ($request->file('image_2')) {
            $file = $request->file('image_2');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_2 = $fileurl;
        }
        if ($request->file('image_3')) {
            $file = $request->file('image_3');
            $filefullname = time() . '.' . $file->getClientOriginalExtension();
            $upload_path = 'imges/uploads/project/';
            $fileurl = $upload_path . $filefullname;
            $success = $file->move($upload_path, $filefullname);
            $project->image_3 = $fileurl;
        }

        if ($request->video) {
            $project->video = $request->video;
        }
        $project->description = $request->description;
        $project->service_id = $request->service_id;


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
