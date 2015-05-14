<?php
	error_reporting(0);

	include('./include/includes.php');
	if ((intval($_POST['Ds_Response'])>=0)&&(intval($_POST['Ds_Response'])<=99)){
		$other_data=explode("//",$_POST['Ds_MerchantData']);
		$payment["id_client"]=$other_data[0];
		$payment["id_order"]=$other_data[1];
		$payment["payed"]=1;
		$r = updateOrder($payment);
		include("./functions/email_order_request.php");
	}else{

  }
?>
