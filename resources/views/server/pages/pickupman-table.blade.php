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
                    <form id="delete-form" action="{{ route('project.deletepickup') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>

                {{-- <form id="excel" action="{{ route('admin.pickupman.excel.import') }}" method="post"
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

                {{-- <a href="{{ route('admin.pickupman.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a> --}}
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
                <h4 class="card-title">Pickup Man Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-light table-hover display nowrap" id="tableData" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pickup Man Name</th>
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
                            @foreach ($pickupmans as $pickupman)
                                <tr class="clickable-row table-info" data-id="{{ $pickupman->id }}">
                                    <td>{{ $pickupman->id }}</td>
                                    <td>{{ $pickupman->pickupman_name }}</td>
                                    <td>{{ $pickupman->phone }}</td>
                                    <td>{{ $pickupman->alt_phone }}</td>
                                    <td>{{ $pickupman->email }}</td>
                                    <td>{{ $pickupman->full_address }}</td>
                                    <td>{{ $pickupman->police_station }}</td>
                                    <td>{{ $pickupman->district }}</td>
                                    <td>{{ $pickupman->division }}</td>
                                    <td><img src="{{ asset('pickupmen/profile_images') }}/{{ $pickupman->profile_img }}"
                                            alt="Profile photo"></td>
                                    <td><img src="{{ asset('pickupmen/nid_images') }}/{{ $pickupman->nid_front }}"
                                            alt="NID Front"></td>
                                    <td><img src="{{ asset('pickupmen/nid_images') }}/{{ $pickupman->nid_back }}"
                                            alt="NID Back"></td>

                                    @if ($pickupman->is_active == 1)
                                        <td><span class="badge bg-label-danger me-1 text-black">Pending</span></td>
                                    @elseif ($pickupman->is_active == 3)
                                        <td><span class="badge bg-label-danger me-1 text-black">Cancelled</span></td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-black">Confirmed</span></td>
                                    @endif


                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-success showButton" data-bs-toggle="modal"
                                                data-bs-target="#showModal" data-id="{{ $pickupman->id }}"
                                                data-pickupman_name="{{ $pickupman->pickupman_name }}"
                                                data-phone="{{ $pickupman->phone }}"
                                                data-alt_phone="{{ $pickupman->alt_phone }}"
                                                data-email="{{ $pickupman->email }}"
                                                data-full_address="{{ $pickupman->full_address }}"
                                                data-police_station="{{ $pickupman->police_station }}"
                                                data-district="{{ $pickupman->district }}"
                                                data-division="{{ $pickupman->division }}"
                                                data-profile_img="{{ asset('pickupmen/profile_images/' . $pickupman->profile_img) }}"
                                                data-nid_front="{{ asset('pickupmen/nid_images/' . $pickupman->nid_front) }}"
                                                data-nid_back="{{ asset('pickupmen/nid_images/' . $pickupman->nid_back) }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            @if ($pickupman->is_active == 1)
                                                <form id="pickupmanConformation"
                                                    action="{{ route('admin.pickupman_confirmation') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickupman->id }}">
                                                    <button class="btn btn-sm btn-success" type="submit"><i
                                                            class="fa-solid fa-check"></i></button>
                                                </form>
                                                <form id="pickupmanCancelConformation"
                                                    action="{{ route('admin.pickupman_cancel_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pickupman->id }}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>

                                                </form>
                                            @endif

                                            <form id="pickupmanDeleteConformation"
                                                action="{{ route('admin.pickupman_destroy') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pickupman->id }}">
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
                {{ $pickupmans->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Pickupman Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer"></div>
                    <div class="card">
                        <div class="card text-center">
                            <div class="card-header">
                                Pickupman Details
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">ID : <span id="pickupman_id"></span></h5>
                                <h5 class="card-title">Name : <span id="pickupman_name"></span></h5>
                                <h5 class="card-title">Phone : <span id="pickupman_phone"></span></h5>
                                <h5 class="card-title">Alternate Phone : <span id="pickupman_alt_phone"></span></h5>
                                <h5 class="card-title">Email : <span id="pickupman_email"></span></h5>
                                <h5 class="card-title">Address : <span id="pickupman_address"></span></h5>
                                <h5 class="card-title">Police Station : <span id="pickupman_police_station"></span></h5>
                                <h5 class="card-title">District : <span id="pickupman_district"></span></h5>
                                <h5 class="card-title">Division : <span id="pickupman_division"></span></h5>
                                <h5 class="card-title mt-1 mb-3">Profile Image:</h5>
                                <img src="" alt="Profile Image" id="pickupman_profile_img" width="350"
                                    height="100" class="img-fluid">
                                <h5 class="card-title">NID Front:</h5>
                                <img src="" alt="NID Front" id="pickupman_nid_front" width="350"
                                    height="100" class="img-fluid">
                                <h5 class="card-title mt-4">NID Back:</h5>
                                <img src="" alt="NID Back" id="pickupman_nid_back" width="350"
                                    height="100" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-primary" data-bs-dismiss="modal">Close</button>
                </div>
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
                                <th scope="col">Pickup Man Name</th>
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
        $(document).ready(function() {
            $(document).on('click', '.showButton', function() {
                // Get data attributes from the clicked button
                var pickupmanId = $(this).data('id');
                var pickupmanName = $(this).data('pickupman_name');
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

                // Populate modal with pickupman details
                $('#pickupman_id').text(pickupmanId);
                $('#pickupman_name').text(pickupmanName);
                $('#pickupman_phone').text(phone);
                $('#pickupman_alt_phone').text(altPhone);
                $('#pickupman_email').text(email);
                $('#pickupman_address').text(fullAddress);
                $('#pickupman_police_station').text(policeStation);
                $('#pickupman_district').text(district);
                $('#pickupman_division').text(division);
                $('#pickupman_profile_img').attr('src', profileImg);
                $('#pickupman_nid_front').attr('src', nidFront);
                $('#pickupman_nid_back').attr('src', nidBack);
            });

        });
    </script>


    <script>
        $('#tableData').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).find('table').addClass('print-table');
                        $(win.document.body)
                            .prepend(
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Pickup Men List</h4></div>'
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
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                if (searchInputValue === '') {
                    $('#tableData').load(location.href + ' #tableData');
                    return;
                }
                $.ajax({
                    url: '{{ route('admin.searchPickup') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'admin_delivery_search': searchInputValue,
                    },
                    dataType: 'html',
                    success: function(response) {
                        $('#tableData').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        $('#tableData').load(location.href + ' #tableData');
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

    {{-- pickupman__conformation_by_the_admin --}}
    {{-- pickupman_cancel_conformation_by_the_admin --}}
    {{-- pickupman_delete_conformation_by_the_admin --}}

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#pickupmanConformation', function(event) {
                event.preventDefault();
                console.log(event);
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
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

            $(document).on('submit', '#pickupmanCancelConformation', function(event) {
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

            $(document).on('submit', '#pickupmanDeleteConformation', function(event) {
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
        });
    </script>
@endsection
