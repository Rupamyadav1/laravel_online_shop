<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRating;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->with('product_images')->paginate();
        // dd($products);

        if (!empty(request()->get('keyword'))) {
            $products = $products->where('title', 'like', '%' . request()->get('keyword') . '%');
        }



        $data['products'] = $products;
        return view('admin.product.index', $data);
    }
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['brands'] = $brands;
        return view('admin.product.create', $data);
    }
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category_id' => 'required',
            'is_featured' => 'required|in:Yes,No'
        ];

        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $product = new Product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->status = $request->product_status;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->related_products = ($request->related_products) ? implode(',', $request->related_products) : '';

            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->save();



            if (!empty($request->image_Array)) {
                foreach ($request->image_Array as $temp_image_id) {
                    $tempImgInfo = TempImage::find($temp_image_id);

                    $extArray = explode('.', $tempImgInfo->image);



                    $ext = last($extArray);


                    $ProductImage = new ProductImage;
                    $ProductImage->product_id = $product->id;
                    $ProductImage->image = 'NULL';
                    $ProductImage->save();

                    $imageName = $product->id . '-' . $ProductImage->id . '-' . time() . '.' . $ext;
                    $ProductImage->image = $imageName;
                    $ProductImage->save();



                    $sourcePath = public_path() . '/temp/' . $tempImgInfo->image;
                    $destPath = public_path() . '/uploads/product/small/' . $imageName;
                    $manager = new ImageManager(new Driver()); // use GD driver

                    // Read image from file system
                    $image = $manager->read($sourcePath);

                    // Resize/crop like fit(300, 275)
                    $image = $image->cover(300, 275);

                    // Save the thumbnail
                    $image->save($destPath);

                    $sourcePath = public_path() . '/temp/' . $tempImgInfo->image;
                    $destPath = public_path() . '/uploads/product/large/' . $imageName;
                    $manager = new ImageManager(new Driver()); // use GD driver

                    // Read image from file system
                    $image = $manager->read($sourcePath);

                    // Resize/crop like fit(300, 275)
                    $image = $image->cover(300, 275);

                    // Save the thumbnail
                    $image->save($destPath);
                    session()->flash('success', 'Product added successfully!');
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'product added sucessfully ',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit(Request $request, $productId)
    {
        $product = Product::find($productId);
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        $relatedProducts = [];

        if (!empty($product->related_products)) {
            $productArray = explode(',', $product->related_products); //explode converts array to string
            // dd([$product->related_products,$productArray]);
            $relatedProducts = Product::whereIn('id', $productArray)->get();
        }


        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['brands'] = $brands;
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'product id not found',
            ]);
        }

        $data['relatedProducts'] = $relatedProducts;
        $data['subcategories'] = $subcategories;
        $data['productImages'] = $productImages;
        $data['product'] = $product;
        return view('admin.product.edit', $data);
    }
    public function update($productId, Request $request)
    {
        $product = Product::find($productId);

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $productId . ',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,slug,' . $productId . ',id',
            'track_qty' => 'required|in:Yes,No',
            'category_id' => 'required',
            'is_featured' => 'required|in:Yes,No'
        ];





        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->status = $request->product_status;
            $product->related_products = ($request->related_products) ? implode(',', $request->related_products) : '';
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->is_featured = $request->is_featured;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->save();

            return response()->json([

                'status' => true,
                'message' => 'product added sucessfully ',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function destroy($productId)
    {


        $product = Product::find($productId);

        $productImages = ProductImage::where('product_id', $productId)->get();
        if (!$product || !$productImages) {
            return response()->json([
                'status' => false,
                'message' => 'product or product_images not found',
            ]);
        }
        if ($productImages) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('uploads/product/small/' . $productImage->image));
                File::delete(public_path('uploads/product/large/' . $productImage->image));
            }
            ProductImage::where('product_id', $productId)->delete();
        }
        $product->delete();


        return response()->json([
            'status' => true,
            'message' => 'product deleted sucessfully ',
        ]);
    }



    public function getProducts(Request $request)
    {
        $tempProduct = [];

        if ($request->term != "") {
            $products = Product::where('title', 'like', '%' . $request->term . '%')->get();

            if (!empty($products)) {
                foreach ($products as $product) {
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }
        return response()->json([
            'tags' => $tempProduct,
            'status' => true,

        ]);
    }

    public function productRating()
    {
        $ratings = ProductRating::select('product_ratings.*', 'products.title as productTitle')
            ->orderBy('created_at', 'DESC');
        $ratings = $ratings->leftJoin('products', 'products.id', 'product_ratings.product_id');
        if (!empty(request()->get('keyword'))) {
            $ratings = $ratings->orWhere('products.title', 'like', '%' . request()->get('keyword') . '%');
            $ratings = $ratings->orWhere('product_ratings.username', 'like', '%' . request()->get('keyword') . '%');
        }
        $ratings = $ratings->paginate(10);
        $data['ratings'] = $ratings;
        return view('admin.product.ratings', $data);
    }

    public function changeRatingStatus(Request $request)
    {
        $productRating = ProductRating::find($request->rating_id);
        $productRating->status = $request->status;
        $productRating->save();

        session()->flash('success', 'Status changed successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}
