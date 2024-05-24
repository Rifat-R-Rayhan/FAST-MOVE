@extends('deliveryman.layouts.masterlayout')
@section('content')
<div class="row">
    <div class="col-xl-8 mx-auto col-lg-12 px-3">
        <div class="w-100 bg-white shadow-sm rounded-1 p-4 mb-3 d-flex justify-content-between">
            <div>
                <h5 class="font-18 text-color-4 mb-0">Recent Fraud Activities </h5>
            </div>
            <div class="d-flex justify-content-between">
                <div class="mx-2">
                    <a href="{{ route('deliveryman.fraud_myentries') }}" class="btn btn-sm text-white bg-success">My Entries</a>
                </div>
                <div class="mx-2">
                    <a href="{{ route('deliveryman.fraud_add_new') }}" class="btn btn-sm btn-info">Add New</a>
                </div>
                <div class="mx-2">
                    <a href="{{ route('deliveryman.fraud_check_search') }}"
                        class="btn btn-sm btn-warning text-black fw-normal">Check</a>
                </div>
            </div>
        </div>
        @foreach ($formattedFrauds as $fraud)
            <div class="w-100 bg-white rounded-2 mb-3">
                <div class="w-100 bg-white rounded-2 mb-3">
                    <div class="w-100 rounded-2 shadow-sm">
                        <div class="w-100 bg-white rounded-2 px-2 pt-3 pb-1 font-15">
                            <div class="px-3 -2">
                                <p><strong>Phone</strong> : <strong>{{ $fraud->formattedPhoneNumber  }}</strong></p>
                                {{-- <p>Name: {{ $fraud->disputant_name }}</p> --}}
                                <p><strong>Complain Details</strong> : {{ $fraud->details }}</p>
                            </div>
                        </div>
                        <div class="w-100 text-end rounded-2 px-2 pb-2">
                            <span class="d-inline-block text-end font-12 fst-italic">{{ \Carbon\Carbon::parse($fraud->created_at)->timezone('Asia/Dhaka')->format('h A d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection