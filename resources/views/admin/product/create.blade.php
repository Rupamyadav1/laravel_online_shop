@extends('admin.layouts.app')

@section('main-content')
    <!-- Search Modal -->
    {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent">
                    <form>
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
        </div> --}}






    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->


    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="card position-relative">
                    <form>
                        <div class="card-body">


                            <div class="row">
                                <div class="col">
                                    <div class="mb-2">
                                        <label class="form-label">Title :</label>
                                        <input type="text" id="title" placeholder="Product Title" 
                                            name="title" class="form-control">
                                    </div>
                                    
                                    <div class="mb-2">
                                        <label for="description">Description:
                                        </label>
                                        <textarea  class="form-control"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Product Status :</label>
                                        <input type="text" class="form-control" placeholder="Product Status"
                                            id="product_status" name="product_status">
                                    </div>
                                    <div class="mb-2 pb-1">
                                        <label for="InvoicePaymentMethod" class="form-label">Product Category:</label>
                                        <select class="form-select" id="InvoicePaymentMethod">
                                            <option value="">Select Method</option>
                                            <option value="Choice 1">Credit / Debit Card</option>
                                            <option value="Choice 2">Bank Transfer</option>
                                            <option value="Choice 3">PayPal</option>
                                            <option value="Choice 4">Payoneer</option>
                                            <option value="Choice 5">Cash On Delivery</option>
                                            <option value="Choice 6">Wallet</option>
                                            <option value="Choice 7">UPI (Gpay)</option>
                                        </select>
                                    </div>





                                    <div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="mb-4">
                                        <label class="form-label">Slug :</label>
                                        <div class="mb-2 pb-1">
                                            <input type="text" class="form-control" placeholder="Product Slug"
                                                name="slug" id="slug" readonly>
                                        </div>



                                    </div>
                                </div>

                                <div class="mb-2 pb-1">
                                    <label for="InvoicePaymentMethod" class="form-label">Product Brand:</label>
                                    <select class="form-select" id="InvoicePaymentMethod" style="width:66%">
                                        <option value="">Select Method</option>
                                        <option value="Choice 1">Credit / Debit Card</option>
                                        <option value="Choice 2">Bank Transfer</option>
                                        <option value="Choice 3">PayPal</option>
                                        <option value="Choice 4">Payoneer</option>
                                        <option value="Choice 5">Cash On Delivery</option>
                                        <option value="Choice 6">Wallet</option>
                                        <option value="Choice 7">UPI (Gpay)</option>
                                    </select>
                                </div>
                            </div>




                        </div> <!-- end card-body-->
                    </form>
                </div><!-- end card -->

                <div class="mb-5">
                    <button class="btn btn-primary">Add Product</button>
                </div>
                <!-- end buttons -->
            </div>


        </div>



    </div>



    </div>


    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection

@section('CustomJS')
    <script>
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
