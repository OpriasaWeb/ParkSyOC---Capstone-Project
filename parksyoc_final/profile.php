<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - Profile</title>
</head>
<body>
  <!-- Navbar section -->
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
  <!-- Navbar section -->

  <!-- Jumbotron section -->
  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Admin profile section</h1>
      <p>As admin you can manage your account here.</p>
    </div>
  </div>
  <!-- Jumbotron section -->
  
  <!-- Add vehicle section -->
  <div class="container">
    <form action="" method="POST">
      <div class="add-vehicle">
        <!-- <h4>Choose vehicle class</h4>
        <select class="form-select" id="inputGroupSelect01">
          <option selected>Choose...</option>
          <option value="1">Four wheel car</option>
          <option value="2">Motor</option>
          <option value="3">Bicycle</option>
        </select> -->

        <div class="input-group mb-3">
          <label>Admin name</label>
          <input type="text" class="form-control" placeholder="Admin name" aria-label="" aria-describedby="button-addon2">
        </div>

        <div class="input-group mb-3">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Username" aria-label="" aria-describedby="button-addon2">
        </div>

        <div class="input-group mb-3">
          <label>Contact number</label>
          <input type="text" class="form-control" placeholder="No.#" aria-label="" aria-describedby="button-addon2">
        </div>

        <div class="input-group mb-3">
          <label>Email</label>
          <input type="text" class="form-control" placeholder="Email" aria-label="" aria-describedby="button-addon2">
        </div>

        <div class="button-sbmt">
          <button class="btn btn-outline-primary mx-auto" type="button" id="button-addon2">Update</button>
        </div>
      </div>
    </form>
  </div>
  
  <!-- Add vehicle section -->
  
  
  <!-- Footer section -->
  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <p class="col-md-4 mb-0 text-muted">&copy; 2021-2022 school year / ParkSyOC: Vehicle Parking System in Olivarez College - Parañaque Campus</p>

      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <i class="fas fa-parking"></i>arkSyOC
      </a>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#"><i class="fab fa-facebook"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><i class="fab fa-instagram"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><i class="fab fa-github"></i></a></li>
      </ul>
    </footer>
  </div>
  <!-- Footer section -->






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>

</body>
</html>