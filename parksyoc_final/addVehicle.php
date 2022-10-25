<?php
// Session start
session_start();

require_once "./db/pdo.php";

// "SELECT * FROM vehicle_details";
// "SELECT * FROM vehicle_class";


$statement2 = $pdo->query("SELECT * FROM add_vehicle");
$statement2->execute();
$rows2 = $statement2->fetch(PDO::FETCH_ASSOC);





$errors = [];
$plt_number = '';
$ownr_name = '';
$cntct_no = '';
$vhcl_select = '';
// add 2
$cstmr_select = '';
$prkng_fee = '' ?? null;

// POST METHOD
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $vhcl_type = $_POST['vhcl_type'];
  $cstmr_select = $_POST['cstmr'];
  $plt_number = $_POST['pltnumber'];
  $ownr_name = $_POST['ownrname'];
  $cntct_no = $_POST['cntctno'];
  $time_in = date('Y-m-d H:i:s');
  $prkng_fee = $_POST['p_fee'];

  if(!$plt_number){
    $errors[] = 'Vehicle platenumber is required.';
  }

  if(!$cntct_no){
    $errors[] = 'Contact number is required.';
  }

  $statement = $pdo->prepare("INSERT INTO add_vehicle (vhcl_type, cstmr_type, plate_no, ownr_name, cntct_no, time_in, prkng_fee)
  VALUES(:vhcl_type, :cstmr_type, :plate_no, :ownr_name, :cntct_no, :time_in, :prkng_fee)");

  $statement->bindValue(':vhcl_type', $vhcl_type);
  $statement->bindValue(':cstmr_type', $cstmr_select);
  $statement->bindValue(':plate_no', $plt_number);
  $statement->bindValue(':ownr_name', $ownr_name);
  $statement->bindValue(':cntct_no', $cntct_no);
  $statement->bindValue(':time_in', $time_in);
  $statement->bindValue(':prkng_fee', $prkng_fee);
  $statement->execute();
  header('Location: manageIn.php');

  if($statement){
    $_SESSION['message'] = "Added successfully!";
    header('Location:./manageIn.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Failed to add. Please try again.";
    header('Location:./manageIn.php');
    exit(0);
  }
}

// <?php
//           foreach($rows as $i => $row):
//         <option value="<?php  "><?php echo $row['class_name'] </option>
// <?php endforeach; 

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
  <title>ParkSyOC - Add vehicle</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <!-- Jumbotron section -->
  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Add vehicle section</h1>
      <p>This where you can add an upcoming vehicle.</p>
    </div>
  </div>
  <!-- Jumbotron section -->

  <!-- Add vehicle section -->
  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error): ?>
        <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="container">
    <form action="" method="POST">
      <div class="add-vehicle">
        <h4>Choose vehicle class</h4>
        <select class="form-select" id="inputGroupSelect01" name="vhcl_type">
          <option value="1">Choose...</option>
        <?php
          $statement3 = $pdo->query("SELECT class_name FROM vehicle_class");
          while($rows = $statement3->fetch(PDO::FETCH_ASSOC))
          {
        ?>
          <option value="<?php echo $rows['class_name'] ?>"><?php echo $rows['class_name'] ?></option>
        <?php 
          }
        ?>
        <!-- Choose vehicle class section -->
          
        </select>
        <!-- Choose vehicle class section -->

        <!-- Customer types - radio buttons -->
        <div class="radio-button">
          <div class="row">
            <div class="col-3 m-2">
              <h5>Customer type</h5>
            </div>
            <div class="col-9 m-2">
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="cstmr" id="cstmr1" autocomplete="off" value="Member" onclick="showFee(0)">
                <label class="btn btn-outline-primary" for="cstmr1">Member</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr2" autocomplete="off" value="Hospital" onclick="showFee(1)">
                <label class="btn btn-outline-primary" for="cstmr2">Hospital</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr3" autocomplete="off" value="Guest" onclick="showFee(2)">
                <label class="btn btn-outline-primary" for="cstmr3">Guest</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr4" autocomplete="off" value="VIP" onclick="showFee(3)">
                <label class="btn btn-outline-primary" for="cstmr4">VIP</label>
              </div>
            </div>
          </div>
        </div>

        
          <!-- <input type="radio" name="cstmr" id="cstmr1" value="Member" onclick="showFee(0)">
          <label for="cstmr1">Member</label>
          <input type="radio" name="cstmr" id="cstmr2" value="Hospital" onclick="showFee(1)">
          <label for="cstmr2">Hospital</label>
          <input type="radio" name="cstmr" id="cstmr3" value="Guest" onclick="showFee(2)">
          <label for="cstmr3">Guest</label>
          <input type="radio" name="cstmr" id="cstmr4" value="VIP" onclick="showFee(3)">
          <label for="cstmr4">VIP</label> -->
        
        

        <!-- Customer types - radio buttons -->
        
        <div class="input-data">
          <div class="form-group" id="customerFee">
            <label for="usr">Fee</label>
            <input type="text" name="p_fee" class="form-control" placeholder="Parking fee" id="usr" aria-describedby="button-addon1" value="<?php echo $prkng_fee ?>">
          </div>

          <div class="input-group mb-3">
            <label>Plate number</label>
            <input type="text" name="pltnumber" class="form-control" placeholder="P-no." aria-label="" aria-describedby="button-addon2" value="<?php echo $plt_number ?>">
          </div>

          <div class="input-group mb-3">
            <label>Owner name</label>
            <input type="text" name="ownrname" class="form-control" placeholder="Name" aria-label="" aria-describedby="button-addon3" value="<?php echo $ownr_name ?>">
          </div>

          <div class="input-group mb-3">
            <label>Contact number</label>
            <input type="text" name="cntctno" class="form-control" placeholder="No.#" aria-label="" aria-describedby="button-addon4" value="<?php echo $cntct_no ?>">
          </div>
        </div>
        

        <!-- <div class="input-group mb-3">
          <label>Member/guest</label>
          <input type="text" class="form-control" placeholder="No.#" aria-label="" aria-describedby="button-addon2">
        </div> -->

        <div class="button-sbmt">
          <button class="btn btn-outline-primary mx-auto" type="submit" id="button-addon2">Incoming vehicle</button>
        </div>
      </div>
    </form>
  </div>
  
  
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
  
  <!-- Add vehicle section -->

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  
  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>

</body>
</html>