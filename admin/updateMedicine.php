<?php
include("../sessions/check_login.php");
include("../config/db.php");

$medicineId = $_POST['medicine_id'];

$name = $_POST['medicine_name'];
$manufacturer = $_POST['manufacturer'];
$dosage = $_POST['dosage'];
$description = $_POST['description'];

mysqli_query($conn,"
UPDATE medicines
SET
medicine_name='$name',
manufacturer='$manufacturer',
dosage='$dosage',
description='$description'
WHERE medicine_id='$medicineId'
");

echo "
<script>
alert('Medicine Updated Successfully');
window.location='manageMedicines.php';
</script>
";
?>