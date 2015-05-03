<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}

include("../include/colors.php");
if(isset($_POST["serial_model_code"])){
	$id=addNewColorWithId($_POST["serial_model_code"],$_POST["id_product"]);
	echo "OK||".$id;
}
?>