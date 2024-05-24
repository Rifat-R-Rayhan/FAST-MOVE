@extends('client.layouts.masterlayout')
@section('content')
<div class="container-xxl py-5 bg-danger hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 pt-5">
            <div class="col-12 text-center text-lg-start">
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title position-relative mb-4 pb-4">
                    <h1 class="mb-2">{{ __('text.content24') }}</h1>
                </div>
                    <p class="mb-4">{{ __('text.content25') }}</p>
                <div class="row g-3">
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-users-cog fa-2x text-danger mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">70</h2>
                            <p class="mb-0">{{ __('text.content26') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-users fa-2x text-danger mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">234</h2>
                            <p class="mb-0">{{ __('text.content27') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-check fa-2x text-danger mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">2647</h2>
                            <p class="mb-0">{{ __('text.content28') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <img class="img-fluid wow zoomIn" width="900px" data-wow-delay="0.5s" src="/frontend/info/c4.jpg">
            </div>
        </div>
    </div>
</div>
@endsection