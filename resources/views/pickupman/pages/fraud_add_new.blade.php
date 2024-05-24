@extends('pickupman.layouts.masterlayout')
@section('content')
<div class="row p-xl-0 p-md-0">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 bg-white rounded p-4">
                    <h5 class="text-color-5 px-3 font-20 fw-bold">Entry Fraudulent Activity
                        <a href="{{ route('pickupman.fraud_check') }}" class="btn btn-sm btn-info">View All</a>
                    </h5>
                    <hr>
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                            role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="fw-bold" data-bs-dismiss="alert" aria-label="Close">X</button>
                        </div>
                    @endif
                    <div class="tab-content p-3">
                        <div class="tab-pane d-block">
                            <div class="col-12">
                                <div class="d-flex justify-content-start">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="POST" action="{{ route('pickupman.fraud_add_new_insert') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $pickupman->id }}">
                                        <div class="form-group row mb-0">
                                            <label for="phone"
                                                class="col-md-4 col-form-label text-color-5 font-14">Phone no. of
                                                Disputant</label>
                                            <div class="col-md-8 ">
                                                <input type="text" id="phone" name="phone_number" value=""
                                                    placeholder="Write the accused person's number" required="required"
                                                    class="form-control font-20 text-color-5">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-color-5 font-14">Name of
                                                Disputant</label>
                                            <div class="col-md-8">
                                                <input type="text" id="name" name="disputant_name"
                                                    value="" placeholder="Write the accused person's name"
                                                    required="required" class="form-control font-15 text-color-5">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="details"
                                                class="col-md-4 col-form-label text-color-5 font-14">Details</label>
                                            <div class="col-md-8">
                                                <textarea id="details" name="details" rows="3" placeholder="Write the complaint details" required="required"
                                                    class="form-control font-15 text-color-5"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label for="consignment_id"
                                                class="col-md-4 col-form-label text-color-5 font-14">Fast Move Parcel ID
                                                (Optional)</label>
                                            <div class="col-md-8">
                                                <input type="text" id="consignment_id" name="fastmove_parcel_id"
                                                    placeholder="Write the fast move parcel id" value=""
                                                    class="form-control font-15 text-color-5">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-md-8  offset-md-4 pt-2">
                                                <button type="submit"
                                                    class="w-100 btn btn-block bg-success text-white shadow-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection