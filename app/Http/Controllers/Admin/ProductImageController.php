<?php

namespace App\Http\Controllers\Admin;



use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;


class ProductImageController extends Controller
{
    public function store(Request $request){

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath=$image->getPathname();

           

        $ProductImage=new ProductImage;
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

    public function destroy(Request $request)
{
    $productImage = ProductImage::find($request->image_id); // updated here
    if ($productImage) {
        File::delete(public_path('uploads/product/small/' . $productImage->image));
        File::delete(public_path('uploads/product/large/' . $productImage->image));
        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully',
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Image not found',
        ]);
    }
}

}
