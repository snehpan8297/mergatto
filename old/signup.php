<?php
@session_start();
$page_title="registrarse";
$signup=-1;
if(isset($_POST["signup_client_email"])) {
	include_once("include/users.php");
	$user["email"] = $_POST["signup_client_email"];
	//$user["remail"] = $_POST["signup_client_reemail"];
	$user["password"] = $_POST["signup_client_password"];
	$user["repassword"] = $_POST["signup_client_repassword"];
	
	if (filter_var($_POST["signup_client_email"], FILTER_VALIDATE_EMAIL)) {
		$signup = accessRequest($user);		
	}else{
		$signup=0;
	}
	if($signup == 2) {
		loginEmail($user["email"],$user["password"]);
		header("location:my_personaledit.php");
		die();
	}
}
$page = "signup";
include("header.php");
?>
<script>
	$(document).ready(function (){
		var code = null;
		$('#content').keypress(function(e){
			code= (e.keyCode ? e.keyCode : e.which);
			if (code == 13) {
				$('#signup_button').click();
			}
		});
		$('#signup_button').click(function(){
			client_email = $('#signup_client_email').val();
			client_reemail = $('#signup_client_reemail').val();
			client_password = $('#signup_client_password').val();
			client_repassword = $('#signup_client_repassword').val();
			recaptcha_response_field = $('#recaptcha_response_field').val();
			error = false;
			if(recaptcha_response_field==""){
						$('#signup_client_recaptcha_alert').html('<?php echo $s["captcha_empty"];?>');
				$('#signup_client_recaptcha_alert').css('display','inline');
				error = true;
			}else{
				$.ajax({
					async:false,
					type: "POST",
					dataType: 'json',
					url: "./js/verify.php",
					data: {
						recaptcha_challenge_field:$('#recaptcha_challenge_field').val(),
						recaptcha_response_field:$('#recaptcha_response_field').val()
					},
					error:function(response) {
						error = true;
						$('#signup_client_recaptcha_alert').html('<?php echo $s["captcha_wrong"];?>');
						$('#signup_client_recaptcha_alert').css('display','inline');
					},
					success: function(response) {
						if(response.result){
						} else {
							$('#signup_client_recaptcha_alert').html('<?php echo $s["captcha_wrong"];?>');
							$('#signup_client_recaptcha_alert').css('display','inline');
							error = true;
						}
					}
				});
			}
			if((client_repassword=="") || (client_repassword!=client_password)){
				$('#signup_client_repassword').css('border','1px solid red');
				$('#signup_client_repassword').css('color','red');
				if(client_repassword==""){
					$('#signup_client_repassword_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_repassword!=client_password){
					$('#signup_client_repassword_alert').html('<?php echo $s["pass_not_match"]; ?>');
				}
				$('#signup_client_repassword_alert').css('display','inline');
				$('#signup_client_repassword').focus();
				error = true;
			}else{
				$('#signup_client_repassword').css('border','1px solid green');
				$('#signup_client_repassword').css('color','green');
				$('#signup_client_repassword_alert').css('display','none');
			}
			if(client_password=="" || client_password.length<5 || client_password.length>20 ){
				$('#signup_client_password').css('border','1px solid red');
				$('#signup_client_password').css('color','red');
				if(client_password==""){
					$('#signup_client_password_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_password.length<5){
					$('#signup_client_password_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20 ){
					$('#signup_client_password_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#signup_client_password_alert').css('display','inline');
				$('#signup_client_password').focus();
				error = true;
			}else{
				$('#signup_client_password').css('border','1px solid green');
				$('#signup_client_password').css('color','green');
				$('#signup_client_password_alert').css('display','none');
			}
			var patron=/^[a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/;
			if(client_email=="" || client_email.length>40 || !patron.test(client_email)){
				$('#signup_client_email').css('border','1px solid red');
				$('#signup_client_email').css('color','red');
				if(client_email==""){
					$('#signup_client_email_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_email)){
					$('#signup_client_email_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(client_email.length>40){
					$('#signup_client_email_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#signup_client_email_alert').css('display','inline');
				$('#signup_client_email').focus();
				error = true;
			}else{
				$('#signup_client_email').css('border','1px solid green');
				$('#signup_client_email').css('color','green');
				$('#signup_client_email_alert').css('display','none');
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
	<div id="section_header">
		<div class="inner">
		</div>
	</div>	
		
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["signup_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["signup_moreinfo"]; ?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./signup.php" method="post">
				<div class='form_entry'>
				<?php
					if($signup==0){
						?>
						<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["signup_error_1"];?></p></span>
						<?php
					}else if($signup==1){
						?>
						<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["signup_error_2"];?></p></span>
						<?php
					}else if($signup==3){
						?>
						<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["signup_error_3"];?></p></span>
						<?php
					}
				?>
				</div>
				<div class='form_entry'>
					<span class='title'><h3><?php echo $s["signup_access_data"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_email"]?> <span class='form_isrequired'>*</span></span>
					<input  name="signup_client_email" id="signup_client_email" class='text' type='text'/>
					<span id="signup_client_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_password"]?> <span class='form_isrequired'>*</span></span>
					<input name="signup_client_password" id="signup_client_password" class='text' type='password'></input>
					<span id="signup_client_password_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["signup_client_repassword"]?> <span class='form_isrequired'>*</span></span><input name="signup_client_repassword" id="signup_client_repassword" class='text' type='password' />
					<span id="signup_client_repassword_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["captcha_label"]?> <span class='form_isrequired'>*</span></span>
				<?php
					require_once('./include/recaptchalib.php');
					$publickey = "6Lcon_ASAAAAAOj4cvYcUvQAXFIAZ-jdFJT1NRjB";
					$error_captcha=null;
					echo recaptcha_get_html($publickey,$error_captcha);
					?>
				</div>
				<div class='form_entry'>
					<span id="signup_client_recaptcha_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton' id="add_to_cart_button" style='float:left;'><a id="signup_button" href="javascript:void(0)"><span class='text'><span class='left_decoration'></span><?php echo $s["signup_button"]?></span><span class='right_decoration'></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>