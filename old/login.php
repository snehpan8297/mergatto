<?php
//Lang confirmado
/*
	Login
	------
	Decripción
	
	Para poder acceder a la página siempre hay que estar dado de alta como cliente. Cuando alguien 
	está accediendo a cualquier página (excepto índex) será rediréccionado a esta página.
	
	En ella hay que introducir el número de cliente (son un código alfanumérico no superior a 10) y el CIF de cliente (alfanumérico no superior a 15).
	
	Una vez introducidos estos datos son comprobados en la base de datos y se comprueba que el usuario esté activado o no en la web (primer acceso).
	
	En caso de que no esté activado se le enviará a la página login_confirm en la cual le pedirá que confirme su correo electrónico para el envió
	de datos, algunos ya lo tendrán en la base de datos y otros no, en caso de que los tengan el campo ya les aparecerá escrito (pero se puede cambiar).
	
	Una vez hayan introducido un email valido les reenviará a la página de login con el usuario ya creado. Se creará una COOKIE que guarde el client_email.
*/
@session_start();
$page_title="login";
if(isset($_POST["login_client_email"])) {
	include_once("include/users.php");
	$login = loginemail($_POST["login_client_email"],$_POST["login_client_password"]);
	if($login==1){
		if($_POST["action"]=="new"){
			header("location:my_personaledit.php?action=new");
		}else{
			header("location:index.php?action=welcome");
		}
	}
} else if(isset($_SESSION['user_classics']['client_email'])) {
	$login = 1;
	header("location:index.php");
} else {
	$login = 2;
}
$page="login";
include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#payments_send_step1').click(function(){	
			client_email = $('#login_client_email').val();
			client_password = $('#login_client_password').val();
			error = false;
			if(client_password=="" || client_password.length>40){
				$('#login_client_password').css('border','1px solid red');
				$('#login_client_password').css('color','red');
				$('#login_client_password_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#login_client_password_alert').css('display','inline');
				$('#login_client_password').focus();
				error = true;
			}else{
				$('#login_client_password').css('border','1px solid green');
				$('#login_client_password').css('color','green');
				$('#login_client_password_alert').css('display','none');
			}
			if(client_email=="" || client_email.length>40){
				$('#login_client_email').css('border','1px solid red');
				$('#login_client_email').css('color','red');
				$('#login_client_email_alert').html('<?php echo $s["obligatory_field"]; ?>');
				$('#login_client_email_alert').css('display','inline');
				$('#login_client_email').focus();
				error = true;
			}else{
				var patron=/^[a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/;
				if(!patron.test(client_email)){
					$('#login_client_email').css('border','1px solid red');
					$('#login_client_email').css('color','red');
					$('#login_client_email_alert').html('<?php echo $s["format_not_valid"]; ?>');
					$('#login_client_email_alert').css('display','inline');
					$('#login_client_email').focus();
					error = true;
				}else{
					$('#login_client_email').css('border','1px solid green');
					$('#login_client_email').css('color','green');
					$('#login_client_email_alert').css('display','none');
				}
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
	
	<div class='contentbox'>
		<div id="section_header">
			<div class="inner">
			</div>
		</div>	
		<div style='width:49%;float:left'>
			<div class='form' id="login_step_1" style="display:block">
				<form id='step_1' action="./login.php" method="post">
					<div class='form_entry'>
						<span class='label' style='padding-top:0px;'><h3><?php echo $s["login_subtitle"]; ?></h3></span>
						<span class='label'><?php echo $s["login_subtitle_2"]; ?></span>
						<?php
						if($login==0){
							?>
							<span id="login_client_alert" class='form_entry_alert'><?php echo $s["login_error"]; ?></span>
							<?php
						}
						if($login==3){
							?>
							<span id="login_client_alert" class='form_entry_alert'><?php echo $s["login_error_inactive"]; ?></span>
							<?php
						}
						?>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["login_client_email"]?> <span class='form_isrequired'>*</span></span><input style='width:280px;' name="login_client_email" id="login_client_email" class='text' type='text' autocomplete="off"/>
						<span id="login_client_email_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["login_client_password"]?> <span class='form_isrequired'>*</span></span><input style='width:280px;' name="login_client_password" id="login_client_password" class='text' type='password' autocomplete="off"/>
						<span id="login_client_password_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><a href='./password_request.php' class='underline'><?php echo $s["forgot_password"];?></a></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
					</div>
					<div class='form_submit'>
						<input type='hidden' name='action' value='<?php if(isset($_GET["action"])&&($_GET["action"]=="new")){echo "new";} ?>'/>
						<div class='likeabutton' id="add_to_cart_button" style:'float:left;'><input type='submit' id="payments_send_step1" value='<?php echo $s["login_button"]?>'/></div>
					</div>
				</form>
			</div>
		</div>
		<div style='width:49%;float:right'>
			<div class='form_entry'>
				<span class='label' style='padding-top:0px;'><h3><?php echo $s["login_signup_subtitle"]; ?></h3></span>
				<span class='label'><?php echo $s["login_signup_subtitle_2"]; ?></span>
				<p style='text-align:center'><a href='./signup.php' class='btn btn-dark'><?php echo $s["signup"]; ?></a></p>
				
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
