@extends('front.layouts.app')
@section('main-content')
    <!DOCTYPE html>
    <html lang="en">


    <body class="pt-3">

        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <div class="container-fluid p-3 pt-3">
                <div class="row ">
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
                                            <form method="post" action="{{ route('front.processResetPassword') }}">
                                                @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">
                                                <h2 class="text-center">Reset Password</h2>


                                                <div class="form-group">
                                                    <input
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        
                        
                                                        type="password" name="new_password" id="new_password"
                                                        placeholder="New Password" >
                                                    @error('new_password')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                    @enderror


                                                </div>

                                                <div class="form-group pt-2">
                                                    <input
                                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                                        
                        
                                                        type="password" name="confirm_password" id="confirm_password"
                                                        placeholder="Confirm Password" >
                                                    @error('confirm_password')
                                                        <p class="invalid-feedback">{{ $message }}</p>
                                                    @enderror


                                                </div>





                                                <div class="form-group mb-0 checkbox-checked">
                                                    <div class=" mt-3">
                                                        <input class="btn btn-dark  btn-lg text-white"
                                                            style="background-color: #02c0ce;" type="submit"
                                                            value="Submit">
                                                    </div>
                                                </div>
                                            </form>


                                        </div>

                                    </div>

                                </div>


                            </div>


                        </div>
                        <div class=" pt-2 text-center small">
                            <a href="{{ route('account.login') }}">Click Here To Login</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </html>
@endsection

@section('customJS')
    <script type="text/javascript"></script>
@endsection
