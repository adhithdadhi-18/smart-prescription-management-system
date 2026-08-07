<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(!isset($_GET['id']))
{
    die("Patient not found.");
}

$patientId = $_GET['id'];

$query = mysqli_query($conn,"
SELECT patients.*, users.email
FROM patients
JOIN users
ON patients.user_id = users.id
WHERE patient_id='$patientId'
");

$patient = mysqli_fetch_assoc($query);

if(!$patient)
{
    die("Patient not found.");
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

<h3>Edit Patient</h3>

</div>

<div class="card-body">

<form action="updatePatient.php" method="POST">

<input
type="hidden"
name="patient_id"
value="<?php echo $patient['patient_id']; ?>">

<input
type="hidden"
name="user_id"
value="<?php echo $patient['user_id']; ?>">

<div class="mb-3">

<label>Patient Name</label>

<input
type="text"
name="patient_name"
class="form-control"
value="<?php echo $patient['patient_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $patient['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Age</label>

<input
type="number"
name="age"
class="form-control"
value="<?php echo $patient['age']; ?>"
required>

</div>

<div class="mb-3">

<label>Gender</label>

<select
name="gender"
class="form-select">

<option value="Male" <?php if($patient['gender']=="Male") echo "selected"; ?>>
Male
</option>

<option value="Female" <?php if($patient['gender']=="Female") echo "selected"; ?>>
Female
</option>

<option value="Other" <?php if($patient['gender']=="Other") echo "selected"; ?>>
Other
</option>

</select>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $patient['phone']; ?>"
required>

</div>

<div class="mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
required><?php echo $patient['address']; ?></textarea>

</div>

<button class="btn btn-success">

Update Patient

</button>

<a
href="managePatients.php"
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