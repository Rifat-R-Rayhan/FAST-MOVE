{{-- @extends('client.layouts.masterlayout')
@section('content') --}}

<h1>Resend Password</h1>
    <form action="{{route('password.update')}}" method="post">
        @csrf

        <br><label for="email">Email</label>
        <input type="email" name="email" value="{{$request->email}}">
        @error('email')
            {{$message}}
        @enderror

        <br><label for="password">Password</label>
        <input type="password" name="password">
        @error('password')
            {{$message}}
        @enderror

        <br><label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation">
        @error('password_confirmation')
            {{$message}}
        @enderror

        <input type="hidden" name="token"  value="{{request()->route('token')}}">

        <br><button type="submit">Reset Password</button>
    </form>
{{-- @endsection --}}