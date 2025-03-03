@extends('server.layouts.masterlayout')
@section('content')
    <div class="row p-3 my-3">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white py-3">
                        <h5 class="text-color-5 px-3 font-18 font-sm-16">
                            Fraudulent Activity Check
                            <a href="{{ route('admin.fraud_check') }}" class="btn btn-sm btn-info">View all</a>
                        </h5>
                        <hr>
                        <div class="w-100 py-0 my-0">
                            <div class="col-12 pb-0 p-2 mblReportType">
                                <div class="row align-items-end">
                                    <div class="col-sm-12 col-12 mb-sm-0 mb-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <form id="searchForm" action="{{ route('admin.fraud_search') }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="phonenumber"
                                                                class="col-xl-2 col-lg-3 col-md-4 text-color-5 font-20  col-form-label">Recipient
                                                                Phone#</label>
                                                            <div class="col-xl-4 col-lg-5 col-md-8">
                                                                <input type="number" id="phonenumber" name="phone_number"
                                                                    placeholder="Enter 11 digit phone number"
                                                                    class="form-control text-color-5 rounded-1">
                                                                <p class="text-danger py-1 mb-0"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div
                                                                class="col-xl-4 col-lg-5 col-md-8 offset-xl-2 offset-lg-3 offset-md-4 pt-0">
                                                                <button type="submit"
                                                                    class="btn w-100 btn-block bg-success text-white shadow-1">Search</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div id="searchResult">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Placeholder for additional content -->
                            <div class="col-12 px-0 mb-4">
                                <div class="w-100 bg-white rounded">
                                    <!-- Content goes here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault();
    
                var form = $(this);
                var submitButton = form.find('button[type="submit"]');
                var resultContainer = $('#searchResult');
                var phoneNumberInput = $('#phonenumber');
                var errorContainer = $('#errorContainer');
    
                if (phoneNumberInput.val().length !== 11) {
                    if (!errorContainer.length) {
                        errorContainer = $('<div id="errorContainer" class="text-danger"></div>');
                        phoneNumberInput.after(errorContainer);
                    }
                    errorContainer.html('Please enter a valid 11-digit phone number');
                    return;
                } else {
                    errorContainer.remove();
                }
    
                submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Searching...');
    
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(data) {
                        var results = data.result;
                        if (results.length > 0) {
                            var resultHTML = '';
                            results.forEach(function(result) {
                                if (result.pickupman) {
                                    resultHTML += '<p><strong>Complain ID</strong>: ' + result.id + '</p>';
                                    resultHTML += '<p><strong>Name of Complainant</strong>: ' + result.pickupman.pickupman_name + '</p>';
                                    resultHTML += '<p><strong>Complainant Designation</strong>: Pickupman</p>';
                                    resultHTML += '<p><strong>Merchant Phone</strong>: ' + result.phone_number + '</p>';
                                    resultHTML += '<p><strong>Merchant Name</strong>: ' + result.disputant_name + '</p>';
                                    resultHTML += '<p><strong>Complain Details</strong>: ' + result.details + '</p>';

                                } else if (result.user) { // Check if user data is available
                                    resultHTML += '<p><strong>Complain ID</strong>: ' + result.id + '</p>';
                                    resultHTML += '<p><strong>Name of Complaintant</strong>: ' + result.user.merchant_name + '</p>';
                                    resultHTML += '<p><strong>Complaintant Designation</strong>: Merchant</p>';
                                    resultHTML += '<p><strong>Pickupman Phone</strong>: ' + result.phone_number + '</p>';
                                    resultHTML += '<p><strong>pickupman Name</strong>: ' + result.disputant_name + '</p>';
                                    resultHTML += '<p><strong>Complain Details</strong>: ' + result.details + '</p>';

                                } else if (result.deliveryman) { // Check if deliveryman data is available
                                    resultHTML += '<p><strong>Complain ID</strong>: ' + result.id + '</p>';
                                    resultHTML += '<p><strong>Name of Complaintant</strong>: ' + result.deliveryman.deliveryman_name + '</p>';
                                    resultHTML += '<p><strong>Complaintant Designation</strong>: Deliveryman</p>';
                                    resultHTML += '<p><strong>Customer Phone</strong>: ' + result.phone_number + '</p>';
                                    resultHTML += '<p><strong>Customer Name</strong>: ' + result.disputant_name + '</p>';
                                    resultHTML += '<p><strong>Complain Details</strong>: ' + result.details + '</p>';
                                    
                                }
                                resultHTML += '</div>';
                            });
                            resultContainer.html(resultHTML);
                            phoneNumberInput.val('');
                        } else {
                            resultContainer.html('<p>No results found</p>');
                        }
                    },
                    error: function(error) {
                        console.error('Error submitting form:', error);
                    },
                    complete: function() {
                        submitButton.html('Search');
                    }
                });
            });
        });
    </script>
    
@endsection
