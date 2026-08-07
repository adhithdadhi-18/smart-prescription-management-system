<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(!isset($_GET['id']))
{
    die("Doctor not found.");
}

$doctorId = $_GET['id'];

$query = mysqli_query($conn,"
SELECT doctors.*, users.email
FROM doctors
JOIN users
ON doctors.user_id = users.id
WHERE doctor_id='$doctorId'
");

$doctor = mysqli_fetch_assoc($query);

if(!$doctor)
{
    die("Doctor not found.");
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Doctor</h3>

</div>

<div class="card-body">

<form action="updateDoctor.php" method="POST">

<input
type="hidden"
name="doctor_id"
value="<?php echo $doctor['doctor_id']; ?>">

<input
type="hidden"
name="user_id"
value="<?php echo $doctor['user_id']; ?>">

<div class="mb-3">

<label>Doctor Name</label>

<input
type="text"
name="doctor_name"
class="form-control"
value="<?php echo $doctor['doctor_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $doctor['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Specialization</label>

<input
type="text"
name="specialization"
class="form-control"
value="<?php echo $doctor['specialization']; ?>"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $doctor['phone']; ?>"
required>

</div>
<button
type="button"
class="btn btn-primary mb-3"
onclick="addMedicine()">
<i class="fa-solid fa-plus"></i>
Add Medicine
</button>
<button class="btn btn-success">

Update Doctor

</button>

<a
href="manageDoctors.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>