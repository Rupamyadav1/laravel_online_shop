@extends('front.layouts.app')
@section('main-content')
    {{-- <link href="{{asset('admin_assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" /> --}}

    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Wishlist</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-12">
                         @include('front.account.common.message')

                    </div>

                    <div class="col-md-3">

                        @include('front.account.common.sidebar')

                    </div>



                    <div class="col-md-9">
                        <div class="card">
                            @if ($wishlists->isNotEmpty())
                                @foreach ($wishlists as $wishlist)
                                    <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start">

                                            @php
                                                $productImage = getProductImage($wishlist->product_id);
                                            @endphp

                                            <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('front.product',$wishlist->product->slug) }}"
                                                style="width: 10rem;">

                                                @if ($productImage)
                                                    <img alt="product image"  class="product-list-primary-img"
                                                        src="{{ asset('uploads/product/small/' . $productImage->image) }}">
                                                @endif
                                            </a>
                                            <div class="pt-2">
                                                <h3 class="product-title fs-base mb-2"><a
                                                        href="shop-single-v1.html">{{ $wishlist->product->title }}</a></h3>
                                                <div class="fs-lg text-accent pt-2">
                                                    <span class="product-list-price">${{ $wishlist->product->price }}</span>
                                                    <span
                                                        class="product-list-price sell-p"><del>{{ $wishlist->product->compare_price }}</del></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <button onclick=" removeProduct( {{$wishlist->product_id}}) " class="btn btn-outline-danger btn-sm" type="button"><i
                                                    class="fas fa-trash-alt me-2"></i>Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            
                            @else
                        <div class="d-flex justify-content-center py-5">
    <h5>Your wishlist is empty !!</h5>
</div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('customJS')
<script>
    function removeProduct(id){
        $.ajax({
            url:"{{ route('account.removeProductfromWishlist') }}",
            type:"POST",
            data:{id:id},
            dataType:"json",
            success:function(response){
                window.location.href="{{ route('account.wishlist') }}"


            }

        });
    }
    </script>
    @endsection
