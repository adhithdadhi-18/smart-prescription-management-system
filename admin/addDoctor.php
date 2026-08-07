<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_POST['save']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];

    $userQuery = "INSERT INTO users(name,email,password,role)
                  VALUES('$name','$email','$password','doctor')";

    if(mysqli_query($conn,$userQuery))
    {
        $userId = mysqli_insert_id($conn);

        $doctorQuery = "INSERT INTO doctors(user_id,doctor_name,specialization,phone)
                        VALUES('$userId','$name','$specialization','$phone')";

        mysqli_query($conn,$doctorQuery);

        echo "<script>alert('Doctor Added Successfully');</script>";
    }
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-10 p-4">

<h2>Add Doctor</h2>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input
type="text"
name="name"
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
<label>Phone</label>
<input
type="text"
name="phone"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Specialization</label>
<input
type="text"
name="specialization"
class="form-control"
required>
</div>

<button
name="save"
class="btn btn-success">

Save Doctor

</button>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>