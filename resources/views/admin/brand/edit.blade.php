@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="brand_form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Brand Name :</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter category name" style="width:101%" value="{{ $brand->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="enter slug"
                                        readonly value="{{ $brand->slug }}">
                                    <p></p>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <input type="text" class="form-control" name="status" placeholder="1:active 0:inactive"
                                        style="width: 50%;" value="{{ $brand->status }}">


                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Update Brand
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
        $("#brand_form").submit(function (event) {
           event.preventDefault();
            var element = $(this);
            $.ajax({

                url: '{{ route('brands.update',$brand->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if(response["status"] == true)
                {
                    window.location.href="{{ route('brands.index') }}"


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