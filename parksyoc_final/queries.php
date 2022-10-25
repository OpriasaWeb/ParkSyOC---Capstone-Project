<?php
session_start();
require_once './db/pdo.php';

// $statement = $pdo->query("SELECT * FROM add_vehicle");


$stmt = $pdo->query("SELECT * FROM messages WHERE mssg_confirmation = '' ");
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



// echo '<pre>';
// var_dump($rows2);
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
  <!-- DATA TABLES CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - Queries</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-3 p-3 bg-success text-white rounded">
      <h1>Pending queries</h1>
      <p>Message queries / Pending queries</p>
    </div>
  </div>

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
    <table id="datatableid" class="table table-hover border-secondary">
      <thead>
        <tr>
          <th scope="col-1">S.no#</th>
          <th scope="col-1">Fullname</th>
          <th scope="col-2">Email</th>
          <th scope="col-1">Subject</th>
          <th scope="col-1">Status</th>
          <th scope="col-3">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <?php
              foreach($rows as $i => $row): ?>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $row['mssg_name'] ?></td>
            <td><?php echo $row['mssg_email'] ?></td>
            <td><?php echo $row['mssg_subject'] ?></td>
            <td>
              <?php 
                if($row['mssg_confirmation'] == ''){
                  echo "<div class='btn-sm btn-warning text-center' >";
                  echo "<b>";
                  echo "pending";
                  echo "</b>";
                  echo "</div>";
                }
                echo $row['mssg_confirmation'] 
              ?>
            </td>


            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['message_id'] ?>">
                <a href="./queriesUpdate.php?<?php echo "queriesId=" . $row['message_id'] ?>" class="btn btn-sm btn-outline-primary">Read</a>
                <a href="./queriesDelete.php?<?php echo "deleteId=" . $row['message_id'] ?>" class="btn btn-sm btn-outline-danger" name="delete" value="">Delete</a>
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