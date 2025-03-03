@extends('client.layouts.masterlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        <div class="page-header">
                            <h3 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="mdi mdi-home"></i>
                                </span> Add Parcel Delivery
                            </h3>
                        </div>

                        <form action="{{ route('post.parcel_booking') }}" class="forms-sample" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Your Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="local_user_name" class="form-control"
                                        id="exampleInputLocalUserName" placeholder="Your Name"
                                        value="{{ old('local_user_name') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('local_user_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Your Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="local_user_contact" class="form-control"
                                        id="exampleInputLocalUserContact" placeholder="Your Phone Number"
                                        value="{{ old('local_user_contact') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('local_user_contact')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Your Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="local_user_email" class="form-control"
                                        id="exampleInputLocalUserEmail" placeholder="Your Email"
                                        value="{{ old('local_user_email') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('local_user_email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Your Full Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="local_user_address" class="form-control"
                                        id="exampleInputLocalUserAddress" placeholder="Your Full Address"
                                        value="{{ old('local_user_address') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('local_user_address')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Hub</label>
                                <select name="hub_id" class="form-control" id="hub">
                                    <option disabled selected>Select Hub</option>
                                    @foreach ($hubs as $hub)
                                        <option value="{{ $hub->id }}">{{ $hub->hub_address }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('hub_id')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Parcel Product Category</label>
                                <select name="product_category" class="form-control" id="product_category">
                                    <option disabled selected>Select Parcel Product Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Document">Document</option>
                                    <option value="Book">Book</option>
                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('product_category')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Customer Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="customer_name" class="form-control" id="exampleInputEmail2"
                                        placeholder="Customer Name" value="{{ old('customer_name') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('customer_name')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="hidden" name="order_tracking_id" value="{{ $numericValue }}">
                            <input type="hidden" name="user_id" value="{{ $id }}">
                            <input type="hidden" name="invoice" value="{{ $uniqueValue }}">

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Customer Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="customer_phone" class="form-control" id="exampleInputMobile"
                                        placeholder="Mobile number" value="{{ old('customer_phone') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('customer_phone')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputEmail" class="col-sm-3 col-form-label">Customer Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="customer_email" class="form-control"
                                        id="exampleInputEmail" placeholder="Customer Email"
                                        value="{{ old('customer_email') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('customer_email')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Customer
                                    Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_address" class="form-control"
                                        id="exampleInputPassword2" placeholder="Customer Address"
                                        value="{{ old('full_address') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('full_address')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select Division</label>
                                <select name="divisions" class="form-control" id="divisions"
                                    onchange="divisionsList();">
                                    <option disabled selected>Select Division</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('divisions')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select District</label>
                                <select name="district" class="form-control" id="distr" onchange="thanaList();">
                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('district')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select Police Station</label>
                                <select name="police_station" class="form-control" id="polic_sta">

                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('police_station')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Parcel Delevery Type</label>
                                <select name="delivery_type" class="form-control" id="delivery">
                                    <option disabled selected>Parcel Delevery Type</option>
                                    <option value="drop">Drop</option>
                                    <option value="pickup and drop">Pickup & Drop</option>
                                </select>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('delivery_type')
                                    {{ $message }}
                                @enderror
                            </span>

                            {{-- <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" name="invoice" class="form-control"
                                        id="exampleInputConfirmPassword2" placeholder="Invoice"
                                        value="{{ old('invoice') }}">
                                </div>
                            </div> --}}
                            <span class="text-danger mb-3 d-block">
                                @error('invoice')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Note</label>
                                <div class="col-sm-9">
                                    <input type="text" name="note" class="form-control"
                                        id="exampleInputConfirmPassword2" placeholder="Write Note..."
                                        value="{{ old('note') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('note')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Product
                                    Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cod_amount" class="form-control" id="cod_amount"
                                        placeholder="Product Price" value="{{ old('cod_amount') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('cod_amount')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Product
                                    Weight</label>
                                <div class="col-sm-9">
                                    <input type="text" name="product_weight" class="form-control" id="product_weight"
                                        placeholder="Product Weight/KG" value="{{ old('product_weight') }}">
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('product_weight')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Exchange Status</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="exchange_status"
                                                    id="membershipRadios1" value="Yes"> Yes </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="exchange_status"
                                                    id="membershipRadios2" value="No"> No </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('exchange_status')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Delivery
                                    Charge</label>
                                <div class="col-sm-9">
                                    <input type="text" name="delivery_charge" class="form-control"
                                        id="delivery_charge" placeholder="Delivery Charge"
                                        value="{{ old('delivery_charge') }}" readonly>
                                </div>
                                {{-- <div class="col-sm-3">
                                    <div class="loading-icon d-none" id="loading_icon"><i class="fas fa-spinner fa-spin"></i>
                                        Loading...</div>
                                </div> --}}
                            </div>
                            <span class="text-danger mb-3 d-block">
                                @error('delivery_charge')
                                    {{ $message }}
                                @enderror
                            </span>

                            <button type="submit" class="btn-grp orange-color">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../marchant/js/address.js"></script>

    {{-- <script>
        $(document).ready(function() {
            var delivery_charge = $('#delivery_charge');
    
            $('#divisions,#distr, #product_weight, #delivery').on('input', function() {
                var from_location = $('#divisions').val();
                var destination = $('#distr').val();
                var productWeight = parseFloat($('#product_weight').val()) || 1;
                var delivery_type = $('#delivery').val();
                delivery_charge.val('');
    
                $.ajax({
                    type: 'GET',
                    url: '{{ route('percel_delivery_charge') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'from_location': from_location,
                        'destination': destination,
                        'product_weight': productWeight,
                        'delivery_type': delivery_type
                    },
                    success: function(response) {
                        if (response.deliveryCharge && response.deliveryCharge.cost !== undefined) {
                            delivery_charge.val(response.deliveryCharge.cost);
                        } else {
                            delivery_charge.val('Not Available');
                        }
                    },
                    error: function(error) {
                        //alert('We have no delivery work for this place');
                        console.log('okey');
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var delivery_charge = $('#delivery_charge');

            $('#divisions,#distr, #product_weight, #delivery').on('input', function() {
                var from_location = $('#divisions').val();
                var destination = $('#distr').val();
                var productWeight = parseFloat($('#product_weight').val()) || 1;
                var delivery_type = $('#delivery').val();
                delivery_charge.val('');
                if (from_location && destination) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('percel_delivery_charge') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'from_location': from_location,
                            'destination': destination,
                            'product_weight': productWeight,
                            'delivery_type': delivery_type
                        },
                        success: function(response) {
                            if (response.deliveryCharge && response.deliveryCharge.cost !==
                                undefined) {
                                delivery_charge.val(response.deliveryCharge.cost);
                            } else {
                                delivery_charge.val('Not Available');
                            }
                        },
                        error: function(error) {
                            alert('We have no delivery work for this place');
                        }
                    });
                }
            });
        });
    </script>
@endsection
