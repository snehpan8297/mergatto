<?php
$dir="./";
@session_start();
if (!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$error=false;
if(!isset($_GET["code"])){
	$error = true;
	die();
}
$page = "admin_show_details";
include_once("./include/inbd.php");
$table='returns';
$filter=array();
$filter["created"]=array("operation"=>"=","value"=>hexdec($_GET["code"]));
$return=getInBD($table,$filter);
$return["total_no_tax"] = 0;

$table="return_lines";
$filter=array();
$filter["id_return"]=array("operation"=>"=","value"=>$return["id_return"]);
$return_lines=listInBD($table,$filter);


$return_methods_s["credit_card"]="Reintegro Tarjeta";
$return_methods_s["bank_transfer"]="Ingreso Cuenta Bancaria";
$return_methods_s["gift_card"]="Tarjeta Regalo";

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
					<div style='border:1px solid #000;width:355px;padding:10px;'>
						DATOS DEL CLIENTE<BR/>
						<b style='text-transform:uppercase'>".$return["invoice_address_name"]." ( #".$return["id_client"]." )</b><br>
						DNI ".$return["invoice_address_DNI"]."<br>
						".$return["invoice_address_email"]."<br>
						".$return["invoice_address_address_1"]."<br>
						".$return["invoice_address_address_2"]."<br>
						".$return["invoice_address_post_code"]." - ".$return["invoice_address_city"]."<br>
						".$return["invoice_address_province"]." ( ".$return["invoice_address_country"]." )<br>
						TLF: ".$return["invoice_address_mobile"]." ".$return["invoice_address_other"]."
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div style='padding:20px 0px;text-transform:uppercase;font-size:25px;'>DEVOLUCIÓN #".$return["id_return"]." | OKY^COKY CLASSICS ".date("Y")."<span style='float:right'>RETURN CODE ".strtoupper(dechex($return["created"]))."</span></div>
		<div>
			<table style='border-collapse:collapse;' id='invoice'>
			<tr>
				<td style=';font-size:15px;width:350px;'>
					<strong>DEVOLUCIÓN</strong>
					<br/>&nbsp;#".$return["id_return"]."&nbsp;
				</td>
				<td style=';font-size:15px;width:350px;'>
					<strong>PEDIDO</strong>
					<br/>&nbsp;#".$return["id_order"]."&nbsp;
				</td>
				<td style=';font-size:15px;width:250px;'>
					<strong>FECHA</strong>
					<br/>  &nbsp;".date("d/m/Y",$return["created"])."&nbsp;
				</td>
				<td rowspan=2 style='text-align:right;font-size:14px;width:367px;vertical-align:top'>
					DIRECCIÓN DE RECOGIDA<BR/>
					<b style='text-transform:uppercase'>".$return["shipping_address_name"]."</b><br>
						".$return["shipping_address_address_1"]."<br>
						".$return["shipping_address_address_2"]."<br>
						".$return["shipping_address_post_code"]." - ".$return["shipping_address_city"]."<br>
						".$return["shipping_address_province"]." ( ".$return["shipping_address_country"]." )<br>
						TLF: ".$return["shipping_address_mobile"]." ".$return["shipping_address_other"]."
				</td>
			</tr>
			<tr>
				<td colspan=3 style='height:50px;max-height:50px;text-align:left;vertical-align:top;padding:10px;'>
					<strong>COMENTARIO</strong>
					<br/>".$return["user_comment"]."&nbsp;
				</td>
			</tr>
	</table>
</div>";
$html_images=$html;

$html.="
	<table class='table' id='invoice' style='margin-top:10px;border-collapse:collapse'>
		<thead>
			<tr style='border:1px solid #000'>
				<th style='width:341px;;padding:5px;text-align:left'>
					CODIGO
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
	foreach($return_lines as $key=>$return_line){
		for($i=1;$i<=10;$i++){
			if($return_line["size_".$i]==0){
				$return_line["size_".$i]="";
			}
		}
		$html.="
			<tr>
				<td style='text-align:left'>".$return_line["product_code"]."</td>
				<td>".$return_line["size_1"]."</td>
				<td>".$return_line["size_2"]."</td>
				<td>".$return_line["size_3"]."</td>
				<td>".$return_line["size_4"]."</td>
				<td>".$return_line["size_5"]."</td>
				<td>".$return_line["size_6"]."</td>
				<td>".$return_line["size_7"]."</td>
				<td>".$return_line["size_8"]."</td>
				<td>".$return_line["size_9"]."</td>
				<td>".$return_line["size_10"]."</td>
				<td>".$return_line["num_products"]."</td>";
			
			$return_line["unitary_price_no_tax"] = number_format($return_line["unitary_price"]/1.21,2);
			$return_line["total_no_tax"] = number_format($return_line["total"]/1.21,2);
			$return["total_no_tax"] += $return_line["total_no_tax"];
								
			$html.="
				<td style='text-align:right'>".$return_line["unitary_price_no_tax"]." € ( ".$return_line["unitary_price"]."€ )</td>
				<td style='text-align:right'>".$return_line["total_no_tax"]." € ( ".$return_line["total"]."€ )</td>
			</tr>
		";
	}
	$limit=30;
	while($count<$limit){
		$html.="<tr style='height:25px;'><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr>";
	    $count++;
	}	
	
	$html.="
	<tr style='height:30px'>
		<td style='text-align:right' colspan=11>
			<strong>NÚMERO DE PRENDAS</strong>
		</td>
		<td >
			<strong>".$return["num_clothes"]."</strong>
		</td>
		<td style='text-align:right' >
			<strong>TOTAL</strong>
		</td>
		<td style='text-align:right'>
			<strong>".$return["total_no_tax"]." € ( ".$return["total"]."€ )</strong>
		</td>
	</tr>
	<tr style='height:30px'>
		<td style='text-align:right' colspan=12>
			METODO DE DEVOLUCIÓN
		</td>
		<td style='text-align:right' colspan=3>
			<strong>".$return_methods_s[$return["return_method"]]."</strong>
		</td>
	</tr>
	<tr style='height:30px'>
		<td style='text-align:right' colspan=15>
			".$return["return_method_info"]."
		</td>
	</tr>
	</tbody>
	</table>
	</div>
	";	
          
$html.="</body></html>";

	
echo $html;

?>
<script>
	print();
</script>