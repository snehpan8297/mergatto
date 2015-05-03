<?php
/*
$dir = dirname(dirname(__FILE__));
include_once($dir."/functions/get_lang.php");
include_once($dir."/include/includes.php");
include_once($dir."/include/front_settings.php");
*/

$lang="es";
include_once("../lang/lang_es.php");
include_once("../include/front_settings.php");
include_once("../include/orders.php");
include_once("../include/products.php");
include_once("../include/users.php");
include_once("../include/colors.php");

$user = userData($payment);

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
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Error en el pago</h3>
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'><span style='color:#999'>Payment Error</span></h3>
		<p style='color:#000 !important; font-size:12px;'>La pasarela de pago no ha finalizado correctamente la operación y su pedido ha quedado pendiente de pago, por favor vuelva a sus pedidos y vuelva a intentarlo, si este error persiste puede que sus tarjeta no acepte compra online, contacte con su banco para más detalles. También ofrecemos la posibilidad de realizar el pago por transferencia bancaria. Si necesita más ayuda, por favor contacte con nuestro servicio de atención al cliente en classics@okycoky.com o en el número de teléfono +34 986 240001</p>
		<p style='color:#999 !important; font-size:12px;'>The payment process had and error and your order is waiting for payment, please visit your order and try again, if this error persist maybe your credit card doesn't allow online payments, contact with your bank for more details. Also you finish your order choosing bank transfer. If you need any help please contact with our costumer service at classics@okycoky.com or the phone number +34 986 240001.</p>
		<p style='text-align:center;margin-top:30px;'><a style='padding:10px 20px;border:1px solid #000;text-transform:uppercase;text-decoration:none;color:black !important;font-size:18px;margin:5px' href='http://www.okycoky.net/classics/show_details.php?id_order=last'>Ver mi último pedido</a></p>
		<p style='text-align:center;margin-top:40px;'><a style='padding:10px 20px;border:1px solid #999;text-transform:uppercase;text-decoration:none;color:#999 !important;font-size:18px;margin:5px' href='http://www.okycoky.net/classics/show_details.php?id_order=last'>Go to last order</a></p>


			<br/><br/><br/>
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

echo $mail_content;
//mail($user["email"],'Esperando Pago | Waiting for payment #'.$payment["id_order"],$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");
//mail($contact_email,'Esperando Pago | Waiting for payment #'.$payment["id_order"],$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");
?>
