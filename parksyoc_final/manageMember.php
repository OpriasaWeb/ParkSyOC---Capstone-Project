<?php
session_start();
require_once './db/pdo.php';

// $statement = $pdo->query("SELECT * FROM add_vehicle");



$statement = $pdo->query("SELECT * FROM membership WHERE mmbr_stts = 'completed' ORDER BY mmbrshp_date DESC");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['delete'])){
  $sql = "DELETE FROM membership WHERE id = :id";
  // echo "<pre>\n$sql\n</pre>\n";
  $statement = $pdo->prepare($sql);
  $statement->execute(array(
    ':id' => $_POST['id']
  ));

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
  <!-- DATA TABLES CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - manage members</title>
</head>
<body>
  <!-- Nav section -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Nav section -->

  <div class="jumbutron-section mb-5">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Manage completed memberships</h1>
      <p>All of the sticker members in parking.</p>
    </div>
  </div>

  <!-- Search vehicles -->
  <!-- <form action="">
    <div class="container">
      <div class="row">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Owner name"  name="search" value="">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </div>
    </div>
  </form> -->

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
          <th scope="col">Membership id</th>
          <th scope="col">Image</th>
          <th scope="col">Fullname</th>
          <th scope="col">Vehicle type</th>
          <th scope="col">Plate no#</th>
          <th scope="col">Email</th>
          <th scope="col">Contact no#</th>
          <th scope="col">Membership date</th>
          <th scope="col">Status</th>
          <th scope="col">Remarks</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <?php
              foreach ($rows as $i => $row): ?>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $row['mmbrshp_id'] ?></td>
            <td>
              <img src="<?php echo $row['image'] ?>" class="thumb-image img-fluid" style="width: 50px; height 50px;">
            </td>
            <td><?php echo $row['fname'] ?></td>
            <td><?php echo $row['vhcl_type'] ?></td>
            <td><?php echo $row['plt_no'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['cntct_no'] ?></td>
            <td><?php echo $row['mmbrshp_date'] ?></td>
            <td>
              <?php 
                if($row['mmbr_stts'] == ''){
                  echo 'pending';
                } else{
                  echo "<div class='btn-sm btn-success text-center' >";
                  echo "<b>";
                  echo $row['mmbr_stts'];
                  echo "</b>";
                  echo "</div>";
                }
              ?>
            </td>
            <td>
              <?php 
                if($row['remarks']){
                  echo $row['remarks'];
                } else{
                  echo "None";
                }
              ?>
            </td>
            <form action="" method="POST">
              <td class="">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./editMembership.php?<?php echo "member_id=" . $row['id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                <a href="./mngMmbrDelete.php?<?php echo "deleteId=" . $row['id'] ?>" class="btn btn-sm btn-outline-danger" name="delete">Delete</a>
              </td>
            </form>
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