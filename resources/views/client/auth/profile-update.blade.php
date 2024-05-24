@extends('marchant.layouts.masterlayout')
@section('content')

<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Profile Update
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
    @if(session('status') == 'profile-information-updated')
        <p><i class="text-success" style="text-align: center">Profile Updated</i></p>
    @endif
    <form action="{{route('user-profile-information.update')}}" class="forms-sample" method="post">
        @csrf
        @method('PUT')
        <br><label for="business_name">Business Name</label>
        <input type="text" class="form-control"
                                    id="exampleInputConfirmPassword2" name="business_name" value="{{auth()->user()->business_name}}">
        @error('business_name')
            {{$message}}
        @enderror

        <br><label for="fname">First Name</label>
        <input type="text" class="form-control"
                                    id="exampleInputConfirmPassword2" name="fname" value="{{auth()->user()->fname}}">
        @error('fname')
            {{$message}}
        @enderror

        <br><label for="lname">Last Name</label>
        <input type="text" class="form-control"
                                    id="exampleInputConfirmPassword2" name="lname" value="{{auth()->user()->lname}}">
        @error('lname')
            {{$message}}
        @enderror

        <br><label for="pick_up_location">Adress of your pick up location</label>
        <input type="text" class="form-control"
                                    id="exampleInputConfirmPassword2" name="pick_up_location" value="{{auth()->user()->pick_up_location}}">
        @error('pick_up_location')
            {{$message}}
        @enderror
        
        <br><label for="phone">Phone number</label>
        <input type="phone" class="form-control"
                                    id="exampleInputConfirmPassword2" name="phone" value="{{auth()->user()->phone}}">
        @error('phone')
            {{$message}}
        @enderror

        <br><label for="email">Email</label>
        <input type="email" class="form-control"
                                    id="exampleInputConfirmPassword2" name="email" value="{{auth()->user()->email}}">
        @error('email')
            {{$message}}
        @enderror

        <button type="submit" class="btn btn-gradient-primary me-2 mt-3">Update</button>
    </form>
                </div>
            </div>
        </div>
    </div>
@endsection