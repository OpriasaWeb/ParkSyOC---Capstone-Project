<?php
// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "parksyoc";

// $conn = new mysqli($server, $username, $password, $dbname);

// if($conn->connect_error){
//   die("Connection failed." . $conn->connect_error);
// }


// if(isset($_POST['qr'])){
//   $qr = $_POST['qr'];
//   $getOut = date('H:i:s');

//   $sql = "UPDATE add_vehicle SET getOut = $getOut WHERE id = $qr";

  // $sql = "INSERT INTO add_vehicle(id, getOut) VALUES ('$qr', NOW())";

//   if($conn->query($sql) === TRUE){
//     echo "Successfully inserted";
//   } else{
//     echo "Error : " . $sql . "<br>" . $conn->error;
//   }
  // header("Location: qrScanner.php");

  // $statement2 = $pdo->prepare($sql);
  // $statement2->bindValue(':getOut', $getOut);
  // $statement2->execute();

// }
// $conn->close();

require_once './db/pdo.php';

$statement2 = $pdo->query("SELECT id FROM vehicle_class");
$statement2->execute();
$rows = $statement2->fetch(PDO::FETCH_ASSOC);



?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- JS -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/styles.css">

  <title>QR code - ParkSyOC</title>
</head>
<body>
  <div class="container">
    <div class="text-center">
      <h1>ParkSyOC</h1>
      <p>Hi, thank you for parking. Now, scan your qr code from the receipt given upon entering in the premises.</p>
    </div>
    <div class="row">
      <div class="col-md-6 mt-5">
        <video class="rounded" src="" id="preview" width="100%" height="120%"></video>
      </div>
      <div class="col-md-6 mt-5">
        <form action="qrInsert.php" method="POST" id="insert" class="form-horizontal">
          <label for="">QR code scanning here!</label>
          <input type="text" name="qr" id="text" readonly="" placeholder="Scan QR code" class="form-control">
        </form>
        <p>Here is the price of your parking:</p>
        <!-- <h5 class="fs-1 text-center">50 pesos</h5> -->
      </div>
    </div>
  </div>



  <script type="text/javascript">
      var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content, image) {
        console.log(content);
      });
 
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else{
          alert('No camera found.');
        }
      }).catch((e) => {
        console.error(e);
      });

      scanner.addListener('scan', (c) => {
        document.getElementById('text').value = c;
        document.forms[0].submit();
        
      });


      // Auto-refresh website
      // window.setInterval('refresh()', 20000); // Call a function every 10000 miliseconds

      // Refresh or reload the page
      // function refresh(){
      //   window.location.reload();
      // }
      
  </script>
</body>
</html>