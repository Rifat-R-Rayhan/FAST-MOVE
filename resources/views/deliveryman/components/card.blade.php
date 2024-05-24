<?php
// Connect to MySQL database
include '../config/db_connection.php';

// Fetch parcel counts
$house_parcel_count = 0;

$sql_house = "SELECT COUNT(*) as house FROM products WHERE is_active = 3";
$result_house = $conn->query($sql_house);
if ($result_house->num_rows > 0) {
    $row_house = $result_house->fetch_assoc();
    $house_parcel_count = $row_house["house"];
}

$conn->close();
?>
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="/marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> In House Parcel <i
                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $house_parcel_count; ?></h2>
                </div>
            </div>
        </div>
    </div>
