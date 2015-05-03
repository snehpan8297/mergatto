<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["id_order_comment"])){
	$table="order_comments";
	$filter=array();
	$filter["id_order_comment"]=array("operation"=>"=","value"=>$_POST["id_order_comment"]);
	if(isInBD($table,$filter)){
		deleteInBD($table,$filter);
	echo "OK";
	die();
	}
}
echo "NOOK";
?>