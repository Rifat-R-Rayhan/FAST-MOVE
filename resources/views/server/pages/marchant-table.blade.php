@extends('server.layouts.masterlayout')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    {{-- <div class="card">
<div class="card-body">

    <form action="#" method="get">
        @csrf
        <div class="input-group mb-3">
            <div class="form-group-feedback form-group-feedback-left">
                <input type="search" name="search" class="form-control form-control-lg"
                    placeholder="Search by From ID or Destination">
                
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-search4 text-muted"></i>
                </div>
            </div>

            <div class="input-group-append ms-2">
                <button type="submit" class="btn btn-primary btn-lg">Search</button>
            </div>
        </div>


    </form>
</div>
</div> --}}


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
                    <form id="delete-form" action="{{ route('project.deletemerchant') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>

                {{-- <a href="{{ route('admin.merchant.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a> --}}
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
                <h4 class="card-title">Marchant's Table</h4>
                {{-- @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif --}}
                <div class="table-responsive">
                    <table class="table table-light table-hover display nowrap" id="tableData" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Business Name</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pick Up Location</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="clickable-row table-info" data-id="{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->business_name }}</td>
                                    <td>{{ $user->merchant_name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->pick_up_location }}</td>
                                    {{-- {{dd($user->profile_img)}} --}}
                                    {{-- <td><img src="{{$user->profile_img}}" alt="Profile Photo"></td> --}}
                                    <td><img src="{{ asset('merchant/profile-photos') }}/{{ $user->profile_img }}"
                                            alt="Profile Photo"></td>
                                    <td><img src="{{ asset('merchant/nid-photos') }}/{{ $user->nid_front }}"
                                            alt="NID Front">
                                    </td>
                                    <td><img src="{{ asset('merchant/nid-photos') }}/{{ $user->nid_back }}"
                                            alt="NID Back">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success showButton" data-bs-toggle="modal"
                                            data-bs-target="#showModal" data-id="{{ $user->id }}"
                                            data-business_name="{{ $user->business_name }}"
                                            data-merchant_name="{{ $user->merchant_name }}"
                                            data-phone="{{ $user->phone }}" data-email="{{ $user->email }}"
                                            data-pick_up_location="{{ $user->pick_up_location }}"
                                            data-profile_img="{{ asset('merchant/profile-photos/' . $user->profile_img) }}"
                                            data-nid_front="{{ asset('merchant/nid-photos/' . $user->nid_front) }}"
                                            data-nid_back="{{ asset('merchant/nid-photos/' . $user->nid_back) }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $users->onEachSide(1)->links() }}
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
                                <th scope="col">Business Name</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pick Up Location</th>
                                <th scope="col">Profile Photo</th>
                                <th scope="col">NID Front</th>
                                <th scope="col">NID Back</th>
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



    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer"></div>
                    <div class="card text-center">
                        <div class="card-header">
                            User Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">ID: <span id="user_id"></span></h5>
                            <h5 class="card-title">Business Name: <span id="business_name"></span></h5>
                            <h5 class="card-title">Merchant Name: <span id="merchant_name"></span></h5>
                            <h5 class="card-title">Phone: <span id="phone"></span></h5>
                            <h5 class="card-title">Email: <span id="email"></span></h5>
                            <h5 class="card-title">Pick-Up Location: <span id="pick_up_location"></span></h5>
                            <h5 class="card-title">Profile Photo:</h5>
                            <img id="profile_img" width="380" height="100" src="" alt="Profile Photo" class="img-fluid mb-3">
                            <h5 class="card-title">NID Front:</h5>
                            <img id="nid_front" width="380" height="100" src="" alt="NID Front" class="img-fluid mb-3">
                            <h5 class="card-title">NID Back:</h5>
                            <img id="nid_back" width="380" height="100" src="" alt="NID Back" class="img-fluid mb-3">
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
                // Get data attributes from the clicked button
                var userId = $(this).data('id');
                var businessName = $(this).data('business_name');
                var merchantName = $(this).data('merchant_name');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var pickUpLocation = $(this).data('pick_up_location');
                var profileImg = $(this).data('profile_img');
                var nidFront = $(this).data('nid_front');
                var nidBack = $(this).data('nid_back');
    
                // Populate modal with user details
                $('#user_id').text(userId);
                $('#business_name').text(businessName);
                $('#merchant_name').text(merchantName);
                $('#phone').text(phone);
                $('#email').text(email);
                $('#pick_up_location').text(pickUpLocation);
                $('#profile_img').attr('src', profileImg);
                $('#nid_front').attr('src', nidFront);
                $('#nid_back').attr('src', nidBack);
            });
        });
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
                url: '{{ route('admin.searchMerchant') }}',
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

    {{-- given or search button press the search is done --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Function to handle form submission
            function submitForm() {
                var inputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.searchMerchant') }}';

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

                        if (response.user && Array.isArray(response.user) &&
                            response.user.length > 0) {
                            $.each(response.user, function(index, user) {
                                resultsBody.append('<tr>' +
                                    '<td>' + user.id + '</td>' +
                                    '<td>' + user.business_name + '</td>' +
                                    '<td>' + user.merchant_name + '</td>' +
                                    '<td>' + user.phone + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' + user.pick_up_location + '</td>' +
                                    '<td><img src="{{ asset('merchant/profile-photos') }}/' +
                                    user.profile_img +
                                    '" alt="Profile photo"></td>' +
                                    '<td><img src="{{ asset('merchant/nid-photos') }}/' +
                                    user.nid_front + '" alt="NID Front"></td>' +
                                    '<td><img src="{{ asset('merchant/nid-photos') }}/' +
                                    user.nid_back + '" alt="NID Back"></td>' +
                                    '</tr>');
                            });
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="9" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Add an event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                submitForm();
                existingTable.show();
                searchResultsSection.hide();
            });

            // Add an event listener for the input field
            searchInput.on('input', function() {
                var inputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (inputValue === '') {
                    searchResultsSection.hide();
                    existingTable.show();

                } else {
                    // Execute the search logic
                    submitForm();
                    existingTable.show();
                    searchResultsSection.hide();
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
@endsection
