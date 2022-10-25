<?php 
session_start();
require_once './db/pdo.php';



$statement = $pdo->query("SELECT * FROM membership");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$fname = $cstmr_type = $vhcl_type = $plt_no = $book_email = $cntct_no = "";
$booking_date = date('Y-m-d');
$booking_time = date('H:i:s');


$bkngDateErr = $bkngTimeErr = $bkngEmailErr = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $fname = test_input($_POST['fname']);
  $vhcl_type = test_input($_POST['vhcl_type']);
  $cstmr_type = test_input($_POST['cstmr']);
  $plt_no = test_input($_POST['plt_no']);

  $imageId = $_FILES['imageId'] ?? null;
  $imageIdentification = '';

  // Valid id or non-valid id
  if($imageId && $imageId['tmp_name']) {
    $imageIdentification = 'images/'.'identification/'.randomString(8).'/'.$imageId['name'];
    
    mkdir(dirname($imageIdentification));
    
    move_uploaded_file($imageId['tmp_name'], $imageIdentification);
  }
  // Valid id or non-valid id

  if(empty($_POST['email'])){
    $bkngEmailErr = "Email is required.";
  } else{
    $book_email = test_input($_POST['email']);
  }

  $cntct_no = test_input($_POST['cntct_no']);

  if(empty($_POST['booking_date'])){
    $bkngDateErr = "Booking date is required.";
  } else{
    $booking_date = test_input($_POST['booking_date']);
  }

  if(empty($_POST['booking_time'])){
    $bkngTimeErr = "Booking time is required.";
  } else{
    $booking_time = test_input($_POST['booking_time']);
  }

  
  $statement2 = $pdo->prepare("INSERT INTO add_vehicle (identification, ownr_name, vhcl_type, cstmr_type, plate_no, email, cntct_no, bkng_dt, bkng_time)
  VALUES (:identification, :ownr_name, :vhcl_type, :cstmr_type, :plate_no, :email, :cntct_no, :bkng_dt, :bkng_time)");

  $statement2->bindValue(':identification', $imageIdentification);
  $statement2->bindValue(':ownr_name', $fname);
  $statement2->bindValue(':vhcl_type', $vhcl_type);
  $statement2->bindValue(':cstmr_type', $cstmr_type);
  $statement2->bindValue(':plate_no', $plt_no);
  $statement2->bindValue(':email', $book_email);
  $statement2->bindValue(':cntct_no', $cntct_no);
  $statement2->bindValue(':bkng_dt', $booking_date);
  $statement2->bindValue(':bkng_time', $booking_time);
  $statement2->execute();
  header('Location:bookingReceipt.php');
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function randomString($n){
  $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str_random = '';

  for($i = 0; $i < $n; $i++){
    $index = rand(0, strlen($characters) - 1);
    $str_random .= $characters[$index];
  }
  return $str_random;
}


$randomId = function($idno){
  $loopChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';

  for($i = 0; $i < $idno; $i++){
    $index = rand(0, strlen($loopChars) - 1);
    $str .= $loopChars[$index];
  }
  return $str;
}

// <?php echo $rows2['cstmr_type']; 

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
  <title>ParkSyOC - book vehicle</title>
</head>
<body>
  <!-- Navigation bar -->

  <!-- Jumbotron section -->
  <div class="mt-4 p-3 bg-success text-white rounded">
    <h1>Book vehicle section</h1>
    <p>This is where the users can register and get the appointment receipt and since the admin has the authority to the system, the admin itself can also add and manage the membership parksyoc.</p>
    <p>Dashboard / Vehicle bookings / Book vehicle</p>
  </div>

  <div class="goback m-5">
    <a href="./index.php" class="btn btn-secondary">Go back home</a>
  </div>


  <section class="member-forms">
    <div class="container">
    
      
      <h3>You can start here</h3>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

        <div class="form-group mt-3">
            <label>Insert your <b>valid or non-valid ID</b> here</label>
            <br>
            <input type="file" name="imageId" required>
        </div>

        <div class="form-floating mt-2 mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="fname" 
          value="" required>
          <label for="floatingPassword">Fullname</label>
        </div>
        <div class="form-floating mb-2">
          <select class="form-select" id="floatingPassword" name="vhcl_type" required>
            <option value=""><p style="opacity: 50%;">Choose...</p></option>
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
          <label for="floatingPassword">Vehicle type</label>
        </div>
        <!-- Customer types - radio buttons -->
        <div class="radio-button">
          <h5>What type of customer are you?</h5>
          <div class="row">
            <div class="col-3 m-2">
            </div>
            <div class="col-9 mb-3">
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          

                <input type="radio" class="btn-check" name="cstmr" id="cstmr2" autocomplete="off" value="Hospital" onclick="" required>
                <label class="btn btn-outline-primary" for="cstmr2">Hospital</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr3" autocomplete="off" value="Visitor" onclick="" required>
                <label class="btn btn-outline-primary" for="cstmr3">Visitor</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr4" autocomplete="off" value="Employee" onclick="" required>
                <label class="btn btn-outline-primary" for="cstmr4">Employee</label>

                <input type="radio" class="btn-check" name="cstmr" id="cstmr5" autocomplete="off" value="Student" onclick="" required>
                <label class="btn btn-outline-primary" for="cstmr5">Student</label>

                <!-- <input type="radio" class="btn-check" name="cstmr" id="cstmr4" autocomplete="off" value="VIP" onclick="paymentReminder(3)" required>
                <label class="btn btn-outline-primary" for="cstmr4">VIP</label> -->
              </div>
            </div>
          </div>
        </div>
        <div class="form-group mb-2" id="paymentReminder">
            <label for="usr" class="fs-5">A <b>20</b> pesos fee before entering parking.</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="plt_no" value="">
          <label for="floatingPassword">Plate number</label>
          
        </div>
        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingPassword" name="email" value="" required>
          <label for="floatingPassword">Email</label>
          <span class="error"><?php echo $bkngEmailErr ?></span>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cntct_no" value="">
          <label for="floatingPassword">Contact no#</label>
        </div>
        <!-- <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="cstmr_type" value=">
          <label for="floatingPassword">Customer type</label>
        </div> -->
        <div class="form-floating mb-2">
          <input type="date" name="booking_date" id="dateControl" class="form-control" autocomplete="off" required>
          <label for="">Book date</label>
        </div>
        <div class="form-floating mb-2">
          <input type="time" class="form-control" id="timepicker1" name="booking_time" required>
          <label for="floatingPassword">Booking time</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" name="messages" value="">
          <label for="floatingPassword">Messages</label>
        </div>
        <div class="container text-center">
          <button type="submit" name="book" class="btn btn-outline-primary">Book!</button>
          <a href="" class="btn btn-outline-danger">Cancel</a>
        </div>
      </form>
      
        
      
      
    </div>
  </section>





  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>






  
  <!-- local JS / jQuery -->
  <script src="./js//datePicker.js"></script>
  <script src="./js//main.js"></script>


  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>