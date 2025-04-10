@extends('admin.layouts.app')

@section('main-content')
    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent">
                <form id="products.store">
                    <div class="card mb-1">
                        <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                            <i class="ri-search-line fs-22"></i>
                            <input type="search" class="form-control border-0" id="search-modal-input"
                                placeholder="Search for actions, people,">
                            <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->




    <div class="card position-relative">
        <form id="productForm">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mt-2">
                            <label class="form-label">Title :</label>
                            <input type="text" name="title" id="title" placeholder="Product Title"
                                class="form-control">
                            <p></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-2">
                            <label class="form-label">Slug :</label>

                            <input type="text" name="slug" id="slug" class="form-control"
                                placeholder="Product Slug" readonly>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="mt-2">
                            <label for="description">Description:
                            </label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-2">
                            <label class="form-label">Product Status :</label>
                            <input type="text" class="form-control" placeholder="Product Status" id="product_status"
                                name="product_status">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mt-2">
                            <label for="InvoicePaymentMethod" class="form-label">Product Category:</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-2">
                            <label for="InvoicePaymentMethod" class="form-label">Product Brand:</label>
                            <select class="form-select" id="brand_id" name="brand_id" style="width:100%">
                                <option value="">Select Brand</option>
                                @if ($brands)
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="mt-2">
                            <label for="featured_product" class="form-label">Featured Product:</label>
                            <select name="is_featured" id="is_featured" value="Yes" class="form-select">
                                <option value="No">Yes</option>
                                <option value="Yes">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2 class="h4 mt-2">Media</h2>
                        <div id="image" class="dropzone dz-clickable" style="border: 2px solid #000; width: 50%;">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click upload</br></br>
                            </div>
                        </div>
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
                        <input type="text" placeholder="Price" class="form-control" name="price"
                            id="price"></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Compare at Price :
                        </label>
                        <input type="text" placeholder="Compare at Price" class="form-control" name="compare_price"
                            id="compare_price"></textarea>
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
                        <input type="text" placeholder="Sku" class="form-control" name="sku"
                            id="sku"></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2">
                        <label for="description">Barcode :
                        </label>
                        <input type="text" placeholder="Barcode" class="form-control" name="barcode"
                            id="barcode"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-2">
                        <div class="form-check mt-2">
                            <input type="hidden" name="track_qty" value="No">
                            <input type="checkbox" class="form-check-input" id="track_qty" name="track_qty"
                                value="Yes" checked>
                            <label class="form-check-label" for="track_quantity">Track Quantity</label>
                        </div>
                        <div class="mt-2">
                            <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity"
                               >
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
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
        <!-- end buttons -->
    </div>



    </form>


    </div>





@endsection

@section('customJS')
    <script>
        $("#productForm").submit(function(event) {

            event.preventDefault();

            var formArray = $(this).serializeArray();
            $.ajax({
                url: "{{ route('products.store') }}",
                type: 'post',
                data: formArray,
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{route('products.index')}}"

                    } else {
                        var errors = response['errors'];

                        // if (errors['title']) {

                        //     $("#title").addClass('is-invalid')
                        //     .siblings('p').addClass('invalid-feedback')
                        //     .html(errors['title'])

                        // }
                        // else
                        // {
                        //     $("#title").removeClass('is-invalid')
                        //     .siblings('p').removeClass('invalid-feedback')
                        //     .html("")

                        // }

                        $(".error").removeClass('invalid-feedback').html("");
                        $("input[type='text'],select,input[type='number']").removeClass('is-invalid');


                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(value);

                        })

                    }

                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },
            })

        });


        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone("#image", {
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                var html = `<div class="card" style="width: 18rem;">
                                    <input type="hidden" name="image_Array[]" value="${response.image_id}">

                <img src="${response.imagePath}" class="card-img-top" alt="...">
                <div class="card-body">
                
                <a href="#" class="btn btn-danger">Delete</a>
                </div>
                </div>`;
                $('#product-gallery').append(html);

            }, error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },

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
