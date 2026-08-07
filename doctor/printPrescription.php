<?php
include("../sessions/check_login.php");
include("../config/db.php");

if(!isset($_GET['id']))
{
    die("Prescription not found.");
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
    die("Prescription not found.");
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

<!DOCTYPE html>

<html>

<head>

<title>Print Prescription</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:40px;
}

@media print{
    .no-print{
        display:none;
    }
}

</style>

</head>

<body>

<div class="container">

<h2 class="text-center">
SMART PRESCRIPTION SYSTEM
</h2>

<h5 class="text-center">
ABC MULTISPECIALITY HOSPITAL
</h5>

<hr>

<table class="table table-bordered">

<tr>
<th width="30%">Prescription Code</th>
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
<th>Issue Date</th>
<td><?php echo $prescription['issue_date']; ?></td>
</tr>

<tr>
<th>Expiry Date</th>
<td><?php echo $prescription['expiry_date']; ?></td>
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

</table>

<h4 class="mt-4">Medicines</h4>

<table class="table table-bordered">

<thead class="table-secondary">

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

<br><br>

<div class="row">

<div class="col-6">
Patient Signature

<br><br><br>

_____________________
</div>

<div class="col-6 text-end">
Doctor Signature

<br><br><br>

_____________________
</div>

</div>

<br>

<div class="text-center no-print">

<button
class="btn btn-primary"
onclick="window.print()">

🖨 Print

</button>

<button
class="btn btn-secondary"
onclick="window.close()">

Close

</button>

</div>

</div>

</body>

</html>