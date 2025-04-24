<!DOCTYPE html>
<html >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title> Bestshop - mini ecommerce shop templates</title>
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="width=device-width" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <link href="{{ asset('front_assets/img/favicon.png') }}" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="{{ asset('front_assets/css/bootstrap-light.css') }}" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('front_assets/css/theme-light.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/style.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/css/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('front_assets/css/ion.rangeSlider.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxvNiWqzLtL6Lzv9DAt5+2rF06exl6dW7A/5ROk7vLhW1l1mpgFdlNcb6lz" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq4BYn9fXc7/q7fq7mLB/c5pJt5r7tnl5jdaJd8gbFsks" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>



</head>

<body>
    

    <div class="container-fluid">
        <nav class="navbar" id="js-nav">

            <div class="navbar-header">


                <a class="navbar-brand" href="#"> <img src="{{ asset('front_assets/img/logo1.jpeg') }}"
                        alt="" /> </a>
            </div>
            <div class="" id="myNavbar">
                <ul class="nav navbar-nav">


                    <li><a href="#contact">My Account</a></li>
                    <li>
                        <form method="post" id="search-form" action="">
                            <input type="text" name="text_search" id="text_search"
                                placeholder="Search  for  products" class="search-input">
                            <button class="btn-search" type="submit"><i class="fas fa-search"></i>
                            </button>
                        </form>

                    </li>
                </ul>


            </div>
            

           
                @php $categories = getCategory(); @endphp

                @if ($categories->count())
                    <nav class="navbar">
                        <div class="container-fluid">
                            <ul class="navbar-nav">
                                @foreach ($categories as $category)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle text-black" href="#"
                                            id="dropdownMenu{{ $category->id }}" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $category->name }}
                                        </a>
                                        @if ($category->sub_category->count())
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $category->id }}">
                                                @foreach ($category->sub_category as $subcategory)
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            {{ $subcategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                @endif
        
    </div>
    <!--/ End header -->


   <main>
    @yield('main-content')
   </main>

    <!-- Footer Section -->
    <div class="section section-min">
        <footer class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="f_logo">
                            <a href="#"><img src="{{ asset('front_assets/img/logo.png') }}"
                                    alt="" /></a>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit best shop for you voluptatem.Sed ut
                                perspiciatis unde omnis iste natus errorsit.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 info_menu">
                        <h4>INFORMATIONS</h4>
                        <ul>
                            <li><a href="#"> Delivery information </a></li>
                            <li><a href="#"> Privacy Policy </a></li>
                            <li><a href="#"> Terms & Conditions </a></li>
                            <li><a href="#"> Return & Exchange </a></li>
                        </ul>
                        <ul>
                            <li><a href="#"> Free Shipping </a></li>
                            <li><a href="#"> Order Status </a></li>
                            <li><a href="#"> Gift Cards</a></li>
                            <li><a href="#"> International</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4  col-sm-12">
                        <div class="footer-newsletter">
                            <div class="center">
                                <h4>stay with us</h4>
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input class="form-control " type="text" placeholder="e-mail">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><span
                                                    class="ti-arrow-right"></span></button>
                                        </span>
                                    </div>
                                </form>
                                <div class="social">
                                    <ul>
                                        <li class="fndus">Find us here:</li>
                                        <li><a href="http://facebook.com/" target="_blank"><span
                                                    class="ti-facebook"></span></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><span
                                                    class="ti-twitter-alt"></span></a></li>
                                        <li><a href="http://linkedin.com/" target="_blank"><span
                                                    class="ti-linkedin"></span></a></li>
                                        <li><a href="https://vimeo.com/" target="_blank"><span
                                                    class="ti-vimeo-alt"></span></a></li>
                                        <li><a href="http://youtube.com/" target="_blank"><span
                                                    class="ti-youtube"></span></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="clearfix col-md-12 col-sm-12">
                        <hr>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="footer-copyright">
                            <p>© 2022 Bestshop - All Rights Reserved.</p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

    </div>
    <!-- jQuery (must come first) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="{{ asset('front_assets/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    {{-- <script src="{{ asset('front_assets/js/vendor/swiper.min.js') }}"></script> --}}
    <script src="{{ asset('front_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery.inview.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery.countdown.js') }}"></script>
    <script src="{{ asset('front_assets/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('front_assets/js/plugins.js') }}"></script>
    <script src="{{ asset('front_assets/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@yield('customJS')
<!-- Mirrored from team90degree.com/html/tf/bestshop-new-demo/bestshop-demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Apr 2025 03:08:07 GMT -->
</body>
</html>
