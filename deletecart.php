<?php
session_start();
$idproduk = $_GET['id'];
// $_SESSION['keranjang'][$idproduk] -= 1;
if (($_SESSION['keranjang'][$idproduk]) > 1) {
    $_SESSION['keranjang'][$idproduk] -= 1;
    echo"<script>
    document.location.href='cart.php';
    </script>";

} else {
    unset($_SESSION['keranjang'][$idproduk]);
    echo"<script>alert('Success delete product');
    document.location.href='shop.php';
    </script>";
}




?>




