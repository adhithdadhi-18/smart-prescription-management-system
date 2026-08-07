<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(!isset($_GET['id']))
{
    die("Medicine not found.");
}

$medicineId = $_GET['id'];

$query = mysqli_query($conn,"
SELECT *
FROM medicines
WHERE medicine_id='$medicineId'
");

$medicine = mysqli_fetch_assoc($query);

if(!$medicine)
{
    die("Medicine not found.");
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<div class="card shadow">

<div class="card-header bg-warning text-dark">

<h3>Edit Medicine</h3>

</div>

<div class="card-body">

<form action="updateMedicine.php" method="POST">

<input
type="hidden"
name="medicine_id"
value="<?php echo $medicine['medicine_id']; ?>">

<div class="mb-3">

<label>Medicine Name</label>

<input
type="text"
name="medicine_name"
class="form-control"
value="<?php echo $medicine['medicine_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Manufacturer</label>

<input
type="text"
name="manufacturer"
class="form-control"
value="<?php echo $medicine['manufacturer']; ?>"
required>

</div>

<div class="mb-3">

<label>Dosage</label>

<input
type="text"
name="dosage"
class="form-control"
value="<?php echo $medicine['dosage']; ?>"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
required><?php echo $medicine['description']; ?></textarea>

</div>

<button
class="btn btn-success">

Update Medicine

</button>

<a
href="manageMedicines.php"
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