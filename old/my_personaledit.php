<?php 
//Lang confirmado
$interface_options["cart_menu_hidden"]=1;

$page="my_editinfo";
@session_start();
if(!isset($_SESSION['user_classics'])) {
	header("location: login.php");
	die();
}
//$error = 0;
if((isset($_POST["name"]))&&(isset($_POST["subname"]))&&(isset($_POST["DNI"]))&&(isset($_POST["address_1"]))&&(isset($_POST["post_code"]))&&(isset($_POST["city"]))&&(isset($_POST["province"]))&&(isset($_POST["country"]))&&(isset($_POST["mobile"]))){
	$new_data["id_client"] = $_SESSION['user_classics']['id_client'];
	$new_data["name"] = $_POST['name'];
	$new_data["subname"] = $_POST['subname'];
	$new_data["DNI"] = $_POST['DNI'];
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
	include("functions/get_lang.php");
	include('./include/includes.php');
	$success=updateUser($new_data);
	if((isset($_POST["action"]))&&($_POST["action"]=="new")){
		header("location:index.php?action=thanks");
	}
}
include("header.php");
$user = array("code" => $_SESSION['user_classics']['id_client']);
$u = userData($user);

if((isset($_GET["action"]))&&($_GET["action"]=="new")){
	$action="new";
}else{
	$action="edit";
}
?>
<script>
	$(document).ready(function (){
		$('#add_to_cart_button').click(function(){
			name = $('#name').val();
			subname = $('#subname').val();
			DNI = $('#DNI').val();
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
				$('#country').focus();
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
			if(DNI==""){
				$('#DNI').css('border','1px solid red');
				$('#DNI').css('color','red');
				if(subname==""){
					$('DNI_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}
				$('#DNI_alert').css('display','inline');
				$('#DNI').focus();
				error = true;
			}else{
				$('#DNI').css('border','1px solid green');
				$('#DNI').css('color','green');
				$('#DNI_alert').css('display','none');
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
		$('#province').change(function(){
			$('#province2').val($('#province').val());
		});
		$('#province3').change(function(){
			$('#province2').val($('#province3').val());
		});
		$('#country').change(function(){
			if($('#country').val() == "España"){ //If it's spain shows province selector, else shows an input
				$('#province2').hide();
				$('#province3').hide();
				$('#province').val("");
				$('#province').show();
			} else if($('#country').val() == "Russia") {
				$('#province2').hide();
				$('#province').hide();
				$('#province3').val("");
				$('#province3').show();
			}else {
				$('#province').hide();
				$('#province3').hide();
				$('#province2').val("");
				$('#province2').show();
			}
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <span class='important'><?php echo $s["my_personal_info"]; ?></span></div>
	</div>
	<div class='contentbox'>
		<?php
		if (isset($success)) {
			?>
			<div id='infobox_header' class='infobox_info'>
				<h3 style='color: green;'><?php echo $s["general_config_succesful"];?></h3>
			</div>
			<?php
		} ?>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_personal_moreinfo"];?></div>
		<div class='form' style="display:block">
			<form id='form' action="./my_personaledit.php" method="post">
				<div class='form_entry'>
				<?php
					/*if($error==1){
						?>
						<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["data_error"];?></p></span>
						<?php
					}*/
				?>
				</div>
				<div class='form_entry'>
					<span class='title'><h3><?php echo $s["signup_address_data"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_name"]?> <span class='form_isrequired'>*</span></span><input  name="name" id="name" class='text' type='text' value='<?php echo $userdata["name"]; ?>'/>
					<span id="name_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_subname"]?> <span class='form_isrequired'>*</span></span><input  name="subname" id="subname" class='text' type='text' value='<?php echo $userdata["subname"]; ?>'/>
					<span id="subname_alert" class='form_entry_alert'></span>
				</div>
				
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_dni"]?> <span class='form_isrequired'>*</span></span><input  name="DNI" id="DNI" class='text' type='text' value='<?php echo $userdata["DNI"]; ?>'/>
					<span id="DNI_alert" class='form_entry_alert'></span>
				</div>
				
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_address"]?> <span class='form_isrequired'>*</span></span><input  name="address_1" id="address_1" class='text' type='text' value='<?php echo $userdata["address_1"]; ?>'/>
					<span id="address_1_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<input  name="address_2" id="address_2" class='text' type='text' value='<?php echo $userdata["address_2"]; ?>'/>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_post_code"]?> <span class='form_isrequired'>*</span></span><input  name="post_code" id="post_code" class='text' type='text' value='<?php echo $userdata["post_code"]; ?>'/>
					<span id="post_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_town"]?> <span class='form_isrequired'>*</span></span><input  name="city" id="city" class='text' type='text' value='<?php echo $userdata["city"]; ?>'/>
					<span id="city_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_country"]?> <span class='form_isrequired'>*</span></span>
					<select name="country" id="country">
						<?php
						$display = array("","");
						$display[0] = "";
						$display[1] = "display:none;";
						$display[2] = "display:none;";
						for($i=0;$i<sizeof($countries);$i++){
							if(isset($countries[$i])) {
								if($countries[$i]["name"] == $userdata["country"]) {
									$selected = " selected";
									if($countries[$i]["name"] == "España") {
										$display[0] = "";
										$display[1] = "display:none;";
										$display[2] = "display:none;";
									} else if($countries[$i]["name"] == "Russia") {
										$display[0] = "display:none;";
										$display[2] = "";
										$display[1] = "display:none;";
									} else{
										$display[0] = "display:none;";
										$display[1] = "";
										$display[2] = "display:none;";
									}
								} else {
									$selected = "";
								}
								echo "<option".$selected." value='".$countries[$i]["name"]."'> ".$countries[$i]["name"]."</option>";
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
								if($provinces[$i]["name"] == $userdata["province"]) {
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
					<input type='text' id='province2' name='province2' class='text' value='<?php echo $prov; ?>' style='width:240px;<?php echo $display[1]; ?>'/>
					<select id='province3' name='province3' name="province_russia" id="province_russia" style='<?php echo $display[2]; ?>'>
						<?php
						for($i=1;$i<sizeof($provinces_russia);$i++){
							if(isset($provinces_russia[$i])) {
								if($provinces_russia[$i]["name"] == $userdata["province"]) {
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
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_mobile"]?> <span class='form_isrequired'>*</span></span><input  name="mobile" id="mobile" class='text' type='text' value='<?php echo $userdata["mobile"]; ?>'/>
					<span id="mobile_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_other"]?> </span><input  name="other" id="other" class='text' type='text' value='<?php echo $userdata["other"]; ?>'/>
					<span id="other_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='comment'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<?php
					if($action=="new"){
						?>
						<input type='hidden' name='action' value='new'/>
						<div class='likeabutton' id="add_to_cart_button" style='float:left;'><a href="javascript:void(0)" id='button'><span class='text'><span class='left_decoration'></span><?php echo $s["finish_it"];?></span><span class='right_decoration'></span></a></div>
						<?php
					}else{
						?>
						<div class='likeabutton' style='float:left;'><a href="./my_account.php"><span class='text'><span class='left_decoration'></span><?php echo $s["cancel"]?></span><span class='right_decoration'></span></a></div>
						<div class='likeabutton' id="add_to_cart_button" style='float:left;'><a id="payments_send_step1" href="javascript:void(0)"><span class='text'><span class='left_decoration'></span><?php echo $s["save"]?></span><span class='right_decoration'></span></a></div>
					<?php
					}
					?>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>