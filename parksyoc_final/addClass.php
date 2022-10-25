<?php
// session
session_start();

// Import pdo.php
require_once('./db/pdo.php');


// INSERT code
if(isset($_POST['classname'])){
  echo "Handling post data...";
  $sql = "INSERT INTO vehicle_class (class_name)
  VALUES (:cname)";
  echo "<pre>\n".$sql."</pre>\n";
  $statement = $pdo->prepare($sql);
  $statement->execute(array(
    ':cname' => $_POST['classname']
  ));

  if($statement){
    $_SESSION['message'] = "Added successfully!";
    header('Location:./manageClass.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Not added. Please try again.";
    header('Location:./manageClass.php');
    exit(0);
  }
  
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
  <title>ParkSyOC - Add Category</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Add class section</h1>
      <p>This is where you can add another vehicle class</p>
    </div>
  </div>
  

  <div class="add-section">
    <form action="" method="post">
      <div class="input-group mb-3">
        <h2>Class name</h2>
        <input type="text" class="form-control" name="classname" value="" placeholder="Enter additional vehicle class" aria-label="Recipient's username" aria-describedby="button-addon2">
        <!-- <input type="hidden" class="form-control" name="time-created" value="" placeholder="Enter additional vehicle class" aria-label="Recipient's username" aria-describedby="button-addon2"> -->
      </div>
      <div class="button-sbmt">
        <button class="btn btn-outline-primary mx-auto" type="submit" id="button-addon2">Add it</button>
      </div>
    </form>
  </div>
  
  <!-- <div class="modal-section">
    <div class="container">
      <div class="modal">
        <h1>dsewe</h1>
      </div>
    </div>
  </div> -->

  <!-- Modal -->
  <?php include_once "./views/modal.php"; ?>
  

  <br>
  <br>
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