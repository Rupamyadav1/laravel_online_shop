@extends('front.layouts.app')
@section('main-content')
<!DOCTYPE html>
<html lang="en">


<body class="pt-3">
 
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <div class="container-fluid p-3 pt-3">
        <div class="row " >
            
            <div class="col-lg-5 " style="margin-left: auto; margin-right: auto;">
                <div class="card">
                    <div class="card-body">
                <div class="login-card login-dark">
                    <div>
                       
                        <div class="login-main">
                            <form method="post" id="registrationForm">
                                @csrf
                                <h2 class="text-center">Register Now</h2>
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control"  type="text" name="name" id="name" placeholder="name">
                                    <p></p>
                                    
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="example@gmail.com">
                                    <p></p>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" placeholder="phone">
                                    <p></p>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control"  type="password" name="password" id="password" placeholder="password">
                                        <p></p>
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control"  type="password" name="password_confirmation" id="password_confirmation" placeholder="password">
                                        <p></p>
                                    </div>
                                    
                                </div>
                            
                                <div class="form-group mb-0 checkbox-checked">
                                    <a class="form-check checkbox-solid-info" href="password/reset.html">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100 text-white" type="submit">Register</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2 justify-content-center" style="margin-left: auto; margin-right: auto;">
                <p class="mb-0">Already have an account? <a href="{{ route('account.login') }}">Login</a></p>
                

           
              
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
       // $("button[type='submit']").prop('disable',true);
        $.ajax({
            url:"{{ route('account.processRegister') }}",
            type:'post',
            data: $(this).serializeArray(),
            dataType:'json',
            success:function(response){
               // $("button[type='submit']").prop('disable',false);
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
                else {
                    $("#name").siblings('p').removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');

                    $("#email").siblings('p').removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');

                    $("#password").siblings('p').removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');


                    window.location.href="{{ route('account.login') }}"

                }



            },
            error:function(JQXHR,execption){
                console.log("something went wrong");

            }
        })
    });
    </script>
    @endsection