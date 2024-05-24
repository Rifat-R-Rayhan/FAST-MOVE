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
                            </span> Update Delivery Charge
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
                    <form action="{{ route('deliverycharge.update', $deliverycharge->id) }}" class="forms-sample" method="post">
                        @csrf
                        {{ dd($deliverycharge->id) }}
                        @method('PUT')

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputEmail2" name="from_location"
                                    value="{{$deliverycharge->from_location}}" placeholder="Write The From Location Name">
                                @error('from_location')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="destination"
                                    value="{{$deliverycharge->destination}}" placeholder="Write The Destination Location Name">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Category</label>
                            <select name="category" class="form-control" id="category">
                                <option value="{{$deliverycharge->category}}" disabled selected>{{$deliverycharge->category}}</option>
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
                                <option value="{{$deliverycharge->delivery_type}}" disabled selected>{{$deliverycharge->delivery_type}}</option>
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
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Delivery Cost/KG</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-black" name="cost"
                                    value="{{$deliverycharge->cost}}">
                                @error('cost')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>







    {{-- 

<h1>Update Delivery Charge</h1>
    <form action="{{route('calculator.update', $calculator->id)}}" method="post">
        @csrf
        @method ('PUT')
        <br><label for="from">From</label>
        <input type="text" name="from" value="{{$calculator->from}}">

        <br><label for="destination">Destinationn</label>
        <input type="text" name="destination" value="{{$calculator->destination}}">

        <br><label for="category">Category</label>
        <input type="text" name="category" value="{{$calculator->category}}">

        <br><label for="service">Service</label>
        <input type="text" name="service" value="{{$calculator->service}}">
        
        <br><label for="weight">Weight</label>
        <input type="text" name="weight" value="{{$calculator->weight}}">

        <br><label for="price">Price</label>
        <input type="text" name="price" value="{{$calculator->price}}">

        <br><button type="submit">Update</button>
    </form> --}}
@endsection
