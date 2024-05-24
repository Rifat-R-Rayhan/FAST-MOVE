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
                        </span> Password Update
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
    @if(session('status') == 'password-updated')
        <p><i class="text-success" style="text-align: center">Password Updated</i></p>
    @endif
    <form action="{{route('user-password.update')}}" class="forms-sample" method="post">
        @csrf
        @method('PUT')

        <br><label for="current_password">Current Password</label>
        <input type="password" class="form-control"
        id="exampleInputConfirmPassword2" name="current_password">
        @error('current_password')
            {{$message}}
        @enderror

        <br><label for="password">Password</label>
        <input type="password" class="form-control"
        id="exampleInputConfirmPassword2" name="password">
        @error('password')
            {{$message}}
        @enderror

        <br><label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control"
        id="exampleInputConfirmPassword2" name="password_confirmation">
        @error('password_confirmation')
            {{$message}}
        @enderror

        <br><button type="submit" class="btn btn-gradient-primary me-2 mt-3">Change Password</button>
    </form>

</div>
</div>
</div>
</div>
@endsection