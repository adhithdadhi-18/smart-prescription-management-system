<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_POST['save']))
{
    $owner=$_POST['owner'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $pharmacy=$_POST['pharmacy'];
    $district=$_POST['district'];
    $town=$_POST['town'];
    $pincode=$_POST['pincode'];
    $phone=$_POST['phone'];

    $query="INSERT INTO users(name,email,password,role)
    VALUES('$owner','$email','$password','pharmacy')";

    if(mysqli_query($conn,$query))
    {
        $userId=mysqli_insert_id($conn);

        mysqli_query($conn,"
        INSERT INTO pharmacies
        (user_id,owner_name,pharmacy_name,district,town,pincode,phone)

        VALUES

        ('$userId','$owner','$pharmacy','$district','$town','$pincode','$phone')
        ");

        echo "<script>alert('Pharmacy Added Successfully');</script>";
    }
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Add Pharmacy</h2>

<form method="POST">

<div class="mb-3">

<label>Owner Name</label>

<input
type="text"
name="owner"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="text"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Pharmacy Name</label>

<input
type="text"
name="pharmacy"
class="form-control"
required>

</div>

<div class="mb-3">

<label>District</label>

<input
type="text"
name="district"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Town</label>

<input
type="text"
name="town"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Pincode</label>

<input
type="text"
name="pincode"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
required>

</div>

<button
name="save"
class="btn btn-success">

Save Pharmacy

</button>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>