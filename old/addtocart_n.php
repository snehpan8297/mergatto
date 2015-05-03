<?php
//Lang revisado

@session_start();

include_once("include/carrito.php");
include_once("include/config.php");
$config=getConfig();
$a["sizes"]=array_fill(1,12,0);
$a["sizes"][$_POST["size"]]=1;
$item = array("id_product" => $_POST["id_product"],
			"id_color" => $_POST["color"],
			"sizes" => $a["sizes"],
			"allsizes" => $_POST["allsizes"]
		);
addItem_n($item);
//print_r($_SESSION['cart_classics']);
if(!empty($t)) {
	echo $t;
}

?>
