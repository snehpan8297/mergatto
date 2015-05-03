<?php
//Lang revisado
@session_start();
if(!isset($_SESSION['admin_classics']) && !isset($_SESSION['user_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/orders.php");
include("../include/promocodes.php");
include("../include/inbd.php");
if(isset($_POST["id_client"])){
	if((isset($_POST["promo_code"]))&&(!empty($_POST["promo_code"]))){
		$promo_code["code"]=$_POST['promo_code'];
		$promo_code=isPromoCode($promo_code);
		if($promo_code){
			$promo_code["codes_left"]-=1;
			updatePromoCode($promo_code);
		}
		unset($_SESSION['cart_promo']);
	}
	$_POST["date"]=date("U");
  $table="clients";
  $filter=array();
  $filter["id_client"]=array("operation"=>"=","value"=>$_POST["id_client"]);
  $user=getInBD($table,$filter);
  $_POST["discount"]=$user["discount"];
	$id_order_request=addOrderRequest($_POST);
	echo "OK||".$id_order_request;
}
?>
