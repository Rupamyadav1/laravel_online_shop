@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="pagesForm" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Page Name" style="width:101%" value="{{ $page->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="Enter Slug" value="{{ $page->slug }}">
                                    <p></p>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Content :</label>
                                    <textarea  class="summernote" name="content" id="content" cols="30" rows="10">{{ $page->content }}
                                    </textarea>
                                        
                                       
                                </div>
                            </div>
                           
                        </div>
                        
                       
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Update Pages
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
        $("#pagesForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({

                url: '{{ route('pages.update', $page->id) }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response["status"] == true) {
                        window.location.href = "{{ route('pages.index') }}"


                    }
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
