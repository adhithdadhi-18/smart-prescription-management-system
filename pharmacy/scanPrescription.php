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

<div class="card shadow">

<div class="card-header bg-success text-white">
<h3>Scan Prescription</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6">

<label>Enter Prescription Code</label>

<input
type="text"
name="code"
class="form-control"
placeholder="RX123456"
required>

</div>

<div class="col-md-2 mt-4">

<button
name="search"
class="btn btn-success">

Search

</button>

</div>

</div>

</form>

<hr>

<?php

if(isset($_POST['search']))
{

$code = mysqli_real_escape_string($conn,$_POST['code']);

$query = mysqli_query($conn,"
SELECT
p.*,
d.doctor_name,
pat.patient_name
FROM prescriptions p
JOIN doctors d
ON p.doctor_id=d.doctor_id
JOIN patients pat
ON p.patient_id=pat.patient_id
WHERE p.prescription_code='$code'
");

if(mysqli_num_rows($query)>0)
{

$data=mysqli_fetch_assoc($query);

?>

<table class="table table-bordered">

<tr>
<th>Prescription Code</th>
<td><?php echo $data['prescription_code']; ?></td>
</tr>

<tr>
<th>Doctor</th>
<td><?php echo $data['doctor_name']; ?></td>
</tr>

<tr>
<th>Patient</th>
<td><?php echo $data['patient_name']; ?></td>
</tr>

<tr>
<th>Diagnosis</th>
<td><?php echo $data['diagnosis']; ?></td>
</tr>

<tr>
<th>Status</th>
<td>

<?php

$status = $data['status'];

if($status=="Active")
{
    echo "<span class='badge bg-success'>Active</span>";
}
elseif($status=="Dispensed")
{
    echo "<span class='badge bg-primary'>Dispensed</span>";
}
elseif($status=="Cancelled")
{
    echo "<span class='badge bg-danger'>Cancelled</span>";
}
else
{
    echo "<span class='badge bg-warning text-dark'>Expired</span>";
}

?>

</td>
</tr>

</table>

<?php

if($status=="Active")
{
?>

<a
href="dispenseMedicine.php?id=<?php echo $data['prescription_id']; ?>"
class="btn btn-primary">

Dispense Medicines

</a>

<?php
}
elseif($status=="Dispensed")
{
?>

<div class="alert alert-primary mt-3">

This prescription has already been dispensed.

</div>

<?php
}
elseif($status=="Cancelled")
{
?>

<div class="alert alert-danger mt-3">

This prescription has been cancelled by the doctor.

</div>

<?php
}
else
{
?>

<div class="alert alert-warning mt-3">

This prescription has expired.

</div>

<?php
}
?>

<?php

}
else
{

echo "<div class='alert alert-danger'>
Prescription Not Found
</div>";

}

}

?>

</div>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>