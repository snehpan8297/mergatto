<?php
//Lang revisado
include ("../include/bd.php");
include ("../include/orders.php");
include ("../include/stock.php");
include_once("../include/front_settings.php");

$order_tmp["id_order"] = $_POST["id_order"];
$order_tmp["order_state"] = $_POST["order_state"];
$order_state = $_POST["order_state"];
$stock_decrease = $_POST["stock_decrease"];
$idorder = $_POST["id_order"];
if($order_state == 4){
	$mail_content="
	El pedido # <br/>
	Ha sido cancelado por el usuario<br/>";
	mail($contact_email,'Oky^Coky - PEDIDO CANCELADO #'.$order_tmp["id_order"] ,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");

}
if(updateOrder($order_tmp)) {
	if(($order_state == 2)||($order_state == 4)) {
		$lines = getOrderLines($idorder);
		while($datos = db_fetch($lines)) {
			$id_stock = checkStock($datos["serial_model_code"],$datos["id_color"]);
			$stock = getStock($datos["serial_model_code"],$datos["id_color"]);
			if(!empty($stock)) {
				$istock["id_stock"] = $id_stock;
				for ($i=1;$i<=12;$i++) {
					$istock["stock_size_".$i]=$stock[$i]+$datos["size_".$i];
				}
				updateStock($istock);
			}
		}
	} else if($order_state == 1) {
		if($stock_decrease == 1) {
			$lines = getOrderLines($idorder);
			while($datos = db_fetch($lines)) {
				$id_stock = checkStock($datos["serial_model_code"],$datos["id_color"]);
				$stock = getStock($datos["serial_model_code"],$datos["id_color"]);
				if(!empty($stock)) {
					$istock["id_stock"] = $id_stock;
					for ($i=1;$i<=12;$i++) {
						$istock["stock_size_".$i]=$stock[$i]-$datos["size_".$i];
					}
					updateStock($istock);
				}
			}
		}
	}
	echo "OK";
} else {
	echo "NoOK";
}
?>
