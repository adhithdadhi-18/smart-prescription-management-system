<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];

    $result=mysqli_query($conn,
    "SELECT user_id FROM pharmacies WHERE pharmacy_id='$id'");

    $row=mysqli_fetch_assoc($result);

    if($row)
    {
        mysqli_query($conn,
        "DELETE FROM pharmacies WHERE pharmacy_id='$id'");

        mysqli_query($conn,
        "DELETE FROM users WHERE id='".$row['user_id']."'");

        echo "<script>alert('Pharmacy Deleted');</script>";
    }
}

$query=mysqli_query($conn,"
SELECT pharmacies.*,users.email

FROM pharmacies

JOIN users

ON pharmacies.user_id=users.id
");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Manage Pharmacies</h2>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Pharmacy</th>

<th>Owner</th>

<th>Email</th>

<th>District</th>

<th>Town</th>

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

<td><?php echo $row['pharmacy_id']; ?></td>

<td><?php echo $row['pharmacy_name']; ?></td>

<td><?php echo $row['owner_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['district']; ?></td>

<td><?php echo $row['town']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<a
href="editPharmacy.php?id=<?php echo $row['pharmacy_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="?delete=<?php echo $row['pharmacy_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Pharmacy?')">

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