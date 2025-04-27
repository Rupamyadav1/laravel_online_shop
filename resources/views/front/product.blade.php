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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="menu1-tab" data-bs-toggle="tab" href="#menu1" role="tab" aria-controls="menu1" aria-selected="false">Menu 1</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="menu2-tab" data-bs-toggle="tab" href="#menu2" role="tab" aria-controls="menu2" aria-selected="false">Menu 2</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="menu3-tab" data-bs-toggle="tab" href="#menu3" role="tab" aria-controls="menu3" aria-selected="false">Menu 3</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3>HOME</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="menu1-tab">
                            <h3>Menu 1</h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="menu2-tab">
                            <h3>Menu 2</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div>
                        <div class="tab-pane fade" id="menu3" role="tabpanel" aria-labelledby="menu3-tab">
                            <h3>Menu 3</h3>
                            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

@endsection

@section('customJS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    // Initialize Bootstrap 5 tabs programmatically if needed
    var myTab = new bootstrap.Tab(document.querySelector('#home-tab'));
    myTab.show();
</script>
@endsection

