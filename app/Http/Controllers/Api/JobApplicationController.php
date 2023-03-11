<?php

namespace App\Http\Controllers\Api;

use App\Models\JobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Http\Controllers\Controller;
use App\Mail\JobCreate;
use App\Models\Vaccancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $applications = JobApplication::all();
            return response()->json(['data' => $applications], 200);
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
     * @param  \App\Http\Requests\StoreJobApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cv' => 'required',
            'vaccancy_id' => 'required',
            'expected_salary' => 'nullable',
        ]);


        try {
            $jobApplication = new JobApplication();
            $jobApplication->name = $request->name;
            $jobApplication->email = $request->email;
            $jobApplication->phone = $request->phone;
            $jobApplication->vaccancy_id = $request->vaccancy_id;
            if ($request->expected_salary) {
                $jobApplication->expected_salary = $request->expected_salary;
            }
            if ($request->file('cv')) {
                $file = $request->file('cv');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'files/jobApplication/cv/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $jobApplication->cv = $fileurl;
            }
            $jobApplication->save();

            $message = 'Thanks for the application. We will contact with you soon.';

            try{
                $sendmail = Mail::to($jobApplication->email)->send(new JobCreate($message));
            }catch (\Throwable $e){
                return response()->json(['message' => $e->getMessage()]);
            }

            return response()->json(['message' => 'Applied!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        try {
            $jobApplication = JobApplication::findOrFail($id);
            return response()->json(['data' => $jobApplication], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApplication $jobApplication)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobApplicationRequest  $request
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cv' => 'required',
            'vaccancy_id' => 'required',
            'expected_salary' => 'nullable',
        ]);


        try {
            $jobApplication = JobApplication::findOrFail($id);
            $jobApplication->name = $request->name;
            $jobApplication->email = $request->email;
            $jobApplication->phone = $request->phone;
            $jobApplication->vaccancy_id = $request->vaccancy_id;
            if ($request->expected_salary) {
                $jobApplication->expected_salary = $request->expected_salary;
            }
            if ($request->file('cv')) {
                $file = $request->file('cv');
                $filefullname = time() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'files/jobApplication/cv/';
                $fileurl = $upload_path . $filefullname;
                $success = $file->move($upload_path, $filefullname);
                $jobApplication->cv = $fileurl;
            }
            $jobApplication->update();
            return response()->json(['message' => 'Applied!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jobApplication = JobApplication::findOrFail($id);
            if ($jobApplication->vc) {
                unlink($jobApplication->vc);
            } //deletting jobApplication vc first
            $jobApplication->delete();
            return response()->json(['message' => 'Application Deleted!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]); //If anything wrong response the error message
        }
    }
}
