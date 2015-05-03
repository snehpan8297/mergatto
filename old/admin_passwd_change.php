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
    die();
}
include_once("include/users.php");

function rand_string( $length ) {
	$chars = "abcdef0123456789";
	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}
$signup=2;
$md5 = false;
if(isset($_POST["passwd"])){
	$filename = "./admin/.temp";
	if(is_readable($filename) && is_writable($filename)) {
		$fp = fopen($filename,"w");
		$line = fread($fp,1024);
		if(trim($line) == "") {
			$md5 = true;
		} else {
			$md5 = substr_compare(trim($line),md5($_POST["passwd"]),6,33);
		}
		if($_POST["passwd"] == $_POST["repasswd"]) {
			if($md5) {
				$user_tmp = $_POST["passwd"];
				$line = rand_string(6);
				$line .= md5($_POST["passwd"]);
				$line .= rand_string(mt_rand(5,30));
				fwrite($fp,$line);
				$signup = 1;
			} else {
				$signup = 5;
			}
		} else {
			$signup = 4;
		}
		fclose($fp);
	}
} else {
	$signup = 3;
}
$page = "admin";
include ("header.php");
?>
<script>
	$(document).ready(function (){
		$('#signup_send_step_1').click(function(){
			client_oldpassword = $('#oldpasswd').val();
			client_password = $('#passwd').val();
			client_repassword = $('#repasswd').val();
			error = false;

			if(client_password=="" || client_password.length<5 || client_password.length>20){
				$('#passwd').css('border','1px solid red');
				$('#passwd').css('color','red');
				if(client_password==""){
					$('#passwd_alert').html('<?php echo $s["obligatory_field"]; ?>');
				} else if(client_password.length<5){
					$('#passwd_alert').html('<?php echo $s["field_too_short"]; ?>');
				} else if(client_password.length>20 ){
					$('#passwd_alert').html('<?php echo $s["field_too_long"]; ?>');
				}
				$('#passwd_alert').css('display','inline');
				$('#passwd').focus();
				error = true;
			}else{
				$('#passwd').css('border','1px solid green');
				$('#passwd').css('color','green');
				$('#passwd_alert').css('display','none');
			}
			
			if(client_oldpassword==""){
				$('#oldpasswd').css('border','1px solid red');
				$('#oldpasswd').css('color','red');
				if(client_oldpassword=="" ){
					$('#oldpasswd_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}
				$('#oldpasswd_alert').css('display','inline');
				$('#oldpasswd').focus();
				error = true;
			}else{
				$('#oldpasswd').css('border','1px solid green');
				$('#oldpasswd').css('color','green');
				$('#oldpasswd_alert').css('display','none');
			}
			
			if(client_password!=client_repassword){
				$('#repasswd').css('border','1px solid red');
				$('#repasswd').css('color','red');
				if(client_repassword!=client_password ){
					$('#repasswd_alert').html('<?php echo $s["pass_not_match"]; ?>');
				}
				$('#repasswd_alert').css('display','inline');
				$('#repasswd').focus();
				error = true;
			}else{
				$('#repasswd').css('border','1px solid green');
				$('#repasswd').css('color','green');
				$('#repasswd_alert').css('display','none');
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
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_passwd_change"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
			if($signup==1){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["admin_passwd_change_success"];?>
				</div>
				<?php
			}else{
		?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_passwd_change_moreinfo"];?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_passwd_change.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["admin_passwd_change_subtitle"]; ?></h3></span>
					<?php
						if($signup==4){
							?>
							<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["admin_passwd_change_error_repasswd"]; ?></p></span>
							<?php
						}
						if($signup==5){
							?>
							<span id="login_client_alert" class='form_entry_alert'><p><?php echo $s["admin_passwd_change_error_oldpasswd"]; ?></p></span>
							<?php
						}
					?>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["old_password"];?> <span class='form_isrequired'>*</span></span><input  name="oldpasswd" id="oldpasswd" class='text' type='password' value=''/>
					<span id="oldpasswd_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["newpassword"];?> <span class='form_isrequired'>*</span></span><input  name="passwd" id="passwd" class='text' type='password' value=''/>
					<span id="passwd_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["repassword"];?> <span class='form_isrequired'>*</span></span><input  name="repasswd" id="repasswd" class='text' type='password' value=''/>
					<span id="repasswd_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='button' value='<?php echo $s["accept"]?>'/></div>
				</div>
			</form>
		</div>
		<?php
			}
		?>
	</div>
</div>
<?php
include ("footer.php");
?>