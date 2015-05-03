<?php
//Lang confirmado
$interface_options["cart_menu_hidden"]=1;

@session_start();
$page="change_pass";
include("header.php");
include_once('./include/users.php');

$changepass=2;
$success=false;
if(isset($_POST["change_pass_client_oldpassword"])){
	$user_tmp["id_client"] = $_SESSION['user_classics']['id_client'];
	$user_tmp=userData($user_tmp);
	if(md5($_POST["change_pass_client_oldpassword"])==$user_tmp['password']){
		$user_tmp["password"] = md5($_POST["change_pass_client_password"]);
		updateUser($user_tmp);
		$success=true;
	}else{
		$changepass=0;
	}
}
?>
<script>
	$(document).ready(function (){
		$('#add_to_cart_button').click(function(){
			client_oldpassword = $('#change_pass_client_oldpassword').val();
			client_password = $('#change_pass_client_password').val();
			client_repassword = $('#change_pass_client_repassword').val();
			error = false;
			if((client_repassword=="") || (client_repassword!=client_password)){
				$('#change_pass_client_repassword').css('border','1px solid red');
				$('#change_pass_client_repassword').css('color','red');
				if(client_repassword==""){
					$('#change_pass_client_repassword_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_repassword!=client_password){
					$('#change_pass_client_repassword_alert').html('<?php echo $s["pass_not_match"]; ?>');
				}
				$('#change_pass_client_repassword_alert').css('display','inline');
				$('#change_pass_client_repassword').focus();
				error = true;
			}else{
				$('#change_pass_client_repassword').css('border','1px solid green');
				$('#change_pass_client_repassword').css('color','green');
				$('#change_pass_client_repassword_alert').css('display','none');
			}
			if(client_password=="" || client_password.length<5 || client_password.length>20 ){

				$('#change_pass_client_password').css('border','1px solid red');
				$('#change_pass_client_password').css('color','red');
				if(client_password==""){
					$('#change_pass_client_password_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_password.length<5){
					$('#change_pass_client_password_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20 ){
					$('#change_pass_client_password_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#change_pass_client_password_alert').css('display','inline');
				$('#change_pass_client_password').focus();
				error = true;
			}else{
				$('#change_pass_client_password').css('border','1px solid green');
				$('#change_pass_client_password').css('color','green');
				$('#change_pass_client_password_alert').css('display','none');
			}
			if(client_oldpassword=="" || client_oldpassword.length<5 || client_oldpassword.length>20 ){
				$('#change_pass_client_oldpassword').css('border','1px solid red');
				$('#change_pass_client_oldpassword').css('color','red');
				if(client_oldpassword==""){
					$('#change_pass_client_oldpassword_alert').html('<?php echo $s["obligatory_field"]; ?>');			
				}else if(client_oldpassword.length<5){
					$('#change_pass_client_oldpassword_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_oldpassword.length>20 ){
					$('#change_pass_client_oldpassword_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#change_pass_client_oldpassword_alert').css('display','inline');
				$('#change_pass_client_oldpassword').focus();
				error = true;
			}else{
				$('#change_pass_client_oldpassword').css('border','1px solid green');
				$('#change_pass_client_oldpassword').css('color','green');
				$('#change_pass_client_oldpassword_alert').css('display','none');
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
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <a href='' class='important'><?php echo $s["change_pass_title"]; ?></a></div>
	</div>
		<div class='contentbox'>
		<?php
			if($success){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["change_pass_success"]; ?>
				</div>
				<?php
			}else{
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["change_pass_moreinfo"]; ?>
		</div>
		<div class='form' id="change_pass_step_1" style="display:block">
			<form id='step_1' action="./change_password.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["change_pass_subtitle"]; ?></h3></span>
					<span class='form_entry_alert'>
						<?php
							if($changepass==0){
								echo "La contraseña introducida no es válida.";
							}
						?>
					</span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["change_pass_client_oldpassword"]?> <span class='form_isrequired'>*</span></span><input  name="change_pass_client_oldpassword" id="change_pass_client_oldpassword" class='text' type='password'/>
					<span id="change_pass_client_oldpassword_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["change_pass_client_password"]?> <span class='form_isrequired'>*</span></span><input  name="change_pass_client_password" id="change_pass_client_password" class='text' type='password'/>
					<span id="change_pass_client_password_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["change_pass_client_repassword"]?> <span class='form_isrequired'>*</span></span><input  name="change_pass_client_repassword" id="change_pass_client_repassword" class='text' type='password'/>
					<span id="change_pass_client_repassword_alert" class='form_entry_alert'></span>
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
		<?php
	}
	?>
	
		
		
	</div>
</div>
<?php
include("footer.php");
?>