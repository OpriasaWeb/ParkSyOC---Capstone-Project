<?php
session_start();

require_once './db/pdo.php';

$fname = '';
$age = '';
$cntct_no = '';
$username = '';
$email = '';
$password = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $fname = $_POST['fullname'];
  $age = $_POST['age'];
  $cntct_no = $_POST['cntct_no'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $register = $_POST['register'];
  

  $statement = $pdo->prepare("INSERT INTO parkadmin (fname, age, cntct_no, username, psswrd, email)
  VALUES (:fname, :age, :cntct_no, :username, :psswrd, :email) ");

  $statement->bindValue(':fname', $fname);
  $statement->bindValue(':age', $age);
  $statement->bindValue(':cntct_no', $cntct_no);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':psswrd', $password);
  $statement->bindValue(':email', $email);
  $statement->execute();
  header('Location: dashboard.php');

  if($statement){
    $_SESSION['message'] = "Registered successfully! You can now access ParkSyOC";
    header('Location: login.php');
    exit(0);
  } elseif(empty($statement)){
    $_SESSION['message'] = 'All must be completed please.';
    header('Location: register.php');
    exit(0);
  } else{
    $_SESSION['message'] = "Failed to register. Please try again.";
    header('Location: register.php');
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
  <link rel="stylesheet" href="./public/login.css">
  <title>ParkSyOC register</title>


</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="right-side">
          <h2 class="h2">Registration page</h2>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Full name</label>
              <input type="text" name="fullname" class="form-control" id="exampleFormControlInput1" placeholder="full name">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Age</label>
              <input type="text" name="age" class="form-control" id="exampleFormControlInput1" placeholder="age">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Contact number</label>
              <input type="text" name="cntct_no" class="form-control" id="exampleFormControlInput1" placeholder="#">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="username">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="email">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
            </div>
            <button class="btn btn-outline-success" type="submit" name="register">Register</button>
            <a href="./dashboard.php" class="btn btn-outline-danger" name="cancel">Cancel</a>
          </form>
        </div>
      </div>
      <div class="col-6">
        <img src="./images/Parking-amico.png" alt="">
      </div>
    </div>
  </div>
</body>
</html>