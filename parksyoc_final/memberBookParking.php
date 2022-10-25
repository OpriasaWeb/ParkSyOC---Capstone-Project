<?php 

error_reporting(0);





session_start();
require_once './db/pdo.php';


$mmbrshp_id = $identification = $fname = $cstmr_type = $vhcl_type = $plt_no = $email = $cntct_no = $booking_date = $booking_time = "";

$bkngDateErr = $bkngTimeErr = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $identification = test_input($_POST['identification']);
  $mmbrshp_id = test_input($_POST['mmbrshp_id']);
  $fname = test_input($_POST['fname']);
  $cstmr_type = test_input($_POST['cstmr']);
  $vhcl_type = test_input($_POST['vhcl_type']);
  $plt_no = test_input($_POST['plt_no']);
  $email = test_input($_POST['email']);
  $cntct_no = test_input($_POST['cntct_no']);

  if(empty($_POST['booking_date'])){
    $bkngDateErr = "Booking date is required.";
  } else{
    $booking_date = test_input($_POST['booking_date']);
  }
  if(empty($_POST['booking_time'])){
    $bkngTimeErr = "Booking time is required.";
  } else{
    $booking_time = test_input($_POST['booking_time']);
  }
  

  $statement = $pdo->prepare("INSERT INTO add_vehicle (identification, mmbrshp_id, ownr_name, cstmr_type, vhcl_type,plate_no, email, cntct_no, bkng_dt, bkng_time) VALUES (:identification, :mmbrshp_id, :ownr_name, :cstmr_type, :vhcl_type, :plt_no, :email, :cntct_no, :booking_date, :booking_time)");


  $statement->bindValue(':identification', $identification);
  $statement->bindValue(':mmbrshp_id', $mmbrshp_id);
  $statement->bindValue(':ownr_name', $fname);
  $statement->bindValue(':cstmr_type', $cstmr_type);
  $statement->bindValue(':vhcl_type', $vhcl_type);
  $statement->bindValue(':plt_no', $plt_no);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':cntct_no', $cntct_no);
  $statement->bindValue(':booking_date', $booking_date);
  $statement->bindValue(':booking_time', $booking_time);
  $statement->execute();
  header('Location:bookingReceipt.php');

}

// Error message in case users input the wrong characters of memberships
if(empty($_GET['membershipId'])){
  $_SESSION['message'] = "Please re-input your id membership. There has to be an error there. Thank you!";
  $_SESSION['suggest_message'] = "ParkSyOC suggests not to memorize it but save it in your device so whenever you make a booking, just copy and paste it.";
}

// Form-validation PHP
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// echo '<pre>';
// var_dump($rows);
// echo '</pre>';

// SELECT all items if conditions were met
$statement2 = $pdo->prepare("SELECT * FROM membership WHERE mmbrshp_id = :mmbrshp_id");
$statement2->execute(array(
  ':mmbrshp_id' => $_GET['membershipId']
));
$rows2 = $statement2->fetch(PDO::FETCH_ASSOC);

$identification = htmlentities($rows2['identification']);
$mmbrshp_id = htmlentities($rows2['mmbrshp_id']);
$fname = htmlentities($rows2['fname']);
$vhcl_type = htmlentities($rows2['vhcl_type']);
$plt_no = htmlentities($rows2['plt_no']);
$email = htmlentities($rows2['email']);
$cntct_no = htmlentities($rows2['cntct_no']);



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
  <!-- BOOTSTRAP ICONS cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!-- Google jquery CDN for disable past dates -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function(){
      $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if(month < 10){
          month = '0' + month.toString();
        }
        if(day < 10){
          day = '0' + day.toString();
        }

        var maxDate = year + '-' + month + '-' + day;

        $('#dateControl').attr('min', maxDate);
      });
    });
  </script>

  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - Member book vehicle</title>
</head>
<body>
  <!-- Navigation bar -->

  <!-- Jumbotron section -->
  <div class="mt-4 p-3 bg-success text-white rounded">
    <h1>Member book vehicle section</h1>
    <p>This is where the users can register and get the appointment receipt and since the admin has the authority to the system, the admin itself can also add and manage the membership parksyoc.</p>
    <p>Dashboard / Vehicle bookings / Book vehicle</p>
  </div>

  <div class="goback m-5">
    <a href="./index.php" class="btn btn-secondary">Go back home</a>
  </div>

  <?php if(isset($_SESSION['suggest_message'])): ?>
    <h5 class="alert alert-success text-center"><?= $_SESSION['suggest_message']; ?></h5>
  <?php 
    unset($_SESSION['suggest_message']);
    endif; 
  ?>


  <?php if(isset($_SESSION['message'])): ?>
    <h5 class="alert alert-success text-center"><?= $_SESSION['message']; ?></h5>
  <?php 
    unset($_SESSION['message']);
    endif; 
  ?>


  <section class="member-forms">
    <div class="container">


      <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-floating mb-2">
          <!-- <input type="text" class="form-control" id="floatingPassword" name="identification"
          value="<?= $identification ?>"> -->
          <input type="hidden" name="identification" value="<?php echo $rows2['identification'] ?>">
          <img src="<?= $identification ?>" alt="" class="updateImage img-fluid m-2">
          
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="mmbrshp_id"
          value="<?= $mmbrshp_id ?>">
          <label for="floatingPassword">Membership ID</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="fname" 
          value="<?= $fname ?>" required>
          <label for="floatingPassword">Fullname</label>
        </div>

        <div class="radio-button">
          <h5>Customer type</h5>
          <div class="row">
            <div class="col-4 m-2">
            </div>
            <div class="col-8 mb-3">
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="cstmr" id="cstmr1" autocomplete="off" value="Member" onclick="paymentReminder(0)" checked>
                <label class="btn btn-outline-primary" for="cstmr1">Member</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr2" autocomplete="off" value="Hospital" onclick="paymentReminder(1)">
                <label class="btn btn-outline-primary" for="cstmr2">Hospital</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr3" autocomplete="off" value="Visitor" onclick="paymentReminder(2)" disabled>
                <label class="btn btn-outline-primary" for="cstmr3">Visitor</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="vhcl_type" 
          value="<?= $vhcl_type ?>" required>
          <label for="floatingPassword">Vehicle type</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="plt_no" value="<?= $plt_no ?>">
          <label for="floatingPassword">Plate number</label>
        </div>

        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingPassword" name="email" value="<?= $email ?>" required>
          <label for="floatingPassword">Email</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cntct_no" value="<?= $cntct_no ?>">
          <label for="floatingPassword">Contact no#</label>
        </div>

        <!-- <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cstmr_type" value=">
          <label for="floatingPassword">Customer type</label>
        </div> -->

        <div class="form-floating mb-2">
          <input type="date" name="booking_date" id="dateControl" class="form-control" autocomplete="off" required>
          <label for="">Book date</label>
          <span class="error"><?php echo $bkngDateErr ?></span>
        </div>

        <div class="form-floating mb-2">
          <input type="time" class="form-control" id="timepicker1" name="booking_time" required> 
          <label for="floatingPassword">Booking time</label>
          <span class="error"><?php echo $bkngTimeErr ?></span>
        </div>

        <div class="container text-center">
          <button type="submit" name="book" class="btn btn-outline-primary">Book!</button>
          <a href="" class="btn btn-outline-danger">Cancel</a>
        </div>
      </form>
      
        
      
      
    </div>
  </section>




  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>






  
  <!-- local JS / jQuery -->
  <script src="./js//datePicker.js"></script>


  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>