<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function allService()
    {
        try {
            $services = Service::all();

            return response()->json(['message' => 'This is all service we provide.','data' => $services], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getService(Service $service)
    {
        try {
            return response()->json([
                'service' => $service
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create(StoreServiceRequest $request)
    {
        try {
            // Create service
            $service = new Service();
            $service->name = $request->name;
            $service->description = $request->description;

            if ($request->file('cover')) {
                $file = $request->file('cover');
                $filefullname = time().'.'.$file->getClientOriginalExtension();
                $upload_path = 'imges/uploads/service/';
                $fileurl = $upload_path.$filefullname;
                $success = $file->move($upload_path, $filefullname);
                $service->cover = $fileurl;
            }

            $service->save();
            return response()->json(['message' => 'Service created Successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        try {
            // Update service
            $service->name = $request->name;
            $service->description = $request->description;

            if ($request->file('cover')) {
                // Delete old cover
                if($service->cover) {
                    unlink($service->cover);
                }
                $file = $request->file('cover');
                $filefullname = time().'.'.$file->getClientOriginalExtension();
                $upload_path = 'img/uploads/service/';
                $fileurl = $upload_path.$filefullname;
                $success = $file->move($upload_path, $filefullname);
                $service->cover = $fileurl;
            }
            $service->update();
            return response()->json(['message' => 'Service updated Successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy(Service $service)
    {
        try {
            if($service->cover) { unlink($service->cover);}
            $service->delete();
            return response()->json(['message' => 'Service deleted successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
