<?php
//Lang revisado
@session_start();
include("../include/inbd.php");
if(isset($_SESSION['user_classics']['id_client'])){
	$table='clients';
	$filter=array();
	$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
	$userdata=getInBD($table,$filter);
	$userdata['name']=htmlentities($userdata['name'], ENT_QUOTES, "UTF-8");
	$userdata['name']=str_replace("&", "", $userdata['name']);
	$userdata['name']=str_replace("acute", "", $userdata['name']);
	$userdata['name']=str_replace(";", "", $userdata['name']);
	$userdata['name']=str_replace("tilde", "", $userdata['name']);

} else {
	$user["id_client"] = 0;
	$userdata=array();
	$userdata["name"]="An&oacute;nimo";
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	$userdata["name"]=$ip;
}

if(isset($_POST["serial_model_code"])){
	$table='products';
	$filter=array();
	$filter["serial_model_code"]=array("operation"=>"=","value"=>$_POST["serial_model_code"]);
	$product=getInBD($table,$filter);
	$product["complete_name"]=$product["name_es"]." ".$product["serial_model_code"];
}

$mmorpg_s["view_image"] = "mira una imagen de ";
$mmorpg_s["check_sizes"] = "mira las tallas disponibles ";
$mmorpg_s["add_to_cart"] = "ha metido en el carro ";
$mmorpg_s["add_to_cart_no_size"] = "ha intentado meter en el carro pero no ha seleccionado talla de ";
$mmorpg_s["check_24_shipping"] = "mira info envio en el producto ";
$mmorpg_s["check_free_return"] = "mira info devolucion en el producto ";
$mmorpg_s["check_need_help"] = "mira datos atencion del cliente en el producto ";

$table='mmorpg';
$data=array();
$data["time"]=date("Y-m-d H:i");
$data["identification"]=$userdata["name"];
$data["action"]=$mmorpg_s[$_POST["action"]]."<b>".$product["complete_name"]."</b>";
addInBD($table,$data);


?>