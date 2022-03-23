<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class cloudinaryStorage extends Controller
{
    private const folder_path = 'uploaded';

    public static function path($path) 
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function upload($image, $filename)
    {
        $newFileName = str_replace(' ', '-', $filename);
        $public_id = date('Y-m-d').'_'.$newFileName;
        $result = cloudinary()->upload($image, [
            'public_id' => self::path($public_id),
            'folder' => self::folder_path
        ])->getSecurePath();

        return $result;
    }

    public static function delete($path)
    {
        $public_id = self::folder_path.'/'.self::path($path);
        return cloudinary()->destroy($public_id);
    }
}
