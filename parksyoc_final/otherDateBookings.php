<?php

error_reporting(0);

session_start();
require_once './db/pdo.php';

// $statement = $pdo->query("SELECT * FROM add_vehicle");


$stmt = $pdo->query("SELECT * FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() + 1 AND booking_stts = 'completed' AND cstmr_stts = '' ");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['delete'])){

  $delete_sql = "DELETE FROM add_vehicle WHERE id = :id ";

  $statement = $pdo->prepare($delete_sql);
  $statement->execute(array(
    ':id' => $_POST['id']
  ));
}

// $stmt2 = $pdo->query("SELECT bkng_time FROM add_vehicle");
// $stmt2->execute();
// $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// DELETE FROM
$delete_bookings = $pdo->query("SELECT * FROM add_vehicle WHERE date(bkng_dt) = CURRENT_DATE() AND date(bkng_time) = CURRENT_TIME()"); 
$delete_bookings->execute();
$rows_delete = $delete_bookings->fetchAll(PDO::FETCH_ASSOC);


$current_date = date('Y-m-d');
$current_time = strtotime(date('H:i:s'))  + 1;

// echo '<pre>';
// var_dump($current_time);
// echo '</pre>';
// exit;

// $delete_current = if($row['bkng_dt'] == $current_date && $row['bkng_time'] == $row['bkng_time'] + 1){
//   $stmt = $pdo->prepare($query);
//   $stmt->execute();
//   return $stmt->rowCount();
// }
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
  <title>ParkSyOC - Other date bookings</title>
</head>
<body>

  <?php

  
  ?>

  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-3 p-3 bg-success text-white rounded">
      <h1>Other date confirmed bookings</h1>
      <p>Here are the rest of the other dates completed bookings.</p>
      <p>Dashboard / Vehicle bookings / Other date bookings</p>
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

  <div class="container text-center">
    <?php if(isset($_SESSION['message'])): ?>
      <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>
  </div>
  
  
  
  <!-- Manage vehicle section -->
  <div class="container-fluid">
    <table id="datatableid" class="table table-hover border-dark">
      <thead>
        <tr>
          <th scope="col-1">S.no#</th>
          <th scope="col-1">Member id</th>
          <th scope="col-2">Fullname</th>
          <th scope="col-2">Vehicle type</th>
          <th scope="col-2">Customer</th>
          <th scope="col-1">Booking date</th>
          <th scope="col-1">Booking time</th>
          <th scope="col-1">Booking status</th>
          <th scope="col-3">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <?php
              foreach($rows as $i => $row): ?>
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
                echo 'Hospital';
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
            <td><?php echo $row['bkng_dt'] ?></td>
            <td>
              <?php 
                if($row['bkng_time'] < 12){
                  echo $row['bkng_time'] . ' AM';
                } elseif($row['bkng_time'] >= 12){
                  echo $row['bkng_time'] . ' PM';
                }

                $current_date = $date = date('Y-m-d');
                
              ?>
            </td>
            <td>
              <?php 
                if($row['booking_stts'] == 'completed'){
                  echo "<div class='btn btn-sm btn-success'>";
                  echo "confirmed";
                  echo "</div>";
                }
              ?>
            </td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./vehicleIn.php?<?php echo "vehicleIn=" . $row['id'] ?>" class="btn btn-sm btn-outline-primary">Vehicle-in</a>
                <a href="./cmpltdBkngsDelete.php?<?php echo "deleteId=" . $row['id'] ?>" class="btn btn-sm btn-outline-danger" name="delete" value="<?php echo $row['id'] ?>">Delete</a>

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

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  


</body>
</html>