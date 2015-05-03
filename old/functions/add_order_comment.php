<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["id_order"])){
	$table="order_request";
	$filter=array();
	$filter["id_order"]=array("operation"=>"=","value"=>$_POST["id_order"]);
	if(isInBD($table,$filter)){
		$table="order_comments";
		$data=$_POST;
		$data["content"]=str_replace("\n", "<br>",$data["content"]);
		$data["created"]=date("Y-m-d");
		addInBD($table,$data);
	echo "OK";
	die();
	}
}
echo "NOOK";
?>