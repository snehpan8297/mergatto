<?php
//Lang confirmado
/*
	Cart_Confirm
	------
	Decripción
	Toma la cookie donde está guardado el carro de la compra y calcula cuanto es el coste total.
	Hay posibilidad de volver atrás o finalizar
*/

@session_start();
if ((!isset($_SESSION['cart_classics']))||(sizeof($_SESSION['cart_classics'])==0)){
	header("location:./index.php");
}
$page = "cart_confirm";
include ("header.php");
include_once ("./include/users.php");
include_once ("./include/products.php");

//Datos de usuario
$user["code"] = $_SESSION['user_classics']['id_client'];
$userdata = userData($user);
//$client["id_rate"] = $userdata["id_rate"];
//$client["id_currency"] = $userdata["id_currency"];

$currency["name"] = "Euro";
$currency["symbol"] = "€";
$currency["exchange"] = 1;
$addresses = listAddresses($userdata);
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["cart_address_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["cart_address_moreinfo"]; ?>
		</div>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_address_moreinfo"];?></div>
		<div class='form' id="signup_step_1" style="display:block;">
			<form id='form' action="./cart_confirm.php" method="post">
				<div style='overflow:auto;'>
				<div style='float:left; margin-right:20px;width:360px;'>
					<div class='form_entry' style='margin-bottom:10px;'>
						<span class='title'><h3><?php echo $s["receipt_data"]; ?></h3></span>
					</div>
					<div class='form_entry' style='height:50px;'>
						<span class='title'><?php echo $s["receipt_data_subtitle"]; ?></span>
					</div>
					<div class='form_entry'>
						<table>
						<tr>
							<td><?php echo $s["signup_name"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_name" id="invoice_name" class='text' type='text' style='width:240px;' value='<?php echo $userdata["name"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_subname"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_subname" id="invoice_subname" class='text' type='text' style='width:240px;' value='<?php echo $userdata["subname"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_dni"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_DNI" id="invoice_DNI" class='text' type='text' style='width:240px;' value='<?php echo $userdata["DNI"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_address"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_address_1" id="invoice_address_1" class='text' type='text' style='width:240px;' value='<?php echo $userdata["address_1"];?>'/></td>
						</tr>
						<tr>
							<td></td>
							<td><input  name="invoice_address_2" id="invoice_address_2" class='text' type='text' style='width:240px;' value='<?php echo $userdata["address_2"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_post_code"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_post_code" id="invoice_post_code" class='text' type='text' style='width:240px;' value='<?php echo $userdata["post_code"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_city"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_city" id="invoice_city" class='text' type='text' style='width:240px;' value='<?php echo $userdata["city"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_country"]?> <span class='form_isrequired'>*</span></td>
							<td>
							<select name="invoice_country" id="invoice_country">
								<?php
								$display = array("","");
								for($i=0; $i<sizeof($countries); $i++) {
									if(isset($countries[$i])) {
										if($i == $userdata["country"]) {
											$selected = " selected";
											if($countries[$i]["name"] != "España") {
												$display[0] = "display:none;";
											} else {
												$display[1] = "display:none;";
											}
										} else {
											$selected = "";
										}
										echo "<option".$selected." value='".$countries[$i]["name"]."'> ".$countries[$i]["name"]."</option>";
									}
								}
								?>
							</select>
							</td>
						</tr>
						<tr>
							<td><?php echo $s["signup_province"]?> <span class='form_isrequired'>*</span></td>
							<td>
							<select name="invoice_province" id="invoice_province" style='<?php echo $display[0]; ?>'>
								<?php
								for($i=0; $i<sizeof($provinces); $i++) {
									if(isset($provinces[$i])) {
										if($i == $userdata["province"]) {
											$selected = " selected";
										} else {
											$selected = "";
										}
										echo "<option".$selected." value='".$provinces[$i]["name"]."'> ".$provinces[$i]["name"]."</option>";
									}
								}
								?>
							</select>
							<?php
							if(isset($provinces[$userdata["province"]]["name"]) && $countries[$userdata["country"]]["name"] == "España") {
								$prov = $provinces[$userdata["province"]]["name"];
							} elseif(!is_numeric($userdata["province"])) {
								$prov = $userdata["province"];
							} else {
								$prov = "";
							}
							?>
							<input type='text' id='invoice_province2' name='invoice_province2' class='text' value='<?php echo $prov; ?>' style='width:240px;<?php echo $display[1]; ?>'/>
							</td>
						</tr>
						<tr>
							<td><?php echo $s["signup_mobile"]?> <span class='form_isrequired'>*</span></td>
							<td><input  name="invoice_mobile" id="invoice_mobile" class='text' type='text' style='width:240px;' value='<?php echo $userdata["mobile"];?>'/></td>
						</tr>
						<tr>
							<td><?php echo $s["signup_other"]?></td>
							<td><input  name="invoice_other" id="invoice_other" class='text' type='text' style='width:240px;' value='<?php echo $userdata["other"];?>'/></td>
						</tr>
						</table>
					</div>
				</div>
				<div>
					<div class='form_entry' style='margin-bottom:10px;'>
						<span class='title'><h3><?php echo $s["address_data"]; ?></h3></span>
					</div>
					<div class='form_entry' style='height:50px;'>
						<span class='title'><input id='use_same_address' type='checkbox'><?php echo $s["use_same_address"]; ?></span><br/>
						<span class='title'><?php echo $s["select_address"]; ?>
							<select style='width:240px;' id='stored_addresses' <?php if(mysql_num_rows($addresses)<1){echo "disabled";}?>>
								<option id='0'><?php if(mysql_num_rows($addresses)<1){echo $s["there_isnt_addresses_stored"];}else{echo $s["from_stored_addresses"];}?></option>
								<script>
									stored_address=Array();
								</script>
								<?php
								$first=true;
								while($a = db_fetch($addresses)) {
								?>
									<option id='<?php echo $a["id_address"]; ?>'><?php echo $a["address_1"]; ?></option>
									<script>
										stored_address[<?php echo $a["id_address"]; ?>]=Array();
										stored_address[<?php echo $a["id_address"]; ?>]['name']='<?php echo $a["name"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['subname']='<?php echo $a["subname"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['address_1']='<?php echo $a["address_1"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['address_2']='<?php echo $a["address_2"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['post_code']='<?php echo $a["post_code"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['city']='<?php echo $a["city"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['country']='<?php echo $countries[$a["country"]]["name"]; ?>';
										<?php
										if(isset($provinces[$a["province"]]["name"]) && $countries[$a["country"]]["name"] == "España") {
											$prov = $provinces[$a["province"]]["name"];
										} elseif(!is_numeric($a["province"])) {
											$prov = $a["province"];
										} else {
											$prov = "";
										}
										?>
										stored_address[<?php echo $a["id_address"]; ?>]['province']='<?php echo $prov; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['mobile']='<?php echo $a["mobile"]; ?>';
										stored_address[<?php echo $a["id_address"]; ?>]['other']='<?php echo $a["other"]; ?>';
									</script>
								<?php
								}
								?>
							</select>
						</span>
					</div>
					<div class='form_entry'>
						<table>
							<tr>
								<td><?php echo $s["signup_name"]?> <span class='form_isrequired'>*</span></td>
								<td><input  name="shipping_name" id="shipping_name" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_subname"]?> <span class='form_isrequired'>*</span></td>
								<td><input  name="shipping_subname" id="shipping_subname" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_address"]?> <span class='form_isrequired'>*</span></td>
								<td><input  name="shipping_address_1" id="shipping_address_1" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td></td>
								<td><input  name="shipping_address_2" id="shipping_address_2" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_post_code"]?> <span class='form_isrequired'>*</span></td>
								<td><input name="shipping_post_code" id="shipping_post_code" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_city"]?> <span class='form_isrequired'>*</span></td>
								<td><input name="shipping_city" id="shipping_city" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_country"]?> <span class='form_isrequired'>*</span></td>
								<td>
								<select name="shipping_country" id="shipping_country">
									<?php
									for($i=0; $i<sizeof($countries); $i++) {
										if(isset($countries[$i])) {
											echo "<option value='".$countries[$i]["name"]."'> ".$countries[$i]["name"]."</option>";
										}
									}
									?>
								</select>
								</td>
							</tr>
							<tr>
								<td><?php echo $s["signup_province"]?> <span class='form_isrequired'>*</span></td>
								<td>
								<select name="shipping_province" id="shipping_province">
									<?php
									for($i=0; $i<sizeof($provinces); $i++) {
										if(isset($provinces[$i])) {
											echo "<option value='".$provinces[$i]["name"]."'> ".$provinces[$i]["name"]."</option>";
										}
									}
									?>
								</select>
								<input type='text' id='shipping_province2' name='shipping_province2' class='text' value='' style='width:240px;display:none'/>
								</td>
							</tr>
							<tr>
								<td><?php echo $s["signup_mobile"]?> <span class='form_isrequired'>*</span></td>
								<td><input name="shipping_mobile" id="shipping_mobile" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
							<tr>
								<td><?php echo $s["signup_other"]?></td>
								<td><input name="shipping_other" id="shipping_other" class='text' type='text' style='width:240px;' value=''/></td>
							</tr>
						</table>
					</div>
					
				</div>
				</div>
				<br/>
				<div style='width: 700px; margin-bottom: 20px;'>
					<div class='form_entry' style='margin-bottom:10px;'>
						<span class='title'><h3><?php echo $s["ship_method"]; ?></h3></span>
					</div>
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
							<div class='ship' style='display: none;'>
								<span style='display: none;' id='country_include'>".$ship["country_include"]."</span>
								<span style='display: none;' id='province_include'>".$ship["province_include"]."</span>
								<span style='display: none;' id='country'>".$countries[$ship["country"]]["name"]."</span>
								<span style='display: none;' id='province'>".$provinces[$ship["province"]]["name"]."</span>
								<input type='radio' name='ship_method' class='ship_method' id='ship_method".$i++."' ".$check." value='".$ship["id"]."'/> <b>".$ship["name_".$lang].":</b> ".$ship["descrip_".$lang].". <b>".$ship["price_es"]."</b><br/></div>";
							$check = "";
							$ship_exists = true;
						}
					}
					if(!$ship_exists) {
						echo "<div id='no_ship_method'>".$s["ship_method_not_suitable"]."</div>";
					} else {
						echo "<div id='no_ship_method_country'>".$s["ship_method_not_suitable_country"]."</div>";
					}
					?>
				</div>
			</form>
		</div>
		<div style='overflow:auto;'>
			<div class='form_submit'>
				<div class='likeabutton' style='float:left; margin-right:30px;'><a id="cart_confirm_back" href="./cart.php"><span class='left_decoration'></span><span class='text'><?php echo $s["back"]?></span><span class='right_decoration'></a></div>
				<div id='loading' style='float:right; margin-right:30px;display:none;'><img src='./img/interface/loading_button.gif'/></div>
				<?php if($ship_exists) { ?>
					<div class='likeabutton' id='confirm_button' style='float:right; margin-right:30px;display:none'><a id="cart_confirm_send" href="javascript:void(0)"><span class='left_decoration'></span><span class='text'><?php echo $s["confirm"]?></span><span class='right_decoration'></span></a></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function (){
		$('#cart_confirm_send').click(function(){
			name = $('#invoice_name').val();
			subname = $('#invoice_subname').val();
			DNI = $('#invoice_DNI').val();
			address_1 = $('#invoice_address_1').val();
			address_2 = $('#invoice_address_2').val();
			post_code = $('#invoice_post_code').val();
			city = $('#invoice_city').val();
			/*province = $('#invoice_province').val();
			country = $('#invoice_country').val();*/
			mobile = $('#invoice_mobile').val();
			other = $('#invoice_other').val();
			error = false;
			if(other.length>20){
				$('#invoice_other').css('border','1px solid red');
				$('#invoice_other').css('color','red');
				$('#invoice_other').focus();
				error = true;
			}else{
				$('#invoice_other').css('border','1px solid green');
				$('#invoice_other').css('color','green');
			}
			if((mobile=="") || (mobile.length>20)){
				$('#invoice_mobile').css('border','1px solid red');
				$('#invoice_mobile').css('color','red');
				$('#invoice_mobile').focus();
				error = true;
			}else{
				$('#invoice_mobile').css('border','1px solid green');
				$('#invoice_mobile').css('color','green');
			}
			/*if(($('#invoice_country').val()==0)){
				$('#invoice_country').css('border','1px solid red');
				$('#invoice_country').focus();
				error = true;
			}else{
				$('#invoice_country').css('border','1px solid green');
			}
			if(($('#invoice_province').val()==0)) {
				$('#invoice_province').css('border','1px solid red');
				$('#invoice_province').focus();
				error = true;
			} else {
				$('#invoice_province').css('border','1px solid green');
			}*/
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((city=="") || !patron.test(city) || (city.length>50)){
				$('#invoice_city').css('border','1px solid red');
				$('#invoice_city').css('color','red');
				$('#invoice_city').focus();
				error = true;
			}else{
				$('#invoice_city').css('border','1px solid green');
				$('#invoice_city').css('color','green');
			}
			if((post_code=="") || (post_code.length>20)){
				$('#invoice_post_code').css('border','1px solid red');
				$('#invoice_post_code').css('color','red');
				$('#invoice_post_code').focus();
				error = true;
			}else{
				$('#invoice_post_code').css('border','1px solid green');
				$('#invoice_post_code').css('color','green');
			}
			if(address_2.length>50){
				$('#invoice_address_1').css('border','1px solid red');
				$('#invoice_address_1').css('color','red');
				$('#invoice_address_2').css('border','1px solid red');
				$('#invoice_address_2').css('color','red');
				$('#invoice_address_1').focus();
				error = true;
			}else{
				$('#invoice_address_1').css('border','1px solid green');
				$('#invoice_address_1').css('color','green');
				$('#invoice_address_2').css('border','1px solid green');
				$('#invoice_address_2').css('color','green');
			}
			if((address_1=="") || (address_1.length>50)){
				$('#invoice_address_1').css('border','1px solid red');
				$('#invoice_address_1').css('color','red');
				$('#invoice_address_2').css('border','1px solid red');
				$('#invoice_address_2').css('color','red');
				$('#invoice_address_1').focus();
				error = true;
			}else{
				$('#invoice_address_1').css('border','1px solid green');
				$('#invoice_address_1').css('color','green');
				$('#invoice_address_2').css('border','1px solid green');
				$('#invoice_address_2').css('color','green');
			}
			if(DNI==""){
				$('#invoice_DNI').css('border','1px solid red');
				$('#invoice_DNI').css('color','red');
				$('#invoice_DNI').focus();
				error = true;
			}else{
				$('#invoice_DNI').css('border','1px solid green');
				$('#invoice_DNI').css('color','green');
			}
			
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((subname=="") || !patron.test(subname) || (subname.length>50)){
				$('#invoice_subname').css('border','1px solid red');
				$('#invoice_subname').css('color','red');
				$('#invoice_subname').focus();
				error = true;
			}else{
				$('#invoice_subname').css('border','1px solid green');
				$('#invoice_subname').css('color','green');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((name=="") || !patron.test(name) || (name.length>50)){
				$('#invoice_name').css('border','1px solid red');
				$('#invoice_name').css('color','red');
				$('#invoice_name').focus();
				error = true;
			}else{
				$('#invoice_name').css('border','1px solid green');
				$('#invoice_name').css('color','green');
			}
			name = $('#shipping_name').val();
			subname = $('#shipping_subname').val();
			address_1 = $('#shipping_address_1').val();
			address_2 = $('#shipping_address_2').val();
			post_code = $('#shipping_post_code').val();
			city = $('#shipping_city').val();
			/*province = $('#shipping_province').val();
			country = $('#shipping_country').val();*/
			mobile = $('#shipping_mobile').val();
			other = $('#shipping_other').val();
			if(other.length>20){
				$('#shipping_other').css('border','1px solid red');
				$('#shipping_other').css('color','red');
				
				$('#shipping_other').focus();
				error = true;
			}else{
				$('#shipping_other').css('border','1px solid green');
				$('#shipping_other').css('color','green');
			}
			if((mobile=="") || (mobile.length>20)){
				$('#shipping_mobile').css('border','1px solid red');
				$('#shipping_mobile').css('color','red');
				$('#shipping_mobile').focus();
				error = true;
			}else{
				$('#shipping_mobile').css('border','1px solid green');
				$('#shipping_mobile').css('color','green');
			}
			/*if(($('#shipping_country').val()==0)){
				$('#shipping_country').css('border','1px solid red');
				$('#shipping_country').focus();
				error = true;
			}else{
				$('#shipping_country').css('border','1px solid green');
			}
			if(($('#shipping_province').val()==0)){
				$('#shipping_province').css('border','1px solid red');
				$('#shipping_province').focus();
				error = true;
			}else{
				$('#shipping_province').css('border','1px solid green');
			}*/
			
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((city=="") || !patron.test(city) || (city.length>50)){
				$('#shipping_city').css('border','1px solid red');
				$('#shipping_city').css('color','red');
				$('#shipping_city').focus();
				error = true;
			}else{
				$('#shipping_city').css('border','1px solid green');
				$('#shipping_city').css('color','green');
			}
			if((post_code=="") || (post_code.length>20)){
				$('#shipping_post_code').css('border','1px solid red');
				$('#shipping_post_code').css('color','red');
				$('#shipping_post_code').focus();
				error = true;
			}else{
				$('#shipping_post_code').css('border','1px solid green');
				$('#shipping_post_code').css('color','green');
			}
			if(address_2.length>50){
				$('#shipping_address_1').css('border','1px solid red');
				$('#shipping_address_1').css('color','red');
				$('#shipping_address_2').css('border','1px solid red');
				$('#shipping_address_2').css('color','red');
				$('#shipping_address_1').focus();
				error = true;
			}else{
				$('#shipping_address_1').css('border','1px solid green');
				$('#shipping_address_1').css('color','green');
				$('#shipping_address_2').css('border','1px solid green');
				$('#shipping_address_2').css('color','green');
			}
			if((address_1=="") || (address_1.length>50)){
				$('#shipping_address_1').css('border','1px solid red');
				$('#shipping_address_1').css('color','red');
				$('#shipping_address_2').css('border','1px solid red');
				$('#shipping_address_2').css('color','red');
				$('#shipping_address_1').focus();
				error = true;
			}else{
				$('#shipping_address_1').css('border','1px solid green');
				$('#shipping_address_1').css('color','green');
				$('#shipping_address_2').css('border','1px solid green');
				$('#shipping_address_2').css('color','green');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((subname=="") || !patron.test(subname) || (subname.length>50)){
				$('#shipping_subname').css('border','1px solid red');
				$('#shipping_subname').css('color','red');
				$('#shipping_subname').focus();
				error = true;
			}else{
				$('#shipping_subname').css('border','1px solid green');
				$('#shipping_subname').css('color','green');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((name=="") || !patron.test(name) || (name.length>50)){
				$('#shipping_name').css('border','1px solid red');
				$('#shipping_name').css('color','red');
				$('#shipping_name').focus();
				error = true;
			}else{
				$('#shipping_name').css('border','1px solid green');
				$('#shipping_name').css('color','green');
			}
			if(!error){
				$("#form").submit();
				return true;
			}
			return false;
		});
		$('#use_same_address').click(function(){
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
			if($('#use_same_address').is(":checked")){
				$('#shipping_name').attr("value",$('#invoice_name').attr("value"));
				$('#shipping_subname').attr("value",$('#invoice_subname').attr("value"));
				$('#shipping_address_1').attr("value",$('#invoice_address_1').attr("value"));
				$('#shipping_address_2').attr("value",$('#invoice_address_2').attr("value"));
				$('#shipping_post_code').attr("value",$('#invoice_post_code').attr("value"));
				$('#shipping_city').attr("value",$('#invoice_city').attr("value"));
				$('#shipping_country').attr("value",$('#invoice_country').attr("value")).change();
				if($('#invoice_country').attr("value") == "España") {
					$('#shipping_province').attr("value",$('#invoice_province').attr("value"));
				} else {
					$('#shipping_province2').attr("value",$('#invoice_province2').attr("value"));
				}
				$('#shipping_mobile').attr("value",$('#invoice_mobile').attr("value"));
				$('#shipping_other').attr("value",$('#invoice_other').attr("value"));
			}
			$('#use_same_address').attr("checked",true);
			cont = 0;
			$('#confirm_button').hide();
			$('.ship').each(function(i, obj) {
				if($(this).find('#country_include').text() == 2 && $(this).find('#country').text() == $('#shipping_country').val()) {
					$(this).hide();
				} else if($(this).find('#country_include').text() == 1 && $(this).find('#country').text() != $('#shipping_country').val()) {
					$(this).hide();
				} else {
					if($(this).find('#province_include').text() == 2 && $(this).find('#province').text() == $('#shipping_province').val()) {
						$(this).hide();
					} else if($(this).find('#province_include').text() == 1 && $(this).find('#province').text() != $('#shipping_province').val()) {
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
		$('#stored_addresses').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			i = $('#stored_addresses :selected').attr('id');
			$('#shipping_name').attr("value",stored_address[i]['name']);
			$('#shipping_subname').attr("value",stored_address[i]['subname']);
			$('#shipping_address_1').attr("value",stored_address[i]['address_1']);
			$('#shipping_address_2').attr("value",stored_address[i]['address_2']);
			$('#shipping_post_code').attr("value",stored_address[i]['post_code']);
			$('#shipping_city').attr("value",stored_address[i]['city']);
			$('#shipping_country').attr("value",stored_address[i]['country']).change();
			if(stored_address[i]['country'] == "España") {
				$('#shipping_province').attr("value",stored_address[i]['province']);
			} else {
				$('#shipping_province2').attr("value",stored_address[i]['province']);
			}
			$('#shipping_mobile').attr("value",stored_address[i]['mobile']);
			$('#shipping_other').attr("value",stored_address[i]['other']);
			
			cont = 0;
			$('#confirm_button').hide();
			$('.ship').each(function(i, obj) {
				if($(this).find('#country_include').text() == 2 && $(this).find('#country').text() == $('#shipping_country').val()) {
					$(this).hide();
				} else if($(this).find('#country_include').text() == 1 && $(this).find('#country').text() != $('#shipping_country').val()) {
					$(this).hide();
				} else {
					if($(this).find('#province_include').text() == 2 && $(this).find('#province').text() == $('#shipping_province').val()) {
						$(this).hide();
					} else if($(this).find('#province_include').text() == 1 && $(this).find('#province').text() != $('#shipping_province').val()) {
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
		$('#invoice_country').change(function(){
			if($('#invoice_country').val() == "España"){ //If it's spain shows province selector, else shows an input
				$('#invoice_province2').hide();
				$('#invoice_province').show();
			} else {
				$('#invoice_province').hide();
				$('#invoice_province2').show();
			}
		});
		$('#shipping_name').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_subname').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_address_1').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_address_2').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_post_code').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_city').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_province').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_country').change(function(){
			if($('#shipping_country').val() == "España"){ //If it's spain shows province selector, else shows an input
				$('#shipping_province2').hide();
				$('#shipping_province').val("");
				$('#shipping_province').show();
			} else {
				$('#shipping_province').hide();
				$('#shipping_province2').val("");
				$('#shipping_province2').show();
			}
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
			cont = 0;
			$('#confirm_button').hide();
			$('.ship').each(function(i, obj) {
				if($(this).find('#country_include').text() == 2 && $(this).find('#country').text() == $('#shipping_country').val()) {
					$(this).hide();
				} else if($(this).find('#country_include').text() == 1 && $(this).find('#country').text() != $('#shipping_country').val()) {
					$(this).hide();
				} else {
					if($(this).find('#province_include').text() == 2 && $(this).find('#province').text() == $('#shipping_province').val()) {
						$(this).hide();
					} else if($(this).find('#province_include').text() == 1 && $(this).find('#province').text() != $('#shipping_province').val()) {
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
		$('#shipping_province').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
			cont = 0;
			$('#confirm_button').hide();
			$('.ship').each(function(i, obj) {
				if($(this).find('#country_include').text() == 2 && $(this).find('#country').text() == $('#shipping_country').val()) {
					$(this).hide();
				} else if($(this).find('#country_include').text() == 1 && $(this).find('#country').text() != $('#shipping_country').val()) {
					$(this).hide();
				} else {
					if($(this).find('#province_include').text() == 2 && $(this).find('#province').text() == $('#shipping_province').val()) {
						$(this).hide();
					} else if($(this).find('#province_include').text() == 1 && $(this).find('#province').text() != $('#shipping_province').val()) {
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
		
		
		$('.ship_method').click(function(){
			$('#confirm_button').show();
		});
		$('#shipping_mobile').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
		$('#shipping_other').change(function(){
			if($('#use_same_address').is(":checked")){
				$('#use_same_address').attr("checked",false);
			}
			if($('#stored_addresses :selected').attr('id')!=0){
				$('#stored_addresses #0').attr("selected",true);
			}
		});
	});
</script>
<?php
include("footer.php");
?>
