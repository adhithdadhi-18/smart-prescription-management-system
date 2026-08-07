<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_POST['save']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    $userQuery="INSERT INTO users(name,email,password,role)
    VALUES('$name','$email','$password','patient')";

    if(mysqli_query($conn,$userQuery))
    {
        $userId=mysqli_insert_id($conn);

        mysqli_query($conn,"
        INSERT INTO patients
        (user_id,patient_name,age,gender,phone,address)
        VALUES
        ('$userId','$name','$age','$gender','$phone','$address')
        ");

        echo "<script>alert('Patient Added Successfully');</script>";
    }
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Add Patient</h2>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="text" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Age</label>
<input type="number" name="age" class="form-control" required>
</div>

<div class="mb-3">
<label>Gender</label>

<select name="gender" class="form-select">

<option>Male</option>

<option>Female</option>

<option>Other</option>

</select>

</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label>Address</label>
<textarea
name="address"
class="form-control"></textarea>
</div>

<button
name="save"
class="btn btn-success">

Save Patient

</button>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>