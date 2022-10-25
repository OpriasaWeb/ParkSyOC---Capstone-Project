<?php

require_once './db/pdo.php';

$statement = $pdo->prepare("SELECT * FROM add_vehicle WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['cstmr_id']
));
$search = $statement->fetch(PDO::FETCH_ASSOC);

$vhcl_cat = htmlentities($search['vhcl_type']);
$cstmr_type = htmlentities($search['cstmr_type']);
$plt_no = htmlentities($search['plate_no']);
$ownr_nm = htmlentities($search['ownr_name']);
$cntc_no = htmlentities($search['cntct_no']);
$time_in = htmlentities($search['time_in']);
$out_time = htmlentities($search['out_time']);
$remarks = htmlentities($search['remarks']);
$prkng_fee = htmlentities($search['prkng_fee']);
$stts = htmlentities($search['cstmr_stts']);

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
  <title>ParkSyOC - Add Category</title>
</head>
<body>


  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>View outgoing vehicle</h1>
      <p>This is where you view the overall information of the outgoing vehicle.</p>
    </div>
  </div>

  <div class="goback">
    <a href="./searchVehicle.php" class="btn btn-secondary">Go back to manage out vehicles</a>
  </div>
  
  <div class="container">
    <div class="viewVehicle">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" class="align-items-center">Vehicle owner information</th>
            <th scope="col">Input information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><b>Vehicle class</b></td>
            <td><?= $vhcl_cat ?></td>
          </tr>
          <tr>
            <td><b>Customer type</b> </td>
            <td><?= $cstmr_type ?></td>
          </tr>
          <tr>
            <td><b>Plate number</b> </td>
            <td>
              <?php 
                if($plt_no == ""){
                  echo 'None';
                }else{
                  echo $plt_no;
                }
              ?>
            </td>
          </tr>
          <tr>
            <td><b>Owner name</b> </td>
            <td><?= $ownr_nm ?></td>
          </tr>
          <tr>
            <td><b>Owner contact no</b> </td>
            <td><?= $cntc_no ?></td>
          </tr>
          <tr>
            <td><b>In time</b> </td>
            <td><?= $time_in ?></td>
          </tr>
          <tr>
            <td><b>Out time</b> </td>
            <td><?= $out_time ?></td>
          </tr>
          <tr>
            <td><b>Remarks</b> </td>
            <td>
              <?php  
                if($remarks == ""){
                  echo 'None';
                } else{
                  echo $remarks;
                }
              ?>
            </td>
          </tr>
          <tr>
            <td><b>Parking fee</b> </td>
            <td>
              <?php 
                if($prkng_fee == ""){
                  echo 'Free';
                }else{
                  echo $prkng_fee;
                }
              ?>
            </td>
          </tr>
          <tr>
            <td><b>Status</b> </td>
            <td>
              <?php
                if($stts == "In"){
                echo "Vehicle in";
                }
                if($stts == "Out"){
                  echo "Vehicle out";
                }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  
  


  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>

</body>
</html>