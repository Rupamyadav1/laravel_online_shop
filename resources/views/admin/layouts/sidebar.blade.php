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
                        <span class="align-middle">Support</span>
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
                <a href="index.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-3-line"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <span class="badge bg-danger rounded-pill">5</span>
                </a>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>
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
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>
                    <span class="menu-text"> Sub Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="pages-starter.html" class="side-nav-link">
                                <span class="menu-text">Starter Page</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-pricing.html" class="side-nav-link">
                                <span class="menu-text">Pricing</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-faq.html" class="side-nav-link">
                                <span class="menu-text">FAQ</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-maintenance.html" class="side-nav-link">
                                <span class="menu-text">Maintenance</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-timeline.html" class="side-nav-link">
                                <span class="menu-text">Timeline</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-coming-soon.html" class="side-nav-link">
                                <span class="menu-text">Coming Soon</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-terms-conditions.html" class="side-nav-link">
                                <span class="menu-text">Terms & Conditions</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="pages-search-results.html" class="side-nav-link">
                                <span class="menu-text">Search Results</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false"
                    aria-controls="sidebarPagesAuth" class="side-nav-link">
                    <span class="menu-icon"> <i class="ri-store-line me-1 fs-16 align-middle"></i></span>
                    <span class="menu-text"> Brand </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesAuth">
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
                    <span class="menu-icon"><i class="ri-error-warning-line"></i></span>
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
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false"
                    aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-share-line"></i></span>
                    <span class="menu-text">Shipping </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false"
                                aria-controls="sidebarSecondLevel" class="side-nav-link">
                                <span class="menu-text"> Add Shipping </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSecondLevel">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="javascript: void(0);" class="side-nav-link">
                                            <span class="menu-text">Shipping</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="javascript: void(0);" class="side-nav-link">
                                            <span class="menu-text">Item 2</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false"
                                aria-controls="sidebarThirdLevel" class="side-nav-link">
                                <span class="menu-text"> Shiiping </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirdLevel">
                                <ul class="sub-menu">
                                    <li class="side-nav-item">
                                        <a href="javascript: void(0);" class="side-nav-link">Item 1</a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false"
                                            aria-controls="sidebarFourthLevel" class="side-nav-link">
                                            <span class="menu-text"> Item 2 </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarFourthLevel">
                                            <ul class="sub-menu">
                                                <li class="side-nav-item">
                                                    <a href="javascript: void(0);" class="side-nav-link">
                                                        <span class="menu-text">Item 2.1</span>
                                                    </a>
                                                </li>
                                                <li class="side-nav-item">
                                                    <a href="javascript: void(0);" class="side-nav-link">
                                                        <span class="menu-text">Item 2.2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

          

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ri-shapes-line"></i></span>
                    <span class="menu-text"> Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIcons">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="icons-remix.html" class="side-nav-link">
                                <span class="menu-text">Add Orders</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="icons-solar.html" class="side-nav-link">
                                <span class="menu-text">Orders</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCharts" aria-expanded="false" aria-controls="sidebarCharts"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ri-bar-chart-line"></i></span>
                    <span class="menu-text"> Discount</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCharts">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="charts-apex-area.html" class="side-nav-link">
                                <span class="menu-text">Add Discount</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-bar.html" class="side-nav-link">
                                <span class="menu-text">Discount</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-bubble.html" class="side-nav-link">
                                <span class="menu-text">Bubble</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-candlestick.html" class="side-nav-link">
                                <span class="menu-text">Candlestick</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-column.html" class="side-nav-link">
                                <span class="menu-text">Column</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-heatmap.html" class="side-nav-link">
                                <span class="menu-text">Heatmap</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-line.html" class="side-nav-link">
                                <span class="menu-text">Line</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-mixed.html" class="side-nav-link">
                                <span class="menu-text">Mixed</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-timeline.html" class="side-nav-link">
                                <span class="menu-text">Timeline</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-boxplot.html" class="side-nav-link">
                                <span class="menu-text">Boxplot</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-treemap.html" class="side-nav-link">
                                <span class="menu-text">Treemap</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-pie.html" class="side-nav-link">
                                <span class="menu-text">Pie</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-radar.html" class="side-nav-link">
                                <span class="menu-text">Radar</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-radialbar.html" class="side-nav-link">
                                <span class="menu-text">RadialBar</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-scatter.html" class="side-nav-link">
                                <span class="menu-text">Scatter</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-polar-area.html" class="side-nav-link">
                                <span class="menu-text">Polar Area</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="charts-apex-sparklines.html" class="side-nav-link">
                                <span class="menu-text">Sparklines</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ri-contrast-line"></i></span>
                    <span class="menu-text"> Forms </span>
                    <span class="menu-arrow"></span>
                </a>
                
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ri-table-view"></i></span>
                    <span class="menu-text"> Tables </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTables">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="tables-basic.html" class="side-nav-link">
                                <span class="menu-text">Basic Tables</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="tables-gridjs.html" class="side-nav-link">
                                <span class="menu-text">Gridjs Tables</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="tables-datatable.html" class="side-nav-link">
                                <span class="menu-text">Datatable Tables</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ri-road-map-line"></i></span>
                    <span class="menu-text"> Maps </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMaps">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="maps-google.html" class="side-nav-link">
                                <span class="menu-text">Google Maps</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="maps-vector.html" class="side-nav-link">
                                <span class="menu-text">Vector Maps</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="maps-leaflet.html" class="side-nav-link">
                                <span class="menu-text">Leaflet Maps</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

       
       

        <div class="clearfix"></div>
    </div>
</div>