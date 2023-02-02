<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\TemporaryFile;


class UploadController extends Controller
{
    // Temporarily uploading file
    public function tempUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $folder = uniqid().'-'.now()->timestamp;
            foreach ($images as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('images/tmp/'.$folder,$filename);
                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename
                ]);
                return $folder;
            }
            return '';
        }
    }


    //Delete any Media
    public function mediaDelete($id)
    {
        $media = Media::find($id);
        $media->delete();
        return redirect()->back();
    }
}
