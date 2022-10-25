<?php
session_start();
require_once './db/pdo.php';

$reserve_sql = "SELECT * FROM membership WHERE mmbrshp_date = '' AND date(appntmnt_date) = CURRENT_DATE() + 1 ORDER BY appntmnt_date DESC";


$statement = $pdo->query("SELECT * FROM membership WHERE mmbr_stts = '' AND appntmnt_stts = 'confirmed' ORDER BY appntmnt_date ASC");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);








// if(isset($_POST['mmbrshp']) && isset($_POST['mmbr_id'])){
//   $sql = "UPDATE membership SET mmbrshp_date = :mmbrshp_date WHERE id = :id";

//   $statement2 = $pdo->prepare($sql);
//   $statement2->execute(array(
//     ':mmbrshp_date' => $_POST['mmbrshp'],
//     ':id' => $_POST['mmbr_id']
//   ));
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
  <title>ParkSyOC - Appointment Membership</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Appointment of application</h1>
      <p>Here are the lists of the confirmed registered in sticker membership.</p>
    </div>
  </div>

  <div class="container">
  <?php if(isset($_SESSION['message'])): ?>
    <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
  <?php 
    unset($_SESSION['message']);
    endif; 
  ?>
  </div>


  <!-- Manage vehicle section -->
  <div class="container-fluid">
    <table id="datatableid" class="table table-hover border-success">
      <thead>
        <tr>
          <th scope="col">S.no#</th>
          <th scope="col">Image</th>
          <th scope="col">Fullname</th>
          <th scope="col">Email</th>
          <th scope="col">Contact no#</th>
          <th scope="col">Appointment date</th>
          <th scope="col">Appointment status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr class="">
            <?php 
              foreach ($rows as $i => $row): ?>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
              <img src="<?php echo $row['image'] ?>" class="thumb-image img-fluid" style="width: 50px; height 50px;">
            </td>
            <td><?php echo $row['fname'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['cntct_no'] ?></td>
            <td>
              <?php 
                echo "<div class='text-center' >";
                echo $row['appntmnt_date'];
                echo "</div>";
              ?>
            </td>
            <td>
              <?php
                if($row['appntmnt_stts'] == 'confirmed'){
                  echo "<div class='btn-sm btn-success text-center' >";
                  echo "<b>";
                  echo 'confirmed registration';
                  echo "</b>";
                  echo "</div>";
                }
              ?>
            </td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./updateMembership.php?<?php echo "member_id=" . $row['id'] ?>" class="btn btn-sm btn-outline-primary">Appointment</a>
                <a href="./mmbrshpReceipt.php?<?php echo "print_id=" . $row['id'] ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Receipt</a>
                <a href="./appntmntMmbrshpDelete.php?<?php echo "deleteId=" . $row['id'] ?>" class="btn btn-sm btn-outline-danger" name="delete">Delete</a>
                
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

  <!-- BOOTBOX CDN JS - POPUP MODAL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  


</body>
</html>