@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                    <div class="flex-grow-1">
                        <h4 class="header-title">Pages</h4>
                    </div>
                    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


                    <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                        <div class="flex-shrink-0 d-flex align-items-center gap-2">
                            <form method="get">
                                <div class="position-relative">
                                    <input type="text" value="{{ Request::get('keyword') }}" class="form-control ps-4" placeholder="Search Here..." name="keyword">

                                </div>
                            </form>

                            <div>
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('pages.index') }}' ">Reset</button>
                            </div>
                        </div>
                        <a href="{{ route('pages.create') }}" class="btn btn-primary"><i
                                class="ri-add-line me-1"></i>Add Pages</a>
                    </div><!-- end d-flex -->
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="bg-light-subtle">
                            <tr>

                                <th class="fs-12 text-uppercase text-muted">ID</th>
                                <th class="fs-12 text-uppercase text-muted">Name </th>
                                <th class="fs-12 text-uppercase text-muted">Slug</th>

                                <th class="text-center fs-12 text-uppercase text-muted" style="width: 120px;">Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (!empty($pages))
                                    @foreach ($pages as $page)
                                            




                                                    <tr>

                                                        <td><span class="text-muted fw-semibold">{{$page->id}}</span></td>
                                                        <td>{{ $page->name }}</td>
                                                        <td><span class="fs-15 text-muted">{{$page->slug}}</span></td>
                                                        
                                                        <td class="pe-3">
                                                            <div class="hstack gap-1 justify-content-end">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                                        class="ri-eye-line"></i></a>
                                                                <a href="{{ route('pages.edit',$page->id) }}"
                                                                    class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                                        class="ri-edit-box-line fs-16"></i></a>
                                                                <a onclick="deletePage({{ $page->id }})" 
                                                                    class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                                        class="ri-delete-bin-line"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr><!-- end table-row -->
                                                </tbody><!-- end table-body -->
                                           
                                    @endforeach
                            @endif
                    </table><!-- end table -->
                    {{ $pages->links() }}
                </div>


            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection

@section('customJS')
<script>
    function deletePage(id) {
        
        var url = "{{ route('pages.delete', 'ID') }}"; // 'ID' is just a placeholder
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
                            if (response.status == true) {
                                
                                Swal.fire("Deleted!", response.message, "success");
                                window.location.href="{{ route('pages.index') }}"
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
    @endsection