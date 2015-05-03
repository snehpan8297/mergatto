<?php


@session_start();
include("../include/payments.php");
if($_POST["client_code"]){
	$payment_tmp["client_code"]=$_POST["client_code"];
	$payment_tmp["id_order_final"]=$_POST["id_order_final"];
	$payment_tmp["payment_code"]=$_POST["payment_code"];
	if(existPaymentCode($payment_tmp)){
		echo "OK";
	}else{
		echo "NoOK";
	}
}
?>