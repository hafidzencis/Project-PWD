
<?php
include 'dbconnect.php';
include 'functions.php';
session_start();

if (isset($_SESSION['loged'])) {
    $namalengkap = explode(" ",$_SESSION['name']);
    $namauser = $namalengkap[0];
    
}

$categories = query("SELECT * FROM kategori_produk");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>HFS</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" href="assets/img/apple-icon.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/ZeSicon.ico">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/templatemo.css">
<link rel="stylesheet" href="assets/css/custom.css">

<!-- Load fonts style after rendering the layout styles -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
<link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

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
					echo ' <li><a class="nav-link" href="historybuy.php"> Buys   History</a>
                    </li>
                   <li>  <a class="nav-link h3" href="admin/indexadmin.php">  ADMIN EDIT </a></li> 
                   <li>  <a class="nav-link text-danger" href="logout.php">LOGOUT</a>
                     </li> </ul>';
					
					};                
                }
                
				?>
                </div>
                <form action="search.php" method="get">    
                <div class="navbar align-self-center d-flex">
                <a class="nav-icon position-relative text-decoration-none" href="cart.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    
                        <div class="d-flex">
                            <input type="text" name="keyword" class="form-control" autocomplete="off"> 
                            <button type="submit" class="btn btn-success" name="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    
                </div>
                </form>
            </div>

        </div>
    </nav>
    <!-- Close Header -->




    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide py-5" data-bs-ride="carousel">
        <div class="carousel-inner py-5">
            <div class="carousel-item active">
                <div class="container py-5">
                    <div class="row py-5 ">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center py-5">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>Hobby Fish Shop</b>  </h1>
                                <h3 class="h2">Hobby Fish Shop , We Sell Cheap Fish</h3>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>s
        </div>
    </div>
    <!-- End Banner Hero -->

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row pt-5">

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