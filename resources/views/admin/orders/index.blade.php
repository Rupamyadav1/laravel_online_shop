@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">Orders</h4>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                        <div class="flex-shrink-0 d-flex align-items-center gap-2">
                            <form method="get">
                                <div class="position-relative">
                                    <input type="text" value="{{ Request::get('keyword') }}" class="form-control ps-4"
                                        placeholder="Search Here..." name="keyword">

                                </div>
                            </form>

                            <div>
                                <button class="btn btn-primary"
                                    onclick="window.location.href='{{ route('orders.index') }}' ">Reset</button>
                            </div>
                        </div>
                       
                    </div><!-- end d-flex -->
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="bg-light-subtle">
                            <tr>

                                <th class="fs-12 text-uppercase text-muted">Orders #</th>
                                <th class="fs-12 text-uppercase text-muted">Customer</th>
                                <th class="fs-12 text-uppercase text-muted">Email </th>
                                <th class="fs-12 text-uppercase text-muted">Phone</th>
                                <th class="fs-12 text-uppercase text-muted">Status</th>
                                <th class="fs-12 text-uppercase text-muted">Amount</th>
                                <th class="fs-12 text-uppercase text-muted">Date Purchased</th>
                            </tr>
                        </thead>
                        <!-- end table-head -->
                        @php
                            $i = 1;
                        @endphp


                        <tbody>
                            @if (!empty($orders))
                                @foreach ($orders as $order)
                                  
                                        <tr>
                                            <td><a class="fs-15 text-muted"href="{{ route('order.detail',$order->id) }}">{{ $order->id }}</a></td>
                                            <td><span class="fs-15 text-muted">{{ $order->first_name }}</span></td>
                                            <td><span class="fs-15 text-muted">{{ $order->email }}</span></td>
                                            <td><span class="fs-15 text-muted">{{ $order->mobile }}</span></td>

                                            @if ($order->status == 'pending')
                                            <td><span class="badge bg-danger">Pending</span></td>
                                            @elseif($order->status == 'shipped')
                                            <td><span class="badge bg-info">Shipped</span></td>
                                            @elseif($order->status == 'delivered')
                                            <td><span class="badge bg-info">Delivered</span></td>
                                            @else
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            @endif

                                            <td><span class="fs-15 text-muted">{{number_format($order->grand_total,2)}}</span></td>
                                            <td><span class="fs-15 text-muted">{{\Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}</span></td>


                                   


                                           
                                        </tr>
                                         @endforeach
                        @endif
                        </tbody>
                      
                       
                    </table><!-- end table -->
                    {{ $orders->links() }}
                </div>


            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection

@section('customJS')
    <script>
        function deleteProduct(id) {
            var url = "{{ route('products.delete', 'ID') }}"; // 'ID' is just a placeholder
            var newUrl = url.replace("ID", id); // Replace placeholder with actual ID
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
                        url: newUrl,
                        type: 'get',
                        data: {
                            product_id: id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status === true) {

                                Swal.fire("Deleted!", response.message, "success");
                                window.location.href = "{{ route('products.index') }}"
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
    </script>
