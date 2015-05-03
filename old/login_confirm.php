<?php 
/*
	Login_Confirm
	
	------
	
	Sirve para que se confirme que el usuario tiene el email bien puesto en caso de que sea la primera vez que acceda.

*/
@session_start();
if(!isset($_SESSION['user'])) {
	header("login.php");
}
$page="login_confirm";
include_once("include/users.php");
if(isset($_POST["login_client_mail"])) {
	$user = array("code"=>$_POST["login_client_code"],"mail"=>$_POST["login_client_mail"],"remail"=>$_POST["login_client_remail"]);
	if(activate($user)) {
		header("location:index.php");
	}
} else {
	$user = array("code"=>$_SESSION['user']['client_code']);
	$mail = userField($user,"email");
}
include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#login_send_step_1').click(function(){
			client_mail = $('#login_client_mail').val();
			client_remail = $('#login_client_remail').val();
			error = false;
			if(client_remail=="" || client_remail!=client_mail){
				$('#login_client_remail').css('border','1px solid red');
				$('#login_client_remail').css('color','red');
				$('#login_client_remail_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#login_client_remail_alert').css('display','inline');
				$('#login_client_remail').focus();
				error = true;
			}else{
				$('#login_client_remail').css('border','1px solid green');
				$('#login_client_remail').css('color','green');
				$('#login_client_remail_alert').css('display','none');
			}
			if(client_mail==""){
				$('#login_client_mail').css('border','1px solid red');
				$('#login_client_mail').css('color','red');
				$('#login_client_mail_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#login_client_mail_alert').css('display','inline');
				$('#login_client_mail').focus();
				error = true;
			}else{
				$('#login_client_mail').css('border','1px solid green');
				$('#login_client_mail').css('color','green');
				$('#login_client_mail_alert').css('display','none');
			}
			if(!error){
				$('#step_1').submit();
			}
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["login_confirm_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["login_confirm_moreinfo"]; ?>
		</div>
		<div class='form' id="login_step_1" style="display:block">
			<form id='step_1' action="./login_confirm.php<?php echo $variables; ?>" method="post">
				<input type="hidden" name="login_client_code" id="login_client_code" value="<?php echo $_SESSION['user']['client_code']; ?>"/>
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["login_confirm_subtitle"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["login_client_email"]?> <span class='form_isrequired'>*</span></span><input  name="login_client_mail" id="login_client_mail" class='text' type='text' value='<?php echo trim($mail); ?>'/>
					<span id="login_client_mail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["login_client_remail"]?> <span class='form_isrequired'>*</span></span><input name="login_client_remail" id="login_client_remail" class='text' type='text'/>
					<span id="login_client_remail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><a id="login_send_step_1" href="javascript:void(0);"><span class='text'><?php echo $s["login_button"]?></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
unset($_SESSION['user']['client_code']);
?>