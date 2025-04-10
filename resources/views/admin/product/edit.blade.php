@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="productForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Title :</label>
                                    <input type="text" name="title" id="title" placeholder="Product Title"
                                        class="form-control" value="{{ $product->title }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Slug :</label>

                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Product Slug" readonly value={{ $product->slug }}>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label for="description">Description:
                                    </label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Product Status :</label>
                                    <input type="text" class="form-control" placeholder="Product Status"
                                        id="product_status" name="product_status" value="{{ $product->status }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label for="InvoicePaymentMethod" class="form-label">Product Category:</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                                {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label for="InvoicePaymentMethod" class="form-label">Product Brand:</label>
                                    <select class="form-select" id="brand_id" name="brand_id" style="width:100%">
                                        @if ($brands)
                                            @foreach ($brands as $brand)
                                                <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2">
                                    <label for="featured_product" class="form-label">Featured Product:</label>
                                    <select name="is_featured" id="is_featured" value="Yes" class="form-select">
                                        <option {{ $product->is_featured == 'Yes' ? 'selected' : '' }} value="Yes">Yes
                                        </option>
                                        <option {{ $product->is_featured == 'No' ? 'selected' : '' }} value="No">No
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h2 class="h4 mt-2">Media</h2>
                                <div id="image" class="dropzone dz-clickable"
                                    style="border: 2px solid #000; width: 50%;">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click upload</br></br>
                                    </div>
                                </div>
                            </div>
                        </div>
                       @foreach ($productImages as $image)
                           
                      
                            <div class="card" style="width: 18rem;">
                                <input type="hidden" name="image_Array[]" value="{{ $image->id }}">

                                <img src="{{ asset('uploads/product/large/'.$image->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">

                                    <a href="#" class="btn btn-danger">Delete</a>
                                    @endforeach
                       
                    </div>
            </div>
            <div class="row mt-2" id="product-gallery" class="product-gallery">

            </div>

        </div>




    </div>
    <div class="card position-relative">
        <div class="card-body">
            <div>
                <h3>Product price</h3>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Price:
                        </label>
                        <input type="text" placeholder="Price" class="form-control" name="price" id="price"
                            value={{ $product->price }}>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Compare at Price :
                        </label>
                        <input type="text" placeholder="Compare at Price" class="form-control" name="compare_price"
                            id="compare_price" value={{ $product->compare_price }}></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card position-relative">
        <div class="card-body">
            <div>
                <h3>Inventory</h3>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Sku(stock keeping price):
                        </label>
                        <input type="text" placeholder="Sku" class="form-control" name="sku" id="sku"
                            value={{ $product->sku }}></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Barcode :
                        </label>
                        <input type="text" placeholder="Barcode" class="form-control" name="barcode" id="barcode"
                            value={{ $product->barcode }}></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-2">
                        <div class="form-check mt-2">
                            <input type="hidden" name="track_qty" value="No">
                            <input type="checkbox" class="form-check-input" id="track_qty" name="track_qty"
                                value="Yes" {{ $product->track_qty == 'Yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="track_quantity">Track Quantity</label>
                        </div>
                        <div class="mt-2">
                            <input type="text" name="qty" id="qty" class="form-control"
                                placeholder="Quantity" value={{ $product->qty }}>
                        </div>
                        <p></p>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- end card -->
    <div class="card-body">
        <div class="mb-5">
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
        <!-- end buttons -->
    </div>



    </form>


    </div>


    </div>
    </div>
@endsection

@section('customJS')
    <script>
        $("#productForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({

                url: '{{ route('products.update', $product->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response["status"] == true) {
                        window.location.href = "{{ route('products.index') }}"


                    }




                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },
            })
        });






        $("#title").change(function() {
            element = $(this);
            $.ajax({
                url: "{{ route('getSlug') }}",
                type: "get",
                data: {
                    title: element.val()
                },
                dataType: "json",
                success: function(response) {
                    if (response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    }
                },
                error: function(xhr) {
                    console.log("Error generating slug:", xhr.responseText);
                }
            });
        });
    </script>
@endsection
