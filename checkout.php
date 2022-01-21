<?php
include 'dbconnect.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['loged'])) {
    echo "<script> alert('Login First!')
    document.location.href='login.php';
    </script>";
}

$namalengkap = explode(" ",$_SESSION['name']);
$namauser = $namalengkap[0];

if (empty($_SESSION['keranjang']) or (!isset($_SESSION['keranjang']))) {
    echo"<script> alert('Product in cart is empty');
    document.location.href='index.php';
    </script>";
}

$dataongkir = array();
$ongkirquery = query("SELECT * FROM ongkos_kirim ORDER BY tarif");
foreach ($ongkirquery as $data) {
    $dataongkir[] = $data ;
}


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
                    ' <li><a class="nav-link" href="historybuy.php"> Buys   History</a>
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

 



    <!-- Start Banner Hero -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1"> Checkout </h1>
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
                            <th>Amount</th>
                            <th>Total Price </th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <?php
                            $totalbelanja= 0 ;
                            $amount = 0 ;
                            $num = 1;
                            foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
                                $cart = query("SELECT * FROM PRODUK WHERE idproduk='$idproduk'");
                                foreach ($cart as $cartdata) {
                             
                            
                        ?>
                        <tbody>

                        <tr>
                            <td><?= $num;?></td>
                            <td><?= $cartdata['namaproduk'] ?></td>
                            <td><?= "Rp. ",number_format($cartdata['hargaproduk'],2,",",".")?></td>
                            <td><?= $jumlah ?></td>
                            <td><?= "Rp. ",number_format( $cartdata['hargaproduk']*$jumlah,2,",",".") ?></td>
                            <td> <a href="deletecart.php?id=<?= $cartdata['idproduk']?>" class="btn btn-danger btn-xs"> - </a></td>
                            
                        </tr>
                        <?php   $num++;
                              
                                } 
                                $amount += $jumlah;
                                $totalbelanja = $totalbelanja + ( $cartdata['hargaproduk']*$jumlah);
                            } 
                            ?>
                            
                        <tr>
                            <td colspan="2">Total Shopping</td>
                          
                            <td>  </td>
                            <td> <?= $amount?></td>
                            <td> <?= "Rp. ", number_format($totalbelanja,"2",",",".")  ?></td>
                
                        </tr>
                       
                        </tbody>
                    </table>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" readonly value="<?= $_SESSION['name']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" readonly value="<?= $_SESSION['notelp']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="idongkir" id="" class="form-control">
                                    <option value=""> Choose Postage</option>
                                    <?php 
                                       foreach($dataongkir as $datong => $val){
                                    ?>
                                    <option value="<?= $val['idongkir']?>">
                                            <?= $val['nama_ongkir'] ?> -  <?= 'Rp.'.number_format($val['tarif'],2,",",".") ?>

                                    </option>
                                    <?php 
                                     }?>
                                </select>
                            </div>
                            <br>
                            <div class="col-md-4 pt-4">
                                <div class="form-group">
                                    <label class="form-label"><b> Please Write Complete Shipping Address </b></label>
                                
                                    <textarea class="form-control" name="alamat" id="" cols="30" rows="3" 
                                    placeholder="Write the complete shipping address..."
                                    style="resize: none;"></textarea>
                                
                                </div>
                            </div>
                        </div>
                   
                        <br><br>
                        <!-- <a href="shop.php" class="btn btn-primary"> Continue Shopping</a> -->
                        <button type="submit" name="checkout" class="btn btn-primary"> Checkout </button>
                    </form>
                </center>
            </div>
        </div>
    </section>    
  

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


    <?php
    if (isset($_POST['checkout'])) {

        if (!$_POST['idongkir'] || !$_POST['alamat']) {
            echo " <script> alert('Choose the postage and write addres!'); </script>;";
            die;
        }
        $dataaddbuyer = [];
        $dataaddbuyer['iduser'] = $_SESSION['id'];
        $dataaddbuyer['idongkir'] = $_POST['idongkir'];
        date_default_timezone_set("Asia/Bangkok");
        $dataaddbuyer['tglbeli'] = date("Y-m-d");
        
        // $tar = 0;
        $ongkir = query("SELECT * FROM ongkos_kirim WHERE idongkir =  $dataaddbuyer[idongkir]");
        foreach ($ongkir as $datas) {
            $tar =  $datas['tarif'];
        }
        // var_dump($ongkir);
        $dataaddbuyer['tarif'] = $tar;
        $dataaddbuyer['totalpembelian']= $totalbelanja + $tar;
        $dataaddbuyer['alamat'] =  $_POST['alamat'];
       
        // var_dump($dataaddbuyer);
     
        if (addbuyer($dataaddbuyer)  == 1 ) {
            
            $idproductsale =  $conn->insert_id;
            
        
            foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
                $ambil=$conn -> query("SELECT * FROM produk WHERE idproduk = $idproduk");
                $potongprod = $ambil->fetch_assoc();
                
                $nama = $potongprod['namaproduk'];
                $harga = $potongprod['hargaproduk'];
                $berat = $potongprod['beratproduk'];
     
                $totalberat = $potongprod['beratproduk'] * $jumlah;
                $totalharga = $potongprod['hargaproduk'] * $jumlah;
                $results=$conn->query("INSERT INTO pembelian_produk 
                (idpembelianproduk,idpembelian,idproduk,jumlah,nama,harga,berat,totalberat,totalharga) VALUES
                ('',$idproductsale,$idproduk,$jumlah,'$nama','$harga','$berat',$totalberat,$totalharga)");
                var_dump($potongprod);

                // update produk\
                $stockprod = $potongprod['stock'];
                $updprod = mysqli_query($conn,"UPDATE produk SET stock = $stockprod - $jumlah
                WHERE idproduk = $idproduk");
                // var_dump(mysqli_affected_rows($conn));
            }

            unset($_SESSION['keranjang']);
            echo "<script>alert('Success buy produt');
            document.location.href='nota.php?id=$idproductsale';</script>";
           
        }
      
    }
   
?>

</body>
</body>

</html>