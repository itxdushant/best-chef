<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Media;

class MediaController extends Controller
{
    public function store(Request $request){

        if ($request->file) {
            $folderPath = "uploads/media/";
            $base64Image = explode(";base64,", $request->file);
            $explodeImage = explode("image/", $base64Image[0]);
           
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $fileName = time() . '.'.$imageType;
            $file = $folderPath .$fileName;
            file_put_contents($file, $image_base64);
            
            $media = Media::create([
                'file_name' => $fileName,
                'file_type' => $imageType
            ]);
            return $media->id;
        }
        
    }
  
}
