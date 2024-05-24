@extends('server.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

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
            <nav class="navbar navbar-light bg-white">
                <div class="container-fluid">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <form id="searchForm" class="d-flex">
                                <div class="input-group">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label fw-bold">Search here</label>
                                        <input type="search" name="admin_delivery_search"
                                            class="p-3 form-control border rounded" placeholder="Search" id="searchInput">
                                    </div>
                                    <div class="input-group-append mb-3 mt-md-1 mt-lg-4 py-lg-1 py-md-1 ms-lg-2">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form id="excel" action="{{ route('admin.date_range_search') }}" method="post"
                                enctype="multipart/form-data" class="d-flex">
                                @csrf

                                <div class="mb-3 d-flex justify-content-center">
                                    <div class="row">
                                        <div class="mb-3 col-md-6 col-lg-5">
                                            <label for="start_date" class="form-label fw-bold">Start Date</label>
                                            <input type="date" name="start_date" class="form-control border rounded"
                                                id="start_date">
                                        </div>
                                        <div class="mb-3 col-md-6 col-lg-5">
                                            <label for="end_date" class="form-label fw-bold">End Date</label>
                                            <input type="date" name="end_date" class="form-control border rounded"
                                                id="end_date">
                                        </div>
                                        <div class="my-lg-4 my-md-1 ms-3 ms-lg-0 p-1 col-md-6 col-lg-2">
                                            <button id="search-btn" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="row w-100 justify-content-start">
                        <div class="col-auto">
                            <a href="{{ route('admin.product.delivery') }}"
                                class="btn btn-primary btn-sm py-3 mb-lg-0 px-4 mb-2">Back</a>
                            <button id="select-all-data" class="btn btn-primary mb-lg-0 py-3 mb-2">Select AllData</button>
                            <button id="deselect-all-data" class="btn btn-secondary py-3 mb-lg-0 mb-2">Deselect
                                AllData</button>
                            <button id="Delete-delete" class="btn btn-danger py-3">Delete</button>
                        </div>
                    </div>
                    <form id="delete-form" action="{{ route('project.delete') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selected-ids">
                    </form>
                </div>
            </nav>
        </div>
    </div>
    </div>




    <div class="col-lg-12 stretch-card" id="existingTable">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Delivery Table</h4>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="table-responsive bg-light" id="tableContainer">
                    <table class="table table-light table-hover display nowrap" id="tableData" style="width:100%">
                        <thead>
                            <tr style="align-items: center">
                                <th scope="col">Product ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Pickupman Name</th>
                                <th scope="col">Deliveryman Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">COD</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        <tbody id="container">
                            @foreach ($deliveries->reverse() as $delivery)
                                <tr class="clickable-row table-info " data-id="{{ $delivery->id }}">
                                    <td>{{ $delivery->id }}</td>
                                    <td>{{ $delivery->updated_at }}</td>
                                    <td>
                                        @if ($delivery->user)
                                            @if ($delivery->user->merchant_name)
                                                {{ $delivery->user->merchant_name }}
                                            @elseif ($delivery->user->local_user_name)
                                                {{ $delivery->user->local_user_name }}
                                            @else
                                                {{ $delivery->user->merchant_name }}
                                            @endif
                                        @else
                                            {{ $delivery->local_user_name }} (Personal)
                                        @endif
                                    </td>
                                    @if ($delivery->pickupman_id > 0)
                                        <td>{{ $delivery->pickupman->pickupman_name }}</td>
                                    @else
                                        <td>No one pickup</td>
                                    @endif
                                    @if ($delivery->deliveryman_id > 0)
                                        <td>{{ $delivery->deliveryman->deliveryman_name }}</td>
                                    @else
                                        <td>No one delivered</td>
                                    @endif
                                    <td>{{ $delivery->customer_name }}</td>
                                    <td>{{ $delivery->customer_phone }}</td>
                                    <td>{{ $delivery->full_address }}</td>
                                    <td>{{ $delivery->police_station }}</td>
                                    <td>{{ $delivery->district }}</td>
                                    <td>{{ $delivery->divisions }}</td>
                                    <td>{{ $delivery->product_category }}</td>
                                    <td>{{ $delivery->delivery_type }}</td>
                                    <td>{{ $delivery->cod_amount }}</td>
                                    <td>{{ $delivery->order_tracking_id }}</td>
                                    <td>{{ $delivery->invoice }}</td>
                                    <td>{{ $delivery->note }}</td>
                                    <td>{{ $delivery->exchange_status }}</td>
                                    <td>{{ $delivery->delivery_charge }}</td>
                                    @if (!empty($delivery->product_bar_code))
                                        <td>
                                            <p>{{ $delivery->product_bar_code }}</p>
                                        </td>
                                    @else
                                        <td>
                                            <p>No product barcode available</p>
                                        </td>
                                    @endif
                                    @if ($delivery->is_active == 2)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product On the way</span>
                                        </td>
                                    @elseif ($delivery->is_active == 3)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Stock</span></td>
                                    @elseif ($delivery->is_active == 4)
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>
                                    @elseif ($delivery->is_active == 5)
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Delivered</span>
                                        </td>
                                    @elseif($delivery->is_active == 6)
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Return <br> and
                                                waiting for <br> pickupman for <br> return product to <br> the
                                                merchant</span></td>
                                    @elseif ($delivery->is_active == 7)
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> By
                                                Admin <br>and waiting for <br> pickupman for <br> return product to <br> the
                                                merchant</span>
                                        </td>
                                    @elseif ($delivery->is_active === '8')
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br>and
                                                waiting for <br> pickupman for <br> return product to <br> the
                                                merchant</span>
                                        </td>
                                    @elseif ($delivery->is_active === '9')
                                        <td><span class="badge bg-label-success me-1 text-dark">return product <br> on the
                                                <br> way</span>
                                        </td>
                                    @elseif ($delivery->is_active === '10')
                                        <td><span class="badge bg-label-success me-1 text-dark">product <br> return
                                                <br> successfully</span>
                                        </td>
                                    @elseif ($delivery->is_active === '8')
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> By
                                                Admin</span>
                                        </td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Pickupman <br> has
                                                not <br> reached yet</span></td>
                                    @endif

                                    @if ($delivery->is_active == 2)
                                        <td>
                                            <div class="d-flex justify-center align-items-center gap-2">
                                                <form id="deliveryConfirmationForm"
                                                    action="{{ route('admin.product.delivery_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                    <button class="btn btn-sm btn-success text-white" type="submit">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                                <form id="deliveryCancelConfirmationForm"
                                                    action="{{ route('admin.product.cancel_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td><span class="badge bg-label-success me-1 text-dark">You have no action
                                                now</span>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($delivery->is_active == 3 || $delivery->is_active == 8)
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-sm btn-success updateDeliveryForm"
                                                        data-bs-toggle="modal" data-bs-target="#updateModal"
                                                        data-id="{{ $delivery->id }}"
                                                        data-name="{{ $delivery->customer_name }}"
                                                        data-phone="{{ $delivery->customer_phone }}"
                                                        data-address="{{ $delivery->full_address }}"
                                                        data-division="{{ $delivery->divisions }}"
                                                        data-dis="{{ $delivery->district }}"
                                                        data-police="{{ $delivery->police_station }}"
                                                        data-deliveryproduct="{{ $delivery->product_category }}"
                                                        data-del="{{ $delivery->delivery_type }}"
                                                        data-cod="{{ $delivery->cod_amount }}"
                                                        data-invoice="{{ $delivery->invoice }}"
                                                        data-note="{{ $delivery->note }}"
                                                        data-exchangeparcel="{{ $delivery->exchange_status }}"
                                                        data-weight="{{ $delivery->product_weight }}"
                                                        data-ordertrack="{{ $delivery->order_tracking_id }}"
                                                        data-deliverycharge="{{ $delivery->delivery_charge }}"
                                                        data-is_active="{{ $delivery->is_active }}"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                    <form id="productDeleteConformation"
                                                        action="{{ route('admin.product.delivery.delete') }}"
                                                        method="get">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $delivery->id }}">
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                    <button class="btn btn-sm btn-success showButton"
                                                        data-bs-toggle="modal" data-bs-target="#showModal"
                                                        data-id="{{ $delivery->id }}"
                                                        @php
$merchantName = '';
                                                        $merchantTitle = '';
                                                    if ($delivery->user) {
                                                        if ($delivery->user->merchant_name) {
                                                            $merchantTitle = "Merchant's Name: ";
                                                            $merchantName = $delivery->user->merchant_name;
                                                        } elseif ($delivery->user->local_user_name) {
                                                            $merchantTitle = "Personal: ";
                                                            $merchantName = $delivery->user->local_user_name;
                                                        } else {
                                                            $merchantTitle = "Merchant's Name: ";
                                                            $merchantName = $delivery->user->merchant_name;
                                                        }
                                                    } else {
                                                        $merchantTitle = "Personal: ";
                                                        $merchantName = $delivery->local_user_name;
                                                    } @endphp
                                                        data-merchant_name="{{ $merchantName }}"
                                                        @php
$merchantContact = '';
                                                    if ($delivery->user) {
                                                        if ($delivery->user->phone) {
                                                            $merchantContact = $delivery->user->phone;
                                                        } elseif ($delivery->user->local_user_contact) {
                                                            $merchantContact = $delivery->user->local_user_contact;
                                                        } else {
                                                            $merchantContact = $delivery->user->phone;
                                                        }
                                                    } else {
                                                        $merchantContact = $delivery->local_user_contact;
                                                    } @endphp
                                                        data-merchant_phone="{{ $merchantContact }}"
                                                        @php
$merchantEmail = '';
                                                    if ($delivery->user) {
                                                        if ($delivery->user->email) {
                                                            $merchantEmail = $delivery->user->email;
                                                        } elseif ($delivery->user->local_user_email) {
                                                            $merchantEmail = $delivery->user->local_user_email;
                                                        } else {
                                                            $merchantEmail = $delivery->user->email;
                                                        }
                                                    } else {
                                                        $merchantEmail = $delivery->local_user_email;
                                                    } @endphp
                                                        data-merchant_email="{{ $merchantEmail }}"
                                                        @php
$merchantAddress = '';
                                                    if ($delivery->user) {
                                                        if ($delivery->user->pick_up_location) {
                                                            $merchantAddress = $delivery->user->pick_up_location . $delivery->user->district;
                                                        } elseif ($delivery->user->local_user_address) {
                                                            $merchantAddress = $delivery->user->local_user_address;
                                                        } else {
                                                            $merchantAddress = $delivery->user->pick_up_location . $delivery->user->district;
                                                        }
                                                    } else {
                                                        $merchantAddress = $delivery->local_user_address;
                                                    } @endphp
                                                        data-merchant_address="{{ $merchantAddress }}"
                                                        data-name="{{ $delivery->customer_name }}"
                                                        data-phone="{{ $delivery->customer_phone }}"
                                                        data-address="{{ $delivery->full_address }}"
                                                        data-division="{{ $delivery->divisions }}"
                                                        data-dis="{{ $delivery->district }}"
                                                        data-police="{{ $delivery->police_station }}"
                                                        data-deliveryproduct="{{ $delivery->product_category }}"
                                                        data-del="{{ $delivery->delivery_type }}"
                                                        data-cod="{{ $delivery->cod_amount }}"
                                                        data-invoice="{{ $delivery->invoice }}"
                                                        data-note="{{ $delivery->note }}"
                                                        data-exchangeparcel="{{ $delivery->exchange_status }}"
                                                        data-weight="{{ $delivery->product_weight }}"
                                                        data-ordertrack="{{ $delivery->order_tracking_id }}"
                                                        data-deliverycharge="{{ $delivery->delivery_charge }}"
                                                        data-is_active="{{ $delivery->is_active }}"
                                                        id="updateDeliveryForm">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="{{ route('admin.product.delivery.show', ['id' => $delivery->id]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.product.delivery.show', ['id' => $delivery->id]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                            @endif
                                        </div>
                                    </td>
                </div>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            {{ $deliveries->onEachSide(1)->links() }}
        </div>
    </div>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="searchResultsSection" class="table-responsive" style="display: none;">
                    <h4 class="card-title">Delivery Table</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Pickupman Name</th>
                                <th scope="col">Deliveryman Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">COD</th>
                                <th scope="col">Order Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        <tbody id="searchResultsBody">
                            <!-- Search results will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <form id="updateDeliveryFormSubmit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Delivery Product</h5>
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
                                        </span> Update Parcel Delivery
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

                                {{-- <form id="updateDeliveryForm" action="" class="forms-sample" method="post">
                                @csrf --}}
                                <input type="hidden" id="up_id">
                                <input type="hidden" id="ordertrack">
                                <input type="hidden" id="deliverycharge">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="Customer_name">
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="order_tracking_id" value="{{ $delivery->numericValue }}">
                                                <input type="hidden" name="user_id" value="{{ $delivery->id }}"> --}}
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" id="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" id="address">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Division</label>
                                    <input type="text" name="divisions" class="form-control" id="divisions">
                                    {{-- <select name="divisions" class="form-control" id="divisions"
                                        onchange="divisionsList();">
                                        <option selected></option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Chattogram">Chattogram</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Khulna">Khulna</option>
                                        <option value="Mymensingh">Mymensingh</option>
                                        <option value="Rajshahi">Rajshahi</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Sylhet">Sylhet</option>
                                    </select> --}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">District</label>
                                    <input type="text" name="district" class="form-control" id="distr">
                                    {{-- <select name="district" class="form-control" id="distr" onchange="thanaList();">
                                        <option selected></option>
                                    </select> --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Police Station</label>
                                    <input type="text" name="police_station" class="form-control" id="policsta">
                                    {{-- <select name="police_station" class="form-control" id="polic_sta">
                                        <option selected></option>
                                    </select> --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Category Type</label>
                                    <select name="category_type" class="form-control" id="category">
                                        <option selected></option>
                                        <option value="Regular">Regular</option>
                                        <option value="Document">Document</option>
                                        <option value="Book">Book</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Delevery Type</label>
                                    <input type="text" name="delivery_type" class="form-control" id="deliverytype">
                                    {{-- <select name="delivery_type" class="form-control" id="deliverytype">
                                        <option selected></option>
                                        <option value="Drop">Drop</option>
                                        <option value="Pickup & Drop">Pickup & Drop</option>
                                    </select> --}}
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">COD
                                        Amount</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cod_amount" class="form-control" id="cod">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2"
                                        class="col-sm-3 col-form-label">Invoice</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="invoice" class="form-control" id="invoice">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Note</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="note" class="form-control" id="note">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2"
                                        class="col-sm-3 col-form-label">Weight</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="weight" class="form-control" id="weight">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Exchange Parcel</label>
                                    <select name="exchange_parcel" class="form-control" id="exchangeparcel">
                                        <option selected></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2"
                                        class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="is_active" class="form-control" id="is_active">
                                    </div>
                                </div>

                                {{-- <button type="submit" class="btn btn-gradient-primary me-2">Save</button> --}}
                                {{-- <button class="btn btn-light">Cancel</button> --}}

                            </div>
                        </div>
                        {{-- </div>
                            </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-gradient-primary update_delivery">Update Delivery</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
        $('#tableData').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    autoPrint: true,
                    customize: function(win) {
                        $(win.document.body).find('table').addClass('print-table');
                        $(win.document.body)
                            .prepend(
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Total Parcel List</h4></div>'
                            );
                    }
                },
                'copy', 'csv', 'excel', 'pdf'
            ],
            responsive: true,
            paging: false,
            columns: [{
                    data: 'Product ID'
                },
                {
                    data: 'Date'
                },
                {
                    data: 'Merchant Name'
                },
                {
                    data: 'Pickupman Name'
                },
                {
                    data: 'Deliveryman Name'
                },
                {
                    data: 'Customer Name'
                },
                {
                    data: 'Customer Phone'
                },
                {
                    data: 'Address'
                },
                {
                    data: 'Police Station'
                },
                {
                    data: 'District'
                },
                {
                    data: 'Division'
                },
                {
                    data: 'Product Category'
                },
                {
                    data: 'Delivery Type'
                },
                {
                    data: 'COD'
                },
                {
                    data: 'Order Tracking Id'
                },
                {
                    data: 'Invoice'
                },
                {
                    data: 'Note'
                },
                {
                    data: 'Exchange Status'
                },
                {
                    data: 'Delivery Charge'
                },
                {
                    data: 'Product Code'
                },
                {
                    data: 'Status'
                },
                {
                    data: 'Action'
                },
                {
                    data: 'Update'
                }
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/marchant/js/address.js"></script>

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
                let id = $(this).data('id');
                let merchant_name = $(this).data('merchant_name');
                let merchant_phone = $(this).data('merchant_phone');
                let merchant_email = $(this).data('merchant_email');
                let merchant_address = $(this).data('merchant_address');
                let customer_name = $(this).data('name');
                let phone = $(this).data('phone')
                let address = $(this).data('address')
                let divisions = $(this).data('division')
                let district = $(this).data('dis')
                let police = $(this).data('police')
                let deliveryproduct = $(this).data('deliveryproduct');
                let del = $(this).data('del');
                let cod = $(this).data('cod');
                let invoice = $(this).data('invoice');
                let note = $(this).data('note');
                let exchangeparcel = $(this).data('exchangeparcel');
                let weight = $(this).data('weight');
                let ordertrack = $(this).data('ordertrack');
                let deliverycharge = $(this).data('deliverycharge');
                let is_active = $(this).data('is_active');
                var status_check = '';
                if (is_active == 1) {
                    var status_check = 'Pending'
                } else if (is_active == 2) {
                    var status_check = 'Product On The Way (Pickupman)';
                } else if (is_active == 3) {
                    var status_check = 'Stock (In House)';
                } else if (is_active == 4) {
                    var status_check = 'Product Shiped (Deliveryman)';
                } else if (is_active == 5) {
                    var status_check = 'Delivered (Customer)';
                } else if (is_active == 6) {
                    var status_check = 'Return (In House)';
                } else if (is_active == 7) {
                    var status_check = 'Delivery Cancelled';
                } else if (is_active == '8') {
                    var status_check = 'Delivery Cancelled';
                }

                $('#id').text(id);
                $('#merchant_name').text(merchant_name);
                $('#merchant_phone').text(merchant_phone);
                $('#merchant_email').text(merchant_email);
                $('#merchant_address').text(merchant_address);
                $('#customer_name').text(customer_name);
                $('#customer_phone').text(phone)
                $('#customer_address').text(address)
                $('#customer_divisions').text(divisions)
                $('#customer_distr').text(district);
                $('#customer_policsta').text(police)
                $('#product_category').text(deliveryproduct)
                $('#product_deliverytype').text(del)
                $('#product_cod').text(cod)
                $('#product_invoice').text(invoice)
                $('#product_note').text(note)
                $('#product_exchangeparcel').text(exchangeparcel)
                $('#product_weight').text(weight)
                $('#product_ordertrack').text(ordertrack)
                $('#product_deliverycharge').text(deliverycharge)
                $('#product_is_active').text(status_check)
            });

            $(document).on('click', '.updateDeliveryForm', function(e) {
                let id = $(this).data('id');
                let Customer_name = $(this).data('name');
                let phone = $(this).data('phone')
                let address = $(this).data('address')
                let divisions = $(this).data('division')
                let district = $(this).data('dis')
                let police = $(this).data('police')
                let deliveryproduct = $(this).data('deliveryproduct');
                let del = $(this).data('del');
                let cod = $(this).data('cod');
                let invoice = $(this).data('invoice');
                let note = $(this).data('note');
                let exchangeparcel = $(this).data('exchangeparcel');
                let weight = $(this).data('weight');
                let ordertrack = $(this).data('ordertrack');
                let deliverycharge = $(this).data('deliverycharge');
                let is_active = $(this).data('is_active');

                $('#up_id').val(id);
                $('#Customer_name').val(Customer_name);
                $('#phone').val(phone)
                $('#address').val(address)
                $('#divisions').val(divisions)
                $('#distr').val(district);
                $('#policsta').val(police)
                $('#category').val(deliveryproduct)
                $('#deliverytype').val(del)
                $('#cod').val(cod)
                $('#invoice').val(invoice)
                $('#note').val(note)
                $('#exchangeparcel').val(exchangeparcel)
                $('#weight').val(weight)
                $('#ordertrack').val(ordertrack)
                $('#deliverycharge').val(deliverycharge)
                $('#is_active').val(is_active)
            });

            $(document).on('click', '.update_delivery', function(e) {
                e.preventDefault();
                let up_id = $('#up_id').val();
                let Customer_name = $('#Customer_name').val();
                let phone = $('#phone').val();
                let address = $('#address').val();
                let divisions = $('#divisions').val();
                let district = $('#distr').val();
                let police = $('#policsta').val()
                let deliveryproduct = $('#category').val();
                let del = $('#deliverytype').val();
                let cod = $('#cod').val();
                let invoice = $('#invoice').val();
                let note = $('#note').val();
                let exchangeparcel = $('#exchangeparcel').val();
                let weight = $('#weight').val();
                let ordertrack = $('#ordertrack').val();
                let deliverycharge = $('#deliverycharge').val();
                let is_active = $('#is_active').val()
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('admin.product.delivery.update') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        up_id: up_id,
                        Customer_name: Customer_name,
                        phone: phone,
                        address: address,
                        divisions: divisions,
                        district: district,
                        police: police,
                        deliveryproduct: deliveryproduct,
                        del: del,
                        cod: cod,
                        invoice: invoice,
                        note: note,
                        exchangeparcel: exchangeparcel,
                        weight: weight,
                        ordertrack: ordertrack,
                        deliverycharge: deliverycharge,
                        is_active: is_active,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#updateModal').modal('hide');
                            $('#updateDeliveryFormSubmit').trigger('reset');
                            $('.modal-backdrop').remove();
                            $('#tableData').load(location.href + ' #tableData')
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        $.each(error.errors, function(index, value) {
                            $('.errMsgContainer').append('<span class="text-danger">' +
                                value + '</span>' + '<br>')
                        })
                    }
                })
            })

        });
    </script>


    {{-- for search button submit --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');

            searchForm.submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val().trim();
                console.log(searchInput);
                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}';

                if (searchInput === '') {
                    // If the input is empty, show existingTable and hide searchResultsSection
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

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

                        if (response.customers.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();
                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }
                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();

                if (searchInput === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- for given input and auto search without press search button --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            $('#searchInput').on('input', function(e) {
                e.preventDefault();

                var searchInput = $(this).val().trim();
                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}';

                if (searchInput === '') {
                    // If the input is empty, show existingTable and hide searchResultsSection
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

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

                        if (response.customers.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();

                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val().trim();

                if (searchInput === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- search_button_typue_by_the_admin --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            var searchForm = $('#searchForm');
            var searchInput = $('#searchInput');

            // Function to handle form submission
            function submitForm() {
                var searchInputValue = searchInput.val().trim();

                // If the input is empty, show existingTable and hide searchResultsSection
                if (searchInputValue === '') {
                    existingTable.show();
                    searchResultsSection.hide();
                    return;
                }

                var csrfToken = '{{ csrf_token() }}';
                var searchRoute = '{{ route('admin.search') }}'; // Replace with your actual route

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
                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.customers.length > 0) {
                            $.each(response.customers, function(index, customer) {
                                resultsBody.append('<tr>' +
                                    '<td>' + customer.id + '</td>' +
                                    '<td>' + customer.user.merchant_name + '</td>' +
                                    '<td>' + (customer.pickupman ? customer
                                        .pickupman.pickupman_name : 'No one pickup'
                                    ) + '</td>' +
                                    '<td>' + (customer.deliveryman ? customer
                                        .deliveryman.deliveryman_name :
                                        'No one delivered') + '</td>' +
                                    '<td>' + customer.customer_name + '</td>' +
                                    '<td>' + customer.customer_phone + '</td>' +
                                    '<td>' + customer.full_address + '</td>' +
                                    '<td>' + customer.police_station + '</td>' +
                                    '<td>' + customer.district + '</td>' +
                                    '<td>' + customer.divisions + '</td>' +
                                    '<td>' + customer.product_category + '</td>' +
                                    '<td>' + customer.delivery_type + '</td>' +
                                    '<td>' + customer.cod_amount + '</td>' +
                                    '<td>' + customer.order_tracking_id + '</td>' +
                                    '<td>' + customer.invoice + '</td>' +
                                    '<td>' + customer.note + '</td>' +
                                    '<td>' + customer.exchange_status + '</td>' +
                                    '<td>' + customer.delivery_charge + '</td>' +
                                    '<td>' + getStatusBadge(customer.is_active) +
                                    '</td>' +
                                    '<td>' + getActionButtons(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</td>' +
                                    '<td>' + getUpdateButton(customer.is_active,
                                        customer.id) + '</td>' +
                                    '</tr>');
                            });

                            function getStatusBadge(status) {
                                switch (status) {
                                    case '2':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
                                    case '3':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Stock</span>';
                                    case '4':
                                        return '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
                                    case '5':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>';
                                    case '6':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Return</span>';
                                    case '7':
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
                                    default:
                                        return '<span class="badge bg-label-success me-1 text-dark">Product Pickupman has not reached yet</span>';
                                }
                            }

                            function getActionButtons(status, deliveryId) {
                                if (status === '2') {
                                    return `
                                    <div class="d-flex justify-center align-items-center gap-2">
                                        <form action="{{ route('admin.product.delivery_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success text-white" type="submit">
                                            <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.cancel_confirmation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa-solid fa-times"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else if (status === 'cancelled') {
                                    return '<span class="badge bg-label-success me-1 text-dark">Not accepted</span>';
                                } else if (status === '4') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '5') {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                } else if (status === '3') {
                                    return `
                                        <span class="badge bg-label-success me-1 text-dark">Awaiting response for deliveryman</span>`;
                                } else {
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }

                            function getUpdateButton(isActive, deliveryId) {
                                if (isActive == 3) {
                                    return `
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('admin.product.delivery.edit') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-success" type="submit">
                                            <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.product.delivery.delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="id" value="${deliveryId}">
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>`;
                                } else {
                                    // Default update button for other cases
                                    return '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                                }
                            }
                        } else {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.html(
                                '<tr><td colspan="21" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
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

            // Update the event listener for the form submission
            searchForm.submit(function(e) {
                e.preventDefault(); // prevent the default form submission
                submitForm();
                searchResultsSection.hide();
                existingTable.show();
            });

            // Add event listeners for the input to handle input and keyup events
            searchInput.on('input keyup', function() {
                var searchInputValue = $(this).val().trim();

                if (searchInputValue === '') {
                    // If the input is cleared, hide searchResultsSection, show existingTable
                    searchResultsSection.hide();
                    existingTable.show();
                } else {
                    // Execute the search logic
                    submitForm();
                    searchResultsSection.hide();
                    existingTable.show();
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
                    url: '{{ route('admin.search') }}',
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


    {{-- product_accept_conformation_by_the_admin --}}
    {{-- product_cancel_conformation_by_the_admin --}}
    {{-- product_delete_conformation_by_the_admin --}}
    <script>
        $(document).ready(function() {
            // Use event delegation for form submission
            $(document).on('submit', '#deliveryConfirmationForm', function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Reload the table content after successful form submission
                        // reloadTableData();
                        $('#tableData').load(location.href + ' #tableData')
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#deliveryCancelConfirmationForm', function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Reload the table content after successful form submission
                        // reloadTableData();
                        $('#tableData').load(location.href + ' #tableData')
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });

            $(document).on('submit', '#productDeleteConformation', function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'GET',
                    data: formData,
                    success: function(response) {
                        // Reload the table content after successful form submission
                        // reloadTableData();
                        $('#tableData').load(location.href + ' #tableData')
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            });
        });
    </script>
@endsection
