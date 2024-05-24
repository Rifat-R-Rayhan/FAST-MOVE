@extends('marchant.layouts.masterlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            {{-- <form id="searchForm" action="{{ route('deliveryme') }}" method="POST">
                @csrf
                <div class="input-group mb-0">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" name="ttt" class="form-control form-control-lg" placeholder="Search by Phone"
                            id="searchInput">
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append ms-2">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </div>
            </form> --}}
            <form id="searchForm">
                <div class="input-group mb-0">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="search" name="admin_delivery_search" class="form-control mr-sm-2" placeholder="Search"
                            id="searchInput">
                    </div>
                    <div class="input-group-append ms-2">
                        <button type="submit" class="btn btn-primary my-2 my-sm-0">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="d-flex justify-content-start gap-4 align-items-center">
                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
                                <option disabled selected>Select Division</option>
                                <option value="Barishal">Barishal</option>
                                <option value="Chattogram">Chattogram</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Sylhet">Sylhet</option>
                            </select>
                            @error('divisions')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();">

                            </select>
                            @error('district')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group w-25">
                            <label for="exampleFormControlSelect2">Select Police Station</label>
                            <select name="police_station" class="form-control" id="polic_sta">

                            </select>
                            @error('police_station')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-light table-hover display nowrap" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange Status</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product weight</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $delivery)
                                <tr class="table-info">
                                    <td>{{ $delivery->id }}</td>
                                    <td>{{ $delivery->customer_name }}</td>
                                    <td>{{ $delivery->customer_phone }}</td>
                                    <td>{{ $delivery->full_address }}</td>
                                    <td>{{ $delivery->police_station }}</td>
                                    <td>{{ $delivery->district }}</td>
                                    <td>{{ $delivery->divisions }}</td>
                                    <td>{{ $delivery->product_category }}</td>
                                    <td>{{ $delivery->delivery_type }}</td>
                                    <td>{{ $delivery->order_tracking_id }}</td>
                                    <td>{{ $delivery->invoice }}</td>
                                    <td>{{ $delivery->note }}</td>
                                    <td>{{ $delivery->exchange_status }}</td>
                                    <td>{{ $delivery->delivery_charge }}</td>
                                    <td>{{ $delivery->cod_amount }}</td>
                                    <td>{{ $delivery->product_weight }}</td>

                                    @if ($delivery->is_active === '1')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Awaiting response <br> for
                                                Pickupman</span></td>
                                    @elseif ($delivery->is_active === '2')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product On <br> the
                                                way</span></td>
                                    @elseif ($delivery->is_active === '3')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Stocked</span></td>
                                    @elseif ($delivery->is_active === '4')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>
                                    @elseif ($delivery->is_active === '5')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Delivered</span></td>
                                    @elseif ($delivery->is_active === '6')
                                        <td><span class="badge bg-label-danger me-1 text-dark">Product Return and <br> now
                                                it's in the <br> ware house</span></td>
                                    @elseif ($delivery->is_active == 7)
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled and <br>
                                                now it's in the <br> ware house</span>
                                        </td>
                                    @elseif ($delivery->is_active == '8')
                                        <td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> by
                                                the admin and <br> now it's in the <br> ware house</span>
                                        </td>
                                    @elseif ($delivery->is_active == '9')
                                        <td><span class="badge bg-label-success me-1 text-dark">Returned product <br>
                                                pickupman
                                                accepted <br>and on the way</span>
                                        </td>
                                    @elseif ($delivery->is_active == '10')
                                        <td><span class="badge bg-label-success me-1 text-dark">Returned product <br>
                                                merchant accepted <br>successfully</span>
                                        </td>
                                    @endif
                                    @if ($delivery->is_active === '8')
                                        <td><span class="badge bg-label-success me-1 text-dark"><br> No action <br>
                                                available</span>
                                        </td>
                                    @elseif($delivery->is_active === '9')
                                        <td>
                                            <div class="d-flex justify-center align-items-center gap-2">
                                                <form id="merchantReturnProductAcceptCoformation"
                                                    action="{{ route('marchant.accept_product_confirmation') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                                                    <button class="btn btn-sm btn-success text-white" type="submit">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @elseif($delivery->is_active === '1')
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-success showMerchantProductButton"
                                                    data-bs-toggle="modal" data-bs-target="#showMerchantproductModal"
                                                    data-id="{{ $delivery->id }}"
                                                    data-customer_name="{{ $delivery->customer_name }}"
                                                    data-customer_phone="{{ $delivery->customer_phone }}"
                                                    data-full_address="{{ $delivery->full_address }}"
                                                    data-police_station="{{ $delivery->police_station }}"
                                                    data-district="{{ $delivery->district }}"
                                                    data-divisions="{{ $delivery->divisions }}"
                                                    data-product_category="{{ $delivery->product_category }}"
                                                    data-delivery_type="{{ $delivery->delivery_type }}"
                                                    data-amount="{{ $delivery->cod_amount }}"
                                                    data-status="{{ $delivery->is_active }}"
                                                    data-order_tracking_id="{{ $delivery->order_tracking_id }}"
                                                    data-invoice="{{ $delivery->invoice }}"
                                                    data-note="{{ $delivery->note }}"
                                                    data-weight="{{ $delivery->product_weight }}"
                                                    data-exchange_status="{{ $delivery->exchange_status }}"
                                                    data-delivery_charge="{{ $delivery->delivery_charge }}"
                                                    id="showProductMerchantForm">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success merchantProductEditModal"
                                                    data-bs-toggle="modal" data-bs-target="#merchantProductEditModal"
                                                    data-idtoedit="{{ $delivery->id }}"
                                                    data-customer_nametoedit="{{ $delivery->customer_name }}"
                                                    data-customer_phonetoedit="{{ $delivery->customer_phone }}"
                                                    data-full_addresstoedit="{{ $delivery->full_address }}"
                                                    data-police_stationtoedit="{{ $delivery->police_station }}"
                                                    data-districttoedit="{{ $delivery->district }}"
                                                    data-divisionstoedit="{{ $delivery->divisions }}"
                                                    data-product_categorytoedit="{{ $delivery->product_category }}"
                                                    data-delivery_typetoedit="{{ $delivery->delivery_type }}"
                                                    data-amounttoedit="{{ $delivery->cod_amount }}"
                                                    data-statustoedit="{{ $delivery->is_active }}"
                                                    data-order_tracking_idtoedit="{{ $delivery->order_tracking_id }}"
                                                    data-invoicetoedit="{{ $delivery->invoice }}"
                                                    data-notetoedit="{{ $delivery->note }}"
                                                    data-exchange_statustoedit="{{ $delivery->exchange_status }}"
                                                    data-delivery_chargetoedit="{{ $delivery->delivery_charge }}"
                                                    data-weighttoedit="{{ $delivery->product_weight }}"
                                                    id="updateDeliveryForm"><i class="fas fa-pencil-alt"></i></button>
                                                <form id="merchantProductDeleteConformation"
                                                    action="{{ route('product.destroy', $delivery->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method ('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <span class="badge bg-label-danger me-1 text-dark">You have <br> No Action
                                                    <br> Available</span>
                                            </div>

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="merchantProductEditModal" tabindex="-1" aria-labelledby="merchantProductEditModalLabel"
        aria-hidden="true">
        <form id="merchantProductEditForm">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="merchantProductupdateModalLabel">Update Delivery Product</h5>
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
                                <input type="text" id="id">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Customer Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control"
                                            id="Customer_nametoedit">
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="order_tracking_id" value="{{ $delivery->numericValue }}">
                                                <input type="hidden" name="user_id" value="{{ $delivery->id }}"> --}}
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Customer Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" id="phonetoedit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" id="addresstoedit">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Division</label>
                                    <input type="text" name="divisions" class="form-control" id="divisionstoedit">
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
                                    <input type="text" name="district" class="form-control" id="distrtoedit">
                                    {{-- <select name="district" class="form-control" id="distr" onchange="thanaList();">
                                        <option selected></option>
                                    </select> --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Police Station</label>
                                    <input type="text" name="police_station" class="form-control"
                                        id="policstatoedit">
                                    {{-- <select name="police_station" class="form-control" id="polic_sta">
                                        <option selected></option>
                                    </select> --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Category Type</label>
                                    <select name="category_type" class="form-control" id="categorytoedit">
                                        <option selected></option>
                                        <option value="Regular">Regular</option>
                                        <option value="Document">Document</option>
                                        <option value="Book">Book</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Delevery Type</label>
                                    <input type="text" name="delivery_type" class="form-control"
                                        id="deliverytypetoedit">
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
                                        <input type="text" name="cod_amount" class="form-control" id="codtoedit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2"
                                        class="col-sm-3 col-form-label">Invoice</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="invoice" class="form-control" id="invoicetoedit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Note</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="note" class="form-control" id="notetoedit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2"
                                        class="col-sm-3 col-form-label">Weight</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="weight" class="form-control" id="weighttoedit">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Exchange Parcel</label>
                                    <select name="exchange_parcel" class="form-control" id="exchangeparceltoedit">
                                        <option selected></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
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
                        <button type="button" class="btn btn-gradient-primary merchantProductEdit">Update
                            Delivery</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="showMerchantproductModal" tabindex="-1" aria-labelledby="showMerchantproductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showMerchantproductModalLabel">Update Delivery Product</h5>
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
                                <h5 class="card-title">Product ID : <span id="productid"></span></h5>
                                <h5 class="card-title">Customer Name : <span id="customername"></span></h5>
                                <h5 class="card-title">Customer Phone : <span id="customerphone"></span></h5>
                                <h5 class="card-title">District : <span id="customerdistrict"></span></h5>
                                <h5 class="card-title">divisions : <span id="customerdivisions"></span></h5>
                                <h5 class="card-title">Police Station : <span id="customerpolicestation"></span></h5>
                                <h5 class="card-title">Full Address : <span id="customerfulladdress"></span></h5>
                                <h5 class="card-title">Product Category : <span id="productcategory"></span></h5>
                                <h5 class="card-title">Delivery Type : <span id="deliverytypeto"></span></h5>
                                <h5 class="card-title">Product Price : <span id="productprice"></span></h5>
                                <h5 class="card-title">Product Status : <span id="productstatus"></span></h5>
                                <h5 class="card-title">Order Tracking ID : <span id="ordertrackingid"></span></h5>
                                <h5 class="card-title">Product Invoice : <span id="productinvoice"></span></h5>
                                <h5 class="card-title">Product Note : <span id="productnote"></span></h5>
                                <h5 class="card-title">Exchange Status : <span id="exchangestatus"></span></h5>
                                <h5 class="card-title">Delivery Charge : <span id="productdeliverycharge"></span></h5>
                                <h5 class="card-title">Product Weight : <span id="productweight"></span></h5>
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


    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="searchResultsSection" class="table-responsive" style="display: none;">
                    <h4 class="card-title">Delivery Table</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Police Station</th>
                                <th scope="col">District</th>
                                <th scope="col">Division</th>
                                <th scope="col">Category Type</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Tracking Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Note</th>
                                <th scope="col">Exchange</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
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
                                '<div><h2>Fast Move Logistic Ltd.</h2><p>Mirpur office: 01913830996</p><h4>Parcel List</h4></div>'
                            );
                    }
                },
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    </script>


    <script src="../marchant/js/address.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    {{-- for input search --}}
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
                $.ajax({
                    url: '{{ route('deliveryme') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'admin_delivery_search': searchInputValue,
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

    {{-- for option search --}}
    <script>
        $(document).ready(function() {
            // Function to submit the search form
            function submitForm() {
                var division = $('#divisions').val();
                var district = $('#distr').val();
                var policeStation = $('#polic_sta').val();

                $.ajax({
                    url: '{{ route('optionsearch') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'division': division,
                        'district': district,
                        'police_station': policeStation,
                    },
                    dataType: 'html',
                    success: function(response) {
                        $('#table').html(response);
                    },
                    error: function(xhr, status, error) {
                        $('#table').load(location.href + ' #table');
                    }
                });
            }
            $('#divisions, #distr, #polic_sta').change(function() {
                submitForm();
            });
        });
    </script>

    {{-- product show edit,delete script --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.showMerchantProductButton', function() {
                let up_id = $(this).data('id');
                let customer_name = $(this).data('customer_name')
                let customer_phone = $(this).data('customer_phone')
                let district = $(this).data('district')
                let divisions = $(this).data('divisions')
                let police_station = $(this).data('police_station')
                let full_address = $(this).data('full_address')
                let product_category = $(this).data('product_category')
                let delivery_type = $(this).data('delivery_type')
                let amount = $(this).data('amount')
                let status = $(this).data('status')
                let order_tracking_id = $(this).data('order_tracking_id')
                let invoice = $(this).data('invoice')
                let note = $(this).data('note')
                let exchange_status = $(this).data('exchange_status')
                let delivery_charge = $(this).data('delivery_charge')
                let weight = $(this).data('weight')

                $('#productid').text(up_id)
                $('#customername').text(customer_name)
                $('#customerphone').text(customer_phone)
                $('#customerdistrict').text(district)
                $('#customerdivisions').text(divisions)
                $('#customerpolicestation').text(police_station)
                $('#customerfulladdress').text(full_address)
                $('#productcategory').text(product_category)
                $('#deliverytypeto').text(delivery_type)
                $('#productprice').text(amount)
                if (status == 1) {
                    $('#productstatus').text("pending")
                } else if (status == 2) {
                    $('#productstatus').text("On the way")
                } else if (status == 3) {
                    $('#productstatus').text("stocked")
                } else if (status == 4) {
                    $('#productstatus').text("shiped")
                } else if (status == 5) {
                    $('#productstatus').text("deliverd")
                } else if (status == 6) {
                    $('#productstatus').text("Return")
                } else if (status == 7) {
                    $('#productstatus').text("cancel")
                } else if (status === 'cancelled') {
                    $('#productstatus').text("Product cancelled <br> by the admin")
                }
                $('#ordertrackingid').text(order_tracking_id)
                $('#productinvoice').text(invoice)
                $('#productnote').text(note)
                $('#exchangestatus').text(exchange_status)
                $('#productdeliverycharge').text(delivery_charge)
                $('#productweight').text(weight)

            });
            $(document).on('click', '.merchantProductEditModal', function() {
                let up_idtoedit = $(this).data('idtoedit');
                let customer_name = $(this).data('customer_nametoedit')
                let customer_phone = $(this).data('customer_phonetoedit')
                let district = $(this).data('districttoedit')
                let divisions = $(this).data('divisionstoedit')
                let police_station = $(this).data('police_stationtoedit')
                let full_address = $(this).data('full_addresstoedit')
                let product_category = $(this).data('product_categorytoedit')
                let delivery_type = $(this).data('delivery_typetoedit')
                let amount = $(this).data('amounttoedit')
                let status = $(this).data('statustoedit')
                let order_tracking_id = $(this).data('order_tracking_idtoedit')
                let invoice = $(this).data('invoicetoedit')
                let note = $(this).data('notetoedit')
                let exchange_status = $(this).data('exchange_statustoedit')
                let weight = $(this).data('weighttoedit')


                $('#id').val(up_idtoedit);
                $('#Customer_nametoedit').val(customer_name);
                $('#phonetoedit').val(customer_phone);
                $('#addresstoedit').val(full_address);
                $('#divisionstoedit').val(divisions);
                $('#distrtoedit').val(district);
                $('#policstatoedit').val(police_station);
                $('#categorytoedit').val(product_category);
                $('#deliverytypetoedit').val(delivery_type);
                $('#codtoedit').val(amount);
                $('#invoicetoedit').val(invoice);
                $('#notetoedit').val(note);
                $('#weighttoedit').val(weight);
                $('#exchangeparceltoedit').val(exchange_status);
            });

            $(document).on('click', '.merchantProductEdit', function(e) {
                e.preventDefault();

                let up_id = $('#id').val();
                let Customer_name = $('#Customer_nametoedit').val();
                let phone = $('#phonetoedit').val();
                let address = $('#addresstoedit').val();
                let divisions = $('#divisionstoedit').val();
                let district = $('#distrtoedit').val();
                let police = $('#policstatoedit').val();
                let deliveryproduct = $('#categorytoedit').val();
                let del = $('#deliverytypetoedit').val();
                let cod = $('#codtoedit').val();
                let invoice = $('#invoicetoedit').val();
                let note = $('#notetoedit').val();
                let weight = $('#weighttoedit').val();
                let exchangeparcel = $('#exchangeparceltoedit').val();

                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('product.update', ['product' => ':up_id']) }}"
                        .replace(':up_id', up_id),
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        '_token': csrfToken,
                        '_method': 'PUT',
                        id: up_id,
                        customer_name: Customer_name,
                        customer_phone: phone,
                        full_address: address,
                        divisions: divisions,
                        district: district,
                        police_station: police,
                        product_category: deliveryproduct,
                        delivery_type: del,
                        cod_amount: cod,
                        invoice: invoice,
                        note: note,
                        exchange_status: exchangeparcel,
                        product_weight: weight,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#merchantProductEditModal').modal('hide');
                            $('#merchantProductEditForm').trigger('reset');
                            $('.modal-backdrop').remove();
                            $('#table').load(location.href + ' #table')
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
            });

            $(document).on('submit', '#merchantProductDeleteConformation', function(event) {
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
            $(document).on('submit', '#merchantReturnProductAcceptCoformation', function(event) {
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

        });
    </script>








    {{-- declear route for input --}}
    {{-- <script>
        var routeUrls = {
            show: '{{ route('product.show', ':id') }}',
            edit: '{{ route('product.edit', ':id') }}',
            destroy: '{{ route('product.destroy', ':id') }}',
        }
    </script> --}}

    {{-- for input --}}
    {{-- <script>
        $(document).ready(function() {
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');

            // Initial setup: hide search results, show existing table
            existingTable.show();
            searchResultsSection.hide();

            $('#searchForm').submit(function(e) {
                e.preventDefault();

                var searchInput = $('#searchInput').val();


                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('delivery') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchInput,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        if (response.deliveries.length > 0) {
                            var resultsBody = $('#searchResultsBody');
                            resultsBody.empty();

                            $.each(response.deliveries, function(index, delivery) {
                                var statusBadge = '';
                                if (delivery.is_active == '1') {
                                    statusBadge =
                                        '<span class="badge bg-label-danger me-1 text-dark">pending</span>';
                                } else if (delivery.is_active === '2') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">On the way</span>';
                                } else if (delivery.is_active === '3') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Checkout</span>';
                                } else if (delivery.is_active === 'canceled') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Cancelled</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Delivered</span>';
                                }
                                var actionButtons = '';
                                if (delivery.is_active == 1) {
                                    actionButtons =
                                        '<div class="d-flex justify-center align-items-center gap-2">' +
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-check"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '<form action="{{ route('marchant.cancel_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        ' <i class="fa-solid fa-times"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>';
                                } else if (delivery.is_active === 'canceled') {
                                    actionButtons =
                                        '<span class="badge bg-label-success me-1 text-dark">Not allowed</span>';
                                } else {
                                    actionButtons =
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' +
                                        delivery.id + '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fas fa-truck"></i>' +
                                        '</button>' +
                                        '</form>';
                                }
                                var actionButtons2 = `
                                    <td>
                                    <div class="d-flex justify-content-center gap-2">
                                    <a href="${routeUrls.show.replace(':id', delivery.id)}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="${routeUrls.edit.replace(':id', delivery.id)}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="${routeUrls.destroy.replace(':id', delivery.id)}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    </div>
                                    </td>
                                    `;

                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.name + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.address + '</td>' +
                                    '<td>' + delivery.police_station + '</td>' +
                                    '<td>' + delivery.district + '</td>' +
                                    '<td>' + delivery.divisions + '</td>' +
                                    '<td>' + delivery.category_type + '</td>' +
                                    '<td>' + delivery.delivery_type + '</td>' +
                                    '<td>' + delivery.order_tracking_id + '</td>' +
                                    '<td>' + delivery.invoice + '</td>' +
                                    '<td>' + delivery.note + '</td>' +
                                    '<td>' + statusBadge + '</td>' +
                                    '<td>' + actionButtons + '</td>' +
                                    actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            // No search results, you can handle this case if needed
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            });

            // Add an event listener for the input to handle clearing
            $('#searchInput').on('input', function() {
                var searchInput = $(this).val();

                if (searchInput === '') {
                    // If the input is cleared, hide search results, show existing table
                    searchResultsSection.hide();
                    existingTable.show();
                }
            });
        });
    </script> --}}

    {{-- for option --}}
    {{-- <script>
        $(document).ready(function() {
            // Initial setup: hide search results, show existing table
            var existingTable = $('#existingTable');
            var searchResultsSection = $('#searchResultsSection');
            existingTable.show();
            searchResultsSection.hide();

            // Function to load data based on divisions and districts
            function loadDataBasedOnDivisionsAndDistricts() {
                var searchoptionId = $('#divisions').val();
                var searchoptionId2 = $('#distr').val();
                var searchoptionId3 = $('#polic_sta').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('optionsearch') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        search: searchoptionId,
                        search2: searchoptionId2,
                        search3: searchoptionId3,
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Show search results, hide existing table
                        existingTable.hide();
                        searchResultsSection.show();

                        console.log('Ajax Response:', response); // Add this line for debugging

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.empty();

                        if (response.deliveries.length > 0) {
                            $.each(response.deliveries, function(index, delivery) {
                                var statusBadge = '';
                                if (delivery.is_active == 1) {
                                    statusBadge =
                                        '<span class="badge bg-label-danger me-1 text-dark">pending</span>';
                                } else if (delivery.is_active === 'canceled') {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">Canceled</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge bg-label-success me-1 text-dark">On the way</span>';
                                }

                                var actionButtons = '';
                                if (delivery.is_active == 1) {
                                    actionButtons =
                                        '<div class="d-flex justify-center align-items-center gap-2">' +
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-check"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '<form action="{{ route('marchant.cancel_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fa-solid fa-times"></i>' +
                                        '</button>' +
                                        '</form>' +
                                        '</div>';
                                } else if (delivery.is_active === 'canceled') {
                                    actionButtons =
                                        '<span class="badge bg-label-success me-1 text-dark">Not allowed</span>';
                                } else {
                                    actionButtons =
                                        '<form action="{{ route('marchant.delivery_confirmation') }}" method="post">' +
                                        '@csrf' +
                                        '<input type="hidden" name="id" value="' + delivery.id +
                                        '">' +
                                        '<button class="btn btn-sm btn-success" type="submit">' +
                                        '<i class="fas fa-truck"></i>' +
                                        '</button>' +
                                        '</form>';
                                }

                                var actionButtons2 = `
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="${routeUrls.show.replace(':id', delivery.id)}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="${routeUrls.edit.replace(':id', delivery.id)}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="${routeUrls.destroy.replace(':id', delivery.id)}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                `;

                                // Append a new row to the search results table for each result
                                resultsBody.append('<tr>' +
                                    '<td>' + delivery.id + '</td>' +
                                    '<td>' + delivery.name + '</td>' +
                                    '<td>' + delivery.phone + '</td>' +
                                    '<td>' + delivery.address + '</td>' +
                                    '<td>' + delivery.police_station + '</td>' +
                                    '<td>' + delivery.district + '</td>' +
                                    '<td>' + delivery.divisions + '</td>' +
                                    '<td>' + delivery.category_type + '</td>' +
                                    '<td>' + delivery.delivery_type + '</td>' +
                                    '<td>' + delivery.order_tracking_id + '</td>' +
                                    '<td>' + delivery.invoice + '</td>' +
                                    '<td>' + delivery.note + '</td>' +
                                    '<td>' + delivery.exchange_parcel + '</td>' +
                                    '<td>' + statusBadge + '</td>' +
                                    actionButtons2 +
                                    // Add more columns as needed
                                    '</tr>');
                            });
                        } else {
                            // No search results, display a message or handle it as needed
                            resultsBody.html(
                                '<tr><td colspan="15" class="text-center fw-bold">No data found for the selected inputs.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);

                        var resultsBody = $('#searchResultsBody');
                        resultsBody.html(
                            '<tr><td colspan="4">Error fetching search results. Please try again.</td></tr>'
                        );
                        existingTable.show();
                    }
                });
            }

            // Attach the event listener to all three select elements
            $('#divisions, #distr, #polic_sta').on('change', loadDataBasedOnDivisionsAndDistricts);
        });
    </script> --}}
@endsection
