<?php
namespace App\trait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait Image
{
    public function store_base64($base64Image, $img_path){
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $image = substr($base64Image, strpos($base64Image, ',') + 1);
            $image = base64_decode($image);

            $extension = strtolower($type[1]); // jpg, png, gif ...

            $allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
            if (in_array($extension, $allowed_extensions)) {
                $img_name = str_replace([' ', ':', '-'], 'X', now() . rand(1, 10000)) . '.' . $extension;
                $path = public_path($img_path . '/' . $img_name);

                if (!File::exists(public_path($img_path))) {
                    File::makeDirectory(public_path($img_path), 0777, true);
                }
 
                file_put_contents($path, $image);

                return $img_name;
            } 
        }
        return null;
    }

    public function delete_image($image_path, $image){
        try {
            $imagePath = public_path($image_path . '/' . $image); 
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}