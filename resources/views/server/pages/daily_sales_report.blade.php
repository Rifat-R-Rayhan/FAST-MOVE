@extends('server.layouts.masterlayout')
@section('content')
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

<div class="table-responsive">
    <form method="GET" action="{{ route('daily.sales.report') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="start-date" class="form-label">Start Date:</label>
                <input type="date" id="start-date" name="start_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="end-date" class="form-label">End Date:</label>
                <input type="date" id="end-date" name="end_date" class="form-control">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Order ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="table-info">
                <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->customer_name }}</td>
                <td>{{ $product->full_address }}</td>
                <td>{{ $product->cod_amount }}</td>
                <td></td>
            @endforeach
        </tbody>
    </table>
</div>
{{ $products->onEachSide(1)->links() }}

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
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                customize: function (win) {
                    $(win.document.body).find('table').addClass('print-table');
                    $(win.document.body)
                        .prepend('<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Daily Sheet of parcel</h4><p><strong>Name:</strong> ______________________________________________</p><p><strong>Number:</strong> ____________________________________________</p></div>');
                }
            },
            'copy', 'csv', 'excel', 'pdf'
        ],
        responsive: true,
        paging: false
    });
</script>
@endsection
