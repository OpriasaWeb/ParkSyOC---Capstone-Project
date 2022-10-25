<?php
// Session start
session_start();

require_once './db/pdo.php';


// POST METHOD
if(isset($_POST['updt_name']) && isset($_POST['updt_date']) && isset($_POST['id'])){
  $sql = "UPDATE vehicle_class SET class_name = :clss_name, creation_date = :crtn_dt WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':clss_name' => $_POST['updt_name'],
    ':crtn_dt' => $_POST['updt_date'],
    ':id' => $_POST['id']
  ));

  if($stmt){
    $_SESSION['message'] = "Edit successfully!";
    header('Location:./manageClass.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Failed to edit. Please try again.";
    header('Location:./manageClass.php');
    exit(0);
  }
}

$stmt = $pdo->prepare("SELECT * FROM vehicle_class WHERE id = :xyz");
$stmt->execute(array(':xyz' => $_GET['userid']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// if($row === false){
//   header('Location: manageClass.php');
//   return;
// }

$updt_nm = $row['class_name'];
$updt_dt = $row['creation_date'];
$cstmr_id = $row['id'];



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
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Edit class section</h1>
      <p>This is where you can edit the name of the chosen class</p>
    </div>
  </div>

  <div class="goback">
    <a href="./manageClass.php" class="btn btn-secondary"><i class="fas fa-hand-point-left"></i> Back to manage class</a>
  </div>
  

  <form action="" method="POST">
    <div class="add-section">
      <div class="input-group mb-3">
        <input type="hidden" name="id" value="<?= $cstmr_id ?>">
        <h2>Class name</h2>
        <!-- <input type="hidden" value="" name="id"> -->
        <input type="text" class="form-control" name="updt_name" value="<?= $updt_nm ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input type="hidden" name="updt_date" value="<?= $updt_dt ?>">
      </div>
      <div class="button-sbmt">
        <button class="btn btn-outline-primary mx-auto" type="submit" name="update" 
        id="button-addon2">Update!</button>
      </div>
    </div>
  </form>
  


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Member or visitor?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5>If member, input your ID membership here</h5>
          <form action="./bookVehicle.php" method="GET">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="membershipId" value="">
              <label for="floatingInput">ID membership</label>
            </div>
        </div>
            <div class="modal-footer">
              <button type="submit" value="" name="member" class="btn btn-primary">Member!</button>
              <a href="./visitorBookParking.php" class="btn btn-secondary">Visitor</a>
            </div>
          </form>
      </div>
    </div>
  </div>
  

  
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->
  






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>

</body>
</html>