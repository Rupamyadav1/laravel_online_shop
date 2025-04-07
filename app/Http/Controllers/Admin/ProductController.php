<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create()
    {
        $categories=Category::orderBy('name','ASC')->get();
        $data['categories']=$categories;
        $brands=Brand::orderBy('name','ASC')->get();
        $data['brands']=$brands;
        return view('admin.product.create',$data);
    }
    public function store(Request $request)
    {
        // dd($request->image_Array);
        // exit();
        $rules=[
            'title'=>'required',
            'slug'=>'required|unique:products',
            'price'=>'required|numeric',
            'sku'=>'required|unique:products',
            'track_qty'=>'required|in:Yes,No',
            'category_id'=>'required|numeric',
            'is_featured'=>'required|in:Yes,No'
        ];

        if(!empty($request->track_qty) && $request->track_qty=='Yes'){
            $rules['qty']='required|numeric';
        }

        $validator=Validator::make($request->all(),$rules);
        if($validator->passes())
        {
            $product =new Product;
            $product->title=$request->title;
            $product->slug=$request->slug;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->status=$request->product_status;
            $product->category_id= $request->category_id;
            $product->brand_id=$request->brand_id;
            $product->is_featured=$request->is_featured;
            $product->price=$request->price;
            $product->compare_price=$request->compare_price;
            $product->sku=$request->sku;
            $product->barcode= $request->barcode;
            $product->track_qty=$request->track_qty;
            $product->qty=$request->qty;
            $product->save();



            if(!empty($request->image_Array))
            {
                foreach($request->image_Array as $temp_image_id)
                {
                    $tempImgInfo=TempImage::find($temp_image_id);
                    $extArray=explode('.',$tempImgInfo);
                    $ext=last($extArray);


                    $ProductImage=new ProductImage;
                    $ProductImage->product_id=$product->id;
                    $ProductImage->image='NULL';
                    $ProductImage->save();

                    $imageName=$product->id.'-'.$ProductImage->id.'-'.time().'.'.$ext;
                    $ProductImage->image=$imageName;
                    $ProductImage->save();

                }

            }

            return response()->json([
                'status'=>true,
                'message'=>'product added sucessfully ',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);

        }
    }
}
