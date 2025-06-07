@extends('admin.layouts.app')

@section('main-content')
    <div class="col-md-12">
        @include('front.account.common.message');
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h2 class=" mb-0 pt-2 pb-2">Change Password</h2>
            </div>
            <form method="post" id="changePasswordForm" name="changePasswordForm">

                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3">
                                <label for="name">Old Password</label>
                                <input type="password" name="old_password" id="old_password" placeholder="Old Password"
                                    class="form-control">
                                <p class="text-danger" id="old-errror"></p>
                            </div>
                            <div class="mb-3">
                                <label for="name">New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="New Password"
                                    class="form-control">
                                <p class="text-danger" id="new-error"></p>
                            </div>
                            <div class="mb-3">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    placeholder="Confirm Password" class="form-control">
                                <p class="text-danger" id="confirm-error"></p>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-add-circle-line me-1"></i>
                                    Save
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('customJS')
    <script>
        $("#changePasswordForm").submit(function(event) {
            event.preventDefault();
            
            $("button[type=submit]").prop("disabled", true);

            $.ajax({
                url: '{{ route('admin.processChangePassword') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        
                        window.location.href = "{{ route('admin.changePassword') }}";
                    } else {
                        var errors = response.errors;

                        if (errors.old_password) {
                            $('#old_password').addClass('is-invalid');
                            $('#old-errror').html(errors.old_password);
                        } else {
                            $('#old_password').removeClass('is-invalid');
                            $('#old-errror').html('');
                        }

                        if (errors.new_password) {
                            $('#new_password').addClass('is-invalid');
                            $('#new-error').html(errors.new_password);
                        } else {
                            $('#new_password').removeClass('is-invalid');
                            $('#new-error').html('');
                        }

                        if (errors.confirm_password) {
                            $('#confirm_password').addClass('is-invalid');
                            $('#confirm-error').html(errors.confirm_password);
                        } else {
                            $('#confirm_password').removeClass('is-invalid');
                            $('#confirm-error').html('');
                        }
                    }

                    $("button[type=submit]").prop("disabled", false);
                },
                error: function(jqXHR, exception) {
                    console.log("Something went wrong:", jqXHR.responseText);
                    $("button[type=submit]").prop("disabled", false);
                }
            });
        });
    </script>
@endsection
