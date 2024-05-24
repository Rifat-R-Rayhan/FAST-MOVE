@extends('server.layouts.masterlayout')
@section('content')

<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="card-title">Edit Privacy Policy </h4>

        <form action="{{ route('admin.privacy.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Privacy Policy Content</label>
                <textarea class="form-control" id="content" name="content" rows="10">{{ $privacyContent }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Privacy Policy </button>
        </form>
    </div>
</div>

@endsection
