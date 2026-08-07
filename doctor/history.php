<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">
            <?php include("includes/sidebar.php"); ?>
        </div>

        <div class="col-md-10 p-4">

            <h2>Prescription History</h2>
            <form method="GET" class="row mb-3">

<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by Prescription Code or Patient Name"
value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

</div>

<div class="col-md-3">

<select
name="status"
class="form-select">

<option value="">All Status</option>

<option value="Active"
<?php if(isset($_GET['status']) && $_GET['status']=="Active") echo "selected"; ?>>

Active

</option>

<option value="Dispensed"
<?php if(isset($_GET['status']) && $_GET['status']=="Dispensed") echo "selected"; ?>>

Dispensed

</option>

<option value="Cancelled"
<?php if(isset($_GET['status']) && $_GET['status']=="Cancelled") echo "selected"; ?>>

Cancelled

</option>

<option value="Expired"
<?php if(isset($_GET['status']) && $_GET['status']=="Expired") echo "selected"; ?>>

Expired

</option>

</select>

</div>

<div class="col-md-2">

<button
class="btn btn-success">

Search

</button>

</div>

</form>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Prescription Code</th>
<th>Patient ID</th>
<th>Issue Date</th>
<th>Expiry Date</th>
<th>Status</th>
<th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                $userId = $_SESSION['user_id'];

                $doctorQuery = mysqli_query($conn,
                "SELECT doctor_id FROM doctors WHERE user_id='$userId'");

                $doctor = mysqli_fetch_assoc($doctorQuery);

                $doctorId = $doctor['doctor_id'];

               $search = isset($_GET['search']) ? mysqli_real_escape_string($conn,$_GET['search']) : "";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn,$_GET['status']) : "";

$sql = "
SELECT
p.*,
pat.patient_name
FROM prescriptions p
JOIN patients pat
ON p.patient_id = pat.patient_id
WHERE p.doctor_id='$doctorId'
";

if($search!="")
{
    $sql .= " AND (
        p.prescription_code LIKE '%$search%'
        OR pat.patient_name LIKE '%$search%'
    )";
}

if($status!="")
{
    $sql .= " AND p.status='$status'";
}

$sql .= " ORDER BY p.prescription_id DESC";

$result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                ?>

               <tr>

<td><?php echo $row['prescription_code']; ?></td>
<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['issue_date']; ?></td>

<td><?php echo $row['expiry_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a
href="viewPrescription.php?id=<?php echo $row['prescription_id']; ?>"
class="btn btn-primary btn-sm">

View

</a>

<?php
if($row['status']=="Active")
{
?>

<a
href="editPrescription.php?id=<?php echo $row['prescription_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="cancelPrescription.php?id=<?php echo $row['prescription_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to cancel this prescription?');">

Cancel

</a>

<?php
}
?>

</td>

</tr>

                <?php
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>