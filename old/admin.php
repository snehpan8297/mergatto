<?php
/*
	Login ADMIN
	------
	Decripción
*/
@session_start();
unset($_SESSION['user_classics']);
if(isset($_SESSION['admin_classics'])){
	header("location:./admin_menu.php");
	die();
}
$page = "admin"; //"login";
include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#admin_send_step_1').click(function(){
			admin_username = $('#admin_username').val();
			admin_password = $('#admin_password').val();
			error = false;
			if(admin_password==""){
				$('#admin_password').css('border','1px solid red');
				$('#admin_password').css('color','red');
				$('#admin_password_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#admin_password_alert').css('display','inline');
				$('#admin_password').focus();
				error = true;
			}else{
				$('#admin_password').css('border','1px solid green');
				$('#admin_password').css('color','green');
				$('#admin_password_alert').css('display','none');
			}
			if(admin_username==""){
				$('#admin_username').css('border','1px solid red');
				$('#admin_username').css('color','red');
				$('#admin_username_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#admin_username_alert').css('display','inline');
				$('#admin_username').focus();
				error = true;
			}else{
				$('#admin_username').css('border','1px solid green');
				$('#admin_username').css('color','green');
				$('#admin_username_alert').css('display','none');
			}
			if(!error){
				$.ajax({
					type: "POST",
					url: "./admin/admin_check.php",
					data: "admin_username=" + admin_username + "&admin_password=" + admin_password,
					success:function(msg){
						if(msg=="true"){
							$('#admin_login_alert').html('');
							$('#step_1').submit();
						}else{
							$('#admin_login_alert').html('<?php echo $s["admin_login_error"]; ?>');
						}
					}
				});
			}
		});
		$('#step_1 input').bind('keyup', function(e) {
			if(e.keyCode==13){
				// Enter pressed... do anything here...
				$('#admin_send_step_1').click();
			}
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["admin_login_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_login_moreinfo"]; ?>
		</div>
		<div class='form' id="login_step_1" style="display:block">
			<form id='step_1' action="./admin.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["admin_login_subtitle"]; ?></h3></span>
					<span id="admin_login_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["admin_username"]?> <span class='form_isrequired'>*</span></span><input  name="admin_username" id="admin_username" class='text' type='text'/>
					<span id="admin_username_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["admin_password"]?> <span class='form_isrequired'>*</span></span><input name="admin_password" id="admin_password" class='text' type='password'/>
					<span id="admin_password_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><a id="admin_send_step_1" href="#"><span class='text'><?php echo $s["login_button"]?></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>