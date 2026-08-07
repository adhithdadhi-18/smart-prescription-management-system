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

<h2 class="mb-4">My Prescriptions</h2>

<?php

$userId = $_SESSION['user_id'];

$getPatient = mysqli_query($conn,
"SELECT patient_id FROM patients WHERE user_id='$userId'");

$patient = mysqli_fetch_assoc($getPatient);

$patientId = $patient['patient_id'];

$query = mysqli_query($conn,"
SELECT
p.*,
d.doctor_name
FROM prescriptions p
JOIN doctors d
ON p.doctor_id=d.doctor_id
WHERE p.patient_id='$patientId'
ORDER BY p.prescription_id DESC
");

?>

<table class="table table-bordered table-striped">

<thead class="table-primary">

<tr>

<th>Prescription Code</th>

<th>Doctor</th>

<th>Issue Date</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['prescription_code']; ?></td>

<td><?php echo $row['doctor_name']; ?></td>

<td><?php echo $row['issue_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a
href="viewPrescription.php?id=<?php echo $row['prescription_id']; ?>"
class="btn btn-success btn-sm">

View

</a>

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