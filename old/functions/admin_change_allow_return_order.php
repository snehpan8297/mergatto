<?php
//Lang revisado
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include ("../include/bd.php");
include ("../include/inbd.php");

$table='order_request';
$filter=array();
$filter["id_order"] = array("operation"=>"=","value"=>$_POST["id_order"]);
$data=array();
$data["allow_return"] = $_POST["allow_return"];
if(updateInBD($table,$filter,$data)) {
	echo "OK";
} else {
	echo "NoOK";
}
?>