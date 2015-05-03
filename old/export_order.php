<?php
$dir="./";
@session_start();
if (!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$error=false;
if(!isset($_GET["id_order"])){
	$error = true;
}
$page = "admin_show_details";
include_once("./include/front_settings.php");
include_once("./include/users.php");
include_once("./include/orders.php");
include_once("./include/products.php");
include_once("./include/colors.php");
include_once("./include/bdOC.php");
if(!$error){
	$order = getOrderData($_GET["id_order"]);
	$lines_tmp = getOrderLines($_GET["id_order"]);
}
$client_tmp["id_client"] = $order["id_client"];

$clientdata = userData($client_tmp);
if($clientdata["id_elastic"]==0){
	$clientdata["id_elastic"]="000000";
}
$client["id_currency"] = $clientdata["id_currency"];

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;
	$s["family_0"] = "";
$s["family_19"]="Varios";
	$s["family_20"]="Tejido";
$s["family_21"]="Componentes";
$s["family_22"]="Tej. Muestrario";
$s["family_23"]="Abrigos";
$s["family_24"]="Blusas";
$s["family_25"]="Camisetas";
$s["family_26"]="Cinturones";
$s["family_27"]="Chaquetas";
$s["family_28"]="Chaq. Ligeras";
$s["family_29"]="Echarpes";
$s["family_30"]="Faldas";
$s["family_31"]="Chalecos";
$s["family_32"]="Pantalones";
$s["family_33"]="Pantalones oky's";
$s["family_36"]="Vestidos";
$s["family_37"]="Tops";
$s["family_38"]="Forros";
$s["family_39"]="Complementos";
$s["family_40"]="Prendas Morocco";
$s["family_41"]="Cuellos";
$s["family_42"]="Blus. Dresslok";
$s["family_43"]="Camisetas Dresslok";
$s["family_44"]="Chaq. Okys";
$s["family_46"]="Guantes";
$s["family_47"]="Collares";
$s["family_48"]="Tocados";
$s["family_49"]="Foulards";
$s["family_50"]="Zapatos";
$s["family_51"]="Estolas";
$s["family_52"]="Shorts";
$s["family_53"]="Boleros";
$s["family_54"]="Cazadoras";
$s["family_55"]="Blazers";
$s["family_56"]="Monos";
$s["family_57"]="Pulseras";
$s["family_58"]="Pendientes";
$s["family_59"]="Capas";
$s["family_60"]="Chaquetones";
$s["family_61"]="Camisas";
$s["family_62"]="Punto";
$s["family_63"]="Sueters";
$s["family_65"]="Conjuntos";
$s["family_69"]="Polos";


if($order["order_state"]==0){
	$order_info="Estado: Nuevo |";
}else if($order["order_state"]==1){
	$order_info="Estado: Enviado |";
}else if($order["order_state"]==2){
	$order_info="Estado: Cancelado |";
}else if($order["order_state"]==3){
	$order_info="Estado: Procesando |";
}else if($order["order_state"]==4){
	$order_info="Estado: Cancelado por el Usuario |";
}

if($order["payed"]==0){
	$order_info.=" Pago no confirmado";
}else if($order["payed"]==1){
	$order_info.=" Pago confirmado";
}
if($order["payment_method"]=="credit_card"){
	$order_info.=" con tarjeta";
}else if ($order["payment_method"]=="bank_transfer"){
	$order_info.=" por transferencia";
}



$html="
<!DOCTYPE html>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html  b:version='2' class='v2'>
<head>
	<meta http-equiv='content-type' content='text/html' charset='utf-8' />
</head>
<style type='text/css'>
	#invoice tr td{
		padding:5px;border:1px solid #000;text-align:center;
	}
	#invoice tr th{padding:5px;border:1px solid #000;text-align:center;width:12px;}
	#images{width:650PX;margin-top:20px;}
	#images td{width:125px;height:250px;margin-top:10px;text-align:center}
	#images img{width:150px}
</style>
<body class='' style='background-color:#ffffff;min-width:1000px;max-width:1000px; font-family:sans-serif;font-size:14px;'>
	<div>
		<table>
			<tr>
				<td style='width:650px;'>
					<img src='".$dir."/img/interface/okycoky-logo.png' style='margin-bottom:10px;'>
					<br/>
					<div style='font-size:12px;'>
						<strong>ROTELPA S.A.</strong>
						<br>  P. Tec. Log&iacute;stico, calle C, nave C1<br>  36315 VIGO (Spain)<br>  Tlf.: +34 986240001 | Fax: +34 986240449<br>  info@okycoky.com | www.okycoky.com
					</div>
				</td>
				<td style='text-align:right;width:330px;'>
					DIRECCIÓN DE FACTURACIÓN
					<div style='border:1px solid #000;width:355px;padding:10px;'>
						<b style='text-transform:uppercase'>".$order["invoice_address_name"]." ".$order["invoice_address_subname"]."</b><br>
						DNI ".$order["invoice_address_DNI"]."<br>
						".$order["invoice_address_address_1"]."<br>
						".$order["invoice_address_address_2"]."<br>
						".$order["invoice_address_post_code"]." - ".$order["invoice_address_city"]."<br>
						".$order["invoice_address_province"]." ( ".$order["invoice_address_country"]." )<br>
						TLF: ".$order["invoice_address_mobile"]." ".$order["invoice_address_other"]."
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div style='padding:20px 0px;text-transform:uppercase;font-size:25px;'>OKY^COKY CLASSICS ".date("Y")."</div>
		<div>
			<table style='border-collapse:collapse;' id='invoice'>
			<tr>
				<td style=';font-size:15px;width:350px;'>
					<strong>PEDIDO</strong>
					<br/>&nbsp;#".$order["id_order"]."&nbsp;
				</td>
				<td style=';font-size:15px;width:250px;'>
					<strong>FECHA</strong>
					<br/>  &nbsp;".date("d/m/Y H:i",$order["date"])."&nbsp;
				</td>
				<td style=';font-size:12px;width:250px;'>
					<strong>IDENTIFICADOR</strong>
					<br/>  W".$clientdata["id_client"]."-E".$clientdata["id_elastic"]."
				</td>
				<td rowspan=3 style='text-align:right;font-size:14px;width:367px;vertical-align:top'>
					DIRECCIÓN DE ENVÍO<BR/>
					<b style='text-transform:uppercase'>".$order["shipping_address_name"]." ".$order["shipping_address_subname"]."</b><br>
						".$clientdata["email"]."<br>
						".$order["shipping_address_address_1"]."<br>
						".$order["shipping_address_address_2"]."<br>
						".$order["shipping_address_post_code"]." - ".$order["shipping_address_city"]."<br>
						".$order["shipping_address_province"]." ( ".$order["shipping_address_country"]." )<br>
						TLF: ".$order["shipping_address_mobile"]." ".$order["shipping_address_other"]."
				</td>
			</tr>
			<tr>
				<td colspan=3 style='height:50px;max-height:50px;text-align:left;vertical-align:top;padding:10px;'>
					<strong>COMENTARIO</strong>
					<br/>".$order["user_comment"]."&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan=3 style='height:50px;max-height:50px;text-align:left;vertical-align:top;padding:10px;'>
					".$order_info."&nbsp;
				</td>
			</tr>
	</table>
</div>";
$html_images=$html;

$html.="
	<table class='table' id='invoice' style='margin-top:10px;border-collapse:collapse'>
		<thead>
			<tr style='border:1px solid #000'>
				<th style='width:80px;;padding:5px;'>
					CODIGO
				</th>
				<th style='width:200px;'>
					COLOR
				</th>
				<th style='width:70px;;'>
					FAMILIA
				</th>
				<th >
					34
				</th>
				<th >
					36
				</th>
				<th >
					38
				</th>
				<th >
					40
				</th>
				<th >
					42
				</th>
				<th >
					44
				</th>
				<th >
					46
				</th>
				<th >
					48
				</th>
				<th >
					50
				</th>
				<th >
					52
				</th>
				<th style='width:20px'>
					CANT.
				</th>
				<th style='width:150px'>
					PRECIO
				</th>
				<th style='width:150px'>
					TOTAL
				</th>
			</tr>
		</thead>
	<tbody>";
    $count=0;
	while($lines = db_fetch($lines_tmp)){
		for ($i=1;$i<=10;$i++){
			if($lines["size_".$i]==0){
				$lines["size_".$i]="";
			}
		}
		$price = number_format($lines["unitary_price"]/(1.21),2);
		$linetotal = $price * $lines["subclothes"];
		$total_neto += number_format($linetotal,2);
		$total_bruto += number_format($lines["subtotal"],2);
		$product = productDataFromSerialModel($lines["serial_model_code"]);
		$color = colorData($lines["id_color"]);
		$idcolor = $color["name_id_color"];
		$html.="<tr style='height:25px;";
			if(!empty($lines["comment"])){
				$html.="border-bottom:1px solid #f4f4f4;";
			}
		$html.="'>
		<td >
			".$lines["serial_model_code"]."
		</td>
		<td style='text-align:left'>
			( ".$idcolor." ) ".$color["name"]."
		</td>
		<td style='text-transform:uppercase;text-align:left'>
		".$s["family_".$product["id_family"]]."</td><td >".$lines["size_1"]."</td><td >".$lines["size_2"]."</td><td >".$lines["size_3"]."</td><td >".$lines["size_4"]."</td><td >".$lines["size_5"]."</td><td >".$lines["size_6"]."</td><td >".$lines["size_7"]."</td><td >".$lines["size_8"]."</td><td >".$lines["size_9"]."</td><td >".$lines["size_10"]."</td>
		<td >".$lines["subclothes"]."</td>
		<td style='text-align:right'>".number_format($price,2)."€ ( ".number_format($lines["unitary_price"],2)."€ )</td>
		<td style='text-align:right'>".number_format($linetotal,2)."€ ( ".number_format($lines["subtotal"],2)."€ )</td>
		</tr>";
	               $count++;
	               if(!empty($lines["comment"])){
		               $html.="<tr style='height:25px;border-top:1px solid #f4f4f4'><td colspan='16' style='text-align:left'><b>".$s["comment"]." :</b> ".$lines["comment"]."</td></tr>";
					   $count++;
	               }
				}
				$limit=30;
				
				while($count<$limit){
					$html.="<tr style='height:25px;'><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr>";
	                $count++;

				}
				$shipping_price=number_format($order["shipping_method_price"]/(1.21),2);
				$total_neto += $shipping_price;
			$html.="
			<tr>
				<td colspan='15' style='text-align:right'>
					<b>MÉTODO DE ENVÍO</b> : ". $order["shipping_method_name"]."</td>
				<td style='text-align:right' id='totamountfin'><b>".number_format($shipping_price,2)." ".$currency["symbol"]."</b> ( ". number_format($order["shipping_method_price"],2)." ".$currency["symbol"]." )</td>
			</tr>";
			if($order["promo_code_amount"]>0){
					$total_neto -= ($order["promo_code_amount"]/1.21);
					$html.="
					<tr>
						<td colspan='15' style='text-align:right'>
							<b>CÓDIGO PROMOCIONAL</b></td>
							<td style='text-align:right' id='totamountfin'><b>-".number_format(($order["promo_code_amount"]/1.21),2)." ".$currency["symbol"]."</b> ( -". number_format($order["promo_code_amount"],2)." ".$currency["symbol"]." )</td>
				</tr>";
				}
				
			$html.="<tr style='height:30px'><td style='text-align:right' colspan=13><strong>NÚMERO DE PRENDAS</strong></td><td style='text-align:right' ><strong>".$order["num_clothes"]."</strong></td><td style='text-align:right' ><strong>SUBTOTAL</strong></td><td style='text-align:right'><strong>".number_format($total_neto,2)."€</strong></td></tr>";
			
				if($order["discount"]>0){
					$html.="<tr><td style='text-align:right' colspan=15><strong>DESCUENTO ".$order["discount"]."%</strong></td><td style='text-align:right'><strong>".$order["total_discount"]."€</strong></td></tr>";
				}
				
				
				
				$html.="<tr><td style='text-align:right' colspan=14><strong>BASE IMPONIBLE </strong></td><td style='text-align:right' ><strong>IVA - (21%)</strong></td><td style='text-align:right'><strong>TOTAL</strong></td></tr>";
				$total_iva = (number_format($total_neto,2)-number_format($order["total_with_discount"],2))*-1;
				
              	$html.="<tr><td style='text-align:right' colspan=14><strong>".number_format($total_neto,2)."€</strong></td><td style='text-align:right' ><strong>".number_format($total_iva,2)."€</strong></td><td style='text-align:right'><strong>".number_format($order["total_with_discount"],2)."€</strong></td></tr></tbody></table></div>";

         
$html.="</body></html>";

	
echo $html;

?>
<script>
	print();
</script>