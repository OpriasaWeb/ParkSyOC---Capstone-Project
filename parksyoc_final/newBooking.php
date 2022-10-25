<?php
session_start();
require_once './db/pdo.php';

// Four wheels and motor, bike and e-Bike
// Member - Visitor
$member_count = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Member' ";
$member_fwheels = $pdo->query($member_count);
$member_fwheels->execute();
$rows_fwheels_member = $member_fwheels->fetchColumn();

$employee_count = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Employee' ";
$employee_fwheels = $pdo->query($employee_count);
$employee_fwheels->execute();
$rows_fwheels_employee = $employee_fwheels->fetchColumn();

$student_count = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Student' ";
$student_fwheels = $pdo->query($student_count);
$student_fwheels->execute();
$rows_fwheels_student = $student_fwheels->fetchColumn();

$visitor_count = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Visitor' ";
$visitor_fwheels = $pdo->query($visitor_count);
$visitor_fwheels->execute();
$rows_fwheels_visitor = $visitor_fwheels->fetchColumn();

$four_wheels_primary = $rows_fwheels_member + $rows_fwheels_employee + $rows_fwheels_student + $rows_fwheels_visitor;

// $total_fwheels = $pdo->query($four_wheels);
// $total_fwheels->execute();
// $rows_fwheels = $total_fwheels->fetchColumn();


// Member - Hospital
$four_wheels_h = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = '4 wheel vehicle' AND cstmr_type = 'Hospital' ";
$total_fwheels_h = $pdo->query($four_wheels_h);
$total_fwheels_h->execute();
$rows_fwheels_h = $total_fwheels_h->fetchColumn();



// Two-Three wheels
$motorWheels = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = 'Motor' ";
$total_mwheels = $pdo->query($motorWheels);
$total_mwheels->execute();
$rows_mwheels = $total_mwheels->fetchColumn();

$bicycleWheels = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE() AND vhcl_type = 'Bicycle' ";
$total_bwheels = $pdo->query($bicycleWheels);
$total_bwheels->execute();
$rows_bwheels = $total_bwheels->fetchColumn();

$eBikeWheels = "SELECT COUNT(id) FROM add_vehicle WHERE booking_stts = 'completed' AND out_time = '' AND date(bkng_dt) = CURRENT_DATE()  AND vhcl_type = 'E-bike' ";
$total_eBikeWheels = $pdo->query($eBikeWheels);
$total_eBikeWheels->execute();
$rows_eBikewheels = $total_eBikeWheels->fetchColumn();

$twoThreeWheels = $rows_mwheels + $rows_bwheels + $rows_eBikewheels;


// test_input() 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$stmt = $pdo->query("SELECT * FROM add_vehicle WHERE date(bkng_dt) AND booking_stts = '' AND cstmr_stts = '' ORDER BY id ASC");
$stmt->execute();
$rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
  <title>ParkSyOC - new bookings</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-3 p-3 bg-success text-white rounded">
      <h1>New bookings</h1>
      <p>Here are the rest of the new bookings.</p>
      <p>Dashboard / Vehicle bookings / New bookings</p>
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

  <div class="container">
    <!-- <h4 class="m-5">Total of bookings tomorrow</h4> -->
    <div class="row">
      <div class="col">
        <div class="card border-dark text-center" style="width: 15rem; height: 10rem">
          <div class="card-body">
            <h5 class="card-title">Four wheels TODAY</h5>
            <div class="card-text fs-1">
              <i class="fas fa-sticky-note fs-4"></i>
              <i class="fas fa-car-alt fs-4"></i>
              <?php
                echo $four_wheels_primary . "/35";
              ?>
              <footer class="fs-5">Primary</footer>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card border-dark text-center" style="width: 15rem; height: 10rem">
          <div class="card-body">
            <h5 class="card-title">Four wheels TODAY</h5>
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
            <h5 class="card-title">Two wheels TODAY</h5>
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
  
  <div class="container">
    <div class="session-alert">
      <?php if(isset($_SESSION['message'])): ?>
        <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
      <?php 
        unset($_SESSION['message']);
        endif; 
      ?>
    </div>
  </div>
  
  <!-- Manage vehicle section -->
  <div class="container-fluid">
    

    <table id="datatableid" class="table table-hover border-dark">
      <thead>
        <tr>
          <th scope="col">S.no#</th>
          <th scope="col">Membership id</th>
          <th scope="col">Fullname</th>
          <th scope="col">Vehicle</th>
          <th scope="col">Customer</th>
          <th scope="col">Contact no#</th>
          <th scope="col">Booking date</th>
          <th scope="col">Booking time</th>
          <th scope="col">Booking status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <?php
              foreach($rows2 as $i => $row):
            ?>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
              <?php 
                if($row['mmbrshp_id']){
                  echo $row['mmbrshp_id'];
                } else{
                  echo "<div class='btn btn-sm btn-outline-secondary text-black' disabled>";
                  echo "None";
                  echo "</div>";
                }
              ?>
            </td>
            <td><?php echo $row['ownr_name'] ?></td>
            <td><?php echo $row['vhcl_type'] ?></td>
            <td>
              <?php 
                // Primary 
              if($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == '4 wheel vehicle' ){ 
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';

                // Hospital
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Hospital';
                // ---------------------------------Bicycle-------------------------------------------

                // Secondary
              } elseif($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
                // -----------------------------------Motor-----------------------------------------
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
                // -----------------------------------E-bike-----------------------------------------
              } elseif($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              }
              // echo $row['cstmr_type'] 
              ?>
            </td>
            
            <td><?php echo $row['cntct_no'] ?></td>
            <td><?php echo $row['bkng_dt'] ?></td>
            <td>
              <?php 
                if($row['bkng_time'] < 12){
                  echo $row['bkng_time'] . ' AM';
                } elseif($row['bkng_time'] >= 12){
                  echo $row['bkng_time'] . ' PM';
                }
                 
              ?>
            </td>
            <td>
              <?php 
                if($row['booking_stts'] == ''){
                  echo "<div class='btn btn-sm btn-warning'>";
                  echo "<b>";
                  echo "pending";
                  echo "</b>";
                  echo "</div>";
                } else{
                  echo $row['booking_status'];
                }
                
              ?>
            </td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./updateNewBooking.php?<?php echo "bookingId=" . $row['id'] ?>" name="confirm" class="btn btn-sm btn-outline-primary">Update</a>
                <a href="./cancelBookings.php?<?php echo "cancelId=" . $row['id'] ?>" name="delete" class="btn btn-sm btn-outline-danger">Cancel</a>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <?php include_once "./views/modal.php"; ?>


  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->
  



  <!-- local JS / jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/dataTables.js"></script>

  <!-- Boxicons -->
  <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  


</body>
</html>