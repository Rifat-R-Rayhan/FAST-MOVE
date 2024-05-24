<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8"> <!-- Specifies the character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Makes the webpage responsive on mobile devices -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Ensures proper rendering and compatibility with Internet Explorer -->

    <!-- Title -->
    <title>Fast Move</title>
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

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Sets the background color of the body */
        }
        .form-box {
            background-color: white; /* Sets the background color of the form box */
            border-radius: 10px; /* Adds rounded corners to the form box */
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; /* Adds shadow effect to the form box */
            padding: 20px; /* Adds padding inside the form box */
        }
    </style>
</head>
<body>
    
    <div class="second-header" id="second-header">
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

<!-- Container -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-box">
                <div class="text-center">
                    <img src="/frontend/img/delivery-bike.png" style="width: 70px" alt="logo" /> 
                </div>
                <h2 class="text-center mb-3">Become a Delivery Man</h2>
                <form action="{{route('deliveryman.store')}}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="mb-3"> 
                                <input type="text" class="form-control" name="deliveryman_name" value="{{ old('deliveryman_name') }}" placeholder="Deliveryman Name"> 
                                @error('deliveryman_name') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"> 
                                @error('phone') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <input type="phone" class="form-control" name="alt_phone" value="{{ old('alt_phone') }}" placeholder="Alternative Phone Number"> 
                                @error('alt_phone') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"> 
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password"> 
                                @error('password') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"> 
                                @error('password_confirmation') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <input type="text" class="form-control" name="full_address" value="{{ old('full_address') }}" placeholder="Address"> 
                                @error('full_address') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6"> 
                             <div class="mb-3">
                                <select class="form-select" name="division" id="divisions" onchange="divisionsList();">
                                    <option selected disabled>Select Division</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                                @error('division')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="district" id="distr" onchange="thanaList();">
                                    <option selected disabled>Select District</option>
                                    <!-- Options will be added dynamically based on the selected division -->
                                </select>
                                @error('district')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="police_station" id="polic_sta">
                                    <option selected disabled>Select Police Station</option>
                                    <!-- Options will be added dynamically based on the selected district -->
                                </select>
                                @error('police_station')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <label for="profile_img" class="form-label">Profile Photo</label> 
                                <input type="file" class="form-control" id="profile_img" name="profile_img"> 
                                @error('profile_img') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <label for="nid_front" class="form-label">NID Front</label>
                                <input type="file" class="form-control" id="nid_front" name="nid_front">
                                @error('nid_front') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3"> 
                                <label for="nid_back" class="form-label">NID Back</label>
                                <input type="file" class="form-control" id="nid_back" name="nid_back"> 
                                @error('nid_back') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> <!-- Include Bootstrap JS from CDN -->

<script src="../marchant/js/address.js"></script>

</body>
</html>
