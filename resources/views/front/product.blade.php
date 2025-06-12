@extends('front.layouts.app')

@section('main-content')

    <head>
        <style>
            .rating {
                direction: rtl;
                unicode-bidi: bidi-override;
                color: #ddd;
                /* Personal choice */
                font-size: 8px;
                margin-left: -15px;
            }

            .rating input {
                display: none;
            }

            .rating label:hover,
            .rating label:hover~label,
            .rating input:checked+label,
            .rating input:checked+label~label {
                color: #ffc107;
                /* Personal color choice. Lifted from Bootstrap 4 */
                font-size: 8px;
            }


            .front-stars,
            .back-stars,
            .star-rating {
                display: flex;
            }

            .star-rating {
                align-items: left;
                font-size: 1.5em;
                justify-content: left;
                margin-left: -5px;
            }

            .back-stars {
                color: #CCC;
                position: relative;
            }

            .front-stars {
                color: #FFBC0B;
                overflow: hidden;
                position: absolute;
                top: 0;
                transition: all 0.5s;
            }


            .percent {
                color: #bb5252;
                font-size: 1.5em;
            }
            .start-rating.product{
                font-size: 1em;
            }
        </style>

    </head>
    <main>
        <section class="section-5 pt-3 pb-3 mb-3">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                        <li class="breadcrumb-item">{{ $product->slug }}</li>
                    </ol>
                </div>
            </div>
        </section>
        

        <section class="section-7 pt-3 mb-3">
            <div class="container">
                <div class="row ">
                     @include('front.account.common.message')
                    <div class="col-md-5">
                        <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light">
                                @if ($product->product_images)
                                    @foreach ($product->product_images as $key => $productImage)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="w-100 h-100"
                                                src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                alt="Image">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="bg-light right">
                            <h1>{{ $product->slug }}</h1>
                            <div class="d-flex mb-3">
                                <div class="text-primary mr-2">
                                    {{-- <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star-half-alt"></small>
                                    <small class="far fa-star"></small> --}}
                                    <div class="star-rating" title="" style="font-size: 1rem;">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: {{ !empty($avgRatingPer) }}%; font-size:1rem">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <small class="">({{ ($product->product_ratings_count > 1) ? $product->product_ratings_count.' Reviews' :$product->product_ratings_count.' Review'}})</small>
                            </div>
                            <h2 class="price text-secondary"><del>{{ $product->compare_price }}</del></h2>
                            <h2 class="price ">{{ $product->price }}</h2>
                            <p>{!! $product->short_description !!}</p>
                            <a onclick="addToCart({{ $product->id }})" class="btn btn-dark"><i
                                    class="fas fa-shopping-cart"></i> &nbsp;ADD TO
                                CART</a>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist"
                            style="margin-top: 20px; display: flex; gap: 15px;">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#description"
                                    role="tab" aria-controls="home" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="menu1-tab" data-bs-toggle="tab" href="#shipping" role="tab"
                                    aria-controls="menu1" aria-selected="false">Shipping & Returns</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="menu2-tab" data-bs-toggle="tab" href="#reviews" role="tab"
                                    aria-controls="menu2" aria-selected="false">Reviews</a>
                            </li>

                        </ul>


                        <!-- Tab content -->
                        <div class="tab-content" id="myTabContent"> <!--Dynamic Tabs -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="home-tab">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="menu1-tab">
                                {!! $product->shipping_returns !!}

                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="menu2-tab">
                                <div class="col-md-8">
                                    <div class="row">
                                        <form id="productRatingForm" name="productRatingForm">
                                            <h3 class="h4 pb-3">Write a Review</h3>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Name">
                                                <p class="text-danger" id="name-error"></p>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Email">
                                                <p class="text-danger" id="email-error"></p>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="rating">Rating</label>
                                                <br>
                                                <div class="rating" style="width: 10rem">
                                                    <input id="rating-5" type="radio" name="rating"
                                                        value="5" /><label for="rating-5"><i
                                                            class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-4" type="radio" name="rating"
                                                        value="4" /><label for="rating-4"><i
                                                            class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-3" type="radio" name="rating"
                                                        value="3" /><label for="rating-3"><i
                                                            class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-2" type="radio" name="rating"
                                                        value="2" /><label for="rating-2"><i
                                                            class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-1" type="radio" name="rating"
                                                        value="1" /><label for="rating-1"><i
                                                            class="fas fa-3x fa-star"></i></label>

                                                </div>
                                                <p class="product-rating-error text-danger"></p>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">How was your overall experience?</label>
                                                <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"
                                                    placeholder="How was your overall experience?"></textarea>
                                                <p class="text-danger" id="comment-error"></p>
                                            </div>
                                            <div>
                                                <button class="btn btn-dark">Submit</button>
                                            </div>

                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="overall-rating mb-3">
                                        <div class="d-flex">
                                            <h1 class="h3 pe-3">{{$avgRating}}</h1>
                                            <div class="star-rating mt-2" title="">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-2">
                                                ({{ ($product->product_ratings_count > 1) ? $product->product_ratings_count.' Reviews' :$product->product_ratings_count.' Review'}})
                                            </div>
                                        </div>

                                    </div>
                                    @if ($product->product_ratings->isNotEmpty())
                                    @foreach ($product->product_ratings as $rating)
                                    @php
                                        $ratingPercentage=($rating->rating*100)/5;
                                    @endphp
                                        
                                   
                                    <div class="rating-group mb-4">
                                        <span> <strong>{{ $rating->username }} </strong></span>
                                        <div class="star-rating mt-2" title="">
                                            <div class="back-stars">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>

                                                <div class="front-stars" style="width: {{ $ratingPercentage }}%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3">
                                            <p>{{ $rating->comment }}

                                            </p>
                                        </div>
                                    </div>

                                         @endforeach
                                    @endif
                                    
                                    
                                </div>
                            </div>

                            {{-- <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="menu2-tab">
                            <h3>Menu 2</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div> --}}

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="pt-5 section-8">
            <div class="container">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
                <div class="col-md-12">
                    @if ($relatedProducts)
                        @foreach ($relatedProducts as $relProduct)
                            @php
                                $productImage = $relProduct->product_images->first();
                            @endphp
                            <div id="related-products" class="carousel">
                                <div class="card product-card">
                                    <div class="product-image">
                                        <a href="{{ route('front.product', $relProduct->slug) }}" class="product-img">
                                            <img class="card-img-top"
                                                src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                alt="" style="height:200px; width:200px"></a>
                                        <a class="whishlist" style="cursor:pointer" onclick="addToWishList({{ $product->id }})"><i class="far fa-heart"></i></a>

                                        <div class="">
                                            @if ($relProduct->track_qty == 'Yes')
                                                @if ($relProduct->qty > 0)
                                                    <a class="btn btn-dark" href="addToCart({{ $relProduct->id }})"
                                                        onclick="addToCart({{ $relProduct->id }})">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                @else
                                                    <a class="btn btn-dark" href="addToCart({{ $relProduct->id }})"
                                                        onclick="addToCart({{ $relProduct->id }})">
                                                        <i class="fa fa-shopping-cart"></i> Out Of Stock
                                                    </a>
                                                @endif
                                            @else
                                                <a class="btn btn-dark"
                                                    onclick="addToCart({{ $relProduct->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="">{{ $relProduct->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>{{ $relProduct->price }}</strong></span>
                                            <span
                                                class="h6 text-underline"><del>{{ $relProduct->compare_price }}</del></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>

@endsection

@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#productRatingForm").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('front.saveRating', $product->id) }}",
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;
                    if(response.status == false) {
                        

                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid');
                            $('#name-error').html('');
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid');
                            $('#email-error').html(errors.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#email-error').html('');
                        }
                        if (errors.rating) {
                            $('.product-rating-error').html(errors.rating)
                        } else {
                            $('.product-rating-error').html('')

                        }

                        if (errors.comment) {
                            $('#comment').addClass('is-invalid');
                            $('#comment-error').html(errors.comment);
                        } else {
                            $('#comment').removeClass('is-invalid');
                            $('#comment-error').html('');
                        }
                    }
                    else{
                    window.location.href="{{ route('front.product',$product->slug) }}"
                }

                }
            



            })
        })
    </script>
@endsection
