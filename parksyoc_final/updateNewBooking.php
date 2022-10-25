<?php 
session_start();
require_once './db/pdo.php';



$statement = $pdo->prepare("SELECT * FROM add_vehicle WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['bookingId']
));

$rows = $statement->fetch(PDO::FETCH_ASSOC);

$fname = htmlentities($rows['ownr_name']);
$vhcl_type = htmlentities($rows['vhcl_type']);
$plt_no = htmlentities($rows['plate_no']);
$email = htmlentities($rows['email']);
$cntct_no = htmlentities($rows['cntct_no']);
$bkng_dt = htmlentities($rows['bkng_dt']);
$bkng_tm = htmlentities($rows['bkng_time']);


if(isset($_POST['complete'])){
  $mmbr_id = $_GET['bookingId'];
  $bkng_stts = $_POST['booking_status'];

  $sql = "UPDATE add_vehicle SET booking_stts = :bkng_stts WHERE id = $mmbr_id ";

  $statement2 = $pdo->prepare($sql);
  $statement2->bindValue(':bkng_stts', $bkng_stts);
  $statement2->execute();

  header('Location:completedBookings.php');

  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = "Hi, booking is confirmed.\n Here is your booking date " . $bkng_dt . " at " . $bkng_tm . ", take care.\n NOTE: The time you have input plus 30 minutes is the duration of waiting of your booking, if you did not make it in time, the admin will delete your bookings. Thank you.";
  $sender = "From:parksyoc@gmail.com";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  if($statement){
    $_SESSION['message'] = "Confirmed booking!";
    header('Location:./newBooking.php');
    exit(0);
  } else{
      $_SESSION['message'] = "Failed to confirm the booking. Please try again.";
      header('Location:./newBooking.php');
      exit(0);
  }

  
}




// echo '<pre>';
// var_dump($rows);
// echo '</pre>';


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
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - new booking</title>
</head>
<body>
  <!-- Jumbotron section -->
  <div class="jumbutron-section mb-3">
    <div class="p-4 bg-success text-white rounded">
      <h1>Update new to complete booking</h1>
      <h5>Hi, welcome to our web system. Here you can book your schedule of parking in Olivarez College parking area.</h5>
    </div>
  </div>

  <!-- Go back button -->
  <div class="container-fluid">
    <div class="d-flex">
      <a href="./newBooking.php" class="btn btn-secondary">Go back to new booking</a>
    </div>
  </div>


  <section class="member-forms mt-5">
    <div class="container">
      <form action="" method="post" enctype="multipart/form-data">

        <?php if($rows['identification']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">Identification</label>
          <img src="<?php echo $rows['identification'] ?>" alt="" class="updateImage img-fluid m-2">
        <?php endif; ?>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Fullname</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $fname ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Vehicle type</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $vhcl_type ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Plate number</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $plt_no ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $email ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label" >Contact no#</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $cntct_no ?>" id="inputPassword">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Booking date</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="appntmnt_date" value="<?= $bkng_dt ?>" id="inputPassword">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Booking time</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $bkng_tm ?>">
          </div>
        </div>
        <!-- <div class="mb-3" style="display: none;">
          <label for="exampleFormControlInput1" class="form-label">Parking fee</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="parking-charge" placeholder="Fee">
        </div> -->
        <div class="mb-3 row">
          <label for="exampleFormControlInput1" class="form-label">Status</label>
          <select class="form-select" id="inputGroupSelect04" value="" aria-label="Example select with button addon" name="booking_status">
            <option selected value="completed" class="m-3">Completed</option>
          </select>
        </div>
        <div class="text-center">
          <button class="btn btn-outline-primary" name="complete" type="submit">Completed!</button>
        </div>
        
      </form>
      
    </div>
  </section>





  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>
</body>
</html>