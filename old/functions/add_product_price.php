<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["pvp"])){
	$table="product_prices";
	$filter=array();
	$filter["id_product"]=array("operation"=>"=","value"=>$_POST["id_product"]);
	$filter["id_client_group"]=array("operation"=>"=","value"=>$_POST["id_client_group"]);

	if(isInBD($table,$filter)){
		unset($_POST["id_product"]);
		unset($_POST["id_client_group"]);
		$data=$_POST;
		updateInBD($table,$filter,$data);
	}else{
		$data=$_POST;
		addInBD($table,$data);
	}
	echo "OK";
	die();
}
echo "NOOK";
?>