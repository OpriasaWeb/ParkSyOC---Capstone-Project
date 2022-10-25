<?php
session_start();



require_once "./db/pdo.php";

if(isset($_GET['member'])){
  $member_id = $_GET['membershipId'];
  $statement = $pdo->query("SELECT mmbrshp_id FROM membership");
  $statement->execute();
  $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
}

function rowCount($pdo, $query){
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  return $stmt->rowCount();
}

// -------------------------------------------------------------------------------------------- //

// Today's vehicle in
$ttl_vehicle = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' ";
$total_vehicle = $pdo->query($ttl_vehicle);
$total_vehicle->execute();
$rows_vehicle = $total_vehicle->fetchColumn();


// Primary
// Vehicle-in VISITOR
$visitor = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Visitor' ";
$total_visitors = $pdo->query($visitor);
$total_visitors->execute();
$rows_visitors = $total_visitors->fetchColumn();

// Vehicle-in Employee
$employee = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Employee' ";
$total_employee = $pdo->query($employee);
$total_employee->execute();
$rows_employee = $total_employee->fetchColumn();

// Vehicle-in Members
$member = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Member' ";
$total_member = $pdo->query($member);
$total_member->execute();
$rows_member = $total_member->fetchColumn();

// Vehicle-in Student
$student = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Student' ";
$total_student = $pdo->query($student);
$total_student->execute();
$rows_student = $total_student->fetchColumn();

$total_in = $rows_visitors + $rows_employee + $rows_member + $rows_student;

// -------------------------------------------------------------------------------------------- //

// Hospital
// Vehicle-in HOSPITAL
$four_wheels_h = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Hospital' ";
$total_fwheels_h = $pdo->query($four_wheels_h);
$total_fwheels_h->execute();
$rows_fwheels_h = $total_fwheels_h->fetchColumn();

// Secondary
$motorWheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = 'Motor' ";
$total_mwheels = $pdo->query($motorWheels);
$total_mwheels->execute();
$rows_mwheels = $total_mwheels->fetchColumn();

$bicycleWheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = 'Bicycle' ";
$total_bwheels = $pdo->query($bicycleWheels);
$total_bwheels->execute();
$rows_bwheels = $total_bwheels->fetchColumn();

$eBikeWheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = 'E-bike' ";
$total_eBikeWheels = $pdo->query($eBikeWheels);
$total_eBikeWheels->execute();
$rows_eBikewheels = $total_eBikeWheels->fetchColumn();

$twoThreeWheels = $rows_mwheels + $rows_bwheels + $rows_eBikewheels;
// Today's vehicle in

// ----------------------------------------------------------------------------------- // 

// Today's booking
$ttl_bookings = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND booking_stts = 'completed' ";
$total_bookings = $pdo->query($ttl_bookings);
$total_bookings->execute();
$rows_bookings = $total_bookings->fetchColumn();

// Booking - VISITOR
$booking_visitors = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Visitor' ";
$visitors_booking = $pdo->query($booking_visitors);
$visitors_booking->execute();
$rows_bookings_visitors = $visitors_booking->fetchColumn();

// Booking - Member
$bookings_member = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Member' ";
$total_bookings_member = $pdo->query($bookings_member);
$total_bookings_member->execute();
$rows_bookings_member = $total_bookings_member->fetchColumn();

// Booking - Employee
$bookings_employee = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Employee' ";
$total_bookings_employee = $pdo->query($bookings_employee);
$total_bookings_employee->execute();
$rows_bookings_employee = $total_bookings_employee->fetchColumn();

// Booking - Student
$ttl_bookings_students = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Student' ";
$total_bookings_students = $pdo->query($ttl_bookings_students);
$total_bookings_students->execute();
$rows_bookings_students = $total_bookings_students->fetchColumn();

$confirmed_bookings = $rows_bookings_visitors + $rows_bookings_member + $rows_bookings_employee + $rows_bookings_students;

// -------------------------------------------------------------------------------------------- //

// Booking - HOSPITAL
$ttl_bookings_fwheels_h = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Hospital' ";
$total_bookings_fwheels_h = $pdo->query($ttl_bookings_fwheels_h);
$total_bookings_fwheels_h->execute();
$rows_bookings_fwheels_h = $total_bookings_fwheels_h->fetchColumn();

// Booking - Secondary
$ttl_bookings_mwheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = 'Motor' ";
$total_bookings_mwheels = $pdo->query($ttl_bookings_mwheels);
$total_bookings_mwheels->execute();
$rows_bookings_mwheels = $total_bookings_mwheels->fetchColumn();

$ttl_bookings_bwheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = 'Bicycle' ";
$total_bookings_bwheels = $pdo->query($ttl_bookings_bwheels);
$total_bookings_bwheels->execute();
$rows_bookings_bwheels = $total_bookings_bwheels->fetchColumn();

$ttl_bookings_ebwheels = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND out_time = '' AND booking_stts = 'completed' AND vhcl_type = 'E-bike' ";
$total_bookings_ebwheels = $pdo->query($ttl_bookings_ebwheels);
$total_bookings_ebwheels->execute();
$rows_bookings_ebwheels = $total_bookings_ebwheels->fetchColumn();

$total_twoThreeVehicles = $rows_bookings_mwheels + $rows_bookings_bwheels + $rows_bookings_ebwheels;

// Today's booking

// ----------------------------------------------------------------------------------- // 

// Available parking

// Visitor
// $add_fvehicles = $confirmed_bookings;
$availableParkingFirstWheels = 35 - $confirmed_bookings;

// Hospital - 27
// $add_vehicles_h = $rows_bookings_fwheels_h;
$availableParkingHospital = 27 - $rows_bookings_fwheels_h;


// Motor, Bike, E-bike
// $add_ttVehicles = $twoThreeWheels;
$availableParkingSecWheels = 50 - $total_twoThreeVehicles;




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
  <link rel="stylesheet" href="./public/index.css">
  <title>ParkSyOC</title>
</head>
<body>
  <!-- Jumbotron section -->



  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fas fa-parking"></i>arkSyOC</a>
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
              <a class="btn btn-outline-secondary" href="./policy.php">Membership</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="./parkingGuide.php">Parking guide</a>
            </li> -->
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

  <!-- Carousel images -->
  <div class="container" id="carousel">
    <h2 class="text-center">Hi, welcome to ParkSyOC</h2>
    <p class="fs-6 text-center">ParkSyOC are made by the IT students in Olivarez College relating to their capstone subject.</p>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./images/parking1.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking10.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking11.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking12.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking13.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/motor1.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/motor2.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/bicycle.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <!-- <div class="carousel-item">
          <img src="./images/parking14.jpg" class="d-block w-100 rounded" id="image">
        </div> -->
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  


  

  <!-- <div class="container-fluid mt-2 text-center">
    <div class="row">
      <div class="col">
        <h2><b><?php echo $rows_vehicle ?>/122</b></h2>
        <h6>Today's vehicle-in</h6>
      </div>
      <div class="col">
        <h2><b><?php echo $rows_fwheels ?>/72</b></h2>
        <h6>Four wheels </b></h6>
      </div>
      <div class="col">
        <h2><b><?php echo $twoThreeWheels ?>/50</b></h2>
        <h6>Motor, E-bike and bicycle </b></h6>
      </div>
    </div>
  </div>

  <div class="container mt-2 text-center">
    <div class="row">
      <div class="col">
        <h2><b><?php echo $rows_bookings ?></b></h2>
        <h6>Today's booking</h6>
      </div>
      <div class="col">
        <h2><b><?php echo $rows_bookings_fwheels ?></b></h2>
        <h6>Today's booking - 4 wheels </b></h6>
      </div>
      <div class="col">
        <h2><b><?php echo $total_twoThreeVehicles ?></b></h2>
        <h6>Today's booking - 2-3 wheels </b></h6>
      </div>
    </div>
  </div> -->

  

  <div class="container mt-3 text-center">
    <h4>Available parking today</h4>
    <div class="row">
      <div class="col btn-outline-success rounded">
        <h2 id="remaining"><b><?php echo $availableParkingFirstWheels . "" ?></b></h2>
        <h6>Primary vehicle parking</h6>
      </div>
      <div class="col btn-outline-success rounded">
        <h2 id="remaining"><b><?php echo $availableParkingHospital . "" ?></b></h2>
        <h6>Hospital vehicle parking</h6>
      </div>
      <div class="col btn-outline-success rounded">
        <h2 id="remaininggg"><b><?php echo $availableParkingSecWheels . "" ?></b></h2>
        <h6>Secondary vehicle parking</h6>
      </div>
    </div>
  </div>

  

  <!-- Main 1 -->
  

  <!-- Countdown membership expiration -->
  <div class="container-fluid mt-5 membership-exp text-center bg-success text-white rounded">
    <p class="fs-3">Next school year 2022-2023</p>
    <p class="fs-5">August 15, 2022</p>
    <div class="">
      <div class="row m-4">
        <div class="col-3">
          <h2 class="fw-bold mb-0" id="days">0</h2>
          <h5 class="fs-6">days</h5>
        </div>
        <div class="col-3">
        <h2 class="fw-bold mb-0" id="hours">0</h2>
          <h5 class="fs-6">hrs</h5>
        </div>
        <div class="col-3">
        <h2 class="fw-bold mb-0" id="minutes">0</h2>
          <h5 class="fs-6">mnts</h5>
        </div>
        <div class="col-3">
          <h2 class="fw-bold mb-0" id="seconds">0</h2>
          <h5 class="fs-6">scnds</h5>
        </div>
      </div>
    </div>
  </div>

  <section class="text-center fs-6 mb-3 bg-light rounded" id="rules">
    <div class="Ocmanagement m-3">
      <h5>Olivarez College management will not be responsible for any loss or damage that may happen to your vehicle. For security and safety of your vehicle, please observe the following:</h5>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>1.</b> Parking hours - 5:00am to 11:00pm., Monday to Sunday. The use of pay parking facilities is conditioned on the observance of the rules and regulations of the Olivarez College Management.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>2.</b> Please secure and lock your own vehicle before you leave it in parking.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>3.</b> Do not leave your parking ticket and valuables inside your vehicle.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>4. NO OVERNIGHT PARKING. </b> Vehicles left in the parking area for more than 24 hours will be automatically towed and turned over to the authorities. You will be required to present documents required in No. 7 before the release of the vehicle.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>5.</b> You will waive your claim against the management for any incident of robbery, abduction, physical injury or death while inside the parking area.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>6.</b> Olivarez College management is free from any liability related to seizure of the vehicle or its forced opening by virtue of an Order from Courts or other government authorities.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>7. NO PARKING TICKET, NO EXIT.</b> In case you losem or deface or mutilate any portion of your parking ticket, you will be required to present the vehicle's original Certificate of Registration with a copy of latest Official Receipt, valid identification card and shall pay the administrative fine of 500 pesos.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>8.</b> Any damages to Olivarez College facilities or other parked vehicles intentionally or negligently caused or attributable shall be subject to criminal or administrative fine.
        </div>
      </div>
    </div>
  </section>

  <section>
    
  </section>

  <section class="text-center fs-6 mb-3 bg-light rounded" id="rules">
    <div class="Ocmanagement m-3">
      <h5>ParkSyOC rules for the rest of the system:</h5>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>1.</b> Booking is available for <b>24 hours</b>
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>2.</b> You can only book today, tomorrow and the day after tomorrow.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>3.</b> The priority in confirmation of bookings is <b>morning(am)</b> schedule so the confirmation of the <b>afternoon(pm) and evening(pm)</b> is depends in the movement of vehicles in the morning parking.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>4.</b> The admin will let you know if your booking date and time is cancel maybe the vehicle is full on that time and for some other reasons. The admin will keep you update.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>5.</b> STRICTLY no EMAIL of confirmation of booking NO PARKING.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>6.</b> STRICTLY no EMAIL of confirmation of membership appointment NO sticker ID transaction.
        </div>
      </div>
    </div>
    <div class="container mb-3 m-auto">
      <div class="row">
        <div class="col">
          <b>7.</b> All of your basic information for sticker membership and bookings will be treated as confidential data.
        </div>
      </div>
    </div>
    
  </section>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Member or visitor?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5>If member, input your ID membership here</h5>
          <form action="./memberBookParking.php" method="GET">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="membershipId" value="">
              <label for="floatingInput">ID membership</label>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" value="" name="" class="btn btn-primary">Member!</button>
          <a href="./userBookVehicle.php" class="btn btn-secondary">Non-member</a>
          
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- <div class="container-fluid">
    <h4>asdsae</h4>
    <?php
      echo rowCount($pdo, "SELECT * FROM add_vehicle WHERE cstmr_type = 'Member' AND date(time_in) = CURRENT_DATE() AND cstmr_stts = 'In' ");
    ?>
  </div> -->


  




  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->


  <!-- local JS / jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="./js/countdown.js"></script>

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- BOXICONS -->
  <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
  
</body>
</html>