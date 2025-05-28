@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

            <div class="card position-relative">
                <form id="discountForm" method="post">
                    <div class="card-body">
                      
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label"> Code :</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $discount->code }}"
                                        placeholder="code" style="width:101%">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Name :</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $discount->code }}"
                                        placeholder="Name">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Description :</label>
                                    <textarea class="form-control" name="description" id="description" value="{{ $discount->description }}">{{ $discount->description }}</textarea>

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Max Uses :</label>
                                    <input type="text" class="form-control" name="max_uses" id="max_uses" value="{{ $discount->max_uses }}"
                                        placeholder="Max Uses">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Max User Uses :</label>
                                    <input type="text" class="form-control" name="max_user_uses" id="max_user_uses" value="{{ $discount->max_uses_user }}"
                                        placeholder="Max User Uses">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Type :</label>
                                    <select name="type" id="type" class="form-control">
                                        <option {{ ($discount->type == 'fixed' ? 'fixed': 'percent' ) }}>Fixed</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Amount :</label>
                                    <input type="text" class="form-control" name="discount_amount" id="discount_amount" value="{{ $discount->discount_amount }}"
                                        placeholder="Amount">
                                        <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Minimum Amount :</label>
                                    <input type="text" class="form-control" name="min_amount" id="min_amount" value="{{ $discount->min_amount }}"
                                        placeholder="Minimum Amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status:</label>
                                    <select class="form-control" id="discount_status" name="discount_status">
                                         <option {{ ($discount->status == 1 ?'Active':'Block') }}>Active</option>
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Starts At :</label>
                                    <input type="text" class="form-control" name="starts_at" id="starts_at" value="{{ $discount->starts_at }}"
                                        placeholder="Starts At">
                                        <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Ends At:</label>
                                    <input type="text" class="form-control" name="ends_at" id="ends_at" value="{{ $discount->expires_at }}"
                                        placeholder="Ends At">
                                        <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Edit Discount
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

        $(document).ready(function(){
            $("#starts_at").datetimepicker({
                format: "Y-m-d H:i:s"
            });

            $("#ends_at").datetimepicker({
                format: "Y-m-d H:i:s"
            });
        })
        $("#discountForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop("disable", true);
            $.ajax({

                url: '{{ route('discount.update', $discount->id) }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                   
                     window.location.href = "{{ route('discount.index') }}"
                    
                    $("button[type=submit]").prop("disable", false);

                    if (response['status'] == true) {
                        $("#code").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("");

                      
                        
                        
                            $("#discount_amount").removeClass("is-invalid")
                            .siblings('p').removeClass("invalid-feedback").html("")
                       
                         

                    } else {
                        var error = response["errors"];
                        if (error["code"]) {
                            $("#code").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['code'])
                        } else {
                            $("#code").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }

                      

                       
                        if (error["discount_amount"]) {
                            $("#discount_amount").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['discount_amount'])
                        } else {
                            $("#discount_amount").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }
                         if (error["starts_at"]) {
                            $("#starts_at").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['starts_at'])
                        } else {
                            $("#starts_at").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }

                        if (error["ends_at"]) {
                            $("#ends_at").addClass("is-invalid")
                                .siblings('p').addClass("invalid-feedback").html(error['ends_at'])
                        } else {
                            $("#ends_at").removeClass("is-invalid")
                                .siblings('p').removeClass("invalid-feedback").html("")
                        }
                        

                       









                    }




                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },
            })
        });
    </script>
@endsection
