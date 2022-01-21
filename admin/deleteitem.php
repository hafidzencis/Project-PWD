<?php
session_start();
include '../dbconnect.php';
include '../functions.php';


$id = $_GET["id"];

if (deleteitem($id) > 0){ 
    echo "<script> 
        alert('Success delete product');
        document.location.href = 'item.php';
        </script>";
} else {
    echo"<script> 
        alert('Success delete product');
        document.location.href = 'item.php';
        </script>";
}

?>