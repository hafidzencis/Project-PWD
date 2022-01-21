<?php
session_start();
include '../dbconnect.php';
include '../functions.php';
if (!isset($_SESSION['loged'])) {
    echo "<script> alert('Login First!')
    document.location.href='../login.php';
    </script>";
  }

$idpem = $_GET['id'];
if (isset( $_POST["update"])) {
    $productinfo = $_POST['status'];
    $result = mysqli_query($conn,"UPDATE pembelian SET status = '$productinfo' WHERE idpembelian = $idpem");
    if (mysqli_affected_rows($conn) == 1) {
        echo "<script>alert('Status has been change');
        document.location.href='purchasing.php';
          </script>";        
    }
}

$arr = [];
$bayar = query("SELECT * FROM pembayaran WHERE  idpembelian = '$idpem' ");

foreach ($bayar as $res) {
    $arr[] = $res;
}

$cek = [];
$sudah = query("SELECT * FROM pembelian WHERE idpembelian = '$idpem'");
foreach ($sudah as $k) {
    $cek[] = $k;
}

?>

<!-- <script>alert('Status has been change');</script> -->

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
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
           
            <li class="nav-item dropdown no-arrow mx-1">
            
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
           
              </div>
            </li>
 
            </li>
            
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Purchasing Info</h1>
           
          </div>

          
         
            <!-- Invoice Example  -->
            <div class="col-xl-12 col-lg-7 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                 
                </div>
                <div class="table-responsive">
                  <table class="table  align-items-center table-flush">
                    <thead class="thead-light ">
                      <tr>
                        <th>Name</th>
                        <th>Bank </th>
                        <th>Date </th>
                        
                        <th>Image</th>
                        <?php if ($cek[0]['status'] != 'Product has arrived' ) { ?>
                        <th>Update Status</th>
                        <th>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($arr as $prod ) { ?>
                            
                      <tr>
                        <td><?= $prod['nama'] ?></td>

                        <td> <?= $prod['bank'] ?></td>
                        
                        <td> <?= $prod['tanggal'] ?></td>
                        <td> <img src="../img/<?= $prod['bukti'] ?>" alt=""></td>
                        <?php } ?>

                        <?php if ($cek[0]['status'] != "Product has arrived" ) { ?>
                        <td><div class="d-flex  mr-4"><div class="form-group">
                       <form action="" method="post">

                      <select name="status" class="form-control">
                        
                        <option value="Product has been shipped">
                        Product has been shipped
                        </option>
                        <option value="Product is on the way">
                        Product is on the way
                        </option>
                        <option value="Product has arrived">
                        Product has arrived
                        </option>
                        
                        </td>   
                        <td><button type="submit" name="update" class="btn btn-primary"> Update</button> </td>
                        <?php } ?>
                      </tr>
                            
                      </form>
  
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          
          <!--Row-->

        

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