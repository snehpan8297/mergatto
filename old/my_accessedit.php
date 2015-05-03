<?php 
//Lang confirmado
$page="my_editinfo";
$interface_options["cart_menu_hidden"]=1;

include("header.php");

if(isset($_POST["signup_client_newemail"]) && isset($_POST["signup_client_renewemail"]) && $_POST["signup_client_newemail"]===$_POST["signup_client_renewemail"]) {
	$new_data["id_client"] = $_SESSION['user_classics']['id_client'];
	$new_data["email"] = $_POST["signup_client_newemail"];
	include("functions/get_lang.php");
	include('./include/includes.php');
	$success=updateUser($new_data);
}

$user = array("id_client" => $_SESSION['user_classics']['id_client']);
$u = userData($user);
?>
<script>
	$(document).ready(function (){
		$('#add_to_cart_button').click(function(){
			error = false;
			email = $('#signup_client_newemail').val();
			reemail = $('#signup_client_renewemail').val();
			var patron=/^[a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/;
			if((email=="") || !patron.test(email)){
				$('#signup_client_newsignup_client_newemail').css('border','1px solid red');
				$('#signup_client_newsignup_client_newemail').css('color','red');
				if(email==""){
					$('#signup_client_newemail_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(email)){
					$('#signup_client_newemail_alert').html('<?php echo $s["invalid_format"]; ?>');
				}
				$('#signup_client_newemail_alert').css('display','inline');
				$('#signup_client_newemail').focus();
				error = true;
			}else{
				$('#signup_client_newemail').css('border','1px solid green');
				$('#signup_client_newemail').css('color','green');
				$('#signup_client_newemail_alert').css('display','none');
			}
			if((reemail=="") || !patron.test(reemail) || reemail!=email){
				$('#signup_client_newsignup_client_renewemail').css('border','1px solid red');
				$('#signup_client_newsignup_client_renewemail').css('color','red');
				if(reemail==""){
					$('#signup_client_renewemail_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(reemail)){
					$('#signup_client_renewemail_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(reemail!=email){
					$('#signup_client_renewemail_alert').html('<?php echo $s["email_not_match"]; ?>');
				}
				$('#signup_client_renewemail_alert').css('display','inline');
				$('#signup_client_renewemail').focus();
				error = true;
			}else{
				$('#signup_client_renewemail').css('border','1px solid green');
				$('#signup_client_renewemail').css('color','green');
				$('#signup_client_renewemail_alert').css('display','none');
			}
			if(!error){
				$("#form").submit();
				return true;
			}
			return false;
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <span class='important'><?php echo $s["my_access_info"]; ?></span></div>
	</div>
	<div class='contentbox'>
		<?php
		if (isset($success) && $success) {
			?>
			<div id='infobox_header' class='infobox_info'>
				<h3 style='color: green;'><?php echo $s["data_saved_successfully"];?></h3>
			</div>
			<?php
		} ?>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_access_info_moreinfo"];?></div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='form' action="./my_accessedit.php" method="post">
				<div class='form_entry'>
					<span class='title'><h3><?php echo $s["signup_access_data"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_oldemail"]?> <span class='form_isrequired'>*</span></span>
					<input  name="signup_client_oldemail" id="signup_client_oldemail" class='text' type='text' value='<?php echo $u["email"]; ?>' readonly="readonly"/>
					<span id="signup_client_oldemail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_newemail"]?> <span class='form_isrequired'>*</span></span>
					<input name="signup_client_newemail" id="signup_client_newemail" class='text' type='text'></input>
					<span id="signup_client_newemail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_renewemail"]?> <span class='form_isrequired'>*</span></span><input name="signup_client_renewemail" id="signup_client_renewemail" class='text' type='text' />
					<span id="signup_client_renewemail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton' style='float:left;'><a href="./my_account.php"><span class='text'><span class='left_decoration'></span><?php echo $s["cancel"]?></span><span class='right_decoration'></span></a></div>
					<div class='likeabutton' id="add_to_cart_button" style='float:left;'><a id="payments_send_step1" href="javascript:void(0)"><span class='text'><span class='left_decoration'></span><?php echo $s["save"]?></span><span class='right_decoration'></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>