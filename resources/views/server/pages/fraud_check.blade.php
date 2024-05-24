@extends('server.layouts.masterlayout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto col-lg-12 px-3">
            <div class="w-100 bg-white shadow-sm rounded-1 p-4 mb-3 d-flex justify-content-between">
                <div>
                    <h5 class="font-18 text-color-4 mb-0">Recent Fraud Activities </h5>
                </div>
                <div class="d-flex justify-content-between">
                    {{-- <div class="mx-2">
                        <a href="" class="btn btn-sm text-white bg-success">My Entries</a>
                    </div> --}}
                    {{-- <div class="mx-2">
                        <a href="" class="btn btn-sm btn-info">Add New</a>
                    </div> --}}
                    <div class="mx-2">
                        
                        <a href="{{ route('admin.fraud_check_search') }}" class="btn btn-sm btn-warning text-black fw-normal">Check</a>
                    </div>
                </div>
            </div>
            @foreach ($frauds as $fraud)
                <div class="w-100 bg-white rounded-2 mb-3">
                    <div class="w-100 bg-white rounded-2 mb-3">
                        <div class="w-100 rounded-2 shadow-sm">
                            <div class="w-100 bg-white rounded-2 px-2 pt-3 pb-1 font-15">
                                @if ($fraud->pickupman)
                                    <div class="px-3 -2">
                                        <p><strong>Complain ID</strong> : {{ $fraud->id }}</p>
                                        <p><strong>Name of Complaintant</strong> : {{ $fraud->pickupman->pickupman_name }}
                                        </p>
                                        <p><strong>Complaintant Designation</strong> : Pickupman</p>
                                        <p><strong>Merchant Phone</strong> : {{ $fraud->phone_number }}</p>
                                        <p><strong>Merchant Name</strong> : {{ $fraud->disputant_name }}</p>
                                        <p><strong>Complain Details</strong> : {{ $fraud->details }}</p>
                                    </div>
                                @elseif ($fraud->user)
                                    <div class="px-3 -2">
                                        <p><strong>Complain ID</strong> : {{ $fraud->id }}</p>
                                        <p><strong>Name of Complaintant</strong> : {{ $fraud->user->merchant_name }}</p>
                                        <p><strong>Complaintant Designation</strong> : Merchant</p>
                                        <p><strong>Pickupman Phone</strong> : {{ $fraud->phone_number }}</p>
                                        <p><strong>pickupman Name</strong> : {{ $fraud->disputant_name }}</p>
                                        <p><strong>Complain Details</strong> : {{ $fraud->details }}</p>
                                    </div>
                                @elseif($fraud->deliveryman)
                                    <div class="px-3 -2">
                                        <p><strong>Complain ID</strong> : {{ $fraud->id }}</p>
                                        <p><strong>Name of Complaintant</strong> : {{ $fraud->deliveryman->deliveryman_name }}</p>
                                        <p><strong>Complaintant Designation</strong> : Deliveryman</p>
                                        <p><strong>Customer Phone</strong> : {{ $fraud->phone_number }}</p>
                                        <p><strong>Customer Name</strong> : {{ $fraud->disputant_name }}</p>
                                        <p><strong>Complain Details</strong> : {{ $fraud->details }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="w-100 text-end rounded-2 px-2 pb-2">
                                {{-- <span class="d-inline-block text-end font-12 fst-italic">{{ \Carbon\Carbon::parse($fraud->created_at)->timezone('Asia/Dhaka')->format('h A d M Y') }}</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
