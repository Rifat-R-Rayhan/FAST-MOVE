@extends('pickupman.layouts.masterlayout')
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
                        </span> Update Pickupman
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <form action="{{route('pickupman.update')}}" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$pickupman->id}}">
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Pickupman Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="pickupman_name" value="{{$pickupman->pickupman_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Phone No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" name="phone" value="{{$pickupman->phone}}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alternative Phone No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" name="alt_phone" value="{{$pickupman->alt_phone}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" value="{{$pickupman->email}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Full Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="full_address" value="{{$pickupman->full_address}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="division" value="{{$pickupman->division}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">District</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="district" value="{{$pickupman->district}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Police Station</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="police_station" value="{{$pickupman->police_station}}">

                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Profile Photo</label>
                            <input name="profile_img" type="file" class="file-input">
                            <img src="{{asset('pickupmen/profile_images')}}/{{$pickupman->profile_img}}" style="width:100px;height:100px">
                            <input name="oldimage" type="hidden" class="form-control" value="{{$pickupman->profile_img}}">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">NID Front</label>
                            <input name="nid_front" type="file" class="file-input">
                            <img src="{{asset('pickupmen/nid_images')}}/{{$pickupman->nid_front}}" style="width:100px;height:100px">
                            <input name="oldimage" type="hidden" class="form-control" value="{{$pickupman->nid_front}}">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">NID Back</label>
                            <input name="nid_back" type="file" class="file-input">
                            <img src="{{asset('pickupmen/nid_images')}}/{{$pickupman->nid_back}}" style="width:100px;height:100px">
                            <input name="oldimage" type="hidden" class="form-control" value="{{$pickupman->nid_back}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Save Change</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection