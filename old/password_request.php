<?php
//Lang confirm
@session_start();

include_once('./include/users.php');

$recoverpass=2;
$sended=false;
if(isset($_POST["recover_pass_client_email"])) {
	$recoverpass = recoverPass($_POST["recover_pass_client_email"]);
	$sended=true;
	header("location:password_requested.php");
	die();
}
$page="recover_pass";
include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#signup_send_step_1').click(function(){
			client_email = $('#recover_pass_client_email').val();
			client_reemail = $('#recover_pass_client_reemail').val();
			error = false;
			if((client_reemail=="") || (client_reemail!=client_email)){
				$('#recover_pass_client_reemail').css('border','1px solid red');
				$('#recover_pass_client_reemail').css('color','red');
				if(client_reemail==""){
					$('#recover_pass_client_reemail_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_reemail!=client_email){
					$('#recover_pass_client_reemail_alert').html('<?php echo $s["email_not_match"]; ?>');
				}
				$('#recover_pass_client_reemail_alert').css('display','inline');
				$('#recover_pass_client_reemail').focus();
				error = true;
			}else{
				$('#recover_pass_client_reemail').css('border','1px solid green');
				$('#recover_pass_client_reemail').css('color','green');
				$('#recover_pass_client_reemail_alert').css('display','none');
			}
			var patron=/^[a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/;
			if(client_email=="" || client_email.length>40 || !patron.test(client_email)){
				$('#recover_pass_client_email').css('border','1px solid red');
				$('#recover_pass_client_email').css('color','red');
				if(client_email==""){
					$('#recover_pass_client_email_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_email)){
					$('#recover_pass_client_email_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(client_email.length>40){
					$('#recover_pass_client_email_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#recover_pass_client_email_alert').css('display','inline');
				$('#recover_pass_client_email').focus();
				error = true;
			}else{
				$('#recover_pass_client_email').css('border','1px solid green');
				$('#recover_pass_client_email').css('color','green');
				$('#recover_pass_client_email_alert').css('display','none');
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
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["recover_pass_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<?php
			if($sended){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["recover_pass_sended"]; ?>
				</div>
				<?php
			}else{
				?>
				<div id='infobox_header' class='infobox_info'>
			<?php echo $s["recover_pass_moreinfo"]; ?>
		</div>
		<div class='form' id="recover_pass_step_1" style="display:block">
			<form id='step_1' action="./password_request.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["recover_pass_subtitle"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["recover_pass_client_email"]?> <span class='form_isrequired'>*</span></span><input  name="recover_pass_client_email" id="recover_pass_client_email" class='text' type='text'/>
					<span id="recover_pass_client_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["recover_pass_client_reemail"]?> <span class='form_isrequired'>*</span></span><input  name="recover_pass_client_reemail" id="recover_pass_client_reemail" class='text' type='text'/>
					<span id="recover_pass_client_reemail_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='button' value='<?php echo $s["send"]?>'/></div>
				</div>
			</form>
		</div>
			<?php
			}
		?>
	</div>
</div>
<?php
include("footer.php");
?>