<?php

include("../sessions/check_login.php");
include("../config/db.php");

echo "<h2>Form Data Received Successfully</h2>";

echo "<hr>";

$patient = $_POST['patient'];
$diagnosis = $_POST['diagnosis'];
$symptoms = $_POST['symptoms'];
$notes = $_POST['notes'];
$expiry = $_POST['expiry'];
$medicines = $_POST['medicine'];

$morning = $_POST['morning'] ?? [];
$afternoon = $_POST['afternoon'] ?? [];
$night = $_POST['night'] ?? [];

$food = $_POST['food'];
$duration = $_POST['duration'];
$quantity = $_POST['quantity'];

echo "<b>Patient ID:</b> ".$patient."<br><br>";

echo "<b>Diagnosis:</b> ".$diagnosis."<br><br>";

echo "<b>Symptoms:</b> ".$symptoms."<br><br>";

echo "<b>Doctor Notes:</b> ".$notes."<br><br>";

echo "<b>Expiry Date:</b> ".$expiry."<br><br>";

echo "<b>Medicine ID:</b> ".$medicine."<br><br>";

echo "<b>Morning:</b> ".$morning."<br><br>";

echo "<b>Afternoon:</b> ".$afternoon."<br><br>";

echo "<b>Night:</b> ".$night."<br><br>";

echo "<b>Food:</b> ".$food."<br><br>";

echo "<b>Duration:</b> ".$duration."<br><br>";

echo "<b>Quantity:</b> ".$quantity."<br><br>";

$userId = $_SESSION['user_id'];

$getDoctor = mysqli_query($conn,
"SELECT doctor_id FROM doctors WHERE user_id='$userId'");

$doctorRow = mysqli_fetch_assoc($getDoctor);

$doctor = $doctorRow['doctor_id'];
$today = date("Y-m-d");

$prescriptionCode = "RX".time();

$status = "Active";

$query = "INSERT INTO prescriptions
(
prescription_code,
doctor_id,
patient_id,
diagnosis,
symptoms,
doctor_notes,
issue_date,
expiry_date,
status
)

VALUES
(
'$prescriptionCode',
'$doctor',
'$patient',
'$diagnosis',
'$symptoms',
'$notes',
'$today',
'$expiry',
'$status'
)";

if(mysqli_query($conn,$query))
{
    $prescriptionId = mysqli_insert_id($conn);

$success = true;

for($i=0; $i<count($medicines); $i++)
{
    $medicineId = $medicines[$i];

 $morningValue = $morning[$i];
$afternoonValue = $afternoon[$i];
$nightValue = $night[$i];

    $foodValue = $food[$i];
    $durationValue = $duration[$i];
    $quantityValue = $quantity[$i];

    $medicineQuery = "INSERT INTO prescription_items
    (
        prescription_id,
        medicine_id,
        morning,
        afternoon,
        night,
        food,
        dosage,
        duration,
        quantity
    )
    VALUES
    (
        '$prescriptionId',
        '$medicineId',
        '$morningValue',
        '$afternoonValue',
        '$nightValue',
        '$foodValue',
        '1 Tablet',
        '$durationValue',
        '$quantityValue'
    )";

    if(!mysqli_query($conn,$medicineQuery))
    {
        $success = false;
        echo mysqli_error($conn);
        break;
    }
}

if($success)
{
    echo "<script>
            alert('Prescription Saved Successfully');
            window.location='dashboard.php';
          </script>";
}
}
else
{
    echo "<h3>Prescription Save Error</h3>";
    echo mysqli_error($conn);
}

?>