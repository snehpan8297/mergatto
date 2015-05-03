<?php
//Lang revisado
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include ("../include/bd.php");
include ("../include/orders.php");
include ("../include/stock.php");

$order_tmp["id_order"] = $_POST["id_order"];
$order_tmp["payment_method"] = $_POST["payment_method"];
$idorder = $_POST["id_order"];
if(updateOrder($order_tmp)) {
	
	echo "OK";
} else {
	echo "NoOK";
}
?>