<?php
//Lang revisado
/*
	Login ADMIN
	------
	Decripción
	
*/
@session_start();

if (!(isset($_SESSION['admin_classics']))){
	header("location:./admin.php");
}
$page="admin";
include("header.php");
include_once("include/inbd.php");

$table="order_request";
$filter=array();
$field="total_with_discount";
$filter["date"]=array("operation"=>">","value"=>1417125600);
$filter["complex"]="payed = 1 OR (payed = 0 AND payment_method = 'bank_transfer')";
$order_count_black=countInBD($table,$filter);
$amount_black=sumInBD($table,$filter,$field);
$amount_black=round($amount_black);

$filter["date"]=array("operation"=>">","value"=>strtotime('-1 day'));
$filter["complex"]="payed = 1 OR (payed = 0 AND payment_method = 'bank_transfer')";
$order_count_day=countInBD($table,$filter);
$amount_day=sumInBD($table,$filter,$field);
$amount_day=round($amount_day);
$filter=array();
$filter["payed"]=array("operation"=>"=","value"=>1);
$filter["date"]=array("operation"=>">","value"=>strtotime('-1 day'));
$order_count_tmp=countInBD($table,$filter);
$amount_tmp=sumInBD($table,$filter,$field);
$filter["payed"]=array("operation"=>"=","value"=>1);
$filter["date"]=array("operation"=>">","value"=>strtotime('-2 day'));
$order_count_yesterday=countInBD($table,$filter);
$amount_yesterday=sumInBD($table,$filter,$field);
$amount_yesterday=round($amount_yesterday);
$order_count_yesterday-=$order_count_tmp;
$amount_yesterday-=$amount_tmp;
$filter["date"]=array("operation"=>">","value"=>strtotime('-1 month'));
$order_count_month=countInBD($table,$filter);
$amount_month=sumInBD($table,$filter,$field);
$amount_month=round($amount_month);
$filter=array();
$filter["payed"]=array("operation"=>"=","value"=>1);
$filter["complex"]="date > ".strtotime('-1 year')." AND date < 1417125600";

$order_count_year=countInBD($table,$filter);
$amount_year=sumInBD($table,$filter,$field);
$amount_year=round($amount_year);
$field="num_clothes";
$clothes_year=sumInBD($table,$filter,$field);

?>
<div id='content'>
	<h1 style='font-size:24px;margin-bottom:10px;'>BLACK FRIDAY</h1>
	<div style='overflow:auto;margin-bottom:20px;'>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black;margin-right:20px;'>
			<p style='font-size:40px'>
				<?php echo $order_count_black;?><br/>
				<span style='font-size:14px'>Pedidos</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $amount_black;?> &euro; <br/>
				<span style='font-size:14px'>Facturado</span>
			</p>
		</div>
	</div>
	<h1 style='font-size:24px;margin-bottom:10px;'>&Uacute;ltimas 24 horas</h1>
	<div style='overflow:auto;margin-bottom:20px;'>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black;margin-right:20px;'>
			<p style='font-size:40px'>
				<?php echo $order_count_day;?><br/>
				<span style='font-size:14px'>Pedidos</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $amount_day;?> &euro; <br/>
				<span style='font-size:14px'>Facturado</span>
			</p>
		</div>
	</div>
	<h1 style='font-size:24px;margin-bottom:10px;'>Ayer</h1>
	<div style='overflow:auto;margin-bottom:20px;'>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black;margin-right:20px;'>
			<p style='font-size:40px'>
				<?php echo $order_count_yesterday;?><br/>
				<span style='font-size:14px'>Pedidos</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $amount_yesterday;?> &euro; <br/>
				<span style='font-size:14px'>Facturado</span>
			</p>
		</div>
	</div>
	<h1 style='font-size:24px;margin-bottom:10px;'>&Uacute;ltimo Mes</h1>

	<div style='overflow:auto;margin-bottom:20px;'>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black;margin-right:20px;'>
			<p style='font-size:40px'>
				<?php echo $order_count_month;?><br/>
				<span style='font-size:14px'>Pedidos</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $amount_month;?> &euro; <br/>
				<span style='font-size:14px'>Facturado</span>
			</p>
		</div>
	</div>
	
	<h1 style='font-size:24px;margin-bottom:10px;'>&Uacute;ltimo A&ntilde;o</h1>

	<div style='overflow:auto;margin-bottom:20px;'>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black;margin-right:20px;'>
			<p style='font-size:40px'>
				<?php echo $order_count_year;?><br/>
				<span style='font-size:14px'>Pedidos</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $amount_year;?> &euro; <br/>
				<span style='font-size:14px'>Facturado</span>
			</p>
		</div>
		<div style='float:left; background-color:#f4f4f4;padding:10px 40px;text-align:center;color:black'>
			<p style='font-size:40px'>
				<?php echo $clothes_year;?>  <br/>
				<span style='font-size:14px'>Prendas</span>
			</p>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
