<?php
include("../sessions/check_login.php");
include("../config/db.php");

if(!isset($_GET['id']))
{
    die("Prescription not found.");
}

$prescriptionId = $_GET['id'];

// Check current status
$query = mysqli_query($conn,"
SELECT status
FROM prescriptions
WHERE prescription_id='$prescriptionId'
");

$row = mysqli_fetch_assoc($query);

if(!$row)
{
    die("Prescription not found.");
}

if($row['status'] != "Active")
{
    die("Only Active prescriptions can be cancelled.");
}

// Update status
mysqli_query($conn,"
UPDATE prescriptions
SET status='Cancelled'
WHERE prescription_id='$prescriptionId'
");

echo "
<script>
alert('Prescription Cancelled Successfully');
window.location='history.php';
</script>
";
?>