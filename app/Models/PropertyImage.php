<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PropertyImage extends Model
{
    use HasFactory;
    protected $table='property_images';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_id',
        'image_path',
    ];

    public static function saveImage($files,$property_id,$new_images){
        try{
            $preview_image='';
            foreach ($files as $key => $file) {
                // Generate a unique name for the image
                $pictureName = time() . '_' . $file->getClientOriginalName();

                // Move the file to the uploads directory
                $file->move(public_path('uploads/properties/'), $pictureName);
//
//                // Get the full path of the uploaded image
//                $picturePath = public_path('uploads/properties/') . $pictureName;
//
//                // Determine the file type
//                $imageInfo = getimagesize($picturePath);
//                $fileType = $imageInfo[2]; // The second element of getimagesize() result contains the image type
//
//                // Open the image using GD
//                if ($fileType === IMAGETYPE_JPEG) {
//                    $image = imagecreatefromjpeg($picturePath);
//                } elseif ($fileType === IMAGETYPE_PNG) {
//                    $image = imagecreatefrompng($picturePath);
//                } else {
//                    // Unsupported image type, handle accordingly (e.g., log an error, skip processing, etc.)
//                    continue;
//                }
//
//                // Add watermark text
//                $watermarkText = 'TREMLAK360.COM';
//                $textColor = imagecolorallocatealpha($image, 255, 255, 255, 90); // light gray with transparency
//                $font = public_path('check.ttf'); // Path to the font file
//                $fontSize = 20;
//
//                // Calculate text dimensions
//                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $watermarkText);
//                $textWidth = abs($textBoundingBox[4] - $textBoundingBox[0]);
//                $textHeight = abs($textBoundingBox[5] - $textBoundingBox[1]);
//
//                // Calculate text position
//                $imageWidth = imagesx($image);
//                $imageHeight = imagesy($image);
//                $x = (($imageWidth - $textWidth) / 2)+50;
//                $y = (($imageHeight - $textHeight) / 2)+80;
//
//                // Rotate the text by 45 degrees
//                $angle = 45;
//
//                // Add the watermark text to the image
//                imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $font, $watermarkText);
//
//                // Save the modified image
//                if ($fileType === IMAGETYPE_JPEG) {
//                    imagejpeg($image, $picturePath);
//                } elseif ($fileType === IMAGETYPE_PNG) {
//                    imagepng($image, $picturePath);
//                }
//
//                // Free up memory
//                imagedestroy($image);

                // Save the image path to the database
                $pictureName = 'uploads/properties/' . $pictureName;
                if($key == 0 && $new_images == true){
                    $preview_image=$pictureName;
                }

                PropertyImage::create([
                    'property_id' => $property_id,
                    'image_path' => $pictureName,
                ]);

            }
           return $preview_image;
        } catch (\Throwable $th) {
            return response()->json(['status' => 'false','icon'=>'error', 'message' => 'Exception to upload images']);
        }
    }

}
