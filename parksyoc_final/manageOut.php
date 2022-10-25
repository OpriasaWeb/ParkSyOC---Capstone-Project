<?php

session_start();

require_once './db/pdo.php';

require_once 'phpqrcode/qrlib.php';

// $statement = $pdo->query("SELECT * FROM vehicle_class WHERE cstmr_stts = 'Vehicle out' ORDER BY time_out ASC");
// cstmr_stts = 'Out'
$statement = $pdo->query("SELECT * FROM add_vehicle WHERE getOut ORDER BY out_time DESC");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


// $statement2 = $pdo->prepare("SELECT * FROM add_vehicle");
// $statement2->execute();
// $rows2 = $statement2->fetch(PDO::FETCH_ASSOC);


// $gettingIn = $rows2['getIn'];
// $gettingOut = $rows2['getOut'];

// $inTime = strtotime($gettingIn);
// $outTime = strtotime($gettingOut);

// $timeDiff = ($outTime - $inTime) / 60;

// echo $timeDiff;

// exit;

// --------------------------


// QR code
// $path = 'images/qr/';
// $file = $path.uniqid().".png";

// // Text or result to output
// $text = $_GET['print_id'];
// $text .= "\n".$timeDiff;


// QRcode::png($text, $file, 'S', 3, 2);



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
  
  <title>ParkSyOC - Add Category</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>View OUT-vehicles</h1>
      <p>This is where you can view the details of the outgoing vehicles.</p>
    </div>
  </div>

  <!-- Go back -->
  
  
  <!-- Manage vehicle section -->
  <div class="container-fluid">


    <?php if(isset($_SESSION['message'])): ?>
      <div class="container">
        <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
      </div>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>

    <table id="datatableid" class="table table-hover border-primary">
      <thead>
        <tr>
          <th scope="col">S.no#</th>
          <th scope="col">Owner name</th>
          <th scope="col">Vehicle class</th>
          <th scope="col">Customer type</th>
          <th scope="col">Plate number</th>
          
          <th scope="col">Contact number</th>
          <th scope="col">Time in</th>
          <th scope="col">Out time</th>
          <th scope="col">Status</th>
          <th scope="col">Fee</th>
          <!-- <th scope="col">Action</th> -->
        </tr>
      </thead>
      <tbody>
        <?php foreach($rows as $i => $row): ?>
        <tr>
          <th scope="row"><?php echo $i + 1 ?></th>
          <td><?php echo $row['ownr_name'] ?></td>
          <td><?php echo $row['vhcl_type'] ?></td>
          <td>
              <?php 
              if($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == '4 wheel vehicle' ){ 
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Hospital';
                // ---------------------------------Bicycle-------------------------------------------
              } elseif($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              }
               elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'Bicycle'){
                echo 'Hospital';
                // -----------------------------------Motor-----------------------------------------
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'Motor'){
                echo 'Hospital';
                // -----------------------------------E-bike-----------------------------------------
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == 'E-bike'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == 'E-bike'){
                echo 'Hospital';
              }
              // echo $row['cstmr_type'] 
              ?>
            </td>
          <td>
            <?php 
            if($row['plate_no'] == ""){
              echo "N/A";
            } else{
              echo $row['plate_no'];
            }
            ?>
          </td>
          
          <td>
            <?php 
            if($row['cntct_no'] == ""){
              echo "None";
            } else{
              echo $row['cntct_no'];
            }
            ?>
          </td>
          <td><?php echo $row['time_in'] ?></td>
          <td><?php echo $row['out_time'] ?></td>

          <td>
            <?php 
              if($row['cstmr_stts'] == 'Out'){
                echo "<div class='btn btn-sm btn-warning' >";
                echo "Out";
                echo "</div>";
              } else{
                echo "In";
              }
            ?>
          </td>
          <td>
            <?php 
            if($row['prkng_fee'] == ""){
              echo 'Free';
            } else{
              echo $row['prkng_fee'];
            }
            ?>
          </td>
          <!-- <td>
            <a href="./outgoingVehicleDetail.php" class="btn btn-sm btn-outline-success">View</a>
          </td> -->
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
  <br>
  <br>
  <br>

  

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->
  



  <!-- local JS / jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/dataTables.js"></script>

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>