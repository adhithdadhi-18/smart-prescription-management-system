<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

$userId = $_SESSION['user_id'];

$getDoctor = mysqli_query($conn,"
SELECT doctor_id
FROM doctors
WHERE user_id='$userId'
");

$doctor = mysqli_fetch_assoc($getDoctor);
$doctorId = $doctor['doctor_id'];

$total = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE doctor_id='$doctorId'"));

$active = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE doctor_id='$doctorId'
AND status='Active'"));

$dispensed = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE doctor_id='$doctorId'
AND status='Dispensed'"));

$cancelled = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE doctor_id='$doctorId'
AND status='Cancelled'"));

$expired = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE doctor_id='$doctorId'
AND status='Expired'"));
?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
.doctor-dashboard {
    min-height: 100vh;
    background: #f4f8fd;
}

.doctor-banner{
    position:relative;
    overflow:hidden;
    padding:32px;
    margin-bottom:30px;
    border-radius:22px;
    color:#ffffff;
    background:linear-gradient(135deg,#0b3d91,#1565c0);
    box-shadow:0 16px 36px rgba(11,61,145,.24);
}

.doctor-banner::after{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    right:-75px;
    top:-95px;
    border-radius:50%;
    background:rgba(255,255,255,.10);
}



.banner-logo{
    width:58px;
    height:58px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    margin-right:16px;
    border-radius:16px;
    font-size:27px;
    background:rgba(255,255,255,.16);
}

.banner-title{
    font-size:28px;
    font-weight:700;
    margin:0;
}

.banner-subtitle{
    margin-top:8px;
    opacity:.88;
    font-size:15px;
}

.banner-date{
    padding:10px 14px;
    border-radius:12px;
    font-size:14px;
    background:rgba(255,255,255,.14);
    display:inline-block;
}

.doctor-stat-card {
    border: 1px solid #e7edf6;
    border-radius: 18px;
    background: white;
    box-shadow: 0 8px 24px rgba(15, 23, 42, .07);
    transition: .25s ease;
    height: 100%;
}

.doctor-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(15, 23, 42, .12);
}

.doctor-stat-card .card-body {
    padding: 25px;
}

.stat-label {
    color: #64748b;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 12px;
}

.stat-value {
    color: #172554;
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 0;
}

.stat-icon {
    font-size: 22px;
    color: #2563eb;
}

.stat-icon.success {
    color: #16a34a;
}

.stat-icon.info {
    color: #0284c7;
}

.stat-icon.danger {
    color: #dc2626;
}

.stat-icon.warning {
    color: #d97706;
}
.overview-card{
    margin-top:30px;
    padding:25px;
    background:#fff;
    border:1px solid #e7eef8;
    border-radius:18px;
    box-shadow:0 10px 26px rgba(31,69,113,.08);
}

.overview-title{
    margin:0 0 8px;
    font-size:20px;
    font-weight:700;
    color:#172033;
}

.overview-text{
    margin-bottom:20px;
    color:#64748b;
    font-size:14px;
}

.overview-item{
    padding:14px 0;
    border-bottom:1px solid #edf2f7;
}

.overview-item:last-child{
    border-bottom:none;
}

.overview-item span{
    color:#64748b;
}

.overview-item strong{
    color:#172033;
}
</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 p-0">
            <?php include("includes/sidebar.php"); ?>
        </div>

        <div class="col-md-10 p-4 doctor-dashboard">

         <div class="doctor-banner">

<div class="row align-items-center">

        <div class="col-md-8">

            <div class="d-flex align-items-center">

                <div class="banner-logo">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <div>

                    <h1 class="banner-title">
                        Doctor Dashboard
                    </h1>

                    <p class="banner-subtitle">
                        Welcome back,
                        <strong><?php echo $_SESSION['name']; ?></strong>.
                        Manage prescriptions and monitor your patient care efficiently.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 text-md-end">

            <div class="banner-date">

                <i class="fa-solid fa-calendar-days me-2"></i>

                <?php echo date("l, d M Y"); ?>

            </div>

        </div>

    </div>

</div>   

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="card doctor-stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="stat-label">Total Prescriptions</p>
                                <i class="fa-solid fa-file-prescription stat-icon"></i>
                            </div>
                            <h2 class="stat-value"><?php echo $total; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card doctor-stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="stat-label">Active Prescriptions</p>
                                <i class="fa-solid fa-circle-check stat-icon success"></i>
                            </div>
                            <h2 class="stat-value"><?php echo $active; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card doctor-stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="stat-label">Dispensed</p>
                                <i class="fa-solid fa-pills stat-icon info"></i>
                            </div>
                            <h2 class="stat-value"><?php echo $dispensed; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card doctor-stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="stat-label">Cancelled</p>
                                <i class="fa-solid fa-circle-xmark stat-icon danger"></i>
                            </div>
                            <h2 class="stat-value"><?php echo $cancelled; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card doctor-stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="stat-label">Expired</p>
                                <i class="fa-solid fa-clock stat-icon warning"></i>
                            </div>
                            <h2 class="stat-value"><?php echo $expired; ?></h2>
                        </div>
                    </div>
                </div>

            </div>
            <section class="overview-card">

    <h3 class="overview-title">Prescription Overview</h3>

    <p class="overview-text">
        A quick summary of your prescription records.
    </p>

    <div class="row">

        <div class="col-md-6">

            <div class="overview-item d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-file-prescription me-2 text-primary"></i>
                    Total Prescriptions
                </span>
                <strong><?php echo $total; ?></strong>
            </div>

            <div class="overview-item d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-circle-check me-2 text-success"></i>
                    Active Prescriptions
                </span>
                <strong><?php echo $active; ?></strong>
            </div>

            <div class="overview-item d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-pills me-2 text-info"></i>
                    Dispensed Prescriptions
                </span>
                <strong><?php echo $dispensed; ?></strong>
            </div>

        </div>

        <div class="col-md-6">

            <div class="overview-item d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-circle-xmark me-2 text-danger"></i>
                    Cancelled Prescriptions
                </span>
                <strong><?php echo $cancelled; ?></strong>
            </div>

            <div class="overview-item d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-clock me-2 text-warning"></i>
                    Expired Prescriptions
                </span>
                <strong><?php echo $expired; ?></strong>
            </div>

        </div>

    </div>

</section>

        </div>

    </div>
</div>

<?php include("includes/footer.php"); ?>