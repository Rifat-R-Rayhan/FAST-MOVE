<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fast Move</title>

    <link rel="stylesheet" href="/marchant/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/marchant/assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="/marchant/assets/css/style.css">
    <!-- End layout styles -->
    <link href="/frontend/img/delivery-bike.png" rel="icon">
</head>

<body>



    <div class="conatiner-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('deliveryman.dashboard') }}"><img
                        src="/frontend/img/delivery-bike.png" style="width: 120px; height:50px;"  alt="logo" /></a>
                {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="marchant/assets/images/logo-mini.svg"
                            alt="logo" /></a> --}}
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                {{-- <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div> --}}

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                {{-- {{dd($admin->admin_name.'_'. $admin->profile_img)}} --}}
                                <img src="{{asset('deliverymen/profile_images')}}/{{$deliveryman->profile_img}}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ $deliveryman->deliveryman_name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

                            <a class="dropdown-item text-dark" href="{{ route('deliveryman.edit') }}">
                                <i class="mdi mdi-account-card-details me-2 text-dark"></i> Update Profile </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-dark" href="{{ route('deliveryman.change.password') }}">
                                <i class="mdi mdi-account-key me-2 text-dark"></i> Change Password </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-dark" href="{{ route('deliveryman.delete') }}">
                                <i class="mdi mdi-account-key me-2 text-dark"></i> Delete Account </a>
                            {{-- <form action="{{ route('admin.delete') }}" method="get">
                                @csrf
                                <button class="dropdown-item" type="submit"
                                    onclick="return confirm('Are you sure?')"><i
                                        class="mdi mdi-account-remove me-2 text-primary"></i> Delete Account</button>
                            </form> --}}
                            <div class="dropdown-divider"></div>

                            <form action="{{ route('deliveryman.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-dark"> <i
                                        class="mdi mdi-logout me-2 text-dark"></i> Signout </button>
                            </form>

                        </div>
                    </li>
{{-- 
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="marchant/assets/images/faces/face4.jpg" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="marchant/assets/images/faces/face2.jpg" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="marchant/assets/images/faces/face3.jpg" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture
                                        updated</h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-settings"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-link-variant"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li> --}}
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">



            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{asset('deliverymen/profile_images')}}/{{$deliveryman->profile_img}}" alt="image">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                    <span class="font-weight-bold mb-2">{{$deliveryman->deliveryman_name}}</span>
                                    <span class="text-secondary text-small">Delivery Man</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('deliveryman.dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="{{ route('deliveryman.product.table') }}">
                            <span class="menu-title">Delivery Product</span>
                            <i class="mdi mdi-shopping menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('deliveryman.fraud_check') }}">
                            <span class="menu-title">Fraud Check</span>
                            <i class="mdi mdi-emoticon-devil menu-icon"></i>
                            {{-- <i class="mdi mdi-contacts menu-icon"></i> --}}
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false"
                            aria-controls="general-pages">
                            <span class="menu-title">Create</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-import menu-icon"></i>
                        </a>
                        <div class="collapse" id="general-pages">
                            <ul class="nav flex-column sub-menu">
                                @if ($admin->role == 'super admin')
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{route('admin.register')}}"> Admin </a></li>
                                @endif
                                <li class="nav-item"> <a class="nav-link" href="{{ route('addDeliveryCharge') }}">
                                        Delivery Charge </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('pickup.create') }}">
                                        Pickup Man</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="marchant/pages/icons/mdi.html">
                            <span class="menu-title">Icons</span>
                            <i class="mdi mdi-contacts menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="marchant/pages/forms/basic_elements.html">
                            <span class="menu-title">Forms</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="marchant/pages/charts/chartjs.html">
                            <span class="menu-title">Charts</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="marchant/pages/tables/basic-table.html">
                            <span class="menu-title">Tables</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false"
                            aria-controls="general-pages">
                            <span class="menu-title">Sample Pages</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-medical-bag menu-icon"></i>
                        </a>
                        <div class="collapse" id="general-pages">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="marchant/pages/samples/blank-page.html"> Blank
                                        Page </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/marchant/pages/samples/login.html">
                                        Login </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="marchant/pages/samples/register.html">
                                        Register </a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="marchant/pages/samples/error-404.html"> 404
                                    </a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="marchant/pages/samples/error-500.html"> 500
                                    </a></li>
                            </ul>
                        </div>
                    </li> --}}
                    
                </ul>
            </nav>
            <!-- partial -->


            <div class="main-panel">
                <div class="content-wrapper">


                    @hasSection('content')
                        @yield('content')
                    @else
                        <h1 style="text-align: center;">Here is no deliveryman content...</h1>
                    @endif
                </div>
            </div>

        </div>



    </div>




    <script src="/marchant/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/marchant/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/marchant/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/marchant/assets/js/off-canvas.js"></script>
    <script src="/marchant/assets/js/hoverable-collapse.js"></script>
    <script src="/marchant/assets/js/misc.js"></script>
    <script src="/marchant/assets/js/dashboard.js"></script>
    <script src="/marchant/assets/js/todolist.js"></script>
</body>

</html>
