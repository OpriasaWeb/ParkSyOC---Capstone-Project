<?php

session_start();

include "connect.php";
if(isset($_POST["login"])){
  if($_POST['username'] == "" or $_POST["email"] == "" or $_POST["password"] == ""){
    echo "<center><h2>Username, email, password cannot be empty...</h2></center>";
  }else{
    $email = trim($_POST['email']);
    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim(md5($_POST['password'])));
    $query = $db->prepare("SELECT * FROM parkadmin WHERE email = ? AND psswrd = ?");
    $query->execute(array($email, $password));
    $control = $query->fetch(PDO::FETCH_OBJ);

    if($control>0){
      $_SESSION["username"] = $username;
      header("Location:dashboard.php");
    }

    echo "<center><h2>Incorrect password or email...</h2></center>";
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

  <script type="text/javascript">
    function preventBack(){
      window.history.forward()
    };
    setTimeout("preventBack()", 0);
    window.onunload=function(){
      null;
    }
  </script>

  <!-- CSS -->
  <link rel="stylesheet" href="./public/login.css">
  <title>ParkSyOC login</title>


</head>
<body>
  <div class="container-fluid">
    <?php if(isset($_SESSION['message'])): ?>
      <h5 class="alert alert-success text-center"><?= $_SESSION['message']; ?></h5>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>
    <div class="row">
      <div class="col-6">
        <img src="./images/PARKING-1.png" alt="">
      </div>
      <div class="col-6">
        <div class="left-side">
          <h2 class="h2">Welcome to ParkSyOC!</h2>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="" placeholder="username">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="" placeholder="email">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="" placeholder="password">
            </div>
            <button class="btn btn-outline-primary" type="submit" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>
    
    
  </div>
</body>
</html>