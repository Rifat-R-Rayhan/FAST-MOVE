<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Voucher</title>
    <link href="/frontend/img/delivery-bike.png" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .voucher {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .product-info {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .barcode {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
@php
    $product_info = $product->customer_name . ' ' . $product->customer_phone;
@endphp

<div class="voucher">
    <div class="logo">
        <h1>Fast Move Logistics Ltd</h1>
    </div>
    <div class="product-info">
        <p>Date: {{ $product->updated_at->format('Y-m-d') }}</p>
        @if (!empty($product->hub->hub_address))
            <h2>{{$product->hub->hub_address}}</h2>
        @else
            <p>Hub address not selected</p>
        @endif
        
        @if (!empty($product->product_bar_code))
            <div class="barcode">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product_info, 'C39', 1, 50) }}" alt="Barcode">
            </div>
            <p>{{ $product->product_bar_code }}</p>
        @else
            <p>No product barcode available</p>
        @endif
        <h4>Ref:</h4>
        <h4><u>Details:</u></h4>
        <p>Receiver: {{$product->customer_name}}</p>
        <p>Contact: {{$product->customer_phone}}</p>
        <p>Address: {{$product->full_address}}, {{$product->police_station}}, {{$product->district}}</p>
    </div>
    {{-- <table>
        <thead>
            <tr>
                <th>Product Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$product->product_info}}</td>
            </tr>
        </tbody>
    </table> --}}
</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>

</body>
</html>
