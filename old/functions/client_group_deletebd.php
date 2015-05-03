<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/inbd.php");
$table = "client_groups";
$filter = array();
if(isset($_POST["id_client_group"])){
	$filter["id_client_group"] = array("operation"=>"=","value"=>$_POST["id_client_group"]);
	deleteInBD($table,$filter);
	echo "OK";
	die();
}
echo "NoOK";
?>