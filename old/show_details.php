<?php
// Producto en ingles revisado - Marcial
// Lang Confirm
@session_start();

$interface_options["cart_menu_hidden"]=1;
$page='show_order';
$error=false;
if (!isset($_GET["id_order"])){
	$error=true;
	header("location:404.php");
	die("Pedido no encontrado");
}
$page_title="detalles del pedido #".$_GET["id_order"];

if(!isset($_SESSION['user_classics']['id_client'])){
	header("location:login.php");
	die();
}
include_once("./include/front_settings.php");
include_once("./include/users.php");
include_once("./include/orders.php");
include_once("./include/products.php");
include_once("./include/colors.php");

if(!$error){
	$order=getOrderData($_GET["id_order"]);
	$lines_tmp=getOrderLines($_GET["id_order"]);
	if(isset($_SESSION['user_classics']['id_client'])){
		$user["id_client"] = $_SESSION['user_classics']['id_client'];
	} else {
		$user["id_client"] = 0;
	}
	$userdata = userData($user);
	if (empty($order) || $order["id_client"]!=$userdata["id_client"]){
		$error=true;
		header("location:404.php");
		die("El pedido no existe o no es de este cliente");
	}
}
include ("header.php");

?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<?php
			if($error){
				echo "<a href='./my_account.php'>".$s["my_account"]."</a> / <a href='' class='important'>".$s["cart"]." no encontrado</a>";
			}else{
				echo "<a href='./my_account.php'>".$s["my_account"]."</a> / <a href='' class='important'>".$s["cart"]." : ".$order["id_order"]."</a>";
			}
			?>
		</div>
	</div>
	<div class='contentbox'>
		<?php
		if($error){
			?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["my_order_error"];?>
			</div>
			<?php
		}else{
		?>
			<h3><?php echo $s["order"]." #".$order["id_order"];?><span style='float:right;font-size:12px;'>
			<?php
			if($order["order_state"]==0){
					?>
										<span style='color:orange'><i class='fa fa-certificate'></i> <?php echo $s["pending"];?></span>
										<?php
									}else if($order["order_state"]==1){
										?>
										<span style='color:black'><i class='fa fa-truck'></i> <?php echo $s["sended"];?></span>
										<?php 
									}else if($order["order_state"]==2){
										?>										
										<span style='color:red'><i class='fa fa-times'></i> <?php echo $s["cancel"];?></span>
										<?php
									}else if($order["order_state"]==3){
										?>										
										<span style='color:green'><i class='fa fa-dropbox'></i> <?php echo $s["processing"];?></span>
										<?php
									}else if($order["order_state"]==8){
										?>
										<span style='color:#333333'><i class='fa fa-clock-o'></i> Pago Pendiente</span>
										<?php
									}

				?> | <?php echo $s["payment_method"];?>: <?php
										if($order["payed"]==0){
											?>
											<span style='color:red'>
											<?php
										}else if($order["payed"]==1){
											?>
											<span style='color:green'>
											<?php
										}
										if($order["payment_method"]=="bank_transfer"){
											?>
											( <?php echo $s["bank_transf"];?> )
											<?php
										}else{
											?>
											( <?php echo $s["payment_gateway"];?> )
											<?php
										}
									?><?php
										if($order["payed"]==0){
											?>
											<span style='color:red'><?php echo $s["waiting_payment"];?></span><br/>
											
											<?php
										}else if($order["payed"]==1){
											?>
											<span style='color:green'> <?php echo $s["payed"];?></span>
											<?php
										}
									?>
</span></h3>
<?php
			if($order["payed"]==0){
				?>
				<div style='text-align:right;background-color:#f4f4f4;padding:10px 10px;border:1px solid #d4d4d4;margin-top:10px;font-size:12px;'>
					<?php echo $s["this_order_is_not_payed_short"];?> <a href="#payment_options" class='btn btn-dark btn-mini'><?php echo $s["choose_a_payment_method"];?> </a>
					<br/>
					<br/>
					<?php echo $s["if_you_want_to_cancel"];?> <a href='javascript:cancel_order()' class='btn btn-dark btn-mini'><?php echo $s["cancel_order"];?></a>
				</div>
				
				<?php
			}

?>
			<br/>
			<?php
				if((((date("U")-$order["date"])<24*60*60*18)&&($order["order_state"]==1))||($order["allow_return"]==1)){
				?>
				<div style="margin:10px 0px;border: 1px solid #d4d4d4;;padding:10px;overflow:auto;">
					<div style='z-index:120'>
						<h1 style='margin-bottom:10px;font-size:22px;text-align:center;'><i class='fa fa-refresh'></i> <?php echo $s["returns"];?></h1>
						<h4 style='text-align:center;'><?php echo $s["are_you_dissapointed_with_clothes"];?></h4>
						<p style='text-align:center'><?php echo $s["return_moreinfo"];?></p>
						<p style='text-align:center'>
							<a href='add_return.php?id_order=<?php echo $order["id_order"];?>' class='btn btn-dark btn-mini'><?php echo $s["start_a_return"];?></a>
						</p>
					</div>
				</div>
				<?php

				}else{
					?>
					<div style="margin:10px 0px;border: 1px solid #d4d4d4;;padding:10px;overflow:auto;">
						<div style='z-index:120'>
							<h4 style='text-align:center;'><?php echo $s["order_problems_title"];?></h4>
							<p style='text-align:center;'><?php echo $s["order_problems_subtitle"];?></p>
				 			<h1 style='text-align:center;'><b><i class='fa fa-phone'></i></b> (+34) 986 240 001<br/><br/><b><i class='fa fa-envelope'></i> </b> classics@okycoky.com</h1>

						</div>
					</div>
					
					<?php
			}	
			$table='returns';
			$filter=array();
			$filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
			if(isInBD($table,$filter)){
				?>
				<h3><?php echo $s["returns_done"];?></h3>
				<div style="margin:10px 0px;border: 1px solid #d4d4d4;border-bottom:none;">

				<?php
				$returns=listInBD($table,$filter);
				foreach($returns as $key=>$return){
					if($return["status"]==1){
					$status_info="<span style='color:orange;white-space: nowrap;'><i class='fa fa-certificate'></i> ".$s["pending"]."</span>";
				}else if($return["status"]==2){
					$status_info="<span style='color:blue;white-space: nowrap;'><i class='fa fa-truck'></i> ".$s["picking_up"]."</span>";
				}else if($return["status"]==3){
					$status_info="<span style='color:purple;white-space: nowrap;'><i class='fa fa-dropbox'></i> ".$s["verifying"]."</span>";
				}else if($return["status"]==4){
					$status_info="<span style='white-space: nowrap;'><i class='fa fa-check'></i> ".$s["terminated"]."</span>";
				}else if($return["status"]==5){
					$status_info="<span style='color:red;white-space: nowrap;'><i class='fa fa-times'></i> ".$s["cancela"]."</span>";
				}
					?>
					<div style='padding:10px;font-size:14px;height:30px;border-bottom:1px solid #d4d4d4;'>
						<a style='float:right;' href='javascript:print_return_label("<?php echo strtoupper(dechex($return["created"]));?>")' class='btn btn-dark btn-mini'><?php echo $s["print_shipping_label"];?></a>
						<p style='margin-top:7px;'><b>#<?php echo strtoupper(dechex($return["created"]));?></b> <?php echo $s["return_status"];?>: <?php echo $status_info;?> (<?php echo date("d/m/Y",$return["created"]);?>)</p>
					</div>
					<?php
				}
				?>
				</div>
				<script>
					function print_return_label(code){
					open("print_return_label.php?code="+code,"_blank");
				}
				</script>
				<?php
			}
			
			
			?>
			<h3><?php echo $s["order_comments"];?></h3>
			<br/>
			<div style="border: 1px solid #f4f4f4;">
				<?php
				include_once("./include/inbd.php");
						$table="order_comments";
						$filter=array();
						$filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
						$fields=array();
						$order_table="created desc";
						$order_comments=listInBD($table,$filter,$fields,$order_table);
						$count=0;
						foreach ($order_comments as $key => $order_comment){
							$tmp = date_create($order_comment["created"]);
							?>
							<div style="padding:10px; border: 1px solid #f4f4f4;">
								
								<div style='margin-bottom:10px;font-size:12px;'>

									<b>[<?php echo date_format($tmp, 'd / m / Y');?>] OKY^COKY TEAM </b>
								</div>
								<p style="margin:0"><?php echo $order_comment["content"];?></p>
								
							</div>
							<?php
							$count++;
						}
						if($count==0){
							?>
							<div style="padding:10px; border: 1px solid #f4f4f4;">
								<?php echo $s["there_is_not_messages"];?>
							</div>

							<?php
						}
				?>
				
			</div>
			<br/>
			<h3><?php echo $s["order_details"];?></h3>
			<br/>
		<?php
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
				<td rowspan=2 style='text-align:right;font-size:14px;width:367px;vertical-align:top'>
					DIRECCIÓN DE ENVÍO<BR/>
					<b style='text-transform:uppercase'>".$order["shipping_address_name"]." ".$order["shipping_address_subname"]."</b><br>
						".$userdata["email"]."<br>
						".$order["shipping_address_address_1"]."<br>
						".$order["shipping_address_address_2"]."<br>
						".$order["shipping_address_post_code"]." - ".$order["shipping_address_city"]."<br>
						".$order["shipping_address_province"]." ( ".$order["shipping_address_country"]." )<br>
						TLF: ".$order["shipping_address_mobile"]." ".$order["shipping_address_other"]."
				</td>
			</tr>
			<tr>
				<td colspan=2 style='height:50px;max-height:50px;text-align:left;vertical-align:top;padding:10px;'>
					<strong>COMENTARIO</strong>
					<br/>".$order["user_comment"]."&nbsp;
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
		$total_neto = number_format($linetotal,2);
		$total_bruto = number_format($lines["subtotal"],2);
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
		<td style='text-align:right'>".number_format($lines["unitary_price"],2)."€</td>
		<td style='text-align:right'>".number_format($lines["subtotal"],2)."€</td>
		</tr>";
	               $count++;
	               if(!empty($lines["comment"])){
		               $html.="<tr style='height:25px;border-top:1px solid #f4f4f4'><td colspan='16' style='text-align:left'><b>".$s["comment"]." :</b> ".$lines["comment"]."</td></tr>";
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
				<td style='text-align:right' id='totamountfin'>". number_format($order["shipping_method_price"],2)."€</td>
			</tr>";
			if($order["promo_code_amount"]>0){
				$html.="
				<tr>
					<td colspan='15' style='text-align:right'>
						<b>".$s["promo_code"]."</b></td>
						<td style='text-align:right' id='totamountfin'><b>- ". number_format($order["promo_code_amount"],2)." ".$currency["symbol"]."€</td>
			</tr>";
			}
			if($order["discount"]>0){
					$html.="<tr><td style='text-align:right' colspan=15><strong>DESCUENTO ".$order["discount"]."%</strong></td><td style='text-align:right'><strong>".$order["total_discount"]."€</strong></td></tr>";
				}
			$html.="<tr style='height:30px'><td style='text-align:right' colspan=13><strong>NÚMERO DE PRENDAS</strong></td><td style='text-align:right' ><strong>".$order["num_clothes"]."</strong></td><td style='text-align:right' ><strong>TOTAL</strong></td><td style='text-align:right'><strong>".number_format($order["total_with_discount"],2)."€</strong></td></tr></tbody></table></div>";

         
$html.="</div>";

	
echo $html;
			?>
					<?php
		}
		?>
	
			<div style='border:1px solid #d4d4d4;margin-top:10px;padding:20px;background-color:#f4f4f4;'>
					<?php
						if($order["payed"]==0){
							$total_amount_tpv=intval($order["total"]*100);
						?>
							<a name="payment_options"></a>
							<div style=''>
								<div style='text-align:center;margin-bottom:10px;'>
									<?php echo $s["this_order_is_not_payed"];?>
								</div>
								<div class='likeabutton' style='text-align:center; margin-right:10px;'>
									<a id='pay_again_transfer' href="javascript:void(0)"><span class='text'><?php echo $s["bank_transfer"]; ?></span></a>
									<a id='pay_again' href="javascript:void(0)"><span class='text'><?php echo $s["credit_card"]; ?></span></a>
								</div>
								<form id='pay_again_form' action="./cart_payments.php" method="post">
									<input type='hidden' name='id_order_request' value='<?php echo $order["id_order"]; ?>'/>
									<input type='hidden' name='amount' value='<?php echo $total_amount_tpv;?>'/>
									<input type='hidden' name='payment_method' id='payment_method' value=''/>
									<input type='hidden' name='action' value='again'/>
								</form>
								<script>
									$(document).ready(function(){
										$("#pay_again").click(function(){
											$("#pay_again_form #payment_method").val("credit_card");
											$("#pay_again_form").submit();
										});
										$("#pay_again_transfer").click(function(){
											$("#pay_again_form #payment_method").val("bank_transfer");
											$("#pay_again_form").submit();
										});
										
										
									});
									function cancel_order(){
										$.ajax({
											type : "POST",
											url : "./functions/changestate_order.php",
											data : {
												"id_order" : <?php echo $_GET["id_order"];?>,
												"order_state" : 4,
											},
											success : function(msg) {
												if(msg == "OK"){
													alert("Su pedido ha sido cancelado");
													window.location="./my_orderlist.php";
												} else {
													alert("Ha ocurrido un error");
													window.location="./my_orderlist.php";
												}
											}
										});
									}
								</script>
							</div>

						<?php
						}
					?>
			</div>
			<div class='likeabutton' style='text-align:center;margin-right:30px;margin-top:25px;'>
				<a href="./my_orderlist.php" class='btn btn-dark'><?php echo $s["my_orders"];?></a>
			</div>

		</div>
	</div>
</div> 
<?php
include ("footer.php");
?>