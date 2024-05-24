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
            <div class="add-btn bg-white">
                <a href="{{ route('addDeliveryCharge') }}" class="btn btn-primary btn-sm">Add Delivery Charge</a>
            </div>
            <nav class="navbar navbar-light bg-white">
                <form id="searchForm">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" class="form-control mr-sm-2"
                                placeholder="Search by From ID or Destination" id="searchInput">
                            <div class="form-control-feedback form-control-feedback-lg">
                                <i class="icon-search4 text-muted"></i>
                            </div>
                        </div>
                        <div class="input-group-append ms-2">
                            <button type="submit" class="btn btn-primary btn-lg">Search</button>
                        </div>
                    </div>
                </form>
                <div class="col-auto">
                    <button id="select-all-data" class="btn btn-primary mb-lg-0 py-3 mb-2">Select AllData</button>
                    <button id="deselect-all-data" class="btn btn-secondary py-3 mb-lg-0 mb-2">Deselect
                        AllData</button>
                    <button id="Delete-delete" class="btn btn-danger py-3">Delete</button>
                    <form id="delete-form" action="{{ route('project.deleteCalculate') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>
            </nav>
            {{-- <form action="{{ url('/calculator/search') }}" method="get">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" name="search" class="form-control form-control-lg"
                            placeholder="Search by From ID or Destination">
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append ms-2">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </div>
            </form> --}}

        </div>
    </div>

    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Calculate Delivery Charge Table</h4>
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
                                <th scope="col">From</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Delivery Cost</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calculates as $calculate)
                                <tr class="clickable-row table-info" data-id="{{ $calculate->id }}">
                                    <td>{{ $calculate->id }}</td>
                                    <td>{{ $calculate->from_location }}</td>
                                    <td>{{ $calculate->destination }}</td>
                                    <td>{{ $calculate->category }}</td>
                                    <td>{{ $calculate->delivery_type }}</td>
                                    <td>{{ $calculate->cost }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- <a href="{{ route('deliverycharge.show', $calculate->id) }}"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i></a> --}}
                                            <button class="btn btn-sm btn-success showButton" data-bs-toggle="modal"
                                                data-bs-target="#showModal" data-id="{{ $calculate->id }}"
                                                data-fromlocation="{{ $calculate->from_location }}"
                                                data-destination="{{ $calculate->from_location }}"
                                                data-category="{{ $calculate->category }}"
                                                data-delivery_type="{{ $calculate->delivery_type }}"
                                                data-cost="{{ $calculate->cost }}" id="updateDeliveryForm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            {{-- <a href="{{ route('deliverycharge.edit', $calculate->id) }}"
                                                class="btn btn-success">
                                                <i class="fas fa-pencil-alt"></i></a> --}}
                                            <button class="btn btn-sm btn-success editDeliveryChargeButton"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-chargeid="{{ $calculate->id }}"
                                                data-chargefromlocation="{{ $calculate->from_location }}"
                                                data-chargedestination="{{ $calculate->from_location }}"
                                                data-chargecategory="{{ $calculate->category }}"
                                                data-chargedeliverytype="{{ $calculate->delivery_type }}"
                                                data-chargecost="{{ $calculate->cost }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form id="chargeDeleteConformation"
                                                action="{{ route('deliverycharge.destroy', $calculate->id) }}"
                                                method="post">
                                                @csrf
                                                @method ('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')"> <i
                                                        class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    {{-- <td>
                                        <a href="{{ route('calculator.show', $calculate->id) }}" class="btn btn-info">
                                            Show
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('calculator.edit', $calculate->id) }}" class="btn btn-success"
                                            style="margin-left: 10px;">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('calculator.destroy', $calculate->id) }}" method="post"
                                            style="margin-left: 10px;">
                                            @csrf
                                            @method ('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $calculates->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    {{-- dliveryCharge Show modal --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
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
                                Delivery Charge Details
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Delivery Charge ID : <span id="chargeid"></span></h5>
                                <h5 class="card-title">From Location : <span id="fromLocation"></span></h5>
                                <h5 class="card-title">Destination : <span id="destination"></span></h5>
                                <h5 class="card-title">Category Type : <span id="category"></span></h5>
                                <h5 class="card-title">Delivery Type : <span id="deliveryType"></span></h5>
                                <h5 class="card-title">Cost : <span id="cost"></span></h5>
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

    {{-- deliveryCharge update modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <form id="editDeliveryChargeForm">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Delivery Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="row w-100">
                                <div class="col-md-9 grid-margin stretch-card"> --}}
                        <div class="errMsgContainer"></div>
                        <div class="card">
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('fail'))
                                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                @endif
                                <div class="page-header">
                                    <h3 class="page-title">
                                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                                            <i class="mdi mdi-home"></i>
                                        </span> Update Delivery Charge
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <span></span>Overview <i
                                                    class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <input type="hidden" id="id">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="from_location"
                                            id="fromtoLocationto">
                                        @error('from_location')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="destination" id="destinationto"
                                            value="" placeholder="Write The Destination Location Name">
                                        @error('destination')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Category</label>
                                    <select name="category" class="form-control" id="categoryto">
                                        <option value="" disabled selected></option>
                                        <option value="Regular">Regular</option>
                                        <option value="Document">Document</option>
                                        <option value="Book">Book</option>
                                    </select>
                                </div>
                                <span class="text-danger mb-3 d-block">
                                    @error('category')
                                        {{ $message }}
                                    @enderror
                                </span>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Delevery Type</label>
                                    <select name="delivery_type" class="form-control" id="deliveryto">
                                        <option value="" disabled selected></option>
                                        <option value="drop">Drop</option>
                                        <option value="pickup and drop">Pickup & Drop</option>
                                    </select>
                                </div>
                                <span class="text-danger mb-3 d-block">
                                    @error('delivery_type')
                                        {{ $message }}
                                    @enderror
                                </span>

                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Delivery
                                        Cost/KG</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control text-black" id="costto"
                                            name="cost">
                                        @error('cost')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-gradient-primary editDeliveryChargeSubmit">Update
                            Delivery</button>
                    </div>
                </div>
            </div>
        </form>
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
                                <th scope="col">From</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Delivery Cost</th>
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
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).find('table').addClass('print-table');
                        $(win.document.body)
                            .prepend(
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Delivery Charge List</h4></div>'
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

    {{-- search button presse or type --}}

    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');
            var resultsBody = $('#searchResultsBody');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();
                if (searchInputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.calculatorSearch') }}';

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
                        resultsBody.empty();

                        if (response.results && Array.isArray(response.results) && response
                            .results.length > 0) {
                            $.each(response.results, function(index, results) {
                                resultsBody.append('<tr>' +
                                    '<td>' + results.id + '</td>' +
                                    '<td>' + results.from_location + '</td>' +
                                    '<td>' + results.destination + '</td>' +
                                    '<td>' + results.category + '</td>' +
                                    '<td>' + results.delivery_type + '</td>' +
                                    '<td>' + results.cost + '</td>' +
                                    '<td>' + results.weight + '</td>' +
                                    getActionButtons(results.id) +
                                    '</tr>');
                            });

                            function getActionButtons(resultsId) {
                                return '<td>' +
                                    '<div class="d-flex justify-content-center gap-2">' +
                                    getViewButton(resultsId) +
                                    getEditButton(resultsId) +
                                    getDeleteButton(resultsId) +
                                    '</div>' +
                                    '</td>';
                            }

                            function getViewButton(resultsId) {
                                return '<a href="{{ route('deliverycharge.show', '') }}/' +
                                    resultsId + '" class="btn btn-info">' +
                                    '<i class="fas fa-eye"></i>' +
                                    '</a>';
                            }

                            function getEditButton(resultsId) {
                                return '<a href="{{ route('deliverycharge.edit', '') }}/' +
                                    resultsId +
                                    '" class="btn btn-success">' +
                                    '<i class="fas fa-pencil-alt"></i>' +
                                    '</a>';
                            }

                            function getDeleteButton(resultsId) {
                                return '<form action="{{ route('deliverycharge.destroy', '') }}/' +
                                    resultsId + '" method="post">' +
                                    '@csrf' +
                                    '@method('DELETE')' +
                                    '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">' +
                                    '<i class="fas fa-trash-alt"></i>' +
                                    '</button>' +
                                    '</form>';
                            }
                        } else {
                            resultsBody.html(
                                '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        resultsBody.html(
                            '<tr><td colspan="6" class="text-center fw-bold">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            }
            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });

            searchInput.on('input', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    searchResultsSection.hide();
                    existingTable.show();
                } else {
                    submitForm();
                }
            });
            searchInput.on('keyup', function(e) {
                if (e.key === 'Backspace' && $(this).val().trim() === '') {
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- search button presse or type and rerender the table --}}
    <script>
        $(document).ready(function() {
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                if (searchInputValue === '') {
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.calculatorSearch') }}';

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

    {{-- show data --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.showButton', function() {
                let up_id = $(this).data('id');
                let from_location = $(this).data('fromlocation');
                let destination = $(this).data('destination')
                let category = $(this).data('category')
                let delivery_type = $(this).data('delivery_type')
                let cost = $(this).data('cost')

                $('#chargeid').text(up_id)
                $('#fromLocation').text(from_location);
                $('#destination').text(destination);
                $('#category').text(category);
                $('#deliveryType').text(delivery_type);
                $('#cost').text(cost);
            });

            $(document).on('click', '.editDeliveryChargeButton', function() {
                let chargeid = $(this).data('chargeid');
                let chargefromlocation = $(this).data('chargefromlocation');
                let chargedestination = $(this).data('chargedestination')
                let chargecategory = $(this).data('chargecategory')
                let chargedeliverytype = $(this).data('chargedeliverytype')
                let chargecost = $(this).data('chargecost')

                $('#id').val(chargeid);
                $('#fromtoLocationto').val(chargefromlocation);
                $('#destinationto').val(chargedestination);
                $('#categoryto').val(chargecategory);
                $('#deliveryto').val(chargedeliverytype);
                $('#costto').val(chargecost);
            });

            $(document).on('click', '.editDeliveryChargeSubmit', function(e) {
                e.preventDefault();
                let up_id = $('#id').val();
                let fromtoLocationto = $('#fromtoLocationto').val();
                let destinationto = $('#destinationto').val();
                let categoryto = $('#categoryto').val();
                let deliveryto = $('#deliveryto').val();
                let costto = $('#costto').val();
                var csrfToken = '{{ csrf_token() }}';

                $.ajax({
                    // url: "{{ route('admin.deliverycharge.update') }}",
                    url: "{{ route('deliverycharge.update', ['deliverycharge' => ':up_id']) }}"
                        .replace(':up_id', up_id),
                    // method:'POST',
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        '_method': 'PUT',
                        from_location: fromtoLocationto,
                        destination: destinationto,
                        category: categoryto,
                        delivery_type: deliveryto,
                        cost: costto
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#editModal').modal('hide');
                            $('#updateDeliveryForm').trigger('reset');
                            $('.modal-backdrop').remove();
                            $('#table').load(location.href + ' #table');
                        }
                    },
                    error: function(err) {
                        console.error("An error occurred:", err);
                    }
                });

            });

            $(document).on('submit', '#chargeDeleteConformation', function(event) {
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
