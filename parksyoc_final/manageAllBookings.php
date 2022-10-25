<?php

require_once './db/pdo.php';

// $statement = $pdo->query("SELECT * FROM add_vehicle");


$search = $_GET['search'] ?? '';
if($search){
  $statement = $pdo->prepare("SELECT * FROM add_vehicle WHERE ownr_name LIKE :owner_name ORDER BY time_in DESC");
  $statement->bindValue(':owner_name', "%$search%");
} else {
  $statement = $pdo->prepare("SELECT * FROM add_vehicle ORDER BY time_in DESC");
}

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
  <!-- DATA TABLES CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
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

  <div class="jumbutron-section mb-5">
    <div class="mt-3 p-3 bg-success text-white rounded">
      <h1>Manage all bookings</h1>
      <p>Here are the history or all of the data of the bookings.</p>
      <p>Dashboard / Vehicle bookings / Manage all bookings</p>
    </div>
  </div>

  <!-- Search vehicles -->
  <!-- <form action="">
    <div class="container">
      <div class="row">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Owner name"  name="search" value="<?php echo $search ?>">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </div>
    </div>
  </form> -->
  
  
  
  <!-- Manage vehicle section -->
  <div class="container-fluid">
    <table id="datatableid" class="table table-hover">
      <thead>
        <tr>
          <th scope="col">S.no#</th>
          <th scope="col">Fullname</th>
          <th scope="col">Vehicle type</th>
          <th scope="col">Plate no#</th>
          <th scope="col">Contact no#</th>
          <th scope="col">Membership date</th>
          <th scope="col">Messages</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Jeremy Opriasa</td>
            <td>4 wheel car</td>
            <td>O14 B3M</td>
            <td>09552324478</td>
            <td>August 15, 2022</td>
            <td>Pa-park po</td>
            <td>
              <a href="" class="btn btn-sm btn-outline-success">Confirm</a>
              <button class="btn btn-sm btn-outline-danger">Cancel</button>
            </td>
          </tr>
      </tbody>
    </table>
  </div>


  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->
  



  <!-- local JS / jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./main.js"></script>

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  


</body>
</html>