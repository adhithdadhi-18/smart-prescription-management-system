<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];

    mysqli_query($conn,"DELETE FROM medicines WHERE medicine_id='$id'");

    echo "<script>alert('Medicine Deleted Successfully');</script>";
}

$query=mysqli_query($conn,"SELECT * FROM medicines");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-10 p-4">

<h2>Manage Medicines</h2>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Medicine</th>
<th>Manufacturer</th>
<th>Dosage</th>
<th>Description</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?php echo $row['medicine_id']; ?></td>

<td><?php echo $row['medicine_name']; ?></td>

<td><?php echo $row['manufacturer']; ?></td>

<td><?php echo $row['dosage']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>

<a
href="editMedicine.php?id=<?php echo $row['medicine_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="?delete=<?php echo $row['medicine_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this medicine?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>