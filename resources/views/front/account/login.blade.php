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
                            <form method="post" action="{{ route('account.authenticate') }}">
                                @csrf
                                <h2 class="text-center">Login to your Account</h2>
                               
                            
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" 
                                        
                                     name="email" id="email" value="{{ old('email') }}" placeholder="example@gmail.com" name="email">
                                    @error('email')
                                  <p class="invalid-feedback">  {{ $message }} </p>
                                        
                                    @enderror
                                  
                                </div>
                               
                            
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control @error('password') is-invalid @enderror"  type="password" name="password" id="password" placeholder="password">
                                        @error('password')
                                        <p class="invalid-feedback">  {{ $message }} </p>
                                              
                                          @enderror
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
            <div class="pt-2 justify-content-center" style="margin-left: auto; margin-right: auto;">
                <p class="mb-0">Do not have an account? <a href="{{ route('account.register') }}">Sign Up</a></p>
                

           
              
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
  
    </script>
    @endsection
