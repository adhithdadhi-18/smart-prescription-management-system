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

<div class="card-header bg-primary text-white">
<h3>View Prescription</h3>
</div>

<div class="card-body">

<?php

if(!isset($_GET['id']))
{
    echo "<div class='alert alert-danger'>Prescription not found.</div>";
    include("includes/footer.php");
    exit();
}

$prescriptionId = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
p.*,
d.doctor_name,
pat.patient_name
FROM prescriptions p
JOIN doctors d ON p.doctor_id=d.doctor_id
JOIN patients pat ON p.patient_id=pat.patient_id
WHERE p.prescription_id='$prescriptionId'
");

$prescription = mysqli_fetch_assoc($query);

if(!$prescription)
{
    echo "<div class='alert alert-danger'>Prescription not found.</div>";
    include("includes/footer.php");
    exit();
}

$medicineQuery = mysqli_query($conn,"
SELECT
pi.*,
m.medicine_name
FROM prescription_items pi
JOIN medicines m
ON pi.medicine_id=m.medicine_id
WHERE pi.prescription_id='$prescriptionId'
");

?>

<table class="table table-bordered">

<tr>
<th>Prescription Code</th>
<td><?php echo $prescription['prescription_code']; ?></td>
</tr>

<tr>
<th>Doctor</th>
<td><?php echo $prescription['doctor_name']; ?></td>
</tr>

<tr>
<th>Patient</th>
<td><?php echo $prescription['patient_name']; ?></td>
</tr>

<tr>
<th>Diagnosis</th>
<td><?php echo $prescription['diagnosis']; ?></td>
</tr>

<tr>
<th>Symptoms</th>
<td><?php echo $prescription['symptoms']; ?></td>
</tr>

<tr>
<th>Doctor Notes</th>
<td><?php echo $prescription['doctor_notes']; ?></td>
</tr>

<tr>
<th>Issue Date</th>
<td><?php echo $prescription['issue_date']; ?></td>
</tr>

<tr>
<th>Expiry Date</th>
<td><?php echo $prescription['expiry_date']; ?></td>
</tr>

<tr>
<th>Status</th>
<td><?php echo $prescription['status']; ?></td>
</tr>

</table>

<h4 class="mt-4">Medicines</h4>

<table class="table table-bordered table-striped">

<thead class="table-success">

<tr>

<th>Medicine</th>
<th>Morning</th>
<th>Afternoon</th>
<th>Night</th>
<th>Food</th>
<th>Duration</th>
<th>Quantity</th>

</tr>

</thead>

<tbody>

<?php

while($medicine=mysqli_fetch_assoc($medicineQuery))
{

?>

<tr>

<td><?php echo $medicine['medicine_name']; ?></td>

<td><?php echo $medicine['morning'] ? "✔" : "-"; ?></td>

<td><?php echo $medicine['afternoon'] ? "✔" : "-"; ?></td>

<td><?php echo $medicine['night'] ? "✔" : "-"; ?></td>

<td><?php echo $medicine['food']; ?></td>

<td><?php echo $medicine['duration']; ?></td>

<td><?php echo $medicine['quantity']; ?></td>

</tr>

<?php

}

?>

</tbody>

</table>
</table>

<a href="myPrescription.php" class="btn btn-secondary">
Back
</a>

</div>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>