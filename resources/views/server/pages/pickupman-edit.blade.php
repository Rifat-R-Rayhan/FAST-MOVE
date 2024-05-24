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
                            </span> Update Parcel Pickup Man
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <form action="{{ route('pickup.update', $pickup->id) }}" class="forms-sample" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                                    placeholder="Name" value="{{ $pickup->name }}">
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleFormControlSelect2">Merchant Name</label>
                            <select name="user_id" class="form-control" id="user_id">
                                @foreach ($pickup->user as $user)
                                        <option value="{{$pickup->user->id}}" >{{$pickup->user->fname}} {{$pickup->user->lname}}</option>
                                    @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control" id="exampleInputMobile"
                                    placeholder="Mobile number" value="{{ $pickup->phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alternative Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="alt_phone" class="form-control" id="exampleInputMobile"
                                    placeholder="Alternative Mobile number" value="{{ $pickup->alt_phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="exampleInputMobile"
                                    placeholder="Email" value="{{ $pickup->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputPassword2"
                                    placeholder="Address" value="{{ $pickup->address }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
                                <option value="{{$pickup->divisions}}"disabled selected>{{$pickup->divisions}}</option>
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
                            <label for="distr">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();">
                                <option value="{{ $pickup->district }}" selected>{{ $pickup->district }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="polic_sta">Select Police Station</label>
                            <select name="ps" class="form-control" id="polic_sta">
                                <option value="{{ $pickup->ps }}" selected>{{ $pickup->ps }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Save Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../marchant/js/address.js"></script>
@endsection
