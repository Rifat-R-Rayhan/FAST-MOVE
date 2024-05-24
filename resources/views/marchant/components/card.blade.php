<?php
use Illuminate\Support\Facades\Auth;
$id = Auth::id();

$user = $id;
// Connect to MySQL database
include '../config/db_connection.php';

// Fetch parcel counts
$total_parcel_count = 0;
$pending_parcel_count = 0;
$delivered_parcel_count = 0;

$sql_total = "SELECT COUNT(*) as total FROM products WHERE user_id = $user";
$result_total = $conn->query($sql_total);
if ($result_total->num_rows > 0) {
    $row_total = $result_total->fetch_assoc();
    $total_parcel_count = $row_total["total"];
}

$sql_pending = "SELECT COUNT(*) as pending FROM products WHERE user_id = $user AND is_active = 1";
$result_pending = $conn->query($sql_pending);
if ($result_pending->num_rows > 0) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_parcel_count = $row_pending["pending"];
}

$sql_delivered = "SELECT COUNT(*) as delivered FROM products WHERE user_id = $user AND is_active = 5";
$result_delivered = $conn->query($sql_delivered);
if ($result_delivered->num_rows > 0) {
    $row_delivered = $result_delivered->fetch_assoc();
    $delivered_parcel_count = $row_delivered["delivered"];
}

$sql_returned = "SELECT COUNT(*) as returned FROM products WHERE user_id = $user AND is_active = 6";
$result_returned = $conn->query($sql_returned);
if ($result_returned->num_rows > 0) {
    $row_returned = $result_returned->fetch_assoc();
    $returned_parcel_count = $row_returned["returned"];
}

// Fetch daily sales
$current_day = date('l');
$current_date = date('Y-m-d');

$sql_daily_sales = "SELECT SUM(cod_amount) as daily_sales FROM products WHERE user_id = $user AND DATE(created_at) = '$current_date' AND is_active = 5";
$result_daily_sales = $conn->query($sql_daily_sales);
$daily_sales = 0;
if ($result_daily_sales->num_rows > 0) {
    $row_daily_sales = $result_daily_sales->fetch_assoc();
    $daily_sales = $row_daily_sales["daily_sales"];
}

// Fetch weekly sales
$current_week_start = date('Y-m-d', strtotime('last sunday'));
$current_week_end = date('Y-m-d', strtotime('next saturday'));

$sql_weekly_sales = "SELECT SUM(cod_amount) as weekly_sales FROM products WHERE user_id = $user AND created_at BETWEEN '$current_week_start' AND '$current_week_end' AND is_active = 5";
$result_weekly_sales = $conn->query($sql_weekly_sales);
$weekly_sales = 0;
if ($result_weekly_sales->num_rows > 0) {
    $row_weekly_sales = $result_weekly_sales->fetch_assoc();
    $weekly_sales = $row_weekly_sales["weekly_sales"];
}

// Fetch monthly sales
$current_month = date('F');
$current_month_start = date('Y-m-01');
$current_month_end = date('Y-m-t');

$sql_monthly_sales = "SELECT SUM(cod_amount) as monthly_sales FROM products WHERE user_id = $user AND created_at BETWEEN '$current_month_start' AND '$current_month_end' AND is_active = 5";
$result_monthly_sales = $conn->query($sql_monthly_sales);
$monthly_sales = 0;
if ($result_monthly_sales->num_rows > 0) {
    $row_monthly_sales = $result_monthly_sales->fetch_assoc();
    $monthly_sales = $row_monthly_sales["monthly_sales"];
}

// Fetch yearly sales
$current_year = date('Y');
$year_start = date('Y-01-01');
$year_end = date('Y-12-31');

$sql_yearly_sales = "SELECT SUM(cod_amount) as yearly_sales FROM products WHERE user_id = $user AND created_at BETWEEN '$year_start' AND '$year_end' AND is_active = 5";
$result_yearly_sales = $conn->query($sql_yearly_sales);
$yearly_sales = 0;
if ($result_yearly_sales->num_rows > 0) {
    $row_yearly_sales = $result_yearly_sales->fetch_assoc();
    $yearly_sales = $row_yearly_sales["yearly_sales"];
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
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Total Parcel <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $total_parcel_count; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Pending Parcel <i
                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $pending_parcel_count; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Delivered Parcel <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $delivered_parcel_count; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Return Parcel <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $returned_parcel_count; ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Daily Sales (<?php echo $current_day; ?>) <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $daily_sales; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Weekly Sales (SUN to SAT) <i
                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $weekly_sales; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Monthly Sales (<?php echo $current_month; ?>) <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $monthly_sales ; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="marchant/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Yearly Sales (<?php echo $current_year; ?>) <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $yearly_sales; ?></h2>
                </div>
            </div>
        </div>
    </div>
