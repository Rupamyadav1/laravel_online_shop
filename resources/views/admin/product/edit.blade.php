@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="productForm">
                    <div class="card-body">
                        <!-- Basic Info -->
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Title :</label>
                                    <input type="text" name="title" id="title" placeholder="Product Title"
                                           class="form-control" value="{{ $product->title }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                           placeholder="Product Slug" readonly value="{{ $product->slug }}">
                                </div>
                            </div>
                        </div>

                        <!-- Description & Status -->
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label for="description">Short Description:</label>
                                    <textarea class="form-control" name="short_description" id="short_description" placeholder="">{{ $product->short_description }}</textarea>
                                </div>
                                <div class="mt-2">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ $product->description }}</textarea>
                                </div>
                                <div class="mt-2">
                                    <label for="description">Shipping and returns:</label>
                                    <textarea class="form-control" name="shipping_returns" id="shipping_returns" placeholder="">{{ $product->shipping_returns }}</textarea>
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

                        <!-- Category, Brand, Featured -->
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Product Category:</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Product sub Category:</label>
                                    <select class="form-select" >
                                        @foreach ($subcategories as $subcategory)
                                            <option {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}
                                                value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Product Brand:</label>
                                    <select class="form-select" id="brand_id" name="brand_id">
                                        @foreach ($brands as $brand)
                                            <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <label class="form-label">Featured Product:</label>
                                    <select name="is_featured" id="is_featured" class="form-select">
                                        <option {{ $product->is_featured == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ $product->is_featured == 'No' ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Dropzone for New Image Upload -->
                        <div class="row">
                            <div class="col">
                                <h2 class="mt-2">Media</h2>
                                <div id="image" class="dropzone dz-clickable" style="border: 2px solid #000; width: 50%;">
                                    <div class="dz-message needsclick">Drop files here or click to upload</div>
                                </div>
                            </div>
                        </div>

                        <!-- Existing Product Images -->
                        <div class="row" id="product-gallery">
                            @foreach ($productImages as $image)
                                <div class="mt-2" id="image-row-{{ $image->id }}" style="width: 18rem;">
                                    <input type="hidden" name="image_Array[]" value="{{ $image->id }}">
                                    <img src="{{ asset('uploads/product/large/' . $image->image) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Info -->
                    <div class="card-body">
                        <h3>Product Price</h3>
                        <div class="row">
                            <div class="col">
                                <label>Price:</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>
                            <div class="col">
                                <label>Compare at Price:</label>
                                <input type="text" name="compare_price" id="compare_price" class="form-control" value="{{ $product->compare_price }}">
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Info -->
                    <div class="card-body">
                        <h3>Inventory</h3>
                        <div class="row">
                            <div class="col">
                                <label>SKU:</label>
                                <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}">
                            </div>
                            <div class="col">
                                <label>Barcode:</label>
                                <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $product->barcode }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <input type="hidden" name="track_qty" value="No">
                                <input type="checkbox" name="track_qty" id="track_qty" value="Yes" class="form-check-input" {{ $product->track_qty == 'Yes' ? 'checked' : '' }}>
                                <label for="track_qty" class="form-check-label">Track Quantity</label>
                                <input type="text" name="qty" id="qty" class="form-control mt-2" placeholder="Quantity" value="{{ $product->qty }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script>
        // Update Product AJAX
        $("#productForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route('products.update', $product->id) }}',
                type: 'PUT',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = "{{ route('products.index') }}";
                    }
                },
                error: function() {
                    console.log("Something went wrong");
                }
            });
        });

        // Dropzone Configuration
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("#image", {
            url: "{{ route('products.images.update') }}",
            maxFiles: 10,
            paramName: 'image',
            params: {'product_id': '{{ $product->id }}'},
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                var html = `<div class="card mt-2" id="image-row-${response.image_id}" style="width: 18rem;">
                                <input type="hidden" name="image_Array[]" value="${response.image_id}">
                                <img src="${response.imagePath}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                                </div>
                            </div>`;
                $('#product-gallery').append(html);
            },
            error: function() {
                console.log("Something went wrong while uploading image");
            }
        });

        // Image Delete Function
        function deleteImage(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('products.images.delete') }}',
                        type: 'POST',
                        data: {
                            image_id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === true) {
                                $("#image-row-" + id).fadeOut(300, function() {
                                    $(this).remove();
                                });
                                Swal.fire("Deleted!", response.message, "success");
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function() {
                            Swal.fire("Error!", "Something went wrong!", "error");
                        }
                    });
                }
            });
        }

        // Slug Generator
        $("#title").change(function() {
            const element = $(this);
            $.ajax({
                url: "{{ route('getSlug') }}",
                type: "GET",
                data: {
                    title: element.val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === true) {
                        $("#slug").val(response.slug);
                    }
                },
                error: function(xhr) {
                    console.log("Error generating slug:", xhr.responseText);
                }
            });
        });
    </script>
@endsection
