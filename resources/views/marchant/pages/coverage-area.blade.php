@extends('marchant.layouts.masterlayout')
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
                h2, h4, p {
                    text-align: center;
                }
        
                /* Add padding and remove borders for table */
                table {
                    border-collapse: collapse;
                    width: 100%;
                    margin: 20px auto;
                }
        
                th, td {
                    padding: 8px;
                    border: 1px solid #ddd;
                }
        
                /* Center-align table content */
                td {
                    text-align: center;
                }
            }
        </style>

    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Coverage(Delivery) Area Table</h4>
                <div class="table-responsive">
                    <table class="table table-light table-hover display nowrap" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">From</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Delivery Cost/Kg</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($area as $calculate)
                                <tr class="table-info">
                                    <td>{{ $calculate->from_location }}</td>
                                    <td>{{ $calculate->destination }}</td>
                                    <td>{{ $calculate->category }}</td>
                                    <td>{{ $calculate->delivery_type }}</td>
                                    <td>{{ $calculate->cost }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            buttons: [
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).find('table').addClass('print-table');
                        $(win.document.body)
                            .prepend('<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Delivery Charge List</h4></div>');
                    }
                },
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
@endsection

