<?php
include("../sessions/check_login.php");
include("../config/db.php");

$prescriptionId = $_POST['prescription_id'];
$patient = $_POST['patient'];
$diagnosis = $_POST['diagnosis'];
$symptoms = $_POST['symptoms'];
$notes = $_POST['notes'];
$expiry = $_POST['expiry'];

// Check status
$check = mysqli_query($conn,"
SELECT status
FROM prescriptions
WHERE prescription_id='$prescriptionId'
");

$row = mysqli_fetch_assoc($check);

if($row['status'] != "Active")
{
    die("This prescription can no longer be edited.");
}

// Update prescription details
mysqli_query($conn,"
UPDATE prescriptions
SET
patient_id='$patient',
diagnosis='$diagnosis',
symptoms='$symptoms',
doctor_notes='$notes',
expiry_date='$expiry'
WHERE prescription_id='$prescriptionId'
");

// Get all existing prescription item IDs
$itemQuery = mysqli_query($conn,"
SELECT item_id
FROM prescription_items
WHERE prescription_id='$prescriptionId'
ORDER BY item_id
");

$itemIds = [];

while($item = mysqli_fetch_assoc($itemQuery))
{
    $itemIds[] = $item['item_id'];
}

$medicine = $_POST['medicine'];
$food = $_POST['food'];
$duration = $_POST['duration'];
$quantity = $_POST['quantity'];

for($i=0; $i<count($medicine); $i++)
{
    $morning = isset($_POST['morning'][$i]) ? 1 : 0;
    $afternoon = isset($_POST['afternoon'][$i]) ? 1 : 0;
    $night = isset($_POST['night'][$i]) ? 1 : 0;

    if(isset($itemIds[$i]))
    {
        mysqli_query($conn,"
        UPDATE prescription_items
        SET
        medicine_id='".$medicine[$i]."',
        morning='$morning',
        afternoon='$afternoon',
        night='$night',
        food='".$food[$i]."',
        duration='".$duration[$i]."',
        quantity='".$quantity[$i]."'
        WHERE item_id='".$itemIds[$i]."'
        ");
    }
    else
    {
        mysqli_query($conn,"
        INSERT INTO prescription_items
        (
            prescription_id,
            medicine_id,
            morning,
            afternoon,
            night,
            food,
            duration,
            quantity
        )
        VALUES
        (
            '$prescriptionId',
            '".$medicine[$i]."',
            '$morning',
            '$afternoon',
            '$night',
            '".$food[$i]."',
            '".$duration[$i]."',
            '".$quantity[$i]."'
        )
        ");
    }
}
echo "
<script>
alert('Prescription Updated Successfully');
window.location='history.php';
</script>
";
?>