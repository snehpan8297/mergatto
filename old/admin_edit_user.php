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
include_once("include/users.php");
include_once("include/inbd.php");
$signup=2;

if(isset($_POST["email"])){
	$table="clients";
	$filter = array();
	$filter["id_client"] = array("operation"=>"=","value"=>$_POST["id_client"]);
	$user_tmp=array();
	$user_tmp["id_client"] = $_POST["id_client"];
	$user_tmp["id_elastic"] = $_POST["id_elastic"];
	$user_tmp["id_client_group"] = $_POST["id_client_group"];
	$user_tmp["name"] = $_POST["name"];
	$user_tmp["subname"] = $_POST["subname"];
	$user_tmp["user_type"] = $_POST["user_type"];
	$user_tmp["discount"] = $_POST["discount"];
	if (isset($_POST["password"]) && !empty($_POST["password"])){
		$user_tmp["password"] = md5($_POST["password"]);
	}
	$user_tmp["email"] = $_POST["email"];
	$user_tmp["web_active"] = 0;
	if(isset($_POST["active"])) {
		$user_tmp["web_active"] = 1;
	}
	$signup=updateInBD($table,$filter,$user_tmp);
	header('location:./admin_list_users.php');
	die();
}
if(isset($_GET["id_client"])){
	$user_tmp['id_client']=$_GET["id_client"];
	$user_tmp=userData($user_tmp);
} else {
	header('location:./admin_list_users.php');
	die();
}

$page = "admin";
include ("header.php");
?>
<script>
	$(document).ready(function (){
		$('#signup_send_step_1').click(function(){
			client_name = $('#name').val();
			client_subname = $('#subname').val();
			client_email = $('#email').val();
			client_password = $('#password').val();
			error = false;
			if(client_password!="" && (client_password.length<5 || client_password.length>20)){
				$('#password').css('border','1px solid red');
				$('#password').css('color','red');
				if(client_password.length<5){
					$('#password_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20 ){
					$('#password_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#password_alert').css('display','inline');
				$('#password').focus();
				error = true;
			}else{
				$('#password').css('border','1px solid green');
				$('#password').css('color','green');
				$('#password_alert').css('display','none');
			}
			var patron=/^[a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/;
			if(client_email=="" || client_email.length>40 || !patron.test(client_email)){
				$('#email').css('border','1px solid red');
				$('#email').css('color','red');
				if(client_email==""){
					$('#email_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_email)){
					$('#email_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(client_email.length>40){
					$('#email_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#email_alert').css('display','inline');
				$('#email').focus();
				error = true;
			}else{
				$('#email').css('border','1px solid green');
				$('#email').css('color','green');
				$('#email_alert').css('display','none');
			}
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if(client_subname=="" || !patron.test(client_subname) || client_subname.length<3 || client_subname.length>40 ){
				$('#subname').css('border','1px solid red');
				$('#subname').css('color','red');
				if(client_name==""){
					$('#subname_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_subname)){
					$('#subname_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(client_name.length<3){
					$('#subname_alert').html('<?php echo $s["field_too_short_3"]; ?>');
				}else if(client_name.length>20 ){
					$('#subname_alert').html('<?php echo $s["field_too_long_email"]; ?>');
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
			if(client_name=="" || !patron.test(client_name) || client_name.length<3 || client_name.length>40 ){
				$('#name').css('border','1px solid red');
				$('#name').css('color','red');
				if(client_name==""){
					$('#name_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_name)){
					$('#name_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(client_name.length<3){
					$('#name_alert').html('<?php echo $s["field_too_short_3"]; ?>');
				}else if(client_name.length>20 ){
					$('#name_alert').html('<?php echo $s["field_too_long_email"]; ?>');
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
				$('#step_1').submit();
				return true;
			}
			return false;
		});
	});
</script>
<style>
.important2 { color: black; font-weight: bold; }
</style>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='./admin_list_users.php'><?php echo $s["admin_users"] ?></a> / <a href='#' class='important2'><?php echo $s["edit_user"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
		if($signup==1){
			?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["edit_user_success"];?>
			</div>
			<?php
		}else{
		?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["edit_user_moreinfo"];?>
			</div>
			<div class='form' id="signup_step_1" style="display:block">
				<form id='step_1' action="./admin_edit_user.php" method="post">
					<div class='form_entry'>
						<span class='label'><h3><?php echo $s["edit_user_subtitle"]; ?></h3></span>
						<?php
						if($signup==3){
							?>
							<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["edit_client_error"]; ?></p></span>
							<?php
						}
						?>
					</div>
					<div class='form_entry'>
						<span class='label'>Identificador Elastic Fashion</span><input  name="id_elastic" id="id_elastic" class='text' type='text' value='<?php echo $user_tmp["id_elastic"]; ?>' autocomplete="off"/>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["name"];?> <span class='form_isrequired'>*</span></span><input  name="name" id="name" class='text' type='text' value='<?php echo $user_tmp["name"]; ?>' autocomplete="off"/>
						<span id="name_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["subname"];?> <span class='form_isrequired'>*</span></span><input  name="subname" id="subname" class='text' type='text' value='<?php echo $user_tmp["subname"]; ?>' autocomplete="off"/>
						<span id="subname_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["email"];?> <span class='form_isrequired'>*</span></span><input  name="email" id="email" class='text' type='text' value='<?php echo $user_tmp["email"]; ?>' autocomplete="off"/>
						<span id="email_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'>Grupo</span>
						<select name='id_client_group' id='id_client_group'>
							<option value='0'>Ningún grupo</option>
							<?php
								$table='client_groups';
								$client_groups = listInBD($table);
								foreach ($client_groups as $key => $client_group){
									?>
										<option value='<?php echo $client_group["id_client_group"];?>' <?php if($user_tmp["id_client_group"]==$client_group["id_client_group"]) echo "selected";?> ><?php echo $client_group["name"];?></option>
									<?php
								}
							?>
						</select>
						<span id="client_group_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["password"];?></span><input name="password" id="password" class='text' type='password' value='' autocomplete="off"/>
						<span id="password_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><input type="checkbox" name="active" id="active" <?php if($user_tmp["web_active"]==1) { echo "checked='checked'";} ?>>
						<?php echo $s["active"]; ?></span>
						<span id="active_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'>Tipo de Usuario (0: Normal, 1:Retailer)</span><input name="user_type" id="user_type" class='text' type='text' value='<?php echo $user_tmp["user_type"];?>' autocomplete="off"/>
						<span id="password_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'>Descuento</span><input name="discount" id="discount" class='text' type='text' value='<?php echo $user_tmp["discount"];?>' autocomplete="off"/>
						<span id="password_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
					</div>
					<input type='hidden' name='id_client' value='<?php echo $user_tmp["id_client"]; ?>'/>
					<div class='form_submit'>
						<div class='likeabutton'><input id="signup_send_step_1" type='submit' value='<?php echo $s["accept"]?>'/></div>
					</div>
				</form>
			</div>
			<hr>
			<div>
				<p><span class='label'><h3><?php echo $s["edit_user_main_address"]; ?></h3></span></p>
				<table>
				<tr>
					<td class='important2'><?php echo $s["signup_name"]?></td>
					<td><?php echo $user_tmp["name"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_subname"]?></td>
					<td><?php echo $user_tmp["subname"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_dni"]?></td>
					<td><?php echo $user_tmp["DNI"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_address"]?></td>
					<td><?php echo $user_tmp["address_1"];?></td>
				</tr>
				<tr>
					<td class='important2'></td>
					<td><?php echo $user_tmp["address_2"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_post_code"]?></td>
					<td><?php echo $user_tmp["post_code"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_city"]?></td>
					<td><?php echo $user_tmp["city"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_province"]?></td>
					<td><?php 
							if(isset($provinces[$user_tmp["province"]]["name"]) && $countries[$user_tmp["country"]]["name"] == "España") {
								echo $provinces[$user_tmp["province"]]["name"];
							} elseif(!is_numeric($user_tmp["province"])) {
								echo $user_tmp["province"];
							}
							?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_country"]?></td>
					<td><?php echo $user_tmp["country"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_mobile"]?></td>
					<td><?php echo $user_tmp["mobile"];?></td>
				</tr>
				<tr>
					<td class='important2'><?php echo $s["signup_other"]?></td>
					<td><?php echo $user_tmp["other"];?></td>
				</tr>
				</table>
			</div>
			<div>
				<p><span class='label'><h3><?php echo $s["edit_user_alt_address"]; ?></h3></span></p>
				<?php $addresses = listAddresses($user_tmp);
				while($user_tmp = db_fetch($addresses)) {
					?>
					<table style='margin: 20px 0px;'>
					<tr>
						<td class='important2'><?php echo $s["signup_name"]?></td>
						<td><?php echo $user_tmp["name"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_subname"]?></td>
						<td><?php echo $user_tmp["subname"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_address"]?></td>
						<td><?php echo $user_tmp["address_1"];?></td>
					</tr>
					<tr>
						<td class='important2'></td>
						<td><?php echo $user_tmp["address_2"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_post_code"]?></td>
						<td><?php echo $user_tmp["post_code"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_city"]?></td>
						<td><?php echo $user_tmp["city"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_province"]?></td>
						<td><?php 
							if(isset($provinces[$user_tmp["province"]]["name"]) && $countries[$user_tmp["country"]]["name"] == "España") {
								echo $provinces[$user_tmp["province"]]["name"];
							} elseif(!is_numeric($user_tmp["province"])) {
								echo $user_tmp["province"];
							}
							?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_country"]?></td>
						<td><?php echo $countries[$user_tmp["country"]]["name"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_mobile"]?></td>
						<td><?php echo $user_tmp["mobile"];?></td>
					</tr>
					<tr>
						<td class='important2'><?php echo $s["signup_other"]?></td>
						<td><?php echo $user_tmp["other"];?></td>
					</tr>
					</table>
				<?php
				}
				?>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php
include ("footer.php");
?>