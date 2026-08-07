<?php
include("../sessions/check_login.php");
include("../config/db.php");
include("includes/header.php");

if(!isset($_GET['id']))
{
    die("Prescription not found.");
}

$prescriptionId = $_GET['id'];

// Get Prescription Details
$query = mysqli_query($conn,"
SELECT *
FROM prescriptions
WHERE prescription_id='$prescriptionId'
");

$prescription = mysqli_fetch_assoc($query);

// Don't allow editing if already dispensed
if($prescription['status'] != "Active")
{
    die("<h3>This prescription can no longer be edited.</h3>");
}

$patients = mysqli_query($conn,"SELECT * FROM patients");
$medicines = mysqli_query($conn,"SELECT * FROM medicines");

$prescriptionMedicines = mysqli_query($conn,"
SELECT *
FROM prescription_items
WHERE prescription_id='$prescriptionId'
");
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-10 p-4">

<h2>Edit Prescription</h2>

<form action="updatePrescription.php" method="POST">

<input
type="hidden"
name="prescription_id"
value="<?php echo $prescriptionId; ?>">

<div class="mb-3">

<label>Patient</label>

<select
name="patient"
class="form-select">

<?php
while($patient=mysqli_fetch_assoc($patients))
{
?>

<option
value="<?php echo $patient['patient_id']; ?>"
<?php
if($patient['patient_id']==$prescription['patient_id'])
echo "selected";
?>>

<?php echo $patient['patient_name']; ?>

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
class="form-control"><?php echo $prescription['diagnosis']; ?></textarea>

</div>

<div class="mb-3">

<label>Symptoms</label>

<textarea
name="symptoms"
class="form-control"><?php echo $prescription['symptoms']; ?></textarea>

</div>

<div class="mb-3">

<label>Doctor Notes</label>

<textarea
name="notes"
class="form-control"><?php echo $prescription['doctor_notes']; ?></textarea>

</div>

<div class="mb-3">

<label>Expiry Date</label>

<input
type="date"
name="expiry"
class="form-control"
value="<?php echo $prescription['expiry_date']; ?>">

</div>
<hr>

<h4>Edit Medicines</h4>
<div id="medicineContainer">
<?php
while($item=mysqli_fetch_assoc($prescriptionMedicines))
{
?>
<div class="border rounded p-3 mb-3 medicine-block">
    <div class="text-end mb-2">

    <button
    type="button"
    class="btn btn-danger btn-sm"
    onclick="removeMedicine(this)">

        <i class="fa-solid fa-trash"></i>

        Remove

    </button>

</div>

<label>Medicine</label>

<select
name="medicine[]"
class="form-select mb-2">

<?php

mysqli_data_seek($medicines,0);

while($med=mysqli_fetch_assoc($medicines))
{

?>

<option
value="<?php echo $med['medicine_id']; ?>"

<?php
if($med['medicine_id']==$item['medicine_id'])
echo "selected";
?>

>

<?php echo $med['medicine_name']; ?>

</option>

<?php
}
?>
</div>
</select>

<div class="row">

<div class="col">

<label>Morning</label><br>

<input
type="checkbox"
name="morning[]"

<?php
if($item['morning'])
echo "checked";
?>

>

</div>

<div class="col">

<label>Afternoon</label><br>

<input
type="checkbox"
name="afternoon[]"

<?php
if($item['afternoon'])
echo "checked";
?>

>

</div>

<div class="col">

<label>Night</label><br>

<input
type="checkbox"
name="night[]"

<?php
if($item['night'])
echo "checked";
?>

>

</div>

</div>

<br>

<label>Food</label>

<select
name="food[]"
class="form-select">

<option
<?php
if($item['food']=="Before Food")
echo "selected";
?>
>

Before Food

</option>

<option
<?php
if($item['food']=="After Food")
echo "selected";
?>
>

After Food

</option>

</select>

<br>

<label>Duration</label>

<input
type="text"
name="duration[]"
class="form-control"
value="<?php echo $item['duration']; ?>">

<br>

<label>Quantity</label>

<input
type="number"
name="quantity[]"
class="form-control"
value="<?php echo $item['quantity']; ?>">

</div>

<?php
}
?>
</div>
<button
type="button"
class="btn btn-primary mb-3"
onclick="addMedicine()">

<i class="fa-solid fa-plus me-2"></i>

Add Medicine

</button>

<br><br>
<button
class="btn btn-success">

Update Prescription

</button>

<a
href="history.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>
<script>

function addMedicine()
{
    let container = document.getElementById("medicineContainer");

    let firstBlock = container.querySelector(".medicine-block");

    let newBlock = firstBlock.cloneNode(true);

    newBlock.querySelectorAll("input").forEach(function(input){

        if(input.type=="checkbox")
        {
            input.checked = false;
        }
        else
        {
            input.value = "";
        }

    });

    newBlock.querySelectorAll("select").forEach(function(select){

        select.selectedIndex = 0;

    });

    container.appendChild(newBlock);
}

function removeMedicine(button)
{
    let blocks = document.querySelectorAll(".medicine-block");

    if(blocks.length > 1)
    {
        button.closest(".medicine-block").remove();
    }
    else
    {
        alert("At least one medicine is required.");
    }
}

</script>
<?php include("includes/footer.php"); ?>