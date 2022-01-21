<?php
session_start();
include '../dbconnect.php';
include '../functions.php';
if (!isset($_SESSION['loged'])) {
  echo "<script> alert('Login First!')
  document.location.href='../login.php';
  </script>";
}
$id = $_GET['id'];

$oldproduct = query("SELECT * FROM Produk WHERE idproduk=$id")[0];
// var_dump($oldproduct);

if (isset( $_POST["submit"])) {
    // var_dump($oldproduct);
  //melakukan cek apakah data sudah dimasukkan di db atau belom
 if ( edititem($_POST) > 0) {
  //    echo "DATA BERHASIL DITAMBAH";
      echo "<script> 
          alert('Succes change the product');
          document.location.href = 'item.php';
          </script>";
 } else {
  echo "<script> 
  alert('Failed change the product');
  document.location.href = 'item.php';
  </script>";
      var_dump($_POST);
      // echo "<script> 
      // alert('Data gagal ditambahkan');
      // document.location.href = 'item.php';
      // </script>";
      // var_dump($_POST);
 }
}

$categorydata = array();
$categoryquery = "SELECT * FROM kategori_produk";
$result = mysqli_query($conn,$categoryquery);
while ($data = mysqli_fetch_assoc($result)) {
  $categorydata[] = $data ;
}
// <?php 
// $ambil = $conn -> query("SELECT * FROM produk JOIN kategori_produk ON produk.idkategori = kategori_produk.idkategori");
// <?php while($produk = $ambil -> fetch_assoc()){
  //  echo $produk['nama_kategori'] 
  // $produk['idkategori']
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
            <h1 class="h3 mb-4text-gray-800">Form Basics</h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <div class="row center">
            <div class="col-xl-12 col-lg-7 mb-46">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
                </div>
                <div class="card-body text-secondary">
                  <form action="" method="POST" enctype="multipart/form-data"> 
                    <div>

                        <input type="hidden" name="id" value="<?= $oldproduct['idproduk'] ?>">
                        <input type="hidden" name="productoldphoto" value="<?= $oldproduct["fotoproduk"] ?>" >
                    </div>
                    <div class="form-group text-secondary">
                      <label for="productname ">Product Name </label> 
                      <input type="text" required value="<?=$oldproduct['namaproduk'];?>" name="productname" class="form-control" id="productname" >
                    </div>
                    <div class="form-group">
                      <label for="productprice" >Product Price </label>
                      <input type="number" required value="<?=$oldproduct['hargaproduk'];?>" name="productprice" class="form-control" id="productprice">
                    </div>
                    <div class="form-group">
                      <label for="productcategory"> Product Category </label>

                      <select name="productcategory" class="form-control">
                      <?php foreach ($categorydata as $datas => $value){

                      ?>
                        <option value="<?= $value['idkategori'] ?>" <?php
                        if ($oldproduct['idkategori'] == $value['idkategori']) { echo'selected'; } ?>>
                        <?= $value['nama_kategori']?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
            
                    <div class="form-group">
                      <label for="productweight">Product Weight </label>
                      <input type="number" required value="<?=$oldproduct['beratproduk'];?>" name="productweight" class="form-control" id="productweight">
                    </div>
                    <div class="form-group">
                      <label for="productstock">Product Stock </label>
                      <input type="text" name="productstock" class="form-control" id="productstock" required value="<?= $oldproduct['stock'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="productdescription">Product Description </label>
                      <input type="text" required value="<?=$oldproduct['deskripsiproduk'];?>" name="productdescription" class="form-control" id="productdescription">
                    </div>
                    <div class="form-group">
                    <label for="Product Photo">Product Photo </label>
                      <div class="custom-file">
                        <input type="file" name="productphoto" id="customFile">
                        <img src="../img/<?= $oldproduct["fotoproduk"] ?>" alt="Gambar Mahasiswa" width="200px">
                      </div>
                      <div class="custom-file">
                      
                      </div>
                    </div>
                    <div class="form-grup">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
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