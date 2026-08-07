<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

$patients = mysqli_query($conn,"SELECT * FROM patients");
$medicines = mysqli_query($conn,"SELECT * FROM medicines");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-10 p-4">

<h2>Create Prescription</h2>

<form action="savePrescription.php" method="POST">

<div class="mb-3">

<label>Patient</label>

<select name="patient" class="form-select" required>

<option value="">Select Patient</option>

<?php
while($row=mysqli_fetch_assoc($patients))
{
?>

<option value="<?php echo $row['patient_id']; ?>">

<?php echo $row['patient_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>Diagnosis</label>

<textarea
name="diagnosis"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label>Symptoms</label>

<textarea
name="symptoms"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Doctor Notes</label>

<textarea
name="notes"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Expiry Date</label>

<input
type="date"
name="expiry"
class="form-control"
required>

</div>

<hr>

<h4>Medicines</h4>

<div id="medicineContainer">

<div class="medicine-row border rounded p-3 mb-3">

<label>Medicine</label>

<select name="medicine[]" class="form-select mb-2">

<?php
mysqli_data_seek($medicines,0);

while($med=mysqli_fetch_assoc($medicines))
{
?>

<option value="<?php echo $med['medicine_id']; ?>">
<?php echo $med['medicine_name']; ?>
</option>

<?php
}
?>

</select>

<div class="row">

<div class="col">

<label>Morning</label><br>
<input type="hidden" name="morning[]" value="0">

<input
type="checkbox"
value="1"
onclick="this.previousElementSibling.value=this.checked?1:0;">
</div>

<div class="col">

<label>Afternoon</label><br>
<input type="hidden" name="afternoon[]" value="0">

<input
type="checkbox"
value="1"
onclick="this.previousElementSibling.value=this.checked?1:0;">

</div>

<div class="col">

<label>Night</label><br>
<input type="hidden" name="night[]" value="0">

<input
type="checkbox"
value="1"
onclick="this.previousElementSibling.value=this.checked?1:0;">

</div>

</div>

<br>

<label>Food</label>

<select name="food[]" class="form-select">

<option>Before Food</option>
<option>After Food</option>

</select>

<br>

<label>Duration</label>

<input
type="text"
name="duration[]"
class="form-control">

<br>

<label>Quantity</label>

<input
type="number"
name="quantity[]"
class="form-control">

</div>

</div>

<button
type="button"
id="addMedicine"
class="btn btn-primary">

+ Add Another Medicine

</button>

<br><br>

<button
class="btn btn-success">

Generate Prescription

</button>

</form>

</div>

</div>

</div>
<script>

document.getElementById("addMedicine").addEventListener("click", function () {

    let first = document.querySelector(".medicine-row");

    let clone = first.cloneNode(true);

    clone.querySelectorAll("input").forEach(function(input){

        if(input.type === "checkbox"){
            input.checked = false;
        }else{
            input.value = "";
        }

    });

    clone.querySelectorAll("select").forEach(function(select){

        select.selectedIndex = 0;

    });

    document.getElementById("medicineContainer").appendChild(clone);

});

</script>

<?php include("includes/footer.php"); ?>
