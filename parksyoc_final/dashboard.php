<!-- PHP SERVER -->
<?php

require_once './db/pdo.php';
session_start();

if($_SESSION['username']){
  echo "<div class='fs-3' >";
  echo "Good day and welcome, " . $_SESSION['username'];
  echo "</div>";
} else{
  header('Location:login.php');
}




// if(isset($_SESSION["username"])){
//   header("Location:login.php");
// }


// if(!isset($_SESSION['email'])){
//   header('Location:login.php');
// }

function rowCount($pdo, $query){
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  return $stmt->rowCount();
}


date_default_timezone_set('Asia/Manila');
echo "<span style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a  ');

// Four wheels and motor, bike and e-Bike
// Member - Visitor
$fwheels_member = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Member' ";
$member_fwheels = $pdo->query($fwheels_member);
$member_fwheels->execute();
$rows_members = $member_fwheels->fetchColumn();

$fwheels_visitor = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Visitor' ";
$visitor_fwheels = $pdo->query($fwheels_visitor);
$visitor_fwheels->execute();
$rows_visitor = $visitor_fwheels->fetchColumn();

$fwheels_employee = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Employee' ";
$employee_fwheels = $pdo->query($fwheels_employee);
$employee_fwheels->execute();
$rows_employee = $employee_fwheels->fetchColumn();

$fwheels_student = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Student' ";
$student_fwheels = $pdo->query($fwheels_student);
$student_fwheels->execute();
$rows_student = $student_fwheels->fetchColumn();

$primary = $rows_members + $rows_visitor + $rows_employee + $rows_student;

// Member - Hospital
$four_wheels_h = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) AND cstmr_stts = 'In' AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Hospital' ";
$total_fwheels_h = $pdo->query($four_wheels_h);
$total_fwheels_h->execute();
$rows_fwheels_h = $total_fwheels_h->fetchColumn();

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



// Overall count
$sql = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in)";
$total = $pdo->query($sql);
$total->execute();
$rows = $total->fetchColumn();

// Parking vehicles
$sql_today = "SELECT COUNT(id) FROM add_vehicle WHERE cstmr_stts = 'In' AND date(time_in) ";
$today = $pdo->query($sql_today);
$today->execute();
$rows_today = $today->fetchColumn();

$sql_out = "SELECT COUNT(id) FROM add_vehicle WHERE date(out_time) = CURRENT_DATE() AND cstmr_stts = 'Out' " ;
$today_out = $pdo->query($sql_out);
$today_out->execute();
$rows_out = $today_out->fetchColumn();

$sql_ystrdy = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) = CURRENT_DATE() - 1";
$yesterday = $pdo->query($sql_ystrdy);
$yesterday->execute();
$rows_ystrdy = $yesterday->fetchColumn();

$sql_lstwk = "SELECT COUNT(id) FROM add_vehicle WHERE date(time_in) = CURRENT_DATE() - 7";
$last_week = $pdo->query($sql_lstwk);
$last_week->execute();
$rows_lstwk = $last_week->fetchColumn();


// Memberships ParkSyOC
$sql_members = "SELECT COUNT(id) FROM membership WHERE mmbr_stts = 'completed' ";
$members = $pdo->query($sql_members);
$members->execute();
$rows_members = $members->fetchColumn();

$appntmnt_members = "SELECT COUNT(id) FROM membership WHERE date(appntmnt_date) = CURRENT_DATE() AND sticker = ''   ";
$members_appntmnt = $pdo->query($appntmnt_members);
$members_appntmnt->execute();
$rows_members_appntmnt = $members_appntmnt->fetchColumn();

$sql_mmbrs_pndng = "SELECT COUNT(id) FROM membership WHERE mmbr_stts = '' ";
$members_pndng = $pdo->query($sql_mmbrs_pndng);
$members_pndng->execute();
$rows_mmbrs_pndng = $members_pndng->fetchColumn();

// Bookings ParkSyOC
$sql_bookings = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND booking_stts = 'completed' ";
$bookings = $pdo->query($sql_bookings);
$bookings->execute();
$rows_booking = $bookings->fetchColumn();

$pending_bookings = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND booking_stts = '' AND cstmr_stts = '' ";
$pndng_bookings = $pdo->query($pending_bookings);
$pndng_bookings->execute();
$rows_booking_pndng = $pndng_bookings->fetchColumn();

$tom_bookings = "SELECT COUNT(id) FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() + 1 AND booking_stts = 'completed' ";
$bookings_tom = $pdo->query($tom_bookings);
$bookings_tom->execute();
$rows_bookings_tom = $bookings_tom->fetchColumn();

$pndng_bookings = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = '' ";
$bookings_pndng = $pdo->query($pndng_bookings);
$bookings_pndng->execute();
$rows_all_pndng = $bookings_pndng->fetchColumn();


// if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
//   header('HTTP/1.0 403 Forbidden', TRUE, 403);
//   die(header('Location:error.php'));
// }



?>
<!-- FRONT END -->


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
  <!-- BOOTSTRAP ICONS cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <script type="text/javascript">
    function preventBack(){
      window.history.forward()
    };
    setTimeout("preventBack()", 0);
    window.onunload=function(){
      null;
    }
  </script>

  <!-- Auto refresh -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - Dashboard</title>
</head>
<body>
  
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->



  <!-- Four wheels / motor, bike, e-bike -->
  <div class="count-parking">
    <div class="container text-center">
      <div class="row mt-5">
        <div class="col">
          <div class="card border-dark text-center" style="width: 15rem; height: 10rem">
            <div class="card-body">
              <h5 class="card-title">Four wheels IN today</h5>
              <div class="card-text fs-1">
                <i class="fas fa-sticky-note fs-4"></i>
                <i class="fas fa-car-alt fs-4"></i>
                <?php
                  echo $primary . "/35";
                ?>
                <footer class="fs-5">Primary</footer>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-dark text-center" style="width: 15rem; height: 10rem">
            <div class="card-body">
              <h5 class="card-title">Four wheels IN today</h5>
              <div class="card-text fs-1">
                <i class="fas fa-hospital-user fs-4"></i>
                <i class="fas fa-car-alt fs-4"></i>
                <?php
                  echo $rows_fwheels_h . "/27";
                ?>
                <footer class="fs-5">Hospital</footer>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-dark text-center" style="width: 15rem; height: 10rem">
            <div class="card-body">
              <h5 class="card-title">Two wheels IN today</h5>
              <div class="card-text fs-1">
                <i class="fas fa-motorcycle fs-4"></i>
                <i class="fas fa-bicycle fs-4"></i>
                <?php
                  echo $twoThreeWheels . "/50";
                ?>
                <footer class="fs-5">Secondary</footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Four wheels / motor, bike, e-bike -->


  <!-- Modal body of the dashboard -->
  <div class="count-parking">
    <div class="container-fluid text-center">
      <div class="row m-5">
        <div class="col">
          <div class="card border-warning text-center" style="width: 20rem; height: 7rem">
            <div class="card-body">
              <h5>Total <b>currently parked</b> on today</h5>
              <div class="card-text fs-1">
                <i class="bi bi-box-arrow-in-right"></i>
                <?php
                  echo "  " . $rows_today . "/112";
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-warning text-center" style="width: 20rem; height: 7rem">
            <div class="card-body">
              <h5>Total of <b>outgoing</b> vehicles today</h5>
              <div class="card-text fs-1">
                <i class="bi bi-box-arrow-left"></i>
                <?php
                  echo "  " . $rows_out;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-warning text-center" style="width: 20rem; height: 7rem">
            <div class="card-body">
              <h5>Total vehicle entries <b>yesterday</b></h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_ystrdy;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-warning text-center" style="width: 20rem; height: 7rem">
            <div class="card-body">
              <h5><b>Total</b> vehicle entries</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal body of the dashboard -->

  
  
  
  
  <!-- Book and membership details -->
  <div class="reserve-parking">
    <div class="container-fluid text-center">
      <div class="row m-5">
        <div class="col">
          <div class="card border-primary text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of bookings today</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_booking;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-primary text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of pending bookings scheduled today</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_booking_pndng;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-primary text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of bookings tomorrow</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_bookings_tom;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-primary text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of pending bookings</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_all_pndng;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Book and membership details -->



  <!-- Customer types -->
  <!-- <div class="customer-types mb-3">
    <div class="container-fluid">
      <div class="row m-4">
        <div class="col-3">
          <h2 class="fw-bold mb-0">
            <i class="fas fa-sticky-note green"></i>
            <?php
              echo rowCount($pdo, "SELECT * FROM add_vehicle WHERE cstmr_type = 'Member' AND date(time_in) = CURRENT_DATE() AND cstmr_stts = 'In' ") . "/45";
              
            ?>
          </h2>
          <h5>Total of <b>members/visitor</b> who parked today</h5>
        </div>
        <div class="col-3">  
          <h2 class="fw-bold mb-0">
            <i class="fas fa-hospital-user pink"></i>
            <?php
              echo rowCount($pdo, "SELECT * FROM add_vehicle WHERE cstmr_type = 'Hospital' AND date(time_in) = CURRENT_DATE() AND cstmr_stts = 'In' ") . "/27";
            ?>
          </h2>
          <h5>Total of <b>hospital category</b> who parked today</h5>
        </div>
        <div class="col-3">
          <h2 class="fw-bold mb-0">
            <i class="far fa-address-card violet"></i>
            <?php
              echo rowCount($pdo, "SELECT * FROM add_vehicle WHERE cstmr_type = 'Guest' AND date(time_in) = CURRENT_DATE() AND cstmr_stts = 'In' ");
              
            ?>
          </h2>
          <h5>Total of <b>visitors</b> today</h5>
        </div>
        <div class="col-3">
          <h2 class="fw-bold mb-0">
            <i class="fas fa-user-tie blue"></i>
            <?php
              echo rowCount($pdo, "SELECT * FROM add_vehicle WHERE cstmr_type = 'VIP' AND date(time_in) = CURRENT_DATE() AND cstmr_stts = 'In' ");
            
            ?>
          </h2>
          <h5>Total of <b>VIP</b> who used parking today</h5>
        </div>
      </div>
    </div>
  </div> -->
  <!-- Customer types -->
  

  
  

  
  

  <!-- Membership -->
  <div class="membership">
    <div class="container text-center">
      <div class="row m-5">
        <div class="col">
          <div class="card border-danger text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of members</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_members;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-danger text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of appointment for sticker today</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_members_appntmnt;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card border-danger text-center" style="width: 20rem; height: 8rem">
            <div class="card-body">
              <h5>Total of pending in membership application</h5>
              <div class="card-text fs-1">
                <?php
                  echo $rows_mmbrs_pndng;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Membership -->

  <!-- Membership expirations -->
  <div class="container mt-5 membership-exp text-center bg-success text-white rounded">
    <p class="fs-3">Next school year 2022-2023</p>
    <p class="fs-5">August 15, 2022</p>
    <div class="container-fluid">
      <div class="row m-4">
        <div class="col-3">
          <h2 class="fw-bold mb-0" id="days">0</h2>
          <h5>days</h5>
        </div>
        <div class="col-3">  
        <h2 class="fw-bold mb-0" id="hours">0</h2>
          <h5>hours</h5>
        </div>
        <div class="col-3">
        <h2 class="fw-bold mb-0" id="minutes">0</h2>
          <h5>minutes</h5>
        </div>
        <div class="col-3">
          <h2 class="fw-bold mb-0" id="seconds">0</h2>
          <h5>seconds</h5>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <?php include_once "./views/modal.php"; ?>


  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>

  <script type="text/javascript">


    // Auto-refresh website
    window.setInterval('refresh()', 20000); // Call a function every 10000 miliseconds

    // Refresh or reload the page
    function refresh(){
      window.location.reload();
    }
      
  </script>




  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./js/countdown.js"></script>

</body>
</html>