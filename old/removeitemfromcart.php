<?php
//Lang confirm
@session_start();
include_once("./include/users.php");
include_once("./include/products.php");

$indice=$_POST["iditem"];
unset($_SESSION['cart_classics'][$indice]);
//Datos de usuario
/*$user["code"] = $_SESSION['user_classics']['id_client'];
$userdata = userData($user);*/

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;

$total_amount = 0;
$total_num = 0;
foreach ($_SESSION['cart_classics'] as $key => $cartitem) {
	//datos doproducto;
	$productdata = productDataFromSerialModel($cartitem["serial_model_code"]);
	$cart["subtotal_amount"] = 0;
	$cart["subtotal_num"] = 0;
	for ($i = 1; $i < sizeof($cartitem["sizes"]); $i++) {
		if($productdata["use_discount"]==1){
			$cart["subtotal_amount"] += round($cartitem["sizes"][$i] * ((1-$productdata["discount"]/100)*$productdata["pvp"]));
		} else {
			$cart["subtotal_amount"] += ($cartitem["sizes"][$i] * $productdata["pvp"]);
		}
		$cart["subtotal_num"] += $cartitem["sizes"][$i];
	}
	$cart["subtotal_amount"] *= $currency["exchange"];

	//Calculo Total
	$total_amount += $cart["subtotal_amount"];
	$total_num += $cart["subtotal_num"];
}
echo "OK|".$total_amount."|".$total_num;
?>