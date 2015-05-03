<?php
//Lang confirmado
/*
	Cart_Confirm
	------
	Decripción
	Toma la cookie donde está guardado el carro de la compra y calcula cuanto es el coste total.
	Hay posibilidad de volver atrás o finalizar
 *
*/
// Producto en ingles revisado - Marcial
@session_start();

if ((!isset($_SESSION['cart_classics']))||(sizeof($_SESSION['cart_classics'])==0)){
	header("location:./index.php");
}
if(!isset($_POST["ship_method"])) {
	header("location:./cart_address.php");
}

$page = "cart_confirm";
$page_title = "confirma carro";

include ("header.php");
include_once ("./include/users.php");
include_once ("./include/products.php");
include_once ("./include/promocodes.php");

//Datos de usuario
$user["code"] = $_SESSION['user_classics']['id_client'];
$userdata = userData($user);
//$client["id_rate"] = $userdata["id_rate"];
//$client["id_currency"] = $userdata["id_currency"];

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;

//Calculo del total
$total_amount = 0;
$total_num = 0;

//Sacado de la Cookie
$icart = 0;
foreach ($_SESSION['cart_classics'] as $key => $cartitem) {
	//datos da cookie;
	$cart[$icart]["key"]=$key;
	$cart[$icart]["id_product"] = $cartitem["id_product"];
	$cart[$icart]["id_color"] = $cartitem["id_color"];
	$cart[$icart]["elements"] = $cartitem["sizes"];
	$cart[$icart]["allsizes"] = $cartitem["allsizes"];
	if ($cartitem["stockout"]==1) $todoOK=0;
	//datos doproducto;
	$productdata = productData($cartitem["id_product"]);
	$name=$productdata["name_".$lang];
	if (($lang!="es")&&($productdata["name_".$lang]!="")) $name=$productdata["name_".$lang];
	$description=$productdata["description_".$lang];
	if (($lang!="es")&&($productdata["description_".$lang]!="")) $description=$productdata["description_".$lang];
	$composition=$productdata["composition_".$lang];
	if (($lang!="es")&&($productdata["composition_".$lang]!="")) $composition=$productdata["composition_".$lang];
	$cart[$icart]["name"] = $name;
	$cart[$icart]["id_product"]=$productdata["id_product"];
	$cart[$icart]["id_family"]=$productdata["id_family"];
	$sizes = productSizes($productdata["id_sizing"]);
	$cart[$icart]["sizes"] = $sizes;
	$cart[$icart]["name_color"] = getColorName($cartitem["id_color"]);
	$cart[$icart]["pvps"] = $productdata["pvp"];
	if($productdata["use_discount"]==1){
		$cart[$icart]["pvps"] = (1-$productdata["discount"]/100)*$cart[$icart]["pvps"];
	}
	$cart[$icart]["pvps"] = number_format(round($cart[$icart]["pvps"]),2);
	$rimages = productImages($productdata["id_product"]);
	$images = db_fetch($rimages);
	$cart[$icart]["image"] = $images["id_image"];
	$cart[$icart]["subtotal_amount"] = 0;
	$cart[$icart]["subtotal_num"] = 0;
	for ($i = 1; $i < sizeof($cart[$icart]["elements"]); $i++) {
		$cart[$icart]["subtotal_amount"] += ($cart[$icart]["elements"][$i] * $cart[$icart]["pvps"]);
		$cart[$icart]["subtotal_num"] += $cart[$icart]["elements"][$i];
	}
	$cart[$icart]["subtotal_amount"] *= $currency["exchange"];
	$cart[$icart]["subtotal_amount"] = number_format(round($cart[$icart]["subtotal_amount"]),2);
	$cart[$icart]["unitary_price"] = number_format(round($cart[$icart]["pvps"] * $currency["exchange"]),2);

	//Calculo Total
	$total_amount += $cart[$icart]["subtotal_amount"];
	$total_num += $cart[$icart]["subtotal_num"];

	$icart++;
}
$sh = getShipping($_POST["ship_method"]);
$ship = db_fetch($sh);
if($ship["price_type"] == 1) {
	$ship["price_es"] = $ship["price_es"]*ceil($total_num/$ship["price_interval"]);
}
$promo_discount=false;
$total_amount_discount=number_format($total_amount,2,".","");
$total_amount_discount_shipping=number_format($total_amount+$ship["price_es"],2,".","");
$total_amount_discount_shipping_string=number_format($total_amount_discount_shipping,2,".","");

$promo_code["code"]="";
$promo_code["amount"]=0;
if((isset($userdata["discount"]))&&($userdata["discount"]!=0)){
	$total_amount_discount=0;
	$total_amount_discount=number_format($total_amount*(100-$userdata["discount"])/100,2,".","");
	$total_amount_discount_shipping=number_format($total_amount_discount+$ship["price_es"],2,".","");
	$total_amount_discount_shipping_string = number_format($total_amount_discount_shipping,2,".","");
}else if((isset($_SESSION['cart_promo']))&&(!empty($_SESSION['cart_promo']))){
	$promo_code["code"]=$_SESSION['cart_promo'];
	$promo_code=isPromoCode($promo_code);
	if($promo_code){
		$promo_discount=true;
		$total_amount_discount=0;
		$total_amount_discount=number_format($total_amount-$promo_code["amount"],2,".","");
		$total_amount_discount_shipping=number_format($total_amount_discount+$ship["price_es"],2,".","");
		$total_amount_discount_shipping_string = number_format($total_amount_discount_shipping,2,".","");
	}
}
$total_amount += $ship["price_es"];
$total_amount_string = number_format($total_amount,2,'.','');
$total_amount_tpv = number_format($total_amount_discount_shipping_string,2,'','');

$invoice_address["name"]=$_POST["invoice_name"];
$invoice_address["subname"]=$_POST["invoice_subname"];
$invoice_address["DNI"]=$_POST["invoice_DNI"];
$invoice_address["address_1"]=$_POST["invoice_address_1"];
$invoice_address["address_2"]=$_POST["invoice_address_2"];
$invoice_address["post_code"]=$_POST["invoice_post_code"];
$invoice_address["city"]=$_POST["invoice_city"];
//$invoice_address["province"] = $provinces[$_POST["invoice_province"]]["name"];
//$invoice_address["country"] = $countries[$_POST["invoice_country"]]["name"];
$invoice_address["country"] = $_POST["invoice_country"];
if($_POST["invoice_country"] == "España") {
	$invoice_address["province"] = $_POST["invoice_province"];
} else {
	$invoice_address["province"] = $_POST["invoice_province2"];
}
$invoice_address["mobile"]=$_POST["invoice_mobile"];
$invoice_address["other"]=$_POST["invoice_other"];
$shipping_address["name"]=$_POST["shipping_name"];
$shipping_address["subname"]=$_POST["shipping_subname"];
$shipping_address["address_1"]=$_POST["shipping_address_1"];
$shipping_address["address_2"]=$_POST["shipping_address_2"];
$shipping_address["post_code"]=$_POST["shipping_post_code"];
$shipping_address["city"]=$_POST["shipping_city"];
//$shipping_address["province"] = $provinces[$_POST["shipping_province"]]["name"];
//$shipping_address["country"] = $countries[$_POST["shipping_country"]]["name"];
$shipping_address["country"] = $_POST["shipping_country"];
if($_POST["shipping_country"] == "España") {
	$shipping_address["province"] = $_POST["shipping_province"];
} else {
	$shipping_address["province"] = $_POST["shipping_province2"];
}
$shipping_address["mobile"]=$_POST["shipping_mobile"];
$shipping_address["other"]=$_POST["shipping_other"];
$shipping_address["method_name"] = $ship["name_".$lang];
$shipping_address["method_descrip"] = $ship["descrip_".$lang];
$shipping_address["method_price"] = $ship["price_es"];
?>
<script>
function sendcart(payment_method) {
	$("#payment_method").val(payment_method);
	if(payment_method=="credit_card"){

	<?php
		if($lang=="es"){
			?>
				var r=confirm("ATENCION:\n\nSi va ha realizar el pago con tarjeta de crédito asegúrese de que está \"autenticada\" por su banco para hacer pagos por internet.\n\nSi no es así, solicítelo en su banco (en algunos bancos se puede hacer por internet) o bien haga el pago por transferencia.\n\nMuchas gracias.");

			<?php

		}else{
			?>
				var r=confirm("WARNING:\n\nPlease, be sure that your credit card is \"authenticated\" by your bank to make payments through internet.\n\nIf not, ask your bank (in some banks this may be done through internet), or you can do the payment by bank transfer.");

			<?php
		}
	?>
	}else if(payment_method=="bank_transfer"){

	}

	if (r==false)
	{
	}
	else
	{
 	$('#ajax_no_loader').css('display','none');
	$('#ajax_loader').css('display','block');
	<?php
	foreach ($invoice_address as $key=>$value) {
		echo "invoice_address_".$key."='".$value."';
		";
	}
	?>
	<?php
	foreach ($shipping_address as $key=>$value) {
		echo "shipping_address".$key."='".$value."';

		";
	}
	?>

	$.ajax({
		type: "POST",
		url: "./functions/create_order.php",
		data:{
			"payment_method":payment_method,
			"id_client":'<?php echo $userdata["id_client"]; ?>',
			"date":'<?php echo date("Y-m-d"); ?>',
			"total":'<?php echo $total_amount_string; ?>',
			"num_clothes":'<?php echo $total_num; ?>',
			"user_comment": $('#user_comment').val(),
			"user_type": 0,
			"promo_code": '<?php echo $promo_code["code"];?>',
			"promo_code_amount": '<?php echo $promo_code["amount"];?>',
			"discount": 0,
			"total_with_discount": '<?php echo $total_amount_discount_shipping_string; ?>',
			<?php
				foreach ($invoice_address as $key=>$value) {
					echo "'invoice_address_".$key."':'".$value."',";
				}
			?>
			<?php
			foreach ($shipping_address as $key=>$value) {
				echo "'shipping_address_".$key."':'".$value."',";
			}
			?>
		},
		success: function(msg) {
			var salida=msg.split("||");
			if (salida[0]!="OK"){
			}else{
				$('#id_order_request').val(salida[1]);
				<?php
				for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
					?>
					var error=false;
					$.ajax({
						type: "POST",
						url: "./functions/create_order_line_n.php",
						data:{
							"id_order_request":salida[1],
							"id_product":"<?php echo $cart[$cart_count]["id_product"]; ?>",
							"id_color":"<?php echo $cart[$cart_count]["id_color"]; ?>",
							"unitary_price": "<?php echo $cart[$cart_count]["pvps"]; ?>",
							"subtotal": "<?php echo $cart[$cart_count]["subtotal_amount"]; ?>",
							"subclothes": "<?php echo $cart[$cart_count]["subtotal_num"]; ?>",
							"allsizes": "<?php echo $cart[$cart_count]["allsizes"]; ?>",
							<?php
								for($i=1;$i<=12;$i++){
									?>
									"size_<?php echo $i;?>":"<?php echo $cart[$cart_count]["elements"][$i]; ?>",
									<?php
								}
							?>
							},success: function(msg) {
									if(msg=="OK"){
				<?php
				}
				?>
				$.ajax({
					type: "POST",
					url: "./functions/delete_cart.php",
					success: function(msg) {
						if(msg="OK"){
							$('#step_1').submit();
						}
					}
				});
				<?php
				for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
					?>
						}
						}
					});
				<?php
				}
				?>
			}
		}
	});
	}
}

function sendorder() {
	$('#ajax_no_loader').css('display','none');
	$('#ajax_loader').css('display','block');
	<?php
	foreach ($invoice_address as $key=>$value) {
		echo "invoice_address_".$key."='".$value."';";
	}
	?>
	<?php
	foreach ($shipping_address as $key=>$value) {
		echo "shipping_address".$key."='".$value."';";
	}
	?>


	$.ajax({
		type: "POST",
		url: "./functions/create_order.php",
		data:{
			"id_client":'<?php echo $userdata["id_client"]; ?>',
			"date":'<?php echo date("Y-m-d"); ?>',
			"total":'<?php echo $total_amount_string; ?>',
			"num_clothes":'<?php echo $total_num; ?>',
			"user_comment": $('#user_comment').val(),
			"user_type": 1,
			"promo_code": '<?php echo $promo_code["code"];?>',
			"promo_code_amount": '<?php echo $promo_code["amount"];?>',
			"discount": '<?php echo $userdata["discount"]; ?>',
			"total_with_discount": '<?php echo $total_amount_discount_shipping_string; ?>',			<?php
				foreach ($invoice_address as $key=>$value) {
					echo "'invoice_address_".$key."':'".$value."',";
				}
			?>
			<?php
			foreach ($shipping_address as $key=>$value) {
				echo "'shipping_address_".$key."':'".$value."',";
			}
			?>
		},
		success: function(msg) {
			var salida=msg.split("||");
			if (salida[0]!="OK"){
			}else{
				$('#id_order_request').val(salida[1]);
				<?php
				for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
					?>
					var error=false;
					$.ajax({
						type: "POST",
						url: "./functions/create_order_line_n.php",
						data:{
							"id_order_request":salida[1],
							"id_product":"<?php echo $cart[$cart_count]["id_product"]; ?>",
							"id_color":"<?php echo $cart[$cart_count]["id_color"]; ?>",
							"unitary_price": "<?php echo $cart[$cart_count]["pvps"]; ?>",
							"subtotal": "<?php echo $cart[$cart_count]["subtotal_amount"]; ?>",
							"subclothes": "<?php echo $cart[$cart_count]["subtotal_num"]; ?>",
							"allsizes": "<?php echo $cart[$cart_count]["allsizes"]; ?>",
							<?php
								for($i=1;$i<=12;$i++){
									?>
									"size_<?php echo $i;?>":"<?php echo $cart[$cart_count]["elements"][$i]; ?>",
									<?php
								}
							?>
							},success: function(msg) {
									if(msg=="OK"){
				<?php
				}
				?>
				$.ajax({
					type: "POST",
					url: "./functions/delete_cart.php",
					success: function(msg) {
						if(msg="OK"){
							$('#step_order').submit();
						}
					}
				});
				<?php
				for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
					?>
						}
						}
					});
				<?php
				}
				?>
			}
		}
	});
}

</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["cart_confirm"]; ?></a></div>
	</div>
	<div class='contentbox' id='ajax_loader' style='display:none'>
		<div style='text-align:center;padding-top:80px;'>
			<p></p><img style='width:50px' src='./img/interface/loader.gif' /></p>
			<?php echo $s["pasarela_save_and_access"]; ?>
		</div>
	</div>
	<div class='contentbox' id='ajax_no_loader'>
		<div class='form_entry'>
			<span class='label'>
				<?php echo $s["cart_confirm_moreinfo"];?>
			</span>
		</div>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_address_moreinfo"];?></div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_order' action="./cart_success_order.php" method="post">
			</form>
			<form id='step_1' action="./cart_payments.php" method="post">
				<input type='hidden' name='id_order_request' id='id_order_request' value=""/>
				<input type='hidden' name='amount' id='amount' value="<?php echo $total_amount_tpv; ?>"/>
				<input type='hidden' name='payment_method' id='payment_method' value="credit_card"/>
				<input type='hidden' name='total_amount_discount_shipping' id='total_amount_discount_shipping' value="<?php echo $total_amount_discount_shipping; ?>"/>

				<div style='float:left; margin-right:20px;width:360px;'>
					<div class='form_entry' style='margin-bottom:10px;'>
						<span class='title'><h3><?php echo $s["receipt_data"]; ?></h3></span>
					</div>
					<div class='form_entry'>
						<p><?php echo $invoice_address["name"]; ?> <?php echo $invoice_address["subname"]; ?></p>
						<p>DNI: <?php echo $invoice_address["DNI"]; ?></p>
						<p><?php echo $invoice_address["address_1"]; ?> <?php if($invoice_address["address_2"]!=""){echo "<br/>".$invoice_address["address_2"];} ?><br/>
						<?php echo $invoice_address["post_code"]; ?> <br/>
						<?php echo $invoice_address["city"]; ?> <br/>
						<?php echo $invoice_address["province"]; ?> <br/>
						<?php echo $invoice_address["country"]; ?> </p>
						<p><?php echo $invoice_address["mobile"]; ?> <br/>
						<?php echo $invoice_address["other"]; ?> </p>
					</div>
				</div>
				<div>
					<div class='form_entry' style='margin-bottom:10px;'>
						<span class='title'><h3><?php echo $s["address_data"]; ?></h3></span>
					</div>
					<div class='form_entry'>
						<p><?php echo $shipping_address["name"]; ?> <?php echo $shipping_address["subname"]; ?></p>
						<p><?php echo $shipping_address["address_1"]; ?> <?php if($shipping_address["address_2"]!=""){echo "<br/>".$shipping_address["address_2"];}?><br/>
						<?php echo $shipping_address["post_code"]; ?> <br/>
						<?php echo $shipping_address["city"]; ?> <br/>
						<?php echo $shipping_address["province"]; ?> <br/>
						<?php echo $shipping_address["country"]; ?> </p>
						<p><?php echo $shipping_address["mobile"]; ?> <br/>
						<?php echo $shipping_address["other"]; ?> </p>
					</div>
				</div>
				<div style='padding-top:10px;'>
					<table class='data_table'>
					<tr>
						<th class='name_selector_header' style='padding:5px 5px'><?php echo $s["table_label_name_and_size_selection"]; ?></th>
						<th class='amount_header'><?php echo $s["table_label_unitary_price"]; ?></th>
						<th class='amount_header' style='padding:5px 5px'><?php echo $s["table_label_amount"]; ?></th>
					</tr>
					<?php
					$todoOK=1;
					for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
						$serialcode = $cart[$cart_count]["id_product"];
						$idcolor = $cart[$cart_count]["id_color"];
						$sizes = $cart[$cart_count]["elements"];
						$stockActual=getStockWithId($serialcode,$idcolor);
						$_SESSION['cart_classics'][$cart[$cart_count]["key"]]["stockout"]=0;
						$p=productData($cart[$cart_count]["id_product"]);
						$c=colorData($idcolor);
						foreach ($sizes as $idt=>$itemnumber) {
							if ($sizes[$idt]>$stockActual[$idt]) {
								$todoOK=0;
								$_SESSION['cart_classics'][$cart[$cart_count]["key"]]["stockout"]=1;
							}
						}
					?>
					<tr id="<?php echo $cart[$cart_count]["key"];?>" <?php if ($_SESSION['cart_classics'][$cart[$cart_count]["key"]]["stockout"]==1) echo "class='cartStockOut'";?>>

						<td style='padding:10px 20px;'>
							<div class='important'>
								<h4><a href="./product.php?p=<?php echo $cart[$cart_count]["id_product"];?>&f=<?php echo $cart[$cart_count]["id_family"];?>&pag=0"><?php echo $p["name_".$lang]." (".$c["name_".$lang].")";?></a></h4>
							</div>
							<div style='margin:10px 0px;'>
								<?php
								for($element=1;$element<sizeof($cart[$cart_count]["sizes"]);$element++){
									if($cart[$cart_count]["elements"][$element]>0){
									?>
										<table id='table_<?php echo $cart[$cart_count]["key"]."_".$element;?>'>
										<tr>
											<td><?php echo $s["size"]." ".$cart[$cart_count]["sizes"][$element]." : <span id='elements_".$cart[$cart_count]["key"]."_".$element."'>".$cart[$cart_count]["elements"][$element]."</span> ".$s["clothes"]; ?></td>
											<td>
										</tr>
										</table>
									<?php
									}
								}
								?>
							</div>
						</td>
						<td style='text-align:right;'><span id='unitary_price_<?php echo $cart[$cart_count]["key"]; ?>'><?php echo $cart[$cart_count]["unitary_price"] . "</span> " . $currency["symbol"];?>
						</td>
						<td style='text-align:right;'><span id='subtotal_<?php echo $cart[$cart_count]["key"]; ?>'><?php echo $cart[$cart_count]["subtotal_amount"] . "</span> " . $currency["symbol"] . " ( <span id='clothes_".$cart[$cart_count]["key"]."'>". $cart[$cart_count]["subtotal_num"] . "</span> ".$s["clothes"]." )";?></td>
					</tr>
					<?php
					}
					?>
					<tr style='display:none'>
						<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;'><h2 style='color:#ffffff;'><?php echo $s["total"]; ?></h2></td>
						<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 5px;color:#ffffff;'><?php echo "<span id='totamountfin'>".number_format($total_amount,2) . "</span> " . $currency["symbol"] . " ( <span id='totcountfin'>" . $total_num . "</span> ".$s["clothes"]." )"; ;?></td>
					</tr>
					</table>
				</div>
				<div class='form_entry' style='margin-bottom:10px;'>
					<span class='title'><h3><?php echo $s["ship_method"]; ?></h3></span>
					<?php
					if($ship["price_es"] == "0.00") {
						$ship["price_es"] = $s["ship_free"];
					} else {
						$ship["price_es"] .= " &euro;";
					}
					echo "<p><b>".$ship["name_".$lang].":</b> ".$ship["descrip_".$lang].". <b>".$ship["price_es"]."</b></p>";
					?>
				</div>
				<div id="cart_comments" style='height:150px;padding:10px 20px 0px 0px;'>
			<div class='form_entry' style="float:left">
				<span class='label'><?php echo $s["drop_comment"];?></span>
				<textarea style='max-width:500px;min-width:500px;max-height:90px;min-height:42px;' name="user_comment" id="user_comment"></textarea>
			</div>
				<?php
			if((isset($userdata["discount"]))&&($userdata["discount"]!=0)){
				?>
							<div style='float:right;padding:5px 30px;margin-top:30px;color:<?php echo $season_color["dark"]; ?>'>
				<h2 style='padding-bottom:10px;'><?php echo $s["total"] ?></h2>
				<h4><?php echo $s["discount"] . " " . $userdata["discount"] . " %";?></h4>
				<h4><?php echo $total_amount_discount . " ".$currency["symbol"]." + " . $ship["price_es"] . "";?></h4>
				<h4><?php echo $total_amount_discount_shipping . " " . $currency["symbol"] . " ( " . $total_num ." ".$s["clothes"]." )"; ;?></h4>
			</div>
				<?php
			}else if($promo_discount){
				?>
				<div style='text-align:right;float:right;padding:5px 30px;margin-top:30px;color:<?php echo $season_color["dark"]; ?>'>
					<h2 style='padding-bottom:10px;'><?php echo $s["total"] ?></h2>
					<h5 style='margin:0;font-weight:100;font-size:14px;color:red;text-decoration:line'><?php echo $s["total"]." ".$total_amount_string . "€ ";?></h5>
					<h5 style='margin:0;font-weight:100;font-size:14px;'><?php echo $s["discount"]." -" . $promo_code["amount"] . "€"?></h5>
					<h5 style='margin:0;font-weight:100;font-size:14px;'><?php echo $s["shipping"]." +" . number_format($ship["price_es"],2) . "€ ";?></h4>
					<h4 style='border-top:1px solid #999;padding-top:5px;'><?php echo $total_amount_discount_shipping . " " . $currency["symbol"] . " ( " . $total_num ." ".$s["clothes"]." )"; ;?></h4>
				</div>
				<?php
			}else{
				?>
				<div style='float:right;padding:5px 30px;margin-top:30px;color:<?php echo $season_color["dark"]; ?>'>
				<h2 style='padding-bottom:10px;'><?php echo $s["total"] ?></h2> <h4><?php echo $total_amount_string . " " . $currency["symbol"] . " ( " . $total_num ." ".$s["clothes"]." )"; ;?></h4>
			</div>
				<?php
			}
?>
		</div>
		<?php
			if((isset($userdata["user_type"]))&&($userdata["user_type"]!=0)){
			?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["order_confirm_moreinfo"];?>
		</div>
				<div style='overflow:auto;'>
					<div class='form_submit' style='padding-top:0px;'>
						<div class='likeabutton' style='float:left; margin-right:30px;'><a id="cart_confirm_back" href="./cart_address.php"><span class='left_decoration'></span><span class='text'><?php echo $s["back"]?></span><span class='right_decoration'></a></div>
						<div id='loading' style='float:right; margin-right:30px;display:none;'><img src='./img/interface/loading_button.gif'/></div>
						<div class='likeabutton' id='confirm_button' style='float:right; margin-right:30px;'><a id="cart_confirm_send" href="javascript:sendorder()"><span class='left_decoration'></span><span class='text'><?php echo $s["confirm"]?></span><span class='right_decoration'></span></a>
						</div>
					</div>
				</div>
			<?php

			}else{
			?>
				<div id='infobox_header' class='infobox_info'>
			<?php echo $s["payment_confirm_moreinfo"];?>
		</div>
				<div style='overflow:auto;' >
					<div class='form_submit' style='padding-top:0px;'>
						<div class='likeabutton' style='float:left; margin-right:30px;'><a id="cart_confirm_back" href="./cart_address.php"><span class='left_decoration'></span><span class='text'><?php echo $s["back"]?></span><span class='right_decoration'></a></div>
						<div id='loading' style='float:right; margin-right:30px;display:none;'><img src='./img/interface/loading_button.gif'/></div>

								<div class='likeabutton' id='confirm_button' style='float:right; margin-right:30px;'><a id="cart_confirm_send" href="javascript:sendcart('paypal')"><span class='left_decoration'></span><span class='text'>PayPal</span><span class='right_decoration'></span></a></div>

						<div class='likeabutton' id='confirm_button' style='float:right; margin-right:30px;'><a id="cart_confirm_send" href="javascript:sendcart('credit_card')"><span class='left_decoration'></span><span class='text'><?php echo $s["credit_card"]?></span><span class='right_decoration'></span></a></div>

								<div class='likeabutton' id='confirm_button' style='float:right; margin-right:30px;'><a id="cart_confirm_send" href="javascript:sendcart('bank_transfer')"><span class='left_decoration'></span><span class='text'><?php echo $s["bank_transfer"]?></span><span class='right_decoration'></span></a></div>



					</div>
				</div>
			<?php
			}
		?>

			</div>
		</form>
	</div>
</div>
<?php
include("footer.php");
?>
