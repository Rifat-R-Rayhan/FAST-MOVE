@extends('marchant.layouts.masterlayout')

@section('content')
    {{-- <button class="btn btn-primary" id="buttonOne">One</button>
    <button class="btn btn-primary" id="buttonTwo">Two</button>
    <button class="btn btn-primary" id="buttonThree">Three</button> --}}
    <div class="container-fluid">
        <div class="row p-5 p-md-2 my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-100 bg-white rounded p-4">
                            <div class="d-flex flex-wrap justify-content-around align-items-center mb-5">
                                <ul id="pills-tab" role="tablist" class="nav nav-pills element-item mx-0 my-2 gap-2">
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.all_consignment') }}"
                                            class="text-center font-15 btn btn-sm btn-secondary text-dark"
                                            id="buttonOne">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.list_byDate') }}"
                                            class="text-center font-15 btn btn-sm btn-secondary text-dark"
                                            id="buttonTwo">List By Date</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.pending_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonThree">On-The-Way</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.approval_pending_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonFour">Approval-Pending</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.delivery_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonFive">Delivered</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.partly_delivery_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonSix">Stocked</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.cancel_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonSeven">Cancelled</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.inreview_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonEight">Return</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.latest_entries_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonNine">Latest
                                            Entries</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.pick_n_drop_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonTen">Shiped</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100 bg-white d-none d-lg-block">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="text-color-6 font-15 font-medium px-2 w-19 d-none d-xl-block">Date
                                            </th>
                                            <th scope="col" class="text-color-6 font-15 font-medium px-2 w-19">Id</th>
                                            <th scope="col" class="text-color-6 font-15 font-medium px-2 w-30">Customer
                                                Name</th>
                                            {{-- <th scope="col" class="text-color-6 font-15 font-medium px-2 w-15">Payment
                                            </th> --}}
                                            <th scope="col" class="text-color-6 font-15 font-medium px-2 w-15">Charge
                                            </th>
                                            <th scope="col"
                                                class="text-center text-color-6 font-15 font-medium px-2 w-18">Assign Status
                                            </th>
                                            <th scope="col"
                                                class="text-center text-color-6 font-15 font-medium px-2 w-18">More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeData as $activeData)
                                            <tr>
                                                <td>{{ $activeData->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $activeData->id }}</td>
                                                <td>{{ $activeData->customer_name }}</td>
                                                {{-- <td>{{ 'Cash On Delivery' }}</td> --}}
                                                <td>{{ $activeData->cod_amount }}</td>
                                                @if ($activeData->is_active === '1')
                                                    <td>{{ 'Pending' }}</td>
                                                @elseif ($activeData->is_active === '2')
                                                    <td>{{ 'On the way' }}</td>
                                                @elseif ($activeData->is_active === '3')
                                                    <td>{{ 'Stocked' }}</td>
                                                @elseif ($activeData->is_active === '4')
                                                    <td>{{ 'Shiped' }}</td>
                                                @elseif ($activeData->is_active === '5')
                                                    <td>{{ 'Deliverd' }}</td>
                                                @elseif ($activeData->is_active === '6')
                                                    <td>{{ 'Return' }}</td>
                                                @elseif ($activeData->is_active === '7')
                                                    <td>{{ 'Canceled' }}</td>
                                                @endif
                                                <td>{{ 'No Comment' }}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            var lastClickedButton = localStorage.getItem("lastClickedButton");
            var lastClickedColor = localStorage.getItem("lastClickedColor");

            if (lastClickedButton && lastClickedColor) {
                $("#" + lastClickedButton).addClass(lastClickedColor);
                // if (lastClickedButton === "buttonListStatus") {
                // $("#buttonOne").addClass(lastClickedColor);
            }
            }
            

            $(".btn").click(function() {
                $(".btn").removeClass("bg-success bg-primary btn-warning btn-danger btn-success");
                var buttonId = $(this).attr("id");
                var buttonColor;

                if (buttonId === "buttonOne") {
                    buttonColor = "bg-success";
                } else if (buttonId === "buttonTwo") {
                    buttonColor = "";
                } else if (buttonId === "buttonThree") {
                    buttonColor = "btn-warning";
                } else if (buttonId === "buttonFour") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonFive") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSix") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSeven") {
                    buttonColor = 'btn-danger';
                }else if (buttonId === "buttonEight") {
                    buttonColor = 'btn-success';
                }else if (buttonId === "buttonNine") {
                    buttonColor = 'btn-success';
                }else if (buttonId === "buttonTen") {
                    buttonColor = 'btn-success';
                }


                $(this).addClass(buttonColor);

                // Save button state to localStorage
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);

                // Log a message to the console
                console.log("Clicked '" + $(this).text() + "' button");

            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            var lastClickedButton = localStorage.getItem("lastClickedButton");
            var lastClickedColor = localStorage.getItem("lastClickedColor");

            if (lastClickedButton && lastClickedColor) {
                $("#" + lastClickedButton).addClass(lastClickedColor);
            }

            if (lastClickedButton ) {
                if (lastClickedButton === "buttonListStatus") {
                $("#buttonOne").addClass("btn-success");
            }
            }
            $(".btn").click(function() {
                $(".btn").removeClass("bg-success bg-primary btn-warning btn-danger btn-success");
                var buttonId = $(this).attr("id");
                var buttonColor;

                if (buttonId === "buttonOne") {
                    buttonColor = "btn-success";
                } else if (buttonId === "buttonTwo") {
                    buttonColor = "";
                } else if (buttonId === "buttonThree") {
                    buttonColor = "btn-warning";
                } else if (buttonId === "buttonFour") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonFive") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSix") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSeven") {
                    buttonColor = 'btn-danger';
                }else if (buttonId === "buttonEight") {
                    buttonColor = 'btn-success';
                }else if (buttonId === "buttonNine") {
                    buttonColor = 'btn-success';
                }else if (buttonId === "buttonTen") {
                    buttonColor = 'btn-success';
                }


                $(this).addClass(buttonColor);

                // Save button state to localStorage
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);

                // Log a message to the console
                console.log("Clicked '" + $(this).text() + "' button");

                
            });
        });
    </script> --}}


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var lastClickedButton = localStorage.getItem("lastClickedButton");
            var lastClickedColor = localStorage.getItem("lastClickedColor");

            if (lastClickedButton && lastClickedColor) {
                $("#" + lastClickedButton).addClass(lastClickedColor);
            }

            if (lastClickedButton) {
                if (lastClickedButton === "buttonListStatus") {
                    $("#buttonOne").addClass("btn-success");
                }
            }
            $(".btn").click(function() {
                $(".btn").removeClass("bg-success bg-primary btn-warning btn-danger btn-success");
                var buttonId = $(this).attr("id");
                var buttonColor;
                console.log('object')
                if (buttonId === "buttonOne") {
                    buttonColor = "btn-success";
                } else if (buttonId === "buttonTwo") {
                    buttonColor = "";
                } else if (buttonId === "buttonThree") {
                    buttonColor = "btn-warning";
                } else if (buttonId === "buttonFour") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonFive") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSix") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonSeven") {
                    buttonColor = 'btn-danger';
                } else if (buttonId === "buttonEight") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonNine") {
                    buttonColor = 'btn-success';
                } else if (buttonId === "buttonTen") {
                    buttonColor = 'btn-success';
                }


                $(this).addClass(buttonColor);
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);
                console.log("Clicked '" + $(this).text() + "' button");
            });
        });
    </script>
@endsection
