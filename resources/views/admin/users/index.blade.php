@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">User</h4>
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
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('users.index') }}' ">Reset</button>
                            </div>
                        </div>
                        <a href="{{ route('users.create') }}" class="btn btn-primary"><i
                                class="ri-add-line me-1"></i>Add Users</a>
                    </div><!-- end d-flex -->
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="bg-light-subtle">
                            <tr>

                                <th class="fs-12 text-uppercase text-muted">ID</th>
                                <th class="fs-12 text-uppercase text-muted">Name </th>
                                <th class="fs-12 text-uppercase text-muted">Email</th>
                                
                                <th class="fs-12 text-uppercase text-muted">Status</th>
                                <th class="text-center fs-12 text-uppercase text-muted" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <!-- end table-head -->
                        @php
                            $i = 1;
                        @endphp


                        <tbody>
                            @if (!empty($users))
                                    @foreach ($users as $user)
                                            

                                            




                                                    <tr>

                                                        <td><span class="text-muted fw-semibold">{{$user->id}}</span></td>
                                                       
                                                            
                                                        
                                                         <td><span class="fs-15 text-muted">{{$user->name}}</span></td>
                                                        <td><span class="fs-15 text-muted">{{$user->email}}</span></td>
                                                        @if ($user->status == 1)
                                                            
                                                        
                                                        <td><button class="btn btn-success">Active</button></td>
                                                        @else
                                                         <td><button class="btn btn-danger">Block</button></td>
                                                        @endif
                                                        

                                                        
                                                        <td class="pe-3">
                                                            <div class="hstack gap-1 justify-content-end">
                                                                
                                                                <a href="{{ route('users.edit',$user->id) }}"
                                                                    class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                                        class="ri-edit-box-line fs-16"></i></a>
                                                                <a  onclick="deleteUser({{ $user->id }})"
                                                                    class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                                        class="ri-delete-bin-line"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            
                                    @endforeach
                            @endif
                    </table><!-- end table -->
                    {{ $users->links() }}
                </div>


            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection

@section('customJS')
   <script>


    function deleteUser(id) {
        var url = "{{ route('users.delete', 'ID') }}"; // 'ID' is just a placeholder
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
                        url:newUrl,
                        type: 'get',
                        data: {
                            product_id :id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status === true) {
                                
                                Swal.fire("Deleted!", response.message, "success");
                                window.location.href="{{ route('users.index') }}"
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