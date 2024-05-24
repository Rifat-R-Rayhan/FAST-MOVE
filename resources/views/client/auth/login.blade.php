<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>First Move</title>



            <!-- Favicon -->
    <link href="/frontend/img/delivery-bike.png" rel="icon">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Include Bootstrap CSS from CDN -->
    
     <link rel="stylesheet" href="/frontend/css/home.css" />
</head>


<style>
 body {
        /* background: hsl(96, 68%, 88%); */
        display: flex;
        flex-direction: column;
        align-items: center;
        background-image: url('/frontend/info/w-3.png');
        background-size: 100% auto;

    }

    .form-box {
        /* height: 450px; */
        background-color: white;
        width: 40%;
        padding: 10px;
        border-radius: 10px;
        position: absolute;
        margin: 150px 0;
        /* top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto; */
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

    }

    @media only screen and (min-width:240px) and (max-width: 800px) {

        .form-box {
            /* height: 450px; */
            background-color: white;
            width: 90%;
        }

        body {
            background: #f5f5f3;
            background-image: url('/frontend/info/w-3.png');
            background-size: cover;
            background-repeat: no-repeat;
        }


    }


</style>



<body>

<div class="container-xxl position-relative p-0 bg-light">
    <div class="second-header navbar navbar-expand-lg px-4 px-lg-5 py-3 " id="second-header">
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

            <div class="nav-bar">
                <ul>
                    {{-- <li><a href="#">Home</a></li> --}}
                    <!--<li><a href="{{ route('home') }}">{{ __('text.content2') }}</a></li>-->
                    {{-- <li><a href="#">About</a></li> --}}
                    <!--<li><a href="{{ route('about') }}">{{ __('text.content3') }}</a></li>-->
                    <li><a href="{{ route('business.account') }}">{{ __('text.content73') }}</a></li>
                    <li><a href="{{ route('driver.account') }}">{{ __('text.content74') }}</a></li>
                    {{-- <li><a href="#">Services</a></li> --}}
                    <li><a href="{{ route('service') }}">{{ __('text.content4') }}</a></li>
                    {{-- <li><a href="#">Tracking</a></li> --}}
                    <li><a href="{{ route('tracking') }}">{{ __('text.content5') }}</a></li>
                    {{-- <li><a href="#">Contact</a></li> --}}
                    <li><a href="{{ route('contact') }}">{{ __('text.content6') }}</a></li>
                    <li><a href="{{ route('parcel_booking') }}">{{ __('text.content70') }}</a></li>

                    {{-- <li>
                        <div id="google_translate_element"></div>
                    </li> --}}
                </ul>
            </div>

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
                            <li><a href="{{ route('home') }}">{{ __('text.content2') }}</a></li>
                            {{-- <li><a href="#">About</a></li> --}}
                            <li><a href="{{ route('about') }}">{{ __('text.content3') }}</a></li>
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
</div>
    
<div class="form-box">
    <div class="text-center mt-3">
        <img src="/frontend/img/delivery-bike.png"
                style="width: 120px; height:50px;" alt="logo" />
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h5 class="text-center mb-2 mt-3">Merchant Login Here</h5>

 

    <form action="{{route('login')}}" method="post" class="text-center p-2 d-flex">
        @csrf

        <div class="w-100 p-3 left text-black text-center">
            
                <input type="email" class="form-control mb-3" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                    {{$message}}
                @enderror
        
                <input type="password" class="form-control mb-3" name="password" placeholder="Password">
                @error('password')
                    {{$message}}
                @enderror
        
                <button class="btn btn-dark" type="submit">Login</button>
        
                <a class="text-decoration-none d-block mt-2" href="{{route('password.request')}}">Forgot password?</a>
            </form>
            
    
        </div>



    
      
    </form>
    
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>

