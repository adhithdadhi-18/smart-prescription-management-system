<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

// Delete Doctor
if(isset($_GET['delete']))
{
    $doctorId = $_GET['delete'];

    // Find user_id
    $result = mysqli_query($conn,"SELECT user_id FROM doctors WHERE doctor_id='$doctorId'");
    $doctor = mysqli_fetch_assoc($result);

    if($doctor)
    {
        $userId = $doctor['user_id'];

        mysqli_query($conn,"DELETE FROM doctors WHERE doctor_id='$doctorId'");
        mysqli_query($conn,"DELETE FROM users WHERE id='$userId'");

        echo "<script>alert('Doctor Deleted Successfully');</script>";
    }
}

$query = mysqli_query($conn,"
SELECT doctors.*, users.email
FROM doctors
JOIN users
ON doctors.user_id = users.id
");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-10 p-4">

<h2>Manage Doctors</h2>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Specialization</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['doctor_id']; ?></td>

<td><?php echo $row['doctor_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['specialization']; ?></td>

<td>

<a
href="editDoctor.php?id=<?php echo $row['doctor_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="?delete=<?php echo $row['doctor_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this doctor?')">

Delete

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>