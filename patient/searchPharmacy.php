<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Search Pharmacy</h2>

<form method="GET" class="mb-4">

<div class="row">

<div class="col-md-6">

<input
type="text"
name="search"
class="form-control"
placeholder="Enter Pharmacy Name"
value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

</div>

<div class="col-md-2">

<button class="btn btn-primary">

Search

</button>

</div>

</div>

</form>

<?php

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

$query = mysqli_query($conn,"
SELECT *
FROM pharmacies
WHERE pharmacy_name LIKE '%$search%'
ORDER BY pharmacy_name
");

?>

<table class="table table-bordered table-striped">

<thead class="table-success">

<tr>

<th>Pharmacy Name</th>
<th>Owner</th>
<th>District</th>
<th>Town</th>
<th>Phone</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $row['pharmacy_name']; ?></td>

<td><?php echo $row['owner_name']; ?></td>

<td><?php echo $row['district']; ?></td>

<td><?php echo $row['town']; ?></td>

<td><?php echo $row['phone']; ?></td>

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