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
                        </span> Delete Account
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
    <form action="{{route('password.confirm')}}" class="forms-sample" method="post">
        @csrf

        <br><label for="password">Password</label>
        <input type="password" class="form-control"
        id="exampleInputConfirmPassword2" name="password">
        @error('password')
            {{$message}}
        @enderror

        <br><button type="submit" class="btn btn-gradient-primary me-2 mt-3">Continue</button>
    </form>
</div>
</div>
</div>
</div>
@endsection