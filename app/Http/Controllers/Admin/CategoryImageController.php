<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class CategoryImageController extends Controller
{
    public function store(Request $request){

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath=$image->getPathname();

           

        $CategoryImage=new CategoryImage;
        $ProductImage->product_id=$request->product_id;
        $ProductImage->image='NULL';
        $ProductImage->save();

        $imageName=$request->product_id.'-'.$ProductImage->id.'-'.time().'.'.$ext;
        $ProductImage->image=$imageName;
        $ProductImage->save();

        $destPath=public_path().'/uploads/product/small/'.$imageName;
        $manager = new ImageManager(new Driver()); // use GD driver

        // Read image from file system
         $image = $manager->read($sourcePath);

        // Resize/crop like fit(300, 275)
        $image = $image->cover(300, 275);

         // Save the thumbnail
        $image->save($destPath);

        $destPath=public_path().'/uploads/product/large/'.$imageName;
        $manager = new ImageManager(new Driver()); // use GD driver

        // Read image from file system
         $image = $manager->read($sourcePath);

        // Resize/crop like fit(300, 275)
        $image = $image->cover(300, 275);

         // Save the thumbnail
        $image->save($destPath);

        return response()->json([
            'status' => true,
            'message' => 'Image uploaded successfully',
            'image_id' => $ProductImage->id,
            'imagePath'=>asset('uploads/product/small/'.$ProductImage->image),
        ]);

    }
}
