<?php
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    echo "NOK";
    die();
}
include ("../include/users.php");
include_once ("../include/bdOC.php");
include_once ("../include/orders.php");
$line = $_POST["line"];
$size = $_POST["size"];
$quantity = $_POST["quantity"];

foreach ($_SESSION["orderdata_classics"] as $keyorder=>$ordervalue) {
	if ($ordervalue["id_line"]!=$line) continue;
	$_SESSION["orderdata_classics"][$keyorder]["elements"][$size]=$quantity;
	$totquantity=0;
	foreach ($_SESSION["orderdata_classics"][$keyorder]["elements"] as $keyelems=>$elemsvalue) {
		$totquantity+=$elemsvalue;
	}
}
$totprice=$totquantity*$_SESSION["orderdata_classics"][$keyorder]["pvp"];
echo $totquantity."|".$totprice."|".$line;