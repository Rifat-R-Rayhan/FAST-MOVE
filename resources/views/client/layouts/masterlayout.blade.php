<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/frontend/img/delivery-bike.png" rel="icon">
    <title>Fast Move BD</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="/frontend/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/frontend/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="/frontend/css/home.css" />
    {{-- <link rel="stylesheet" href="/frontend/css/google_translate_api.css" />
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> --}}
    
    <style>
        .popup-container {
    display: none;
    position: fixed;
    top: 18%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the pop-up horizontally and vertically */
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
    z-index: 9999;
}

.popup {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}


.new-overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.new-popup-container {
    position: absolute;
    top: 78%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    z-index: 10000;
}

.new-popup {
    text-align: center;
}

.new-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>

<body>
    <div class="popup-container" id="popupContainer">
        <div class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Welcome to Fast Move Logistics Ltd!</h2>
            <p>We're glad you're here. Keep with us!</p>
        </div>
    </div>
    
    <div class="new-overlay" id="overlay">
        <div class="new-popup-container" id="popupContainer">
            <div class="new-popup">
                <span class="new-close" onclick="closePopup()">&times;</span>
                <h2>Welcome to our website!</h2>
                <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
                <button onclick="setCookieAndClosePopup()">Accept</button>
            </div>
        </div>
    </div>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="top-header">
            <div class="d-flex gap-2">
                {{-- <span class="d-block"><i class="l-icon fa-solid fa-phone-volume"></i>+880-1723-456789</span> --}}
                <span class="d-block text-white fw-bold date"><?php echo date("F j, Y"); ?></span>
                <span class="d-block text-white fw-bold"><i
                        class="l-icon fa-solid fa-phone-volume"></i>{{ __('text.content00') }}</span>
                {{-- <span class="d-block"><i class="l-icon fa-solid fa-envelope"></i>fastmovebd@gmail.com</span> --}}
            </div>
            

            <div class="d-flex gap-2">
                <select class="lang-change lang-select">
                    <option value="Select Language bg-dark">Select Language</option>
                    <option value="en" {{ session()->get('lang_code') == 'en' ? 'selected' : '' }}>EN
                        {{-- </option>
                    <option value="ar" {{ session()->get('lang_code') == 'ar' ? 'selected' : '' }}>عربي
                    </option> --}}
                    <option value="bn" {{ session()->get('lang_code') == 'bn' ? 'selected' : '' }}>BN
                    </option>
                </select>
                <span class="d-block"><i class="l-icon fa-solid fa-envelope"></i>{{ __('text.content01') }}</span>
            </div>

        </div>


        <div class="header header-1">
            <div class="logo">
                <div class="img">
                    <a href="{{ route('home') }}"><img src="/frontend/img/delivery-bike.png" style="width: 160px; height:60px;" alt="logo" /></a>
                </div>
                <div class="text">
                    {{-- <span class="d-block head">Fast Move</span> --}}
                    {{-- <span class="d-block head">{{ __('text.content') }}</span> --}}
                    {{-- <span class="d-block moto">Perfect Way To Your Destination.</span> --}}
                    {{-- <span class="d-block moto">{{ __('text.content1') }}</span> --}}
                </div>
            </div>

            <!--<div class="nav-bar">-->
            <!--    <ul>-->
            <!--        {{-- <li><a href="#">Home</a></li> --}}-->
            <!--        <li><a href="{{ route('home') }}">{{ __('text.content2') }}</a></li>-->
            <!--        {{-- <li><a href="#">About</a></li> --}}-->
            <!--        <li><a href="{{ route('about') }}">{{ __('text.content3') }}</a></li>-->
            <!--        {{-- <li><a href="#">Services</a></li> --}}-->
            <!--        <li><a href="{{ route('service') }}">{{ __('text.content4') }}</a></li>-->
            <!--        {{-- <li><a href="#">Tracking</a></li> --}}-->
            <!--        <li><a href="{{ route('tracking') }}">{{ __('text.content5') }}</a></li>-->
            <!--        {{-- <li><a href="#">Contact</a></li> --}}-->
            <!--        <li><a href="{{ route('contact') }}">{{ __('text.content6') }}</a></li>-->
            <!--        <li><a href="{{ route('parcel_booking') }}">{{ __('text.content70') }}</a></li>-->

            <!--        {{-- <li>-->
            <!--            <div id="google_translate_element"></div>-->
            <!--        </li> --}}-->
            <!--    </ul>-->
            <!--</div>-->

            <div class="toggle-buttons">
                <button class="btn btn-light " type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="mobile-nav">
                        <ul>
                            {{-- <li><a href="#">Home</a></li> --}}
                            {{-- <li><a href="{{ route('home') }}">{{ __('text.content2') }}</a></li> --}}
                            {{-- <li><a href="#">About</a></li> --}}
                            {{-- <li><a href="{{ route('about') }}">{{ __('text.content3') }}</a></li> --}}
                            <li><a href="{{ route('business.account') }}">{{ __('text.content73') }}</a></li>
                            <li><a href="{{ route('driver.account') }}">{{ __('text.content74') }}</a></li>
                            {{-- <li><a href="#">Services</a></li> --}}
                            <li><a href="{{ route('service') }}">{{ __('text.content4') }}</a></li>
                            {{-- <li><a href="#">Tracking</a></li> --}}
                            <li><a href="{{ route('tracking') }}">{{ __('text.content5') }}</a></li>
                            {{-- <li><a href="#">Contact</a></li> --}}
                            <li><a href="{{ route('contact') }}">{{ __('text.content6') }}</a></li>
                            <li>
                                <button class="btn-grp orange-color">
                                    {{-- <i class="me-2 fa-solid fa-user-lock"></i>Login<i
                                        class="ms-2 fa-solid fa-caret-down"></i> --}}
                                    <i class="me-2 fa-solid fa-user-lock"></i>{{ __('text.content7') }}<i
                                        class="ms-2 fa-solid fa-caret-down"></i>

                                    <div class="sub-button">
                                        {{-- <a href="{{ route('admin.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Admin
                                            Login</a> --}}
                                        {{-- <a href="{{ route('login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Merchant Login</a> --}}
                                        <a href="{{ route('login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content10') }}</a>

                                        {{-- <a href="{{ route('pickupman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Pickupman Login</a> --}}
                                        <a href="{{ route('pickupman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content11') }}</a>

                                        {{-- <a href="{{ route('deliveryman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Deliveryman Login</a> --}}
                                        <a href="{{ route('deliveryman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content12') }}</a>
                                    </div>
                                </button>
                            </li>
                            <li class="mt-3">
                                <button class="btn-grp black-color">
                                    <i class="me-2 fa-solid fa-user-pen"></i>Register<i
                                        class="ms-2 fa-solid fa-caret-down"></i>

                                    <div class="sub-button">
                                        {{-- <a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right me-2"></i>Become a Merchant</a> --}}
                                        <a href="{{ route('register') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content13') }}</a>
                                        {{-- <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>Become a Pickupman</a> --}}
                                        <a href="{{ route('deliveryman.register') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content14') }}</a>
                                        {{-- <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>Become a Deliveryman</a> --}}
                                        <a href="{{ route('pickupman.register') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content15') }}</a>
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="button-part">
                <button class="btn-grp orange-color">
                    <i class="me-2 fa-solid fa-user-lock"></i>{{ __('text.content7') }}<i
                        class="ms-2 fa-solid fa-caret-down"></i>
                    {{-- <i class="me-2 fa-solid fa-user-lock"></i>Login<i class="ms-2 fa-solid fa-caret-down"></i> --}}

                    <div class="sub-button">
                        {{-- <a href="{{ route('admin.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Admin Login</a> --}}
                        {{-- <a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Merchant Login</a> --}}
                        <a href="{{ route('login') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content10') }}</a>
                        {{-- <a href="{{ route('pickupman.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Pickupman Login</a> --}}
                        <a href="{{ route('pickupman.login') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content11') }}</a>
                        {{-- <a href="{{ route('deliveryman.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Deliveryman Login</a> --}}
                        <a href="{{ route('deliveryman.login') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content12') }}</a>
                    </div>
                </button>

                <button class="btn-grp black-color">
                    {{-- <i class="me-2 fa-solid fa-user-pen"></i>Register<i class="ms-2 fa-solid fa-caret-down"></i> --}}
                    <i class="me-2 fa-solid fa-user-pen"></i>{{ __('text.content8') }}<i
                        class="ms-2 fa-solid fa-caret-down"></i>
                    <div class="sub-button">
                        {{-- <a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right me-2"></i>Become a Merchant</a> --}}
                        <a href="{{ route('register') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content13') }}</a>
                        {{-- <a href="{{ route('pickupman.register') }}"><i class="fa-solid fa-chevron-right me-2"></i>Become a Deliveryman</a> --}}
                        <a href="{{ route('deliveryman.register') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content14') }}</a>
                        {{-- <a href="{{ route('deliveryman.register') }}"><i class="fa-solid fa-chevron-right me-2"></i>Become a Pickupman</a> --}}
                        <a href="{{ route('pickupman.register') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content15') }}</a>
                    </div>
                </button>
            </div>
        </div>
        
        <div class="header header-2">
            <div class="nav-bar">
                <ul>
                    <!--<li><a href="{{ route('home') }}">{{ __('text.content2') }}</a></li>-->
                    <!--<li><a href="{{ route('about') }}">{{ __('text.content3') }}</a></li>-->
                    <li><a href="{{ route('business.account') }}">{{ __('text.content73') }}</a></li>
                    <li><a href="{{ route('driver.account') }}">{{ __('text.content74') }}</a></li>
                    <li><a href="{{ route('service') }}">{{ __('text.content4') }}</a></li>
                    <li><a href="{{ route('tracking') }}">{{ __('text.content5') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('text.content6') }}</a></li>
                    <li><a href="{{ route('parcel_booking') }}">{{ __('text.content70') }}</a></li>

                    {{-- <li>
                        <div id="google_translate_element"></div>
                    </li> --}}
                </ul>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 40, 51, 0.8);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3"
                                placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->


        @hasSection('content')
            @yield('content')
        @else
            <h1 style="text-align: center;">Here is no content...</h1>
        @endif


        <!-- Footer Start -->
        <div class="container-fluid text-white footer mt-5 pt-5 wow fadeIn bg-danger" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row gy-5 gx-4 pt-5">
                    <div class="col-12">
                        {{-- <h5 class="fw-bold text-white mb-4">Subscribe Our Newsletter</h5> --}}
                        <h3 class="fw-bold text-white mb-2">{{ __('text.content41') }}</h3>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6">
                                {{-- <h5 class="fw-bold text-white mb-4">About Us</h5> --}}
                                <h5 class="fw-bold text-white mb-4">{{ __('text.content48') }}</h5>
                                {{-- <a class="btn btn-link" href="">About Us</a> --}}
                                <a class="btn btn-link" href="{{ route('about') }}">{{ __('text.content49') }}</a>
                                {{-- <a class="btn btn-link" href="">Privacy Policy</a> --}}
                                <a class="btn btn-link"
                                    href="{{ route('privacy-policy') }}">{{ __('text.content51') }}</a>
                                {{-- <a class="btn btn-link" href="">Terms & Condition</a> --}}
                                <a class="btn btn-link" href="{{ route('terms-condition') }}">{{ __('text.content52') }}</a>
                                {{-- <a class="btn btn-link" href="">Support</a> --}}
                                <a class="btn btn-link" href="{{ route('contact') }}">{{ __('text.content53') }}</a>
                            </div>
                            <div class="col-md-6">
                                {{-- <h5 class="fw-bold text-white mb-4">Our Services</h5> --}}
                                <h5 class="fw-bold text-white mb-4">{{ __('text.content54') }}</h5>
                                {{-- <a class="btn btn-link" href="">Contact Us</a> --}}
                                <a class="btn btn-link" href="{{ route('contact') }}">{{ __('text.content50') }}</a>
                                {{-- <a class="btn btn-link" href="">Domain Register</a> --}}
                                <a class="btn btn-link" href="{{ route('faq') }}">{{ __('text.content55') }}</a>
                                {{-- <a class="btn btn-link" href="">Shared Hosting</a> --}}
                                <a class="btn btn-link" href="">{{ __('text.content56') }}</a>
                                {{-- <a class="btn btn-link" href="">VPS Hosting</a> --}}
                                <a class="btn btn-link" href="">{{ __('text.content57') }}</a>
                                {{-- <a class="btn btn-link" href="">Dedicated Hosting</a> --}}
                                {{-- <a class="btn btn-link" href="">{{ __('text.content58') }}</a> --}}
                                {{-- <a class="btn btn-link" href="">Reseller Hosting</a> --}}
                                {{-- <a class="btn btn-link" href="">{{ __('text.content59') }}</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        {{-- <h5 class="fw-bold text-white mb-4">Get In Touch</h5> --}}
                        <h5 class="fw-bold text-white mb-4">{{ __('text.content60') }}</h5>
                        {{-- <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Dhaka</p> --}}
                        <p class="mb-2 text-white"><i class="fa fa-map-marker-alt me-3"></i>{{ __('text.content61') }}</p>
                        {{-- <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p> --}}
                        <p class="mb-2 text-white"><i class="fa fa-phone-alt me-3"></i>{{ __('text.content62') }}</p>
                        {{-- <p class="mb-2"><i class="fa fa-envelope me-3"></i>quickexpress@gmail.com</p> --}}
                        <p class="mb-2 text-white"><i class="fa fa-envelope me-3"></i>{{ __('text.content63') }}</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-lg-n5 mt-5">
                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                            <h5 class="fw-bold text-white mb-4">{{ __('text.content71') }}</h5>
                            <div class="position-relative" style="max-width:400px;">
                                <input class="form-control bg-white border-0 w-100 py-3 ps-4 pe-5" type="email"
                                    id="email" name="email" placeholder="Enter your email" required>
                                <button type="submit"
                                    class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Subscribe</button>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        {{-- <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy;2024. First Move Logistics Ltd. All Right Reserved. Designed By <a class="border-bottom text-decoration-none"
                                href="https:/mystrix.site">Mystrix</a>
                        </div> --}}
                        <div class="col-lg-12 text-center text-md-start mb-3 mb-md-0">
                            &copy;{{ __('text.content64') }} <a class="border-bottom text-decoration-none"
                                href="https:/mystrix.site">{{ __('text.content65') }}</a>
                        </div>
                        {{-- <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">{{ __('text.content66') }}</a>
                                <a href="">Cookies</a>
                                <a href="">{{ __('text.content67') }}</a>
                                <a href="">Help</a>
                                <a href="">{{ __('text.content68') }}</a>
                                <a href="">FQAs</a>
                                <a href="">{{ __('text.content69') }}</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i
                    class="bi bi-arrow-up"></i></a> --}}
    </div>

    {{-- <script>
        var botmanWidget = {
            // frameEndpoint: '/iFrameUrl'
            title: 'Fast Move Logistics',
            aboutText: 'Webappfix',
            introMessage: 'Hi, welcome to fastest logistics service Fast Move Logistics.'
        };
    </script> --}}
    {{-- <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> --}}


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/lib/wow/wow.min.js"></script>
    <script src="frontend/lib/easing/easing.min.js"></script>
    <script src="frontend/lib/waypoints/waypoints.min.js"></script>
    <script src="frontend/lib/counterup/counterup.min.js"></script>
    <script src="frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="frontend/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        var url = "{{ route('lang.change') }}";
        $('.lang-change').change(function() {
            let lang_code = $(this).val();
            window.location.href = url + "?lang=" + lang_code;
        });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> --}}
    {{-- <script>
        function googleTranslateElementInit() {
            // Create a new instance of TranslateElement
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: 'true',
                includedLanguages: 'hi,en,bn,id,fr,ar',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');
        }
    </script> --}}
    
    <script>
      document.addEventListener("DOMContentLoaded", function() {
    // Check if the current URL is the home directory
    if (window.location.pathname === '/' || window.location.pathname === '/index.html') {
        document.getElementById("popupContainer").style.display = "block";
        setTimeout(function() {
            document.getElementById("popupContainer").style.display = "none";
        }, 3000);
    }
});

function closePopup() {
    document.getElementById("popupContainer").style.display = "none";
}



    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Check if the user has already accepted the cookies
    if (!getCookie("cookiesAccepted")) {
        // If cookies are not accepted, display the pop-up
        document.getElementById("overlay").style.display = "block";
    }
});

// Function to close the pop-up
function closePopup() {
    document.getElementById("overlay").style.display = "none";
}

// Function to set cookies and close the pop-up
function setCookieAndClosePopup() {
    // Set a cookie to indicate that the user has accepted the cookies
    setCookie("cookiesAccepted", "true", 365); // Cookie expires in 365 days
    // Close the pop-up
    closePopup();
}

// Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Function to get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/663bf74907f59932ab3d6ce8/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
