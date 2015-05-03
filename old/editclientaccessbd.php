<?php


@session_start();
include("./include/includes.php");
$_POST["client_code"] = 0;
$_POST["web_active"] = "checked";

if(isset($_POST["client_code"])){
	$edit["client_code"]=$_POST["client_code"];
	
	if($_POST["web_active"]=="checked"){
		$edit["web_active"]=1;
		$edit["access_request"]=0;
	}else{
		$edit["web_active"]=0;
	$edit["access_request"]=1;
	}
	//updateUser($edit);
    if($_POST["web_active"]=="checked"){
    include_once("../functions/get_lang.php");
	include_once("../include/front_settings.php");
	include_once("../include/settings.php");
	
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
	<div style='display:block;margin:auto;margin:10px 0px;text-align:center'><img style='margin:auto;min-height:30px;max-height:30px' src='".$url_base."img/interface/okycoky-logo.png'/></div>
	<div class='content' style='margin:20px;font-weight:100;font-size:14px;'>
		<br/>
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Bienvenido a nuestra tienda online</h3>
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'><span style='color:#999'>Welcome to our online shop</span></h3>
		<p style='color:#000 !important; font-size:12px;>Ya estás registrado en nuestra tienda online, ahora podrás empezar descubrir nuestros mejores prendas al mejor precio. En caso de que tengas alguna duda, por favor contacta con nuestro servicio de atención al cliente en el número (+34) 986 240001 o en el correo electrónico classics@okycoky.com. Si no te funciona el botón para acceder a tu cuenta, copia y pega la direccción http://www.okycoky.net/classics/login.php en tu navegador.</p>
		<p style='color:#999 !important; font-size:12px;'>You just finished our signup procces, now you can discover our best clothes at the best price. If you have any questions, please contact our customer service at (+34) 986 240001 or email reatailers@okycoky.com. If the button doesn't work, copy and paste the url http://www.okycoky.net/classics/login.php in your web navigator</p>
		
		<p style='text-align:center;margin-top:30px;'><a style='padding:10px 20px;border:1px solid #000;text-transform:uppercase;text-decoration:none;color:black !important;font-size:18px;margin:5px' href='http://www.okycoky.net/classics/login.php'>Acceder a la tienda</a></p>
		<p style='text-align:center;margin-top:40px;'><a style='padding:10px 20px;border:1px solid #999;text-transform:uppercase;text-decoration:none;color:#999 !important;font-size:18px;margin:5px' href='http://www.okycoky.net/classics/login.php'>Go to shop</a></p>
		<br/><br/><br/><br/>
	</div>
	
	<div style='text-align:center;color:#333;font-weight:100;font-size:12px;padding:20px;background-color:#f4f4f4;'>
		Encuentra nuestras prendas al mejor precio en nuestra tienda online OKY^COKY CLASSICS<br/><br/>
		<a href='http://www.okycoky.net/classics/'><img style='min-height:30px;max-height:30px;'src='http://www.okycoky.net/classics/img/interface/okycoky-logo.png'</a><br/><br/>
		<a href='http://www.okycoky.net/classics/'>http://www.okycoky.net/classics/</a>
	</div>
	<div style='display:block;margin-top:20px;padding:40px 0px;background-color:#222222;overflow:auto;color:#666 !important;font-size:10px;'>
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
		
		".date('Y')." - © Oky^Coky Classics Shop. Todos los derechos reservados<br/><br/>
		<span style='color:#666'>Oky Coky Classics es nuestra tienda outlet online de ropa para mujer, donde podras encontrar los clasicos de OkyCoky y oky's</br>
		<p style='font-size:10px'>Esta información ha sido enviada por el sistema Oky^Coky Classics Shop al email asociado con su cuenta de cliente.</p>
		<p style='font-size:10px'>Para más información sobre la política de privacidad viste nuestra página <a style='color:#999;text-decoration:underline;' href='".$url_base."privacy_policy.php'>".$url_base."privacy_policy.php</a></p>

	</div>
</body>
</html>";

	error_log("[Classsics] [Email] Bienvenido | Welcome START (".$_POST["email"].")");

    mail($_POST["email"],'Bienvenido | Welcome',$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Classics Shop<no-reply@okycoky.net>");
	error_log("[Classsics] [Email] Bienvenido | Welcome OK (".$_POST["email"].")");

	}
	
	
	echo "OK";
}

?>