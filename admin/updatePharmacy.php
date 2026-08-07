<?php
include("../sessions/check_login.php");
include("../config/db.php");

$pharmacyId = $_POST['pharmacy_id'];
$userId = $_POST['user_id'];

$owner = $_POST['owner_name'];
$pharmacy = $_POST['pharmacy_name'];
$email = $_POST['email'];
$district = $_POST['district'];
$town = $_POST['town'];
$pincode = $_POST['pincode'];
$phone = $_POST['phone'];

mysqli_query($conn,"
UPDATE pharmacies
SET
owner_name='$owner',
pharmacy_name='$pharmacy',
district='$district',
town='$town',
pincode='$pincode',
phone='$phone'
WHERE pharmacy_id='$pharmacyId'
");

mysqli_query($conn,"
UPDATE users
SET
name='$owner',
email='$email'
WHERE id='$userId'
");

echo "
<script>
alert('Pharmacy Updated Successfully');
window.location='managePharmacies.php';
</script>
";
?>