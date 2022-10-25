<?php

require_once './db/pdo.php';

// include_once './views/qrcode.php';




$statement = $pdo->prepare("SELECT * FROM add_vehicle WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['print_id']
));

$rows = $statement->fetch(PDO::FETCH_ASSOC);

$vhcl_cat = htmlentities($rows['vhcl_type']);
$cstmr_type = htmlentities($rows['cstmr_type']);
$prkng_fee = htmlentities($rows['prkng_fee']);
$time_in = htmlentities($rows['time_in']);
$getIn = htmlentities($rows['getIn']);
$getOut = htmlentities($rows['getOut']);
// $out_time = htmlentities($rows['out_time']);

// --------------------------
$gettingIn = $rows['getIn'];
$gettingOut = "03:40:00";



$inTime = strtotime($gettingIn);
$outTime = strtotime($gettingOut);

$timeDiff = ($outTime - $inTime) / 60;

// echo $timeDiff;

// exit;

// --------------------------

require_once 'phpqrcode/qrlib.php';

// QR code
$path = 'images/qr/';
$file = $path.uniqid().".png";

// Text or result to output
$text = $_GET['print_id'] ;
// $text .= "\n /".$timeDiff;


QRcode::png($text, $file, 'S', 3, 2);

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
</head>
<body>


  <div class="my-5" size="A4" id="page">
    <div class="p-3">
      <h2 class="text-center fs-4">ParkSyOC <i class="fas fa-receipt"></i> receipt</h2>
      <div class="exact-date">
        <?php
          echo "<div class='text-center' >";
          date_default_timezone_set('Asia/Manila');
          echo "<span class='text-center' style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a  ');
          echo "</div>";
        ?>
      </div>
      <div class="address text-center" id="address">
        <p>Olivarez College, Dr. Arcadio Santos Avenue, Sucat Road, Parañaque City, 1700 Metro Manila.</p>
      </div>
      <div class="thank-you text-center" id="thanks">
        <p>Thank you for parking-in</p>
      </div>
      <div class="greetings text-center" id="greetings">
        <p>Have a nice day!</p>
      </div>

      <table class="table" style="width:15rem;">
        <tbody>
          <tr>
            <td class="bold">Id:</td>
            <td>
              <?php 
                echo $rows['id'];
              ?>
            </td>
          </tr>
          <tr>
            <td class="bold">Vehicle category:</td>
            <td>
              <?php 
                echo $rows['vhcl_type'];
              ?>
            </td>
          </tr>
          <tr>
            <td class="bold">Customer:</td>
            <td>
              <?php 
                echo $rows['cstmr_type'];
              ?>
            </td>
          </tr>
          <tr>
            <td class="bold">Time in</td>
            <td><?php echo $rows['time_in'] ?></td>
          </tr>
        </tbody>
      </table>
      <div class="address text-center">
        <p>
          <?php
            echo "<img class='img-fluid' src='".$file."'>";
          ?>
        </p>
        <p class="" id="texts">Olivarez College management will not be responsible for any loss or damage that may happen to your vehicle. For security and safety of your vehicle, please observe the following:</p>
        <p class="" id="texts">Parking hours - 5:00am to 11:00pm., Monday to Sunday. The use of pay parking facilities is conditioned on the observance of the rules and regulations of the Olivarez College Management.</p>
        <p class="" id="texts">Please secure and lock your own vehicle before you leave it in parking.</p>
        <p class="" id="texts">Do not leave your parking ticket and valuables inside your vehicle.</p>
        <p class="" id="texts">NO OVERNIGHT PARKING. Vehicles left in the parking area for more than 24 hours will be automatically towed and turned over to the authorities. You will be required to present documents required in No. 7 before the release of the vehicle.</p>
        <p class="" id="texts">You will waive your claim against the management for any incident of robbery, abduction, physical injury or death while inside the parking area.</p>
        <p class="" id="texts">Olivarez College management is free from any liability related to seizure of the vehicle or its forced opening by virtue of an Order from Courts or other government authorities.</p>
        <p class="" id="texts">NO PARKING TICKET, NO EXIT. In case you losem or deface or mutilate any portion of your parking ticket, you will be required to present the vehicle's original Certificate of Registration with a copy of latest Official Receipt, valid identification card and shall pay the administrative fine of 500 pesos.</p>
        <p class="" id="texts">Any damages to Olivarez College facilities or other parked vehicles intentionally or negligently caused or attributable shall be subject to criminal or administrative fine.</p>
      </div>
    </div>
  </div>

  <!-- Date and time-in -->
  

  <!-- Print button -->
  <div class="center-button text-center">
    <button type="submit" name="print" onclick="window.print()" class="btn btn-outline-primary">Print <i class="fas fa-print"></i></button>
  </div>
</body>
</html>