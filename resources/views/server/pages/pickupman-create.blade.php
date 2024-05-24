@extends('server.layouts.masterlayout')

@section('content')

    <div class="row">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Add Parcel Pickup Man
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <form action="{{ route('pickup.store') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                                    placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Merchant Name</label>
                            <select name="user_id" class="form-control" id="user_id">
                                @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                            </select>
                            @error('user_id')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control" id="exampleInputMobile"
                                    placeholder="Mobile number" value="{{ old('phone') }}">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alternative Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="alt_phone" class="form-control" id="exampleInputMobile"
                                    placeholder="Alternative Mobile number" value="{{ old('alt_phone') }}">
                                @error('alt_phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="exampleInputMobile"
                                    placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputPassword2"
                                    placeholder="Address" value="{{ old('address') }}">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
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
                            @error('divisions')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="distr">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();"></select>
                            @error('district')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="polic_sta">Select Police Station</label>
                            <select name="ps" class="form-control" id="polic_sta"></select>
                            @error('ps')
                                {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../marchant/js/address.js"></script>
@endsection
