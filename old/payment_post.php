<?php
//Lang confirm
	error_reporting(0);
	
	if(!isset($_GET['lang'])){
		$lang="es";
		$variables='?lang=ES';
	}else{
		if($_GET['lang']=='ES'){
			$lang="es";
			$variables='?lang=ES';
		}
		if($_GET['lang']=='EN'){
			$lang="en";
			$variables='?lang=EN';
		}
	}
	include('./include/includes.php');
	if ((intval($_POST['Ds_Response'])>=0)&&(intval($_POST['Ds_Response'])<=99)){
		$other_data=explode("//",$_POST['Ds_MerchantData']);
		$payment["id_client"]=$other_data[0];
		$payment["id_order"]=$other_data[1];
		$payment["payed"]=1;
		$r = updateOrder($payment);
		include("./functions/email_order_request.php");
	}
?>