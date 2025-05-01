@extends('front.layouts.app')

@section('main-content')
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
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        <h2 class="price text-secondary"><del>{{ $product->compare_price }}</del></h2>
                        <h2 class="price ">{{ $product->price }}</h2>
                        <p>{!! $product->short_description !!}</p>
                        <a href="cart.php" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO
                            CART</a>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 20px; display: flex; gap: 15px;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="home" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="menu1-tab" data-bs-toggle="tab" href="#shipping" role="tab" aria-controls="menu1" aria-selected="false">Shipping & Returns</a>
                        </li>


                        
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="menu2-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="menu2" aria-selected="false">Reviews</a>
                        </li>
                        
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content" id="myTabContent">  <!--Dynamic Tabs -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="home-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="menu1-tab">
                            {!! $product->shipping_returns  !!}
                        
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="menu2-tab">
                            <h3>Menu 2</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div>
                       
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
                        $productImage=$relProduct->product_images->first();
                    @endphp
                <div id="related-products" class="carousel">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route('front.product',$relProduct->slug) }}" class="product-img">
                                <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="" style="height:200px; width:200px"></a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                            <div class="product-action">
                                <a class="btn btn-dark" href="#">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="">{{$relProduct->title}}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{$relProduct->price}}</strong></span>
                                <span class="h6 text-underline"><del>{{$relProduct->compare_price}}</del></span>
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

@endsection