<?php
//Lang revisado
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/payments.php");
if(isset($_POST["client_code"])){
	$payment_tmp["client_code"] = $_POST["client_code"];
	$payment_tmp["id_order_final"] = $_POST["id_order"];
	$payment_tmp["created"] = date('Y-m-d H:i:s');
	$amount_tmp= explode(".",$_POST["amount"]);
	$payment_tmp["amount"] = $amount_tmp[0].$amount_tmp[1];
	$payment_tmp["num_clothes"] = $_POST["num_clothes"];
	$payment_tmp["is_payed"] = 0;
	$payment_tmp["payment_code"] = substr(md5($_POST["client_code"].$payment_tmp["created"]),0,10);
	$add_payment=addPayment($payment_tmp);
	if($add_payment!=0){
		include("./email_autopayment_request.php");
		echo "OK";
	}else{
		echo "NoOK";
	}	
}
?>