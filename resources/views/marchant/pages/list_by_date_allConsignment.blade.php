{{-- @extends('marchant.layouts.masterlayout')
@section('content')
    <div class="container-fluid">
    <div class="row p-xl-4 p-md-2 my-3">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="w-100 bg-white rounded px-sm-3 py-sm-2">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <ul id="pills-tab" role="tablist" class="nav nav-pills element-item mx-0 my-2">
                                <li class="nav-item">
                                    <a href="https://steadfast.com.bd/consignments" role="tab" aria-controls="consign-all" aria-selected="true" class="nav-link text-center font-15">List By Status</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://steadfast.com.bd/user/consignment/count-by-date" role="tab" aria-controls="consign-all" aria-selected="true" class="nav-link text-center font-15 active">List By Date</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-100 bg-white rounded px-sm-3 py-sm-4">
                        <h5 class="text-color-5 px-3 font-18">Parcel List by Date</h5>
                        <hr>

                        <div class="w-100 bg-white d-none d-lg-block">
                            <div class="w-100 px-1 px-xl-3 d-inline-flex align-items-center element-item-list-tag">
                                <div class="text-color-6 font-lg-14 font-medium px-2 w30 d-none d-xl-block">Date</div>
                                <div class="text-color-6 font-lg-14 font-medium px-2 w30">Total</div>
                                <div class="text-color-6 font-lg-14 font-medium px-2 w40">Action</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid">
        <div class="row p-xl-4 p-md-2 my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-100 bg-white rounded px-sm-3 py-sm-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <ul id="pills-tab" role="tablist" class="nav nav-pills element-item mx-0 my-3 gap-3">
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.all_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonListStatus">List By Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="text-center btn-sm font-15 btn btn-success text-dark"
                                            id="buttonList">List By Date</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="w-100 bg-white rounded px-sm-1 py-sm-2">
                            <h5 class="text-color-5 px-3 font-18">Parcel List by Date</h5>
                            <hr>

                            <div class="w-100 bg-white d-none d-lg-block">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th class="text-color-6 font-lg-14 font-medium">Date</th>
                                            <th class="text-color-6 font-lg-14 font-medium">Total</th>
                                            <th class="text-color-6 font-lg-14 font-medium">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Your table rows go here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btn").click(function() {
                var buttonId = $(this).attr("id");
                var buttonColor;

                if (buttonId === "buttonListStatus") {
                    buttonColor = "";
                }
                $(this).addClass(buttonColor);
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);

                window.location.href = "{{ route('merchant.all_consignment') }}";
            });
        });
    </script>
@endsection --}}
@extends('marchant.layouts.masterlayout')

@section('content')
    <div class="container-fluid">
        <div class="row p-xl-4 p-md-2 my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-100 bg-white rounded px-sm-3 py-sm-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <ul id="pills-tab" role="tablist" class="nav nav-pills element-item mx-0 my-3 gap-3">
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.all_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonListStatus">List By Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="text-center btn-sm font-15 btn btn-success text-dark"
                                            id="buttonList">List By Date</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="w-100 bg-white rounded px-sm-1 py-sm-2">
                            <h5 class="text-color-5 px-3 font-18">Parcel List by Date</h5>
                            <hr>

                            <div class="w-100 bg-white d-none d-lg-block">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th class="text-color-6 font-lg-14 font-medium">Date</th>
                                            <th class="text-color-6 font-lg-14 font-medium">Total</th>
                                            {{-- <th class="text-color-6 font-lg-14 font-medium">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($result as $item)
                                       <tr>
                                           <td>{{ $item->date }}</td>
                                           <td>{{ $item->total_products }}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btn").click(function() {
                var buttonId = $(this).attr("id");
                var buttonColor;

                if (buttonId === "buttonListStatus") {
                    buttonColor = "";
                }
                $(this).addClass(buttonColor);
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);

                window.location.href = "{{ route('merchant.all_consignment') }}";
            });
        });
    </script>
@endsection
