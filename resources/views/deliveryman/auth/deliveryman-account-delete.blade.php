@extends('deliveryman.layouts.masterlayout')
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
                        </span> Delete Account Permanently
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <form action="{{route('deliveryman.delete.account')}}" class="forms-sample" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Your Password">
                            @error('password')
                                {{$message}}
                            @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Delete Account</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection