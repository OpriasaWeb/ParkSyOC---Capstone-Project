<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Membership receipt</title>
</head>
<body>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Vehicle class
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./addClass.php">Add class</a></li>
              <li><a class="dropdown-item" href="./manageClass.php">Manage class</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./addVehicle.php"><i class="far fa-plus-square"></i> Add vehicle</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-bookmark-plus-fill"></i> Vehicle bookings
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./newBooking.php">New bookings</a></li>
              <li><a class="dropdown-item" href="./completedBookings.php">Completed bookings</a></li>
              <li><a class="dropdown-item" href="./manageAllBookings.php">Manage all bookings</a></li>
              <li><a class="dropdown-item" href="./bookVehicle.php">Book vehicle</a></li>
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
              <li><a class="dropdown-item" href="./manageMember.php">Manage membership</a></li>
              <li><a class="dropdown-item" href="./addMember.php">Add new member</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>

    <div class="profile">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-address-card"></i>
        </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Log out</a></li>
          </ul>
      </li>
    </div>
  </nav>
</body>
</html>