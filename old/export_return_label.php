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
	<div style='border:2px dashed #000;padding:40px 20px;margin:20px;'>
		<table>
			<tr>
				<td style='width:650px;'>
					<img src='".$dir."/img/interface/okycoky-logo.png' style='margin-bottom:40px;'>
					<br/>
					<div style='font-size:24px;text-transform:uppercase;'>
						<strong style='font-size:54px;'>ROTELPA S.A.</strong>
						<br>  P. Tec. Log&iacute;stico,<br/> calle C, nave C1<br>  36312 VIGO (Spain)<br>  Tlf.: +34 986240001 | Fax: +34 986240449<br>
					</div>
				</td>
				<td style='text-align:right;width:330px;'>
					<div style='border:1px solid #999;width:355px;padding:10px;text-align:center'>
						<h1  style='text-align:center;color:#666'>RETURN CODE</h1>
						<h1 style='font-size:60px;'>".strtoupper(dechex($return["created"]))."</h1>
						<p style='font-size:12px'>ASEGURESE QUE EL CÓDIGO SE LEA CORRECTAMENTE</p>
						<p style='font-size:12px'>BE SURE THE CODE CAN BE READ CORRECTLY</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
";
	
echo $html;

?>
<script>
	print();
</script>