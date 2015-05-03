<?php
//Lang revisado
@session_start();
$page_title="devolución pedido ".$_GET["id_order"];
include_once("./include/inbd.php");

if(isset($_POST["id_order"])){
	$table="order_request";
	$filter=array();
	$filter["id_order"]=array("operation"=>"=","value"=>$_POST["id_order"]);
	$order=getInBD($table,$filter);


	$table="lines_order_request";
	$filter=array();
	$filter["id_order_request"]=array("operation"=>"=","value"=>$_POST["id_order"]);
	$order_lines=listInBD($table,$filter);

	$table="clients";
	$filter=array();
	$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
	$client=getInBD($table,$filter);

	$table="returns";
	$data=array();
	$data["id_client"] = $client["id_client"];
	$data["id_order"]=$_POST["id_order"];
	$data["status"] = 1;
	$data["created"] = date("U");
	$data["user_comment"]=$_POST["user_comment"];
	$data["invoice_address_name"]=$order["invoice_address_name"]." ".$order["invoice_address_subname"];
	$data["invoice_address_DNI"]=$order["invoice_address_DNI"];
	$data["invoice_address_email"]= $client["email"];
	$data["invoice_address_address_1"]=$order["invoice_address_address_1"];
	$data["invoice_address_address_2"]=$order["invoice_address_address_2"];
	$data["invoice_address_post_code"]=$order["invoice_address_post_code"];
	$data["invoice_address_city"]=$order["invoice_address_city"];
	$data["invoice_address_province"]=$order["invoice_address_province"];
	$data["invoice_address_country"]=$order["invoice_address_country"];
	$data["invoice_address_mobile"]=$order["invoice_address_mobile"];
	$data["invoice_address_other"]=$order["invoice_address_other"];
	$data["shipping_address_name"]=$_POST["shipping_address_name"];
	$data["shipping_address_address_1"]=$_POST["shipping_address_address_1"];
	$data["shipping_address_address_2"]=$_POST["shipping_address_address_2"];
	$data["shipping_address_post_code"]=$_POST["shipping_address_post_code"];
	$data["shipping_address_city"]=$_POST["shipping_address_city"];
	$data["shipping_address_province"]=$_POST["shipping_address_province"];
	$data["shipping_address_country"]=$_POST["shipping_address_country"];
	$data["shipping_address_mobile"]=$_POST["shipping_address_mobile"];
	$data["shipping_address_other"]=$_POST["shipping_address_other"];
	$data["return_method"]=$_POST["return_method"];
	$data["num_clothes"]=$_POST["num_clothes"];
	$data["total"]=$_POST["total"];
	$return=array();
	$return["id_return"]=addInBD($table,$data);

	$mail_content="
	El pedido # ".$data["id_order"]."<br/>
	Ha solicitado una devoilución<br/>";
	mail($contact_email,'Oky^Coky - Solicitud Devolución Pedido #'.$data["id_order"] ,$mail_content,"Content-type: text/html\r\nFrom:Oky^Coky Shop<sales@okycoky.com>");


	foreach($order_lines as $key=>$order_line){
		if($_POST[$order_line["id_line"]."_"."num_products"]>0){
			$table="return_lines";
			$data=array();
			$data["id_return"]=$return["id_return"];
			$data["id_product"]=$_POST[$order_line["id_line"]."_"."id_product"];
			$data["id_color"]=$_POST[$order_line["id_line"]."_"."id_color"];
			$data["product_code"]=$_POST[$order_line["id_line"]."_"."product_code"];
			$data["unitary_price"]=$_POST[$order_line["id_line"]."_"."unitary_price"];
			$data["num_products"]=$_POST[$order_line["id_line"]."_"."num_products"];
			$data["total"]=$_POST[$order_line["id_line"]."_"."total"];
			$data["size_1"]=$_POST[$order_line["id_line"]."_"."size_1"];
			$data["size_2"]=$_POST[$order_line["id_line"]."_"."size_2"];
			$data["size_3"]=$_POST[$order_line["id_line"]."_"."size_3"];
			$data["size_4"]=$_POST[$order_line["id_line"]."_"."size_4"];
			$data["size_5"]=$_POST[$order_line["id_line"]."_"."size_5"];
			$data["size_6"]=$_POST[$order_line["id_line"]."_"."size_6"];
			$data["size_7"]=$_POST[$order_line["id_line"]."_"."size_7"];
			$data["size_8"]=$_POST[$order_line["id_line"]."_"."size_8"];
			$data["size_9"]=$_POST[$order_line["id_line"]."_"."size_9"];
			$data["size_10"]=$_POST[$order_line["id_line"]."_"."size_10"];
			addInBD($table,$data);
		}
	}
	header("location:success_return.php?id_return=".$return["id_return"]);
	die();

}
$page = "add_return";
include ("header.php");


$table="order_request";
$filter=array();
$filter["id_order"]=array("operation"=>"=","value"=>$_GET["id_order"]);
$order=getInBD($table,$filter);

$table="lines_order_request";
$filter=array();
$filter["id_order_request"]=array("operation"=>"=","value"=>$_GET["id_order"]);
$order_lines=listInBD($table,$filter);
?>
<div id='content'>
	<div class='contentbox'>
		<form id='form' action="add_return.php" method="post">
		<input type='hidden' name='id_order' id='id_order' value='<?php echo $order["id_order"];?>'/>
		<h1 style='font-size:24px;margin-bottom:20px;'><?php echo $s["return_order"];?> #<?php echo $order["id_order"];?></h1>
		<div style='margin-bottom:10px;'>
			<h3 style='margin-bottom:10px;'><span class='badge'>1</span> <?php echo $s["return_reason_title"];?></h3>
			<div style='float:left'>
				<textarea name='user_comment' id='user_comment' style='width:400px;height:150px;font-size:12px;padding:10px;'></textarea>
			</div>
			<div style='margin-left:430px;min-height:150px;border: 1px solid #d4d4d4;background-color: #f4f4f4;padding:10px;font-size:14px;text-align:center'>
				<i class='fa fa-refresh fa-3x'></i><br/><br/>
				<?php echo $s["return_reason_help"];?>
			</div>
		</div>
		<div style='margin-bottom:10px;'>
			<h3 style='margin-bottom:10px;'><span class='badge'>2</span> <?php echo $s["return_select_clothes_title"];?></h3>
			<div style='border: 1px solid #d4d4d4;background-color: #f4f4f4;padding:10px;font-size:12px;'>
				<?php echo $s["return_select_clothes_help"];?>
			</div>
			<table class='table' id='invoice' style='margin-top:10px;border-collapse:collapse;font-size:10px !important; color:#000'>
				<thead>
					<tr style='border:1px solid #dddddd'>
						<th style='width:100%;text-align:left'>
							<?php echo $s["code"];?>
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
							<?php echo $s["Amou."];?>
						</th>
						<th style='width:5px'>
							<?php echo $s["price"];?>
						</th>
						<th style='width:100px !important'>
							<?php echo $s["total"];?>
						</th>
					</tr>
				</thead>
				<tbody>

				<?php
					if($order["promo_code_amount"]>0){
						$order_line["unitary_price"]=number_format($order_line["unitary_price"]*($order["total_with_discount"]-$order["shipping_method_price"])/($order["total"]-$order["shipping_method_price"]),2);
						?>
						<tr style='color:orange;background-color:#ffffd4'>
							<td style='text-align:right' colspan=14>
								<?php echo $s["alert_prices_discount_ajustment"];?>
							</td>
						</tr>
						<?php
					}
					foreach($order_lines as $key=>$order_line){
						$table="colors";
						$filter=array();
						$filter["id_product"]=array("operation"=>"=","value"=> $order_line["id_product"]);
						$filter["id_color"]=array("operation"=>"=","value"=> $order_line["id_color"]);
						$order_line["color"]=getInBD($table,$filter);

						$table="products";
						$filter=array();
						$filter["serial_model_code"]=array("operation"=>"=","value"=> $order_line["serial_model_code"]);
						$order_line["product"]=getInBD($table,$filter);
						?>
						<tr>
							<td style='text-align:left;font-size:14px;'>
								<b><?php echo $order_line["product"]["name_".$lang];?> <?php echo $order_line["color"]["name_".$lang];?></b><br/><span style='color:#999'>[ Ref.: <?php echo $order_line["serial_model_code"];?> ]</span>
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_product_code' id='<?php echo $order_line["id_line"];?>_product_code' value='<?php echo $order_line["product"]["name_".$lang];?> <?php echo $order_line["color"]["name_".$lang];?> ( <?php echo $order_line["serial_model_code"];?> )'/>
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_id_product' value='<?php echo $order_line["id_product"];?>'/>
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_id_color' value='<?php echo $order_line["color"]["id"];?>'/>
							</td>
							<?php
								for($size_count=1;$size_count<=10;$size_count++){
								?>
								<td>
									<?php
									if($order_line["size_".$size_count]>1){
										?>
										<select name='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' id='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' class='amount_selector' id_order_line='<?php echo $order_line["id_line"];?>'>
											<?php
												for($i=0;$i<=$order_line["size_".$size_count];$i++){
													?>
													<option value='<?php echo $i;?>'><?php echo $i;?></option>
													<?php
												}
											?>
										</select>
										<?php
									}else if($order_line["size_".$size_count]==1){
										?>
										<input type='checkbox' id='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>_checkbox' id_order_line='<?php echo $order_line["id_line"];?>' id_size='<?php echo $size_count;?>' class='amount_checkbox'/>
										<input type='hidden' name='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' id='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' value='0'/>
										<?php
									}else{
										?>
										<input type='checkbox' id='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>_checkbox' id_order_line='<?php echo $order_line["id_line"];?>' class='amount_checkbox' style='opacity:0.5'disabled/>
										<input type='hidden' name='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' id='<?php echo $order_line["id_line"];?>_size_<?php echo $size_count;?>' value='0'/>
										<?php
									}
									?>
								</td>
								<?php
								}
							?>
							<td>
								<span id='<?php echo $order_line["id_line"];?>_num_clothes_preview'>0</span>
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_num_products' id='<?php echo $order_line["id_line"];?>_num_clothes' class='num_clothes_line' value='0'/>
							</td>
							<?php
							if($order["promo_code_amount"]>0){
								$order_line["unitary_price"]=number_format($order_line["unitary_price"]*($order["total_with_discount"]-$order["shipping_method_price"])/($order["total"]-$order["shipping_method_price"]),2);
							}
							?>
							<td>
								<?php echo $order_line["unitary_price"];?>€
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_unitary_price' id='<?php echo $order_line["id_line"];?>_unitary_price' class='unitary_price_line' value='<?php echo $order_line["unitary_price"];?>'/>
							</td>
							<td>
								<span id='<?php echo $order_line["id_line"];?>_total_line_preview'>0</span>€
								<input type='hidden' name='<?php echo $order_line["id_line"];?>_total' id='<?php echo $order_line["id_line"];?>_total_line' class='total_line' value='0'/>
							</td>
						</tr>
						<?php
					}
				?>

				<tr style='height:30px'>
					<td style='text-align:right' colspan=11>
						<strong><?php echo $s["amount_clothes"];?></strong>
					</td>
					<td >
						<strong>
							<span id='num_clothes_total_preview'>0</span>
							<input type='hidden' name='num_clothes' id='num_clothes_total' value='0'/>
						</strong>
					</td>
					<td style='text-align:right'>
						<strong><?php echo $s["total"];?></strong>
					</td>
					<td style='text-align:right'>
						<strong>
							<span id='total_preview'>0</span>€
							<input type='hidden' name='total' id='total' value='0'/>
						</strong>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
		<div style='margin-bottom:10px;overflow:auto;'>
			<h3 style='margin-bottom:10px;'><span class='badge'>3</span> <?php echo $s["return_pickup_address_title"];?></h3>
			<div style='width:280px;height:325px;float:left;border: 1px solid #d4d4d4;background-color: #f4f4f4;padding:10px;font-size:14px;text-align:center'>
				<p style='text-align:center'>
					<i class='fa fa-dropbox fa-4x'></i>
				</p>
				<p>
					<?php echo $s["return_pickup_address_help"];?>
				</p>
			</div>
			<div style='text-align:right;margin-left:320px;padding:10px;border: 1px solid #d4d4d4;' class='return_address'>
				<h1 style='text-align:center;margin-bottom:10px;'><?php $s["shipping_address"];?></h1>
				<?php echo $s["name"];?> <input type='text' name='shipping_address_name' value='<?php echo $order["shipping_address_name"];?> <?php echo $order["shipping_address_subname"];?>'/><br>
				<?php echo $s["address"];?> <input type='text' name='shipping_address_address_1' value='<?php echo $order["shipping_address_address_1"];?>'/><br>
				<input type='text' name='shipping_address_address_2' value='<?php echo $order["shipping_address_address_2"];?>'/><br>
				<?php echo $s["post_code"];?> <input type='text' name='shipping_address_post_code' value='<?php echo $order["shipping_address_post_code"];?>'/><br/>
				<?php echo $s["city"];?> <input type='text' name='shipping_address_city' value='<?php echo $order["shipping_address_city"];?>'/><br/>
				<?php echo $s["province"];?> <input type='text' name='shipping_address_province' value='<?php echo $order["shipping_address_province"];?>'/><br/>
				<?php echo $s["country"];?> <input type='text' name='shipping_address_country' value='<?php echo $order["shipping_address_country"];?>'/><br/>
				<?php echo $s["phone"];?> <input type='text' name='shipping_address_mobile' value='<?php echo $order["shipping_address_mobile"];?>'/><br/>
				<input type='text' name='shipping_address_other' value='<?php echo $order["shipping_address_other"];?>'/><br/>
			</div>
		</div>
		<script>
			var num_clothes_total=0;
			$(document).ready(function(){
				$(".amount_checkbox").change(function(){
					id_order_line=$(this).attr("id_order_line");
					id_size=$(this).attr("id_size");
					if($(this).attr("checked")=="checked"){
						$("#"+id_order_line+"_size_"+id_size).val("1");
					}else{
						$("#"+id_order_line+"_size_"+id_size).val("0");
					}
					num_clothes=0;
					total_line=0;
					for(i=1;i<=10;i++){
						amount=parseInt($("#"+id_order_line+"_size_"+i).val());
						unitary_price=parseFloat($("#"+id_order_line+"_unitary_price").val());
						num_clothes+=amount;
						total_line+=(amount*unitary_price);

					}
					$("#"+id_order_line+"_num_clothes").val(num_clothes);
					$("#"+id_order_line+"_num_clothes_preview").html(num_clothes);
					$("#"+id_order_line+"_total_line").val(total_line.toFixed(2));
					$("#"+id_order_line+"_total_line_preview").html(total_line.toFixed(2));
					num_clothes_total=0;
					$(".num_clothes_line").each(function(){
						num_clothes_total+=parseInt($(this).val())
					});
					$("#num_clothes_total").val(num_clothes_total.toFixed(2));
					$("#num_clothes_total_preview").html(num_clothes_total.toFixed(2));
					total=0;
					$(".total_line").each(function(){
						total+=parseFloat($(this).val());
					});
					$("#total").val(total.toFixed(2));
					$("#total_preview").html(total.toFixed(2));
				});
				$(".amount_selector").change(function(){
					id_order_line=$(this).attr("id_order_line");
					num_clothes=0;
					total_line=0;
					for(i=1;i<=10;i++){
						amount=parseInt($("#"+id_order_line+"_size_"+i).val());
						unitary_price=parseFloat($("#"+id_order_line+"_unitary_price").val());
						num_clothes+=amount;
						total_line+=(amount*unitary_price);

					}
					$("#"+id_order_line+"_num_clothes").val(num_clothes);
					$("#"+id_order_line+"_num_clothes_preview").html(num_clothes);
					$("#"+id_order_line+"_total_line").val(total_line.toFixed(2));
					$("#"+id_order_line+"_total_line_preview").html(total_line.toFixed(2));
					num_clothes_total=0;
					$(".num_clothes_line").each(function(){
						num_clothes_total+=parseInt($(this).val())
					});
					$("#num_clothes_total").val(num_clothes_total.toFixed(2));
					$("#num_clothes_total_preview").html(num_clothes_total.toFixed(2));
					total=0;
					$(".total_line").each(function(){
						total+=parseFloat($(this).val());
					});
					$("#total").val(total.toFixed(2));
					$("#total_preview").html(total.toFixed(2));
				});
			});
		</script>
		<div style='margin-bottom:10px;'>
			<h3 style='margin-bottom:10px;'><span class='badge'>4</span> <?php echo $s["return_method_title"];?></h3>
			<div style='text-align:right;border: 1px solid #d4d4d4;padding:10px;'>
				<?php echo $s["return_method"];?> <select name='return_method'>
					<option value='<?php echo $order["payment_method"];?>'><?php echo $return_methods_s[$order["payment_method"]];?></option>
				</select>
			</div>
		</div>
		<div style='text-align:center;'>
			<a href='./show_details.php?id_order=<?php echo $order["id_order"];?>' style='margin:5px;' class='btn btn-dark'>Cancelar</a>
			<a href='javascript:add_return()' style='margin:5px;' class='btn btn-dark'><?php echo $s["next"];?></a>
		</div>
		</form>

<style type='text/css'>
	#invoice tr td{
		padding:5px;border:1px solid #aaaaaa;text-align:center;
	}
	#invoice tr th{padding:5px;border:1px solid #aaaaaa;text-align:center;width:12px;}
	#images{width:650PX;margin-top:20px;}
	#images td{width:125px;height:250px;margin-top:10px;text-align:center}
	#images img{width:150px}
</style>
	</div>
</div>
<script>
	function add_return(){
		if(num_clothes_total==0){
			alert("<?php echo $s["no_clothes_to_return"];?>");
		}else{
			$("#form").submit();

		}
	}
	function print_return(){
	}
	function print_return_label(){
	}


</script>


<?php
include ("footer.php");
?>
