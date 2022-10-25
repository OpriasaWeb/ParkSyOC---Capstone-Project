<?php
// Session start
session_start();

require_once "./db/pdo.php";

// "SELECT * FROM vehicle_details";
// "SELECT * FROM vehicle_class";

$queriesId = $_GET['queriesId'];
$statement2 = $pdo->query("SELECT mssg_queries, mssg_name FROM messages WHERE message_id = '$queriesId' ");
$statement2->execute();
$rows2 = $statement2->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['confirm'])){
  $queriesId = $_GET['queriesId'];
  $reply = $_POST['reply'];

  $confirm_stts = "Confirmed";
  
  // Update time_in
  $sql = "UPDATE messages SET mssg_confirmation = :confirmed, mssg_reply = :reply WHERE message_id = '$queriesId' ";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':confirmed', $confirm_stts);
  $statement->bindValue(':reply', $reply);
  $statement->execute();
  header('Location:queries.php');

  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = $reply;
  $sender = "From:parksyoc@gmail.com";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  if($statement){
    $_SESSION['message'] = "Message confirmed!";
    header('Location:./queries.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Ooops. Please try again.";
    header('Location:./queries.php');
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
  <title>ParkSyOC - Add vehicle</title>
</head>
<body>

  <!-- Jumbotron section -->
  <div class="jumbutron-section">
    <div class="mt-2 p-4 bg-success text-white rounded">
      <h1>Message queries confirmation</h1>
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


  <div class="container text-center mt-5">
    <div class="card mt-10">
      <div class="card-header">
        ParkSyOC
      </div>
      <div class="card-body">
        <p>
          <?php
          echo "<b>";
          echo "From: " . "</b>" 
          . $rows2['mssg_name'] . "\n" ?></p>
        <p>
          <?php 
          echo "<b>";
          echo "Messages: " . "</b>"  
          . $rows2['mssg_queries'] ?>
        </p>
        <form action="" method="POST">
          <i class="fas fa-check-circle text-success fs-1 mt-5"></i>
          <p class="card-text">Have you read the message?</p>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Reply from Admin:</label>
            <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button class="btn btn-sm btn-outline-success mt-2" name="confirm">Confirm</button>
          <a href="./queries.php" class="btn btn-sm btn-outline-primary mt-2">Cancel</a>
        </form>
      </div>
    </div>
    
    <img src="./images/Parking-pana.png" class="img-fluid" width="500" height="500">
  </div>
  
  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->






  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./js/main.js"></script>

</body>
</html>