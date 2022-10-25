<?php

// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "parksyoc";

// $conn = new mysqli($server, $username, $password, $dbname);

// if($conn->connect_error){
//   die("Connection failed." . $conn->connect_error);
// }

require_once './db/pdo.php';



if(isset($_POST['qr'])){
  $qr = $_POST['qr'];
  $getOut = date('H:i:s');
  $getIn = date('H:i:s');
  $out_time = date('Y-m-d H:i:s');
  $cstmr_stat = "Out";

  $sql = "UPDATE add_vehicle SET getOut = :getOut, out_time = :vhcl_out, cstmr_stts = :cstmr_stts WHERE id = $qr";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(':getOut', $getOut);
  $statement->bindValue(':vhcl_out', $out_time);
  $statement->bindValue(':cstmr_stts', $cstmr_stat);
  $statement->execute();

  // $sql = "INSERT INTO add_vehicle(id, getOut) VALUES ('$qr', NOW())";

  // if($conn->query($sql) === TRUE){
  //   echo "Successfully inserted";
  // } else{
  //   echo "Error : " . $sql . "<br>" . $conn->error;
  // }


  $statement1 = $pdo->prepare("SELECT * FROM add_vehicle WHERE id = $qr");
  $statement1->execute();

  $rows = $statement1->fetch(PDO::FETCH_ASSOC);

  $gettingIn = $rows['getIn'];
  $gettingOut = $rows['getOut'];
  $cstmr_type = $rows['cstmr_type'];


  $inTime = strtotime($gettingIn);
  $outTime = strtotime($gettingOut);

  $timeDiff = number_format(($outTime - $inTime) / 60);



  if($cstmr_type == "Member"){
    echo $timeDiff = "Member - free";
  } else if($cstmr_type == "Hospital"){
    echo $timeDiff = "Hospital - free";
  }
  else if($timeDiff <= 120){
    echo $timeDiff = 20;
  } else if($timeDiff > 120 & $timeDiff < 240){
    echo $timeDiff = 30;
  } else if($timeDiff >= 240 & $timeDiff < 360){
    echo $timeDiff = 40;
  } else if($timeDiff >= 360 & $timeDiff < 480){
    echo $timeDiff = 50;
  } else if($timeDiff >= 480 & $timeDiff < 600){
    echo $timeDiff = 60;
  } else if($timeDiff >= 600 & $timeDiff < 720){
    echo $timeDiff = 80;
  } else if($timeDiff >= 720 & $timeDiff < 840){
    echo $timeDiff = 90;
  } else if($timeDiff >= 840 & $timeDiff < 960){
    echo $timeDiff = 100;
  } else if($timeDiff >= 960 & $timeDiff < 1080){
    echo $timeDiff = 120;
  } else{
    echo $timeDiff = 150;
  }
  // echo $timeDiff;

  $payment = $timeDiff;

  // $sql1 = "INSERT INTO add_vehicle (payment) VALUES (paym) WHERE id = $qr";

  $sql1 = "UPDATE add_vehicle SET prkng_fee = :prkng_fee WHERE id = $qr";

  $statement2 = $pdo->prepare($sql1);
  $statement2->bindValue(':prkng_fee', $payment);
  $statement2->execute();



  header("Location: qrScanner.php");

  $receiver = "b33333m14@gmail.com";
  $subject = "ParkSyOC system";
  $body = "Hello, here is your payment: $payment";
  $sender = "From:parksyoc@gmail.com";

  if(mail($receiver, $subject, $body, $sender)){ // php function send mail
    echo "Email sent successfully to $receiver";
  } else{
    echo "Sorry, failed while sending mail";
  }

  // $statement2 = $pdo->prepare($sql);
  // $statement2->bindValue(':getOut', $getOut);
  // $statement2->execute();

}







?>