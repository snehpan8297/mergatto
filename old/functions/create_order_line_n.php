<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/orders.php");
include("../include/stock.php");
include("../include/products.php");
if(isset($_POST["id_order_request"])){
	$result=addOrderLineWithId($_POST);
	
	$stock["id_color"]= $_POST["id_color"];
	$stock["stock_size_1"] = $_POST["size_1"];
	$stock["stock_size_2"] = $_POST["size_2"];
	$stock["stock_size_3"] = $_POST["size_3"];
	$stock["stock_size_4"] = $_POST["size_4"];
	$stock["stock_size_5"] = $_POST["size_5"];
	$stock["stock_size_6"] = $_POST["size_6"];
	$stock["stock_size_7"] = $_POST["size_7"];
	$stock["stock_size_8"] = $_POST["size_8"];
	$stock["stock_size_9"] = $_POST["size_9"];
	$stock["stock_size_10"] = $_POST["size_10"];
	$stock["stock_size_11"] = $_POST["size_11"];
	$stock["stock_size_12"] = $_POST["size_12"];
	
	$result=reduceStockWithId($stock,$_POST["id_product"]);

	echo "OK";
}
?>