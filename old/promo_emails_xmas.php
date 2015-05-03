<?php
include_once("./include/inbd.php");

$table="clients";
$filter["lang"]=array("operation"=>"=","value"=>"en");
$clients=listInBD($table,$filter);
foreach ($clients as $key=>$client){
	$lang="en";
	$promo_code = "XMAS-".(($client["id_client"]+256)*64);
	$mail_subject="Merry Christmas - GIFT CARD 15.00�";

	$table="promo_codes";
	$data=array();
	$data["code"]=$promo_code;
	$data["codes_left"]=1;
	$data["amount"]=15;
	$data["comment"]="Xmas";
	addInBD($table,$data);

	error_log("[Classsics] Promocode Creado (".$client["email"]." - ".$promo_code.")<br/>");

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
<body style='font-family: \"Open Sans\", sans-serif;margin:0;padding:0'>
	<div style='padding:0px 10px'>
		<div class='content' style='padding-top:10px;'>



			<p style='text-align: center;'>
				<img src='http://www.okycoky.net/classics/news/gift_card_xmas_en.jpg'/>
			</p>
			<h1 style='text-align: center;font-size:50px;color:red'>
				".$promo_code."
			</h1>
			<h1 style='text-align: center;'>
				<a href='http://www.okycoky.net/classics?action=gift_card'>
					Ir a la tienda | Visit the Shop
				</a>
			</h1>
			<br/><br/>

		</div>

	</div>
	<div style='text-align:center;color:#333;font-weight:100;font-size:12px;padding:20px;background-color:#f4f4f4;'>
		Encuentra nuestras prendas al mejor precio en nuestra tienda online Oky^Coky<br/><br/>
		<a href='http://www.okycoky.net/classics/'><img style='min-height:30px;max-height:30px;'src='http://www.okycoky.net/classics/img/interface/okycoky-logo.png'</a><br/><br/>
		<a href='http://www.okycoky.net/classics/'>http://www.okycoky.net/classics/</a>
	</div>
	<div style='display:block;margin:auto;padding:40px 0px;background-color:#222222;overflow:auto;color:#666;font-size:10px;'>
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
				las �ltimas novedades que tenemos desde OKY^COKY
				para ti
			</div>
		</div>

	</div>
	<div style='text-align:center;background:#000;padding:20px;color:white;font-weight:100;font-size:12px;'>

		".date('Y')." - � Oky^Coky Shop. Todos los derechos reservados<br/><br/>
		<span style='color:#666'>Oky Coky Classics es nuestra tienda outlet online de ropa para mujer, donde podras encontrar los clasicos de OkyCoky y oky's</br>
		<p style='font-size:10px'>Esta informaci�n ha sido enviada por el sistema Oky^Coky Shop al email asociado con su cuenta de cliente.</p>
		<p style='font-size:10px'>Para m�s informaci�n sobre la pol�tica de privacidad viste nuestra p�gina <a style='color:#999;text-decoration:underline;' href='http://www.okycoky.net/classics/privacy_policy.php'>http://www.okycoky.net/classics/privacy_policy.php</a></p>

	</div>

</body>
</html>";
error_log("[Classsics] Promocode enviando START (".$client["email"]." - ".$promo_code.")<br/>");
mail($client["email"],$mail_subject,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");
error_log("[Classsics] Promocode enviando END (".$client["email"]." - ".$promo_code.")<br/>");


}




 /*
	include_once("./include/inbd.php");
	$table="order_request";
	$filter=array();
	$filter["id_order"]=array("operation"=>">","value"=>1759);
	$filter["generated_promo"]=array("operation"=>"=","value"=>0);
	$filter["payed"]=array("operation"=>"=","value"=>1);
	$orders=listInBD($table,$filter);
	echo "<pre>";
	echo "[Classsics] Promo codes send [START]<br/>";
	foreach($orders as $key => $order){
		$table="promo_codes";
		$data=array();
		$data["codes_left"]=1;
		$data["comment"]="Black Friday Gift Card";
		$data["amount"]=15.00;
		$data["code"]="BF-".$order["id_order"]."-".$order["id_client"];
		$promo_code="BF-".$order["id_order"]."-".$order["id_client"];
		addInBD($table,$data);

		$table="order_request";
		$filter=array();
		$filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
		$data=array();
		$data["generated_promo"]=1;
		updateInBD($table,$filter,$data);

		$table="clients";
		$filter=array();
		$filter["id_client"]=array("operation"=>"=","value"=>$order["id_client"]);
		$client=getInBD($table,$filter);

		$mail_subject="15.00� GIFT CARD | TARJETA REGALO";

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
<body style='font-family: \"Open Sans\", sans-serif;margin:0;padding:0'>
	<div style='padding:0px 10px'>
		<div class='content' style='padding-top:10px;'>



			<p style='text-align: center;'>
				<img src='http://www.okycoky.net/classics/news/coupon_header1.jpg'/>
			</p>
			<h1 style='text-align: center;'>
				".$promo_code."
			</h1>
			<p style='text-align: center;'>
				<img src='http://www.okycoky.net/classics/news/coupon_footer.jpg'/>
			</p>
			<h1 style='text-align: center;'>
				<a href='http://www.okycoky.net/classics?action=gift_card'>
					Ir a la tienda | Visit the Shop
				</a>
			</h1>
			<br/><br/>

		</div>

	</div>
	<div style='text-align:center;color:#333;font-weight:100;font-size:12px;padding:20px;background-color:#f4f4f4;'>
		Encuentra nuestras prendas al mejor precio en nuestra tienda online Oky^Coky<br/><br/>
		<a href='http://www.okycoky.net/classics/'><img style='min-height:30px;max-height:30px;'src='http://www.okycoky.net/classics/img/interface/okycoky-logo.png'</a><br/><br/>
		<a href='http://www.okycoky.net/classics/'>http://www.okycoky.net/classics/</a>
	</div>
	<div style='display:block;margin:auto;padding:40px 0px;background-color:#222222;overflow:auto;color:#666;font-size:10px;'>
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
				las �ltimas novedades que tenemos desde OKY^COKY
				para ti
			</div>
		</div>

	</div>
	<div style='text-align:center;background:#000;padding:20px;color:white;font-weight:100;font-size:12px;'>

		".date('Y')." - � Oky^Coky Shop. Todos los derechos reservados<br/><br/>
		<span style='color:#666'>Oky Coky Classics es nuestra tienda outlet online de ropa para mujer, donde podras encontrar los clasicos de OkyCoky y oky's</br>
		<p style='font-size:10px'>Esta informaci�n ha sido enviada por el sistema Oky^Coky Shop al email asociado con su cuenta de cliente.</p>
		<p style='font-size:10px'>Para m�s informaci�n sobre la pol�tica de privacidad viste nuestra p�gina <a style='color:#999;text-decoration:underline;' href='http://www.okycoky.net/classics/privacy_policy.php'>http://www.okycoky.net/classics/privacy_policy.php</a></p>

	</div>

</body>
</html>";
echo "[Classsics] Promocode enviando START (".$client["email"].")<br/>";
error_log("[Classsics] Promocode enviando START (".$client["email"].")");
mail($client["email"],'Oky^Coky - '.$mail_subject,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");
echo "[Classsics] Promocode enviando END (".$client["email"].")<br/>";
error_log("[Classsics] Promocode enviando END (".$client["email"].")");
	}
	echo "[Classsics] Promo codes send [END]<br/>";
	echo "</pre>";

*/
	?>
<!--
<script>
	alert("Promo codes enviados. Pulsa aceptar para cerrar la p�gina.");
	window.close();
</script>
-->
