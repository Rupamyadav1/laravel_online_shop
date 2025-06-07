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
                                            <form method="post" action="{{ route('front.processForgetPassword') }}">
                                                @csrf
                                                <h2 class="text-center">Change Password</h2>


                                                <div class="form-group">
                                                    <label class="col-form-label">Email</label>
                                                    <input
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        
                        
                                                        type="email" name="email" id="email"
                                                        placeholder="example@gmail.com" name="email">
                                                    @error('email')
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
                            <a href="{{ route('account.login') }}">Login</a>
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
