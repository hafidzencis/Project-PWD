<?php
include 'functions.php';
session_start();
$idproduk = $_GET['id'];

$valprod = [];

$prod = query("SELECT * FROM produk WHERE idproduk = '$idproduk' ");
foreach ($prod as $key) {
    $valprod[] = $key;
}


if (isset($_SESSION['keranjang'][$idproduk])) {
    if ($valprod[0]['stock'] > $_SESSION['keranjang'][$idproduk]) {
        $_SESSION['keranjang'][$idproduk] += 1;
    }
    
}
else {
    $_SESSION['keranjang'][$idproduk] = 1;
}



echo "<script>
document.location.href='cart.php';</script>;"

?>