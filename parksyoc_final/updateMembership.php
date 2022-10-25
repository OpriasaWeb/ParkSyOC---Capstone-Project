<?php 
session_start();
require_once './db/pdo.php';

// $id = $_GET['id'] ?? null;

// if(!$id){
//   header('Location: index.php');
// }

// $statement3 = $pdo->prepare('SELECT * FROM products WHERE id = :member_id');
// $statement3->bindValue(':member_id', $id);
// $statement3->execute();
// $member = $statement3->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM membership WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['member_id']
));

$rows = $statement->fetch(PDO::FETCH_ASSOC);



$mmbr_id = htmlentities($rows['mmbrshp_id']);
$image = htmlentities($rows['image']);
$fname = htmlentities($rows['fname']);
$vhcl_type = htmlentities($rows['vhcl_type']);
$plt_no = htmlentities($rows['plt_no']);
$email = htmlentities($rows['email']);
$cntct_no = htmlentities($rows['cntct_no']);
$appntmnt_date = htmlentities($rows['appntmnt_date']);
$messages = htmlentities($rows['messages']);


if(isset($_POST['complete'])){
  $member_id = $_GET['member_id'];
  $rmrks = $_POST['rmrks'];
  $status = $_POST['status'];
  $sticker = "Received";
  $mmbrshp_dt = date('Y-m-d');
  $expiration_dt = (date('Y')+1).date('-m-d');

  

  $sql = "UPDATE membership SET remarks = :rmrks, sticker = :sticker, mmbr_stts = :stts, mmbrshp_date = :mmbrshp_dt, expiration_date = :expiration_dt WHERE id = $member_id ";
  $statement2 = $pdo->prepare($sql);

  $statement2->bindValue(':rmrks', $rmrks);
  $statement2->bindValue(':sticker', $sticker);
  $statement2->bindValue(':stts', $status);
  $statement2->bindValue(':mmbrshp_dt', $mmbrshp_dt);
  $statement2->bindValue(':expiration_dt', $expiration_dt);
  $statement2->execute();
  header('Location:manageMember.php');

  // Expiration date


  // $email
  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = "Hi " . $fname . ", your registration is completed.\nYou are now officially member of ParkSyOC \nYour membership ID: " . $mmbr_id . ", use it whenever you make a booking and the system will automatically input all of your basic information. Thankyou! \n Here is the expiration date of your membership: " . $expiration_dt;
  $sender = "From:parksyoc@gmail.com";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  
  if($statement){
    $_SESSION['message'] = "Successful membership application!";
    header('Location:./manageMember.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Ooops. Please try again.";
    header('Location:./manageMember.php');
    exit(0);
  }

}



function randomString($n){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';

  for($i = 0; $i < $n; $i++){
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];
  }
  return $str;
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
      <h1>Update section of pending membership</h1>
      <h5>Hi, welcome to our web system. Here you can book your schedule of parking in Olivarez College parking area.</h5>
    </div>
  </div>

  <!-- Go back button -->
  <div class="container-fluid">
    <div class="d-flex">
      <a href="./appntmntMember.php" class="btn btn-secondary">Go back to pending</a>
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
          <img src="<?php echo $rows['identification'] ?>" alt="" id="identification" class="img-fluid m-2">
        <?php endif; ?>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Fullname</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $fname ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Vehicle type</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $vhcl_type ?>">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Vehicle brand</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?php echo $rows['vehicle_brand'] ?>">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Vehicle model</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?php echo $rows['vehicle_model'] ?>">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Plate number</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $plt_no ?>">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Chassis number</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?php echo $rows['chassis_no'] ?>">
          </div>
        </div>

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
          <label for="inputPassword" class="col-sm-2 col-form-label">Addres</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?php echo $rows['address'] ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $email ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label" >Contact no#</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $cntct_no ?>" id="inputPassword">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Appointment date</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $appntmnt_date ?>" name="appntmnt_date" id="inputPassword">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Messages</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" value="<?= $messages ?>" disabled>
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Remarks:</label>
          <textarea class="form-control" name="rmrks" value="" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <!-- <div class="mb-3" style="display: none;">
          <label for="exampleFormControlInput1" class="form-label">Parking fee</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="parking-charge" placeholder="Fee">
        </div> -->
        <div class="input-group">
          <label for="exampleFormControlInput1" class="form-label">Status</label>
          <select class="form-select" id="inputGroupSelect04" value="" aria-label="Example select with button addon" name="status">
            <option selected value="completed" class="m-3">Completed</option>
          </select>
        </div>
        <div class="text-center">
          <button class="btn btn-outline-primary" name="complete" type="submit">Completed!</button>
          <a href="./dashboard.php" class="btn btn-outline-danger">Cancel</a>
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
</body>
</html>