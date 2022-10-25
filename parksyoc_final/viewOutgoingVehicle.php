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
  <title>ParkSyOC - Add Category</title>
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

  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>View outgoing vehicle</h1>
      <p>This is where you view the overall information of the outgoing vehicle.</p>
    </div>
  </div>

  <div class="goback">
    <a href="./manageOut.php" class="btn btn-secondary">Go back to manage out vehicles</a>
  </div>
  

  <div class="viewVehicle">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Vehicle owner information</th>
          <th scope="col">Input information</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Vehicle id</td>
          <td>D23243sd</td>
        </tr>
        <tr>
          <td>Vehicle class</td>
          <td>Motor</td>
        </tr>
        <tr>
          <td>Plate number</td>
          <td>D65 AAP</td>
        </tr>
        <tr>
          <td>Owner name</td>
          <td>Jeremy Opriasa</td>
        </tr>
        <tr>
          <td>Owner contact number</td>
          <td>09267758198</td>
        </tr>
        <tr>
          <td>In time</td>
          <td>12:22:2021 01:00:39</td>
        </tr>
        <tr>
          <td>Out time</td>
          <td>12:22:2021 05:30:02</td>
        </tr>
        <tr>
          <td>Remakrs</td>
          <td>None</td>
        </tr>
        <tr>
          <td>Parking fee</td>
          <td>20</td>
        </tr>
        <tr>
          <td>Status</td>
          <td>Vehicle in</td>
        </tr>
      </tbody>
    </table>

    <!-- <div class="input-sections">
      <div class="input-group">
        <label for="">Remarks</label>
        <textarea class="form-control" aria-label="With textarea"></textarea>
      </div>
      <div class="input-group mb-3">
        <label for="">Parking charge</label>
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
      </div>
      <div class="input-group mb-3">
        <label for="">Status</label>
        <select class="form-select" id="inputGroupSelect01">
          <option selected><i class="fas fa-chevron-down"></i></option>
          <option value="1">Outgoing vehicle</option>
          <option value="2">VIP guest</option>
        </select>
      </div>
    </div>
    <div class="button-sbmt">
      <button class="btn btn-outline-primary mx-auto" type="button" id="button-addon2">Update</button>
    </div> -->
  </div>
  
  


  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>

</body>
</html>