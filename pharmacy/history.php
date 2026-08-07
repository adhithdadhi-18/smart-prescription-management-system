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

<h2>Dispensing History</h2>

<table class="table table-bordered table-striped">

<thead class="table-success">

<tr>

<th>Prescription Code</th>
<th>Patient</th>
<th>Medicine</th>
<th>Quantity</th>
<th>Dispense Date</th>

</tr>

</thead>

<tbody>

<?php

$query = mysqli_query($conn,"
SELECT
p.prescription_code,
pat.patient_name,
m.medicine_name,
dm.dispensed_quantity,
dm.dispense_date
FROM dispensed_medicines dm

JOIN prescriptions p
ON dm.prescription_id=p.prescription_id

JOIN patients pat
ON p.patient_id=pat.patient_id

JOIN medicines m
ON dm.medicine_id=m.medicine_id

ORDER BY dm.dispense_date DESC
");

while($row=mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $row['prescription_code']; ?></td>

<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['medicine_name']; ?></td>

<td><?php echo $row['dispensed_quantity']; ?></td>

<td><?php echo $row['dispense_date']; ?></td>

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