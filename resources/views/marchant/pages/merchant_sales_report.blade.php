@extends('marchant.layouts.masterlayout')
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

<?php
use Illuminate\Support\Facades\Auth;
$id = Auth::id();

$user = $id;
// Connect to MySQL database
include '../config/db_connection.php';

// Fetch all sales data
$sql_all_sales = "SELECT * FROM products WHERE user_id = $user AND is_active = 5 OR is_active = 6";
$result_all_sales = $conn->query($sql_all_sales);
?>

<div class="table-responsive">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Order ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Amount</th>
                <th>Parcel Charge</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_all_sales->num_rows > 0) {
    while ($row = $result_all_sales->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['customer_name'] . "</td>";
        echo "<td>" . $row['full_address'] . ", " . $row['police_station'] . "</td>";
        echo "<td>" . $row['cod_amount'] . "</td>";
        echo "<td>" . $row['delivery_charge'] . "</td>";
        
        // Add a conditional statement to display the appropriate status
        echo "<td>";
        if ($row['is_active'] == 5) {
            echo "Delivered";
        } elseif ($row['is_active'] == 6) {
            echo "Return";
        } else {
            // Handle other cases if needed
            echo $row['is_active']; // Display the value as is
        }
        echo "</td>";
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No sales found.</td></tr>";
}
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
?>

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
                        .prepend('<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Daily Sheet of Merchant</h4><p><strong>Name of Merchant:</strong> ______________________________________________</p><p><strong>Number:</strong> ____________________________________________</p></div>');
                }
            },
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
</script>
@endsection
