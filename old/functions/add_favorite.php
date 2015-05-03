<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["id_product"])){
	$table="client_favorites";
	$filter=array();
	$filter["id_product"]=array("operation"=>"=","value"=>$_POST["id_product"]);
	$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
	if(!isInBD($table,$filter)){
		$data=array();
		$data["id_product"]=$_POST["id_product"];
		$data["id_client"]=$_SESSION['user_classics']['id_client'];
		$data["created"]=date("U");
		addInBD($table,$data);
	}else{
		deleteInBD($table,$filter);
	}
	echo "OK";
	die();
}
echo "NOOK";
?>