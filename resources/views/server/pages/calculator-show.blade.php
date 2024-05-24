<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="card text-center">
        <div class="card-header">
            Delivery Charge Details
        </div>
        <div class="card-body">
            <h5 class="card-title">From: {{ $deliverycharge->from_location }}</h5>
            <h5 class="card-title">Destination: {{ $deliverycharge->destination }}</h5>
            <h5 class="card-title">Category: {{ $deliverycharge->category }}</h5>
            <h5 class="card-title">Delivery Type: {{ $deliverycharge->delivery_type }}</h5>
            <h5 class="card-title">Cost: {{ $deliverycharge->cost }}</h5>
            <h5 class="card-title">Weight: {{ $deliverycharge->weight }}</h5>

            <a href="{{ route('deliverycharge.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
