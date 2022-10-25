<?php
session_start();

require_once './db/pdo.php';
require_once 'phpqrcode/qrlib.php';

// QR code
$path = 'images/qr/';
$file = $path.uniqid().".png";

// Text or result to output
$text = $_GET['vehicle_id'];


QRcode::png($text, $file, 'S', 3, 2);

$statement = $pdo->query("SELECT * FROM vehicle_class");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$rmrks = '';

if(isset($_POST['update'])){
  $vid = $_GET['vehicle_id'];
  $rmrks = $_POST['remarks'];
  $stts = $_POST['status'];
  $out_time = date('Y-m-d H:i:s');
  $getOut = date('H:i:s');

  $sql = "UPDATE add_vehicle SET remarks = :rmrks, cstmr_stts = :stts, out_time = :vhcl_out, getOut = :getOut WHERE id = $vid";
  $statement2 = $pdo->prepare($sql);
  $statement2->bindValue(':rmrks', $rmrks);
  $statement2->bindValue(':stts', $stts);
  $statement2->bindValue(':vhcl_out', $out_time);
  $statement2->bindValue(':getOut', $getOut);
  $statement2->execute();


  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = "Thank you for parking!. \n -ParkSyOC";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  if($statement2){
    $_SESSION['message'] = "Updated successfully!";
    header('Location:./manageOut.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Failed to update. Please try again.";
    header('Location:./manageOut.php');
    exit(0);
  }

  header('Location: manageOut.php');
}

$statement3 = $pdo->prepare("SELECT * FROM add_vehicle WHERE id = :vhl_id");
$statement3->execute(array(
  ':vhl_id' => $_GET['vehicle_id']
));
$rows2 = $statement3->fetch(PDO::FETCH_ASSOC);

$vhcl_cat = htmlentities($rows2['vhcl_type']);
$cstmr_type = htmlentities($rows2['cstmr_type']);
$plt_no = htmlentities($rows2['plate_no']);
$ownr_nm = htmlentities($rows2['ownr_name']);
$cntc_no = htmlentities($rows2['cntct_no']);
$time_in = htmlentities($rows2['time_in']);
$stts = htmlentities($rows2['cstmr_stts']);
$prkng_fee = htmlentities($rows2['prkng_fee']);




// <==== STATUS part ====>
// <?php
//   if($row['Status'] == ""){
//     echo "Vehicle in";
//   }
//   if($row['Status'] == "Out"){
//     echo "Vehicle out";
//   }

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
  <title>ParkSyOC - View Incoming Vehicle details</title>
</head>
<body>


  <div class="container-fluid">
    <div class="jumbutron-section">
      <div class="mt-4 p-5 bg-success text-white rounded">
        <h1>Incoming vehicle details</h1>
        <p>This where you can view and edit the details of the vehicle at the same time.</p>
      </div>
    </div>
  </div>
  <br>

  <!-- Go back -->
  <div class="container">
    <a href="./manageIn.php" class="btn btn-secondary"><i class="fas fa-hand-point-left"></i> Go back to manage incoming</a>
  </div>
  
  
  <!-- Manage vehicle section -->
  <div class="container mt-3">
    <h2>View incoming vehicle details</h2>           
    <table class="table table-hover">
      <tbody>
        <tr>
          <td class="bold">Vehicle category</td>
          <td><?= $vhcl_cat ?></td>
        </tr>
        <tr>
          <td class="bold">Customer type</td>
          <td><?= $cstmr_type ?></td>
        </tr>
        <?php
          if($cstmr_type == "Guest"){
            echo '<tr><td class="bold">';
            echo 'Parking fee</td>';
            echo '<td>';
            echo $prkng_fee;
            if($prkng_fee == ''){
              echo '<b>Forgot to input...</b>';
            }
            echo '</td></tr>';
          } 
          
        ?>
        <tr>
          <td class="bold">Plate number</td>
          <td><?= $plt_no ?></td>
        </tr>
        <tr>
          <td class="bold">Owner name</td>
          <td><?= $ownr_nm ?></td>
        </tr>
        <tr>
          <td class="bold">Contact number</td>
          <td><?= $cntc_no ?></td>
        </tr>
        <tr>
          <td class="bold">Time in</td>
          <td><?= $time_in ?></td>
        </tr>
        <tr>
          <td class="bold">
            Status
          </td>
          <td>
            <?php
              if($stts == "In"){
              echo "Vehicle in";
              }
              if($stts == "Out"){
                echo "Vehicle out";
              }
            ?>
          </td>
        </tr>
      
      </tbody>
      
    </table>
  </div>



  <div class="container">
    <form action="" method="POST">
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Remarks:</label>
        <textarea class="form-control" name="remarks" id="exampleFormControlTextarea1" rows="3"><?php echo $rmrks ?></textarea>
      </div>
      <!-- <div class="mb-3" style="display: none;">
        <label for="exampleFormControlInput1" class="form-label">Parking fee</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="parking-charge" placeholder="Fee">
      </div> -->
      <div class="input-group">
        <label for="exampleFormControlInput1" class="form-label">Status</label>
        <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="status">
          <option selected value="Out">Outgoing vehicle</option>
        </select>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" name="update" class="btn btn-primary">Update!</button>
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