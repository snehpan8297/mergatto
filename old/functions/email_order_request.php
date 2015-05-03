<?php
$dir = dirname(dirname(__FILE__));
include_once($dir."/functions/get_lang.php");
include_once($dir."/include/includes.php");
include_once($dir."/include/front_settings.php");

$order=getOrderData($payment["id_order"]);
$lines_tmp=getOrderLines($payment["id_order"]);
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
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Gracias por comprar en Oky^Coky</h3>
		<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'><span style='color:#999'>Thanks for ordering from Oky^Coky</span></h3>
		<p style='color:#000 !important; font-size:12px;'><span style='text-transform:uppercase'>Tu número de pedido es #".$payment["id_order"]."</span>. Comprobaremos que todos los productos que has solicitado están en nuestro stock y que todo es correcto, normalmente el proceso de procesar los pedidos para envío nos lleva entre 0 y 3 días laborables. Este tiempo no incluye el tiempo de envío. Te enviaremos otro email cuando enviemos tu pedido para mantenerte informado. Para comprobar el estado de tu pedido, visita: <a href='".$url_base."show_details.php?id_order=".$payment["id_order"]."'>".$url_base."show_details.php?id_order=".$payment["id_order"]."</a></p>
		<p style='color:#999 !important; font-size:12px;'><span style='text-transform:uppercase'>Your order number is #".$payment["id_order"].".</span> Your order has been submitted and is in the queue to be processed. If all items you ordered are in stock, it will take about 0 - 3 business days for your order to be processed and marked as shipped. This time does not include ship time. We will be sending you another email when we ship your order. To check the status of your order, please visit: <a href='".$url_base."show_details.php?id_order=".$payment["id_order"]."'>".$url_base."show_details.php?id_order=".$payment["id_order"]."</a></p>

		<br/><br/>

		<table style='width:100%;border-collapse:collapse;font-size:12px;'>
			<tr>
				<th style='background-color:#f4f4f4;color:#000;padding:5px 10px;font-weight:300;padding:10px'>".$s["table_label_name_and_size_selection"]."</th>
				<th style='background-color:#f4f4f4;color:#000;padding:5px 10px;font-weight:300;padding:10px;text-align:right;'>".$s["table_label_unitary_price"]."</th>
				<th style='background-color:#f4f4f4;color:#000;padding:5px 10px;font-weight:300;padding:10px;text-align:right;'>".$s["table_label_amount"]."</th>
			</tr>";
			$portage=-1;
			while($lines=db_fetch($lines_tmp)){
				if ($lines["serial_model_code"]==getPortageCode()) {
					$portage=$lines["price"];
					continue;
				}
				$product=productDataFromSerialModel($lines["serial_model_code"]);
				$name=$product["name_".$lang];
				if (($lang!="es")&&($product["name_".$lang]!="")) $name=$product["name_".$lang];
				$description=$product["description_".$lang];
				if (($lang!="es")&&($product["description_".$lang]!="")) $description=$product["description_".$lang];
				$composition=$product["composition_".$lang];
				if (($lang!="es")&&($product["composition_".$lang]!="")) $composition=$product["composition_".$lang];
				$price_tmp=strval($lines["unitary_price"]);
				$price_vector=explode(".",$price_tmp);
				$price_string=$price_vector[0];
				if(isset($price_vector[1])){
					if(strlen($price_vector[1])==1){
						$price_string.=$price_vector[1]."0";
					}else{
						$price_string.=$price_vector[1];
					}
				}else{
					$price_string.=".00";
				}
				$subtotal_tmp=strval($lines["subtotal"]);
				$subtotal_vector=explode(".",$subtotal_tmp);
				$subtotal_string=$subtotal_vector[0];
				if(isset($subtotal_vector[1])){
					if(strlen($subtotal_vector[1])==1){
						$subtotal_string.=$subtotal_vector[1]."0";
					}else{
						$subtotal_string.=$subtotal_vector[1];
					}
				}else{
					$subtotal_string.=".00";
				}
				$color=colorData($lines["id_color"]);
				if(!empty($product["id_product"])) {
					$images=productImages($product["id_product"]);
					$image=db_fetch($images);
				}
				$sizes = explode(",",$lines["allsizes"]);
				$mail_content .="<tr id='".$lines["id_line"]."'>";


				$mail_content .="<td style='padding:10px 20px;'>
					<div class='important'>
					<a style='color:#000 !important;text-decoration:none' href='".$url_base."product.php?p=".$product["id_product"]."&f=".$product["id_family"]."&pag=0'>".$name." (" . $color["name"] . ")"." ".$lines["serial_model_code"]."</a>
					</div>
					<div style='margin:5px 0px;color:#666'>";
							$sizes_count=0;
							for($size=1;$size<sizeof($sizes);$size++){
								if(!empty($sizes[$size])){
									if($lines["size_".$size]>0){
										 $mail_content .=$s["size"]." ".$sizes[$size-1]." : ".$lines["size_".$size]." ".$s["clothes"];
									}

									$sizes_count++;

								}
							}

				$mail_content .="
					</div>
				</td>
				<td style='text-align:right;'>".$price_string." €</td>
				<td style='text-align:right;'>".$subtotal_string." €</td>
			</tr>";
			}
			$mail_content .="
			<tr>
				<td style='padding:10px 20px;'>".$s["ship_method"]." : ".$order["shipping_method_name"]."</td>
				<td style='text-align:right;'>--</td>
				<td style='text-align:right;'>".$order["shipping_method_price"]." €</td>
			</tr>
			";
			if($order["promo_code_amount"]>0){
				$mail_content.="
				<tr>
					<td style='padding:10px 20px;'>".$s["promo_code"]."</td>
					<td style='text-align:right;'>--</td>
					<td style='text-align:right;'>- ".$order["promo_code_amount"]." €</td>
				</tr>";
			}
			$mail_content .="
			<tr>
				<td colspan='5' style='background-color:#f4f4f4;color:#000;padding:5px 10px;font-weight:300;padding:10px;text-align:right;'>"."<span id='total'>".$order["total"]."</span> € ( <span id='num_clothes'>".$order["num_clothes"]."</span> ".$s["clothes"]." )"."</h4></td>
			</tr>
			</table>
			<p style='text-align:center;margin-top:30px;'><a style='padding:10px 20px;border:1px solid #000;text-transform:uppercase;text-decoration:none;color:black !important;font-size:18px;margin:5px' href='".$url_base."show_details.php?id_order=".$payment["id_order"]."'>Ir al Pedido</a></p>
		<p style='text-align:center;margin-top:40px;'><a style='padding:10px 20px;border:1px solid #999;text-transform:uppercase;text-decoration:none;color:#999 !important;font-size:18px;margin:5px' href='".$url_base."show_details.php?id_order=".$payment["id_order"]."'>Go to Order</a></p>
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

mail($user["email"],'Oky^Coky - Factura #'.$payment["id_order"],$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");
mail($contact_email,'Oky^Coky - Pedido Pagado #'.$payment["id_order"]." ( ".$order["total_with_discount"]." € | Pasarela ) [Copia]",$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky<sales@okycoky.com>");
?>
