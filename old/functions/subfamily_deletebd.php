<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/subfamily.php");
if(isset($_POST["id_subfamily"])){
	error_log($_POST["id_subfamily"]);
	$subfamily["id_subfamily"]=$_POST["id_subfamily"];
	deleteSubfamily($subfamily);
	echo "OK";
}
?>