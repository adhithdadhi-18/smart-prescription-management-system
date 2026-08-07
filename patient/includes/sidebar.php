<div class="bg-primary text-white vh-100 shadow" style="width:250px;">

    <div class="text-center py-4 border-bottom">

        <i class="fa-solid fa-user fa-3x mb-3"></i>

        <h4>Patient Panel</h4>

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

            <a href="myPrescription.php" class="nav-link text-white">

                <i class="fa-solid fa-file-prescription me-2"></i>

                My Prescriptions

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="searchPharmacy.php" class="nav-link text-white">

                <i class="fa-solid fa-magnifying-glass-location me-2"></i>

                Search Pharmacy

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