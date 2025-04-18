<!DOCTYPE html>
<html lang="zxx">


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <nav class="navbar navbar-fixed-top shadow" id="js-nav">

            <div class="navbar-header">
                <button class="navbar-toggle" data-target="#myNavbar" data-toggle="collapse" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#"> <img src="{{ asset('front_assets/img/logo1.jpeg') }}"
                        alt="" /> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
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
                <nav class="navbar navbar-expand-lg navbar-dark bg-black">
                    <div class="container-fluid">
                        <ul class="navbar-nav">
                            @foreach ($categories as $category)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#"
                                        id="dropdownMenu{{ $category->id }}" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
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



    </div>
    </nav>
    </div>
    <!--/ End header -->



    <!-- slider -->
    <section class="home section image-slider" id="home">
        <div class="home-slider text-center">
            <div class="swiper-wrapper">
                <div class="swiper-slide"
                    style="background: url('{{ asset('front_assets/img/slider/slide2.jpg') }}');">
                    <h3><span class="hglight">Modern & Trendy</span></h3>
                    <h2 class="home-slider-title-main">with working cart & pay pal</h2>
                    <div class="home-buttons text-center"> <a href="#products" class="btn btn-lg  btn-primary">Shop
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
    <!--/ slider -->

    <!-- cart section -->
    <span id="items-counter" class="h3 cart-items-counter" style="display: none">0</span>
    <div class="cart-widget-container">
        <div class="cart-widget text-center">
            <a class="close" id="cart-widget-close">
                <span class="ti-close"></span>
            </a>
            <h1>Best<span class="hglight">shop</span></h1>
            <h3 class="section-heading">Your cart</h3>
            <div id="cart-empty" class="cart-empty">
                <h4>is empty <span class="ti-face-sad icon"></span> </h4>
            </div>
            <!-- container for js inject cart items content -->
            <div class="items-container" id="items"></div>
            <!-- container for js inject cart items content -->

            <div class="cart-delivery" id="cart-delivery">
                <h4 class="section-heading">Delivery option</h4>
                <div class="custom-radio">
                    <input id="radio1" type="radio" name="delivery" value="10.00" checked>
                    <label for="radio1">domestic delivery ($10)</label>
                </div>

                <div class="custom-radio">
                    <input id="radio2" type="radio" name="delivery" value="15.00">
                    <label for="radio2">express domestic delivery ($15) </label>
                </div>

                <div class="custom-radio">
                    <input id="radio3" type="radio" name="delivery" value="20.00">
                    <label for="radio3">worldwide delivery ($20)</label>
                </div>
            </div>
            <div class="cart-summary" id="cart-summary">
                <h4 class="section-heading">summary</h4>
                <div class="cart-summary-row" id="cart-total">Total products <span class="cart-value">$<span
                            id="cost_value">0.00</span></span></div>
                <div class="cart-summary-row">Shipping <span class="cart-value">$<span
                            id="cost_delivery"></span></span></div>
                <div class="cart-summary-row cart-summary-row-total">Total <span class="cart-value">$<span
                            id="total-total"></span></span></div>
            </div>

            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="cart-form" id="cart-form">
                <!-- Identify your business so that you can collect the payments. -->
                <input type="hidden" name="business" value="yourpaypal@email.com">
                <!-- Specify a Buy Now button. -->
                <input type="hidden" name="cmd" value="_xclick">
                <!-- Specify details about the item that buyers will purchase. -->
                <input type="hidden" name="item_name" value="Bestshop shop - checkout">
                <input type="hidden" name="amount" id="amount" value="">
                <input type="hidden" name="currency_code" value="USD">
                <!-- Display the payment button. -->
                <button type="submit" name="submit" class="btn btn-default btn-lg">
                    pay pal checkout <span class="ti-arrow-right"></span>
                </button>
            </form>
        </div>
        <div class="cart-widget-close-overlay"></div>
    </div>
    <!--/ cart section end -->

    <!-- Catalog area -->
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
                                            src="{{ asset('uploads/category/thumb/' . $category->image) }}"
                                            style="width: 500px; height: 200px;">
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
    <!--/ Catalog area -->

    <!-- products area -->
    <section class="section-min section product" id="products">
		<div class="container overflow-hidden">
			<div class="row">
				<div class="col-md-12">
					<h3 class="section-heading">Featured Products</h3>
				</div>
				<div class="col-md-12">
					<div class="product-list-sliderd">
						<ul class="swiper-wrappers product-list product-list-vertical">
                            @if($products)

                            @foreach($products as $product)

                            @php
                            $productImage=$product->product_images->first();
                            
                            @endphp
                                
                           
							<li class="swiper-slidess text-center"> 
								<span class="product-list-left pull-left">
							    	<span class="sale-p">sale</span>
									<a href="#" data-target="#product-01" data-toggle="modal">
                                        @if(!empty($productImage->image))
                                        <img alt="product image" class="product-list-primary-img" src="{{ asset('uploads/product/small/'.$productImage->image) }}"> 
                                        
									<img alt="product image" class="product-list-secondary-img" src="{{ asset('uploads/product/small/'.$productImage->image) }}">
                                    @endif
									</a>
								</span> 

								<a href="#" data-target="#product-01" data-toggle="modal">
									<span class="product-list-right pull-left">
										<span class="product-list-name h4 black-color">{{ $product->title }} </span>
										<span class="product-list-price">${{ $product->price }}</span>
										<span class="product-list-price sell-p"><del>{{$product->compare_price}}</del></span>
									</span>
								</a> 

								<button class="btn btn-default add-item" type="button" data-image="{{ asset('front_assets/img/p1.jpg')}}" data-name="Winter Long Sleeve Black White " data-cost="400.00" data-id="1" >
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
                               
                               @if($latestProducts)
                               @foreach ($latestProducts as $latestProduct)
                               @php
                                   $latestProduct->product_images->first();
                               @endphp 
                                   
                               
								<li class="swiper-slide text-center"> 
									<span class="product-list-left pull-left">
										<span class="sale-p">sale</span>
										<a href="#" data-target="#product-01" data-toggle="modal"><img alt="product image" class="product-list-primary-img" src="{{ asset('uploads/product/small/'.$latestProduct->image) }}"> 
										<img alt="product image" class="product-list-secondary-img" src="{{ asset('uploads/product/small/'.$latestProduct->image) }}">
										</a>
									</span> 

									<a href="#" data-target="#product-01" data-toggle="modal">
										<span class="product-list-right pull-left">
											<span class="product-list-name h4 black-color">{{ $latestProduct->title }}</span>
											<span class="product-list-price">{{ $latestProduct->price }}</span>
											<span class="product-list-price sell-p"><del>$580.00</del></span>
										</span>
									</a> 

									<button class="btn btn-default add-item" type="button" data-image="img/p1.jpg" data-name="women white backless mini" data-cost="400.00" data-id="1" >
										add to cart
									</button> 		
								</li>
                                @endforeach
                                @endif
								
								
							</ul>
							<!-- Add Pagination -->
							<div class="product-list-pagination text-center"> </div>
							<div class="product-list-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
							<div class="product-list-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
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
								<div class="item active"> <img alt="" src="img/p7.jpg" title=""> </div>
								<div class="item"> <img alt="" src="img/p4.jpg" title=""> </div>
								<div class="item"> <img alt="" src="img/p5.jpg" title=""> </div>
								<div class="item"> <img alt="" src="img/p2.jpg" title=""> </div>
							</div>
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li class="active" data-slide-to="0" data-target="#product-carousel"> <img alt="" src="img/p7.jpg"> </li>
								<li class="" data-slide-to="1" data-target="#product-carousel"> <img alt="" src="img/p4.jpg"> </li>
								<li class="" data-slide-to="2" data-target="#product-carousel"> <img alt="" src="img/p5.jpg"> </li>
								<li class="" data-slide-to="3" data-target="#product-carousel"> <img alt="" src="img/p2.jpg"> </li>
							</ol>
						</div>
						<!-- Wrapper for slides -->
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-push-2">
									<div class="row">
										<div class="col-md-7">
											<h3 class="pull-left nk section-heading">Elegant Formal Party Dress</h3>
										</div>
										<div class="col-md-5">
											<span class="product-right-section">
												<span>$299.00</span>
												<button class="btn btn-default add-item" type="button" data-image="img/p2.jpg" data-name="Elegant Formal Party Dress" data-cost="299.00" data-id="8">
												add to cart </button>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-8 col-md-push-2 product-description">
									<h4 class="section-heading">Ut enim ad minim veniam</h4>
									<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p>
									<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p>
									<div class="row">
										<div class="col-md-6"> <img src="img/p7.jpg" class="img-responsive" alt="product image"> </div>
										<div class="col-md-6">
											<h4 class="section-heading">Ut enim ad minim veniam</h4>
											<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
									<div class="product-tabs">
										<ul class="nav nav-tabs">
											<li class="active"><a data-toggle="tab" href="#tab1">Details</a></li>
											<li><a data-toggle="tab" href="#tab2">Info tab</a></li>
											<li><a data-toggle="tab" href="#tab3">Other info </a></li>
										</ul>
										<div class="tab-content">
											<div id="tab1" class="tab-pane fade in active">
												<h4 class="section-heading">details</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											</div>
											<div id="tab2" class="tab-pane fade">
												<h4 class="section-heading">Info tab</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
											</div>
											<div id="tab3" class="tab-pane fade">
												<h4 class="section-heading">other info</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
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
    <!--/ products area end -->

    <!-- About area -->
    <section class="about white-color" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Why should customers choose</h4>
                    <h2> <span>our</span> products</h2>
                    <p>Lorem ipsum dolor sit amet eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitatio ex eatikre commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatuor.
                        Excepteur sint occaecat cupidataproident, sunt in culpa qui officiad est laboincididunt ut
                        labore et dolore magna aliqua. eiusmeiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="read-more-btn">
                        <a href="#">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ About area end-->

    <!-- Special area -->
    <section class="countdown" id="special">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Summer Sale</h3>
                </div>
                <div class="col-md-7">
                    <div class="countdown-container">
                        <h3>Sexy Women Floral Embroidery</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. </p>
                        <!-- data in countdown ul from js -->
                        <ul id="countdown" class="countdown-counter"></ul>
                        <!-- data in countdown ul from js --><span class="countdown-price h3">$420.00
                            <del>$670.00</del></span>
                        <button class="btn btn-default add-item" type="button"
                            data-image="{{ asset('front_assets/img/p7.jpg') }}"
                            data-name="Sexy Women Floral Embroidery" data-cost="420.00" data-id="9">
                            add to cart
                        </button>
                    </div>
                </div>
                <div class="col-md-5">
                    <ul class="product-list product-list-vertical">
                        <li>
                            <span class="product-list-left pull-left">
                                <span class="sale-p">sale</span>
                                <a href="#" data-target="#product-01" data-toggle="modal">
                                    <img alt="product image" class="product-list-primary-img"
                                        src="{{ asset('front_assets/img/p7.jpg') }}">
                                    <img alt="product image" class="product-list-secondary-img"
                                        src="{{ asset('front_assets/img/p9.jpg') }}">
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--/ Special area end-->

    <!-- Testimonials area -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Testimonials</h3>
                </div>
                <div class="testimonials-slider text-center col-md-12">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar"
                                    src="{{ asset('front_assets/img/user.png') }}">
                                <h3> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar"
                                    src="{{ asset('front_assets/img/user2.png') }}">
                                <h3> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar"
                                    src="{{ asset('front_assets/img/user.png') }}">
                                <h3> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonials-pagination"></div>
                    <div class="testimonials-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span>
                    </div>
                    <div class="testimonials-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Testimonials area end -->

    <!-- Add area -->
    <div class="p-badd">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="add-area">
                        <a href="#">
                            <div class="effect-add">
                                <img class="img-responsive" alt=" "
                                    src="{{ asset('front_assets/img/add4.png') }}">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add area end-->

    <!-- counter section -->
    <section class="text-center shadow section section-min">
        <div class="about-counter" id="about-counter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-3 cnt1 about-counter-single">
                        <div class="counter"> <span class="fa fa-truck icon"></span>
                            <h2>FREE SHIPPING</h2>
                            <p>Shipping in World for orders over $99</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 cnt2 about-counter-single">
                        <div class="counter"> <span class="ti-gift icon"></span>
                            <h2>SPECIAL GIFT</h2>
                            <p> Give the perfect gift to your loved ones</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 cnt3 about-counter-single">
                        <div class="counter"> <span class="fa fa-money icon"></span>
                            <h2>MONEY BACK</h2>
                            <p>Not receiving an item applied to reward </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 cnt4 about-counter-single">
                        <div class="counter"> <span class="ti-headphone-alt icon"></span>
                            <h2>Support 24/7</h2>
                            <p> We are wait for you in 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ counter section end-->

    <!-- contact section  -->
    <section id="contact" class="contact contact-with-map">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Get in Touch</h3>
                </div>
                <div class="col-md-3">
                    <div class="contact-data">
                        <h4>United States</h4>
                        <ul>
                            <li><span class="ti-mobile icon"></span>+ 123 456 7890</li>
                            <li><span class="ti-email icon"></span>admin@Bestshop</li>
                            <li><span class="ti-map-alt icon"></span>201 Oak Street Building 27 <br> Manchester, USA
                            </li>
                        </ul>
                    </div>
                    <div class="contact-data">
                        <h4>Australia</h4>
                        <ul>
                            <li><span class="ti-mobile icon"></span>+ 123 456 7890</li>
                            <li><span class="ti-map-alt icon"></span>201 Oak Street Building 27 <br> Manchester, USA
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-md-push-1">
                    <div class="contact-form">
                        <form class="contact-forms" id="contact-form"
                            action="https://team90degree.com/html/tf/bestshop-new-demo/bestshop-demo/mail.php"
                            method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" cols="10" rows="7" placeholder="Message"></textarea>
                            </div>
                            <button type="submit"
                                class="btn btn-round btn-g btn btn-primary btn-lg text-center float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Message -->
        <div class="cr-contact-message-modal">
            <p class="form-messege"></p>
        </div>
        <!--// Form Message -->
        <!-- contact-map -->
        <div id="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96811.54759587669!2d-74.01263924803828!3d40.6880494567041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae694479a3%3A0xb9949385da52e69e!2sBarclays%20Center!5e0!3m2!1sen!2sbd!4v1636195194646!5m2!1sen!2sbd"
                allowfullscreen loading="lazy"></iframe>
        </div>
        <!-- contact-map-end -->

    </section>
    <!--/ contact section  end-->

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

    <script src="{{ asset('front_assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/swiper.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery.inview.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery.countdown.js') }}"></script>
    <script src="{{ asset('front_assets/js/tt-cart.js') }}"></script>
    <script src="{{ asset('front_assets/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('front_assets/js/contact.js') }}"></script>
    <script src="{{ asset('front_assets/js/plugins.js') }}"></script>
    <script src="{{ asset('front_assets/js/main.js') }}"></script>
</body>


<!-- Mirrored from team90degree.com/html/tf/bestshop-new-demo/bestshop-demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Apr 2025 03:08:07 GMT -->

</html>
