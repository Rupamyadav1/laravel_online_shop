@extends('front.layouts.app')
@section('main-content')

 <head>
    <style>
         .product-card .whishlist {
                position: absolute;
                top: 10px;
                right: 15px;
                opacity: 0;
                transition: opacity 0.3s ease;
                color: #02c0ce;
                /* Heart color */
                font-size: 30px;
                z-index: 10;
            }

            /* Show wishlist icon on hover */
            .product-card:hover .whishlist {
                opacity: 1;
            }

            .product-card .product-action {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 9;
            }

            /* Show button on hover of image */
            .product-card .product-image:hover .product-action {
                opacity: 1;
            }

            /* Make sure product image container is relatively positioned */
            .product-card .product-image {
                position: relative;
            }
        </style>
</head>
    <main>

        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar mt-5">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if (!empty($categories))
                                    @foreach ($categories as $key => $category)
                                        <div class="accordion-item">
                                            @if ($category->sub_category->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne-{{ $key }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne-{{ $key }}"
                                                        aria-controls="collapseOne-{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                            @else
                                                <a style="text-decoration: none; color: #212529; padding-left:13px;font-size:1.5rem;"
                                                    href="{{ route('front.shop', $category->slug) }}"
                                                    class="nav-item nav-link d-block">{{ $category->name }}</a>
                                            @endif


                                            @if (!empty($category->sub_category))
                                                <div id="collapseOne-{{ $key }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="headingOne-{{ $key }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @foreach ($category->sub_category as $sub_category)
                                                                <a href="{{ route('front.shop', [$category->slug, $sub_category->slug]) }}"
                                                                    class="nav-item nav-link d-block">{{ $sub_category->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if ($brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input brand-label"
                                            {{ in_array($brand->id, $brandArray) ? 'checked' : '' }} type="checkbox"
                                            value="{{ $brand->id }}" id="flexCheckDefault" name="brand[]"
                                            id="brand-{{ $brand->id }}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $brand->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="">

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                <select name="sort" id="sort" class="form-select me-2">
                                    <option selected>sorting</option>
                                    <option value="latest">latest order</option>
                                    <option value="price_desc">price high</option>
                                    <option value="price_asc">price low</option>

                                </select>
                            </div>
                            </div>
                        </div>
                        @if ($products)
                            @foreach ($products as $product)
                              
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                              @php
                                    $productImage = $product->product_images->first();

                                @endphp

                                            @if (!empty($productImage->image))
                                             <a onclick="addToWishList({{ $product->id }})"
                                                                    class="whishlist" href="javascript:void(0);"><i
                                                                        class="far fa-heart"></i></a>
                                              
                                                <a href="{{ route('front.product',$product->slug) }}" class="product-img">
                                                    <img class="card-img-top"
                                                        src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                        alt="product image"></a>
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
                                            <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>{{ $product->price }}</strong></span>
                                                <span
                                                    class="h6 text-underline"><del>{{ $product->compare_price }}</del></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                           
                        @endif
                        <div class="col md-12 scroll-pt-5">
                            {{ $products->links() }}
                        </div>



                    </div>
                    
                </div>
               
            </div>
        </div>
    </main>
@endsection


@section('customJS')
<script src="{{ asset('front_assets/js/ion.rangeSlider.min.js')}}"></script>


        <script>



     rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: {{ $priceMin }},
        step: 10,
        to: {{ $priceMax }},
       
        skin: "round",
        max_postfix: "+",
        prefix: "₹ ",
        onFinish: function(){
            apply_filters(); //jab slider ko stop krenge tab ye function chalega
           
            
        }
    });

    // Access the slider data after initialization
   

$("#sort").change(function() {
    apply_filters();
})

var slider = $(".js-range-slider").data("ionRangeSlider");


   



        $(".brand-label").change(function() {
            apply_filters();

        })

        function apply_filters() {
            var brands = [];
            $(".brand-label").each(function() {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            })
            console.log(brands.toString());
            var url = "{{ url()->current() }}?";
            var keyword=$("#search").val();
            if(keyword.length > 0){
                url+= "&search=" +keyword;
            }

           
            url+= "&price_min=" + slider.result.from + "&price_max=" + slider.result.to;

            url+= "&sort=" + $("#sort").val();

            if(brands.length > 0)
            {
               url+= '&brand=' + brands.toString()
            }

            window.location.href = url ; 
            

        }
    </script>
@endsection
