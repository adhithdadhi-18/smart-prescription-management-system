<div class="bg-primary text-white vh-100 shadow" style="width:250px;">

    <div class="text-center py-4 border-bottom">

        <i class="fa-solid fa-notes-medical fa-3x mb-3"></i>

        <h4>Admin Panel</h4>

        <small>
            Welcome,
            <br>
            <?php echo $_SESSION['name']; ?>
        </small>

    </div>

    <ul class="nav flex-column p-3">

        <li class="nav-item mb-2">
            <a href="dashboard.php" class="nav-link text-white">
                <i class="fa-solid fa-house me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="addDoctor.php" class="nav-link text-white">
                <i class="fa-solid fa-user-doctor me-2"></i>
                Add Doctor
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="manageDoctors.php" class="nav-link text-white">
                <i class="fa-solid fa-users me-2"></i>
                Manage Doctors
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="addPatient.php" class="nav-link text-white">
                <i class="fa-solid fa-user-plus me-2"></i>
                Add Patient
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="managePatients.php" class="nav-link text-white">
                <i class="fa-solid fa-user-group me-2"></i>
                Manage Patients
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="addPharmacy.php" class="nav-link text-white">
                <i class="fa-solid fa-hospital me-2"></i>
                Add Pharmacy
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="managePharmacies.php" class="nav-link text-white">
             <i class="fa-solid fa-house-medical me-2"></i>
                Manage Pharmacies
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="addMedicine.php" class="nav-link text-white">
                <i class="fa-solid fa-pills me-2"></i>
                Add Medicine
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="manageMedicines.php" class="nav-link text-white">
                <i class="fa-solid fa-capsules me-2"></i>
                Manage Medicines
            </a>
        </li>

        <li class="nav-item mt-4">

            <a href="../logout.php" class="btn btn-danger w-100 rounded-pill">

                <i class="fa-solid fa-right-from-bracket me-2"></i>

                Logout

            </a>

        </li>

    </ul>

</div>