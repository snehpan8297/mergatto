<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/inbd.php");
if(isset($_POST["id_return"])){
	$table="returns";
	$filter=array();
	$filter["id_return"]=array("operation"=>"=","value"=>$_POST["id_return"]);
	deleteInBD($table,$filter);
	echo "OK";
	die();
}
echo "NOOK";

?>