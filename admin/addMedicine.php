<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_POST['save']))
{
    $medicine=$_POST['medicine'];
    $manufacturer=$_POST['manufacturer'];
    $dosage=$_POST['dosage'];
    $description=$_POST['description'];

    mysqli_query($conn,"
    INSERT INTO medicines
    (medicine_name,manufacturer,dosage,description)
    VALUES
    ('$medicine','$manufacturer','$dosage','$description')
    ");

    echo "<script>alert('Medicine Added Successfully');</script>";
}
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-10 p-4">

<h2>Add Medicine</h2>

<form method="POST">

<div class="mb-3">
<label>Medicine Name</label>
<input type="text" name="medicine" class="form-control" required>
</div>

<div class="mb-3">
<label>Manufacturer</label>
<input type="text" name="manufacturer" class="form-control" required>
</div>

<div class="mb-3">
<label>Dosage</label>
<input type="text" name="dosage" class="form-control" placeholder="500 mg" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"></textarea>
</div>

<button name="save" class="btn btn-success">
Save Medicine
</button>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>