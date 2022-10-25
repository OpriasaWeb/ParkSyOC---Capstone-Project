<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-parking"></i>arkSyOC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./dashboard.php"><i class="fas fa-columns"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./qrScanner.php" target="_blank" id="" role="button" data-bs-toggle="" aria-expanded="">
            <i class="fas fa-qrcode"></i> QR Scanner
          </a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vehicle class
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./addClass.php">Add class</a></li>
            <li><a class="dropdown-item" href="./manageClass.php">Manage class</a></li>
          </ul>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="./addVehicle.php"><i class="far fa-plus-square"></i> Add vehicle</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bookmark-plus-fill"></i> Vehicle bookings
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./newBooking.php">New bookings</a></li>
            <li><a class="dropdown-item" href="./completedBookings.php">Completed bookings</a></li>
            <li><a class="dropdown-item" href="./otherDateBookings.php">Other date bookings</a></li>
            <!-- <li class="nav-item m-3">
              <button type="text" class="btn btn-outline-primary" data-bs-toggle="modal"  data-bs-target="#exampleModal">
                Book parking
              </button>
            </li> -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage vehicle
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./manageIn.php">Manage-in vehicle</a></li>
            <li><a class="dropdown-item" href="./manageOut.php">Manage-out vehicle</a></li>
            <li><a class="dropdown-item" href="./searchVehicle.php">All vehicle parkings</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle"></i> Memberships
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./pendingMmbrship.php">Pending membership</a></li>
            <li><a class="dropdown-item" href="./appntmntMember.php">Appointment</a></li>
            <li><a class="dropdown-item" href="./manageMember.php">Manage all members</a></li>
            <!-- <li class="nav-item text-light m-3">
              <a class="btn btn-outline-success" href="./addMember.php">Add member</a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-inbox"></i> 
            Message queries
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./queries.php">Messages pending</a></li>
            <li><a class="dropdown-item" href="./queriesConfirmed.php">Messages read</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-address-card"></i> Admin account
          </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="./register.php">Register admin</a></li>
              <li><a class="dropdown-item" href="./logout.php">Log out</a></li>
            </ul>
        </li>
        

      </ul>
    </div>
    

  </div>

  
</nav>