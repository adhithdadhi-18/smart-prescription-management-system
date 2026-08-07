<?php
include("../sessions/check_login.php");
include("../config/db.php");

$doctorId = $_POST['doctor_id'];
$userId = $_POST['user_id'];

$name = $_POST['doctor_name'];
$email = $_POST['email'];
$specialization = $_POST['specialization'];
$phone = $_POST['phone'];

mysqli_query($conn,"
UPDATE doctors
SET
doctor_name='$name',
specialization='$specialization',
phone='$phone'
WHERE doctor_id='$doctorId'
");

mysqli_query($conn,"
UPDATE users
SET
email='$email',
name='$name'
WHERE id='$userId'
");

echo "
<script>
alert('Doctor Updated Successfully');
window.location='manageDoctors.php';
</script>
";
?>