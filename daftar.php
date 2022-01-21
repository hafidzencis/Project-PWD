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

require 'functions.php';
require 'dbconnect.php';

if(isset($_POST['adduser']))
	{
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$pass = $_POST['pass']; 

        $login = query("SELECT * FROM login WHERE email ='$email'");
        $log;
        $log2;
        foreach ($login as $dat) {
            $log = $dat['email'];
            $log2 = $dat['notelpon'];
        }
        if ($email == $log) {
            echo "<div class='alert alert-warning text-danger'>
			Email registered!
		    </div>
		    <meta http-equiv='refresh' content='1; url= daftar.php'/> ";
        } 
        elseif ($telp == $log2) {
            echo "<div class='alert alert-warning text-danger'>
			Number Phone Registered!
		    </div>
		    <meta http-equiv='refresh' content='1; url= daftar.php'/> ";
        }
        else {
            $tambahuser = mysqli_query($conn,"insert into login (nama, email, password, notelpon, alamat) 
            values('$nama','$email','$pass','$telp','$alamat')");
            if ($tambahuser){
            echo " <div class='alert alert-success'>
                Berhasil mendaftar, silakan masuk.
              </div>
            <meta http-equiv='refresh' content='1; url= login.php'/>  ";
            } else { echo "<div class='alert alert-warning text-danger'>
                Gagal mendaftar, silakan coba lagi.
              </div>
             <meta http-equiv='refresh' content='1; url= daftar.php'/> ";
            }
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
                        <li class="nav-item d-flex justify-content-center">
                            <a class="nav-link" href="daftar.php">Register</a>
                            <a class="nav-link">/</a>
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
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
                <h2 class="text-success"> Register Account</h2>
                </div>
                <div class="d-flex align-items-center justify-content-center pt-2 pb-5">
            
                    <div class="justify-content-center">
                        <div class="input-group mb-5 pb-5">
                
                    <form method="post">
                       

                        <div class="col-xxl-20">
                        <input type="text" class="form-control bg-light border-light mb-4" name="nama" placeholder="Name" id="nama" required width="10">
                        </div>
                        <input type="text" class="form-control bg-light border-light mb-4" name="telp" placeholder="Phone Number" required maxlength="13">

                        
                        <input type="text"  class="form-control bg-light border-light mb-4" name="alamat" placeholder="Addres" required>
                    
                        <input type="email" class="form-control bg-light border-light mb-4" name="email" placeholder="Email" required="@">

                        
                        <input type="password" class="form-control bg-light border-light mb-4 " name="pass" placeholder="Password" required>

                        <input type="submit" class="form-control align-center nav-link btn-success" name="adduser" value="Sign Up">
				
                        <h4 class=" h4 text-danger mt-5 pb-4">*disclaimer 
                            your email used to login</h4> 
                    </form>
                   
                   
                    
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