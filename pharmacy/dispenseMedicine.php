<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_SESSION['success']))
{
    echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
    unset($_SESSION['success']);
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<?php

if(!isset($_GET['id']))
{
    echo "<div class='alert alert-danger'>Prescription Not Found</div>";
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
JOIN doctors d
ON p.doctor_id=d.doctor_id
JOIN patients pat
ON p.patient_id=pat.patient_id
WHERE p.prescription_id='$prescriptionId'
");

$prescription=mysqli_fetch_assoc($query);

?>

<div class="card shadow mb-4">

<div class="card-header bg-success text-white">

<h3>Dispense Medicine</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>Prescription Code</th>

<td><?php echo $prescription['prescription_code']; ?></td>

</tr>

<tr>

<th>Patient</th>

<td><?php echo $prescription['patient_name']; ?></td>

</tr>

<tr>

<th>Doctor</th>

<td><?php echo $prescription['doctor_name']; ?></td>

</tr>

<tr>

<th>Diagnosis</th>

<td><?php echo $prescription['diagnosis']; ?></td>

</tr>

</table>

</div>

</div>

<?php

$medicineQuery = mysqli_query($conn,"
SELECT
pi.*,
m.medicine_name,
COALESCE(SUM(dm.dispensed_quantity),0) AS dispensed
FROM prescription_items pi
JOIN medicines m
ON pi.medicine_id = m.medicine_id
LEFT JOIN dispensed_medicines dm
ON pi.prescription_id = dm.prescription_id
AND pi.medicine_id = dm.medicine_id
WHERE pi.prescription_id='$prescriptionId'
GROUP BY pi.item_id
");

?>

<form method="POST">

<table class="table table-bordered table-striped">

<thead class="table-primary">

<tr>

<th>Medicine</th>

<th>Dosage</th>

<th>Morning</th>

<th>Afternoon</th>

<th>Night</th>

<th>Duration</th>

<th>Prescribed Qty</th>

<th>Dispense Qty</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($medicineQuery))
{
$remaining = $row['quantity'] - $row['dispensed'];
?>

<tr>

<td>

<?php echo $row['medicine_name']; ?>

<input
type="hidden"
name="medicine_id[]"
value="<?php echo $row['medicine_id']; ?>">

</td>

<td><?php echo $row['dosage']; ?></td>

<td><?php echo $row['morning'] ? "✔" : "-"; ?></td>

<td><?php echo $row['afternoon'] ? "✔" : "-"; ?></td>

<td><?php echo $row['night'] ? "✔" : "-"; ?></td>

<td><?php echo $row['duration']; ?></td>

<td>

<?php echo $row['quantity']; ?>

<?php
if($row['dispensed']>0)
{
    echo "<br><small class='text-success'>
    Dispensed : ".$row['dispensed']."
    </small>";
}
?>

</td>

<td>
<?php
if($remaining<=0)
{
    echo "<span class='badge bg-success mb-2'>Fully Dispensed</span>";
}
?>
<input
type="number"
class="form-control"
name="dispense_qty[]"
value="<?php echo $remaining; ?>"
min="1"
max="<?php echo $remaining; ?>"
<?php if($remaining<=0) echo "disabled"; ?>>
</td>

</tr>

<?php

}

?>

</tbody>

</table>

<button
class="btn btn-success"
name="dispense">

Dispense Medicine

</button>

<a
href="scanPrescription.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>
<?php

if(isset($_POST['dispense']))
{

    $userId = $_SESSION['user_id'];

    $getPharmacy = mysqli_query($conn,
    "SELECT pharmacy_id
     FROM pharmacies
     WHERE user_id='$userId'");

    $pharmacy = mysqli_fetch_assoc($getPharmacy);

    $pharmacyId = $pharmacy['pharmacy_id'];

    $medicineIds = $_POST['medicine_id'];
    $quantities = $_POST['dispense_qty'];
    $fullyDispensed = true;

    for($i=0; $i<count($medicineIds); $i++)
    {
        $medicineId = $medicineIds[$i];
        $qty = $quantities[$i];
        $getQty = mysqli_query($conn,"
SELECT quantity
FROM prescription_items
WHERE prescription_id='$prescriptionId'
AND medicine_id='$medicineId'
");

$item = mysqli_fetch_assoc($getQty);

$prescribedQty = $item['quantity'];

if($qty < $prescribedQty)
{
    $fullyDispensed = false;
}

// Find how many have already been dispensed
$getDispensed = mysqli_query($conn,"
SELECT COALESCE(SUM(dispensed_quantity),0) AS dispensed
FROM dispensed_medicines
WHERE prescription_id='$prescriptionId'
AND medicine_id='$medicineId'
");

$d = mysqli_fetch_assoc($getDispensed);
$alreadyDispensed = $d['dispensed'];

// Don't allow dispensing more than prescribed
if(($alreadyDispensed + $qty) <= $prescribedQty)
{
    mysqli_query($conn,"
    INSERT INTO dispensed_medicines
    (
        prescription_id,
        pharmacy_id,
        medicine_id,
        dispensed_quantity,
        dispense_date
    )
    VALUES
    (
        '$prescriptionId',
        '$pharmacyId',
        '$medicineId',
        '$qty',
        NOW()
    )
    ");
}
else
{
    die("Cannot dispense more than the prescribed quantity.");
} 
}
$remaining = mysqli_query($conn,"
SELECT
    pi.quantity,
    COALESCE(SUM(dm.dispensed_quantity),0) AS dispensed
FROM prescription_items pi
LEFT JOIN dispensed_medicines dm
ON pi.prescription_id = dm.prescription_id
AND pi.medicine_id = dm.medicine_id
WHERE pi.prescription_id='$prescriptionId'
GROUP BY pi.item_id
");

$allCompleted = true;

while($r = mysqli_fetch_assoc($remaining))
{
    if($r['dispensed'] < $r['quantity'])
    {
        $allCompleted = false;
        break;
    }
}

if($allCompleted)
{
    mysqli_query($conn,"
    UPDATE prescriptions
    SET status='Dispensed'
    WHERE prescription_id='$prescriptionId'
    ");
}

$_SESSION['success'] = "Medicine Dispensed Successfully";

header("Location: history.php");
exit();
}
?>
<?php include("includes/footer.php"); ?>