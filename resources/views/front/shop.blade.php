@extends('front.layouts.app')
@section('main-content')


    <main>

        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
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
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-bs-toggle="dropdown">Sorting</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Latest</a>
                                            <a class="dropdown-item" href="#">Price High</a>
                                            <a class="dropdown-item" href="#">Price Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($products)
                            @foreach ($products as $product)
                                @php
                                    $productImage = $product->product_images->first();

                                @endphp
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">

                                            @if (!empty($productImage))
                                                <a href="" class="product-img"><img class="card-img-top"
                                                        src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                        alt=""></a>
                                            @else
                                                <a href="" class="product-img"><img class="card-img-top"
                                                        src="" alt=""></a>
                                            @endif


                                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                            <div class="product-action">
                                                <a class="btn btn-dark" href="#">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3">
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



                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('customJS')


        <script>


$(document).ready(function () {
    $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: 200,
        to: 500,
        grid: true
    });
});



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

            window.location.href = url + '&brand=' + brands.toString(); // send brand id to the url 
        }
    </script>
@endsection
