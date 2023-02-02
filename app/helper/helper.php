<?php

use Illuminate\Support\Facades\File;

function fileUpload($file, $path, $old_path='')
{
    if ($old_path) {
        if (file_exists($old_path)) {
            unlink($old_path);
        }
    }
    $file_name = uniqid('file_', true).'.'.$file->extension();
    if (!File::isDirectory($path)) {
      File::makeDirectory($path);  
    }
    $file->move($path, $file_name);
    return $file_name;
}
