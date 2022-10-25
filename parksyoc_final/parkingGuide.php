



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
  <!-- DATA TABLES CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <!-- BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS -->
  <link rel="stylesheet" href="./public/index.css">
  <title>Parking guide - ParkSyOC</title>
</head>
<body>
  <!-- Carousel images -->
  <div class="container" id="carousel">
    <h2 class="text-center">Parking guide</h2>
    <p class="fs-6 text-center">ParkSyOC are made by the IT students in Olivarez College relating to their capstone subject.</p>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item">
          <img src="./images/parking1.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking10.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking11.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking12.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/parking13.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/motor1.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/motor2.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/bicycle.jpg" class="d-block w-100 rounded" id="image">
          <div class="carousel-caption d-md-block" id="pguide">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <!-- <div class="carousel-item">
          <img src="./images/parking14.jpg" class="d-block w-100 rounded" id="image">
        </div> -->
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>



  <!-- Footer -->
  <?php include_once "./views/footer.php"; ?>
  <!-- Footer section -->


  <!-- local JS / jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- <script src="./js/countdown.js"></script> -->

  <!-- DATA TABLES cdn -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- BOOTSTRAP JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- BOXICONS -->
  <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
</body>
</html>