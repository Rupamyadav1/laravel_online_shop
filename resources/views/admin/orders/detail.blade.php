@extends('admin.layouts.app')
@section('main-content')
<div class="navbar-nav pl-2">
					<ol class="breadcrumb p-0 m-0">
						<li class="breadcrumb-item"><a href="orders.html">Orders</a></li>
						<li class="breadcrumb-item active">Order Detail</li>
					</ol>
				</div>
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
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Order: #{{$order->id}}</h1>
							</div>
							<div class="col-sm-6 text-right">
                                <a href="orders.html" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header pt-3">
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                            <h1 class="h5 mb-3">Shipping Address</h1>
                                            <address>
                                                <strong>{{$order->first_name .' '.$order->last_name}}</strong><br>
                                                {{$order->address}}<br>
                                                {{$order->city}}, {{$order->zip}} {{$order->countryName}}<br>
                                               Phone: {{$order->mobile}}<br>
                                               Email: {{ $order->email }}
                                            </address>
                                            </div>
                                            
                                            <h1 class="h5 mb-3">Shipped date</h1>
                                            <time datetime="2019-10-01">
                                                    @if (!empty($order->shipped_date))
                                                        
                                                    
                                                   {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M,Y') }}
                                                   @else
                                                   N/A
                                                   @endif
                                                </time>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="col-sm-4 invoice-col">
                                                {{-- <b>Invoice #007612</b><br>
                                                <br> --}}
                                                <b>Order ID:</b> {{$order->id}}<br>
                                                <b>Total:</b> {{number_format($order->grand_total,2)}}<br>
                                                <b>Status:</b> 
                                                
                                                @if ($order->status == 'pending')
                                            <td><span class="badge bg-danger">Pending</span></td>
                                            @elseif($order->status == 'shipped')
                                            <td><span class="badge bg-info">Shipped</span></td>
                                            @else
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            @endif
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-3">								
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th width="100">Price</th>
                                                    <th width="100">Qty</th>                                        
                                                    <th width="100">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItems as $orderItem )
                                                    
                                               
                                                <tr>
                                                    <td>{{$orderItem->name}}</td>
                                                    <td>{{$orderItem->price}}</td>                                        
                                                    <td>{{$orderItem->qty}}</td>
                                                    <td>{{$orderItem->total}}</td>
                                                </tr>
                                                 @endforeach
                                              
                                                <tr>
                                                    <th colspan="3" class="text-right">Subtotal:</th>
                                                    <td>${{number_format($order->sub_total,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">Discount:( {{(!empty($order->coupon_code) ? $order->coupon_code :'' )}})</th>
                                                    <td>${{number_format($order->discount,2)}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th colspan="3" class="text-right">Shipping:</th>
                                                    <td>${{number_format($order->shipping,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">Grand Total:</th>
                                                    <td>${{number_format($order->grand_total,2)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>								
                                    </div>                            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <form id="changeOrderStatusForm" method="post">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Order Status</h2>
                                        <div class="mb-3">
                                            <select id="order_status" name="order_status"  class="form-control">
                                                <option>Select order status</option>
                                                <option value="pending" {{ ($order->status) == 'pending' ?'selected' :''}}>Pending</option>
                                                <option value="shipped" {{ ($order->status) == 'shipped' ?'selected' :''}}>Shipped</option>
                                                <option value="delivered" {{ ($order->status) == 'delivered' ?'selected' :''}}>Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="shipped_date">Shipped Date</label>
                                            <input placeholder="shipped date" value="{{ $order->shipped_date }}" type="text" class="form-control" id="shipped_date" name="shipped_date">
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Send Inovice Email</h2>
                                        <div class="mb-3">
                                            <select class="form-control">
                                                <option value="">Customer</option>                                                
                                                <option value="">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
						
		
@endsection
@section('customJS')
<script>

        $(document).ready(function(){
            $("#shipped_date").datetimepicker({
                format: "Y-m-d H:i:s"
            });
        })
        $("#changeOrderStatusForm").submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('order.status.change',$order->id) }}",
                type:'post',
                data:$(this).serializeArray(),
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    window.location.href="{{ route('order.detail',$order->id) }}";


                }
            })

        })
            </script>
@endsection
