<?php 
session_start();
require_once './db/pdo.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $fname = $_POST['fname'];
  $vhcl_type = $_POST['vhcl_type'];
  $plt_no = $_POST['plt_no'];
  $member_email = $_POST['email'];
  $cntct_no = $_POST['cntct_no'];
  $appntmnt_date = $_POST['appntmnt_date'];
  $messages = $_POST['messages'];
  $mmbrshp_id = $_POST['mmbrshp_id'];
  $mmbr_date = date('m-d-Y');
  $randomId = randomId(7);

  $statement = $pdo->prepare("INSERT INTO membership (fname, vhcl_type, plt_no, email, cntct_no, appntmnt_date, messages, mmbrshp_id) 
  VALUES (:fname, :vhcl_type, :plt_no, :email, :cntct_no, :appntmnt_date, :messages, :mmbrshp_id)");

  $statement->bindValue(':fname', $fname);
  $statement->bindValue(':vhcl_type', $vhcl_type);
  $statement->bindValue(':plt_no', $plt_no);
  $statement->bindValue(':email', $member_email);
  $statement->bindValue(':cntct_no', $cntct_no);
  $statement->bindValue(':appntmnt_date', $appntmnt_date);
  $statement->bindValue(':messages', $messages);
  $statement->bindValue(':mmbrshp_id', $randomId);
  $statement->execute();
  header('Location:pendingMmbrship.php');

  if($statement){
    $_SESSION['message'] = "Added successfully!";
    header('Location:./pendingMmbrship.php');
    exit(0);
  } else{
      $_SESSION['message'] = "Failed to add. Please try again.";
      header('Location:./pendingMmbrship.php');
      exit(0);
  }
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
  <title>ParkSyOC - membership</title>

</head>
<body>
  
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <!-- Jumbotron section -->
  <div class="mt-4 p-5 bg-success text-white rounded">
    <h1>Membership section</h1>
    <p>This is where the users can register and get the appointment receipt and since the admin has the authority to the system, the admin itself can also add and manage the membership parksyoc.</p>
  </div>


  <section class="member-forms mt-5">
    <div class="container">
      <form action="" method="post">
        <div class="form-floating mb-2 mt-2">
          <input type="text" class="form-control" name="fname" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Fullname</label>
        </div>
        <div class="form-floating mb-2">
          <select class="form-select" id="floatingPassword" name="vhcl_type">
            <option value="1"><p style="opacity: 50%;">Choose...</p></option>
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
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="plt_no">
          <label for="floatingPassword">Plate number</label>
        </div>
        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingPassword" placeholder="Password" name="email">
          <label for="floatingPassword">Email</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="cntct_no">
          <label for="floatingPassword">Contact no#</label>
        </div>
        <h6>You can only choose Monday-Friday appointment date. <b>Note:</b> office hours only</h6>

        <div class="form-floating mb-2">
          <input type="date" class="form-control" id="dateControl" placeholder="Password" name="appntmnt_date">
          <label for="floatingPassword">Appointment date</label>
        </div>


        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="messages">
          <label for="floatingPassword">Messages</label>
        </div>
        <input type="hidden" name="mmbrshp_id">
        <button class="btn btn-outline-primary" type="submit">Submit!</button>
        <a href="./dashboard.php" class="btn btn-outline-danger">Cancel</a>
      </form>
      
    </div>
  </section>


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




  <!-- local JS / jQuery -->
  <script src="./js//disableWeekends.js"></script>


  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</body>
</html>