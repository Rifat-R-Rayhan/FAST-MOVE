@extends('server.layouts.masterlayout')

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
                            </span> Update Parcel Delivery
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
                    
                    <form action="{{route('admin.delivery.update')}}" class="forms-sample" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$delivery->id}}">
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                                    value="{{$delivery->name}}">
                            </div>
                        </div>
                        {{-- <input type="hidden" name="order_tracking_id" value="{{ $delivery->numericValue }}">
                        <input type="hidden" name="user_id" value="{{ $delivery->id }}"> --}}
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control" id="exampleInputMobile"
                                value="{{ $delivery->phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputPassword2"
                                    value="{{ $delivery->address }}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
                                <option selected value="{{ $delivery->divisions }}">{{ $delivery->divisions }}</option>
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
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();">
                                <option selected value="{{ $delivery->district }}">{{ $delivery->district }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Police Station</label>
                            <select name="police_station" class="form-control" id="polic_sta">
                                <option selected value="{{ $delivery->police_station }}">{{ $delivery->police_station }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Category Type</label>
                            <select name="category_type" class="form-control" id="category">
                                <option selected value="{{ $delivery->category_type }}">{{ $delivery->category_type }}</option>
                                <option value="Regular">Regular</option>
                                <option value="Document">Document</option>
                                <option value="Book">Book</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Delevery Type</label>
                            <select name="delivery_type" class="form-control" id="delivery">
                                <option selected value="{{ $delivery->delivery_type }}">{{ $delivery->delivery_type }}</option>
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
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" name="weight" class="form-control"
                                    id="exampleInputConfirmPassword2" value="{{ $delivery->weight }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Exchange Parcel</label>
                            <select name="exchange_parcel" class="form-control" id="category">
                                <option value="{{ $delivery->exchange_parcel }}" selected>{{ $delivery->exchange_parcel }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../marchant/js/address.js"></script>
@endsection







