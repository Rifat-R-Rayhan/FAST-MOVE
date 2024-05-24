@extends('client.layouts.masterlayout')
@section('content')
<div class="container-xxl py-5 bg-danger hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 pt-5">
            <div class="col-12 text-center text-lg-start">
                {{-- <h1 class="display-4 text-white animated slideInLeft">TRACK YOUR CONSIGNMENT</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start animated slideInLeft">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Domain</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
    </div>
</div>
<!-- Full Screen Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(29, 40, 51, 0.8);">
            <div class="modal-header border-0">
                <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <div class="input-group" style="max-width: 600px;">
                    <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                    <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Full Screen Search End -->


<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Contact For Any Query</h1>
            <p class="mb-1">Fast Move Logistics support you 24/7</p>
        </div>
        <div class="row g-5">
            {{-- <div class="col-lg-7 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-warning w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="section-title position-relative mx-auto mb-4 pb-4">
                    <h3 class="fw-bold mb-0">Customer Support</h3>
                </div>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-danger me-3"></i>1068/2 Kathaltala Panir Pump, Purba Monipur, Mirpur-2, Dhaka, BD</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-danger me-3"></i>+880-1913-830996</p>
                <p class="mb-2"><i class="fa fa-envelope text-danger me-3"></i>fastmoveinfo@gmail.com</p>
                <div class="border rounded text-center p-4 mt-4">
                    <h3 class="fw-bold mb-4">Need Any Help?</h3>
                    <a class="btn btn-danger py-3 px-5" href="">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- ======= Map Section ======= -->
        <section class="col-lg-12">

            <center>
                <h3>Our Office</h3>
            </center>
    
            <center class="p-5 col-lg-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7301.090672979241!2d90.36009003968007!3d23.79919961454825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s1068%2F2%20Kathaltola%20Panirpamp!5e0!3m2!1sen!2sbd!4v1714459419613!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </center>
        </section>
@endsection