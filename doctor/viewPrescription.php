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

$userId = $_SESSION['user_id'];

$getDoctor = mysqli_query($conn,
"SELECT doctor_id FROM doctors WHERE user_id='$userId'");

$doctorRow = mysqli_fetch_assoc($getDoctor);

$doctorId = $doctorRow['doctor_id'];

if(isset($_GET['id']))
{
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
}
else
{
    $query = mysqli_query($conn,"
    SELECT
    p.*,
    d.doctor_name,
    pat.patient_name
    FROM prescriptions p
    JOIN doctors d ON p.doctor_id=d.doctor_id
    JOIN patients pat ON p.patient_id=pat.patient_id
    WHERE p.doctor_id='$doctorId'
    ORDER BY p.prescription_id DESC
    LIMIT 1
    ");
}

$prescription = mysqli_fetch_assoc($query);
if(!$prescription)
{
    echo "<div class='alert alert-warning'>No Prescription Found.</div>";
    include("includes/footer.php");
    exit();
}
$prescriptionId = $prescription['prescription_id'];

$medicineQuery = mysqli_query($conn,"
SELECT
pi.*,
m.medicine_name
FROM prescription_items pi
JOIN medicines m
ON pi.medicine_id = m.medicine_id
WHERE pi.prescription_id='$prescriptionId'
");

?>

<?php
if($prescription)
{
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
while($medicine = mysqli_fetch_assoc($medicineQuery))
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

<div class="mt-3">

<a
href="printPrescription.php?id=<?php echo $prescriptionId; ?>"
target="_blank"
class="btn btn-primary">

🖨 Print Prescription

</a>

<a
href="history.php"
class="btn btn-secondary">

Back

</a>

</div>

<?php
}
else
{
    echo "<div class='alert alert-warning'>No prescriptions found.</div>";
}
?>
                </div>

            </div>

        </div>

    </div>
</div>
<style>

@media print{

.btn{
display:none !important;
}

.col-md-2{
display:none !important;
}

.card-header{
background:white !important;
color:black !important;
}

}

</style>

<?php include("includes/footer.php"); ?>