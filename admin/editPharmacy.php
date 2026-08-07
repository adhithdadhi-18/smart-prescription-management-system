<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(!isset($_GET['id']))
{
    die("Pharmacy not found.");
}

$pharmacyId = $_GET['id'];

$query = mysqli_query($conn,"
SELECT pharmacies.*, users.email
FROM pharmacies
JOIN users
ON pharmacies.user_id = users.id
WHERE pharmacy_id='$pharmacyId'
");

$pharmacy = mysqli_fetch_assoc($query);

if(!$pharmacy)
{
    die("Pharmacy not found.");
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

<h3>Edit Pharmacy</h3>

</div>

<div class="card-body">

<form action="updatePharmacy.php" method="POST">

<input
type="hidden"
name="pharmacy_id"
value="<?php echo $pharmacy['pharmacy_id']; ?>">

<input
type="hidden"
name="user_id"
value="<?php echo $pharmacy['user_id']; ?>">

<div class="mb-3">
<label>Owner Name</label>
<input
type="text"
name="owner_name"
class="form-control"
value="<?php echo $pharmacy['owner_name']; ?>"
required>
</div>

<div class="mb-3">
<label>Pharmacy Name</label>
<input
type="text"
name="pharmacy_name"
class="form-control"
value="<?php echo $pharmacy['pharmacy_name']; ?>"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
value="<?php echo $pharmacy['email']; ?>"
required>
</div>

<div class="mb-3">
<label>District</label>
<input
type="text"
name="district"
class="form-control"
value="<?php echo $pharmacy['district']; ?>"
required>
</div>

<div class="mb-3">
<label>Town</label>
<input
type="text"
name="town"
class="form-control"
value="<?php echo $pharmacy['town']; ?>"
required>
</div>

<div class="mb-3">
<label>Pincode</label>
<input
type="text"
name="pincode"
class="form-control"
value="<?php echo $pharmacy['pincode']; ?>"
required>
</div>

<div class="mb-3">
<label>Phone</label>
<input
type="text"
name="phone"
class="form-control"
value="<?php echo $pharmacy['phone']; ?>"
required>
</div>

<button class="btn btn-success">
Update Pharmacy
</button>

<a
href="managePharmacies.php"
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