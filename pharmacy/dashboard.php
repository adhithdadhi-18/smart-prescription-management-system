<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");
?>

<div class="row">


<?php
$pharmacyName = htmlspecialchars($_SESSION['name']);

$active = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE status='Active'
"));

$dispensed = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM prescriptions
WHERE status='Dispensed'
"));

$today = date("Y-m-d");

$todayDispensed = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM dispensed_medicines
WHERE DATE(dispense_date)='$today'
"));

$totalDispensed = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM dispensed_medicines
"));
?>

<style>

.pharmacy-dashboard{
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
z-index:1;
}

.banner-logo{
width:58px;
height:58px;
display:flex;
align-items:center;
justify-content:center;
margin-right:16px;
border-radius:16px;
font-size:26px;
background:rgba(255,255,255,.16);
}

.banner-title{
font-size:28px;
font-weight:700;
margin:0;
}

.banner-subtitle{
margin-top:8px;
opacity:.9;
font-size:15px;
}

.banner-date{
padding:10px 15px;
border-radius:12px;
background:rgba(255,255,255,.15);
font-size:14px;
}

.stats-card{
height:100%;
padding:24px;
border-radius:18px;
background:#fff;
border:1px solid #e7eef8;
box-shadow:0 10px 26px rgba(31,69,113,.08);
transition:.3s;
}

.stats-card:hover{
transform:translateY(-6px);
box-shadow:0 18px 35px rgba(31,69,113,.14);
}

.stats-top{
display:flex;
justify-content:space-between;
align-items:center;
}

.stats-label{
margin:0;
font-size:15px;
font-weight:600;
color:#64748b;
}

.stats-number{
margin:18px 0 5px;
font-size:40px;
font-weight:700;
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
display:flex;
align-items:center;
justify-content:center;
border-radius:13px;
font-size:20px;
}

.icon-green{
background:#eaf8f0;
color:#198754;
}

.icon-blue{
background:#e8f1ff;
color:#1565c0;
}

.icon-orange{
background:#fff4e6;
color:#d97706;
}

.icon-purple{
background:#f2edff;
color:#6f42c1;
}

.overview-card{
margin-top:30px;
padding:25px;
border-radius:18px;
background:#fff;
border:1px solid #e7eef8;
box-shadow:0 10px 26px rgba(31,69,113,.08);
}

.overview-title{
font-size:20px;
font-weight:700;
color:#172033;
margin-bottom:8px;
}

.overview-text{
color:#64748b;
margin-bottom:20px;
}

.overview-item{
padding:14px 0;
border-bottom:1px solid #edf2f7;
}

.overview-item:last-child{
border-bottom:none;
}

</style>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<main class="col-md-10 pharmacy-dashboard">

<section class="healthcare-banner">

<div class="row align-items-center banner-content">

<div class="col-md-8">

<div class="d-flex align-items-center">

<div class="banner-logo">

<i class="fa-solid fa-house-medical"></i>

</div>

<div>

<h1 class="banner-title">

Pharmacy Dashboard

</h1>

<p class="banner-subtitle">

Welcome back,
<?php echo $pharmacyName; ?>.
Manage medicine dispensing efficiently.

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
    <div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">
                Active Prescriptions
            </p>

            <div class="stats-icon icon-green">
                <i class="fa-solid fa-file-circle-check"></i>
            </div>

        </div>

        <h2 class="stats-number">
            <?php echo $active['total']; ?>
        </h2>

        <p class="stats-caption">
            Ready for dispensing
        </p>

    </div>

</div>


<div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">
                Dispensed
            </p>

            <div class="stats-icon icon-blue">
                <i class="fa-solid fa-pills"></i>
            </div>

        </div>

        <h2 class="stats-number">
            <?php echo $dispensed['total']; ?>
        </h2>

        <p class="stats-caption">
            Successfully completed
        </p>

    </div>

</div>


<div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">
                Today's Dispensed
            </p>

            <div class="stats-icon icon-orange">
                <i class="fa-solid fa-calendar-check"></i>
            </div>

        </div>

        <h2 class="stats-number">
            <?php echo $todayDispensed['total']; ?>
        </h2>

        <p class="stats-caption">
            Dispensed today
        </p>

    </div>

</div>


<div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-top">

            <p class="stats-label">
                Total Dispensed
            </p>

            <div class="stats-icon icon-purple">
                <i class="fa-solid fa-capsules"></i>
            </div>

        </div>

        <h2 class="stats-number">
            <?php echo $totalDispensed['total']; ?>
        </h2>

        <p class="stats-caption">
            Lifetime dispensing records
        </p>

    </div>

</div>

</section>


<section class="overview-card">

    <h3 class="overview-title">
        Dispensing Overview
    </h3>

    <p class="overview-text">
        A quick summary of prescription dispensing activities.
    </p>

    <div class="row">

        <div class="col-md-6">

            <div class="overview-item d-flex justify-content-between">

                <span>
                    <i class="fa-solid fa-file-circle-check text-success me-2"></i>
                    Active Prescriptions
                </span>

                <strong>
                    <?php echo $active['total']; ?>
                </strong>

            </div>

            <div class="overview-item d-flex justify-content-between">

                <span>
                    <i class="fa-solid fa-pills text-primary me-2"></i>
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
                    <i class="fa-solid fa-calendar-check text-warning me-2"></i>
                    Today's Dispensed
                </span>

                <strong>
                    <?php echo $todayDispensed['total']; ?>
                </strong>

            </div>

            <div class="overview-item d-flex justify-content-between">

                <span>
                    <i class="fa-solid fa-capsules text-info me-2"></i>
                    Total Dispensed
                </span>

                <strong>
                    <?php echo $totalDispensed['total']; ?>
                </strong>

            </div>

        </div>

    </div>

</section>
</main>

</div>

</div>

<?php include("includes/footer.php"); ?>
