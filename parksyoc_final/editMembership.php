<?php 
session_start();
require_once './db/pdo.php';


$statement = $pdo->prepare("SELECT * FROM membership WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['member_id']
));

$rows = $statement->fetch(PDO::FETCH_ASSOC);

$fname = htmlentities($rows['fname']);
$vhcl_type = htmlentities($rows['vhcl_type']);
$plt_no = htmlentities($rows['plt_no']);
$email = htmlentities($rows['email']);
$cntct_no = htmlentities($rows['cntct_no']);
$appntmnt_date = htmlentities($rows['appntmnt_date']);
$messages = htmlentities($rows['messages']);


if(isset($_POST['complete'])){
  $mmbr_id = $_GET['member_id'];
  $fname = $_POST['fname'];
  $vhcl_type = $_POST['vhcl_type'];
  $plt_no = $_POST['plt_no'];
  $email = $_POST['email'];
  $cntct_no = $_POST['cntct_no'];



  $sql = "UPDATE membership SET fname = :fname, vhcl_type = :vhcl_type, plt_no = :plt_no, email = :email, cntct_no = :cntct_no WHERE id = $mmbr_id ";
  $statement2 = $pdo->prepare($sql);

  $statement2->bindValue(':fname', $fname);
  $statement2->bindValue(':vhcl_type', $vhcl_type);
  $statement2->bindValue(':plt_no', $plt_no);
  $statement2->bindValue(':email', $email);
  $statement2->bindValue(':cntct_no', $cntct_no);
  $statement2->execute();
  header('Location:manageMember.php');

  if($statement){
    $_SESSION['message'] = "Edit successfully!";
    header('Location:./manageMember.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Ooops. Please try again.";
    header('Location:./manageMember.php');
    exit(0);
  }
}




// echo '<pre>';
// var_dump($rows);
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
  <!-- BOOTSTRAP ICONS cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - membership</title>
</head>
<body>
  <!-- Jumbotron section -->
  <div class="jumbutron-section mb-3">
    <div class="p-4 bg-success text-white rounded">
      <h1>Update registered members</h1>
      <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, aspernatur?</h5>
    </div>
  </div>

  <!-- Go back button -->
  <div class="container-fluid">
    <div class="d-flex">
      <a href="./manageMember.php" class="btn btn-secondary">Go back to pending</a>
    </div>
  </div>


  <section class="member-forms mt-5">
    <div class="container">
      <form action="" method="POST" enctype="multipart/form-data">

        <?php if($rows['image']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">Selfie</label>
          <img src="<?php echo $rows['image'] ?>" alt="" class="updateImage img-fluid m-2">
        <?php endif; ?>

        <?php if($rows['identification']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">Identification</label>
          <img src="<?php echo $rows['identification'] ?>" alt="" class="updateImage img-fluid m-2">
        <?php endif; ?>

        <?php if($rows['orcr']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">OR/CR</label>
          <img src="<?php echo $rows['orcr'] ?>" alt="" class="img-fluid m-2" id="longImage">
        <?php endif; ?>

        <?php if($rows['drivers_license']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">Driver's license</label>
          <img src="<?php echo $rows['drivers_license'] ?>" alt="" class="updateImage img-fluid m-2">
        <?php endif; ?>

        <?php if($rows['id_employment']): ?>
          <label for="inputPassword" class="col-sm-2 col-form-label">ID employment</label>
          <img src="<?php echo $rows['id_employment'] ?>" alt="" class="updateImage img-fluid m-2">
        <?php endif; ?>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Fullname</label>
          <div class="col-sm-10">
            <input type="text" name="fname" class="form-control" id="inputPassword" value="<?= $fname ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Vehicle type</label>
          <div class="col-sm-10">
            <input type="text" name="vhcl_type" class="form-control" id="inputPassword" value="<?= $vhcl_type ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Plate number</label>
          <div class="col-sm-10">
            <input type="text" name="plt_no" class="form-control" id="inputPassword" value="<?= $plt_no ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" name="email" class="form-control" id="inputPassword" value="<?= $email ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label" >Contact no#</label>
          <div class="col-sm-10">
            <input type="text" name="cntct_no" class="form-control" value="<?= $cntct_no ?>" id="inputPassword">
          </div>
        </div>



        <div class="text-center">
          <button class="btn btn-outline-primary" name="complete" type="submit">Update!</button>
          <a href="./manageMember.php" class="btn btn-outline-danger">Cancel</a>
        </div>
        
      </form>
      
    </div>
  </section>





  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./main.js"></script>
</body>
</html>