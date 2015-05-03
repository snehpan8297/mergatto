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
$signup=0;

if(isset($_POST["email"])){
	$user_tmp["name"] = $_POST["name"];
	$user_tmp["subname"] = $_POST["subname"];
	$user_tmp["password"] = $_POST["password"];
	$user_tmp["email"] = $_POST["email"];
	$user_tmp["web_active"] = 0;
	if(isset($_POST["active"])) {
		$user_tmp["web_active"] = 1;
	}
	$signup=adminAddUser($user_tmp);
	if($signup == 1) {
		header('location:./admin_list_users.php');
		die();
	}
} else {
	$user_tmp["name"] = "";
	$user_tmp["subname"] = "";
	$user_tmp["password"] = "";
	$user_tmp["email"] = "";
	$user_tmp["web_active"] = 0;
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

			if(client_password=="" || client_password.length<5 || client_password.length>20 || client_password==client_name ){
				$('#password').css('border','1px solid red');
				$('#password').css('color','red');
				if(client_password==""){
					$('#password_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_password.length<5){
					$('#password_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20){
					$('#password_alert').html('<?php echo $s["field_too_long"]; ?>');
				} else if(client_password==client_name){
					$('#password_alert').html('<?php echo $s["name_pass_match"]; ?>');
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
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["add_user"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["add_user_moreinfo"];?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_user.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["add_user_subtitle"]; ?></h3></span>
					<?php
					if($signup==2){
						echo "<span id='login_client_alert' class='form_entry_alert'><p>".$s["add_user_error"]."</p></span>";
					}else if($signup==3){
						echo "<span id='login_client_alert' class='form_entry_alert'><p>".$s["add_user_duplicate"]."</p></span>";
					}
					?>
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
					<span class='label'><?php echo $s["password"];?> <span class='form_isrequired'>*</span></span><input name="password" id="password" class='text' type='password' value='' autocomplete="off"/>
					<span id="password_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><input type="checkbox" name="active" id="active" <?php if($user_tmp["web_active"]==1) { echo "checked='checked'";} ?>>
					<?php echo $s["active"]; ?> <span class='form_isrequired'>*</span></span>
					<span id="active_alert" class='form_entry_alert'></span>
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
	</div>
</div>
<?php
include ("footer.php");
?>