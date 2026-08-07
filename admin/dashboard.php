<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

$doctorCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctors"));
$patientCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patients"));
$pharmacyCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pharmacies"));
$medicineCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM medicines"));
$prescriptionCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM prescriptions"));

$adminName = htmlspecialchars($_SESSION['name']);
?>

<style>
.admin-dashboard {
    min-height: 100vh;
    padding: 32px;
    background: linear-gradient(135deg, #f3f8ff 0%, #eaf2ff 52%, #f8fbff 100%);
}

.healthcare-banner {
    position: relative;
    overflow: hidden;
    padding: 32px;
    margin-bottom: 30px;
    border-radius: 22px;
    color: #ffffff;
    background: linear-gradient(135deg, #0b3d91, #1565c0);
    box-shadow: 0 16px 36px rgba(11, 61, 145, 0.24);
}

.healthcare-banner::after {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    right: -75px;
    top: -95px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.10);
}

.banner-content {
    position: relative;
    z-index: 1;
}

.banner-logo {
    width: 58px;
    height: 58px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    border-radius: 16px;
    font-size: 27px;
    background: rgba(255, 255, 255, 0.16);
}

.banner-title {
    font-size: 28px;
    font-weight: 700;
    margin: 0;
}

.banner-subtitle {
    margin: 8px 0 0;
    opacity: 0.88;
    font-size: 15px;
}

.banner-date {
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.14);
}

.stats-card {
    height: 100%;
    padding: 24px;
    border: 1px solid #e7eef8;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 10px 26px rgba(31, 69, 113, 0.08);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 35px rgba(31, 69, 113, 0.14);
}

.stats-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stats-label {
    margin: 0;
    color: #64748b;
    font-size: 15px;
    font-weight: 600;
}

.stats-number {
    margin: 18px 0 4px;
    color: #172033;
    font-size: 38px;
    font-weight: 700;
    line-height: 1;
}

.stats-caption {
    margin: 0;
    color: #94a3b8;
    font-size: 13px;
}

.stats-icon {
    width: 46px;
    height: 46px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    font-size: 19px;
}

.icon-blue { background: #e8f1ff; color: #1565c0; }
.icon-green { background: #eaf8f0; color: #198754; }
.icon-orange { background: #fff4e6; color: #d97706; }
.icon-red { background: #fff0f0; color: #dc3545; }
.icon-purple { background: #f2edff; color: #6f42c1; }

.overview-card {
    margin-top: 30px;
    padding: 25px;
    border: 1px solid #e7eef8;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 10px 26px rgba(31, 69, 113, 0.08);
}

.overview-title {
    margin: 0 0 6px;
    color: #172033;
    font-size: 20px;
    font-weight: 700;
}

.overview-text {
    margin: 0 0 20px;
    color: #64748b;
    font-size: 14px;
}

.overview-item {
    padding: 14px 0;
    border-bottom: 1px solid #edf2f7;
}

.overview-item:last-child {
    border-bottom: none;
}

.overview-item span {
    color: #64748b;
}

.overview-item strong {
    color: #172033;
}

@media (max-width: 767px) {
    .admin-dashboard {
        padding: 20px;
    }

    .healthcare-banner {
        padding: 24px;
    }

    .banner-title {
        font-size: 22px;
    }

    .banner-date {
        display: inline-block;
        margin-top: 20px;
    }
}
</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 p-0">
            <?php include("includes/sidebar.php"); ?>
        </div>

        <main class="col-md-10 admin-dashboard">

            <section class="healthcare-banner">
                <div class="row align-items-center banner-content">

                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="banner-logo">
                                <i class="fa-solid fa-notes-medical"></i>
                            </div>

                            <div>
                                <h1 class="banner-title">Smart Prescription Management System</h1>
                                <p class="banner-subtitle">
                                    Welcome back, <?php echo $adminName; ?>. Manage the healthcare system from one place.
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
                            <p class="stats-label">Doctors</p>
                            <div class="stats-icon icon-blue">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                        </div>

                        <h2 class="stats-number"><?php echo $doctorCount; ?></h2>
                        <p class="stats-caption">Total registered doctors</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-card">
                        <div class="stats-top">
                            <p class="stats-label">Patients</p>
                            <div class="stats-icon icon-green">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                        </div>

                        <h2 class="stats-number"><?php echo $patientCount; ?></h2>
                        <p class="stats-caption">Total registered patients</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-card">
                        <div class="stats-top">
                            <p class="stats-label">Pharmacies</p>
                            <div class="stats-icon icon-orange">
                                <i class="fa-solid fa-house-medical"></i>
                            </div>
                        </div>

                        <h2 class="stats-number"><?php echo $pharmacyCount; ?></h2>
                        <p class="stats-caption">Connected pharmacy accounts</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-card">
                        <div class="stats-top">
                            <p class="stats-label">Medicines</p>
                            <div class="stats-icon icon-red">
                                <i class="fa-solid fa-pills"></i>
                            </div>
                        </div>

                        <h2 class="stats-number"><?php echo $medicineCount; ?></h2>
                        <p class="stats-caption">Available medicine records</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-card">
                        <div class="stats-top">
                            <p class="stats-label">Prescriptions</p>
                            <div class="stats-icon icon-purple">
                                <i class="fa-solid fa-file-prescription"></i>
                            </div>
                        </div>

                        <h2 class="stats-number"><?php echo $prescriptionCount; ?></h2>
                        <p class="stats-caption">Total prescriptions issued</p>
                    </div>
                </div>

            </section>

            <section class="overview-card">
                <h3 class="overview-title">System Overview</h3>
                <p class="overview-text">A quick summary of the records currently available in the system.</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="overview-item d-flex justify-content-between">
                            <span><i class="fa-solid fa-user-doctor me-2 text-primary"></i>Doctors registered</span>
                            <strong><?php echo $doctorCount; ?></strong>
                        </div>

                        <div class="overview-item d-flex justify-content-between">
                            <span><i class="fa-solid fa-user-group me-2 text-success"></i>Patients registered</span>
                            <strong><?php echo $patientCount; ?></strong>
                        </div>

                        <div class="overview-item d-flex justify-content-between">
                            <span><i class="fa-solid fa-house-medical me-2 text-warning"></i>Pharmacies connected</span>
                            <strong><?php echo $pharmacyCount; ?></strong>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="overview-item d-flex justify-content-between">
                            <span><i class="fa-solid fa-pills me-2 text-danger"></i>Medicine records</span>
                            <strong><?php echo $medicineCount; ?></strong>
                        </div>

                        <div class="overview-item d-flex justify-content-between">
                            <span><i class="fa-solid fa-file-prescription me-2 text-info"></i>Prescriptions issued</span>
                            <strong><?php echo $prescriptionCount; ?></strong>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</div>

<?php include("includes/footer.php"); ?>