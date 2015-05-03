<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["id_category"])){
	$table="categories";
	$filter=array();
	$filter["id_category"]=array("operation"=>"=","value"=>$_POST["id_category"]);
	deleteInBD($table,$filter);
	echo "OK";
	die();
}
echo "NOOK";

?>