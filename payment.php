<?php
session_start();
// error_reporting(0);
require "functions.php";

if (!isset($_SESSION['loged'])) {
    echo "<script> alert('Login First!')
    document.location.href='login.php';
    </script>";
}

$namalengkap = explode(" ",$_SESSION['name']);
$namauser = $namalengkap[0];



$idpembelian = $_GET['id'];
$sudahbayar = query("SELECT * FROM pembayaran WHERE idpembelian = '$idpembelian'");


$pemb = query("SELECT * FROM pembelian WHERE idpembelian = '$idpembelian'");

?>  

<!DOCTYPE html>
<html lang="en">

<head>
<title>HFS</title>
<?php
include "head.php";
?>
</head>

<?php
// session_start();


require 'dbconnect.php';

if(isset($_POST['submit']))
	{
        // var_dump($_POST);
       	  
		if (addpayment($_POST) == 1) {
            echo "<script>alert('Thank you for send payment evidence');
            document.location.href='historybuy.php'
            </script>";
            $ubahstatus = mysqli_query($conn,"UPDATE pembelian SET status = 'Already paid' WHERE idpembelian = '$idpembelian'");
            
        }
		
	};
?>


<body>  


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h2 align-self-center" href="index.php">
                Hobby Fish Shop
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <?php
				if(!isset($_SESSION['loged'])){
					echo '
                    <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="daftar.php">Register</a>
                    <a class="nav-link">/</a>
                    <a class="nav-link" href="login.php">Login</a>
                     </li>';
				} else {
					if($_SESSION['role']=='Member'){
					echo 
                    ' <li><a class="nav-link" href="historybuy.php"> Buys History</a>
                    </li>
                    <li> <a class="nav-link"> <b class="text-success">Hello,'.$namauser.'</b></a></li>
                  <li><a class="nav-link text-danger" href="logout.php">LOGOUT</a>
                  </ul>';
					} else {
					echo ' <li><a class="nav-link" href="historybuy.php"> BuysHistory</a>
                    </li>
                   <li>  <a class="nav-link h3" href="admin/indexadmin.php">  ADMIN EDIT </a></li> 
                   <li>  <a class="nav-link text-danger" href="logout.php">LOGOUT</a>
                     </li> </ul>';
					
					};                
                }
                
				?>

                </div>
                <div class="navbar align-self-center d-flex">
                <a class="nav-icon position-relative text-decoration-none" href="cart.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <form action="search.php" method="get">    
                        <div class="d-flex">
                            <input type="text" name="keyword" class="form-control" autocomplete="off"> 
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->


  
    <!--form pendaftaran-->
    
    <div class="container py-5">
    <div class="mb-5 pt-5">
                <div class="d-flex align-item-center justify-content-center pt-5 pb-3">
                <h2 class="text-success"> Payment Confirm </h2>
                <br>
            
                </div>
                <?php foreach ($pemb as $dat )   {?>
                <h4 class="h4 text-danger d-flex align-item-center justify-content-center 2 pb-3">Total bill <?= number_format($dat['total_pembelian'],2,",",".") ?></h4>
                <?php } ?>  

                <div class="d-flex align-items-center justify-content-center pt-2 pb-5">
            
                    <div class="justify-content-center">
                        <div class="input-group mb-5 pb-5">

                <?php
                    if (($sudahbayar)) {
                        foreach ($sudahbayar as $sb) { ?>
                            
                            <form method="post" enctype="multipart/form-data">
                               
                                <input type="hidden" name="idpem" value="<?= $idpembelian ?>" >
                                <input type="hidden" name="date" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d"); ?>" >
                                
                                <input type="text" class="form-control bg-light border-light mb-4" name="nama" placeholder="Depositor Name" required value="<?=$sb['nama']?>" id="nama" required width="10"> 
                                
                                <input type="text" class="form-control bg-light border-light mb-4" name="bank" placeholder="Bank" required value="<?=$sb['bank']?>" required maxlength="13"> 

                                <img src="img/<?= $sb["bukti"] ?>" alt="Gambar Mahasiswa" width="500px">
                               
                                
                         
                               
                            </form>
                    <?php }
                        }
                     else { ?>

                          <form method="post" enctype="multipart/form-data">
                       
                          <input type="hidden" name="idpem" value="<?= $idpembelian ?>" >
                          <input type="hidden" name="date" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d"); ?>" >
                          
                          <input type="text" class="form-control bg-light border-light mb-4" name="nama" placeholder="Depositor Name" required  id="nama" required width="10"> 
                          
                          <input type="text" class="form-control bg-light border-light mb-4" name="bank" placeholder="Bank" required maxlength="13"> 
  
  
                          <input type="file" class="form-control bg-light border-light mb-4 " name="gambar" placeholder="Image" required>
                          
                          <input type="submit" class="form-control align-center nav-link btn-success" name="submit" value="Submit">
                         
                        </form>
               <?php } ?>
                    
                </div>

                    </div>

                </div>
              
                
            </div>
        </div>
        </div>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="d-flex align-items-center justify-content-center pt-5">
                    <h2 class="h2 text-light border-bottom pb-5 border-light">Further Info</h2>
                </div>
                <div class="d-flex justify-content-center">
                    <ul class="d-flex justify-content-center p-2 list-unstyled">
                        <li><a class="text-decoration-none p-5" href="index.php">Home</a></li>
                        <li><a class="text-decoration-none p-5" href="about.php">About Us</a></li>
                        <li><a class="text-decoration-none p-5" href="contact.php">Feedback</a></li>
                    </ul>
                </div>
                

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="d-flex justify-content-center mr-5">
                <ul class="d-flex justify-content-center p-2 list-unstyled ">
                        <li class="list-inline-item border border-light rounded-circle text-center mx-5 ">
                            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center mx-5">
                            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center mx-5">
                            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center mx-5">
                            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                       
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Zenchis
                            | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>