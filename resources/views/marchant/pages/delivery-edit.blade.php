@extends('marchant.layouts.masterlayout')

@section('content')
    <div class="row">
        <div class="col-md-9 grid-margin stretch-card">
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
                            </span> Update Product Delivery Details
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    
                    <form action="{{route('product.update', $product->id)}}" class="forms-sample" method="post">
                        @csrf
                        @method ('PUT')

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Product Category</label>
                            <select name="product_category" class="form-control" id="category">
                                <option value="{{ $delivery->product_category }}" disabled selected>{{ $delivery->product_category }}</option>
                                <option value="Regular">Regular</option>
                                <option value="Document">Document</option>
                                <option value="Book">Book</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="customer_name" class="form-control" id="exampleInputEmail2"
                                    value="{{$delivery->customer_name}}">
                            </div>
                        </div>
                        {{-- <input type="hidden" name="order_tracking_id" value="{{ $delivery->numericValue }}">
                        <input type="hidden" name="user_id" value="{{ $delivery->id }}"> --}}
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="customer_phone" class="form-control" id="exampleInputMobile"
                                value="{{ $delivery->customer_phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="full_address" class="form-control" id="exampleInputPassword2"
                                    value="{{ $delivery->full_address }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input type="text" name="divisions" class="form-control" id="exampleInputPassword2"
                                    value="{{ $delivery->divisions }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                                <input type="text" name="district" class="form-control" id="exampleInputPassword2"
                                    value="{{ $delivery->district }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Police Station</label>
                            <div class="col-sm-9">
                                <input type="text" name="police_station" class="form-control" id="exampleInputPassword2"
                                    value="{{ $delivery->police_station }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Delevery Type</label>
                            <select name="delivery_type" class="form-control" id="delivery">
                                <option value="{{ $delivery->delivery_type }}" disabled selected>{{ $delivery->delivery_type }}</option>
                                <option value="Drop">Drop</option>
                                <option value="Pickup & Drop">Pickup & Drop</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">COD Amount</label>
                            <div class="col-sm-9">
                                <input type="text" name="cod_amount" class="form-control"
                                    id="exampleInputConfirmPassword2"
                                    value="{{ $delivery->cod_amount }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Invoice</label>
                            <div class="col-sm-9">
                                <input type="text" name="invoice" class="form-control"
                                    id="exampleInputConfirmPassword2"
                                    value="{{ $delivery->invoice }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <input type="text" name="note" class="form-control"
                                    id="exampleInputConfirmPassword2" value="{{ $delivery->note }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Product Weight</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_weight" class="form-control"
                                    id="exampleInputConfirmPassword2" value="{{ $delivery->product_weight }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Exchange Status</label>
                            <select name="exchange_parcel" class="form-control" id="category">
                                <option value="{{ $delivery->exchange_status }}" disabled selected>{{ $delivery->exchange_status }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Exchange Parcel</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="exchange"
                                                id="membershipRadios1" value="Yes"> Yes </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="exchange"
                                                id="membershipRadios2" value="No"> No </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../marchant/js/address.js"></script>
@endsection







