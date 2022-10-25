<?php 
session_start();

require_once "./db/pdo.php"; 

$statement = $pdo->prepare("SELECT * FROM membership WHERE id = :id");
$statement->execute(array(
  ':id' => $_GET['member_id']
));
$rows = $statement->fetch(PDO::FETCH_ASSOC);

$appntmnt_dt = htmlentities($rows['appntmnt_date']);


if(isset($_POST['confirmed'])){
  $getMmbrId = $_GET['member_id'];

  $appntmnt_stts = $_POST['appntmnt_stts'];


  $sql_mmbr = "UPDATE membership SET appntmnt_stts = :appntmnt_stts WHERE id = $getMmbrId";
  $statement = $pdo->prepare($sql_mmbr);
  $statement->bindValue(':appntmnt_stts', $appntmnt_stts);
  $statement->execute();
  header('Location:appntmntMember.php');

  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = "Hi, your membership registration is confirmed. \nFee: 100 pesos \nOffice hours only, see you on $appntmnt_dt. Thank you! \n-Admin.";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  if($statement){
    $_SESSION['message'] = "Appointment confirmed!";
    header('Location:./appntmntMember.php');
    exit(0);
  } else{
      $_SESSION['message'] = "Ooops. Please try again.";
      header('Location:./appntmntMember.php');
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
  <title>Confirmation</title>
</head>
<body>
  <div class="container text-center ">
    <div class="card mt-10">
      <div class="card-header">
        ParkSyOC
      </div>
      <div class="card-body">
        <i class="fas fa-check-circle text-success fs-1"></i>
        <p class="card-text">Confirm registration?</p>
        <form action="" method="post">
          <input type="hidden" name="appntmnt_stts" value="confirmed">
          <a href="./pendingMmbrship.php" class="btn btn-sm btn-outline-primary">Cancel</a>
          <button class="btn btn-sm btn-outline-success" name="confirmed">Confirm</button>
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