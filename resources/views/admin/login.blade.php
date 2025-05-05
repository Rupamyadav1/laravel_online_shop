<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from larathemes.pixelstrap.com/edmin/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Mar 2025 04:42:09 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta name="csrf-token" content="75VFgswPaJFFxUjqqs8Vk2Sfg9U1Q69K71wBlbf4">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Edmin admin is super flexible, powerful, clean &amp; modern responsive bootstrap admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Edmin admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Edmin - Premium Admin Template</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

   
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify-icons/themify-icons/css/themify.css')}}">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css/animate.css')}}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/weather-icons/css/weather-icons.min.css')}}">

    
    <!-- App css-->
    <link rel="preload" as="style" href="{{asset('build/assets/style-BQ9xLEwC.css')}}" /><link rel="stylesheet" href="{{asset('build/assets/style-BQ9xLEwC.css')}}" data-navigate-track="reload" />
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
</head>

<body>
   

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div><a class="logo" href="login.html"><img class="img-fluid for-light"
                                    src="{{asset('assets/images/logo/logo.png')}}" alt="looginpage"><img
                                    class="img-fluid for-dark m-auto" src="{{asset('assets/images/logo/dark-logo.png')}}"
                                    alt="logo"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('admin.authenticate') }}">
                                @csrf
                                <h2 class="text-center">Sign in to account</h2>
                                <p class="text-center">Enter your email &amp; password to login</p>
                            
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ ('example@gmail.com') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control @error('password') is-invalid @enderror"  type="password" name="password" value={{ ('mypassword123') }}>
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                    @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
                                </div>
                            
                                <div class="form-group mb-0 checkbox-checked">
                                    <a class="form-check checkbox-solid-info" href="password/reset.html">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100 text-white" type="submit">Sign in</button>
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
    <!-- page-wrapper end-->

    <!-- jquery-->
<script src="{{asset('assets/js/vendors/jquery/dist/jquery.min.js')}}"></script>

<!-- bootstrap js-->
<script src="{{asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>

    <script src="{{asset('assets/js/password.js')}}"></script>

<!-- custom script -->
<script src="{{asset('assets/js/script.js')}}"></script></body>

<!-- Mirrored from larathemes.pixelstrap.com/edmin/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Mar 2025 04:42:14 GMT -->
</html>
