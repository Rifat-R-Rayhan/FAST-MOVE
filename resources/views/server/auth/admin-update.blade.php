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
                        </span> Update Admin
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <form action="{{route('admin.update')}}" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$admin->id}}">
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="admin_name" value="{{$admin->admin_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Designation</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" name="designation" value="{{$admin->designation}}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" name="phone" value="{{$admin->phone}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" value="{{$admin->email}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" value="{{$admin->address}}">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="{{$admin->role}}">{{$admin->role}}</option>
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Profile</label>
                            <input name="profile_img" type="file" class="file-input">
                            <img src="{{asset('admins/profile_images')}}/{{$admin->profile_img}}" style="width:100px;height:100px">
                            <input name="oldimage" type="hidden" class="form-control" value="{{$admin->profile_img}}">
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