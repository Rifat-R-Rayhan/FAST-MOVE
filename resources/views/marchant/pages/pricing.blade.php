{{-- @extends('marchant.layouts.masterlayout')

@section('content')
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row gy-5 gx-4">
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="FromId">From</label>
                    <select id="FromId" name="from_location" class="form-control">
                        <option value="Dhaka City">
                            Dhaka City
                        </option>
                        <option value="Bagerhat">
                            Bagerhat
                        </option>
                        <option value="Bandarban">
                            Bandarban
                        </option>
                        <option value="Barguna">
                            Barguna
                        </option>
                        <option value="Barishal">
                            Barishal
                        </option>
                        <option value="Bhola">
                            Bhola
                        </option>
                        <option value="Bogra">
                            Bogra
                        </option>
                        <option value="Brahmanbaria">
                            Brahmanbaria
                        </option>
                        <option value="Chandpur">
                            Chandpur
                        </option>
                        <option value="Chapainawabganj">
                            Chapainawabganj
                        </option>
                        <option value="Chittagong2">
                            Chittagong
                        </option>
                        <option value="Chuadanga">
                            Chuadanga
                        </option>
                        <option value="Cox's Bazar">
                            Cox's Bazar
                        </option>
                        <option value=" Cumilla">
                            Cumilla
                        </option>

                        <option value="Dhaka Sub-Urban">
                            Dhaka Sub-Urban
                        </option>
                        <option value=" Dinajpur">
                            Dinajpur
                        </option>
                        <option value="Faridpur">
                            Faridpur
                        </option>
                        <option value="Feni">
                            Feni
                        </option>
                        <option value="Gaibandha">
                            Gaibandha
                        </option>
                        <option value="Gazipur">
                            Gazipur
                        </option>
                        <option value="Gopalganj">
                            Gopalganj
                        </option>
                        <option value="Habiganj">
                            Habiganj
                        </option>
                        <option value="Jamalpur">
                            Jamalpur
                        </option>
                        <option value="Jashore">
                            Jashore
                        </option>
                        <option value="Jhalokati">
                            Jhalokati
                        </option>
                        <option value="Jhenaidah">
                            Jhenaidah
                        </option>
                        <option value="Joypurhat">
                            Joypurhat
                        </option>
                        <option value="Khagrachori">
                            Khagrachori
                        </option>
                        <option value="Khulna">
                            Khulna
                        </option>
                        <option value="Kishoreganj">
                            Kishoreganj
                        </option>
                        <option value="Kurigram">
                            Kurigram
                        </option>
                        <option value="Kustia">
                            Kustia
                        </option>
                        <option value="Lalmonirhat">
                            Lalmonirhat
                        </option>
                        <option value="29">
                            Laxmipur
                        </option>
                        <option value="62">
                            Madaripur
                        </option>
                        <option value="31">
                            Magura
                        </option>
                        <option value="32">
                            Manikganj
                        </option>
                        <option value="51">
                            Meherpur
                        </option>
                        <option value="40">
                            Moulvibazar
                        </option>
                        <option value="35">
                            Munshiganj
                        </option>
                        <option value="11">
                            Mymenshingh
                        </option>
                        <option value="55">
                            Naogaon
                        </option>
                        <option value="48">
                            Narail
                        </option>
                        <option value="13">
                            Narayanganj
                        </option>
                        <option value="10">
                            Narshindi
                        </option>
                        <option value="22">
                            Natore
                        </option>
                        <option value="50">
                            Netrokona
                        </option>
                        <option value="24">
                            Nilphamari
                        </option>
                        <option value="8">
                            Noakhali
                        </option>
                        <option value="41">
                            Pabna
                        </option>
                        <option value="54">
                            Panchgarh
                        </option>
                        <option value="45">
                            Patuakhali
                        </option>
                        <option value="49">
                            Pirojpur
                        </option>
                        <option value="39">
                            Rajbari
                        </option>
                        <option value="5">
                            Rajshahi
                        </option>
                        <option value="47">
                            Rangamati
                        </option>
                        <option value="4">
                            Rangpur
                        </option>
                        <option value="63">
                            Shariatpur
                        </option>
                        <option value="53">
                            Shatkhira
                        </option>
                        <option value="60">
                            Sherpur
                        </option>
                        <option value="33">
                            Sirajganj
                        </option>
                        <option value="65">
                            Sunamganj
                        </option>
                        <option value="3">
                            Sylhet
                        </option>
                        <option value="17">
                            Tangail
                        </option>
                        <option value="46">
                            Thakurgaon
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="destinationId">Destination</label> <select id="destinationId"
                        name="destination" class="form-control">
                        <option value="Dhaka City">
                            Dhaka City
                        </option>
                        <option value="Bagerhat">
                            Bagerhat
                        </option>
                        <option value="61">
                            Bandarban
                        </option>
                        <option value="57">
                            Barguna
                        </option>
                        <option value="7">
                            Barishal
                        </option>
                        <option value="38">
                            Bhola
                        </option>
                        <option value="16">
                            Bogra
                        </option>
                        <option value="19">
                            Brahmanbaria
                        </option>
                        <option value="20">
                            Chandpur
                        </option>
                        <option value="58">
                            Chapainawabganj
                        </option>
                        <option value="2">
                            Chittagong
                        </option>
                        <option value="30">
                            Chuadanga
                        </option>
                        <option value="42">
                            Cox's Bazar
                        </option>
                        <option value="9">
                            Cumilla
                        </option>
                        <option value="18">
                            Dhaka Sub-Urban
                        </option>
                        <option value="15">
                            Dinajpur
                        </option>
                        <option value="28">
                            Faridpur
                        </option>
                        <option value="21">
                            Feni
                        </option>
                        <option value="23">
                            Gaibandha
                        </option>
                        <option value="14">
                            Gazipur
                        </option>
                        <option value="44">
                            Gopalganj
                        </option>
                        <option value="34">
                            Habiganj
                        </option>
                        <option value="26">
                            Jamalpur
                        </option>
                        <option value="Jashore">
                            Jashore
                        </option>
                        <option value="59">
                            Jhalokati
                        </option>
                        <option value="43">
                            Jhenaidah
                        </option>
                        <option value="64">
                            Joypurhat
                        </option>
                        <option value="52">
                            Khagrachori
                        </option>
                        <option value="6">
                            Khulna
                        </option>
                        <option value="12">
                            Kishoreganj
                        </option>
                        <option value="56">
                            Kurigram
                        </option>
                        <option value="27">
                            Kustia
                        </option>
                        <option value="37">
                            Lalmonirhat
                        </option>
                        <option value="29">
                            Laxmipur
                        </option>
                        <option value="62">
                            Madaripur
                        </option>
                        <option value="31">
                            Magura
                        </option>
                        <option value="32">
                            Manikganj
                        </option>
                        <option value="51">
                            Meherpur
                        </option>
                        <option value="40">
                            Moulvibazar
                        </option>
                        <option value="35">
                            Munshiganj
                        </option>
                        <option value="11">
                            Mymenshingh
                        </option>
                        <option value="55">
                            Naogaon
                        </option>
                        <option value="48">
                            Narail
                        </option>
                        <option value="13">
                            Narayanganj
                        </option>
                        <option value="10">
                            Narshindi
                        </option>
                        <option value="22">
                            Natore
                        </option>
                        <option value="50">
                            Netrokona
                        </option>
                        <option value="24">
                            Nilphamari
                        </option>
                        <option value="8">
                            Noakhali
                        </option>
                        <option value="41">
                            Pabna
                        </option>
                        <option value="54">
                            Panchgarh
                        </option>
                        <option value="45">
                            Patuakhali
                        </option>
                        <option value="49">
                            Pirojpur
                        </option>
                        <option value="39">
                            Rajbari
                        </option>
                        <option value="5">
                            Rajshahi
                        </option>
                        <option value="47">
                            Rangamati
                        </option>
                        <option value="4">
                            Rangpur
                        </option>
                        <option value="63">
                            Shariatpur
                        </option>
                        <option value="53">
                            Shatkhira
                        </option>
                        <option value="60">
                            Sherpur
                        </option>
                        <option value="33">
                            Sirajganj
                        </option>
                        <option value="65">
                            Sunamganj
                        </option>
                        <option value="3">
                            Sylhet
                        </option>
                        <option value="17">
                            Tangail
                        </option>
                        <option value="46">
                            Thakurgaon
                        </option>
                    </select></div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Category</label>
                    <select id="categoryId" name="category" class="form-control">
                        <option value="Regular">Regular</option>
                        <option value="Document">Document</option>
                        <option value="Book">Book</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Service</label> <select id="serviceId" name="service"
                        class="form-control">
                        <option value="1">Regular</option>
                        <option value="2">Same Day</option>
                    </select></div>
            </div>
            <div class="col-md-2 col-12">
                <div class="form-group"><label for="weightId">Weight (KG)</label> <input type="text"
                        id="weightId" name="weight" value="1" placeholder="Parcel's Weight"
                        class="form-control"></div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <input type="text" id="valueId" class="form-control w-25 py-3 text-dark" value="50TK">
        </div>


        <div class="text-center mt-4">
            <span class="d-block mt-2">* ১% ক্যাশ অন ডেলিভারি ও রিস্ক ম্যানেজমেন্ট চার্জ প্রযোজ্য </span>
            <span class="d-block mt-2">* পার্সেল সাইজের কারণে ডেলিভারি মাশুল পরিবর্তিত হতে পারে </span>
            <span class="d-block mt-2">* উক্ত চার্জসমূহ ভ্যাট ও ট্যাক্স ব্যাতিত </span>
            <span class="d-block mt-2">* অনাকাঙ্ক্ষিত কারণবশত ডেলিভারি সময়ের পরিবর্তন হতে পারে</span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle change event of form fields and make AJAX request
        $('select, input').change(function() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            
            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge
                        .price !== undefined) {
                        // Update the value of the input field
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price +
                            'TK');
                    } else {
                        console.error('Invalid response format');
                    }
                },
                error: function(error) {
                    // console.error(error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Initial state: disable and make readonly the input field
        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        // Handle change event of form fields and make AJAX request
        $('select, input').change(function() {
            let fromLocation = $('#FromId').val();
            let destination = $('#destinationId').val();
            let category = $('#categoryId').val();
            let service = $('#serviceId').val();
            var weight = parseFloat($('#weightId').val());
            
            $.ajax({
                url: '/calculate_delivery_charge',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'from_location': fromLocation,
                    'destination': destination,
                    'category': category,
                    'service': service,
                    'weight': weight,
                },
                success: function(data) {
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        // Update the value of the input field
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');

                        // Enable the input field and make it readonly after updating the value
                        $('.form-control.w-25.py-3').prop('disabled', false).prop('readonly', true);
                    } else {
                        console.error('Invalid response format');
                    }
                },
                error: function(error) {
                    // Handle error if needed
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection --}}

@extends('marchant.layouts.masterlayout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 600px;">
            <h1 class="mb-3">Calculate Delivery Charge</h1>
            <p class="mb-1">We provide efficient and affordable charge services.</p>
        </div>
        <div class="row gy-5 gx-4">
            <div class="col-md-3 col-6">
                <div class="form-group"><label for="FromId">From</label>
                    <select id="fromLocation" name="from_location" class="form-control">
                        <option value="Dhaka">Dhaka</option>
                        @foreach ($fromLocations as $location)
                            <option value="{{ $location->from_location }}">{{ $location->from_location }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="form-group">
                    <label for="destinationId">Destination</label>
                    <select id="destination" name="destination" class="form-control">
                        <option value="Dhaka">Dhaka</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group"><label for="serviceId">Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value="Regular">Regular</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="form-group">
                    <label for="serviceId">Service</label>
                    <select id="serviceId" name="service" class="form-control">
                        <option value="1">Regular</option>
                        <option value="2">Same Day</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-12">
                <div class="form-group">
                    <label for="weightId">Weight (KG)</label>
                    <input type="text" id="weightId" name="weight" value="1" placeholder="Parcel's Weight"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 tt">
            <input type="text" id="valueId" class="form-control w-25 py-3 text-dark inputsearch" value="50TK">
        </div>
        <div class="text-center mt-4">
            <span class="d-block mt-2">* ১% ক্যাশ অন ডেলিভারি ও রিস্ক ম্যানেজমেন্ট চার্জ প্রযোজ্য </span>
            <span class="d-block mt-2">* পার্সেল সাইজের কারণে ডেলিভারি মাশুল পরিবর্তিত হতে পারে </span>
            <span class="d-block mt-2">* উক্ত চার্জসমূহ ভ্যাট ও ট্যাক্স ব্যাতিত </span>
            <span class="d-block mt-2">* অনাকাঙ্ক্ষিত কারণবশত ডেলিভারি সময়ের পরিবর্তন হতে পারে</span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<script>
    $(document).ready(function() {

        $('.form-control.w-25.py-3').prop('disabled', true).prop('readonly', false);

        // Handle input event for weight field
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

        // Handle change event of form fields and make AJAX request
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
                    console.log(data);
                    if (data && data.deliveryCharge && data.deliveryCharge.price !== undefined) {
                        $('.form-control.w-25.py-3').val(data.deliveryCharge.price + 'TK');
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
    });
</script>


<script>
    $(document).ready(function() {
        var fromLocation;
        var destination;
        var selectedCategory;
        $('#fromLocation').change('change', function() {
            fromLocation = $(this).val(); // Update the variable with the selected value
            console.log("Updated fromLocation value:", fromLocation);

            // Clear and populate the destination dropdown
            $.ajax({
                url: '/get-destinations',
                type: 'GET',
                data: {
                    from_location: fromLocation
                },
                success: function(data) {
                    var destinationDropdown = $('#destination');
                    destinationDropdown.empty();
                    // destinationDropdown.append(
                    //     '<option value="" selected>Select Destination</option>');
                    $.each(data, function(index, destination) {
                        destinationDropdown.append('<option value="' + destination
                            .destination + '">' + destination.destination +
                            '</option>');
                    });

                    // Clear and populate the category dropdown
                    $('#category').empty();
                    $('#category').append(
                        '<option value="" selected>Select Category</option>');
                }
            });
        });

        $('#destination').on('click', function() {
            var destination = $(this).val();
            console.log("Updated destination value:", destination);
            // Clear and populate the category dropdown
            $.ajax({
                url: '/get-categories',
                type: 'GET',
                data: {
                    destination: destination
                },
                success: function(data) {
                    var categoryDropdown = $('#category');
                    categoryDropdown.empty();
                    // categoryDropdown.append(
                    //     '<option value="" selected>Select Category</option>');

                    $.each(data, function(index, category) {
                        categoryDropdown.append('<option value="' + category
                            .category + '">' + category.category + '</option>');
                    });
                }
            });
        });

        // Click event for the selected option in the category dropdown
        $('#category').on('click', function() {
            var selectedCategory = $(this).val();
            console.log("Selected Category:", selectedCategory);
        });
    });
</script>

@endsection