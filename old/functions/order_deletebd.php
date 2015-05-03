<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
    die();
}
if(isset($_POST["id_order"])){
	include("../include/orders.php");
	include("../include/stock.php");
	$idorder = $_POST["id_order"];
	$order_state = $_POST["stock_return"];
	if($order_state == 1) {
		$lines = getOrderLines($idorder);
		while($datos = db_fetch($lines)) {
			$id_stock = checkStockWithId($datos["id_product"],$datos["id_color"]);
			$stock = getStockWithId($datos["id_product"],$datos["id_color"]);
			if(!empty($stock)) {
				$istock["id_stock"] = $id_stock;
				for ($i=1;$i<=12;$i++) {
					$istock["stock_size_".$i]=$stock[$i]+$datos["size_".$i];
				}
				updateStock($istock);
			}
		}
	}
	if (deleteOrder($_POST["id_order"])){
		echo "OK";
	}else{
		echo "NoOK";
	}
}
?>