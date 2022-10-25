<?php

require_once './db/pdo.php';

$statement = $pdo->query("SELECT * FROM add_vehicle WHERE cstmr_stts = 'Out'");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


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
  <title>ParkSyOC - View Outgoing Vehicle details</title>
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
              <li><a class="dropdown-item" href="./manageMember.php">Manage all members</a></li>
              <li><a class="dropdown-item" href="./pendingMmbrship.php">Pending membership</a></li>
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

  <div class="container">
    <div class="jumbutron-section">
      <div class="mt-4 p-5 bg-success text-white rounded">
        <h1>Outgoing vehicle details</h1>
        <p>This is where you can view the whole details of the vehicle who use the parking in Olivarez College.</p>
      </div>
    </div>
  </div>
  <br>
  <!-- Go back -->
  <div class="container">
    <a href="./manageOut.php" class="btn btn-secondary"><i class="fas fa-hand-point-left"></i> Back to view outgoing</a>
  </div>
  
  <!-- Manage vehicle section -->
  <div class="container mt-3">
    <h2>View outgoing vehicle details</h2>          
    <table class="table table-hover">
      <tbody>
        <tr>
          <td class="bold">Parking number</td>
          <td>55</td>
        </tr>
        <tr>
          <td class="bold">Vehicle category</td>
          <td>Four wheel car</td>
        </tr>
        <tr>
          <td class="bold">Plate number</td>
          <td>AAP 5E4</td>
        </tr>
        <tr>
          <td class="bold">Owner name</td>
          <td>Jeremy</td>
        </tr>
        <tr>
          <td class="bold">Contact number</td>
          <td>09738477281</td>
        </tr>
        <tr>
          <td class="bold">Time in</td>
          <td>12:34:29</td>
        </tr>
        <tr>
          <td class="bold">Out time</td>
          <td>6:02:57</td>
        </tr>
        <tr>
          <td class="bold">Remarks</td>
          <td>N/A</td>
        </tr>
        <tr>
          <td class="bold">Status</td>
          <td>Vehicle In</td>
        </tr>
        <tr>
          <td class="bold">Parking fee</td>
          <td>20</td>
        </tr>
      </tbody>
    </table>
  </div>



  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>

</body>
</html>