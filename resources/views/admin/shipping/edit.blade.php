@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="shippingForm">
                    <div class="card-body">
                        <!-- Invoice Logo-->
                        <h2>Shipping Mangement</h2>

                        <div class="row">
                            <div class="col">
                                <div class="mb-2 mt-2">
                                   <select class="form-select" name="country" id="country">
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id}}" {{ $shipping->country_id == $country->id ? 'selected' :''}} >{{ $country->name }}</option>
                                    @endforeach
                                    <option value="rest_of_world">Rest of the world</option>
                                   </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 mt-2">
                                    
                                    <input type="text" class="form-control" name="amount" id="amount"
                                        placeholder="amount" value="{{ $shipping->amount }}">
                                        <p></p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-add-circle-line me-1"></i>
                                    Add Shipping
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('customJS')
    <script>
        $("#shippingForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route('shipping.update', $shipping->id) }}',
                
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success: function(response) {
                    if (response["status"] == true) {
                        window.location.href = "{{ route('shipping.index') }}"


                    }
                },
                error: function(jqXHR, exception) {
                    console.log("something went wrong");

                },
            })
        });


       
    </script>
@endsection
