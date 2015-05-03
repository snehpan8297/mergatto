<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/bd.php");
include("../include/orders.php");

$order_tmp["id_order"] = $_POST["id_order"];
$order_tmp["order_state"] = 2;
if(updateOrder($order_tmp)){
	echo "OK";
} else {
	echo "NoOK";
}
?>