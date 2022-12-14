<?php

session_start();
require_once './db/pdo.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $mssg_name = $_POST['mssg_name'];
  $mssg_email = $_POST['mssg_email'];
  $mssg_subject = $_POST['mssg_subject'];
  $mssg_queries = $_POST['mssg_queries'];

  $statement = $pdo->prepare("INSERT INTO messages (mssg_name, mssg_email, mssg_subject, mssg_queries) VALUES (:mssg_name, :mssg_email, :mssg_subject, :mssg_queries)");

  $statement->bindValue(':mssg_name', $mssg_name);
  $statement->bindValue(':mssg_email', $mssg_email);
  $statement->bindValue(':mssg_subject', $mssg_subject);
  $statement->bindValue(':mssg_queries', $mssg_queries);
  $statement->execute();

  header('Location:contactSent.php');


}



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
  <!-- BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - contact page</title>
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><i class="fas fa-parking"></i>arkSyOC</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="fas fa-parking"></i>arkSyOC</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <button type="text" class="btn btn-outline-primary" data-bs-toggle="modal"  data-bs-target="#exampleModal">
                Book parking
              </button>
            </li>
            <li class="nav-item text-light mt-2">
              <a class="btn btn-outline-secondary" href="./userAddMember.php">Membership</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./contact.php">Contact</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Parking guide
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="#">Hospital parking</a></li>
                <li><a class="dropdown-item" href="#">Visitors / Members parking</a></li>
                <li><a class="dropdown-item" href="#">VIP parking</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Motor</a></li>
                <li><a class="dropdown-item" href="#">Bicycle</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="./login.php" target="_blank">Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Navigation section -->

  <div class="container">
    <div class="row">
      <div class="col-md-7 text-center">
        <h2 class="mt-5">Contact queries</h2>
        <p>Any complain, suggestion or direct message to admin. Feel free to message here.</p>
        <div class="messages text-center">
          <form action="" method="POST">
            <div class="form-floating mb-3">
              <input type="text" name="mssg_name" class="form-control" id="floatingInput" required>
              <label for="floatingInput">Fullname</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="mssg_email" class="form-control" id="floatingInput" required>
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="mssg_subject" class="form-control" id="floatingInput" required>
              <label for="floatingInput">Subject</label>
            </div>
            <div class="form-floating">
              <textarea class="form-control" name="mssg_queries" id="floatingTextarea2" style="height: 100px" required></textarea>
              <label for="floatingTextarea2">Messages:</label>
            </div>
            <button type="submit" class="btn btn-outline-primary mt-3">Submit!</button>
          </form> 
        </div>
      </div>
      <div class="col-md-5">
        <img src="./images/Parking-pana.png" alt="" class="img-fluid">
      </div>
    </div>
  </div>







  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- BOXICONS -->
  <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
  
</body>
</html>