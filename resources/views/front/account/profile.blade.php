@extends('front.layouts.app')
@section('main-content')
    {{-- <link href="{{asset('admin_assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" /> --}}

    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a>
                        </li>
                        <li class="breadcrumb-item">My Profile</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">

                    <div class="col">

                        @include('front.account.common.sidebar')

                    </div>
                    <div class="col">

                        @include('front.account.common.message')

                    </div>



                    <div class="col-md-9">
                        <form method="post" name="profileForm" id="profileForm">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input value="{{ !empty($user->name) ? $user->name : '' }}" type="text"
                                                name="name" id="name" placeholder="Enter Your Name"
                                                class="form-control">
                                            <p class="text-danger" id="name-error"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input value="{{ !empty($user->email) ? $user->email : '' }}" type="text"
                                                name="email" id="email" placeholder="Enter Your Email"
                                                class="form-control">
                                            <p class="text-danger" id="email-error"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input value="{{ !empty($user->phone) ? $user->phone : '' }}" type="text"
                                                name="phone" id="phone" placeholder="Enter Your Phone"
                                                class="form-control">
                                            <p class="text-danger" id="phone-error"></p>
                                        </div>




                                        <div class="d-flex">
                                            <button class="btn btn-dark" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="card mt-5">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-3 pb-2">Address</h2>
                            </div>
                            <div class="card-body p-4">

                                <form id="addressForm" name="addressForm" method="post">

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">First Name</label>
                                            <input
                                                value="{{ !empty($customerAddress->first_name) ? $customerAddress->first_name : '' }}"
                                                type="text" name="first_name" id="first_name"
                                                placeholder="Enter Your First Name" class="form-control">
                                            <p class="text-danger" id="first-name-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email">Last Name</label>
                                            <input
                                                value="{{ !empty($customerAddress->last_name) ? $customerAddress->last_name : '' }}"
                                                type="text" name="last_name" id="last_name"
                                                placeholder="Enter Your Last Name" class="form-control">
                                            <p class="text-danger" id="last-name-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="phone">Email</label>
                                            <input
                                                value="{{ !empty($customerAddress->email) ? $customerAddress->email : '' }}"
                                                type="text" name="email" id="email"
                                                placeholder="Enter Your Email " class="form-control">
                                            <p class="text-danger" id="address-email-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input
                                                value="{{ !empty($customerAddress->mobile) ? $customerAddress->mobile : '' }}"
                                                type="text" name="mobile" id="mobile"
                                                placeholder="Enter Your Mobile No." class="form-control">
                                            <p class="text-danger" id="mobile-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="country">Country</label>
                                            <select id="country" name="country" class="form-control">
                                                <option value="">Select a country</option>
                                                @if (!empty($country))
                                                    @foreach ($countries as $country)
                                                        <option
                                                            {{ $country->id == $customerAddress->id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>

                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            <p class="text-danger" id="country-error"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" placeholder="Enter Your Address" class="form-control">{{ !empty($customerAddress->address) ? $customerAddress->address : '' }}
                                            </textarea>
                                            <p class="text-danger" id="address-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="apartment">Apartment</label>
                                            <input
                                                value="{{ !empty($customerAddress->apartment) ? $customerAddress->apartment : '' }}"
                                                type="text" name="apartment" id="apartment"
                                                placeholder="Enter Your Apartment" class="form-control">
                                            <p class="text-danger" id="apartment-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="city">City</label>
                                            <input
                                                value="{{ !empty($customerAddress->city) ? $customerAddress->city : '' }}"
                                                type="text" name="city" id="city"
                                                placeholder="Enter Your City" class="form-control">
                                            <p class="text-danger" id="city-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="state">State</label>
                                            <input
                                                value="{{ !empty($customerAddress->state) ? $customerAddress->state : '' }}"
                                                type="text" name="state" id="state"
                                                placeholder="Enter Your State" class="form-control">
                                            <p class="text-danger" id="state-error"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="zip">Zip</label>
                                            <input
                                                value="{{ !empty($customerAddress->zip) ? $customerAddress->zip : '' }}"
                                                type="text" name="zip" id="zip"
                                                placeholder="Enter Your Zip" class="form-control">
                                            <p class="text-danger" id="zip-error"></p>
                                        </div>




                                        <div class="d-flex">
                                            <button class="btn btn-dark" type="submit">Update</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            </div>
        </section>
    </main>
@endsection

@section('customJS')
    <script>
        $("#profileForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        $('#profileForm #name').removeClass('is-invalid');
                        $('#name-error').html('');

                        $('#profileForm #email').removeClass('is-invalid');
                        $('#email-error').html('');

                        $('#profileForm #phone').removeClass('is-invalid');
                        $('#phone-error').html('');
                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $('#profileForm #name').addClass('is-invalid');
                            $('#name-error').html(errors.name);
                        } else {
                            $('#profileForm #name').removeClass('is-invalid');
                            $('#name-error').html('');
                        }

                        if (errors.email) {
                            $('#profileForm #email').addClass('is-invalid');
                            $('#email-error').html(errors.email);
                        } else {
                            $('#profileForm #email').removeClass('is-invalid');
                            $('#email-error').html('');
                        }

                        if (errors.phone) {
                            $('#profileForm #phone').addClass('is-invalid');
                            $('#phone-error').html(errors.phone);
                        } else {
                            $('#profileForm #phone').removeClass('is-invalid');
                            $('#phone-error').html('');
                        }
                    }


                }
            })
        })

        $("#addressForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.updateAddress') }}',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#first_name').removeClass('is-invalid');
                        $('#first-name-error').html('');

                        $('#last_name').removeClass('is-invalid');
                        $('#last-name-error').html('');

                        $('#addressForm #email').removeClass('is-invalid');
                        $('#email-error').html('');

                        $('#mobile').removeClass('is-invalid');
                        $('#mobile-error').html('');

                        $('#country').removeClass('is-invalid');
                        $('#country-error').html('');

                        $('#addressForm #email').removeClass('is-invalid');
                        $('#address-email-error').html('');

                        $('#apartment').removeClass('is-invalid');
                        $('#apartment-error').html('');

                        $('#city').removeClass('is-invalid');
                        $('#city-error').html('');

                        $('#city').removeClass('is-invalid');
                        $('#city-error').html('');

                        $('#state').removeClass('is-invalid');
                        $('#state-error').html('');

                        $('#zip').removeClass('is-invalid');
                        $('#zip-error').html('');
                    } else {
                        var errors = response.errors;

                        if (errors.first_name) {
                            $('#first_name').addClass('is-invalid');
                            $('#first-name-error').html(errors.first_name);
                        } else {
                            $('#first_name').removeClass('is-invalid');
                            $('#first-name-error').html('');
                        }

                        if (errors.last_name) {
                            $('#last_name').addClass('is-invalid');
                            $('#last-name-error').html(errors.last_name);
                        } else {
                            $('#last_name').removeClass('is-invalid');
                            $('#last-name-error').html('');
                        }

                        if (errors.email) {
                            $('#addressForm #email').addClass('is-invalid');
                            $('#address-email-error').html(errors.email);
                        } else {
                            $('#addressForm #email').removeClass('is-invalid');
                            $('#address-email-error').html('');
                        }

                        if (errors.mobile) {
                            $('#mobile').addClass('is-invalid');
                            $('#mobile-error').html(errors.mobile);
                        } else {
                            $('#mobile').removeClass('is-invalid');
                            $('#mobile-error').html('');
                        }

                        if (errors.country) {
                            $('#country').addClass('is-invalid');
                            $('#country-error').html(errors.country);
                        } else {
                            $('#country').removeClass('is-invalid');
                            $('#country-error').html('');
                        }

                        if (errors.address) {
                            $('#address').addClass('is-invalid');
                            $('#address-error').html(errors.mobile);
                        } else {
                            $('#address').removeClass('is-invalid');
                            $('#address-error').html('');
                        }

                        if (errors.apartment) {
                            $('#apartment').addClass('is-invalid');
                            $('#apartment-error').html(errors.mobile);
                        } else {
                            $('#apartment').removeClass('is-invalid');
                            $('#apartment-error').html('');
                        }

                        if (errors.city) {
                            $('#city').addClass('is-invalid');
                            $('#city-error').html(errors.mobile);
                        } else {
                            $('#city').removeClass('is-invalid');
                            $('#city-error').html('');
                        }

                        if (errors.state) {
                            $('#state').addClass('is-invalid');
                            $('#state-error').html(errors.mobile);
                        } else {
                            $('#state').removeClass('is-invalid');
                            $('#state-error').html('');
                        }

                        if (errors.zip) {
                            $('#zip').addClass('is-invalid');
                            $('#zip-error').html(errors.mobile);
                        } else {
                            $('#zip').removeClass('is-invalid');
                            $('#zip-error').html('');
                        }

                    }


                }
            })
        })
    </script>
@endsection
