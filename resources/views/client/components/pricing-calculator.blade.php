<div class="hero-content mb-3">
    <div class="content-1">
        <div class="left p-4">
            {{-- <h4 class="text-light">Track Your Parcel Here!</h4> --}}
            <div class="track-img">
                <img src="/frontend/info/track.png" alt="">
            </div>
            <h4 class="text-light mt-4">{{ __('text.content16') }}</h4>
            <div class="mb-3">
                <form id="searchForm">
                    @csrf
                    {{-- <input type="text" class="form-control mb-2" name="tracking_id" placeholder="Tracking ID....." /> --}}
                    <input type="text" class="form-control mb-2" name="tracking_id"
                        placeholder="{{ __('text.content17') }}" />
                    {{-- <button type="button" class="btn btn-light" id="trackBtn" disabled>Track</button> --}}
                    <button type="button" class="btn btn-light" id="trackBtn"
                        disabled>{{ __('text.content18') }}</button>
                </form>
            </div>
        </div>

        <div class="right">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/frontend/info/c2.jpg" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/info/c3.jpg" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/info/c3.jpg" class="d-block w-100" alt="..." />
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>


    </div>

    <div class="content-2">
        <div class="left">
            <video width="100%" height="100%" controls>
                <source src="/frontend/video/nature.mp4" type="video/mp4" />
            </video>

        </div>

        <div class="right">
            {{-- <h4 class="text-dark">Calculate Charge</h4> --}}
            <h4 class="text-dark">{{ __('text.content20') }}</h4>
            <div class="boxes d-md-flex d-sm-block gap-2" style="justify-content: space-between;">
                <select id="fromLocation" name="from_location" class="form-control">
                    {{-- <option value="Dhaka">From</option> --}}
                    <option value="Dhaka">{{ __('text.content21') }}</option>
                    @foreach ($fromLocations as $location)
                        <option value="{{ $location->from_location }}">{{ $location->from_location }}</option>
                    @endforeach
                </select>
                <select id="destination" name="destination" class="form-control">
                    {{-- <option value="Dhaka">Destination</option> --}}
                    <option value="Dhaka">{{ __('text.content22') }}</option>
                </select>
                <select id="serviceId" name="service" class="form-control">
                    {{-- <option value="1">Delivery Type</option> --}}
                    <option value="1">{{ __('text.content23') }}</option>
                </select>
                <!--<div class="">-->
                <!--    {{-- <input type="text" id="weightId" name="weight" value="1" placeholder="Parcel's Weight"-->
                <!--        class="form-control" readonly> --}}-->
                <!--    <input type="text" id="weightId" name="weight" value="1 kg" placeholder="Parcel's Weight"-->
                <!--        class="form-control" readonly>-->
                <!--</div>-->
            </div>
            <div class="price-text d-flex justify-content-center align-items-center gap-2">
                <div class="w-25">
                    {{-- <input type="text" id="weightId" name="weight" value="1" placeholder="Parcel's Weight"
                        class="form-control" readonly> --}}
                    <input type="text" id="weightId" name="weight" value="1 kg" placeholder="Parcel's Weight"
                        class="form-control" readonly>
                </div>
                <input type="text" id="valueId" class="form-control w-25 text-dark inputsearch"
                    value="TK">
            </div>

        </div>

    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

<div class="modal" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document"style="max-width: 80vw;">
        <div class="modal-content" style="max-height: 80vh; overflow-y: auto;">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel">Track Your Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your wizard structure -->
                <section class="step-wizard">
                    <ul class="step-wizard-list py-5">
                        <li class="step-wizard-item current-item">
                            <span class="progress-count">1</span>
                            <span class="progress-label">Pending</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">2</span>
                            <span class="progress-label">On the way</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">3</span>
                            <span class="progress-label">Checkout</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">4</span>
                            <span class="progress-label">Shiped</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">5</span>
                            <span class="progress-label">Deliverd</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">6</span>
                            <span class="progress-label">Return</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">7</span>
                            <span class="progress-label">Cancelled</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">8</span>
                            <span class="progress-label">Cancel By Admin</span>
                        </li>
                    </ul>
                </section>
                <p id="noDataMessage" class="text-center" style="display: none;">Your Query doesn't exits in our
                    database</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

{{-- for the calculate delivery charge --}}
{{-- <script src="/frontend/js/delivey_charge_calculator.js"></script> --}}

<script>
    $(document).ready(function() {
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        $('#weightId').on('input', function() {
            var weightValue = parseFloat($(this).val());
            if (weightValue || weightValue === 0) {
                showLoadingIcon();
                setTimeout(function() {
                    updateDeliveryCharge();
                    hideLoadingIcon();
                }, 1000);
            } else {
                hideLoadingIcon();
            }
        });

        $('#fromLocation, #destination, #serviceId').on('change', function() {
            showLoadingIcon();
            setTimeout(function() {
                updateDeliveryCharge();
                hideLoadingIcon();
            }, 1000);
        });

        function updateDeliveryCharge() {
            let fromLocation = $('#fromLocation').val();
            let destination = $('#destination').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            $('.form-control.w-25.py-3').val('');

            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data.deliveryCharge.cost);
                    if (data && data.deliveryCharge && data.deliveryCharge.cost !== undefined) {
                        $('#valueId').val(data.deliveryCharge.cost + 'TK');
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showLoadingIcon() {
            $('.inputsearch').after(
                '<span class="loading-icon spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        }

        function hideLoadingIcon() {
            $('.loading-icon').remove();
        }

        var fromLocation;
        var destination;
        var selectedCategory;
        $('#fromLocation').change('change', function() {
            fromLocation = $(this).val();
            console.log("Updated fromLocation value:", fromLocation);

            // Enable or disable the weightId input based on the fromLocation value
            if (fromLocation) {
                $('#weightId').prop('readonly', false);
            } else {
                $('#weightId').prop('readonly', true);
            }

            $.ajax({
                url: '/get-destinations',
                type: 'GET',
                data: {
                    from_location: fromLocation
                },
                success: function(data) {
                    var destinationDropdown = $('#destination');
                    destinationDropdown.empty();
                    $.each(data, function(index, destination) {
                        destinationDropdown.append('<option value="' + destination
                            .destination + '">' + destination.destination +
                            '</option>');
                    });
                    $('#category').empty();
                    $('#category').append(
                        '<option value="" selected>Select Category</option>');
                    $('#serviceId').empty();
                    $('#serviceId').append(
                        '<option value="" selected>Select Category</option>');
                }
            });
        });

        $('#destination').on('click', function() {
            var destination = $(this).val();
            console.log("Updated destination value:", destination);
            $.ajax({
                url: '/get-categories',
                type: 'GET',
                data: {
                    destination: destination
                },
                success: function(data) {
                    var categoryDropdown = $('#category');
                    console.log(data);
                    categoryDropdown.empty();
                    $.each(data, function(index, category) {
                        categoryDropdown.append('<option value="' + category
                            .category + '">' + category.category + '</option>');
                    });
                }
            });

            $.ajax({
                url: '/get-services',
                type: 'GET',
                data: {
                    destination: destination
                },
                success: function(serviceData) {
                    var serviceDropdown2 = $('#serviceId');
                    serviceDropdown2.empty();
                    $.each(serviceData, function(index, service) {
                        serviceDropdown2.append('<option value="' + service
                            .delivery_type + '">' + service.delivery_type +
                            '</option>');
                    });
                }
            });
        });

        $('#category').on('click', function() {
            var selectedCategory = $(this).val();
            console.log("Selected Category:", selectedCategory);
        });
    });
</script>


{{-- for the tracking --}}
{{-- <script>
    $(document).ready(function() {
        $('.step-wizard').hide();

        function performAjaxCall(trackingId) {
            $.ajax({
                type: 'POST',
                url: '{{ route('search.delivery') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tracking_id': trackingId
                },
                success: function(data) {
                    var is_active = parseInt(data.delivery.is_active, 10);
                    progressCountValue = is_active + 1;
                    console.log(progressCountValue)
                    updateActiveStep(progressCountValue);
                    $('.step-wizard').show();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        $('#searchForm input[name="tracking_id"]').on('input', function(e) {
            var trackingId = $(this).val();
            if (e.originalEvent.inputType === 'deleteContentBackward' && trackingId.length < 6) {
                $('.step-wizard').hide();
                $('#trackingModal').modal('hide');
                return;
            }

            if (trackingId.length === 6) {
                performAjaxCall(trackingId);
                $('#trackingModal').modal('show');
            } else {
                $('.step-wizard').hide();
                $('#trackingModal').modal('hide');
            }
        });

        $('#trackBtn').on('click', function(e) {
            e.preventDefault();
            var trackingId = $('#searchForm input[name="tracking_id"]').val();
            performAjaxCall(trackingId);
            $('#trackingModal').modal('show');
        });

        function updateActiveStep(progressCountValue) {
            $('.step-wizard-item').removeClass('current-item');
            $('.step-wizard-item').each(function() {
                var stepValue = parseInt($(this).find('.progress-count').text());

                if (stepValue == progressCountValue) {
                    $(this).addClass('current-item');
                }
            });
        }
    });
    $(document).ready(function() {
        $('#trackingModal').on('show.bs.modal', function() {});

        $('#trackingModal').on('hide.bs.modal', function() {
            $('.step-wizard').hide();
            $('#searchForm input[name="tracking_id"]').val('');
        });

        $('#trackingModal').on('hidden.bs.modal', function() {});
    });
</script> --}}

{{-- disable track_button code --}}
<script>
    $(document).ready(function() {
        $('.step-wizard').hide();

        function performAjaxCall(trackingId) {
            $.ajax({
                type: 'POST',
                url: '{{ route('search.delivery') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tracking_id': trackingId
                },
                success: function(data) {
                    if (data && data.delivery && data.delivery.is_active) {
                        var is_active = parseInt(data.delivery.is_active, 10);
                        progressCountValue = is_active + 1;
                        updateActiveStep(progressCountValue);
                        $('#noDataMessage').hide();
                        $('.step-wizard').show();
                    } else {
                        $('#noDataMessage').show();
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        $('#searchForm input[name="tracking_id"]').on('input', function(e) {
            var trackingId = $(this).val();

            if (e.originalEvent.inputType === 'deleteContentBackward' && trackingId.length === 0) {
                $('#trackBtn').prop('disabled', true);
                return;
            }

            if (trackingId.length === 6) {} else {
                $('#trackBtn').prop('disabled', false);
                return;
            }

            if (e.originalEvent.inputType === 'deleteContentBackward' && trackingId.length < 6) {
                $('.step-wizard').hide();
                $('#trackingModal').modal('hide');
                return;
            }
            performAjaxCall(trackingId);
            $('#trackingModal').modal('show');
        });

        $('#trackBtn').on('click', function(e) {
            e.preventDefault();
            var trackingId = $('#searchForm input[name="tracking_id"]').val();
            performAjaxCall(trackingId);
            $('#trackingModal').modal('show');
        });

        function updateActiveStep(stepValue) {
            $('.step-wizard-item').removeClass('current-item');
            $('.step-wizard-item').hide();
            if (stepValue == 1) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(4)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 2) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(4)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 3) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(4)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 4) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(4)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 5) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(4)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 6) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(5)').show();
            } else if (stepValue == 7) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(6)').show();
            } else if (stepValue == 8) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(7)').show();
            } else if (stepValue == 9) {
                $('.step-wizard-item:nth-child(1)').show();
                $('.step-wizard-item:nth-child(2)').show();
                $('.step-wizard-item:nth-child(3)').show();
                $('.step-wizard-item:nth-child(8)').show();
            } else {
                $('.step-wizard-item').show();
                // Show all steps if stepValue doesn't match any condition
            }
            // Highlight the current step
            $('.step-wizard-item:nth-child(' + stepValue + ')').addClass('current-item');
        }

        $('#trackingModal').on('hide.bs.modal', function() {
            $('.step-wizard').hide();
            // $('#searchForm input[name="tracking_id"]').val('');
            // $('#trackBtn').prop('disabled', true);
        });
    });
</script>

