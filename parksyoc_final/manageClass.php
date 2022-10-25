<?php
// Session
session_start();

require_once "./db/pdo.php";

// DELETE code
if(isset($_POST['delete'])){
  $sql = "DELETE FROM vehicle_class WHERE id = :id";
  // echo "<pre>\n$sql\n</pre>\n";
  $statement = $pdo->prepare($sql);
  $statement->execute(array(
    ':id' => $_POST['id']
  ));

}

$statement = $pdo->query("SELECT id, class_name FROM vehicle_class");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


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
  <title>ParkSyOC - Add Category</title>
</head>
<body>
  <!-- Navigation -->
  <?php include_once "./views/nav.php"; ?>
  <!-- Navigation section -->

  <div class="jumbutron-section">
    <div class="mt-4 p-5 bg-success text-white rounded">
      <h1>Manage class section</h1>
      <p>This where you can edit and delete the vehicle class</p>
    </div>
  </div>
  
  <!-- Manage vehicle section -->
  <div class="container">
    <!-- Session message -->
    <?php if(isset($_SESSION['message'])): ?>
      <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>

      <!-- Session message 2 -->
    <?php if(isset($_SESSION['message'])): ?>
      <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
    <?php 
      unset($_SESSION['message']);
      endif; 
    ?>


    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Class</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($rows as $i => $row): ?>
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $row['class_name'] ?></td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <a href="./editClass.php?<?php echo "userid=" . $row['id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                <a href="./manageClassDelete.php?<?php echo "classId=" . $row['id'] ?>" class="btn btn-sm btn-outline-danger" name="delete">Delete</a>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  


  <!-- Modal -->
  <?php include_once "./views/modal.php"; ?>

  

  <br>
  <br>
  <br>
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