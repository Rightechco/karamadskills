<?php

namespace Modules\File\Http\Services;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Modules\File\Models\File;
use Nette\FileNotFoundException;

class FileService
{
    public static function save($disk,$file,$model,$name = null)
    {
        $path = Storage::disk($disk)->putFile($file);
        $file = $model->files()->create([
           'path' => $path,
            'name' => $name
        ]);
        return $file->id;
    }

    public static function linkSave($model,$link,$name = null){
        $file = $model->files()->create([
            'path' => 'link',
             'name' => $name,
             'link' => $link
         ]);
         return $file->id;
    }
}
