<?php
session_start();
include '../dbconnect.php';
include '../functions.php';


$id = $_GET["id"];

if (deletecategory($id) > 0){ 
    echo "<script> 
        alert('Success delete category');
        document.location.href = 'categories.php';
        </script>";
} else {
    echo"<script> 
    alert('Failed delete category');
        document.location.href = 'item.php';
        </script>";
}

?>