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
                            </span> Add Delivery Charge
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
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                            role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="fw-bold" data-bs-dismiss="alert" aria-label="Close">X</button>
                        </div>
                    @endif

                    <form action="{{ route('storeDeliveryCharge') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputEmail2" name="from_location"
                                    value="{{ old('from_location') }}" placeholder="Write The From Location Name">
                            </div>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('from_location')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="destination"
                                    value="{{ old('destination') }}" placeholder="Write The Destination Location Name">
                            </div>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('destination')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Category</label>
                            <select name="category" class="form-control" id="category">
                                <option disabled selected>Select Category</option>
                                <option value="Regular">Regular</option>
                                <option value="Document">Document</option>
                                <option value="Book">Book</option>
                            </select>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Delevery Type</label>
                            <select name="delivery_type" class="form-control" id="delivery">
                                <option disabled selected>Delevery Type</option>
                                <option value="drop">Drop</option>
                                <option value="pickup and drop">Pickup & Drop</option>
                            </select>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('delivery_type')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Cost</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="cost"
                                    value="{{ old('cost') }}" placeholder="Write Delivery Cost/KG">
                            </div>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('cost')
                                {{ $message }}
                            @enderror
                        </span>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
