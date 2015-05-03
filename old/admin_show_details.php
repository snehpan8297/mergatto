 <?php
//Lang revisado
$page="admin";
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
include ("header.php");
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
?>
<script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
<style>
	.cart_data_table { border-collapse: collapse; width: 770px; border-color: #7F3F00;}
	th { padding: 10px 10px; }
	.th-size { width: 8px; padding: 0px; font-size:11px;text-align:center;}
	.cart_data_table td { padding: 5px; }
</style>
<div id='content'>
	<div id='page_header'>
		<div id='page_navigator'>
			<?php
			if($error){
				?>
				<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='./admin_list_orders.php'><?php echo $s["admin_orders"];?></a> / <a href='' class='important'><?php echo $s["cart"]." no encontrado";?></a>
				<?php
			}else{
				?>
				<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='./admin_list_orders.php'><?php echo $s["admin_orders"];?></a> / <a href='' class='important'><?php echo $s["cart"]." : ".$order["id_order"];?></a>
				<?php
			}
			?>
		</div>
	</div>
	<div class='contentbox'>


		<?php
			$table='order_request';
			$filter=array();
			$filter["id_order"]=array("operation"=>"<","value"=>$order["id_order"]);
			$fields=array("id_order");
			$order_table="id_order desc";
			if(isInBD($table,$filter,$fields,$order_table)){
				$prev_order=getInBD($table,$filter,$fields,$order_table);
			}
			$filter=array();
			$filter["id_order"]=array("operation"=>">","value"=>$order["id_order"]);
			$fields=array("id_order");
			$order_table="id_order asc";
			if(isInBD($table,$filter,$fields,$order_table)){
				$next_order=getInBD($table,$filter,$fields,$order_table);
			}
		?>
		<h1 style='font-size:16px;margin-bottom:10px;'><a href='./admin_list_orders.php'>Todos los Pedidos</a> / Pedido #<?php echo $order["id_order"];?>
			<?php
				if(isset($prev_order)){
					?>
					<a class='pull-right' href='./admin_show_details?id_order=<?php echo $prev_order["id_order"];?>'><i class='fa fa-arrow-right'></i></a>
					<?php
				}
				if(isset($next_order)){
					?>
					<a class='pull-right' style='margin-right:10px'  href='./admin_show_details?id_order=<?php echo $next_order["id_order"];?>'><i class='fa fa-arrow-left'></i></a>
					<?php
				}
				?>
		</h1>
		<div class='pull-right' style='padding-top:7px;padding-right:10px;'>
				<a href='./exporter.php?order_id=<?php echo $order["id_order"];?>' target="_blank" class='btn btn-mini btn-dark'>EXPORTAR</a>
			</div>
			<h4 style="margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;font-size:12px;
			<?php
				if($order["exported"]==0){
					echo "background-color:#ffdddd";
				}else{
					echo "background-color:#ddffdd";
				}
			?>
			">EXPORTAR A ELASTIC
			<?php
			if($order["exported"]==0){
				echo "<span style='color:red;white-space: nowrap;' id='export_status'><i class='fa fa-times'></i> No Exportado ";
			}else if($order["exported"]==1){
				echo "<span style='color:green;white-space: nowrap;' id='export_status'><i class='fa fa-check'></i> Exportado ";
			}
			?>
			</h4>
		<div style='margin-bottom:20px;overflo:auto;'>
			<?php
				$table="returns";
				$filter=array();
				$filter["id_order"]=array("operation"=>"=","value"=>$_GET["id_order"]);
				$returns=listInBD($table,$filter);
				foreach ($returns as $key=>$return){
					if($return["status"]==1){
						$row_background="background-color:#fffff4";
						$status_info="<span style='color:orange;white-space: nowrap;font-size:16px;'><i class='fa fa-certificate'></i> Nuevo</span>";
					}else if($return["status"]==2){
						$row_background="background-color:#f4ffff";
						$status_info="<span style='color:blue;white-space: nowrap;font-size:16px;'><i class='fa fa-truck'></i> Recogiendo</span>";
					}else if($return["status"]==3){
						$row_background="background-color:#fff4ff";
						$status_info="<span style='color:purple;white-space: nowrap;font-size:16px;'><i class='fa fa-dropbox'></i> Verificando</span>";
					}else if($return["status"]==4){
						$row_background="background-color:#ffffff";
						$status_info="<span style='white-space: nowrap;font-size:16px;'><i class='fa fa-check'></i> Finalizado</span>";
					}else if($return["status"]==5){
						$row_background="background-color:#ffffff";
						$status_info="<span style='color:red;white-space: nowrap;font-size:16px;'><i class='fa fa-times'></i> Cancelado</span>";
					}
					?>
					<a href='./admin_show_return.php?id_return=<?php echo $return["id_return"];?>' style='margin-top:7px;margin-right:10px;'class='btn btn-mini btn-dark pull-right'>Ver Devolución</a>
					<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;<?php echo $row_background;?>'>DEVOLUCIÓN #<?php echo $return["id_return"];?> | <?php echo strtoupper(dechex($return["created"]));?> <?php echo $status_info;?></h4>

					<?php
				}
			if($order["order_state"]==0){
				$row_background="background-color:#fffff4";
				$status_info="<span style='color:orange;white-space: nowrap;><i class='fa fa-certificate'></i> Nuevo</span>";
				$order_info="Estado: Nuevo |";
			}else if($order["order_state"]==1){
				$row_background="background-color:#ffffff";
				$status_info="<span style='white-space: nowrap;'><i class='fa fa-truck'></i> Enviado</span>";
				$order_info="Estado: Enviado |";
			}else if($order["order_state"]==2){
				$row_background="background-color:#fff4f4";
				$status_info="<span style='color:red;white-space: nowrap;'><i class='fa fa-times'></i> Cancelado</span>";
				$order_info="Estado: Cancelado |";
			}else if($order["order_state"]==3){
				$row_background="background-color:#f4ffff";
				$status_info="<span style='color:green;white-space: nowrap;><i class='fa fa-dropbox'></i> Procesando</span>";
				$order_info="Estado: Procesando |";
			}else if($order["order_state"]==4){
				$row_background="background-color:#fff4f4";
				$status_info="<span style='color:red;white-space: nowrap;'><i class='fa fa-times'></i> Cance. Usuar.</span>";
				$order_info="Estado: Cancelado por el Usuario |";
			}
			?>

			<div class='pull-right' style='padding-top:7px;padding-right:10px;'>
				Actualizar estado
				<select id='order_status' style='margin:0;'>
					<option value='0' <?php if($order["order_state"]==0) echo "selected";?>>Nuevo</option>
					<option value='1' <?php if($order["order_state"]==1) echo "selected";?>>Enviado</option>
					<option value='2' <?php if($order["order_state"]==2) echo "selected";?>>Cancelado</option>
					<option value='3' <?php if($order["order_state"]==3) echo "selected";?>>Procesando</option>
				</select>
				<a href='javascript:save_status();' class='btn btn-mini btn-dark'>Guardar</a>
			</div>
			<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;font-size:12px;'>Estado del Pedido <?php echo $status_info;?></h4>
			<?php
			if($order["payed"]==0){
				$payment_info="<span style='color:red;white-space: nowrap;'><i class='fa fa-check'></i> No Confirm. ";
				$order_info.=" Pago no confirmado";
			}else if($order["payed"]==1){
				$payment_info="<span style='color:green;white-space: nowrap;'><i class='fa fa-check'></i> Confirm. ";
				$order_info.=" Pago confirmado";
			}
			if($order["payment_method"]=="credit_card"){
				$payment_info.="Tarjeta</span>";
				$order_info.=" con tarjeta";
			}else if ($order["payment_method"]=="bank_transfer"){
				$payment_info.="Transferencia</span>";
				$order_info.=" por transferencia";
			}else if ($order["payment_method"]=="paypal"){
				$payment_info.="PayPal</span>";
				$order_info.=" por paypal";
			}
			?>


			<div class='pull-right' style='padding-top:7px;padding-right:10px;'>
				Actualizar Pago
				<select id='payment_method' style='margin:0;'>
					<option value='credit_card' <?php if($order["payment_method"]=="credit_card") echo "selected";?>>Tarjeta</option>
					<option value='bank_transfer' <?php if($order["payment_method"]=="bank_transfer") echo "selected";?>>Transferencia</option>
					<option value='paypal' <?php if($order["payment_method"]=="paypal") echo "selected";?>>PayPal</option>
				</select>
				<select id='payed' style='margin:0;'>
					<option value='0' <?php if($order["payed"]==0) echo "selected";?>>No Confirmado</option>
					<option value='1' <?php if($order["payed"]==1) echo "selected";?>>Confirmado</option>
				</select>
				<a href='javascript:save_payment();' class='btn btn-mini btn-dark'>Guardar</a>
			</div>
			<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;font-size:12px;
			<?php
				if($order["payed"]==0){
					echo "background-color:#ffdddd";
				}else{
					echo "background-color:#ddffdd";
				}
			?>'>Pago <?php echo $payment_info;?></h4>

			<?
			if($order["allow_return"]==0){
				if(((date("U")-$order["date"])<24*60*60*18)){
					if(($order["order_state"]==1)){
						$return_info="En periodo de Devolución";
					}else{
						$return_info="En espera de Envío";
					}
				}else{
					$return_info="<span style='color:red'> Bloquedado</span>";
				}
			}else if($order["allow_return"]==1){
				$return_info="<span style='color:green'>Periodo de Gracia</span>";
			}
			?>
			<div class='pull-right' style='padding-top:7px;padding-right:10px;'>
				Extender periodo
				<select id='allow_return' style='margin:0;'>
					<option value='0' <?php if($order["allow_return"]==0) echo "selected";?>>No</option>
					<option value='1' <?php if($order["allow_return"]==1) echo "selected";?>>Sí</option>
				</select>
				<a href='javascript:save_allow_return();$("#export_status").css("display","none")' class='btn btn-mini btn-dark'>Guardar</a>
			</div>
			<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;font-size:12px;'>Sistema de Devolución <?php echo $return_info;?></h4>


		</div>

				<div>
					<h3>Comentarios Para el usuario</h3>
					<br/>
					<div style='border:1px solid #d0d0d0;border-bottom:none'>
					<?php
						include_once("./include/inbd.php");
						$table="order_comments";
						$filter=array();
						$filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
						$fields=array();
						$table_order="id_order_comment desc";
						$order_comments=listInBD($table,$filter,$fields,$table_order);
						$count=0;
						foreach ($order_comments as $key => $order_comment){
							?>
							<div style='background-color: #f4f4f4;padding:5px 10px;font-size:12px;border-bottom:1px solid #d0d0d0'>
								<a href='javascript:delete_order_comment(<?php echo $order_comment["id_order_comment"];?>)' class='text-danger pull-right'><i class='fa fa-trash-o'></i> Borrar Comentario</a>
								<h4 style='font-size:12px;padding-bottom:5px;'>[<?php echo $order_comment["created"];?>] OKY^COKY TEAM</h4>
								<?php echo $order_comment["content"];?>
							</div>
							<?php
							$count++;
						}
						if($count==0){
							?>
							<div style='background-color: #f4f4f4;padding:10px;border-bottom:1px solid #d0d0d0'>
								No hay comentarios
							</div>

							<?php
						}
					?>
					</div>
					<div class='form_entry' style='margin-top:10px;'>
						<textarea id='new_order_comment_content' style='min-width:100%; height:40px;min-height:40px;max-height:40px;' ></textarea><br/><br/>
						<a href='javascript:add_order_comment(<?php echo $order["id_order"];?>)' class='btn btn-white btn-mini'>Enviar</a>
					</div>
				</div>
				<script>
					function delete_order_comment(id_order_comment){
							$.ajax({
								type : "POST",
								url : "./functions/delete_order_comment.php",
								data : {
									"id_order_comment" : id_order_comment
								},error: function() {
									alert("Error al eliminar comentario en el pedido");
								},
								success : function(msg) {
									if(msg=="OK"){
										location.reload();
									}else{
										alert("Error al eliminar nuevo comentario en el pedido");
									}
								}
							});
					}
					function add_order_comment(id_order){
							$.ajax({
								type : "POST",
								url : "./functions/add_order_comment.php",
								data : {
									"id_order" : id_order,
									"content" : $("#new_order_comment_content").val()
								},error: function() {
									alert("Error al introducir nuevo comentario en el pedido");
								},
								success : function(msg) {
									if(msg=="OK"){
										location.reload();
									}else{
										alert("Error al introducir nuevo comentario en el pedido");
									}
								}
							});
					}
				</script>
				<br/><br/>
<?php

	if(isset($order["user_comment"])&&(!empty($order["user_comment"]))){
		?>
		<div style='border:1px solid orange; color:orange !important;background-color:#fff4d4;padding:10px;margin-bottom:10px;'>
			<h3 style='color:orange !important'>Comentario del Cliente</h3>
			<p><?php echo $order["user_comment"];?></p>
		</div>
		<?php
	}
$html="

<style type='text/css'>
	#invoice tr td{
		padding:5px;border:1px solid #aaaaaa;text-align:center;
	}
	#invoice tr th{padding:5px;border:1px solid #aaaaaa;text-align:center;width:12px;}
	#images{width:650PX;margin-top:20px;}
	#images td{width:125px;height:250px;margin-top:10px;text-align:center}
	#images img{width:150px}
</style>
<div style='border:1px solid #d4d4d4; width: 100%; min-width:680px; margin:auto;'>
	<div style='padding:10px;'>
	<div>
		<table>
			<tr>
				<td style='width:680px;'>
					<img src='./img/interface/okycoky-logo.png' style='height:25px;'>
					<br/>
					<div style='font-size:12px;'>
						<strong>ROTELPA S.A.</strong>
						<br>  P. Tec. Log&iacute;stico, calle C, nave C1<br>  36315 VIGO (Spain)<br>  Tlf.: +34 986240001 | Fax: +34 986240449<br>  info@okycoky.com | www.okycoky.com
					</div>
				</td>
				<td style='text-align:right;width:330px;'>
					DIRECCIÓN DE FACTURACIÓN
					<div style='border:1px solid #666;width:355px;padding:10px;'>
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
	<div style='padding:20px 0px;text-transform:uppercase;font-size:25px;'>Oky^Coky ".date("Y")."</div>
		<div>
			<table style='border-collapse:collapse;' id='invoice'>
			<tr>
				<td style=';font-size:12px;width:350px;'>
					<strong>PEDIDO</strong>
					<br/>&nbsp;#".$order["id_order"]."&nbsp;
				</td>
				<td style=';font-size:12px;width:250px;'>
					<strong>FECHA</strong>
					<br/>  &nbsp;".date("d/m/Y H:i",$order["date"])."&nbsp;
				</td>
				<td style=';font-size:12px;width:250px;'>
					<strong>IDENTIFICADOR</strong>
					<br/>  W".$clientdata["id_client"]."-E".$clientdata["id_elastic"]."
				</td>
				<td rowspan=3 style='text-align:right;font-size:12px;width:367px;vertical-align:top'>
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
				<td colspan=3 style='height:20px;max-height:50px;text-align:left;vertical-align:top;padding:10px;'>
					".$order_info."&nbsp;
				</td>
			</tr>
	</table>
</div>";
$html_images=$html;

$html.="
	<table class='table' id='invoice' style='margin-top:10px;border-collapse:collapse;font-size:10px !important; color:#000'>
		<thead>
			<tr style='border:1px solid #dddddd'>
				<th style='width:80px'>
					CODIGO
				</th>
				<th style='width:220px'>
					COLOR
				</th>
				<th style='width:70px;'>
					FAMILIA
				</th>
				<th style='width:5px'>
					34
				</th>
				<th style='width:5px'>
					36
				</th>
				<th style='width:5px'>
					38
				</th>
				<th style='width:5px'>
					40
				</th>
				<th style='width:5px'>
					42
				</th>
				<th style='width:5px'>
					44
				</th>
				<th style='width:5px'>
					46
				</th>
				<th style='width:5px'>
					48
				</th>
				<th style='width:5px'>
					50
				</th>
				<th style='width:5px'>
					52
				</th>
				<th style='width:5px'>
					CAN
				</th>
				<th style='width:150px'>
					PRECIO
				</th>
				<th style='min-width:150px'>
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
		$line_returned=false;
		$line_returned_str="<span style='color:red'>Linea Devuelta ";
		if($lines["id_product"]==0){
			$table='products';
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$lines["serial_model_code"]);
			$tmp=getInBD($table,$filter);
			$lines["id_product"]=$tmp["id_product"];
		}
		foreach ($returns as $key=>$return){
			$table='colors';
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$lines["id_color"]);
			$tmp = getInBD($table,$filter);
			$table='return_lines';
			$filter=array();
			$filter["id_return"]=array("operation"=>"=","value"=>$return["id_return"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$lines["id_product"]);
			$filter["id_color"]=array("operation"=>"=","value"=>$tmp["id"]);
			if(isInBD($table,$filter)){
				$line_returned_str.=" (#".strtoupper(dechex($return["created"])).") ";
				$line_returned=true;
			}
		}
		error_log("Line returned: ".$filter["id_return"]["value"]." ".$lines["id_product"]." ".$tmp["id"]);
		$line_returned_str.="</span>";

		if($line_returned){
			$html.="<tr style='height:25px;background-color:#fff4ff;";
		}else{
			$html.="<tr style='height:25px;";
		}



		if((!empty($lines["comment"]))||($line_returned)){
			$html.="border-bottom:1px solid #fff4f4;";
		}
		$html.="'>
		<td >
			<a href='product.php?p=".$lines["id_product"]."' target='_blank' style='color:black;text-decoration:underline'>".$lines["serial_model_code"]."</a>
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
				   if((!empty($lines["comment"]))||($line_returned)){
		               $html.="<tr style='height:25px;border-top:1px solid #f4f4f4;";
		               if($line_returned){
						  $html.="background-color:#fff4ff;'><td colspan='16' style='text-align:left'>".$line_returned_str;
					   }else{
			               $html.="'><td colspan='16' style='text-align:left'>";
					   }
					   if(!empty($lines["comment"])){
					   		$html.="<b>".$s["comment"]." :</b> ".$lines["comment"];
		               }

		               $html.="</td></tr>";
					   $count++;
	               }
				}
				$limit=0;

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
					<td colspan='15' style='text-align:right;color:red'>
						<strong>".$s["promo_code"]."</strong></td>
						<td style='text-align:right;color:red' id='totamountfin'>-".number_format(($order["promo_code_amount"]/1.21),2)." ".$currency["symbol"]." ( -". number_format($order["promo_code_amount"],2)." ".$currency["symbol"]." )</td>
			</tr>";
			}



			$html.="<tr style='height:30px'><td style='text-align:right' colspan=13><strong>NÚMERO DE PRENDAS</strong></td><td style='text-align:right' ><strong>".$order["num_clothes"]."</strong></td><td style='text-align:right' ><strong>SUBTOTAL</strong></td><td style='text-align:right'><strong>".number_format($total_neto,2)."€</strong></td></tr>";

      $total_iva = ($total_neto-$order["total_with_discount"])*-1;

				if($order["discount"]>0){
          $total_iva = round($order["total_with_discount"]-($order["total_with_discount"]/1.21),2);
          $total_neto_old=$total_neto;
          $total_neto = round($order["total_with_discount"]/1.21,2);
          $order["total_discount"] = round($total_neto_old-$total_neto,2);
					$html.="<tr><td style='text-align:right' colspan=15><strong>DESCUENTO ".$order["discount"]."%</strong></td><td style='text-align:right'><strong>".$order["total_discount"]."€</strong></td></tr>";
				}
				$html.="<tr><td style='text-align:right' colspan=14><strong>BASE IMPONIBLE </strong></td><td style='text-align:right' ><strong>IVA (21%)</strong></td><td style='text-align:right'><strong>TOTAL</strong></td></tr>";
        $html.="<tr><td style='text-align:right' colspan=14><strong>".number_format($total_neto,2)."€</strong></td><td style='text-align:right' ><strong>".number_format($total_iva,2)."€</strong></td><td style='text-align:right'><strong>".number_format($order["total_with_discount"],2)."€</strong></td></tr></tbody></table></div>";


$html.="</div>";


echo $html;
?>
<!--

		<h1>Pedido: #<?php echo $order["id_order"];?> (<?php echo $order["date"];?>) <?php if($order["user_type"]==1) echo " RETAILER";?></h1>
		<?php
		if($error){
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["my_order_error"];?>
		</div>
		<?php
		}else{
		?>
		<div id='infobox_header' class='infobox_info'>
			<h4><?php echo $s["status_label"]?></h4>
		</div>
		<div id='infobox_header' class='infobox_info' >
			<table>
			<tr id='order_state'>
			<?php
				if($order["order_state"]==0){
					echo "<td><span class='visible_label' style='margin:auto;'></span></td><td>".$s["status"][0]."</td>";
				}else if($order["order_state"]==1){
					echo "<td><span class='accept_label' style='margin:auto;'></span></td><td>".$s["status"][1]."</td>";
				}else if($order["order_state"]==2){
					echo "<td><span class='reject_label' style='margin:auto;'></span></td><td>".$s["status"][2]."</td>";
				}
			?>
			</tr>
			</table>
			<div id='infobox_header' class='infobox_info'>
				<h4><?php echo $s["client_info_label"]; ?></h4>
			</div>
			<div id='infobox_header' class='infobox_info'>
				<table>
				<tr>
					<td class='important' style='font-weight: bold;'><?php echo $s["name"]; ?></td>
					<td><?php echo $clientdata["name"];?> <?php echo $clientdata["subname"];?></td>
				</tr>
				<tr>
					<td class='important' style='font-weight: bold;'><?php echo $s["email"]; ?></td>
					<td><?php echo $clientdata["email"];?></td>
				</tr>
				<tr>
					<td colspan="2" class='important' style='font-weight: bold;'><?php echo $s["client_comment"]; ?></td>
				</tr>
				<tr>
					<td colspan="2"><?php if(!empty($order["user_comment"])){echo $order["user_comment"];}else{ echo $s["no_comment"];}?></td>
				</tr>
				<tr>
					<td class='important' style='width:300px;font-weight: bold;'><?php echo $s["invoice_address"]; ?></td>
					<td class='important' style='font-weight: bold;'><?php echo $s["shipping_address"]; ?></td>
				</tr>
				<tr>
					<td style='vertical-align:top'>

						<table style='font-size:14px !important;'>
							<tr>
								<td><?php echo $s["name"]; ?></td>
								<td><?php echo $order["invoice_address_name"]." ".$order["invoice_address_subname"];?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_dni"]; ?></td>
								<td><?php echo $order["invoice_address_DNI"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_address"]; ?></td>
								<td><?php echo $order["invoice_address_address_1"]; ?></td>
							</tr>
							<tr>
								<td></td>
								<td><?php echo $order["invoice_address_address_2"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_post_code"]; ?></td>
								<td><?php echo $order["invoice_address_post_code"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_city"]; ?></td>
								<td><?php echo $order["invoice_address_city"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_province"]; ?></td>
								<td><?php echo $order["invoice_address_province"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_country"]; ?></td>
								<td><?php echo $order["invoice_address_country"]; ?></td>
							</tr>

							<tr>
								<td><?php echo $s["signup_mobile"]; ?></td>
								<td><?php echo $order["invoice_address_mobile"]; ?></td>
							</tr>
							<tr>
								<td></td>
								<td><?php echo $order["invoice_address_other"]; ?></td>
							</tr>

						</table>
					</td>
					<td style='vertical-align:top'>
						<table style='font-size:14px !important;'>
							<tr>
								<td><?php echo $s["name"]; ?></td>
								<td><?php echo $order["shipping_address_name"]." ".$order["shipping_address_subname"];?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_address"]; ?></td>
								<td><?php echo $order["shipping_address_address_1"]; ?></td>
							</tr>
							<tr>
								<td></td>
								<td><?php echo $order["shipping_address_address_2"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_post_code"]; ?></td>
								<td><?php echo $order["shipping_address_post_code"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_city"]; ?></td>
								<td><?php echo $order["shipping_address_city"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_province"]; ?></td>
								<td><?php echo $order["shipping_address_province"]; ?></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_country"]; ?></td>
								<td><?php echo $order["shipping_address_country"]; ?></td>
							</tr>

							<tr>
								<td><?php echo $s["signup_mobile"]; ?></td>
								<td><?php echo $order["shipping_address_mobile"]; ?></td>
							</tr>
							<tr>
								<td></td>
								<td><?php echo $order["shipping_address_other"]; ?></td>
							</tr>

						</table>
					</td>
				</tr>
				</table>
			</div>

			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["my_order_moreinfo"];?>
			</div>
		</div>
		<?php } ?>
		<div style='padding-top:20px;'>
			<table class='cart_data_table' border='1'>
			<tr style='background-color:<?php echo $season_color["light"]; ?>; color: white; font-weight: bold;'>
				<th width="75px"><?php echo $s["table_label_serial_code"]; ?></th>
				<th width="75px"><?php echo $s["table_label_color"]; ?></th>
				<th width="75px"><?php echo $s["table_label_family"]; ?></th>
				<?php
				$sizzes = getSizesIndex(1);
				for($size=0; $size<count($sizzes); $size++){
					if(!empty($sizzes[$size])){
						echo "<th class='th-size'>".$sizzes[$size]."</th>";
					}
				}
				?>
				<th><?php echo $s["table_label_num"]; ?></th>
				<th style='width:110px;'><?php echo $s["table_label_price"]; ?></th>
				<th style='width:145px;'><?php echo $s["table_label_total"]; ?></th>
			</tr>
			<?php
			$total_neto=0;
			$total_bruto=0;
			while($lines = db_fetch($lines_tmp)){
				if($lines["serial_model_code"] == getPortageCode()) {
					continue;
				}
				$serialcode = $lines["serial_model_code"];
				$product = productDataFromSerialModel($serialcode);
				$color = colorData($lines["id_color"]);
				$idcolor = $color["name_id_color"];
				$family = getFamilyName($product["id_family"]);
				$sizes = explode(",",$lines["allsizes"]);
				$cant = 0;
				$price = number_format($lines["unitary_price"]/(1.21),2);
				echo "<tr id='".$lines["id_line"]."'>";
				echo "<td style='font-weight: bold;'><a href='./product.php?p=".$product["id_product"]."&f=".$product["id_family"]."&pag=0'>".$serialcode."</a></td>";
				if(count($idcolor)>1) {
					echo "<td>".$idcolor[1]." ".$color["name"]."</td>";
				} else {
					echo "<td>".$color["name"]."</td>";
				}
				echo "<td>".$family."</td>";
				for($size=1; $size<=count($sizzes); $size++){
					if(!empty($lines["size_".$size])){
						echo "<td class='th-size important'>".$lines["size_".$size]."</td>";
						$cant += $lines["size_".$size];
					} elseif($size <= 10) {
						echo "<td class='th-size'> - </td>";
					}
				}
				$linetotal = $price * $cant;
				$total_neto += number_format($linetotal,2);
				$total_bruto += number_format($lines["subtotal"],2);

				echo "<td style='text-align:right'>".$cant."</td>";
				echo "<td style='text-align:right'><b>".number_format($price,2)." ".$currency["symbol"]."</b> ( ".number_format($lines["unitary_price"],2)." ".$currency["symbol"]." )</td>";
				echo "<td style='text-align:right'><b>".number_format($linetotal,2)." ".$currency["symbol"]."</b> ( ".number_format($lines["subtotal"],2)." ".$currency["symbol"]." )</td>";
				echo "</tr>";
			}
			$amount_tmp= explode(".",$order["total"]);
			if($order["discount"]!=0){
				$amount_tmp= explode(".",$order["total_with_discount"]);
			}
			if(isset($amount_tmp[1]) && strlen($amount_tmp[1])==1){
				$total_with_zero=$amount_tmp[0].$amount_tmp[1]."0";
				$total_with_zero=$amount_tmp[0].".".$amount_tmp[1]."0";
				$total_string=$amount_tmp[0].".".$amount_tmp[1]."0";
			}else if(isset($amount_tmp[1]) && strlen($amount_tmp[1])==2){
				$total_with_zero=$amount_tmp[0].$amount_tmp[1];
				$total_string=$amount_tmp[0].".".$amount_tmp[1];
			}else{
				$total_with_zero=$amount_tmp[0]."00";
				$total_string=$amount_tmp[0].".00";
			}
			?>
			<?php
			if($order["discount"]!=0){
				?>
			<tr style='background-color:<?php echo $season_color["light"]; ?>; color: white;'>
				<td colspan='15' style='text-align:right'><?php echo $s["discount"]." (".$order["discount"]."%)"; ?></td>
				<td style='text-align:right' id='totamountfin'><?php echo number_format($total_bruto*(100-$order["discount"])/100,2)." ".$currency["symbol"]; ?></td>
			</tr>
				<?php
			}
			?>
			<?php
				$shipping_price=number_format($order["shipping_method_price"]/(1.21),2);
				$total_neto += $shipping_price;
			?>
			<tr>
				<td colspan='15'><b><?php echo $s["ship_method"]?></b> : <?php echo $order["shipping_method_name"]; ?></td>
				<td style='text-align:right' id='totamountfin'><b><?php echo number_format($shipping_price,2)." ".$currency["symbol"]; ?></b> ( <?php echo number_format($order["shipping_method_price"],2)." ".$currency["symbol"];?> )</td>
			</tr>

			<tr style='background-color:<?php echo $season_color["light"]; ?>; color: white;'>
				<td colspan='13' style='text-align:right'><?php echo $s["table_label_total_clothes"]; ?></td>
				<td style='text-align:right' id='totcountfin'><?php echo $order["num_clothes"]; ?></td>
				<td style='text-align:right'><?php echo $s["table_label_subtotal"]; ?></td>
				<td style='text-align:right' id='totamountfin'><?php echo number_format($total_neto,2)." ".$currency["symbol"]; ?></td>
			</tr>


			<tr style='background-color:<?php echo $season_color["semidark"]; ?>; color: white; font-weight: bold; text-transform:uppercase;'>
				<td colspan='14' style='text-align:right' id='totcountfin'><?php echo $s["base_imponible"]; ?></td>
				<td style='text-align:right'><?php echo $s["iva"]." (21%)"; ?></td>
				<td style='text-align:right' id='totamountfin'><?php echo $s["total"]; ?></td>
			</tr>
			<?php
				$total_iva = number_format($total_neto*0.21,2);
				$total_bruto= $total_neto+$total_iva;
			?>
			<tr style='background-color:<?php echo $season_color["light"]; ?>; color: white;font-size:12px;'>
				<td colspan='14' style='text-align:right' id='totcountfin'><?php echo number_format($total_neto,2)." ".$currency["symbol"]; ?></td>
				<td style='text-align:right'><?php echo number_format($total_iva,2)." ".$currency["symbol"]; ?></td>
				<td style='text-align:right' id='totamountfin'><?php echo number_format($total_bruto,2)." ".$currency["symbol"]; ?> ( <?php echo number_format($order["total"],2)." ".$currency["symbol"];?> )</td>
			</tr>
			</table>
			<input type='hidden' id='amount_input' value='<?php echo $total_with_zero; ?>'/>
			<input type='hidden' id='num_clothes_input' value='<?php echo $order["num_clothes"]; ?>'/>
			-->
			<div class='form_submit' style='min-width:700x;'>

				<a id="login_send_step_1" class='btn btn-dark btn-small uppercase' href="javascript:show_window();"><?php echo $s["send_email_button"];?></a>
				<a id="login_send_step_1" class='btn btn-dark btn-small uppercase' href="admin_list_orders.php"><?php echo $s["back"];?></a>
				<a id="login_send_step_1" class='btn btn-dark btn-small uppercase' target="_blanch" href="javascript:print_order()">IMPRIMIR</a>


			</div>
		</div>
	</div>
</div>
<div id='zoom_window' style='display:none;'>
	<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
	<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left:200px; width:0px; z-index:910;'>
		<div style='position:absolute; text-align: right;width: 100%;'>
			<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
		</div>
		<div class='window' style='width:520px;background-color:#ffffff;padding:50px 10px ;overflow:auto;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s["send_email_title"]; ?></a></div>
			</div>
			<div class='contentbox'>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["send_email_moreinfo"]; ?>
				</div>
				<form>
					<div class='form_entry'>
						<span class='label'><?php echo $s["subject"]?> <span class='form_isrequired'>*</span></span><input  name="email_subject" id="email_subject" class='text' type='text' value='<?php echo "Oky^Coky Order: ".'#'.$order["id_order"]; ?>'/>
						<span id="subject_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["content"]?> <span class='form_isrequired'>*</span></span><textarea style='max-width:500px !important;min-width:500px !important' name="email_content" id="email_content"></textarea>
					</div>
					<div style='margin-right:30px;padding-top:20px'>
						Espera de pago: <a href="javascript:set_content('es','wait_payment');">Castellano</a> | <a href="javascript:set_content('en','wait_payment');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Espera de pago Transferencia: <a href="javascript:set_content('es','wait_payment_transfer');">Castellano</a> | <a href="javascript:set_content('en','wait_payment_transfer');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Cancelación Pedido: <a href="javascript:set_content('es','cancel');">Castellano</a> | <a href="javascript:set_content('en','cancel');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Enviando Pedido: <a href="javascript:set_content('es','sending');">Castellano</a> | <a href="javascript:set_content('en','sending');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Recibido aviso de Devolución: <a href="javascript:set_content('es','return');">Castellano</a> | <a href="javascript:set_content('en','return');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Abono de Devolución: <a href="javascript:set_content('es','return_payment');">Castellano</a> | <a href="javascript:set_content('en','return_payment');">Inglés</a>
					</div>
					<div class='form_submit' style='padding-top:10px'>
					<div class='likeabutton' style='float:right; margin-right:30px;'>
						<a id="send" href="javascript:send_email();"><span class='text'><?php echo $s["send"];?></span></a>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function send_email(){
		$("#send").parent().html("Enviando...");
		$.ajax({
			type : "POST",
			url : "./functions/send_email_to_client.php",
			data : {
				"email" : "<?php echo $clientdata["email"];?>",
				"subject" : $('#email_subject').val(),
				"content" : $('#email_content').val(),
				"id_order" : <?php echo $order["id_order"];?>
			},
			success : function(msg) {
				if(msg == "OK"){
					alert("Correo electrónico enviado");
					$('#zoom_window').css('display','none');
					$('#email_content').val("");
					$("#send").parent().html("<a id=\"send\" href=\"javascript:send_email();\"><span class='text'><?php echo $s["send"];?></span></a>");
				}
			}
		});
	}
	/*
		OJO MODIFICAR TAMBIEN EN SHOW_DETAILS Y SHOW_RETURN
	*/
	function set_content(lang,op){
		if(op=="wait_payment"){
			if(lang=="es"){
				$("#email_content").val("Hola ,\nPonemos este pedido en espera de pago, dado a que por algún motivo no se ha finalizado el pago.\nPor favor, asegúrate que tu tarjeta de crédito está autenticada-securizada por tu banco para hacer pagos por internet.\nSi no es así, solicítalo en tu banco (en algunos bancos esto puede hacerse por internet) o bien haz el pago por transferencia o PayPal.\nPuedes intentar el pago de nuevo yendo a MI CUENTA – Mostrar historial de pedidos – IR AL PEDIDO – SELECCIONE UN MÉTODO DE PAGO.\nMuchas gracias y saludos.");
			}else{
				$("#email_content").val("Hello ,\nyour order is waiting for payment because there was an error in the payment process.\nPlease, make sure your credit card is activated in order to make a purchase on the internet.\nContact your bank to activate your card. You can also pay for your order through a bank transfer or PayPal.\nYou can retry to make the payment, please go to MY ACCOUNT – Show order list – GO TO YOUR ORDER – CHOOSE A PAYMENT METHOD.\nThank you and kind regards.");

			}
		}else if(op=="wait_payment_transfer"){

			if(lang=="es"){
				$("#email_content").val("Hola ,\nEl envío de tu pedido está esperando a que se reciba la transferencia bancaria que has escogido para hacer el pago.\nSi tienes el comprobante de la transferencia, nos lo puedes enviar por email en orden a acelerar su envío.\nSi todavía no la has hecho, puedes intentar el pago por tarjeta de crédito o PayPal yendo a MI CUENTA - Mostrar historial de pedidos - IR AL PEDIDO y escoger otro método de pago.\n\nMuchas gracias.");
			}else{
				$("#email_content").val("Hello ,\nYour order is waiting for shipment because we are waiting the bank tranfer that you have chosen to make the payment.\nIf you have the bank receipt, you can send us by email in order to accelerate the shipment.\nIf you have not done, you can retry to make the payment, please go to MY ACCOUNT – Show order list – GO TO YOUR ORDER and choose other payment method.\n\nThank you and kind regards.");
			}
		}else if(op=="cancel"){

			if(lang=="es"){
				$("#email_content").val("Hola ,\nCancelamos este pedido dado a que por algún motivo no has podido hacer el pago.\nPuedes volver a hacer un nuevo pedido pero antes deberías asegurarte que tu tarjeta de crédito está autenticada-securizada por tu banco para hacer pagos por internet.\nPuedes solicítalo en tu banco (en algunos bancos esto puede hacerse por internet).\nTambién puedes pagar tus pedidos por transferencia o PayPal.\nMuchas gracias.\nSaludos.");
			}else{
				$("#email_content").val("Hello ,\nWe cancel your order because there was an error in the payment process.\nYou may put another new order but before please, make sure your credit card is activated in order to make a purchase on the internet.\nContact your bank to activate your card. You can also pay for your order through a bank transfer or PayPal.\nThank you.");
			}
		}else if(op=="sending"){

			if(lang=="es"){
				$("#email_content").val("Hola ,\nhemos enviado hoy tu pedido por Seur, esperamos que te lo entreguen mañana.\nEl número de seguimiento del envío (traking) es:\nMuchas gracias y disfruta de tu compra.");
			}else{
				$("#email_content").val("Hello ,\nyour order has been sent by Fedex and should arrive next week.\nThe tracking number is:\nThank you and we hope you will love your clothes.");
			}
		}else if(op=="return"){

			if(lang=="es"){
				$("#email_content").val("Hola ,\nDamos orden a Seur para que pasen a recoger tu devolución.\nPor favor, pon las prendas a devolver con todas sus etiquetas en la caja en la que fueron entregadas y escribe nuestra dirección sobre la caja:\nROTELPA, S.A. – OKY^COKY\nParque Tec. Logístico de Vigo\nCalle C, nave C1\n36315 VIGO\n.\nRecuerda que las devoluciones no tienen costo para ti, no debes pagar nada al transportista.\nUna vez la devolución llegue a nuestros almacenes, comprobaremos que todo está correcto y procederemos a abonar el importe, bien en la cuenta de tu tarjeta de crédito o débito o bien por transferencia, dependiendo como hayas hecho el pago del pedido.\nMuchas gracias.");
			}else{
				$("#email_content").val("Hello ,\nto proceed with the return of the goods, you must contact D.H.L.:\n\nDHL Ireland: 1890 725 725\nDHL United Kingdom: 44-844-2480808\nDHL Belgium: 02-715 50 50\nDHL Germany: 0180 5 345 300 - 3\nDHL France: 0825 10 00 80\n\nYou must order a “ECONOMY SERVICE” giving the following information:\nDHL Number account of ROTELPA, S.A. (OKY^COKY): 952751289\n1 BOX (40cmX30cmX8cm) – 0’5 kgr.\n\nTo be delivered at: ROTELPA, S.A. -Parque Tec.Logistico Vigo,C, C1-36312 VIGO-SPAIN\nWe remember that this service is free for you, you don't need to pay anything to DHL for this.\n\nThank you.");
			}
		}else if(op=="return_payment"){

			if(lang=="es"){
				$("#email_content").val("Hola ,\nHemos recibido la devolución del vestido () y ya hemos abonado en la cuenta de tu tarjeta su importe (€).\nPor favor, compruébalo en tu siguiente extracto.\nMuchas gracias.");
			}else{
				$("#email_content").val("Hello ,\nWe have received the returned goods () and we have refunded the cost (€) on your credit card.\nPlease check it in your next bank statement.\nThank you.");
			}
		}else{

		}


	}
	is_changed=false;
	function change_state (id_order,order_state){
		if(order_state==1 && <?php echo $order["order_state"] ?> == 2) {
			stock_decrease = 1;
		} else {
			stock_decrease = 0;
		}
		$.ajax({
			type : "POST",
			url : "./functions/admin_changestate_order.php",
			data : {
				"id_order" : id_order,
				"order_state" : order_state,
				"is_changed" : is_changed,
				"stock_decrease" : stock_decrease
			},
			success : function(msg) {
				if(msg == "OK"){
					if(order_state==0){
						$('#order_state').html('<td><span class="visible_label" style="margin:auto;"></span></td><td><?php echo $s["status"][0]?></td>');
						alert("Estado del pedido cambiado correctamente.");
						window.location="./admin_list_orders.php";
						die();
					}else if(order_state==1){
						$('#order_state').html('<td><span class="accept_label" style="margin:auto;"></span></td><td><?php echo $s["status"][1]?></td>');
					}else if(order_state==2){
						$('#order_state').html('<td><span class="reject_label" style="margin:auto;"></span></td><td><?php echo $s["status"][2]?></td>');
						alert("<?php echo $s["alert_order_rejected"]; ?>");
					}else if(order_state==3){
						if(print==false){
						alert("Estado del pedido cambiado correctamente.");
							window.location="./admin_list_orders.php";
						}
						die();
					}
					if(confirm("<?php echo $s["alert_order_update"]; ?>")) {
						show_window();
					} else {
						window.location="./admin_list_orders.php";
					}
				}
			}
		});
	}
	var print=false;
	function print_order(){
		open("export_order.php?id_order=<?php echo $order["id_order"];?>","_blank");
		print=true;

	}
	function change_payed (id_order,payed){
		$.ajax({
			type : "POST",
			url : "./functions/admin_changepayed_order.php",
			data : {
				"id_order" : id_order,
				"payed" : payed
			},
			success : function(msg) {
				if(msg == "OK"){
					window.location="./admin_show_details.php?id_order=<?php echo $_GET["id_order"];?>";
				}
			}
		});
	}
	function change_payment_method (id_order,payment_method){
		$.ajax({
			type : "POST",
			url : "./functions/admin_change_payment_method.php",
			data : {
				"id_order" : id_order,
				"payment_method" : payment_method
			},
			success : function(msg) {
				if(msg == "OK"){
					window.location="./admin_show_details.php?id_order=<?php echo $_GET["id_order"];?>";
				}
			}
		});
	}
	var mouse_is_inside = false;
	function show_window(){
		$('#zoom_window').css('display','block');
	}
	$(document).ready(function (){
		center= parseInt($(window).width()/2)-250;
		$('.window_preview').css('left',center);
		$('#close_button').click(function() {
			$('#email_content').val("");
			$('#zoom_window').css('display','none');
		});
		$('.window').hover(function(){
			mouse_is_inside=true;
		}, function(){
			mouse_is_inside=false;
		});
		$("body").mouseup(function(){
			if(! mouse_is_inside) $('#zoom_window').css('display','none');
		});
	});

	function save_allow_return(){
		$.ajax({
			type : "POST",
			url : "./functions/admin_change_allow_return_order.php",
			data : {
				"id_order" : <?php echo $order["id_order"];?>,
				"allow_return" : $("#allow_return").val()
			},
			success : function(msg) {
				if(msg == "OK"){
					window.location="./admin_show_details.php?id_order=<?php echo $_GET["id_order"];?>";
				}else{
					alert("Ha ocurrido un error");
				}
			}
		});
	}
	function save_status(){
		change_state(<?php echo $order["id_order"];?>,$("#order_status").val());
	}
	function save_payment(){
		change_payed(<?php echo $order["id_order"];?>,$("#payed").val());
		change_payment_method(<?php echo $order["id_order"];?>,$("#payment_method").val());
	}
</script>
<?php
include ("footer.php");
?>
