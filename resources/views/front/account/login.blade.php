@extends('front.layouts.app')
@section('main-content')
<!DOCTYPE html>
<html lang="en">


<body class="pt-3">
 
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <div class="container-fluid p-3 pt-3">
        <div class="row " >
            <div class="col-lg-5 " style="margin-left: auto; margin-right: auto;">
                

                    @if (Session::get('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {!! Session::get('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                <div class="login-card login-dark">
                    <div>
                       
                        <div class="login-main">
                            <form method="post" id="registrationForm">
                                @csrf
                                <h2 class="text-center">Login to your Account</h2>
                               
                            
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="example@gmail.com">
                                    <p></p>
                                </div>
                               
                            
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control"  type="password" name="password" id="password" placeholder="password">
                                        <p></p>
                                    </div>
                                   
                                </div>
                                
                            
                                <div class="form-group mb-0 checkbox-checked">
                                    <a class="form-check checkbox-solid-info" href="password/reset.html">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100 text-white" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
   
</html>

@endsection

@section('customJS')
<script type="text/javascript">
    $('#registrationForm').submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('account.processRegister') }}",
            type:'post',
            data: $(this).serializeArray(),
            dataType:'json',
            success:function(response){
                var errors=response.errors;

                if(response.status == false){
                    if(errors.name){
                    $("#name").siblings('p').addClass('invalid-feedback').html(errors.name);
                    $("#name").addClass('is-invalid')
                }else{
                    $("#name").siblings('p').removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');
                }

                if(errors.email){
                    $("#email").siblings('p').addClass('invalid-feedback').html(errors.email);
                    $("#email").addClass('is-invalid')
                }else{
                    $("#email").siblings('p').removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');
                }

                if(errors.password){
                    $("#password").siblings('p').addClass('invalid-feedback').html(errors.password);
                    $("#password").addClass('is-invalid')
                }else{
                    $("#password").siblings('p').removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');
                }
                }
                else{
                    $("#name").siblings('p').removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');

                    $("#email").siblings('p').removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');

                    $("#password").siblings('p').removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');

                }



            },
            error:function(JQXHR,execption){
                console.log("something went wrong");

            }
        })
    });


    </script>
    @endsection
