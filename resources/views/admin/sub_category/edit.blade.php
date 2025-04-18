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
                                    <select class="form-select" name="category_id" id="category_id">

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $cat->id == $subcategory->category_id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter category name" style="width:101%"
                                        value="{{ $subcategory->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="enter slug"  value="{{ $subcategory->slug }}">
                                    <p></p>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <select class="form-select" name="status">
                                        
                                        <option {{ $subcategory->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $subcategory->status == 0 ? 'selected' : '' }} value="0">Block</option>

                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Show On Home :</label>
                                    <select class="form-select" name="showHome">
                                        <option>Select Status</option>
                                        <option {{ $subcategory->showHome == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ $subcategory->showHome == 'No' ? 'selected' : '' }} value="No">No</option>
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
        $("#subCategoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({

                url: '{{ route('sub-category.update', $subcategory->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response["status"] === true) {
                        // Clear error messages before redirect
                        $("#name").removeClass("is-invalid")
                            .next('p').removeClass("invalid-feedback").html("");

                        $("#slug").removeClass("is-invalid")
                            .next('p').removeClass("invalid-feedback").html("");

                        // Redirect
                        window.location.href = "{{ route('sub-category.index') }}";
                    } else {
                        let error = response["errors"];

                        if (error["name"]) {
                            $("#name").addClass("is-invalid")
                                .next('p').addClass("invalid-feedback").html(error['name']);
                        } else {
                            $("#name").removeClass("is-invalid")
                                .next('p').removeClass("invalid-feedback").html("");
                        }

                        if (error["slug"]) {
                            $("#slug").addClass("is-invalid")
                                .next('p').addClass("invalid-feedback").html(error['slug']);
                        } else {
                            $("#slug").removeClass("is-invalid")
                                .next('p').removeClass("invalid-feedback").html("");
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
