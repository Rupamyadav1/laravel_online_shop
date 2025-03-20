@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="category_form">
                    <div class="card-body">
                        <!-- Invoice Logo-->


                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Category Name :</label>
                                    <input type="text" class="form-control" name="category_name" placeholder="enter category name" style="width:101%" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Slug :</label>
                                    <input type="text" class="form-control" name="slug" placeholder="enter slug" >
                                </div>
                            </div>
                           
                           

                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <input type="text" class="form-control" name="slug" placeholder="1:active 0:inactive" style="width: 50%;">
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

    <script >
        $("#category_form").submit(function(event) {
                console.log("Clicked submit button");
                event.preventDefault(); // Prevent actual form submission (remove this if needed)
            });
    </script>
@endsection
