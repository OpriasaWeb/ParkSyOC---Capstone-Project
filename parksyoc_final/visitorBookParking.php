<?php 
session_start();
require_once './db/pdo.php';



$statement = $pdo->query("SELECT * FROM membership");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['book'])){
  $fname = $_POST['fname'];
  $cstmr = $_POST['cstmr'];
  $vhcl_type = $_POST['vhcl_type'];
  $user_email = $_POST['email_user'];
  $plt_no = $_POST['plt_no'];
  $cntct_no = $_POST['cntct_no'];
  $booking_date = $_POST['booking_date'];
  $booking_time = $_POST['booking_time'];

  $statement2 = $pdo->prepare("INSERT INTO add_vehicle (ownr_name, cstmr_type, vhcl_type, email, plate_no, cntct_no, bkng_dt, bkng_time)
  VALUES (:ownr_name, :cstmr_type, :vhcl_type, :email, :plate_no, :cntct_no, :bkng_dt, :bkng_time)");

  $statement2->bindValue(':ownr_name', $fname);
  $statement2->bindValue(':cstmr_type', $cstmr);
  $statement2->bindValue(':vhcl_type', $vhcl_type);
  $statement2->bindValue(':email', $user_email);
  $statement2->bindValue(':plate_no', $plt_no);
  $statement2->bindValue(':cntct_no', $cntct_no);
  $statement2->bindValue(':bkng_dt', $booking_date);
  $statement2->bindValue(':bkng_time', $booking_time);
  $statement2->execute();
  header('Location:newBooking.php');

  if($statement){
    $_SESSION['message'] = "Book successfully!";
    header('Location:./newBooking.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Failed to book. Please try again.";
    header('Location:./newBooking.php');
    exit(0);
  }
}


$randomId = function($idno){
  $loopChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';

  for($i = 0; $i < $idno; $i++){
    $index = rand(0, strlen($loopChars) - 1);
    $str .= $loopChars[$index];
  }
  return $str;
}

// <?php echo $rows2['cstmr_type']; 

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
  <title>ParkSyOC - book vehicle</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <!-- Jumbotron section -->
  <div class="mt-4 p-3 bg-success text-white rounded">
    <h1>Book vehicle section</h1>
    <p>This is where the users can register and get the appointment receipt and since the admin has the authority to the system, the admin itself can also add and manage the membership parksyoc.</p>
    <p>Dashboard / Vehicle bookings / Book vehicle</p>
  </div>


  <section class="member-forms">
    <div class="container mt-3">

      <h3>You can start here</h3>

      <form action="" method="POST">
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="fname" 
          value="" required>
          <label for="floatingPassword">Fullname</label>
        </div>
        <div class="form-floating mb-2">
          <select class="form-select" id="floatingPassword" name="vhcl_type" required>
            <option value="1"><p style="opacity: 50%;">Choose...</p></option>
            <?php
              $statement3 = $pdo->query("SELECT class_name FROM vehicle_class");
              while($rows = $statement3->fetch(PDO::FETCH_ASSOC))
              {
            ?>
              <option value="<?php echo $rows['class_name'] ?>"><?php echo $rows['class_name'] ?></option>
            <?php 
              }
            ?>
          </select>
          <label for="floatingPassword">Vehicle type</label>
        </div>
        <!-- Customer type -->
        <div class="radio-button">
          <h5>What type of customer are you?</h5>
          <button class="btn btn-sm btn-outline-success">Learn more.</button> *modal
          <div class="row">
            <div class="col-3 m-2">
            </div>
            <div class="col-9 mb-3">
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="cstmr" id="cstmr1" autocomplete="off" value="Member" onclick="paymentReminder(0)" required disabled>
                <label class="btn btn-outline-primary" for="cstmr1">Member</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr2" autocomplete="off" value="Hospital" onclick="paymentReminder(1)" required>
                <label class="btn btn-outline-primary" for="cstmr2">Hospital</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr3" autocomplete="off" value="Visitor" onclick="paymentReminder(2)" required>
                <label class="btn btn-outline-primary" for="cstmr3">Visitor</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr4" autocomplete="off" value="VIP" onclick="paymentReminder(3)" required>
                <label class="btn btn-outline-primary" for="cstmr4">VIP</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group mb-2" id="paymentReminder">
            <label for="usr" class="fs-5">A <b>20</b> pesos fee before entering parking.</label>
        </div>
        <!-- Customer type -->
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="plt_no" value="">
          <label for="floatingPassword">Plate number</label>
        </div>
        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingPassword" name="email_user" value="" required>
          <label for="floatingPassword">Email</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cntct_no" value="">
          <label for="floatingPassword">Contact no#</label>
        </div>
        <!-- <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cstmr_type" value=">
          <label for="floatingPassword">Customer type</label>
        </div> -->
        <div class="form-floating mb-2">
          <input type="date" name="booking_date" id="dateControl" class="form-control datepicker" autocomplete="off" required>
          <label for="">Book date</label>
        </div>
        

        <!-- <div class="form-floating mb-2">
          <input type="date" id="datepicker" class="form-control" id="floatingPassword"  name="booking_date">
          <label for="floatingPassword">Booking date</label>
        </div> -->


        <div class="form-floating mb-2">
          <input type="time" class="form-control" id="timepicker1" name="booking_time" required>
          <label for="floatingPassword">Booking time</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="messages" value="">
          <label for="floatingPassword">Messages</label>
        </div>
        <div class="container text-center">
          <button type="submit" name="book" class="btn btn-outline-primary">Book!</button>
          <a href="" class="btn btn-outline-danger">Cancel</a>
        </div>
      </form>
      
        
      
      
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
          <form action="./bookVehicle.php" method="GET">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="membershipId" value="">
                <label for="floatingInput">ID membership</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" value="" name="member" class="btn btn-primary">Member!</button>
              <a href="./visitorBookParking.php" class="btn btn-secondary">Visitor</a>
            </div>
          </form>
          
      </div>
    </div>
  </div>





  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>






  
  <!-- local JS / jQuery -->

  <script src="./js//datePicker.js"></script>
  <script src="./js//main.js"></script>

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>


</html>