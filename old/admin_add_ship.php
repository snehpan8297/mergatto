<?php
//Lang revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}

$signup=2;
include_once("include/orders.php");

if(isset($_POST["name_es"])){
	$ship_tmp["name_es"] = $_POST["name_es"];
	$ship_tmp["descrip_es"] = $_POST["descrip_es"];
	$ship_tmp["price_es"] = $_POST["price_es"];
	$ship_tmp["name_en"] = $_POST["name_en"];
	$ship_tmp["descrip_en"] = $_POST["descrip_en"];
	$ship_tmp["price_type"] = $_POST["price_type"];
	$ship_tmp["price_interval"] = $_POST["price_interval"];
	if(isset($_POST["country_filter"])) {
		$ship_tmp["country_include"] = $_POST["country_include"];
		$ship_tmp["country"] = $_POST["country"];
	} else {
		$ship_tmp["country_include"] = 0;
		$ship_tmp["country"] = 0;
	}
	
	if(isset($_POST["province_filter"])) {
		$ship_tmp["province_include"] = $_POST["province_include"];
		$ship_tmp["province"] = $_POST["province"];
	} else {
		$ship_tmp["province_include"] = 0;
		$ship_tmp["province"] = 0;
	}
	
	if(!empty($_POST["price_min"])) {
		$ship_tmp["price_min"] = $_POST["price_min"];
	} else {
		$ship_tmp["price_min"] = 0;
	}
	if(!empty($_POST["price_max"])) {
		$ship_tmp["price_max"] = $_POST["price_max"];
	} else {
		$ship_tmp["price_max"] = 0;
	}
	if ($_POST["ship_type"]=="new"){
		$signup = addShipping($ship_tmp);
		$signup = 1;
	} else {
		$ship_tmp["id"] = $_POST["ship_id"];
		$signup = updateShipping($ship_tmp);
		header('location:./admin_list_ship.php');
		die;
	}
}
if(isset($_GET["id_ship"])){
	$ship_tmp["id"] = $_GET["id_ship"];
	$ship_type="edit";
	$sh = getShipping($ship_tmp["id"]);
	$ship = db_fetch($sh);
	$ship_tmp["name_es"] = $ship["name_es"];
	$ship_tmp["descrip_es"] = $ship["descrip_es"];
	$ship_tmp["price_es"] = $ship["price_es"];
	$ship_tmp["name_en"] = $ship["name_en"];
	$ship_tmp["descrip_en"] = $ship["descrip_en"];
	$ship_tmp["price_variable"] = "";
	$ship_tmp["price_fixed"] = "";
	$ship_tmp["price_fixed_all"] = "";
	if($ship["price_type"] == 1) {
		$ship_tmp["price_variable"] = "checked";
	} elseif($ship["price_type"] == 2) {
		$ship_tmp["price_fixed"] = "checked";
	} else {
		$ship_tmp["price_fixed_all"] = "checked";
	}
	if(!empty($ship["price_interval"]) && $ship["price_type"] == 1) {
		$ship_tmp["price_interval"] = $ship["price_interval"];
	} else {
		$ship_tmp["price_interval"] = "1";
	}
	if(!empty($ship["price_min"])) {
		$ship_tmp["price_min"] = $ship["price_min"];
	} else {
		$ship_tmp["price_min"] = 0;
	}
	if(!empty($ship["price_max"])) {
		$ship_tmp["price_max"] = $ship["price_max"];
	} else {
		$ship_tmp["price_max"] = 0;
	}
	$ship_tmp["country_include_0"] = "";
	$ship_tmp["country_include_1"] = "";
	$ship_tmp["country_include_2"] = "";
	if($ship["country_include"] == 1) {
		$ship_tmp["country_include_0"] = "checked";
		$ship_tmp["country_include_1"] = "checked";
	} elseif($ship["country_include"] == 2) {
		$ship_tmp["country_include_0"] = "checked";
		$ship_tmp["country_include_2"] = "checked";
	} else {
		$ship_tmp["country_include_1"] = "checked";
	}
	$ship_tmp["country"] = $ship["country"];
	
	$ship_tmp["province_include_0"] = "";
	$ship_tmp["province_include_1"] = "";
	$ship_tmp["province_include_2"] = "";
	if($ship["province_include"] == 1) {
		$ship_tmp["province_include_0"] = "checked";
		$ship_tmp["province_include_1"] = "checked";
	} elseif($ship["province_include"] == 2) {
		$ship_tmp["province_include_0"] = "checked";
		$ship_tmp["province_include_2"] = "checked";
	} else {
		$ship_tmp["province_include_1"] = "checked";
	}
	$ship_tmp["province"] = $ship["province"];
	
} else {
	$ship_type="new";
	$ship_tmp["name_es"] = "";
	$ship_tmp["descrip_es"] = "";
	$ship_tmp["price_es"] = "";
	$ship_tmp["name_en"] = "";
	$ship_tmp["descrip_en"] = "";
	$ship_tmp["price_interval"] = "1";
	$ship_tmp["price_min"] = "";
	$ship_tmp["price_max"] = "";
	$ship_tmp["price_variable"] = "";
	$ship_tmp["price_fixed"] = "";
	$ship_tmp["price_fixed_all"] = "checked";
	$ship_tmp["country_include_0"] = "";
	$ship_tmp["country_include_1"] = "checked";
	$ship_tmp["country_include_2"] = "";
	$ship_tmp["country"] = "";
	$ship_tmp["province_include_0"] = "";
	$ship_tmp["province_include_1"] = "checked";
	$ship_tmp["province_include_2"] = "";
	$ship_tmp["province"] = "";
}

$page = "admin";
include ("header.php");
?>
<script>
	$(document).ready(function (){
		$('#country').change(function(){
			if($('#country').val()=="139"){
				$('#province_russia').css("display","block");	
				$('#province_spain').css("display","none");	
			}else{
				$('#province_spain').css("display","block");	
				$('#province_russia').css("display","none");	
			}
		});
		$('#signup_cancel').click(function(){
			window.history.back();
		});
		$('#signup_send_step_1').click(function(){
			if($('#country').val()=="139"){
				$('#province').val($('#province_russia').val());	
			}else{
				$('#province').val($('#province_spain').val());	
			}
			client_name = $('#name_es').val();
			client_descrip = $('#descrip_es').val();
			client_price = $('#price_es').val();
			client_name_en = $('#name_en').val();
			client_descrip_en = $('#descrip_en').val();
			client_price_interval = $('#price_interval').val();
			client_price_min = $('#price_min').val();
			client_price_max = $('#price_max').val();
			client_price_type = $('input[name=price_type]:checked', '#step_1').val();
			client_country_filter = $('#country_filter').is(':checked');
			client_country = $('#country').val();
			client_province_filter = $('#province_filter').is(':checked');
			client_province = $('#province').val();
			error = false;

			if(client_country_filter==true && client_country==0){
				$('#country').css('border','1px solid red');
				$('#country').css('color','red');
				$('#country_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#country_alert').css('display','inline');
				$('#country').focus();
				error = true;
			}else{
				$('#country').css('border','1px solid green');
				$('#country').css('color','green');
				$('#country_alert').css('display','none');
			}
			
			if(client_province_filter==true && client_province==0){
				$('#province').css('border','1px solid red');
				$('#province').css('color','red');
				$('#province_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#province_alert').css('display','inline');
				$('#province').focus();
				error = true;
			}else{
				$('#province').css('border','1px solid green');
				$('#province').css('color','green');
				$('#province_alert').css('display','none');
			}
			
			if(client_descrip=="" || client_descrip.length<5){
				$('#descrip_es').css('border','1px solid red');
				$('#descrip_es').css('color','red');
				if(client_descrip==""){
					$('#descrip_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_descrip.length<5){
					$('#descrip_alert').html('<?php echo $s["field_too_short"]; ?>');
				}
				$('#descrip_alert').css('display','inline');
				$('#descrip_es').focus();
				error = true;
			}else{
				$('#descrip_es').css('border','1px solid green');
				$('#descrip_es').css('color','green');
				$('#descrip_alert').css('display','none');
			}
			if(client_descrip_en=="" || client_descrip_en.length<5 ){
				$('#descrip_en').css('border','1px solid red');
				$('#descrip_en').css('color','red');
				if(client_descrip_en==""){
					$('#descrip_alert_en').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_descrip_en.length<5){
					$('#descrip_alert_en').html('<?php echo $s["field_too_short"]; ?>');
				}
				$('#descrip_alert_en').css('display','inline');
				$('#descrip_en').focus();
				error = true;
			}else{
				$('#descrip_en').css('border','1px solid green');
				$('#descrip_en').css('color','green');
				$('#descrip_alert_en').css('display','none');
			}
			if(client_name=="" || client_name.length<5 || client_name.length>40 ){
				$('#name_es').css('border','1px solid red');
				$('#name_es').css('color','red');
				if(client_name==""){
					$('#name_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_name.length<5){
					$('#name_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_name.length>64 ){
					$('#name_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#name_alert').css('display','inline');
				$('#name_es').focus();
				error = true;
			}else{
				$('#name_es').css('border','1px solid green');
				$('#name_es').css('color','green');
				$('#name_alert').css('display','none');
			}
			if(client_name_en=="" || client_name_en.length<5 || client_name_en.length>40 ){
				$('#name_en').css('border','1px solid red');
				$('#name_en').css('color','red');
				if(client_name_en==""){
					$('#name_alert_en').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_name_en.length<5){
					$('#name_alert_en').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_name_en.length>64 ){
					$('#name_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#name_alert_en').css('display','inline');
				$('#name_en').focus();
				error = true;
			}else{
				$('#name_en').css('border','1px solid green');
				$('#name_en').css('color','green');
				$('#name_alert_en').css('display','none');
			}
			var patron=/^[0-9]+[\.0-9]{2,3}$/;
			if(!patron.test(client_price)){
				$('#price_es').css('border','1px solid red');
				$('#price_es').css('color','red');
				$('#price_alert_es').html('<?php echo $s["format_not_valid"]; ?>');
				$('#price_alert_es').css('display','inline');
				$('#price_es').focus();
				error = true;
			}else{
				$('#price_es').css('border','1px solid green');
				$('#price_es').css('color','green');
				$('#price_alert_es').css('display','none');
			}
			var patron=/^[0-9]+$/;
			if(client_price_type == 1 && !patron.test(client_price_interval)){
				$('#price_interval').css('border','1px solid red');
				$('#price_interval').css('color','red');
				$('#price_interval_alert_es').html('<?php echo $s["format_not_valid"]; ?>');
				$('#price_interval_alert_es').css('display','inline');
				$('#price_interval').focus();
				error = true;
			}else if(client_price_type == 1){
				$('#price_interval').css('border','1px solid green');
				$('#price_interval').css('color','green');
				$('#price_interval_alert_es').css('display','none');
			} else {
				$('#price_interval').css('border','');
				$('#price_interval').css('color','');
				$('#price_interval_alert_es').css('display','none');
			}
			var patron=/^[0-9]+$/;
			if(client_price_type == 2 && !patron.test(client_price_min)){
				$('#price_min').css('border','1px solid red');
				$('#price_min').css('color','red');
				$('#price_min_alert_es').html('<?php echo $s["format_not_valid"]; ?>');
				$('#price_min_alert_es').css('display','inline');
				$('#price_min').focus();
				error = true;
			}else if(client_price_type == 2){
				$('#price_min').css('border','1px solid green');
				$('#price_min').css('color','green');
				$('#price_min_alert_es').css('display','none');
			} else {
				$('#price_min').css('border','');
				$('#price_min').css('color','');
				$('#price_min_alert_es').css('display','none');
			}
			var patron=/^[0-9]+$/;
			if(client_price_type == 2 && !patron.test(client_price_max)){
				$('#price_max').css('border','1px solid red');
				$('#price_max').css('color','red');
				$('#price_max_alert_es').html('<?php echo $s["format_not_valid"]; ?>');
				$('#price_max_alert_es').css('display','inline');
				$('#price_max').focus();
				error = true;
			}else if(client_price_type == 2){
				$('#price_max').css('border','1px solid green');
				$('#price_max').css('color','green');
				$('#price_max_alert_es').css('display','none');
			} else {
				$('#price_max').css('border','');
				$('#price_max').css('color','');
				$('#price_max_alert_es').css('display','none');
			}
			if(!error){
				$("#step_1").submit();
				return true;
			}
			return false;
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["add_ship_method"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
			if($signup==1){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["add_ship_success"];?>
				</div>
				<?php
			}else{
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_ship_method_moreinfo"];?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_ship.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["add_ship_method_subtitle"]; ?></h3></span>
					<?php
					if($signup==3){
						?>
						<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["add_ship_error"]; ?></p></span>
						<?php
					}
					?>
				</div>
				<table>
				<tr>
					<td>
						<div class='form_entry'>
							<span class='label'><?php echo $s["ship_method_name_es"];?> <span class='form_isrequired'>*</span></span><input  name="name_es" id="name_es" class='text' type='text' value='<?php echo $ship_tmp["name_es"]; ?>'/>
							<span id="name_alert" class='form_entry_alert'></span>
						</div>
					</td>
					<td>
						<div class='form_entry'>
							<span class='label'><?php echo $s["ship_method_name_en"];?> <span class='form_isrequired'>*</span></span><input  name="name_en" id="name_en" class='text' type='text' value='<?php echo $ship_tmp["name_en"]; ?>'/>
							<span id="name_alert_en" class='form_entry_alert'></span>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class='form_entry'>
							<span class='label'><?php echo $s["ship_method_descrip_es"];?> <span class='form_isrequired'>*</span></span><textarea name="descrip_es" id="descrip_es" class='text'><?php echo $ship_tmp["descrip_es"]; ?></textarea>
							<span id="descrip_alert" class='form_entry_alert'></span>
						</div>
					</td>
					<td>
						<div class='form_entry'>
							<span class='label'><?php echo $s["ship_method_descrip_en"];?> <span class='form_isrequired'>*</span></span><textarea name="descrip_en" id="descrip_en" class='text'><?php echo $ship_tmp["descrip_en"]; ?></textarea>
							<span id="descrip_alert_en" class='form_entry_alert'></span>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class='form_entry'>
							<span class='label'><?php echo $s["ship_method_price_es"];?> </span><input  name="price_es" id="price_es" class='text' type='text' value='<?php echo $ship_tmp["price_es"]; ?>'/>
							<span id="price_alert_es" class='form_entry_alert'></span>
							<div><?php echo $s["ship_free_note"]; ?></div>
						</div>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<div class='form_entry'>
							<span class='label'>
								<input name="price_type" id="price_variable" class='radio' type='radio' <?php echo $ship_tmp["price_fixed_all"]; ?> value='0'/> <?php echo $s["ship_method_price_fixed_all"];?>
							</span>
							<span class='label'>
								<input name="price_type" id="price_variable" class='radio' type='radio' <?php echo $ship_tmp["price_variable"]; ?> value='1'/> <?php echo $s["ship_method_price_variable"];?> 
								<input type="text" class='text' style='width: 40px;' name='price_interval' id='price_interval' value='<?php echo $ship_tmp["price_interval"]; ?>'/><span id="price_interval_alert_es" class='form_entry_alert'></span> <?php echo $s["ship_method_price_elements"] ?>
							</span>
							<span class='label'>
								<input name="price_type" id="price_fixed" class='radio' type='radio' <?php echo $ship_tmp["price_fixed"]; ?> value='2'/> <?php echo $s["ship_method_price_fixed"]." ".$s["ship_method_price_min"]; ?> 
								<input type="text" class='text' style='width: 40px;' name='price_min' id='price_min' value='<?php echo $ship_tmp["price_min"]; ?>'/><span id="price_min_alert_es" class='form_entry_alert'></span> <?php echo $s["ship_method_price_max"]; ?> 
								<input type="text" class='text' style='width: 40px;' name='price_max' id='price_max' value='<?php echo $ship_tmp["price_max"]; ?>'/><span id="price_max_alert_es" class='form_entry_alert'></span>
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class='form_entry'>
							<input name="country_filter" id="country_filter" class='radio' type='checkbox' <?php echo $ship_tmp["country_include_0"]; ?> value='0'/> <?php echo $s["ship_method_country_filter"];?>
							<fieldset>
								<table width="100%">
								<tr>
									<td>
										<span class='label'>
											<input name="country_include" id="country_include" class='radio' type='radio' <?php echo $ship_tmp["country_include_1"]; ?> value='1'/> <?php echo $s["ship_method_country_include"];?>
										</span>
									</td>
									<td rowspan="2" style='text-align: right;'>
										<select name="country" id="country">
											<?php
											for($i=0;$i<sizeof($countries);$i++){
												?>
												<option <?php if($i==$ship_tmp["country"]){ echo "selected";}?> value='<?php echo $i; ?>'> <?php echo $countries[$i]["name"]; ?></option>
												<?php
												echo $countries[$i]["name"];
											}
											?>
										</select><br/>
										<span id="country_alert" class='form_entry_alert'></span>
									</td>
								</tr>
								<tr>
									<td>
										<span class='label'>
											<input name="country_include" id="country_include" class='radio' type='radio' <?php echo $ship_tmp["country_include_2"]; ?> value='2'/> <?php echo $s["ship_method_country_exclude"];?> 
										</span>
									</td>
								</tr>
								</table>
							</fieldset>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class='form_entry'>
							<input name="province_filter" id="province_filter" class='radio' type='checkbox' <?php echo $ship_tmp["province_include_0"]; ?> value='0'/> <?php echo $s["ship_method_province_filter"];?>
							<fieldset>
								<table width="100%">
								<tr>
									<td>
										<span class='label'>
											<input name="province_include" id="province_include" class='radio' type='radio' <?php echo $ship_tmp["province_include_1"]; ?> value='1'/> <?php echo $s["ship_method_province_include"];?>
										</span>
									</td>
									<td rowspan="2" style='text-align: right;'>
										<input type='hidden' name='province' id='province' value='<?php echo $userdata["province"];?>' />
										<select name="province_spain" id="province_spain" style='<?php if($ship_tmp["country"]=="139") echo "display:none";?>'>
											<?php
											for($i=0;$i<sizeof($provinces);$i++){
												if(isset($provinces[$i]["name"])) {
													?>
													<option <?php if($i==$ship_tmp["province"]){ echo "selected";}?> value='<?php echo $i; ?>'> <?php echo $provinces[$i]["name"]; ?></option>
													<?php
													echo $provinces[$i]["name"];
												}
											}
											?>
										</select><br/>
										<select name="province_russia" id="province_russia" style='<?php if($ship_tmp["country"]!="139") echo "display:none";?>'>
											<?php
											for($i=1;$i<sizeof($provinces_russia);$i++){
												if(isset($provinces_russia[$i])) {
													if($provinces_russia[$i]["name"] == $ship_tmp["province"]) {
														$selected = " selected";
													} else {
														$selected = "";
													}
													echo "<option".$selected." value='".$provinces_russia[$i]["name"]."'> ".$provinces_russia[$i]["name"]."</option>";
												}
											}
											?>
										</select>
										<span id="province_alert" class='form_entry_alert'></span>
									</td>
								</tr>
								<tr>
									<td>
										<span class='label'>
											<input name="province_include" id="province_include" class='radio' type='radio' <?php echo $ship_tmp["province_include_2"]; ?> value='2'/> <?php echo $s["ship_method_province_exclude"];?> 
										</span>
									</td>
								</tr>
								</table>
							</fieldset>
						</div>
					</td>
				</tr>
				
				</table>
				<input type='hidden' name='ship_type' value='<?php echo $ship_type; ?>'/>
				<input type='hidden' name='ship_id' value='<?php echo $ship_tmp['id']; ?>'/>
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='button' value='<?php echo $s["accept"]?>'/></div>
					<div class='likeabutton'><input id="signup_cancel" type='button' value='<?php echo $s["cancel"]?>'/></div>
				</div>
			</form>
		</div>
		<?php
			}
		?>
	</div>
</div>
<?php
include ("footer.php");
?>