@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">Rating</h4>
                    </div>
                    @include('front.account.common.message')

                    <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                        <div class="flex-shrink-0 d-flex align-items-center gap-2">
                            <form method="get">
                                <div class="position-relative">
                                    <input type="text" value="{{ Request::get('keyword') }}" class="form-control ps-4" placeholder="Search Here..." name="keyword">

                                </div>
                            </form>

                            <div>
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('product.ratings') }}' ">Reset</button>
                            </div>
                        </div>
                       
                    </div><!-- end d-flex -->
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="bg-light-subtle">
                            <tr>

                                <th class="fs-12 text-uppercase text-muted">ID</th>
                                <th class="fs-12 text-uppercase text-muted">Product </th>
                                <th class="fs-12 text-uppercase text-muted">Rating</th>
                                <th class="fs-12 text-uppercase text-muted">Comment</th>
                                <th class="fs-12 text-uppercase text-muted">Rated By</th>
                                <th class="fs-12 text-uppercase text-muted">Status</th>
                            </tr>
                        </thead>
                        <!-- end table-head -->
                      


                        <tbody>
                            @if (!empty($ratings))
                                    @foreach ($ratings as $rating)
                                            

                                            




                                                    <tr>

                                                        <td><span class="text-muted fw-semibold">{{$rating->id}}</span></td>
                                                       
                                                            
                                                        
                                                         <td><span class="fs-15 text-muted">{{$rating->productTitle}}</span></td>
                                                        <td><span class="fs-15 text-muted">{{$rating->rating}}</span></td>
                                                        <td><span class="fs-15 text-muted">{{$rating->comment}}</span></td>
                                                        <td><span class="fs-15 text-muted">{{$rating->username}}</span></td>
                                                        @if ($rating->status == 1)
                                                            
                                                        
                                                        <td><button class="btn btn-success" onclick="changeStatus(0,{{ $rating->id }})">Active</button></td>
                                                        @else
                                                         <td><button class="btn btn-danger" onclick="changeStatus(1,{{ $rating->id }})">Block</button></td>
                                                        @endif
                                                        

                                                        
                                                       
                                                    </tr>
                                                </tbody>
                                            
                                    @endforeach
                            @endif
                    </table><!-- end table -->
                    {{ $ratings->links() }}
                </div>


            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection

@section('customJS')
   <script>


    function changeStatus(status,id) {
        var url = "{{ route('product.changeRatingStatus', 'ID') }}"; // 'ID' is just a placeholder
        var newUrl = url.replace("ID", id); // Replace placeholder with actual ID
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change status "
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:newUrl,
                        type: 'get',
                        data: {
                            status:status,
                            rating_id :id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status === true) {
                                
                                Swal.fire("Status Changed!", response.message, "success");
                                window.location.href="{{ route('product.ratings') }}"
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