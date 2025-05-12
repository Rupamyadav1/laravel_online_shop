@extends('front.layouts.app')

@section('main-content')
 @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center pt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="header-title">Thank You</h4>
                            <p>Your order has been placed successfully.</p>
                           <p> Your orderId is:<strong>{{$orderId}}</strong></p>
                        </div>
                    </div>

@endsection

@section('customJS')
@endsection