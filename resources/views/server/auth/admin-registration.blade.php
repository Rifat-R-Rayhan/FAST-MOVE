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
                        </span> Add Admin
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <form action="{{route('admin.store')}}" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="admin_name" value="{{old('admin_name')}}" placeholder="Admin Name">
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('admin_name')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Designation</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" name="designation" value="{{old('designation')}}" placeholder="Designation">
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('designation')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" name="phone" value="{{old('phone')}}" placeholder="Phone Number">
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('phone')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('email')
                                {{$message}}
                            @enderror
                    </span>
                    
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('password')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('password_confirmation')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('address')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option disabled selected>Select Admin Role</option>
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('role')
                                {{$message}}
                            @enderror
                    </span>

                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Profile Photo</label>
                        <div class="col-sm-9">
                            <input name="profile_img" type="file" id="emailWithTitle" class="form-control" data-fouc/>
                        </div>
                    </div>
                    <span class="text-danger mb-3 d-block">
                        @error('profile_img')
                                {{$message}}
                            @enderror
                    </span>

                    <button type="submit" class="btn btn-gradient-primary me-2">Add</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection