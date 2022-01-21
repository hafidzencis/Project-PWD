<?php
session_start();
include '../dbconnect.php';
include '../functions.php';


$id = $_GET["id"];

if (deletecustomer($id) > 0){ 
    echo "<script> 
        alert('Success delete costumer');
        document.location.href = 'costumer.php';
        </script>";
} else {
    echo"<script> 
    alert('Failed delete costumer');
        document.location.href = 'costumer.php';
        </script>";
}

?>