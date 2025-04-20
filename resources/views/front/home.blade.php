@extends('front.layouts.app')
@section('main-content')

    <!-- slider -->
    <div class="container-fluid">
        <section class="home section image-slider" id="home">
            <div class="home-slider text-center">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"
                        style="background: url('{{ asset('front_assets/img/slider/slide2.jpg') }}');">
                        <h3><span class="hglight">Modern & Trendy</span></h3>
                        <h2 class="home-slider-title-main">with working cart & pay pal</h2>
                        <div class="home-buttons"> <a href="#products" class="btn btn-lg  btn-primary">Shop
                                Now</a> </div>
                        <a class="arrow bounce text-center" href="#about"> <span class="ti-mouse"></span> <span
                                class="ti-angle-double-down"></span> </a>
                    </div>

                    <div class="swiper-slide"
                        style="background: url('{{ asset('front_assets/img/slider/slide1.jpg') }}');">
                        <h1>Sell <span class="hglight">shop</span></h1>
                        <h2 class="home-slider-title-main">52% Discount for this season </h2>
                        <div class="home-buttons text-center"> <a href="#products" class="btn btn-lg  btn-primary">Shop
                                Now</a> </div>
                        <a class="arrow bounce text-center" href="#about"> <span class="ti-mouse"></span> <span
                                class="ti-angle-double-down"></span> </a>
                    </div>
                </div>
                <div class="home-pagination"></div>
                <div class="home-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
                <div class="home-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
            </div>
        </section>
    </div>
    <!--/ slider -->

    <!-- cart section -->

    <!--/ cart section end -->

    <!-- Catalog area -->
    <div class="container-fluid">
        <div class="catalog-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-heading">PRODUCT CATEGORIES</h3>

                    </div>

                    @php $categories = getCategory(); @endphp

                    @if (!empty($categories))
                        @foreach ($categories as $category)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                <div class="add-area">
                                    <a href="#">
                                        <div class="effect-add">
                                            <img class="img-responsive" alt=" "
                                                src="{{ asset('uploads/category/thumb/' . $category->image) }}">
                                            <h2>{{ $category->name }}</h2>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!--/ Catalog area -->

    <!-- products area -->
    <div class="container-fluid">
        <section class="section-min section product" id="products">
            <div class="container overflow-hidden">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-heading">Featured Products</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="product-list-sliderd">
                            <ul class="swiper-wrappers product-list product-list-vertical">
                                @if ($products)

                                    @foreach ($products as $product)
                                        @php
                                            $productImage = $product->product_images->first();

                                        @endphp


                                        <li class="swiper-slidess text-center">
                                            <span class="product-list-left pull-left">
                                                <span class="sale-p">sale</span>
                                                <a href="#" data-target="#product-01" data-toggle="modal">
                                                    @if (!empty($productImage->image))
                                                        <img alt="product image" class="product-list-primary-img"
                                                            src="{{ asset('uploads/product/small/' . $productImage->image) }}">

                                                        <img alt="product image" class="product-list-secondary-img"
                                                            src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                                    @endif
                                                </a>
                                            </span>

                                            <a href="#" data-target="#product-01" data-toggle="modal">
                                                <span class="product-list-right pull-left">
                                                    <span
                                                        class="product-list-name h4 black-color">{{ $product->title }}
                                                    </span>
                                                    <span class="product-list-price">${{ $product->price }}</span>
                                                    <span
                                                        class="product-list-price sell-p"><del>{{ $product->compare_price }}</del></span>
                                                </span>
                                            </a>

                                            <button class="btn btn-default add-item" type="button"
                                                data-image="{{ asset('front_assets/img/p1.jpg') }}"
                                                data-name="Winter Long Sleeve Black White " data-cost="400.00"
                                                data-id="1">
                                                add to cart
                                            </button>
                                        </li>
                                    @endforeach

                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="new-products-area">
                        <div class="col-md-12">
                            <h3 class="section-heading">New Products</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="product-list-slider">
                                <ul class="swiper-wrapper product-list product-list-vertical">

                                    @if ($latestProducts)
                                        @foreach ($latestProducts as $latestProduct)
                                            @php
                                                $latestImage = $latestProduct->product_images->first();
                                            @endphp


                                            <li class="swiper-slide text-center">
                                                <span class="product-list-left pull-left">
                                                    <span class="sale-p">sale</span>
                                                    <a href="#" data-target="#product-01" data-toggle="modal">
                                                        @if (!empty($latestImage->image))
                                                        <img alt="product image" class="product-list-primary-img"
                                                            src="{{ asset('uploads/product/small/' . $latestImage->image) }}">

                                                        <img alt="product image" class="product-list-secondary-img"
                                                            src="{{ asset('uploads/product/small/' . $latestImage->image) }}">
                                                    @endif
                                                       

                                                            
                                                    </a>
                                                </span>

                                                <a href="#" data-target="#product-01" data-toggle="modal">
                                                    <span class="product-list-right pull-left">
                                                        <span
                                                            class="product-list-name h4 black-color">{{ $latestProduct->title }}</span>
                                                        <span
                                                            class="product-list-price">{{ $latestProduct->price }}</span>
                                                        <span
                                                            class="product-list-price sell-p"><del>{{ $latestProduct->compare_price }}</del></span>
                                                    </span>
                                                </a>

                                                <button class="btn btn-default add-item" type="button"
                                                    data-image="img/p1.jpg" data-name="women white backless mini"
                                                    data-cost="400.00" data-id="1">
                                                    add to cart
                                                </button>
                                            </li>
                                        @endforeach
                                    @endif


                                </ul>
                                <!-- Add Pagination -->
                                <div class="product-list-pagination text-center"> </div>
                                <div class="product-list-slider-next right-arrow-negative"> <span
                                        class="ti-arrow-right"></span> </div>
                                <div class="product-list-slider-prev left-arrow-negative"> <span
                                        class="ti-arrow-left"></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRODUCT MODAL -->
            <div class="modal fade product-modal" id="product-01" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content shadow">
                        <a class="close" data-dismiss="modal"> <span class="ti-close"></span></a>
                        <div class="modal-body">
                            <!-- Wrapper for slides -->
                            <div class="carousel slide product-slide" id="product-carousel">
                                <div class="carousel-inner cont-slider">
                                    <div class="item active"> <img alt="" src="img/p7.jpg" title="">
                                    </div>
                                    <div class="item"> <img alt="" src="img/p4.jpg" title=""> </div>
                                    <div class="item"> <img alt="" src="img/p5.jpg" title=""> </div>
                                    <div class="item"> <img alt="" src="img/p2.jpg" title=""> </div>
                                </div>
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li class="active" data-slide-to="0" data-target="#product-carousel"> <img
                                            alt="" src="img/p7.jpg"> </li>
                                    <li class="" data-slide-to="1" data-target="#product-carousel"> <img
                                            alt="" src="img/p4.jpg"> </li>
                                    <li class="" data-slide-to="2" data-target="#product-carousel"> <img
                                            alt="" src="img/p5.jpg"> </li>
                                    <li class="" data-slide-to="3" data-target="#product-carousel"> <img
                                            alt="" src="img/p2.jpg"> </li>
                                </ol>
                            </div>
                            <!-- Wrapper for slides -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-push-2">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h3 class="pull-left nk section-heading">Elegant Formal Party Dress
                                                </h3>
                                            </div>
                                            <div class="col-md-5">
                                                <span class="product-right-section">
                                                    <span>$299.00</span>
                                                    <button class="btn btn-default add-item" type="button"
                                                        data-image="img/p2.jpg" data-name="Elegant Formal Party Dress"
                                                        data-cost="299.00" data-id="8">
                                                        add to cart </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-md-push-2 product-description">
                                        <h4 class="section-heading">Ut enim ad minim veniam</h4>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        </p>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6"> <img src="img/p7.jpg" class="img-responsive"
                                                    alt="product image"> </div>
                                            <div class="col-md-6">
                                                <h4 class="section-heading">Ut enim ad minim veniam</h4>
                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                    ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                    aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.</p>
                                            </div>
                                        </div>
                                        <div class="product-tabs">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tab1">Details</a>
                                                </li>
                                                <li><a data-toggle="tab" href="#tab2">Info tab</a></li>
                                                <li><a data-toggle="tab" href="#tab3">Other info </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab-pane fade in active">
                                                    <h4 class="section-heading">details</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </p>
                                                </div>
                                                <div id="tab2" class="tab-pane fade">
                                                    <h4 class="section-heading">Info tab</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </p>
                                                </div>
                                                <div id="tab3" class="tab-pane fade">
                                                    <h4 class="section-heading">other info</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / PRODUCT MODAL -->
        </section>
    </div>
  
    @endsection