<?php
//Lang confirmado
@session_start();
include ("header.php");
include_once ("./include/users.php");
include_once ("./include/products.php");

$variables = "";
//Datos de usuario
$user["code"] = $_SESSION['user']['id_client'];
$userdata = userData($user);

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;
$merchant_data=$userdata["id_client"]."//".$_POST["id_order_request"];
$url_tpvv='https://sis.sermepa.es/sis/realizarPago';
//$url_tpvv='https://sis-t.sermepa.es:25443/sis/realizarPago';

//Datos TPV
$amount = $_POST["amount"];
$currency_tpv='978';
$order= "000000000000000000000000000".$_POST["id_order_request"];

if(strlen($order)>8){
	$order=substr( $order, strlen($order)-7, strlen($order));
}else{
	$order="";
	for($i=strlen($order);$i<7;$i++){
		$order.=0;
	}
	$order.=$_POST["id_order_request"];
}
$order="CL-".$order;


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
$producto='Pagos a Oky^Coky Classics';
$message = $amount.$order.$code.$currency_tpv.$transactionType.$urlMerchant.$clave;
$signature = strtoupper(sha1($message));
?>

<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["cart_confirm"]; ?></a></div>
	</div>
	<div class='contentbox' id='ajax_loader'>
		<div style='text-align:center;padding-top:80px;'>
			<p></p><img style='width:50px' src='./img/interface/loader.gif' /></p>
			<?php echo $s["pasarela_access"]; ?>
		</div>
	</div>
		<form id='form' name="compra" action="<?php echo $url_tpvv; ?>" method="post">
			<input type=hidden name=Ds_Merchant_Amount value='<?php echo $amount; ?>'>
			<input type=hidden name=Ds_Merchant_Currency value='<?php echo $currency_tpv; ?>'>
			<input type=hidden name=Ds_Merchant_Order  value='<?php echo $order; ?>'>
			<input type=hidden name=Ds_Merchant_Titular  value='<?php echo $titular; ?>'>
			<input type=hidden name=Ds_Merchant_MerchantCode value='<?php echo $code; ?>'>
			<input type=hidden name=Ds_Merchant_MerchantName value='<?php echo $merchant_name; ?>'>
			<input type=hidden name=Ds_Merchant_ConsumerLanguage value='<?php echo $language; ?>'>
			<input type=hidden name=Ds_Merchant_Terminal value='<?php echo $terminal; ?>'>
			<input type=hidden name=Ds_Merchant_TransactionType value='<?php echo $transactionType; ?>'>
			<input type=hidden name=Ds_Merchant_MerchantURL value='<?php echo $urlMerchant; ?>'>
			<input type=hidden name=Ds_Merchant_UrlOK value='<?php echo $urlOK; ?>'>
			<input type=hidden name=Ds_Merchant_UrlKO value='<?php echo $urlKO; ?>'>
			<input type=hidden name=Ds_Merchant_MerchantSignature value='<?php echo $signature; ?>'>
			<input type=hidden name=Ds_Merchant_MerchantData value='<?php echo $merchant_data; ?>'>
		</form>
	</div>
	<script>
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url: "./payment_post.php",
			data:{
				"Ds_Response":"0",
				"Ds_MerchantData":"<?php echo $merchant_data; ?>",
			},success: function(msg) {
				window.location="./payment_success.php";
			}
		});
		
		
		//$('#form').delay(200).submit();	
	});
	</script>
</div>
<?php
include("footer.php");
?>