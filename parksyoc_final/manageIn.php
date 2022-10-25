<?php

session_start();

require_once "./db/pdo.php";

$statement = $pdo->query("SELECT * FROM add_vehicle WHERE cstmr_stts = 'In' AND getOut = '' ORDER BY time_in DESC");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $pdo->query("SELECT class_name FROM vehicle_class");
$statement2->execute();
$rows2 = $statement2->fetch(PDO::FETCH_ASSOC);


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
      <h1>Manage IN-vehicle</h1>
      <p>This is where you can view the details of the in-vehicles.</p>
    </div>
  </div>

  <!-- Go back -->

  
  
  <!-- Manage vehicle section -->
  <div class="container-fluid">
    <?php if(isset($_SESSION['message'])): ?>
      <h5 class="alert alert-success text-center"><?= $_SESSION['message']; ?></h5>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>

    <table id="datatableid" class="table table-hover border-primary">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Owner name</th>
          <th scope="col">Vehicle type</th>
          <th scope="col">Plate number</th>
          
          <th scope="col">Customer</th>
          <th scope="col">Status</th>
          <th scope="col">Contact number</th>
          <th scope="col">Time in</th>
          <th scope="col">Receipt</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php
          foreach ($rows as $i => $row): ?>
          <th scope="row"><?php echo $i + 1 ?></th>
          <td><?php echo $row['ownr_name'] ?></td>
          <td><?php echo $row['vhcl_type'] ?></td>
          <td>
            <?php 
            if($row['plate_no'] == ""){
              echo 'N/A';
            } else{
              echo $row['plate_no'];
            }
            ?>
          </td>
          <td>
              <?php 
                // ---------------------------------Primary-------------------------------------------
              if($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == '4 wheel vehicle' ){ 
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Employee' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';
              } elseif($row['cstmr_type'] == 'Student' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Primary';

                // ---------------------------------Hospital-------------------------------------------
              } elseif($row['cstmr_type'] == 'Hospital' && $row['vhcl_type'] == '4 wheel vehicle'){
                echo 'Hospital';

                // ---------------------------------Secondary-------------------------------------------

                // ---------------------------------Bicycle-------------------------------------------
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
              } elseif($row['cstmr_type'] == 'Member' && $row['vhcl_type'] == 'Motor'){
                echo 'Secondary';
              } elseif($row['cstmr_type'] == 'Visitor' && $row['vhcl_type'] == 'Motor'){
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
          <td>
            <?php  
              echo "<div class='btn btn-sm btn-success' >";
              echo $row['cstmr_stts'];
              echo "</div>";
            ?>
          </td>
          <td><?php echo $row['cntct_no'] ?></td>
          <td><?php echo $row['time_in'] ?></td>
          <td>
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <a href="./print.php?<?php echo "print_id=" . $row['id'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">Print</a>
            </form>
          </td>
          <td>
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <!-- <a href="./incomingVehicleDetail.php?<?php echo "vehicle_id=" . $row['id'] ?>" class="btn btn-sm btn-outline-secondary">Going-out</a> -->
              <a href="./delete.php?deleteId=<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-danger" name="delete" id="delete"
              >Delete</a>
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