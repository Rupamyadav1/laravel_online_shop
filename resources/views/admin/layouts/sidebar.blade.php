<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{asset('admin_assets/images/logo.png')}}" alt="logo"></span>
            <span class="logo-sm"><img src="{{asset('admin_assets/images/logo-sm.png')}}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{asset('admin_assets/images/logo-dark.png')}}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{asset('admin_assets/images/logo-sm.png')}}" alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ri-close-line align-middle"></i>
    </button>

    <div data-simplebar>

        <!-- User -->
        <div >
            <div class="dropdown-center">
                {{-- <a class="topbar-link dropdown-toggle text-reset drop-arrow-none px-2 d-flex align-items-center justify-content-center" data-bs-toggle="dropdown" data-bs-offset="0,19" type="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('admin_assets/images/users/avatar-1.jpg')}}" width="42" class="rounded-circle me-2 d-flex" alt="user-image">
                    <span class="d-flex flex-column gap-1 sidebar-user-name">
                        <h4 class="my-0 fw-bold fs-15">{{Auth::guard('admin')->user()->name}}</h4>
                        <h6 class="my-0">Admin Head</h6>
                    </span>
                    <i class="ri-arrow-down-s-line d-block sidebar-user-arrow align-middle ms-2"></i>
                </a> --}}

            
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome {{Auth::guard('admin')->user()->name}}!</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="ri-wallet-3-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">Wallet : <span class="fw-semibold">$89.25k</span></span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="ri-settings-2-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="ri-question-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">Change Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="ri-lock-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">Lock Screen</span>
                    </a>
                   

                    <!-- item-->
                   
                    
                    
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="dropdown-item active fw-semibold text-danger">
                        <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                        <span class="align-middle">Sign Out</span>
                    </a>
                   
                

                </div>
            </div>
        </div>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" >
            {{ csrf_field() }}
        </form>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
          
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    
                </a>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-tags"  style="color:#02bace; font-size: 1rem;"></i></span>
                    <span class="menu-text">Category</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="sub-menu">
                       
                        
                        <li class="side-nav-item">
                            <a href="{{ route('categories.index') }}" class="side-nav-link">
                                <span class="menu-text">Category</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('categories.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Category</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCategory" aria-expanded="false" aria-controls="sidebarCategory"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-tags"  style="color:#02bace; font-size: 1rem;"></i></span>
                    <span class="menu-text"> Sub Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategory">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('sub-category.index') }}" class="side-nav-link">
                                <span class="menu-text">Category</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('sub-category.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Category</span>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBrand" aria-expanded="false"
                    aria-controls="sidebarBrand" class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-building" style="color:#02bace; font-size: 1rem;"></i> </span>
                    <span class="menu-text"> Brand </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBrand">
                    <ul class="sub-menu">
                       
                        <li class="side-nav-item">
                            <a href="{{ route('brands.index') }}" class="side-nav-link">
                                <span class="menu-text">Brand</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('brands.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Brand</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesError" aria-expanded="false"
                    aria-controls="sidebarPagesError" class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-box"  style="color:#02bace; font-size: 1rem;"></i></span>
                    <span class="menu-text"> Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesError">
                    <ul class="sub-menu">
                       
                        <li class="side-nav-item">
                            <a href="{{ route('products.index') }}" class="side-nav-link">
                                <span class="menu-text">Product</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('products.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Product</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>

           

            

          

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-shipping-fast"  style="color:#02bace; font-size: 1rem;"></i></span>
                    <span class="menu-text"> Shipping</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIcons">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('shipping.index') }}" class="side-nav-link">
                                <span class="menu-text">Shipping</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('shipping.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Shipping</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCharts" aria-expanded="false" aria-controls="sidebarCharts"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-tags"  style="color:#02bace; font-size: 1rem;"></i>    </span>
                    <span class="menu-text"> Discount</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCharts">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('discount.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Discount</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('discount.index') }}" class="side-nav-link">
                                <span class="menu-text">Discount</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>

            

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-shopping-cart"  style="color:#02bace; font-size: 1rem;"></i> </span>
                    <span class="menu-text"> Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTables">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('orders.index') }}" class="side-nav-link">
                                <span class="menu-text">Orders</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="tables-gridjs.html" class="side-nav-link">
                                <span class="menu-text">Add Orders</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-users"  style="color:#02bace; font-size: 1rem;"></i>   </span>
                    <span class="menu-text"> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('users.index') }}" class="side-nav-link">
                                <span class="menu-text">User</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('users.create') }}" class="side-nav-link">
                                <span class="menu-text">Add User</span>
                            </a>
                        </li>
                     
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-file"  style="color:#02bace; font-size: 1rem;"></i>  </span>
                    <span class="menu-text"> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('pages.create') }}" class="side-nav-link">
                                <span class="menu-text">Add Pages</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('pages.index') }}" class="side-nav-link">
                                <span class="menu-text">Pages</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarRatings" aria-expanded="false" aria-controls="sidebarRatings"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fas fa-star"  style="color:#02bace; font-size: 1rem;"></i> </span>
                    <span class="menu-text"> Ratings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRatings">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('product.ratings') }}" class="side-nav-link">
                                <span class="menu-text">Ratings</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>

           
        </ul>

       
       

        <div class="clearfix"></div>
    </div>



</div>