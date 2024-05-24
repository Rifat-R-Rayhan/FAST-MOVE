@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
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

    <div class="card">
        <div class="card-body">
            <nav class="navbar">
                <form id="searchForm">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" name="admin_delivery_search" class="form-control mr-sm-2"
                                placeholder="Search" id="searchInput">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-primary my-2 my-sm-0">Search</button>
                        </div>
                    </div>
                </form>
                <div class="col-auto">
                    <button id="select-all-data" class="btn btn-primary mb-lg-0 py-3 mb-2">Select AllData</button>
                    <button id="deselect-all-data" class="btn btn-secondary py-3 mb-lg-0 mb-2">Deselect
                        AllData</button>
                    <button id="Delete-delete" class="btn btn-danger py-3">Delete</button>
                    <form id="delete-form" action="{{ route('project.deletedeliveryman') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>

                {{-- <form id="excel" action="{{ route('admin.deliveryman.excel.import') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="file" name="excel_file">
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-dark my-2 my-sm-0">Import Excel</button>
                        </div>
                    </div>
                </form> --}}

                {{-- <a href="{{ route('admin.deliveryman.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a> --}}
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
                <h4 class="card-title">Delivery Man Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-light table-hover display nowrap" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Delivery Man Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Alt Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliverymen as $deliveryman)
                                <tr class="clickable-row table-info" data-id="{{ $deliveryman->id }}">
                                    <td>{{ $deliveryman->id }}</td>
                                    <td>{{ $deliveryman->deliveryman_name }}</td>
                                    <td>{{ $deliveryman->phone }}</td>
                                    <td>{{ $deliveryman->alt_phone }}</td>
                                    <td>{{ $deliveryman->email }}</td>
                                    <td>{{ $deliveryman->full_address }}</td>
                                    <td>{{ $deliveryman->police_station }}</td>
                                    <td>{{ $deliveryman->district }}</td>
                                    <td>{{ $deliveryman->division }}</td>
                                    <td><img src="{{ asset('deliverymen/profile_images') }}/{{ $deliveryman->profile_img }}"
                                            alt="Profile photo"></td>
                                    <td><img src="{{ asset('deliverymen/nid_images') }}/{{ $deliveryman->nid_front }}"
                                            alt="NID Front"></td>
                                    <td><img src="{{ asset('deliverymen/nid_images') }}/{{ $deliveryman->nid_back }}"
                                            alt="NID Back"></td>

                                    @if ($deliveryman->is_active == 1)
                                        <td><span class="badge bg-label-danger me-1 text-black">Pending</span></td>
                                    @elseif ($deliveryman->is_active == 3)
                                        <td><span class="badge bg-label-danger me-1 text-black">Cancelled</span></td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-black">Confirmed</span></td>
                                    @endif


                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($deliveryman->is_active == 1)
                                                <form id="deliverymanConformation"
                                                    action="{{ route('admin.deliveryman_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $deliveryman->id }}">
                                                    <button class="btn btn-sm btn-success" type="submit"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </form>
                                                <form id="deliverymanCancelConformation"
                                                    action="{{ route('admin.deliveryman_cancel_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $deliveryman->id }}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>

                                                </form>
                                            @endif
                                            {{-- <a href="{{ route('pickup.show', $pickup->id) }}"
                                            class="btn btn-sm btn-info"> <i class="fas fa-eye"></i></a> --}}
                                            {{-- <a href="{{ route('pickup.edit', $deliveryman->id) }}"
                                                class="btn btn-sm btn-success"> <i class="fas fa-pencil-alt"></i></a> --}}
                                            {{-- <button class="btn btn-sm btn-success showButton" data-bs-toggle="modal"
                                                data-bs-target="#showModal">
                                                <i class="fas fa-eye"></i>
                                            </button> --}}
                                            <button class="btn btn-sm btn-success showButton" data-bs-toggle="modal"
                                                data-bs-target="#showModal" data-id="{{ $deliveryman->id }}"
                                                data-deliveryman_name="{{ $deliveryman->deliveryman_name }}"
                                                data-phone="{{ $deliveryman->phone }}"
                                                data-alt_phone="{{ $deliveryman->alt_phone }}"
                                                data-email="{{ $deliveryman->email }}"
                                                data-full_address="{{ $deliveryman->full_address }}"
                                                data-police_station="{{ $deliveryman->police_station }}"
                                                data-district="{{ $deliveryman->district }}"
                                                data-division="{{ $deliveryman->division }}"
                                                data-profile_img="{{ asset('deliverymen/profile_images/' . $deliveryman->profile_img) }}"
                                                data-nid_front="{{ asset('deliverymen/nid_images/' . $deliveryman->nid_front) }}"
                                                data-nid_back="{{ asset('deliverymen/nid_images/' . $deliveryman->nid_back) }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form id="deliverymanDeleteConformation"
                                                action="{{ route('admin.deliveryman_destroy') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $deliveryman->id }}">
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $deliverymen->onEachSide(1)->links() }}
            </div>
        </div>
    </div>


    <div class="col-lg-12 stretch-card" id="searchResultsSection" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Search Results</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col"> DeliveryMan Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Alt Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
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


    {{-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Delivery Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer"></div>
                    <div class="card">
                        <div class="card text-center">
                            <div class="card-header">
                                Product Details
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product ID : <span id="id"></span></h5>
                                <h5 class="card-title">Merchant's/Personal Name : <span id="merchant_name"></span></h5>
                                <h5 class="card-title">Merchant's/Personal Contact : <span id="merchant_phone"></span>
                                </h5>
                                <h5 class="card-title">Merchant's/Personal Email : <span id="merchant_email"></span></h5>
                                <h5 class="card-title">Merchant's/Personal Address : <span id="merchant_address"></span>
                                </h5>
                                <h5 class="card-title">Customer's Name : <span id="customer_name"></span></h5>
                                <h5 class="card-title">Customer's Contact : <span id="customer_phone"></span></h5>
                                <h5 class="card-title">Customer's Address : <span id="customer_address"></span></h5>
                                <h5 class="card-title">Product Category : <span id="product_category"></span></h5>
                                <h5 class="card-title">Delivery Type : <span id="product_deliverytype"></span></h5>
                                <h5 class="card-title">Tracking Number : <span id="product_ordertrack"></span></h5>
                                <h5 class="card-title">Cash On Delivery : <span id="product_cod"></span></h5>
                                <h5 class="card-title">Delivery Charge : <span id="product_deliverycharge"></span></h5>
                                <h5 class="card-title">Invoice : <span id="product_invoice"></span></h5>
                                <h5 class="card-title">Note : <span id="product_note"></span></h5>
                                <h5 class="card-title">Exchange Percel Status : <span id="product_exchangeparcel"></span>
                                </h5>
                                <h5 class="card-title">Delivery Status : <span id="product_is_active"></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Deliveryman Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer"></div>
                    <div class="card text-center">
                        <div class="card-header">
                            Deliveryman Details
                        </div>
                        <div class="card-body">
                            <!-- Display deliveryman details -->
                            <h5 class="card-title">Deliveryman ID: <span id="id"></span></h5>
                            <h5 class="card-title">Name: <span id="merchant_name"></span></h5>
                            <h5 class="card-title">Phone: <span id="merchant_phone"></span></h5>
                            <h5 class="card-title">Alt Phone: <span id="merchant_alt_phone"></span></h5>
                            <h5 class="card-title">Email: <span id="merchant_email"></span></h5>
                            <h5 class="card-title">Address: <span id="merchant_address"></span></h5>
                            <h5 class="card-title">Police Station: <span id="police_station"></span></h5>
                            <h5 class="card-title">District: <span id="district"></span></h5>
                            <h5 class="card-title">Division: <span id="division"></span></h5>
                            <!-- Image placeholders -->
                            <h5 class="card-title">Profile Image:</h5>
                            <img id="profile_img" src="" width="350" height="100" alt="Profile Image" class="img-fluid">
                            <h5 class="card-title">NID Front:</h5>
                            <img id="nid_front" src="" width="350" height="100" alt="NID Front" class="img-fluid">
                            <h5 class="card-title">NID Back:</h5>
                            <img id="nid_back" src="" width="350" height="100" alt="NID Back" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Delivery Men List</h4></div>'
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


    <script>
        document.getElementById('select-all-data').addEventListener('click', function() {
            selectAllData();
        });

        document.getElementById('deselect-all-data').addEventListener('click', function() {
            deselectAllData();
        });

        document.getElementById('Delete-delete').addEventListener('click', function() {
            var ids = getSelectedIds();
            if (ids.length > 0) {
                console.log(ids);
                // Set the selected IDs to the hidden input field in the form
                document.getElementById('selected-ids').value = JSON.stringify(ids);
                
                document.getElementById('delete-form').submit();
            } else {
                alert('Please select at least one item to delete.');
            }
        });

        function selectAllData() {
            var rows = document.querySelectorAll('.clickable-row');
            var selectedIds = [];
            rows.forEach(row => {
                row.classList.add('table-warning');
                selectedIds.push(row.getAttribute('data-id'));
            });

            console.log(selectedIds);
        }

        function deselectAllData() {
            var rows = document.querySelectorAll('.clickable-row');
            rows.forEach(row => {
                row.classList.remove('table-warning');
            });
        }

        function getSelectedIds() {
            var selectedIds = [];
            console.log('object');
            var selectedRows = document.querySelectorAll('.clickable-row.table-warning');
            selectedRows.forEach(row => {
                selectedIds.push(row.getAttribute('data-id'));
            });
            return selectedIds;
        }

        // Enable row-click selection
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', () => {
                toggleRowSelection(row); // Toggle selection of the row
            });
        });

        // Function to toggle selection of the row
        function toggleRowSelection(clickedRow) {
            clickedRow.classList.toggle('table-warning'); // Toggle visual indication of selection
            clickedRow.classList.toggle('table-success'); // Toggle selection of the clicked row
        }
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.showButton', function() {
                var deliverymanId = $(this).data('id');
                var deliverymanName = $(this).data('deliveryman_name');
                var phone = $(this).data('phone');
                var altPhone = $(this).data('alt_phone');
                var email = $(this).data('email');
                var fullAddress = $(this).data('full_address');
                var policeStation = $(this).data('police_station');
                var district = $(this).data('district');
                var division = $(this).data('division');
                var profileImg = $(this).data('profile_img');
                var nidFront = $(this).data('nid_front');
                var nidBack = $(this).data('nid_back');
                console.log(division);
                // Populate the modal with the deliveryman's information
                $('#id').text(deliverymanId);
                $('#merchant_name').text(deliverymanName);
                $('#merchant_phone').text(phone);
                $('#merchant_alt_phone').text(altPhone);
                $('#merchant_email').text(email);
                $('#merchant_address').text(fullAddress);
                $('#police_station').text(policeStation);
                $('#district').text(district);
                $('#division').text(division);
                $('#profile_img').attr('src', profileImg);
                $('#nid_front').attr('src', nidFront);
                $('#nid_back').attr('src', nidBack);
            });
        });
    </script>


    {{-- for the first time type or submit button search --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Add an event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                var inputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.searchDeliveryman') }}';

                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: inputValue,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.deliverymen && Array.isArray(response.deliverymen) &&
                            response.deliverymen.length > 0) {
                            $.each(response.deliverymen, function(index, deliveryman) {
                                resultsBody.append('<tr>' +
                                    '<td>' + deliveryman.id + '</td>' +
                                    '<td>' + deliveryman.deliveryman_name +
                                    '</td>' +
                                    '<td>' + deliveryman.phone + '</td>' +
                                    '<td>' + deliveryman.alt_phone + '</td>' +
                                    '<td>' + deliveryman.email + '</td>' +
                                    '<td>' + deliveryman.full_address + '</td>' +
                                    '<td>' + deliveryman.police_station + '</td>' +
                                    '<td>' + deliveryman.district + '</td>' +
                                    '<td>' + deliveryman.division + '</td>' +
                                    '<td><img src="{{ asset('deliverymen/profile_images') }}/' +
                                    deliveryman.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('deliverymen/nid_images') }}/' +
                                    deliveryman.nid_front +
                                    '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('deliverymen/nid_images') }}/' +
                                    deliveryman.nid_back +
                                    '" alt="NID Back"></td>' +
                                    '<td>' + getStatusBadge(deliveryman.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(deliveryman.is_active,
                                        deliveryman.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                if (status === 1) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Pending</span>';
                                } else if (status === 3) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-black">Confirmed</span>';
                                }
                            }

                            function getActionButtons(status, deliverymanId) {
                                if (status === 1) {
                                    return `
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('admin.deliveryman_confirmation') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="${deliverymanId}">
                                                <button class="btn btn-sm btn-success" type="submit">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.deliveryman_cancel_confirmation') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="${deliverymanId}">
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="fa-solid fa-times"></i>
                                                </button>
                                            </form>
                                        </div>`;
                                } else {
                                    return `
                                        <form action="{{ route('admin.deliveryman_destroy') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliverymanId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>`;
                                }
                            }

                        } else {
                            resultsBody.html(
                                '<tr><td colspan="14" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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
            });

            // Add an event listener for the input field
            searchInput.on('input', function() {
                var inputValue = $(this).val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                // Trigger form submission to execute the search logic
                searchForm.submit();
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


    {{-- for the first time type or submit button search and render the table dynamically --}}
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

                $.ajax({
                    url: '{{ route('admin.searchDeliveryman') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
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
            searchInput.on('input', function() {
                submitForm();
            });
            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });
        });
    </script>

    {{-- for given input and automatic search --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
    
            // Add an event listener for the input field
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();
    
                // If the input is empty, show existingTable and hide searchResultsSection
                if (searchInput === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }
    
                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.searchDeliveryman') }}';
    
                $.ajax({
                    url: searchRoute,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        admin_delivery_search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        existingTable.hide();
                        searchResultsSection.show();
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();
    
                        if (response.deliverymen && Array.isArray(response.deliverymen) &&
                            response.deliverymen.length > 0) {
                            $.each(response.deliverymen, function(index, deliveryman) {
                                resultsBody.append('<tr>' +
                                    '<td>' + deliveryman.id + '</td>' +
                                    '<td>' + deliveryman.deliveryman_name +
                                    '</td>' +
                                    '<td>' + deliveryman.phone + '</td>' +
                                    '<td>' + deliveryman.alt_phone + '</td>' +
                                    '<td>' + deliveryman.email + '</td>' +
                                    '<td>' + deliveryman.full_address + '</td>' +
                                    '<td>' + deliveryman.police_station + '</td>' +
                                    '<td>' + deliveryman.district + '</td>' +
                                    '<td>' + deliveryman.division + '</td>' +
                                    '<td><img src="{{ asset('deliverymen/profile_images') }}/' +
                                    deliveryman.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('deliverymen/nid_images') }}/' +
                                    deliveryman.nid_front +
                                    '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('deliverymen/nid_images') }}/' +
                                    deliveryman.nid_back +
                                    '" alt="NID Back"></td>' +
                                    '<td>' + getStatusBadge(deliveryman.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(deliveryman.is_active,
                                        deliveryman.id) + '</td>' +
                                    '</tr>');
                            });
    
                            function getStatusBadge(status) {
                                if (status === 1) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Pending</span>';
                                } else if (status === 3) {
                                    return '<span class="badge bg-label-danger me-1 text-black">Cancelled</span>';
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-black">Confirmed</span>';
                                }
                            }
    
                            function getActionButtons(status, deliverymanId) {
                                if (status === 1) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.deliveryman_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliverymanId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deliveryman_cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliverymanId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    return `
                                    <form action="{{ route('admin.deliveryman_destroy') }}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="${deliverymanId}">
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>`;
                                }
                            }
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="14" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#deliverymanDeleteConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'GET',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href + ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#deliverymanCancelConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href + ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#deliverymanConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#existingTable').load(location.href +
                                ' #existingTable > *');
                        } else {
                            console.error('Error occurred during delete operation');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
        });
    </script>
@endsection
