<?php
include("../sessions/check_login.php");
include("../config/db.php");

$patientId = $_POST['patient_id'];
$userId = $_POST['user_id'];

$name = $_POST['patient_name'];
$email = $_POST['email'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$address = $_POST['address'];

mysqli_query($conn,"
UPDATE patients
SET
patient_name='$name',
age='$age',
gender='$gender',
phone='$phone',
address='$address'
WHERE patient_id='$patientId'
");

mysqli_query($conn,"
UPDATE users
SET
name='$name',
email='$email'
WHERE id='$userId'
");

echo "
<script>
alert('Patient Updated Successfully');
window.location='managePatients.php';
</script>
";
?>