@extends('front.layouts.app')
@section('main-content')

   
    <!-- slider -->
    <section>
        <div class="container-fluid">
            <section class="home section image-slider" id="home">
                <div class="home-slider text-center">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"
                            style="background: url('{{ asset('front_assets/img/slider/slide2.jpg') }}');">
                            <h3><span class="hglight">Modern & Trendy</span></h3>
                            <h2 class="home-slider-title-main">with working cart & pay pal</h2>
                            <div class="home-buttons"> <a href="{{ route('front.shop') }}"
                                    class="btn btn-lg  btn-primary">Shop
                                    Now</a> </div>
                            <a class="arrow bounce text-center" href="#about"> <span class="ti-mouse"></span> <span
                                    class="ti-angle-double-down"></span> </a>
                        </div>

                        <div class="swiper-slide"
                            style="background: url('{{ asset('front_assets/img/slider/slide1.jpg') }}');">
                            <h1>Best <span class="hglight">shop</span></h1>
                            <div class="home-buttons text-center"> <a href="{{ route('front.shop') }}"
                                    class="btn btn-lg  btn-primary">Shop
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
    </section>
    <!--/ slider -->



    <!-- Catalog area -->
    <section>

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
                                        <img style="height:200px; width:300px;" class="img-responsive" alt=" "
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

    </section>
    <!--/ Catalog area -->

    <!-- products area -->

    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Featured Products</h3>
                </div>

                @if ($products)
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    @php $productImage = $product->product_images->first(); @endphp
                                    @if (!empty($productImage->image))
                                        <a onclick="addToWishList({{ $product->id }})" class="whishlist"
                                            href="javascript:void(0);">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                            <img alt="product image" class="card-img-top"
                                                src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                        </a>
                                    @endif
                                    <div class="product-action">
                                        @if ($product->track_qty == 'Yes' && $product->qty <= 0)
                                            <button class="btn btn-secondary" disabled>Out of Stock</button>
                                        @else
                                            <button class="btn btn-primary add-item" type="button"
                                                onclick="addToCart({{ $product->id }})">
                                                Add to Cart
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="card-text">${{ $product->price }} <del>{{ $product->compare_price }}</del>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>


        </div>
    </section>


    <section>
        <div class="container pb-5">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="section-heading">New Products</h3>
                </div>


                @if ($latestProducts)
                    @foreach ($latestProducts as $latestProduct)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    @php
                                        $latestImage = $latestProduct->product_images->first();
                                    @endphp





                                    @if (!empty($latestImage->image))
                                        <a onclick="addToWishList({{ $latestProduct->id }})" class="whishlist"
                                            href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                        <a href="{{ route('front.product', $latestProduct->slug) }}" class="product-img">



                                            <img alt="product image" class="card-img-top"
                                                src="{{ asset('uploads/product/small/' . $latestImage->image) }}">
                                        </a>
                                    @endif

                                    <div class="product-action">
                                        @if ($latestProduct->track_qty == 'Yes' && $latestProduct->qty <= 0)
                                            <button class="btn btn-secondary" disabled>Out of Stock</button>
                                        @else
                                            <button class="btn btn-primary add-item" type="button"
                                                onclick="addToCart({{ $latestProduct->id }})">
                                                Add to Cart
                                            </button>
                                        @endif
                                    </div>





                                </div>


                                <div class="card-body">
                                    <span class="card-title">{{ $latestProduct->title }}</span>

                                    <p class="card-text">{{ $latestProduct->price }}
                                        <del>{{ $latestProduct->compare_price }}</del>
                                    </p>
                                </div>
                            </div>

                            </div>
                    @endforeach
                @endif
            </div>






    </section>



    </section>
    </div>
@endsection
