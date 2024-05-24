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
                            </span> Create News
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <form action="{{route('admin.post.news')}}" class="forms-sample" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">News Headline</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="exampleInputEmail2"
                                    placeholder="News Headline" value="{{ old('title') }}">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">News Content</label>
                            <div class="col-sm-9">
                                <input type="text" name="content" class="form-control" id="exampleInputMobile"
                                    placeholder="News Content" value="{{ old('content') }}">
                                @error('content')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input name="news_image" type="file" id="emailWithTitle" class="form-control" data-fouc/>
                            </div>
                        </div>
                        <span class="text-danger mb-3 d-block">
                            @error('news_image')
                                    {{$message}}
                                @enderror
                        </span>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
