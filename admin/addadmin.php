<?php
session_start();
include '../dbconnect.php';
include '../functions.php';

if (!isset($_SESSION['loged'])) {
  echo "<script> alert('Login First!')
  document.location.href='../login.php';
  </script>";
}
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $pass = $_POST['password']; 
    $role = 'Admin';

    $band = query("SELECT * FROM login where email = '$email'");
    foreach ($band as $ba ) {
      $emba = $ba['email'];
      $nohp = $ba['notelpon'];
    }

    if ($emba == $email) {
      echo"<script> alert('Email has been available');
        document.location.href='admin.php';</script> ";

    } elseif ( $nohp == $telp) {
      echo"<script> alert('Phone number has been available');
        document.location.href='admin.php';</script> ";
    }  else {
      $result = mysqli_query($conn,"INSERT INTO login (nama,email,password,notelpon,alamat,role) 
      VALUES ('$nama','$email','$pass','$telp','$alamat','$role' )");
      if (mysqli_affected_rows($conn) > 0) {
          echo "<script> alert('Success adding admin');
          document.location.href='admin.php';
          </script> ";
      } else {
          echo"<script> alert('Failed adding admin');
          document.location.href='admin.php';</script> ";
      }
    }

  
   
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Hobby Fish Shop</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexadmin.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo3.png">
        </div>
        <!-- <div class="sidebar-brand-text mx-3">RuangAdmin</div> -->
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Back To Shop</span></a>
      </li>
     
      <li class="nav-item active">
        <a class="nav-link" href="costumer.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Costumer</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Admin</span></a>
      </li>
      <li class="nav-item active  ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Manage</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage</h6>
            <a class="collapse-item" href="categories.php">Categories</a>
            <a class="collapse-item" href="item.php">Product</a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="purchasing.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Purchasing</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="paymentreport.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Payment report</span></a>
      </li>
      <li class="nav-item active">
         <a class="nav-link" href="feedback.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Feedback</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../logout.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Log Out</span></a>
      </li>
    
    </ul>
    <!-- Sidebar -->
    <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center mb-1 py-5">
            <h1 class="h3 mb-4text-gray-800">Category</h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <div class="row center">
            <div class="col-xl-12 col-lg-7 mb-46">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="form-group">
                      <label for="admin">Name </label>
                      <input type="text" name="nama" class="form-control" id="admin" aria-describedby="emailHelp"
                        placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="admin">Email </label>
                      <input type="text" name="email" class="form-control" id="admin" aria-describedby="emailHelp"
                        placeholder="email">
                    </div>
                    <div class="form-group">
                      <label for="admin">Password </label>
                      <input type="password" name="password" class="form-control" id="admin" aria-describedby="emailHelp"
                        placeholder="password">
                    </div>
                    <div class="form-group">
                      <label for="admin">Phone Number </label>
                      <input type="text" name="telp" class="form-control" id="category" aria-describedby="emailHelp"
                        placeholder="phone number">
                    </div>
                    <div class="form-group">
                      <label for="admin">Address </label>
                      <input type="text" name="alamat" class="form-control" id="category" aria-describedby="emailHelp"
                        placeholder="address">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
  <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>