<?php 
session_start();
require_once './db/pdo.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $fname = $_POST['fname'];
  $vhcl_brnd = $_POST['vhcl_brnd'];
  $vhcl_mdl = $_POST['vhcl_mdl'];
  $vhcl_type = $_POST['vhcl_type'];
  $plt_no = $_POST['plt_no'];
  $chassis_no = $_POST['chassis_no'];
  $address = $_POST['address'];
  $member_email = $_POST['email'];
  $cntct_no = $_POST['cntct_no'];
  $appntmnt_date = $_POST['appntmnt_date'];
  $messages = $_POST['messages'];
  $mmbrshp_id = $_POST['mmbrshp_id'];
  $hosID = $_POST['hsptl_id'];
  $mmbr_date = date('m-d-Y H:i:s');
  $randomId = randomId(7);

  if(!is_dir('images')){
    mkdir('images');
  }

  if(empty($errors)){
    $image = $_FILES['image'] ?? null;
    $imageId = $_FILES['imageId'] ?? null;
    $image_orcr = $_FILES['image_orcr'] ?? null;
    $image_license = $_FILES['image_license'] ?? null;
    $image_empId = $_FILES['image_empId'] ?? null;

    $imagePath = '';
    $imageIdentification = '';
    $imageORCR = '';
    $imageLicense = '';
    $imageEmployee = '';

    // Selfie image
    if($image && $image['tmp_name']) {
      $imagePath = 'images/'.'selfie/'.randomString(8).'/'.$image['name'];
      
      mkdir(dirname($imagePath));
      
      move_uploaded_file($image['tmp_name'], $imagePath);
    }
    // Selfie image

    // Valid id or non-valid id
    if($imageId && $imageId['tmp_name']) {
      $imageIdentification = 'images/'.'identification/'.randomString(8).'/'.$imageId['name'];
      
      mkdir(dirname($imageIdentification));
      
      move_uploaded_file($imageId['tmp_name'], $imageIdentification);
    }
    // Valid id or non-valid id

    // ORCR image
    if($image_orcr && $image_orcr['tmp_name']) {
      $imageORCR = 'images/'.'orcr/'.randomString(8).'/'.$image_orcr['name'];
      
      mkdir(dirname($imageORCR));
      
      move_uploaded_file($image_orcr['tmp_name'], $imageORCR);
    }
    // ORCR image

    // License image
    if($image_license && $image_license['tmp_name']) {
      $imageLicense = 'images/'.'drivers_license/'.randomString(8).'/'.$image_license['name'];
      
      mkdir(dirname($imageLicense));
      
      move_uploaded_file($image_license['tmp_name'], $imageLicense);
    }
    // License image

    // Employee ID image
    if($image_empId && $image_empId['tmp_name']) {
      $imageEmployee = 'images/'.'employment_id/'.randomString(8).'/'.$image_empId['name'];
      
      mkdir(dirname($imageEmployee));
      
      move_uploaded_file($image_empId['tmp_name'], $imageEmployee);
    }
    // Employee ID image

    // SQL statement
    $statement = $pdo->prepare("INSERT INTO membership (identification, fname, image, vhcl_type, orcr, drivers_license, id_employment, address, vehicle_brand, vehicle_model, chassis_no, plt_no, email, cntct_no, appntmnt_date, messages, mmbrshp_id) 
    VALUES (:identification, :fname, :image, :vhcl_type, :orcr, :drivers_license, :id_employment, :address, :vehicle_brand, :vehicle_model, :chassis_no, :plt_no, :email, :cntct_no, :appntmnt_date, :messages, :mmbrshp_id)");
    // SQL statement

    $statement->bindValue(':identification', $imageIdentification);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':vhcl_type', $vhcl_type);
    $statement->bindValue(':orcr', $imageORCR);
    $statement->bindValue(':drivers_license', $imageLicense);
    $statement->bindValue(':id_employment', $imageEmployee);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':vehicle_brand', $vhcl_brnd);
    $statement->bindValue(':vehicle_model', $vhcl_mdl);
    $statement->bindValue(':chassis_no', $chassis_no);
    $statement->bindValue(':plt_no', $plt_no);
    $statement->bindValue(':email', $member_email);
    $statement->bindValue(':cntct_no', $cntct_no);
    $statement->bindValue(':appntmnt_date', $appntmnt_date);
    $statement->bindValue(':messages', $messages);
    $statement->bindValue(':mmbrshp_id', $randomId);
    $statement->execute();
    header('Location:userMembershipReceipt.php');

  }
}

function randomString($n){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str_random = '';

  for($i = 0; $i < $n; $i++){
    $index = rand(0, strlen($characters) - 1);
    $str_random .= $characters[$index];
  }
  return $str_random;
} 



function randomId($idno){
  $loopChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';

  for($i = 0; $i < $idno; $i++){
    $index = rand(0, strlen($loopChars) - 1);
    $str .= $loopChars[$index];
  }
  return $str;
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
  <!-- BOOTSTRAP ICONS cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!-- Google jquery CDN for disable past dates -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function(){
      $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if(month < 10){
          month = '0' + month.toString();
        }
        if(day < 10){
          day = '0' + day.toString();
        }

        var maxDate = year + '-' + month + '-' + day;

        $('#dateControl').attr('min', maxDate);
      });
    });
  </script>

  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">
  <title>ParkSyOC - user</title>
</head>
<body>
  <!-- Jumbotron section -->
  <div class="jumbutron-section mb-3">
    <div class="p-4 bg-success text-white rounded">
      <h1>Register to be a member</h1>
      <h5>Hi, welcome to our web system. Here you can book your schedule of parking in Olivarez College parking area.</h5>
    </div>
  </div>


  <!-- Go back section -->
  <a href="./index.php" class="btn btn-secondary m-2">Go back to home</a>


  <section class="member-forms mt-5">
    <div class="container">
      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Insert your <b>selfie</b> here</label>
            <br>
            <input type="file" name="image">
        </div>

        <div class="form-group mt-3">
            <label>Insert your <b>valid or non-valid ID</b> here</label>
            <br>
            <input type="file" name="imageId" required>
        </div>

        <div class="form-floating mb-2 mt-2">
          <input type="text" class="form-control" name="fname" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Fullname</label>
        </div>

        <div class="form-floating mb-2">
          <select class="form-select" id="floatingPassword" name="vhcl_type">
            <option value="1"><p style="opacity: 50%;">Vehicle type</p></option>
            <?php
              $statement3 = $pdo->query("SELECT class_name FROM vehicle_class");
              while($rows = $statement3->fetch(PDO::FETCH_ASSOC))
              {
            ?>
              <option value="<?php echo $rows['class_name'] ?>"><?php echo $rows['class_name'] ?></option>
            <?php 
              }
            ?>
          </select>
        </div>

        <div class="form-floating mb-2 mt-2">
          <input type="text" class="form-control" name="vhcl_brnd" id="floatingInput" placeholder="name@example.com" required>
          <label for="floatingInput">Vehicle brand</label>
        </div>

        <div class="form-floating mb-2 mt-2">
          <input type="text" class="form-control" name="vhcl_mdl" id="floatingInput" placeholder="name@example.com" required>
          <label for="floatingInput">Vehicle model</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="plt_no" required>
          <label for="floatingPassword">Plate number</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="chassis_no">
          <label for="floatingPassword">Chassis number</label>
        </div>

        <div class="form-group mt-3">
            <label><b>OR/CR</b> picture</label>
            <br>
            <input type="file" name="image_orcr">
        </div>

        <div class="form-group mt-3">
            <label><b>Driver's license</b> picture</label>
            <br>
            <input type="file" name="image_license">
        </div>
        
        <div class="form-group mt-3">
            <label><b>If employed</b>, picture ID of employment</label>
            <br>
            <input type="file" name="image_empId">
        </div>

        <!-- <div class="form-group mt-3">
            <label><b>If hospital parking</b>, identification of Olivarez Hospital.</label>
            <br>
            <input type="file" name="hsptl_id">
        </div> -->

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="address" required>
          <label for="floatingPassword">Address</label>
        </div>

        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingPassword" placeholder="Password" name="email" required>
          <label for="floatingPassword">Email</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="cntct_no" required>
          <label for="floatingPassword">Contact no#</label>
        </div>

        <div class="form-floating mb-2">
          <input type="date" class="form-control" id="dateControl" placeholder="Password" name="appntmnt_date" required>
          <label for="floatingPassword">Appointment date</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="messages">
          <label for="floatingPassword">Messages</label>
        </div>

        <input type="hidden" name="mmbrshp_id">
        <button class="btn btn-outline-primary" type="submit">Submit!</button>
        <a href="./index.php" class="btn btn-outline-danger">Cancel</a>
      </form>
      
    </div>
  </section>





  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>




  <!-- local JS / jQuery -->
  <script src="./js//disableWeekends.js"></script>         

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>