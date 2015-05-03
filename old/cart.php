<?php
//Lang confirmado
/*
 Cart
 ------
 Decripción
 Toma la cookie donde está guardado el carro de la compra. Dentro están los productos de la forma:
 id_product, id_color, [0,1,0,0,0,0,0,0,0,0,0,0] <-Son 12
 Recoge cada uno de los elementos, coge sus datos (precio, nombre, etc) y lo muestra.
 Hay un botón para finalizar el pedido y la opción de eliminar elementos del carro de la compra (mediante Javascript para no recargar la página).
 Si se quiere modificar la cantidad de elementos de un producto te lleva a la página del producto (para simplificar el interfaz.
 */
// Producto en ingles revisado - Marcial

@session_start();

if (!isset($_SESSION['cart_classics']) || sizeof($_SESSION['cart_classics'])==0){
	unset($_SESSION['cart_classics']);
	//header("location:./index.php");
	//die();
}

$page = "cart";
$page_title = "Carro de la Compra";
include ("header.php");
include_once ("./include/users.php");
include_once ("./include/products.php");

//Datos de usuario
if(isset($_SESSION['user_classics'])) {
	$user["code"] = $_SESSION['user_classics']['id_client'];
	$userdata = userData($user);
	//$client["id_rate"] = $userdata["id_rate"];
	//$client["id_currency"] = $userdata["id_currency"];
} else {
	$userdata["web_active"] == 0;
}

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;

//Calculo del total
$total_amount = 0;
$total_num = 0;

//Sacado de la Cookie
$icart = 0;
$todoOK=1;
if(isset($_SESSION['cart_classics']) && sizeof($_SESSION['cart_classics'])!=0){
	foreach ($_SESSION['cart_classics'] as $key => $cartitem) {
		//datos da cookie;
		$cart[$icart]["key"]=$key;
		$cart[$icart]["id_product"] = $cartitem["id_product"];
		$cart[$icart]["id_color"] = $cartitem["id_color"];
		$cart[$icart]["elements"] = $cartitem["sizes"];
		if ($cartitem["stockout"]==1) $todoOK=0;
		//datos doproducto;
		$productdata = productData($cartitem["id_product"]);
		$name = $productdata["name_".$lang];
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
	$total_amount = number_format(round($total_amount),2);

	if((isset($userdata["discount"]))&&($userdata["discount"]!=0)){
		$total_amount_discount=0;
		$total_amount_discount=number_format($total_amount*(100-$userdata["discount"])/100,2);
	}
	$promo_discount=false;
	unset($_SESSION['cart_promo']);
	if((isset($_GET["promo_code"]))&&(!empty($_GET["promo_code"]))){
		$promo_code["code"]=$_GET["promo_code"];
		$promo_code=isPromoCode($promo_code);
		if($promo_code){
			$promo_discount=true;
			$total_amount_discount=0;
			$total_amount_discount=number_format($total_amount-$promo_code["amount"],2);
			$_SESSION['cart_promo']=$promo_code["code"];
		}else{
			?>
			<script>
				$(document).ready(function(){
					$(".modal_window").css("display","block");
				});
			</script>
			<?php
		}
	}
}
?>

<div id='content' style='margin-bottom: 50px;'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='' class='important'><?php echo $s["cart"];?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
		if($userdata["web_active"]==1){
			?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["cart_moreinfo"];?>
			</div>
			<?php
		}else{
			?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["cart_no_allow"];?>
			</div>
			<?php
		}
		?>
		<div id='infobox_error' class='infobox_error' style="display:none;">
			<?php echo $s["cart_review_stock"];?>
		</div>
		<div style='padding-top:20px;'>
			<table class='data_table'>
				<tr>
					<th class='image_header'></th>
					<th class='name_selector_header'><?php echo $s["table_label_name_and_size_selection"]; ?></th>
					<th class='amount_header'><?php echo $s["table_label_unitary_price"]; ?></th>
					<th class='amount_header'><?php echo $s["table_label_amount"]; ?></th>
					<th class='delete_header'></th>
				</tr>
				<?php
				$empty = "";
				if(!isset($_SESSION['cart_classics']) || sizeof($_SESSION['cart_classics'])==0){
					$cart = array();
				}
				if(sizeof($cart)>0) {
					$empty = "display: none;";
				}
				?>
				<tr class='empty' style='<?php echo $empty; ?>'>
					<td colspan='5' style='padding: 50px; text-align: center' class='important'><?php echo $s["cart_empty"]; ?></td>
				</tr>
				<?php
				$todoOK=1;
				for($cart_count=0;$cart_count<sizeof($cart);$cart_count++){
					$serialcode = $cart[$cart_count]["id_product"];
					$p = productData($serialcode);

					$idcolor = $cart[$cart_count]["id_color"];
					$sizes = $cart[$cart_count]["elements"];
					$stockActual=getStockWithId($p["id_product"],$idcolor);
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
				<?php

					if(file_exists("./images/images/".$p["serial_model_code"]."-1.jpg")){
						$image_src="./images/images/".$p["serial_model_code"]."-1.jpg";
					}else{
						$image_src="./img/interface/no_image.jpg'";
					}


				?>
				<td style='padding:10px 4px;'><a href="./product.php?p=<?php echo $cart[$cart_count]["id_product"];?>&f=<?php echo $cart[$cart_count]["id_family"];?>&pag=0"><img style='width:50px' src='<?php echo $image_src;?>' /></a></td>
				<td style='padding:5px 20px;'>
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
							<!--<div class='cart_options'>
								<a id='increase_<?php echo $cart[$cart_count]["key"]."_".$element; ?>' class='btn btn-white btn-mini cart_button' href='javascript:action_cart("<?php echo $cart[$cart_count]["key"]; ?>","<?php echo $element; ?>","increase","<?php echo $stockActual[$element]; ?>","<?php echo $cart[$cart_count]["id_product"]; ?>")'<?php if($stockActual[$element]<=$cart[$cart_count]["elements"][$element]){echo "style='display:none'";}?>>+</a>
								<span disabled='disabled' class='btn btn-white btn-mini cart_button' id='no_increase_<?php echo $cart[$cart_count]["key"]."_".$element; ?>' <?php if($stockActual[$element]>$cart[$cart_count]["elements"][$element]){echo "style='display:none'";}?>>+</span>
								<a  class='btn btn-white btn-mini cart_button' id='decrease_<?php echo $cart[$cart_count]["key"]."_".$element; ?>' href='javascript:action_cart("<?php echo $cart[$cart_count]["key"]; ?>","<?php echo $element; ?>","decrease","<?php echo $stockActual[$element]; ?>","<?php echo $cart[$cart_count]["id_product"]; ?>")'<?php if($cart[$cart_count]["elements"][$element]<=1){echo "style='display:none'";}?>>-</a>
								<span disabled='disabled'  class='btn btn-white btn-mini cart_button' id='no_decrease_<?php echo $cart[$cart_count]["key"]."_".$element; ?>' <?php if($cart[$cart_count]["elements"][$element]>1){echo "style='display:none'";}?>>-</span>
							</div>-->
							</td>
						</tr>
						</table>
					<?php
					}
				}
			?>
		</div>
		</td>
		<td style='text-align:right;'><span id='unitary_price_<?php echo $cart[$cart_count]["key"]; ?>'><?php echo $cart[$cart_count]["unitary_price"] . "</span> " . $currency["symbol"];?></td>
		</td>
		<td style='text-align:right;'><span id='subtotal_<?php echo $cart[$cart_count]["key"]; ?>'><?php echo $cart[$cart_count]["subtotal_amount"] . "</span> " . $currency["symbol"] . " ( <span id='clothes_".$cart[$cart_count]["key"]."'>". $cart[$cart_count]["subtotal_num"] . "</span> ".$s["clothes"]." )";?></td>
		<td><a id="close_button" class="close_button"  href="javascript:eliminaitemcarro('<?php echo $cart[$cart_count]["key"];?>');"><?php echo $s["delete"]; ?></a></td>
		</tr>
		<?php
		}
		?>

			<?php




				if((isset($userdata["discount"]))&&($userdata["discount"]!=0)){
				?>
		<tr class='total'>
			<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 10px;'><h2 style='color:#ffffff;'><?php echo $s["total"]." ( ".$s["discount"]." ".$userdata["discount"]."% ) "; ?></h2></td>
			<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'><?php echo " <span id='totamountfin' style='text-decoration:line-through;color:red;'>".$total_amount ." ".$currency["symbol"]."</span> <span id='totamountfindiscount'> ".($total_amount_discount)."</span>" . $currency["symbol"] . " ( <span id='totcountfin'>" . $total_num . "</span> ".$s["clothes"]." )"; ;?></td>
			<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'></td>
		</tr>

				<?php
				}else if($promo_discount){

				?>
				<tr class='total'>
					<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 10px;'><h2 style='color:#ffffff;'><?php echo $s["total"]." ( -".$promo_code["amount"]."€ ) "; ?></h2></td>
					<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'><?php echo " <span id='totamountfin' style='text-decoration:line-through;color:red;'>".$total_amount ." ".$currency["symbol"]." ( <span id='totcountfin'>" . $total_num . "</span> ".$s["clothes"]." )</span><br/> <span id='totamountfindiscount'> ".($total_amount_discount)."</span>" . $currency["symbol"] . " ( <span id='totcountfin'>" . $total_num . "</span> ".$s["clothes"]." )"; ;?></td>
					<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'></td>
				</tr>
				<?php
				}else{
					?>
		<tr class='total'>
			<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;'><h2 style='color:#ffffff;'><?php echo $s["promo_code"];?> **</h2></td>
			</td>
			<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:left;padding:20px 0px;color:#ffffff;'><input id='promo_code_input' type='text' class='text' style='width:80px;float:left;margin:0px 20px 0px 20px;font-size:14px;border:none;padding:5px 10px;outline:0'/><a id='promo_code_link' href='?promo_code=' style='float:left;margin-right:10px;' class='btn btn-white btn-small'><?php echo $s["use_code"];?></a></td>
		</tr>
    <tr class='total'>
			<td colspan="4" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:red;'><span style="color:red">* 15% de Descuento Adicional Día de la Madre aplicado ya a los productos</span></td>
			<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'></td>
		</tr>
    <tr class='total'>
			<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;'><h2 style='color:#ffffff;'><?php echo $s["total"]; ?> ( <?php echo $s["vat_included"];?> )</h2></td>
			<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'><?php echo "<span id='totamountfin'>".$total_amount . "</span> " . $currency["symbol"] . " ( <span id='totcountfin'>" . $total_num . "</span> ".$s["clothes"]." )"; ;?></td>
			<td style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 0px;color:#ffffff;'></td>
		</tr>
					<?php
				}
			?>
		<tr class='total'>
			<td colspan="3" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;'>
				<h2><?php echo $s["shipping_cost"];?></h2>
			</td>
			<td colspan="2" style='background-color:<?php echo $season_color["light"];?>;border-top:1px solid <?php echo $season_color["dark"];?>;border-bottom:1px solid <?php echo $season_color["dark"];?>;text-align:right;padding:20px 10px;color:#ffffff;'>
			<?php
					$sh = getShipping(0);
					$i = 0;
					$ship_exists = false;
					if($sh != false) {
						$check = "checked";
						//Contar elementos del carrito
						$cartcount = 0;
						foreach ($_SESSION['cart_classics'] as $key => $cartitem) {
							for ($i = 1; $i < sizeof($cartitem["sizes"]); $i++) {
								$cartcount += $cartitem["sizes"][$i];
							}
						}
						while($ship = db_fetch($sh)) {
							if($ship["price_type"] == 2 && ($ship["price_max"] < $cartcount || $ship["price_min"] > $cartcount)) {
								continue;
							}
							if($ship["price_type"] == 1) {
								$ship["price_es"] = $ship["price_es"]*ceil($cartcount/$ship["price_interval"]);
							}
							if($ship["price_es"] == "0.00") {
								$ship["price_es"] = $s["ship_free"];
							} else {
								$ship["price_es"] .= " &euro;";
							}

							echo "
							<div class='ship_option ".$shipping_offer."' style='display: none;text-align:left;margin-bottom:5px;'>
								<span style='display: none;' id='country_include'>".$ship["country_include"]."</span>
								<span style='display: none;' id='province_include'>".$ship["province_include"]."</span>
								<span style='display: none;' id='country'>".$countries[$ship["country"]]["name"]."</span>
								";
								if($ship["country"]=="139"){
									echo "
									<span style='display: none;' id='province'>".$ship["province"]."</span>

									";
								}else{
									if(isset($provinces[$ship["province"]]["name"])){
										echo "
									<span style='display: none;' id='province'>".$provinces[$ship["province"]]["name"]."</span>
									";
									}

								}
							if($ship["id"]==2){
								echo "<center><h4 style='margin-bottom:5px;'>".$s["shipping_offer"]."</h4>										</center>";
							}
							echo "
								<b>".$ship["name_".$lang].":</b>  <b>".$ship["price_es"]."</b><br/></div>";
							$check = "";
							$ship_exists = true;
						}
					}

					?>

			</td>
		</tr>
		</table>
		<?php
		if($userdata["web_active"]==1){
			?>
			<div class='form_submit'>
				<div class='likeabutton' style='float:right; margin-right:30px;'>
					<a id="login_send_step_1" href="javascript:checkcart();"><span class='left_decoration'></span><span class='text'><?php echo $s["next"];?></span><span class='right_decoration'></a>
				</div>
			</div>
			<?php
		}else{
			?>
			<div class='form_submit'>
				<div class='likeabutton' style='float:right; margin-right:30px;'>
					<a href="./login.php"><span class='left_decoration'></span><span class='text'><?php echo $s["login"];?></span><span class='right_decoration'></a>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<input type="hidden" name="todoOK" id="todoOK" value="<?php echo $todoOK;?>">
</div>
<script>
	$(document).ready(function(){
		$("#promo_code_input").change(function(){
			$("#promo_code_link").attr("href","?promo_code="+$("#promo_code_input").val());
		});

		$('#shipping_name').attr("value",$('#invoice_name').attr("value"));
				$('#shipping_subname').attr("value",$('#invoice_subname').attr("value"));
				$('#shipping_address_1').attr("value",$('#invoice_address_1').attr("value"));
				$('#shipping_address_2').attr("value",$('#invoice_address_2').attr("value"));
				$('#shipping_post_code').attr("value",$('#invoice_post_code').attr("value"));
				$('#shipping_city').attr("value",$('#invoice_city').attr("value"));
				if($('#invoice_country').attr("value") == "España") {
					$('#shipping_province').attr("value",$('#invoice_province').attr("value"));
				} else if ($('#invoice_country').attr("value") == "Russia"){
					$('#shipping_province3').attr("value",$('#invoice_province3').attr("value"));
					$('#shipping_province2').attr("value",$('#invoice_province3').attr("value"));
				}else{
					$('#shipping_province2').attr("value",$('#invoice_province2').attr("value"));
				}
				$('#shipping_mobile').attr("value",$('#invoice_mobile').attr("value"));
				$('#shipping_other').attr("value",$('#invoice_other').attr("value"));

			$('#use_same_address').attr("checked",true);
			cont = 0;
			$('#confirm_button').hide();
			$('.ship_option').each(function(i, obj) {
				if($(this).find('#country_include').text() == 2 && $(this).find('#country').text() == "<?php echo $userdata["country"];?>") {
					$(this).hide();
				} else if($(this).find('#country_include').text() == 1 && $(this).find('#country').text() != "<?php echo $userdata["country"];?>") {
					$(this).hide();
				} else {
					if($(this).find('#province_include').text() == 2 && $(this).find('#province').text() == "<?php echo $userdata["province"];?>") {
						$(this).hide();
					} else if($(this).find('#province_include').text() == 1 && $(this).find('#province').text() != "<?php echo $userdata["province"];?>") {
						$(this).hide();
					} else {
						$(this).show();
						if(cont==0) {
							$(this).find('input').attr("checked",true);
							$('#confirm_button').show();
						} else {
							$(this).find('input').attr("checked",false);
						}
						$('#no_ship_method').hide();
						$('#no_ship_method_country').hide();
						cont++;
					}
				}
			});
			if(cont==0) {
				if($('.ship').length>0) {
					$('#no_ship_method_country').show();
				} else {
					$('#no_ship_method').show();
				}
			}




	});
	function eliminaitemcarro(indice) {
		if(confirm("<?php echo $s["alert_delete_cartitem"]; ?>")) {
			$.ajax({
				type: "POST",
				url: "./removeitemfromcart.php",
				data:{
					"iditem": indice,
				}, success: function(msg) {
					var salida=msg.split("|");
					if (salida[0]="OK") {
						var idtable="#"+indice;
						$(idtable).remove();
						if (salida[1]=="") salida[1]=0;
						if (salida[2]=="") salida[2]=0;
						$("#totamountfin").html(parseFloat(salida[1]).toFixed(2));
						$("#totcountfin").html(salida[2]);
						$("#moneytotal").html(parseFloat(salida[1]).toFixed(2));
						$("#numtotal").html(salida[2]);
						if($(".data_table tr").length<4) {
							$(".empty").show();
							$(".form_submit").hide();
						}
					}
				}
			});
		}
	}
	function checkcart() {
		if ($("#todoOK").val()=="1") {
			window.location="./cart_address.php";
		}
	}
	function testOK() {
		if ($("#todoOK").val()=="0") $("#infobox_error").css("display","block");
	};
    testOK();
	function action_cart(index,element,action,stock,id_product) {
		$.ajax({
			type: "POST",
			url: "./functions/operationitemfromcart.php",
			data:{
				"index": index,
				"element": element,
				"action": action,
			}, success: function(msg) {
				if (msg=="OK") {
					if(action=="decrease"){
						subtotal = parseFloat($('#subtotal_'+index).html());
						subtotal -= parseFloat($('#unitary_price_'+index).html());
						total = parseFloat($('#totamountfin').html())-parseFloat($('#unitary_price_'+index).html());
						clothes = parseInt($('#elements_'+index+"_"+element).html())-1;
						subclothes = parseInt($('#clothes_'+index).html())-1;
						totalclothes = parseInt($('#totcountfin').html())-1;

						$('#subtotal_'+index).html(subtotal.toFixed(2));
						$('#totamountfin').html(total.toFixed(2));
						$('#moneytotal').html(total.toFixed(2));
						$('#elements_'+index+"_"+element).html(clothes);
						$('#clothes_'+index).html(subclothes);
						$('#totcountfin').html(totalclothes);
						$('#numtotal').html(totalclothes);

						if(clothes<=1){
							$('#decrease_'+index+"_"+element).css('display','none');
							$('#no_decrease_'+index+"_"+element).css('display','block');
						}else{
							$('#decrease_'+index+"_"+element).css('display','block');
							$('#no_decrease_'+index+"_"+element).css('display','none');
						}
						if(clothes<stock){
							$('#increase_'+index+"_"+element).css('display','block');
							$('#no_increase_'+index+"_"+element).css('display','none');
						}
						//Comentado para que si se pone una prenda a 0 no elimine la prenda del carro. Esto no va porque no se deja llegar a 0, por eso se comenta.
						/*if(subclothes==0){
							if(confirm("<?php //echo $s["alert_delete_cartitem"]; ?>")) {
								$.ajax({
									type: "POST",
									url: "./removeitemfromcart.php",
									data:{
										"iditem": index,
									}, success: function(msg) {
										$('#'+index).remove();
									}
								});
							}
						}*/
					}else if(action=="increase"){
						subtotal = parseFloat($('#subtotal_'+index).html());
						subtotal += parseFloat($('#unitary_price_'+index).html());
						total = parseFloat($('#totamountfin').html())+parseFloat($('#unitary_price_'+index).html());
						clothes = parseInt($('#elements_'+index+"_"+element).html())+1;
						subclothes = parseInt($('#clothes_'+index).html())+1;
						totalclothes = parseInt($('#totcountfin').html())+1;
						$('#subtotal_'+index).html(subtotal.toFixed(2));
						$('#totamountfin').html(total.toFixed(2));
						$('#moneytotal').html(total.toFixed(2));
						$('#elements_'+index+"_"+element).html(clothes);
						$('#clothes_'+index).html(subclothes);
						$('#totcountfin').html(totalclothes);
						$('#numtotal').html(totalclothes);
						if(clothes>0){
							$('#decrease_'+index+"_"+element).css('display','block');
							$('#no_decrease_'+index+"_"+element).css('display','none');
						}
						if(clothes>=stock){
							$('#increase_'+index+"_"+element).css('display','none');
							$('#no_increase_'+index+"_"+element).css('display','block');
						}else{
							$('#increase_'+index+"_"+element).css('display','block');
							$('#no_increase_'+index+"_"+element).css('display','none');
						}
					}
				}
			}
		});
	}
</script>
</div>
<?php
include ("footer.php");
?>
