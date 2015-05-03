<?php	
//Lang confirm
if(isset($_POST['client_code'])&&isset($_POST['id_order_final'])&&isset($_POST['payment_code'])){

@session_start();
include_once("./include/payments.php");

if(existPaymentCode($_POST)){
	$payment = paymentDataUser($_POST);
}else{
	header("location:./payments.php?error=true");
	die;
}

$page="payments";
include("header.php");
?>
<script language=JavaScript>
function calc() { 
	document.forms[0].submit();}
</script>
<?php
	$email=$_POST['payments_email'];
	$concept=$_POST['payments_concept'];
	$amount_string=$_POST['payments_amount'];
	$amount=ereg_replace("[,]", "", $amount_string);
	$merchant_data=$userdata["client_code"]."//".$payment["id_order_final"];
	$url_tpvv='https://sis.sermepa.es/sis/realizarPago';
	
	//Datos TPV
	$amount = $payment["amount"];
	$amount_string = "";
	//echo strlen($amount);
	if(strlen($amount)>2){
		$amount_string=substr( $amount, 0, strlen($amount)-2 ).".".substr( $amount, strlen($amount)-2, strlen($amount) );
	}else{
		if(strlen($amount)==2){
			$amount_string="0.".$amount;
		}else{
			$amount_string="0.0".$amount;
		}
	}
	$currency='978';
	$order= date('His').$payment["id_order_final"];
	if(strlen($order)>12){
		$order=substr( $order, 0, 11);
	}
	$titular='Oky Coky Shop';
	$merchant_name='ROTELPA, S.A ("Fashion Retail")';
	$language='001';
	if ($lang=='en'){
		$language='002';
	}
	$urlOK=$url_base.'payment_success.php'.$variables;
	$urlKO=$url_base.'payment_error.php'.$variables;

	$clave='O651R804125P0063';
	$name='OkyCoky';

	$code='047278643';
	$terminal='1';
	$transactionType='0';
	$urlMerchant=$url_base.'payment_post.php'.$variables;
	$producto='Pagos a Oky^Coky';
	
	/*echo "Ds_Merchant_Amount: ".$amount."<br/>";
	echo "Ds_Merchant_Data: ".$merchant_data."<br/>";
	echo "Ds_Merchant_Order: ".$order."<br/>";
	echo "Ds_Merchant_MerchantCode: ".$code."<br/>";
	echo "Ds_Merchant_Currency: ".$currency."<br/>";
	echo "Ds_Merchant_TransactionType: ".$transactionType."<br/>";
	echo "Ds_Merchant_MerchantURL: ".$urlMerchant."<br/>";
	echo "CLAVE SECRETA: ".$clave."<br/>";*/
	$message = $amount.$order.$code.$currency.$transactionType.$urlMerchant.$clave;
	//echo $message."<br/>";
	//echo strtoupper(sha_1($message))."<br/>";
	//echo strtoupper(sha1($message))."<br/>";
	
	$signature = strtoupper(sha1($message));
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["payment_confirm_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'></div>
		<div class='confirm' id='payment_step_2' style="display:block">
			<form action="https://securepayments.paypal.com/webapps/HostedSoleSolutionApp/webflow/sparta/hostedSoleSolutionProcess" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["payment_confirm_subtitle"];?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_client_name"]?> <span class='form_isrequired'>*</span></span><span id='payments_client_confirm' class='field_confirm'><?php echo $userdata["name"]; ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["client_code"]?> <span class='form_isrequired'>*</span></span><span id='payments_store_name_confirm' class='field_confirm'><?php echo $userdata["client_code"]; ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_email"]?> <span class='form_isrequired'>*</span></span><span id='payments_email_confirm' class='field_confirm'><?php echo $userdata["email"]; ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["id_order_final"]?> <span class='form_isrequired'>*</span></span><span id='payments_concept_confirm' class='field_confirm'><?php echo $payment["id_order_final"]; ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_amount"]?> <span class='form_isrequired'>*</span></span><span id='payments_amount_confirm' class='field_confirm'><?php echo $amount_string; ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["num_clothes"]?> <span class='form_isrequired'>*</span></span><span id='payments_amount_confirm' class='field_confirm'><?php echo $payment["num_clothes"]; ?></span>
				</div>
				<div class='form_entry'>
						<span class='label'>
							<?php echo $s["payment_confirm_moreinfo"];?>
						</span>
					</div>
				<div class='form_submit'>
					<div class='likeabutton'><input id="payments_send_step1" type='submit' value='<?php echo $s["confirm"]?>'/></div>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><a id="payments_back_step2" href="./payments.php"><span class='text'><?php echo $s["back"]?></span></a></div> 
				</div>
				<form 

				<input type="hidden" name="cmd" value="_hosted-payment">
				<input type="hidden" name="subtotal" value="<?php echo $amount;?>">
				<input type="hidden" name="business" value="K3BRJAETH8GJ2">
				<input type="hidden" name="paymentaction" value="sale">
				<input type="hidden" name="cancel_return" value="http://www.okycoky.net/classics/payment_error.html">
				<input type="hidden" name="return" value="http://www.okycoky.net/classics/payment_success_paypal.html">
				<input type="hidden" name="notify_url" value="http://www.okycoky.net/classics/payment_post_paypal.html">
				<input type="hidden" name="invoice" value="<?php echo $order; ?>">

			
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
<?php
}else{
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
	header("location:./payments.php".$variables);
}
?>