<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
    die();
}

include_once("../include/bdOC.php");
include_once("../include/products.php");
include_once("../include/stock.php");

$products=listProducts("all");
while ($product=db_fetch($products)) {
	$colors=productColors($product["serial_model_code"]);
	while ($color=db_fetch($colors)) {
		$stock=getModelColorStock($product["serial_model_code"], $color["id_color"]);
		$a=strpos($color["name_id_color"],"M");
		if ($a===false) {
			$stockM=getModelColorStockM($product["serial_model_code"],$color["name_id_color"]);
		} else {
			$stockM=array(0,0,0,0,0,0,0,0,0,0,0,0);
		}
		$istock=array();
		$istock["id_product"]=$product["id_product"];
		$istock["id_color"]=$color["id"];
		for ($i=1;$i<=12;$i++) {
			$istock["stock_size_".$i]=$stock[$i-1]+$stockM[$i-1];
		}
		$idstock=existStock($product["id_product"],$color["id"]);
		if ($idstock!=false) {
			$istock["id_stock"]=$idstock;
			updateStock($istock);
		} else {
			insertStock($istock);
		}
	}
}
?>