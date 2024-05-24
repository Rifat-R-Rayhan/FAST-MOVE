@extends('server.layouts.masterlayout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
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


    <div class="card mb-3">
        <div class="card-body">
            <a href="{{ route('admin.register') }}" class="btn btn-sm btn-primary mb-2">Add Admin</a>
            <nav class="navbar navbar-light bg-white">
                <form id="searchForm">
                    <div class="input-group mb-0">
                        <div class="form-group-feedback form-group-feedback-left">
                            <input type="search" class="form-control mr-sm-2" placeholder="Search by Phone"
                                id="searchInput">
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
                    <form id="delete-form" action="{{ route('project.deleteAdmin') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>
                {{-- 
                <form id="excel" action="{{ route('admin.excel.import') }}" method="post"
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

                {{-- <a href="{{ route('admin.excel.export') }}" class="btn btn-dark my-2 my-sm-0">Export Excel</a> --}}
            </nav>

        </div>
    </div>



    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Admin's Table</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive bg-light">
                    <table class="table table-light table-hover" id="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admintab)
                                <tr class="clickable-row table-info" data-id="{{ $admintab->id }}">
                                    <td>{{ $admintab->id }}</td>
                                    <td>{{ $admintab->admin_name }}</td>
                                    <td>{{ $admintab->designation }}</td>
                                    <td>{{ $admintab->phone }}</td>
                                    <td>{{ $admintab->email }}</td>
                                    <td>
                                        <form id="adminDeleteConformation" action="{{ route('admin.destroy') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $admintab->id }}">
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                onclick="return confirm('Are you sure want to delete admin?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $admins->onEachSide(1)->links() }}
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
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Delete</th>
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

    {{-- for the first time type or submit button search --}}
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
                var searchRoute = '{{ route('admin.adminSearch') }}';

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

                        if (response.deliveries && Array.isArray(response.deliveries) && response
                            .deliveries.length > 0) {
                            $.each(response.deliveries, function(index, delivery) {
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.admin_name + '</td>' +
                                    '<td>' + delivery.designation + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.email + '</td>' +
                                    '<td>' +
                                    '<form action="{{ route('admin.destroy') }}" method="get">' +
                                    '@csrf' +
                                    '<input type="hidden" name="id" value="' + delivery.id +
                                    '">' +
                                    '<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm(\'Are you sure?\')">' +
                                    '<i class="far fa-trash-alt"></i>' +
                                    '</button>' +
                                    '</form>' +
                                    '</td>' +
                                    '</tr>');
                            });
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

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.adminSearch') }}';

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
            searchInput.on('input', function() {
                submitForm();
            });
            searchForm.submit(function(e) {
                e.preventDefault();
                submitForm();
            });
        });
    </script>

    {{-- admin delete_conformation --}}
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#adminDeleteConformation', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#table').load(location.href + ' #table');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
        });
    </script>
@endsection
