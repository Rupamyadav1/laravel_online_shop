@extends('admin.layouts.app');

@section('main-content')
    <div class="row row-cols-xxl-3 row-cols-md-2 row-cols-1">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Number of Orders">
                                Total Orders</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($totalOrders,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-1">
                                </span>
                                <span class="text-nowrap"><a href="{{ route('orders.index') }}">more info</a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-42">
                                <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Revenue">Total
                                Products</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($totalProducts,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1">
                                </span>
                                <span class="text-nowrap"><a href="{{ route('products.index') }}">more info</a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-42">
                                <iconify-icon icon="solar:wad-of-money-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="New Users">Total Customers
                            </h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($totalUsers,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1"></span>
                                <span class="text-nowrap"><a href="{{ route('users.index') }}">more info</a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-42">
                                <iconify-icon icon="solar:user-plus-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->


    </div><!-- end row -->
    <div class="row row-cols-xxl-3 row-cols-md-2 row-cols-1">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Customer Satisfaction">
                                Total Sale</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($totalRevenue,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1"></span>
                                <span class="text-nowrap"><a></a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-42">
                                <iconify-icon icon="solar:sticker-smile-circle-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Customer Satisfaction">Revenue this month</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($revenueThisMonth,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1"></span>
                                <span class="text-nowrap"><a></a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-42">
                                <iconify-icon icon="solar:sticker-smile-circle-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Customer Satisfaction">Revenue Last Month ({{ $lastMonthName }})</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($revenuelastMonth,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1"></span>
                                <span class="text-nowrap"><a></a></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-42">
                                <iconify-icon icon="solar:sticker-smile-circle-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
    </div>

    <div class="row row-cols-xxl-3 row-cols-md-2 row-cols-1 ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h5 class="text-muted fs-13 fw-bold text-uppercase" title="Customer Satisfaction">Revenue Last 30 Days</h5>
                            <h3 class="my-2 py-1 fw-bold">${{number_format($revenuelastThirtyDays,2)}}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-1"></span>
                                <span class="text-nowrap"></span>
                            </p>
                        </div>
                        <div class="avatar-xl flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-42">
                                <iconify-icon icon="solar:sticker-smile-circle-bold-duotone"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
