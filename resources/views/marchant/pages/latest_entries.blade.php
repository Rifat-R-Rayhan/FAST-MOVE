@extends('marchant.layouts.masterlayout')

@section('content')
    <div class="container-xl my-3">
        <div class="row p-2">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bg-white rounded p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <ul id="pills-tab" role="tablist" class="nav nav-pills element-item mx-0 my-2 gap-2">
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.all_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonListStatus">List By Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.list_byDate') }}"
                                            class="text-center btn-sm font-15 btn btn-secondary text-dark"
                                            id="buttonList">List By Date</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('merchant.latest_entries_consignment') }}"
                                            class="text-center btn-sm font-15 btn btn-warning text-white"
                                            id="buttondate"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-100">
                                <div class="px-3 py-3">
                                    Total Parcels: <strong>{{ $total }}</strong> Total COD Amount: <strong>{{ $cod_amount }} TK</strong>
                                </div>
                            </div>
                            <div class="bg-white d-none d-lg-block">
                                <table class="table border">
                                    <thead>
                                        <tr class="element-item-list-tag">
                                            <th scope="col" class="text-color-6 font-15 font-medium">Date</th>
                                            <th scope="col" class="text-color-6 font-15 font-medium">Id</th>
                                            <th scope="col" class="text-color-6 font-15 font-medium">Customer Name</th>
                                            <th scope="col" class="text-color-6 font-15 font-medium">Payment</th>
                                            <th scope="col" class="text-color-6 font-15 font-medium">Charge</th>
                                            <th scope="col" class="text-center text-color-6 font-15 font-medium">Assign
                                                Status</th>
                                            {{-- <th scope="col" class="text-center text-color-6 font-15 font-medium">More
                                            </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($allConsignment as $allConsignment)
                                        <tr>
                                        <td>{{ $allConsignment->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $allConsignment->id }}</td>
                                            <td>{{ $allConsignment->name }}</td>
                                            <td>{{ 'Cash On Delivery' }}</td>
                                            <td>{{ $allConsignment->cod_amount }}</td>
                                            @if($allConsignment->is_active==='1')
                                            <td>{{ "Pending" }}</td>
                                            @elseif ($allConsignment->is_active==='2')
                                            <td>{{ "On the way" }}</td>
                                            @elseif ($allConsignment->is_active==='3')
                                            <td>{{ "Checkout" }}</td>
                                            @elseif ($allConsignment->is_active==='4')
                                            <td>{{ "Delivered" }}</td>
                                            @else
                                                <td>{{ "Canceled" }}</td> 
                                            @endif
                                        </tr>
                                        @endforeach --}}
                                        @foreach($activeData as $allConsignment)
                                        <tr>
                                            <td>{{ $allConsignment->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $allConsignment->id }}</td>
                                            <td>{{ $allConsignment->name }}</td>
                                            <td>{{ 'Cash On Delivery' }}</td>
                                            <td>{{ $allConsignment->cod_amount }}</td>
                                            @if($allConsignment->is_active==='1')
                                            <td>{{ "Pending" }}</td>
                                            @elseif ($allConsignment->is_active==='2')
                                            <td>{{ "On the way" }}</td>
                                            @elseif ($allConsignment->is_active==='3')
                                            <td>{{ "Checkout" }}</td>
                                            @elseif ($allConsignment->is_active==='4')
                                            <td>{{ "Delivered" }}</td>
                                            @else
                                                <td>{{ "Canceled" }}</td> 
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div id="pills-tabContent" class="tab-content">
                            <div id="consign-all" role="tabpanel" aria-labelledby="all-tab" class="tab-pane fade show active">
                                <ul class="list-unstyled p-0 m-0"></ul>
                                <nav class="custome-pagination">
                                    <div class="d-flex justify-content-center font-14"></div>
                                </nav>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                if (buttonId === "buttonOne") {
                    buttonColor = "btn-success";
                }
                //  else if (buttonId === "buttonTwo") {
                //     buttonColor = "";
                // }
                //  else if (buttonId === "buttonThree") {
                //     buttonColor = "btn-warning";
                // }
                //  else if (buttonId === "buttonFour") {
                //     buttonColor = 'btn-success';
                // } else if (buttonId === "buttonFive") {
                //     buttonColor = 'btn-success';
                // } else if (buttonId === "buttonSix") {
                //     buttonColor = 'btn-success';
                // } else if (buttonId === "buttonSeven") {
                //     buttonColor = 'btn-danger';
                // }else if (buttonId === "buttonEight") {
                //     buttonColor = 'btn-success';
                // }else if (buttonId === "buttonNine") {
                //     buttonColor = 'btn-success';
                // }else if (buttonId === "buttonTen") {
                //     buttonColor = 'btn-success';
                // }


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
                }
                 else if (buttonId === "buttonTwo") {
                    buttonColor = "";
                }
                 else if (buttonId === "buttonThree") {
                    buttonColor = "btn-warning";
                }
                 else if (buttonId === "buttonFour") {
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
                }else if (buttonId === "buttondate") {
                    buttonColor = 'btn-warning';
                }


                $(this).addClass(buttonColor);
                localStorage.setItem("lastClickedButton", buttonId);
                localStorage.setItem("lastClickedColor", buttonColor);
                console.log("Clicked '" + $(this).text() + "' button");
            });
        });
    </script>
    <script>
        // Function to format date in the desired format
        function formatDate(date) {
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
            return new Intl.DateTimeFormat('en-US', options).format(date);
        }
    
        // Function to update the dynamic date range link
        function updateDynamicLink() {
            const now = new Date();
            const startDate = new Date(now);
            const endDate = new Date(now);
            endDate.setHours(endDate.getHours() + 23, 59, 59); // Set end time to 11:59:59 PM
    
            const linkElement = document.getElementById('buttondate');
    
            // Update the link text with the formatted date range
            linkElement.innerText = `${formatDate(startDate)} - ${formatDate(endDate)}`;
        }
    
        // Call the function to update the dynamic link
        updateDynamicLink();
    </script>
@endsection
