<?php

require_once './db/pdo.php';

// $statement = $pdo->query("SELECT * FROM add_vehicle");


$search = $_GET['search'] ?? '';
if($search){
  $statement = $pdo->prepare("SELECT * FROM add_vehicle WHERE ownr_name LIKE :owner_name ORDER BY time_in DESC");
  $statement->bindValue(':owner_name', "%$search%");
} else {
  $statement = $pdo->prepare("SELECT * FROM add_vehicle ORDER BY time_in DESC");
}

$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

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
      <h1>Search vehicles</h1>
      <p>This where you can search both parked-on and outgoing vehicles.</p>
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
  
  
  
  <!-- Manage vehicle section -->
  <div class="container">
    <table id="datatableid" class="table table-hover border-primary">
      <thead>
        <tr>
          <th scope="col">S.no#</th>
          <th scope="col">Vehicle type</th>
          <th scope="col">Plate number</th>
          <th scope="col">Owner name</th>
          <th scope="col">Contact number</th>
          <th scope="col">Info</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach($rows as $i => $row):  ?>
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $row['vhcl_type'] ?></td>
            <td>
              <?php 
              if($row['plate_no'] == ""){
                echo 'None';
              } else{
                echo $row['plate_no'];
              }
              
              
              ?>
            </td>
            <td><?php echo $row['ownr_name'] ?></td>
            <td><?php echo $row['cntct_no'] ?></td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./viewSearchVehicle.php?<?php echo "cstmr_id=" .$row['id'] ?>" class="btn btn-sm btn-outline-success">View</a>
              </form>
              
            </td>
          </tr>
        <?php 
          endforeach;  ?>
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