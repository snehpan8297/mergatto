<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/orders.php");
if(isset($_POST["id_ship"])){
	if (deleteShipping($_POST["id_ship"])){
		echo "OK";
	}else{
		echo "Fail";
	}
}
?>