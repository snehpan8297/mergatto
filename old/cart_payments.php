<script type="text/javascript">

/**
 * Creates a temporary global ga object and loads analy  tics.js.
 * Paramenters o, a, and m are all used internally.  They could have been declared using 'var',
 * instead they are declared as parameters to save 4 bytes ('var ').
 *
 * @param {Window}      i The global context object.
 * @param {Document}    s The DOM document object.
 * @param {string}      o Must be 'script'.
 * @param {string}      g URL of the analytics.js script. Inherits protocol from page.
 * @param {string}      r Global name of analytics object.  Defaults to 'ga'.
 * @param {DOMElement?} a Async script tag.
 * @param {DOMElement?} m First script tag in document.
 */
(function(i, s, o, g, r, a, m){
  i['GoogleAnalyticsObject'] = r; // Acts as a pointer to support renaming.

  // Creates an initial ga() function.  The queued commands will be executed once analytics.js loads.
  i[r] = i[r] || function() {
    (i[r].q = i[r].q || []).push(arguments)
  },

  // Sets the time (as an integer) this tag was executed.  Used for timing hits.
  i[r].l = 1 * new Date();

  // Insert the script tag asynchronously.  Inserts above current tag to prevent blocking in
  // addition to using the async attribute.
  a = s.createElement(o),
  m = s.getElementsByTagName(o)[0];
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-35971078-1', 'auto'); // Creates the tracker with default parameters.
ga('send', 'pageview');            // Sends a pageview hit.


</script>

<?php
//Lang confirmado
@session_start();
$page='cart-payments';

include ("header.php");
$page_title = "Sistema de Pago";
include_once ("./include/users.php");
include_once ("./include/products.php");
$id_order_request=$_POST["id_order_request"];
$orderdata=getOrderData($id_order_request);
if($_POST["payment_method"]=="credit_card"){
	if((isset($_POST["action"]))&&($_POST["action"]=="again")){
		$new_order=duplicateOrder($_POST["id_order_request"]);
		$id_order_request=$new_order["id_order"];
		$new_order["payment_method"]="credit_card";
		updateOrder($new_order);
	}
	$variables = "";
	//Datos de usuario
	$user["code"] = $_SESSION['user_classics']['id_client'];
	$userdata = userData($user);

	$currency["name"] = "Euro";
	$currency["symbol"] = "€";
	$currency["exchange"] = 1;
	$merchant_data=$userdata["id_client"]."//".$id_order_request;
	$url_tpvv='https://sis.sermepa.es/sis/realizarPago';
	//$url_tpvv='https://sis-t.sermepa.es:25443/sis/realizarPago';

	//Datos TPV
	$amount = $_POST["amount"];
	$currency_tpv='978';
	$order= "000000000000000000000000000".$id_order_request;

	if(strlen($order)>8){
		$order=substr( $order, strlen($order)-7, strlen($order));
	}else{
		$order="";
		for($i=strlen($order);$i<7;$i++){
			$order.=0;
		}
		$order.=$id_order_request;
	}
	$order="CL-".$order;

	$subject = "Pedido #".$id_order_request." entrando en pasarela de pago";
	$_SESSION["ped"] = $id_order_request;

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
	$message = $amount.$order.$code.$currency_tpv.$transactionType.$urlMerchant.$clave;
	$signature = strtoupper(sha1($message));
	include_once ("./include/orders.php");

	$mail_content ="
	El Pedido #".$id_order_request." está entrando en la pasarela de pago.<br/>
	Datos del usuario:<br/>
	email: ".$userdata["email"]."
	Nombre: ".$orderdata["invoice_address_name"]." ".$orderdata["invoice_address_subname"]."
	Teléfono: ".$orderdata["invoice_address_mobile"]." ".$orderdata["invoice_address_other"]."
	Ciudad: ".$orderdata["invoice_address_city"]." (".$orderdata["invoice_address_country"].")
	";
	mail($contact_email,'Oky^Coky - Pedido en pasarela #'.$id_order_request,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");
}else if($_POST["payment_method"]=="paypal"){
	$orderdata["payment_method"]="paypal";
	updateOrder($orderdata);
	$amount = $_POST["amount"];
	$order= "000000000000000000000000000".$id_order_request;

	if(strlen($order)>8){
		$order=substr( $order, strlen($order)-7, strlen($order));
	}else{
		$order="";
		for($i=strlen($order);$i<7;$i++){
			$order.=0;
		}
		$order.=$id_order_request;
	}
	$order="CL-".$order;
	$mail_content ="
	El Pedido #".$id_order_request." está entrando en PayPal.<br/>
	Datos del usuario:<br/>
	email: ".$userdata["email"]."
	Nombre: ".$orderdata["invoice_address_name"]." ".$orderdata["invoice_address_subname"]."
	Teléfono: ".$orderdata["invoice_address_mobile"]." ".$orderdata["invoice_address_other"]."
	Ciudad: ".$orderdata["invoice_address_city"]." (".$orderdata["invoice_address_country"].")
	";
	mail($contact_email,'Oky^Coky - Pedido en pasarela #'.$id_order_request,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");
	?>

	<?php


}else if($_POST["payment_method"]=="bank_transfer"){

	$orderdata["payment_method"]="bank_transfer";
	updateOrder($orderdata);

	$amount = $_POST["amount"];
	$currency_tpv='978';
	$order= "000000000000000000000000000".$id_order_request;

	if(strlen($order)>8){
		$order=substr( $order, strlen($order)-7, strlen($order));
	}else{
		$order="";
		for($i=strlen($order);$i<7;$i++){
			$order.=0;
		}
		$order.=$id_order_request;
	}
	$order="CL-".$order;


	$mail_content ="
	Finalizado Pedido #".$id_order_request." mediante transferencia bancaria.<br/>
	Datos del usuario:<br/>
	email: ".$userdata["email"]."
	Nombre: ".$orderdata["invoice_address_name"]." ".$orderdata["invoice_address_subname"]."
	Teléfono: ".$orderdata["invoice_address_mobile"]." ".$orderdata["invoice_address_other"]."
	Ciudad: ".$orderdata["invoice_address_city"]." (".$orderdata["invoice_address_country"].")
	";
	mail($contact_email,'Oky^Coky - Pedido Finalizado #'.$id_order_request.'( '.$orderdata["total_with_discount"].' € | Transferencia )',$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");

	$mail_content ="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns='http://www.w3.org/1999/xhtml' dir='ltr' lang='".$lang."' xml:lang='".$lang."'
xmlns:b='http://www.google.com/2005/gml/b'
xmlns:b='http://www.google.com/2005/gml/b'
xmlns:data='http://www.google.com/2005/gml/data'
xmlns:expr='http://www.google.com/2005/gml/expr'
xmlns:og='http://opengraphprotocol.org/schema/'>
<head>
	<meta http-equiv='content-type' content='text/html; charset=utf-8' />
</head>
<style type='text/css'>
		a{ color:color:#666; }
		a:hover{ color:#000; }
		b{ color:#000; font-weight:300 }
		.important{ color:#000; }
		.uppercase{ text-transform: uppercase; }
		.underline{ text-decoration:underline; }
		th{}
		td{ padding:5px 10px; }
		.preview img{ height:100px; }
		.right{ text-align:right; }
		.left{ text-align:left; }
		.semifooter{ padding-top:20px; font-size:10px; }
		h3{ font-size:14px; color:#000; font-weight:300}
	</style>
<body style='font-family: \"Open Sans\", sans-serif;margin:0;padding:0;font-weight:100 !important'>
	<div style='display:block;margin:auto;margin:10px 0px;text-align:center'><img style='margin:auto;min-height:30px;max-height:30px' src='http://www.okycoky.net/classics/img/interface/okycoky-logo.png'/></div>
	<div class='content' style='margin:20px;font-weight:100;font-size:14px;'>
		<br/>
		".$s["bank_transfer_moreinfo_mail"]."
		<br/>
		<div style='color: #fba000;background-color: #fff5e5;border:1px solid #fba000;text-align:center;width:460px;margin:auto;padding:20px;font-size:14px;margin-bottom:10px;'>
				".$s["bank_transfer_warning"]."
		</div>

		<table style='margin:auto;border:1px solid #ccc;padding:20px;background:#fff;font-size:14px;'>
			<tr>
				<td style='text-align:center;padding-bottom:10px;' colspan='2'><b>".$s["bank_transfer_data"]."</b></td>
				</tr>
				<tr>
					<td style='text-align:right;'><b>".$s["bank"]."</b></td>
					<td style=''>La Caixa, Caja de Ahorros y Pensiones de Barcelona</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["swift"]."</b></td>
					<td>CAIXESBB</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["iban"]."</b></td>
					<td>ES7021002178030200148419</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["account_number"]."</b></td>
					<td>2100 2178 03 0200148419</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["account_owner"]."</b></td>
					<td>ROTELPA, S.A ('Fashion Retail')</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["concept"]."</b></td>
					<td>".$s["order"]." ".$order."</td>
				</tr>
				<tr>
					<td style='text-align:right'><b>".$s["amount_bank"]."</b></td>
					<td>".$_POST["total_amount_discount_shipping"]." €</td>
				</tr>
			</table>
		<p style='text-align:center;margin-top:30px;'><a style='padding:10px 20px;border:1px solid #000;text-transform:uppercase;text-decoration:none;color:black !important;font-size:18px;margin:5px' href='http://www.okycoky.net/classics/show_details.php?id_order=".$id_order_request."'>".$s["go_to_order"]."</a></p>
		<br/><br/><br/><br/>
	</div>
	<div style='text-align:center;color:#333;font-weight:100;font-size:12px;padding:20px;background-color:#f4f4f4;'>
		Encuentra nuestras prendas al mejor precio en nuestra tienda online Oky^Coky<br/><br/>
		<a href='http://www.okycoky.net/classics/'><img style='min-height:30px;max-height:30px;'src='http://www.okycoky.net/classics/img/interface/okycoky-logo.png'</a><br/><br/>
		<a href='http://www.okycoky.net/classics/'>http://www.okycoky.net/classics/</a>
	</div>
	<div style='display:block;padding:40px 0px;background-color:#222222;overflow:auto;color:#666 !important;font-size:10px;'>
		<div style='float:left;padding-left:20px;padding-bottom:10px;'>
			<a href='http://www.okycoky.net/classics/'><img style='min-height:30px;max-height:30px;padding-bottom:10px;' src='http://www.okycoky.net/classics/img/okycoky-logo-white.png'/></a><br/>
			Parque Tecnologico y Logistico de Vigo,<br/>
			Calle C nave C.<br/>
			VIGO<br/>
			+34 986 240 001<br/>
			shop@okycoky.com<br/>
		</div>
		<div style='float:right;padding-right:20px;text-align:left;width:300px;font-size:11px;padding-bottom:10px;'>
			<a href='https://www.facebook.com/okycoky' style='margin:2px'><img src='http://www.okycoky.net/images/fb-icon.png' style='width:30px' /></a>
			<a href='https://twitter.com/okycoky' style='margin:2px'><img src='http://www.okycoky.net/images/tw-icon.png' style='width:30px' /></a>
			<a href='http://vimeo.com/okycoky' style='margin:2px'><img src='http://www.okycoky.net/images/vim-icon.png' style='width:30px' /></a>
			<a href='http://www.youtube.com/user/OKYCOKY86' style='margin:2px'><img src='http://www.okycoky.net/images/ytu-icon.png' style='width:30px' /></a>
			<a href='http://www.flickr.com/photos/okycoky/' style='margin:2px'><img src='http://www.okycoky.net/images/flc-icon.png' style='width:30px' /></a>
			<a href='http://instagram.com/okycoky' style='margin:2px'><img src='http://www.okycoky.net/images/pnt-icon.png' style='width:30px' /></a>
			<br/>
			<div style='text-align:left;margin-top:5px;'>
				Sigue nuestros perfiles en las redes sociales y descubre
				las últimas novedades que tenemos desde OKY^COKY
				para ti
			</div>
		</div>

	</div>
	<div style='text-align:center;background:#000;padding:20px;color:white;font-weight:100;font-size:12px;'>

		".date('Y')." - © Oky^Coky Shop. Todos los derechos reservados<br/><br/>
		<span style='color:#666'>Oky Coky Classics es nuestra tienda outlet online de ropa para mujer, donde podras encontrar los clasicos de OkyCoky y oky's</br>
		<p style='font-size:10px'>Esta información ha sido enviada por el sistema Oky^Coky Shop al email asociado con su cuenta de cliente.</p>
		<p style='font-size:10px'>Para más información sobre la política de privacidad viste nuestra página <a style='color:#999;text-decoration:underline;' href='".$url_base."privacy_policy.php'>".$url_base."privacy_policy.php</a></p>

	</div>
</body>
</html>";

error_log("[Classsics] [Email] Ingreso en cuenta / Bank Transfer Detail START (".$userdata["email"].")");
mail($userdata["email"],'Ingreso en cuenta / Bank Transfer Details Pedido #'.$id_order_request,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");
error_log("[Classsics] [Email] Ingreso en cuenta / Bank Transfer Detail END (".$userdata["email"].")");
}
?>

<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["cart_confirm"]; ?></a></div>
	</div>
	<div class='contentbox' id='ajax_loader'>
		<div style='text-align:center;padding-top:80px;'>
			<p></p><img style='width:50px' src='./img/interface/loader.gif' /></p>
			<?php
			if($_POST["payment_method"]=="credit_card"){
				 echo $s["pasarela_access"];
			}else if($_POST["payment_method"]=="bank_transfer"){
				echo $s["bank_access"];
			}
			?>
		</div>
	</div>
	<?php
		if($_POST["payment_method"]=="credit_card"){
	?>
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
		<?php
		}else if($_POST["payment_method"]=="paypal"){
		?>
		<FORM id='form' ACTION="https://www.paypal.com/cgi-bin/webscr" METHOD="POST">
			<input type="hidden" name="cancel_return" value="http://www.okycoky.net/classics/payment_error.php">
			<input type="hidden" name="return" value="http://www.okycoky.net/classics/payment_success.php">
			<input type="hidden" name="notify_url" value="http://www.okycoky.net/classics/payment_post_paypal.php">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="K3BRJAETH8GJ2">
			<input type="hidden" name="item_name" value="ORDER:<?php echo $order; ?>">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="amount" value="<?php echo $_POST["total_amount_discount_shipping"];?>">
			<input type="hidden" name="custom" value="<?php echo $id_order_request;?>">
		</form>
		<?php
		}else if($_POST["payment_method"]=="bank_transfer"){
			?>
			<form id='form' name="compra" action="./pay_by_transfer.php" method="post">
				<input type='hidden' name='order' id='order' value='<?php echo $order;?>'/>
				<input type='hidden' name='amount' id='amount' value='<?php echo $_POST["total_amount_discount_shipping"];?>'/>
			</form>
			<?php
		}
		?>
	</div>
	</div>
<?php

$payment["id_order"]=$_POST["id_order_request"];

$table='order_request';
$filter=array();
$filter["id_order"]=array("operation"=>"=","value"=>$payment["id_order"]);
$order=getInBD($table,$filter);
$order["revenue"]=round(($order["total_with_discount"]-$order["shipping_method_price"])/1.21,2);

$order["shipping"]=round($order["shipping_method_price"],2);
$order["tax"]=round(($order["total_with_discount"]-$order["shipping_method_price"])-$order["revenue"],2);

$trans = array('id'=>$order["id_order"], 'affiliation'=>'Oky^Coky','revenue'=>$order["revenue"], 'shipping'=>$order["shipping"], 'tax'=>$order["tax"]);

$table='lines_order_request';
$filter=array();
$filter["id_order_request"]=array("operation"=>"=","value"=>$payment["id_order"]);
$lines=listInBD($table,$filter);
$items = array();
foreach($lines as $key=>$line){
	$items[]=array('sku'=>$line["serial_model_code"], 'name'=>$line["serial_model_code"], 'category'=>'Clothes', 'price'=>$line["unitary_price"], 'quantity'=>$line["subclothes"]);
}

// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': '{$trans['affiliation']}',
  'revenue': '{$trans['revenue']}',
  'shipping': '{$trans['shipping']}',
  'tax': '{$trans['tax']}'
});
HTML;
}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['name']}',
  'sku': '{$item['sku']}',
  'category': '{$item['category']}',
  'price': '{$item['price']}',
  'quantity': '{$item['quantity']}'
});
HTML;
}

?>
<!-- Begin HTML -->
<script>
ga('require', 'ecommerce');

<?php
echo getTransactionJs($trans);

foreach ($items as &$item) {
  echo getItemJs($trans['id'], $item);
}
?>

ga('ecommerce:send');
</script>
<script>
	$(document).ready(function(){
		$('#form').delay(400).submit();
	});
</script>



<?php
include("footer.php");
?>
