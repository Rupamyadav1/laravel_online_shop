@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="categoryForm">
                    <div class="card-body">
                        <!-- Invoice Logo-->


                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Category Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter category name" style="width:101%">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug"  placeholder="enter slug" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="image_id" id="image_id" value="">
                                <h2 class="h4 mt-2">Media</h2>
                                <div id="image" class="dropzone dz-clickable" style="border: 2px solid #6c757d; width: 50%;">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click upload</br></br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <select class="form-select" name="status">
                                        <option>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                        </select>
                                        
                                       
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Show On Home :</label>
                                    <select class="form-select" name="showHome">
                                        <option>Select Status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                        
                                       
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Add Category
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

function deleteImage(id) {
    $("#image-row-" + id).remove();
}

        $("#categoryForm").submit(function (event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop("disable",true);
            $.ajax({

                url: '{{ route('categories.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    window.location.href="{{ route('categories.index') }}"
                    $("button[type=submit]").prop("disable",false);

                    if (response['status'] == true) {
                        $("#name").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("");

                        $("#slug").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("")

                    }
                    else {
                        var error = response["errors"];
                        if (error["name"]) {
                            $("#name").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['name'])
                        }
                        else {
                            $("#name").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }

                        if (error["slug"]) {
                            $("#slug").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['slug'])
                        }
                        else {
                            $("#slug").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }

                    }




                },
                error: function (jqXHR, exception) {
                    console.log("something went wrong");

                },
            })
        });


         $("#name").change(function () {
              element = $(this);
            $.ajax({
                url: "{{ route('getSlug') }}",
                type: "get",
                data: { title: element.val() },
                dataType: "json",
                success: function (response) {
                    if (response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    }
                },
                error: function (xhr) {
                    console.log("Error generating slug:", xhr.responseText);
               }
           });
         });


    </script>


@endsection