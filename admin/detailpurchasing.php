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
            <h6 class="collapse-header">Forms</h6>
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          
         
            <!-- Invoice Example  -->
  
        <div class="container py-5 ">
            <div class="row text-center py-3 d-flex justify-content-center">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1"> Buy Details </h1>
                </div>
            </div>
            <?php 
                $total = query("SELECT * FROM pembelian JOIN login ON pembelian.iduser = login.iduser
                WHERE pembelian.idpembelian = '$_GET[id]' ");
                foreach ($total as $key) {
                    
                    ?>
                
         
            <div class="row ">
                <div class="col-6 alert alert-info">
                    <h4>Details Costumer</h4>
                    <strong>Name :<?=$key['nama'] ?><br>
                        Email : <?= $key['email']?><br>
                        Phone Number : <?= $key['notelpon']?>
                    </strong>
                </div>
                <div class="col-6 alert alert-info">
                    <h4>Detail Invoice</h4>
                    <strong>
                        Buys Date :  <?= $key['tanggal_pembelian']?> <br>
                        Send to :  <?= $key['alamat']?> <br>
                        Cost Postage :  <?= "Rp. ", number_format($key['tarif'],"2",",",".")  ?><br>
                        Total Cost : <?= "Rp. ", number_format($key['total_pembelian'],"2",",",".")  ?>
                    </strong>
                </div>

            </div>
            <div class="row">
                <center>
                    <table class="table mb-5">
                        <thead >
                        <tr>
                            <th>Number</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Weight(Kg)</th>
                            <th>Amount </th>
                            <th>Total Weight (Kg)</th>
                            <th>Total Price </th>
                        </tr>
                        </thead>
                        <?php
                            $totalprice= 0 ;
                            $amount = 0 ;
                            $weight = 0;
                            $num = 1;
                            $cart = query("SELECT * FROM pembelian_produk WHERE idpembelian='$_GET[id]'");
                            foreach ($cart as $cartdata) {  

                
                        ?>
                        <tbody>

                        <tr>
                           
                            <td><?= $num;?></td>
                            <td><?= $cartdata['nama'] ?></td>
                            <td><?= "Rp. ",number_format($cartdata['harga'],2,",",".")?></td>
                            <td><?= $cartdata['berat']?></td>
                            <td><?= $cartdata['jumlah'] ?></td>
                            <td><?= $cartdata['totalberat'] ?></td>
                            <td><?= "Rp. ",number_format($cartdata['totalharga'],2,",",".")?></td>

                            

                        </tr>
                        <?php   $num++;
                              
                                } 
                            
                            ?>
                            
                        <tr>
                            <td colspan="6">Total Shopping</td>
                          
                           
                            <td> <strong><?= "Rp. ", number_format($key['total_pembelian'],"2",",",".")  ?> </strong></td>
                
                        </tr>
                       
                        </tbody>
                    </table>
                    <form action="" method="POST" >
                        <div class="row">
                            <div class="col-md-7">
                                <div class="alert alert-primary">
                                    <p> <b> Made Payment Rp. <strong> <?= number_format($key['total_pembelian'],"2",",",".")?> </strong>
                                        <h5> BANK BNI 696 - 1234567 - 99999  AN. Zenchis </h5>
                                    </p> 
                                </div>
                            </div>
                    
                            </div> 
                            <br>
                         
                        </div>
                   
                        <br><br>
                    
                            <?php
                    }
                ?>
                    </form>
                </center>
            </div>
        </div>

          
          <!--Row-->

          <div class="row">
            <div class="col-lg-12 text-center">
              <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
            </div>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <br>
      <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div>
      </footer> -->
      <!-- Footer -->
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