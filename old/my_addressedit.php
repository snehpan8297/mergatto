<?php 
//Lang confirmado
$interface_options["cart_menu_hidden"]=1;
$page="my_editinfo";
if (!isset($_SESSION)) {
	@session_start();
}
	include("functions/get_lang.php");
include('./include/includes.php');

if(isset($_GET["id"])){
	if(isset($_SESSION['user_classics']['id_client'])){
		$user["id_client"] = $_SESSION['user_classics']['id_client'];
	} else {
		$user["id_client"] = 0;
	}
	$userdata = userData($user);
	$action="edit";
	$address = addressData($userdata,$_GET["id"]);
	if(empty($address)) {
		header("location:404.php");
	}
}else{
	$action="new";
	$address = array("name"=>"","subname"=>"","address_1"=>"","address_2"=>"","post_code"=>"","city"=>"","country"=>"","province"=>"","mobile"=>"","other"=>"");
}

if((isset($_POST["name"]))&&(isset($_POST["subname"]))&&(isset($_POST["address_1"]))&&(isset($_POST["post_code"]))&&(isset($_POST["city"]))&&(isset($_POST["province"]))&&(isset($_POST["country"]))&&(isset($_POST["mobile"]))){
	$new_data["name"] = $_POST['name'];
	$new_data["subname"] = $_POST['subname'];
	$new_data["address_1"] = $_POST['address_1'];
	$new_data["address_2"] = $_POST['address_2'];
	$new_data["post_code"] = $_POST['post_code'];
	$new_data["city"] = $_POST['city'];
	$new_data["country"] = $_POST['country'];
	if($_POST['country'] == 155) {
		$new_data["province"] = $_POST['province'];
	} else {
		$new_data["province"] = $_POST['province2'];
	}
	$new_data["mobile"] = $_POST['mobile'];
	$new_data["other"] = $_POST['other'];
	if(isset($_POST["id_address"])){
		$new_data["id_address"] = $_POST["id_address"];
		$success = updateAddress($new_data);
	}else{
		$new_data["id_client"] = $_SESSION['user_classics']['id_client'];
		$success = addAddress($new_data);
	}
	header("location:my_addressesedit.php");
}

include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#save').click(function(){
			name = $('#name').val();
			subname = $('#subname').val();
			address_1 = $('#address_1').val();
			post_code = $('#post_code').val();
			city = $('#city').val();
			//province = $('#province').val();
			//country = $('#country').val();
			mobile = $('#mobile').val();
			other = $('#other').val();
			error = false;
			if(other!="") {
				var patron=/^\+{0,1}[0-9]+[0-9 ]*[0-9]+$/;
				if(!patron.test(other) || (other.length>20)){
					$('#other').css('border','1px solid red');
					$('#other').css('color','red');
					if(!patron.test(other)){
						$('#other_alert').html('<?php echo $s["invalid_format"]; ?>');
					}else if(other.length>20){
						$('#other_alert').html('<?php echo $s["too_long"]; ?>');
					}
					$('#other_alert').css('display','inline');
					$('#other').focus();
					error = true;
				}else{
					$('#other').css('border','1px solid green');
					$('#other').css('color','green');
					$('#other_alert').css('display','none');
				}
			}
			var patron=/^\+{0,1}[0-9]+[0-9 ]*[0-9]+$/;
			if((mobile=="") || !patron.test(mobile) || (mobile.length>20)){
				$('#mobile').css('border','1px solid red');
				$('#mobile').css('color','red');
				if(mobile==""){
					$('#mobile_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(mobile)){
					$('#mobile_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(mobile.length>20){
					$('#mobile_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#mobile_alert').css('display','inline');
				$('#mobile').focus();
				error = true;
			}else{
				$('#mobile').css('border','1px solid green');
				$('#mobile').css('color','green');
				$('#mobile_alert').css('display','none');
			}
			/*if((country==0)){
				$('#country').css('border','1px solid red');
				$('#country_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#country_alert').css('display','inline');
				$('#country').focus();
				error = true;
			}else{
				$('#country').css('border','1px solid green');
				$('#country_alert').css('display','none');
			}
			if((province==0)){
				$('#province').css('border','1px solid red');
				$('#province_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#province_alert').css('display','inline');
				$('#province').focus();
				error = true;
			}else{
				$('#province').css('border','1px solid green');
				$('#country_alert').css('display','none');
			}*/
			
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((city=="") || !patron.test(city) || (city.length>50)){
				$('#city').css('border','1px solid red');
				$('#city').css('color','red');
				if(city==""){
					$('#city_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(city)){
					$('#city_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(city.length>50){
					$('#city_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#city_alert').css('display','inline');
				$('#city').focus();
				error = true;
			}else{
				$('#city').css('border','1px solid green');
				$('#city').css('color','green');
				$('#city_alert').css('display','none');
			}
			if((post_code=="") || (post_code.length>20)){
				$('#post_code').css('border','1px solid red');
				$('#post_code').css('color','red');
				if(post_code==""){
					$('#post_code_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(post_code.length>20){
					$('#post_code_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#post_code_alert').css('display','inline');
				$('#post_code').focus();
				error = true;
			}else{
				$('#post_code').css('border','1px solid green');
				$('#post_code').css('color','green');
				$('#post_code_alert').css('display','none');
			}
			if((address_1=="") || (address_1.length>50)){
				$('#address_1').css('border','1px solid red');
				$('#address_1').css('color','red');
				$('#address_2').css('border','1px solid red');
				$('#address_2').css('color','red');
				if(address_1==""){
					$('#address_1_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(address_1.length>50){
					$('#address_1_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#address_1_alert').css('display','inline');
				$('#address_1').focus();
				error = true;
			}else{
				$('#address_1').css('border','1px solid green');
				$('#address_1').css('color','green');
				$('#address_2').css('border','1px solid green');
				$('#address_2').css('color','green');
				$('#address_1_alert').css('display','none');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((subname=="") || !patron.test(subname) || (subname.length>50)){
				$('#subname').css('border','1px solid red');
				$('#subname').css('color','red');
				if(subname==""){
					$('#subname_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(subname)){
					$('#subname_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(subname.length>50){
					$('#subname_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#subname_alert').css('display','inline');
				$('#subname').focus();
				error = true;
			}else{
				$('#subname').css('border','1px solid green');
				$('#subname').css('color','green');
				$('#subname_alert').css('display','none');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if((name=="") || !patron.test(name) || (name.length>50)){
				$('#name').css('border','1px solid red');
				$('#name').css('color','red');
				if(name==""){
					$('#name_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(name)){
					$('#name_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(name.length>50){
					$('#name_alert').html('<?php echo $s["too_long"]; ?>');
				}
				$('#name_alert').css('display','inline');
				$('#name').focus();
				error = true;
			}else{
				$('#name').css('border','1px solid green');
				$('#name').css('color','green');
				$('#name_alert').css('display','none');
			}
			if(!error){
				$("#form").submit();
				return true;
			}
			return false;
		});
		$('#country').change(function(){
			if($('#country').val() == "52"){ //If it's spain shows province selector, else shows an input
				$('#province2').hide();
				$('#province').val("");
				$('#province').show();
			} else {
				$('#province').hide();
				$('#province2').val("");
				$('#province2').show();
			}
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <a href='./my_addressesedit.php'><?php echo $s["my_addresses_info"]; ?></a> / 
		<?php
			if($action=="new"){
				?>
				<span class='important'><?php echo $s["add_new_address"]; ?></span></div>
				<?php
			}else{
				?>
				<span class='important'><?php echo $s["add_edit_address"]; ?></span></div>
				<?php
			}
		?>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_address_moreinfo"];?></div>
		<div class='form' style="display:block">
			<form id='form' action="./my_addressedit.php" method="post">
				<div class='form_entry'>
					<span class='title'><h3><?php echo $s["address_data"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_name"]?> <span class='form_isrequired'>*</span></span><input  name="name" id="name" class='text' type='text' value='<?php echo $address["name"]; ?>'/>
					<span id="name_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_subname"]?> <span class='form_isrequired'>*</span></span><input  name="subname" id="subname" class='text' type='text' value='<?php echo $address["subname"]; ?>'/>
					<span id="subname_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_address"]?> <span class='form_isrequired'>*</span></span><input  name="address_1" id="address_1" class='text' type='text' value='<?php echo $address["address_1"]; ?>'/>
					<span id="address_1_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<input  name="address_2" id="address_2" class='text' type='text' value='<?php echo $address["address_2"]; ?>'/>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_post_code"]?> <span class='form_isrequired'>*</span></span><input  name="post_code" id="post_code" class='text' type='text' value='<?php echo $address["post_code"]; ?>'/>
					<span id="post_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_town"]?> <span class='form_isrequired'>*</span></span><input  name="city" id="city" class='text' type='text' value='<?php echo $address["city"]; ?>'/>
					<span id="city_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_country"]?> <span class='form_isrequired'>*</span></span>
					<select name="country" id="country">
						<?php
						$display = array("","");
						for($i=0;$i<sizeof($countries);$i++){
							if(isset($countries[$i])) {
								if($i == $address["country"]) {
									$selected = " selected";
									if($countries[$i]["name"] != "España") {
										$display[0] = "display:none;";
									} else {
										$display[1] = "display:none;";
									}
								} else {
									$selected = "";
								}
								echo "<option".$selected." value='".$i."'> ".$countries[$i]["name"]."</option>";
							}
						}
						?>
					</select>
					<span id="country_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_province"]?> <span class='form_isrequired'>*</span></span>
					<select name="province" id="province" style='<?php echo $display[0]; ?>'>
						<?php
						for($i=0;$i<sizeof($provinces);$i++){
							if(isset($provinces[$i])) {
								if($i == $address["province"]) {
									$selected = " selected";
								} else {
									$selected = "";
								}
								echo "<option".$selected." value='".$i."'> ".$provinces[$i]["name"]."</option>";
							}
						}
						?>
					</select>
					<?php
					if(isset($provinces[$address["province"]]["name"]) && $countries[$address["country"]]["name"] == "España") {
						$prov = $provinces[$address["province"]]["name"];
					} elseif(!is_numeric($address["province"])) {
						$prov = $address["province"];
					} else {
						$prov = "";
					}
					?>
					<input type='text' id='province2' name='province2' class='text' value='<?php echo $prov; ?>' style='width:240px;<?php echo $display[1]; ?>'/>
					<span id="province_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_mobile"]?> <span class='form_isrequired'>*</span></span><input  name="mobile" id="mobile" class='text' type='text' value='<?php echo $address["mobile"]; ?>'/>
					<span id="mobile_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_other"]?> </span><input  name="other" id="other" class='text' type='text' value='<?php echo $address["other"]; ?>'/>
					<span id="other_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='comment'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton' style='float:left;'><a href="./my_addressesedit.php"><span class='text'><span class='left_decoration'></span><?php echo $s["cancel"]?></span><span class='right_decoration'></span></a></div>
					<?php
						if($action=="edit"){
							?>
							<input type='hidden' name='id_address' value='<?php echo $_GET["id"];?>'/>
							<?php	
						}
					?>
					<div class='likeabutton' style='float:left;'><a id="save" href="javascript:void(0)"><span class='text'><span class='left_decoration'></span><?php echo $s["save"]?></span><span class='right_decoration'></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>