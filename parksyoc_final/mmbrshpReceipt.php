<?php

require_once './db/pdo.php';

$statement = $pdo->prepare("SELECT * FROM membership WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['print_id']
));

$rows = $statement->fetch(PDO::FETCH_ASSOC);

$vhcl_cat = htmlentities($rows['vhcl_type']);



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

  <div class="my-4 page" size="A4">
    <div class="p-3">
      <h2 class="text-center fs-4">ParkSyOC <i class="fas fa-receipt"></i> receipt</h2>
      <div class="exact-date">
        <?php
          echo "<div class='text-center' >";
          date_default_timezone_set('Asia/Manila');
          echo "<span class='text-center' style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a');
          echo "</div>";
        ?>
      </div>
      <div class="address text-center" id="address">
        <p>Olivarez College, Dr. Arcadio Santos Avenue, Sucat Road, Parañaque City, 1700 Metro Manila.</p>
      </div>
      <div class="thank-you text-center" id="thanks">
        <p>Sticker membership receipt</p>
      </div>
      <div class="greetings text-center" id="greetings">
        <p>Have a nice day!</p>
      </div>

      <table class="table" style="width:15rem;">
        <tbody>

          <tr>
            <td class="bold">Vehicle category:</td>
            <td>
              <?php 
                echo $rows['vhcl_type'];
              ?>
            </td>
          </tr>

          <tr>
            <td class="bold">Status:</td>
            <td>
              <?php
                if($rows['appntmnt_stts'] == 'confirmed'){
                  echo "<div class='' >";
                  echo 'confirmed registration';
                  echo "</div>";
                }
              ?>
            </td>
          </tr>

        </tbody>
      </table>
      <div class="address text-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col-6">
              <h6>Assessment</h6>
              <p>_______________</p>

            </div>
            <div class="col-6">
              <h6>Accounting</h6>
              <p>_______________</p>
            </div>
          </div>
        </div>


        <p class="card-text" id="texts">Read the policy for membership</p>
        <p class="" id="texts"><b>ParkSyOC membership rules and policy:</b></p>
        <p class="" id="texts">1. First step is agree on this policy.</p>
        <p class="" id="texts">2. Second, register online and make all of the needed information filled with right and truthness.</p>
        <p class="" id="texts">3. Third, the system will email you when your registration is completed and remind you on what date you have choose for an appointment.</p>
        <p class="" id="texts">4. Fourth, once verified by the admin - the receipt will be given directing to assesment for inputing data and accounting for payment.</p>
        <p class="" id="texts">5. Fifth, when the transaction is completed, go back to admin and present the receipt and get your sticker membership for your vehicle.</p>
        <p class="" id="texts">6. Sixth, the membership is one year guarantee and the ParkSyOC would not consider leap year, if any case, the admin and system will consider it as February 28 or March 1.</p>
        <p class="" id="texts">7. Seventh, the online booking is still required even if you are a member or not.</p>
        <p class="" id="texts">8. Eight, upon online booking enter your unique ID that system emailed you the day of the successful transaction.</p>
        <p class="" id="texts">9. Ninth, ParkSyOC suggest to copy the unique ID from the email and paste/store it in your notes so that whenever you make a booking it is easy for you to copy and paste it in online booking.</p>
        <p class="" id="texts">10. In case, your membership sticker got lost, go directly to admin and present your receipt together with ID.</p>
        <p class="" id="texts">Enjoy the parking, take care.</p>
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