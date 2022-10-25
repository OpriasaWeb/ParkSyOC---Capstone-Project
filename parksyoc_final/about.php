

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
  <link rel="stylesheet" href="./public/users.css">
  <title>ParkSyOC - about page</title>
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
      <div class="col-md-6 text-center">
        <h2 class="mt-5">ABOUT</h2>
        <i class="fa-solid fa-a"></i>
        <p class="mt-5 about-text" id="about-text">The <b>ParkSyOC: Development of Digital Conventional Vehicle Parking System in Olivarez College - Parañaque Campus</b> is the title of the study chosen by the researchers lead by <b>Jeremy D. Opriasa</b>, and two members which are <b>John Philip R. Malacad</b> and <b>Su Jin Lee</b>. The study which the researchers are tackling is about the parking in the institution which is the Olivarez College parking. The main goal of this study is to improve the manual parking system to digital, to have a future bookings, provide solutions to the problems experiencing by the customers and to control the flow of the vehicles through information from the dashboard, so the system will bring more satisfaction to the users.</p>
      </div>
      <div class="col-md-6">
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



