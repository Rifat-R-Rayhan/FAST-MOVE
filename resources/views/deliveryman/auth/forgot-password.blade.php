<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fast Move</title>



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




    <link href="/frontend/img/delivery-bike.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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


<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0 bg-light">
    <nav class="navbar navbar-expand-lg px-4 px-lg-5 py-3 ">
        <a href="" class="navbar-brand p-0">
            <h2 class="m-0"><img src="/frontend/img/delivery-bike.png" width="60">Fast Move</h2>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                        <a href="{{ route('service') }}" class="nav-item nav-link">Services</a>
                        <a href="{{route('tracking')}}" class="nav-item nav-link">Tracking</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal"
                data-bs-target="#searchModal"><i class="fa fa-search"></i></button>

            {{-- <a href="{{ route('register') }}" class="btn btn-dark py-2 px-4 ms-3">Register</a>
            <a href="{{ route('login') }}" class="btn btn-dark py-2 px-4 ms-3">Login</a> --}}


        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->


    <div class="form-box">
        <div class="text-center mt-3">
            <img src="/frontend/img/delivery-bike.png" style="width: 120px; height:50px" alt="logo" />
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <h5 class="text-center mb-3
        mt-3">Forgot Password!</h5>



        <form action="{{ route('deliveryman.forgot.password.post') }}" method="post" class="text-center p-2 d-flex">
            @csrf

            <div class="w-100 p-3 left text-black text-center">
                <input type="email" class="form-control mb-3" name="email"
                    placeholder="Email">

                <button class="btn btn-dark" type="submit">Send Password Reset Link</button>
            </div>
        </form>


    </div>





    </form>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>

