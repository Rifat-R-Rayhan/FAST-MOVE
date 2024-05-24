<?php
// Connect to MySQL database
include '../config/db_connection.php';

// Fetch parcel counts
$pending_parcel_count = 0;

$sql_pending = "SELECT COUNT(*) as pending FROM products WHERE is_active = 1";
$result_pending = $conn->query($sql_pending);
if ($result_pending->num_rows > 0) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_parcel_count = $row_pending["pending"];
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
                    <h4 class="font-weight-normal mb-3"> Pending Parcel <i
                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $pending_parcel_count; ?></h2>
                </div>
            </div>
        </div>
    </div>
