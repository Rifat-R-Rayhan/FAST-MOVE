@extends('pickupman.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <style>
        /* Styles for printing */
        @media print {

            /* Hide non-essential elements */
            .hide-on-print {
                display: none !important;
            }

            /* Center-align headers */
            h2,
            h4,
            p {
                text-align: center;
            }

            /* Add padding and remove borders for table */
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 20px auto;
            }

            th,
            td {
                padding: 8px;
                border: 1px solid #ddd;
            }

            /* Center-align table content */
            td {
                text-align: center;
            }
        }
    </style>

    <div class="card mb-3">
        <div class="card-body">
            <nav class="navbar navbar-light bg-light">
                <form id="searchForm">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" name="admin_delivery_search" class="form-control mr-sm-2"
                                placeholder="Search" id="searchInput">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Search</button>
                        </div>
                    </div>
                </form>
            </nav>
        </div>
        {{-- <div class="card-body">
            <div class="form-group  ms-1" style="margin-top: -30px">
                <select id="searchoptionId" name="search_option" class="form-control" style="width: 19rem">
                    <option disabled selected>Select your search option</option>
                    <option value="Rifat">Rifat</option>
                    <option value="phone">Phone</option>
                    <option value="delivery_type">Delivery Type</option>
                    <option value="address">Address</option>
                    <option value="id">Id</option>
                    <option value="category_type">Category Type</option>
                    <option value="district">District</option>
                    <option value="order_tracking_id">Order Tracking Id</option>
                    <option value="divisions">Divisions</option>
                </select>
            </div>
        </div> --}}
    </div>
    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Delivery Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive bg-light">
                    <table class="table table-light table-hover display nowrap" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">COD</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col">Update</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $delivery)
                                <tr class="table-info">
                                    <td>{{ $delivery->id }}</td>
                                    <td>
                                        @if ($delivery->user)
                                            @if ($delivery->user->merchant_name)
                                                {{ $delivery->user->merchant_name }}
                                            @elseif ($delivery->user->local_user_name)
                                                {{ $delivery->user->local_user_name }}
                                            @else
                                                {{ $delivery->user->merchant_name }}
                                            @endif
                                        @else
                                            {{ $delivery->local_user_name }} (0{{ $delivery->local_user_contact }},
                                            {{ $delivery->local_user_address }})
                                        @endif
                                    </td>
                                    <td>{{ $delivery->customer_name }}</td>
                                    <td>{{ $delivery->customer_phone }}</td>
                                    <td>{{ $delivery->full_address }}</td>
                                    <td>{{ $delivery->police_station }}</td>
                                    <td>{{ $delivery->district }}</td>
                                    <td>{{ $delivery->divisions }}</td>
                                    <td>{{ $delivery->product_category }}</td>
                                    <td>{{ $delivery->delivery_type }}</td>
                                    <td>{{ $delivery->cod_amount }}</td>
                                    <td>{{ $delivery->order_tracking_id }}</td>
                                    <td>{{ $delivery->invoice }}</td>
                                    <td>{{ $delivery->note }}</td>
                                    <td>{{ $delivery->exchange_status }}</td>
                                    <td>{{ $delivery->delivery_charge }}</td>
                                    @if ($delivery->is_active == 1)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Pending</span></td>
                                    @elseif ($delivery->is_active == 2)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product On <br> the
                                                way</span>
                                        </td>
                                    @elseif ($delivery->is_active == 3)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Stocked</span></td>
                                    @elseif ($delivery->is_active == 4)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>
                                    @elseif ($delivery->is_active == 5)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Delivered</span></td>
                                    @elseif ($delivery->is_active == 6)
                                        <td><span class="badge bg-label-danger me-1 text-dark">product Return</span></td>
                                    @elseif ($delivery->is_active == 7)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Canceled</span></td>
                                    @elseif ($delivery->is_active === '8')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Cancel <br> by the
                                                Admin</td>
                                    @elseif ($delivery->is_active == 9)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Returned product <br>
                                                pickupman
                                                accepted <br>and on the way</span></td>
                                    @elseif ($delivery->is_active == 10)
                                        <td><span class="badge bg-label-danger me-1 text-dark">product return <br>
                                                successfully</span></td>
                                    @endif

                                    <td>
                                        @if ($delivery->is_active == 1)
                                            <div class="d-flex justify-center align-items-center gap-2">
                                                <form id="pickupmanDeliveryProductCoformation"
                                                    action="{{ route('pickupman.product.delivery_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                    {{-- <input type="hidden" name="pickupman_id" value="{{ $id }}"> --}}
                                                    <button class="btn btn-sm btn-success text-white" type="submit">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($delivery->is_active == 6 || $delivery->is_active == 7 || $delivery->is_active == 8)
                                            <div class="d-flex justify-center align-items-center gap-2">
                                                <form id="pickupmanReturnProductCoformation"
                                                    action="{{ route('pickupman.product.return_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                    {{-- <input type="hidden" name="pickupman_id" value="{{ $id }}"> --}}
                                                    <button class="btn btn-sm btn-warning text-white" type="submit">
                                                        <i class="fa-solid fa-arrow-rotate-left"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="badge bg-label-success me-1 text-dark">Your job <br> is done<br>
                                                Thanks!!</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->onEachSide(1)->links() }}
            </div>
        </div>
    </div>


    <div class="col-lg-12 stretch-card" id="searchResultsSection" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search Results</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="searchtable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">COD</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col">Update</th> --}}
                            </tr>
                        </thead>
                        <tbody id="searchResultsBody">
                            <!-- Use JavaScript to populate this tbody with search results -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination for search results if needed -->
                <div id="searchResultsPagination">
                    <!-- Add pagination links here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).find('table').addClass('print-table');
                        $(win.document.body)
                            .prepend(
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Parcel List</h4></div>'
                            );
                    }
                },
                'copy', 'csv', 'excel', 'pdf'
            ],
            responsive: true,
            paging: false
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- first searc code before create ajax for productConformation --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Function to handle form submission
            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (searchInputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('pickupman.productPickSearch') }}'; // Replace with your actual route

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInputValue,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();
                        if (response.customers.length > 0) {
                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) + '</td>' +
                                    '<td>' + getActionButtons(customer.is_active, customer
                                        .id) + '</td>' +
                                    '<td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                if (status === '1') {
                                    return '<span class="badge bg-label-danger me-1 text-dark">Product Pending</span>';
                                } else if (status === '2') {
                                    return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                } else if (status === '3') {
                                    return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                } else if (status === '6') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                } else if (status === '7') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '1') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form id='pickupmanDeliveryProductCoformatio' action="{{ route('pickupman.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    return `
                                    <span class="badge bg-label-success me-1 text-dark">
                                        Your job <br> is done <br> Thanks!!
                                    </span>`;
                                }
                            }
                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="21">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            }

            // Update the event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                submitForm();
                searchResultsSection.hide();
                existingTable.show();
            });

            // Add event listeners for the input to handle input and keyup events
            searchInput.on('input keyup', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                } else {
                    // Execute the search logic
                    submitForm();
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    // If backspace key is pressed and input is empty, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- after product conformation ajax request create --}}
    <script>
        $(document).ready(function() {
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                if (searchInputValue === '') {
                    $('#table').load(location.href + ' #table');
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('pickupman.productPickSearch') }}';

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInputValue,
                    },
                    dataType: 'html',
                    success: function(response) {
                        $('#table').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        $('#table').load(location.href + ' #table');
                    }
                });
            }

            // Trigger submitForm on keyup event of searchInput
            searchInput.on('keyup', function() {
                submitForm();
            });

            // Trigger submitForm on form submission
            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });

            searchInput.on('input keyup', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    submitForm();
                } else {
                    // Execute the search logic
                    submitForm();
                }
            });
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    // If backspace key is pressed and input is empty, hide searchResultsSection, show existingTable
                    submitForm();
                }
            });
        });
    </script>

    {{-- pickupmanDeliveryProductCoformation --}}
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#pickupmanDeliveryProductCoformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#table').load(location.href + ' #table')
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
            $(document).on('submit', '#pickupmanReturnProductCoformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#table').load(location.href + ' #table')
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
        })
    </script>
@endsection
