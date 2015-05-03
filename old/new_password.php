<?php
//Lang confirmado
@session_start();

include_once('./include/users.php');

$recoverpass=2;
$success=false;
if(isset($_GET["code"])) {
	$is_a_code=isARecoverCode($_GET["code"]);
}
if(isset($_POST["code"])) {
	if(isARecoverCode($_POST["code"])){
		newRecoverPassword($_POST["code"],$_POST["recover_pass_client_password"]);
		$success=true;
	}
}

$page="recover_pass";
include("header.php");

?>
<script>
	$(document).ready(function (){
		$('#step_1').submit(function(){	
			client_password = $('#recover_pass_client_password').val();
			client_repassword = $('#recover_pass_client_repassword').val();
			error = false;
			if((client_repassword=="") || (client_repassword!=client_password)){
				$('#recover_pass_client_repassword').css('border','1px solid red');
				$('#recover_pass_client_repassword').css('color','red');
				if(client_repassword==""){
					$('#recover_pass_client_repassword_alert').html('<?php echo $s["obligatory_field"]; ?>');			
				}else if(client_repassword!=client_password){
					$('#recover_pass_client_repassword_alert').html('<?php echo $s["pass_not_match"]; ?>');
				}
				$('#recover_pass_client_repassword_alert').css('display','inline');
				$('#recover_pass_client_repassword').focus();
				error = true;
			}else{
				$('#recover_pass_client_repassword').css('border','1px solid green');
				$('#recover_pass_client_repassword').css('color','green');
				$('#recover_pass_client_repassword_alert').css('display','none');
			}
			if(client_password=="" || client_password.length<5 || client_password.length>20 ){

				$('#recover_pass_client_password').css('border','1px solid red');
				$('#recover_pass_client_password').css('color','red');
				if(client_password==""){
					$('#recover_pass_client_password_alert').html('<?php echo $s["obligatory_field"]; ?>');			
				}else if(client_password.length<5){
					$('#recover_pass_client_password_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20 ){
					$('#recover_pass_client_password_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#recover_pass_client_password_alert').css('display','inline');
				$('#recover_pass_client_password').focus();
				error = true;
			}else{
				$('#recover_pass_client_password').css('border','1px solid green');
				$('#recover_pass_client_password').css('color','green');
				$('#recover_pass_client_password_alert').css('display','none');
			}
			if(!error){
				return true;
			}
			return false;
		});
		
	});
</script>



<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["recover_pass_change_title"]; ?></a></div>
	</div>
		<div class='contentbox'>
		<?php
			if($success){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["recover_pass_success"]; ?>
				</div>
				<?php
			}else{
		?>
	<?php
		if($is_a_code){
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["recover_pass_ok"]; ?>
		</div>
		<div class='form' id="recover_pass_step_1" style="display:block">
			<form id='step_1' action="./new_password.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["change_pass_subtitle"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["recover_pass_client_password"]?> <span class='form_isrequired'>*</span></span><input  name="recover_pass_client_password" id="recover_pass_client_password" class='text' type='password'/>
					<span id="recover_pass_client_password_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["recover_pass_client_repassword"]?> <span class='form_isrequired'>*</span></span><input  name="recover_pass_client_repassword" id="recover_pass_client_repassword" class='text' type='password'/>
					<span id="recover_pass_client_repassword_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<input type='hidden' name='code' value='<?php echo $_GET["code"]; ?>' />
				<div class='form_submit'>
					<div class='likeabutton'><input id="recover_pass_send_step_1" type='submit' value='<?php echo $s["next"]?>'/></div>
				</div>
			</form>
		</div>		
		<?php
	}else{
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["recover_pass_expired"]; ?>
		</div>
		<?php
	}
	}
	?>
	
		
		
	</div>
</div>
<?php
include("footer.php");
?>