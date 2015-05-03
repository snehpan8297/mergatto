<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/products.php");
if(isset($_POST["id_product"])){
	deleteProduct($_POST["id_product"]);
	echo "OK";
}
?>