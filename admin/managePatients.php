<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_GET['delete']))
{
    $patientId=$_GET['delete'];

    $result=mysqli_query($conn,
    "SELECT user_id FROM patients WHERE patient_id='$patientId'");

    $patient=mysqli_fetch_assoc($result);

    if($patient)
    {
        mysqli_query($conn,
        "DELETE FROM patients WHERE patient_id='$patientId'");

        mysqli_query($conn,
        "DELETE FROM users WHERE id='".$patient['user_id']."'");

        echo "<script>alert('Patient Deleted');</script>";
    }
}

$query=mysqli_query($conn,"
SELECT patients.*,users.email
FROM patients
JOIN users
ON patients.user_id=users.id
");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Manage Patients</h2>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Age</th>

<th>Gender</th>

<th>Phone</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['patient_id']; ?></td>

<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['age']; ?></td>

<td><?php echo $row['gender']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<a
href="editPatient.php?id=<?php echo $row['patient_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="?delete=<?php echo $row['patient_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Patient?')">

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