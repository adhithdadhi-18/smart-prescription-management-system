<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

$userId = $_SESSION['user_id'];

$patientQuery = mysqli_query($conn,
"SELECT patient_id
FROM patients
WHERE user_id='$userId'");

$patient = mysqli_fetch_assoc($patientQuery);

$patientId = $patient['patient_id'];

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE patient_id='$patientId'
"));

$active = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE patient_id='$patientId'
AND status='Active'
"));

$dispensed = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE patient_id='$patientId'
AND status='Dispensed'
"));

$cancelled = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE patient_id='$patientId'
AND status='Cancelled'
"));

$expired = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE patient_id='$patientId'
AND status='Expired'
"));

$patientName = htmlspecialchars($_SESSION['name']);
?>

<style>

.patient-dashboard{

min-height:100vh;

padding:32px;

background:linear-gradient(135deg,#f3f8ff 0%,#eaf2ff 52%,#f8fbff 100%);

}

.healthcare-banner{

position:relative;

overflow:hidden;

padding:32px;

margin-bottom:30px;

border-radius:22px;

color:#fff;

background:linear-gradient(135deg,#0b3d91,#1565c0);

box-shadow:0 16px 36px rgba(11,61,145,.24);

}

.healthcare-banner::after{

content:"";

position:absolute;

width:220px;

height:220px;

right:-75px;

top:-95px;

border-radius:50%;

background:rgba(255,255,255,.10);

}

.banner-content{

position:relative;

z-index:2;

}

.banner-logo{

width:58px;

height:58px;

display:inline-flex;

align-items:center;

justify-content:center;

margin-right:16px;

border-radius:16px;

font-size:26px;

background:rgba(255,255,255,.18);

}

.banner-title{

font-size:28px;

font-weight:700;

margin:0;

}

.banner-subtitle{

margin-top:8px;

font-size:15px;

opacity:.9;

}

.banner-date{

padding:10px 14px;

border-radius:12px;

background:rgba(255,255,255,.14);

display:inline-block;

}

.stats-card{

height:100%;

padding:24px;

background:#fff;

border-radius:18px;

border:1px solid #e7eef8;

box-shadow:0 10px 26px rgba(31,69,113,.08);

transition:.3s;

}

.stats-card:hover{

transform:translateY(-5px);

box-shadow:0 18px 35px rgba(31,69,113,.14);

}

.stats-top{

display:flex;

justify-content:space-between;

align-items:center;

}

.stats-label{

font-size:15px;

font-weight:600;

color:#64748b;

margin:0;

}

.stats-number{

font-size:40px;

font-weight:700;

margin:18px 0 4px;

color:#172033;

}

.stats-caption{

font-size:13px;

color:#94a3b8;

margin:0;

}

.stats-icon{

width:48px;

height:48px;

border-radius:14px;

display:flex;

align-items:center;

justify-content:center;

font-size:20px;

}

.icon-blue{background:#e8f1ff;color:#1565c0;}
.icon-green{background:#eaf8f0;color:#198754;}
.icon-cyan{background:#e8fbff;color:#0dcaf0;}
.icon-red{background:#fff0f0;color:#dc3545;}
.icon-orange{background:#fff4e6;color:#d97706;}

/* ===== Overview Card ===== */

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

<main class="col-md-10 patient-dashboard">

<section class="healthcare-banner">

<div class="row align-items-center banner-content">

<div class="col-md-8">

<div class="d-flex align-items-center">

<div class="banner-logo">

<i class="fa-solid fa-user"></i>

</div>

<div>

<h1 class="banner-title">

Patient Dashboard

</h1>

<p class="banner-subtitle">

Welcome back,

<strong><?php echo $patientName; ?></strong>

Manage and monitor your prescriptions securely.

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

</section>

<section class="row g-4">
    <div class="col-lg-4 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">Total Prescriptions</p>

            <div class="stats-icon icon-blue">

                <i class="fa-solid fa-file-prescription"></i>

            </div>

        </div>

        <h2 class="stats-number">

            <?php echo $total['total']; ?>

        </h2>

        <p class="stats-caption">

            Total prescriptions received

        </p>

    </div>

</div>

<div class="col-lg-4 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">Active</p>

            <div class="stats-icon icon-green">

                <i class="fa-solid fa-circle-check"></i>

            </div>

        </div>

        <h2 class="stats-number">

            <?php echo $active['total']; ?>

        </h2>

        <p class="stats-caption">

            Currently active prescriptions

        </p>

    </div>

</div>

<div class="col-lg-4 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">Dispensed</p>

            <div class="stats-icon icon-cyan">

                <i class="fa-solid fa-capsules"></i>

            </div>

        </div>

        <h2 class="stats-number">

            <?php echo $dispensed['total']; ?>

        </h2>

        <p class="stats-caption">

            Successfully dispensed

        </p>

    </div>

</div>

<div class="col-lg-4 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">Cancelled</p>

            <div class="stats-icon icon-red">

                <i class="fa-solid fa-ban"></i>

            </div>

        </div>

        <h2 class="stats-number">

            <?php echo $cancelled['total']; ?>

        </h2>

        <p class="stats-caption">

            Cancelled prescriptions

        </p>

    </div>

</div>

<div class="col-lg-4 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">Expired</p>

            <div class="stats-icon icon-orange">

                <i class="fa-solid fa-hourglass-end"></i>

            </div>

        </div>

        <h2 class="stats-number">

            <?php echo $expired['total']; ?>

        </h2>

        <p class="stats-caption">

            Expired prescriptions

        </p>

    </div>

</div>

</section>
<section class="overview-card">

    <h3 class="overview-title">

        Prescription Overview

    </h3>

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

                <strong>

                    <?php echo $total['total']; ?>

                </strong>

            </div>

            <div class="overview-item d-flex justify-content-between">

                <span>

                    <i class="fa-solid fa-circle-check me-2 text-success"></i>

                    Active Prescriptions

                </span>

                <strong>

                    <?php echo $active['total']; ?>

                </strong>

            </div>

            <div class="overview-item d-flex justify-content-between">

                <span>

                    <i class="fa-solid fa-capsules me-2 text-info"></i>

                    Dispensed Prescriptions

                </span>

                <strong>

                    <?php echo $dispensed['total']; ?>

                </strong>

            </div>

        </div>

        <div class="col-md-6">

            <div class="overview-item d-flex justify-content-between">

                <span>

                    <i class="fa-solid fa-ban me-2 text-danger"></i>

                    Cancelled Prescriptions

                </span>

                <strong>

                    <?php echo $cancelled['total']; ?>

                </strong>

            </div>

            <div class="overview-item d-flex justify-content-between">

                <span>

                    <i class="fa-solid fa-hourglass-end me-2 text-warning"></i>

                    Expired Prescriptions

                </span>

                <strong>

                    <?php echo $expired['total']; ?>

                </strong>

            </div>

        </div>

    </div>

</section>

</main>

</div>

</div>

<?php include("includes/footer.php"); ?>