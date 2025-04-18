@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="subCategoryForm">
                    <div class="card-body">



                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Category Name :</label>
                                    @if ($categories)
                                        <div class="form-group">
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    @endif


                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Sub Category Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter sub category name" style="width:101%">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="enter slug" readonly>
                                    <p></p>

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
                                <p></p>
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
                                Add Sub Category
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
        $("#subCategoryForm").submit(function(event) {
            event.preventDefault();

            var element = $(this);
            $("button[type=submit]").prop("disable", true);
            $.ajax({

                url: "{{ route('sub-category.store') }}",
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    window.location.href="{{ route('sub-category.index') }}";
                    if (response['status'] == true) {
                        $("#name").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("");

                        $("#slug").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("");

                        $("#category_id").removeClass("is-invalid")
                            .next('p').removeClass("invalid-feedback").html("");



                    } else {
                        var error = response["errors"];
                        console.log(error)

                        if (error["category_id"]) {
                            $("#category_id").addClass("is-invalid")
                                .next('p').addClass("invalid-feedback").html(error['category_id']);
                        } else {
                            $("#category_id").removeClass("is-invalid")
                                .next('p').removeClass("invalid-feedback").html("");
                        }



                        if (error["name"]) {
                            $("#name").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['name'])
                        } else {
                            $("#name").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }

                        if (error["slug"]) {
                            $("#slug").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['slug'])
                        } else {
                            $("#slug").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }





                    }

                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },
            })
        });


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
