<?php

namespace App\Http\Traits;

trait ImagesTrait{


    private function uploadImage($file, $fileNewName, $path, $oldFilePath = null)
    {
        $file->move(public_path('uploads/'.$path), $fileNewName);
        $NewFilePath = 'uploads/'.$path. '/'.$fileNewName;
        if(!is_null($oldFilePath))
        {
            unlink(public_path($oldFilePath));
        }
         return $NewFilePath;
    }
}
