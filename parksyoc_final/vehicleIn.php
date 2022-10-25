<?php
// Session start
session_start();

require_once "./db/pdo.php";

// "SELECT * FROM vehicle_details";
// "SELECT * FROM vehicle_class";

$vehicleIn = $_GET['vehicleIn'];
$statement2 = $pdo->query("SELECT * FROM add_vehicle WHERE id = '$vehicleIn' ");
$statement2->execute();
$rows2 = $statement2->fetch(PDO::FETCH_ASSOC);

$csmtr_type = '';
$prkng_fee = '';

// --------------------------------------------- //


// --------------------------------------------- //


// --------------------------------------------- //
// require the qrlib
require_once 'phpqrcode/qrlib.php';

// QR code
$path = 'images/qr/';
$file = $path.uniqid().".png";

// Text or result to output
$text = $_GET['vehicleIn'];

QRcode::png($text, $file, 'S', 3, 2);

// --------------------------------------------- //



if(isset($_POST['incoming'])){
  $vhclIn_id = $_GET['vehicleIn'];
  $time_in = date('Y-m-d H:i:s');
  $getIn = date('H:i:s');
  $qrCode = $file;
  $cstmr_stts = "In";
  $bkng_stts = "";
  
  // Update time_in
  $sql = "UPDATE add_vehicle SET time_in = :time_in, getIn = :getIn, cstmr_stts = :cstmr_stts, booking_stts = :bkng_stts, qrcode = :qrcode WHERE id = '$vhclIn_id' ";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':time_in', $time_in);
  $statement->bindValue(':getIn', $getIn);
  $statement->bindValue(':cstmr_stts', $cstmr_stts);
  $statement->bindValue(':bkng_stts', $bkng_stts);
  $statement->bindValue(':qrcode', $qrCode);
  $statement->execute();
  header('Location:manageIn.php');

  if($statement){
    $_SESSION['message'] = "Vehicle in!";
    header('Location:./manageIn.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Ooops. Please try again.";
    header('Location:./manageIn.php');
    exit(0);
  }

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
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - Add vehicle</title>
</head>
<body>

  <!-- Jumbotron section -->
  <div class="jumbutron-section">
    <div class="mt-2 p-4 bg-success text-white rounded">
      <h1>Parking-in vehicle</h1>
      <p>This where you can add an upcoming vehicle.</p>
    </div>
  </div>
  <!-- Jumbotron section -->


  <!-- Add vehicle section -->
  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error): ?>
        <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="container text-center mt-5">
    <div class="card mt-10">
      <div class="card-header">
        ParkSyOC
      </div>
      <div class="card-body">
        <i class="fas fa-check-circle text-success fs-1"></i>
        <p class="card-text">Vehicle getting in?</p>
        <form action="" method="POST">
          <a href="./completedBookings.php" class="btn btn-sm btn-outline-primary">Cancel</a>
          <button class="btn btn-sm btn-outline-success" name="incoming">Confirm</button>
        </form>
      </div>
    </div>
    <img src="./images/Parking-pana.png" class="img-fluid" width="500" height="500">
  </div>
  
  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>

</body>
</html>