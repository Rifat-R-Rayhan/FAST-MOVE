@extends('server.layouts.masterlayout')
@section('content')

<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="card-title">Edit About </h4>

        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">About Content</label>
                <textarea class="form-control" id="content" name="content" rows="10">{{ $aboutContent }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update About </button>
        </form>
    </div>
</div>

@endsection
