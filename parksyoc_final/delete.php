<?php 
session_start();

require_once "./db/pdo.php";  



if(isset($_POST['delete'])){
  $getId = $_GET['deleteId'];

  $sql = "DELETE FROM add_vehicle WHERE id = :deleteId ";
  $statement3 = $pdo->prepare($sql);
  $statement3->execute(array(
    ':deleteId' => $getId
  ));
  header('Location:manageIn.php');
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
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>Delete warning!</title>
</head>
<body>
  <div class="container text-center ">
    <div class="card mt-10">
      <div class="card-header">
        ParkSyOC
      </div>
      <div class="card-body">
        <i class="fas fa-exclamation-circle fs-1 text-danger" id="icon-red"></i>
        <p class="card-text">Are you sure to delete this one?</p>
        <form action="" method="post">
          <a href="./manageIn.php" class="btn btn-sm btn-outline-primary">Cancel</a>
          <button class="btn btn-sm btn-outline-danger" name="delete">Yes, delete</button>
        </form>
      </div>
    </div>
    <img src="./images/Parking-pana.png" class="img-fluid" width="500" height="500">
  </div>
  




  <!-- Local JS -->
  <script src="./js/sweetAlert.js"></script>
  <!-- Sweet alert -->
</body>
</html>