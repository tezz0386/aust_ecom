<?php
namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class ImageSupport
{
    function __construct(){

    }

    public function removeImage($image):bool
    {
        $path = parse_url($image);
        $base_path = $_SERVER['DOCUMENT_ROOT'];
        try {
            if(file_exists($base_path.$path['path'])){
                unlink($base_path.$path['path']);
            }
        } catch (\Throwable $th) {
            info("Image Not Found");
        }
        return true;
    }
    public function uploadImage($image, $folder_name="holiday")
    {
        $image = Storage::disk('public')->put($folder_name, $image);
        $image = asset("storage/$image");
        return $image;
    }
}