@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="categoryForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Category Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter category name" style="width:101%" value="{{ $category->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="enter slug" value="{{ $category->slug }}">
                                    <p></p>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="image_id" id="image_id" value="">
                                <h2 class="mt-2">Media</h2>
                                <div id="image" class="dropzone dz-clickable"
                                    style="border: 2px solid #000; width: 50%;">
                                    <div class="dz-message needsclick">Drop files here or click to upload</div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">

                                    @if ($category->image)
                                   
                                        <img src="{{ asset('uploads/category/thumb/' . $category->image) }}"
                                            alt="Category Image" class="card-img-top" style="width: 200px; height: 200px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <input type="text" class="form-control" name="status"
                                        placeholder="1:active 0:inactive" style="width: 101%;"
                                        value="{{ $category->status }}">


                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Show On Home :</label>
                                    <select class="form-select" name="showHome">

                                        <option {{ $category->showHome == 'Yes' ? 'selected' : '' }} value="Yes">Yes
                                        </option>
                                        <option {{ $category->showHome == 'No' ? 'selected' : '' }} value="No">No
                                        </option>
                                    </select>


                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Update Category
                            </button>
                        </div>

                    </div>


                </form>
            </div><!-- end card -->

        </div>
    </div>
@endsection

@section('customJS')
    <script>
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({

                url: '{{ route('categories.update', $category->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response["status"] == true) {
                        window.location.href = "{{ route('categories.index') }}"


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

                $("#image_id").val(response.image_id);
                // var html = `<div class="card" id="image-row-${response.image_id}" style="width: 18rem;">
            //                     <input type="hidden" name="image_Array[]" value="${response.image_id}">

            // <img src="${response.imagePath}" class="card-img-top" alt="...">
            // <div class="card-body">

            // <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
            // </div>
            // </div>`;
                // $('#product-gallery').append(html);


            },


            error: function(jqXHR, exception) {
                console.log("something went wrong");

            },

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






        $("#name").change(function() {
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
