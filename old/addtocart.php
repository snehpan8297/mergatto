<?php
//Lang revisado

@session_start();

include_once("include/carrito.php");
include_once("include/config.php");
$config=getConfig();
$a["sizes"]=array_fill(1,12,0);
$a["sizes"][$_POST["size"]]=1;
$item = array("serial_model_code" => $_POST["model"],
			"id_color" => $_POST["color"],
			"sizes" => $a["sizes"],
			"allsizes" => $_POST["allsizes"]
		);
addItem($item);
//print_r($_SESSION['cart_classics']);
if(!empty($t)) {
	echo $t;
}

?>
