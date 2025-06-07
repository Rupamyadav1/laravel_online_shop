@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card position-relative">
                <form id="usersForm" method="post">
                    <div class="card-body">
                        <!-- Invoice Logo-->


                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Name :</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name"
                                        placeholder="Enter Name" style="width:49%">
                                    <p class="text-danger" id="name-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Email :</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email"
                                        placeholder="Enter Email">
                                    <p class="text-danger" id="email-error"></p>

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Password :</label>
                                    <input type="text"  name="password" id="password" class="form-control"
                                        placeholder="Enter Password">
                                        <span>to change Password to have to enter value otherwise leave blank</span>
                                    <p class="text-danger" id="password-error"></p>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Phone :</label>
                                    <input type="text" value="{{ $user->phone }}" name="phone" id="phone" class="form-control"
                                        placeholder="Enter Phone">
                                    <p class="text-danger" id="phone-error"></p>




                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Status :</label>
                                    <select class="form-control" id="user_status" name="user_status">
                                        
                                        <option  value="1" {{ $user->status == '1' ?'selected':'' }}>Active</option>
                                        <option value="0" {{ $user->status == '0' ?'selected':'' }}>Block</option>

                                    </select>



                                </div>
                            </div>

                        </div>


                        <div class="p-2">
                            <button type="submit" type="submit" class="btn btn-primary">
                                <i class="ri-add-circle-line me-1"></i>
                                Edit User
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
        $("#usersForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop("disable", true);
            $.ajax({

                url: '{{ route('users.update',$user->id) }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == true){
                        window.location.href="{{ route('users.index') }}";
                        
                    }
                     
                    $("button[type=submit]").prop("disable", false);

                    if (response['status'] == true) {

                        $('#name').removeClass('is-invalid');
                        $('#name-error').html('');

                        $('#email').removeClass('is-invalid');
                        $('#email-error').html('');

                        $('#password').removeClass('is-invalid');
                        $('#password-error').html('');

                        $('#phone').removeClass('is-invalid');
                        $('#phone-error').html('');

                    } else {
                        var errors = response["errors"];
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid');
                            $('#name-error').html('');
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid');
                            $('#email-error').html(errors.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#email-error').html('');
                        }

                        if (errors.password) {
                            $('#password').addClass('is-invalid');
                            $('#password-error').html(errors.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('#password-error').html('');
                        }

                        if (errors.phone) {
                            $('#pone').addClass('is-invalid');
                            $('#phone-error').html(errors.phone);
                        } else {
                            $('#phone').removeClass('is-invalid');
                            $('#phone-error').html('');
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
