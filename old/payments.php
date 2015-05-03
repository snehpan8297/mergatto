<?php
//Lang confirm
@session_start();

$page="payments";
include("header.php");
?>
<script>
	$(document).ready(function (){
		$('#payments_send_step1').click(function(){
			client_code = $('#client_code').val();
			id_order_final = $('#id_order_final').val();
			payment_code = $('#payment_code').val();
			error = false;
			if (payment_code==""){
				$('#payment_code').css('border','1px solid red');
				$('#payment_code').css('color','red');
				if(payment_code==""){
					$('#payment_code_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}
				$('#payment_code_alert').css('display','inline');
				$('#payment_code').focus();
				error = true;
			}else{
				$('#payment_code').css('border','1px solid green');
				$('#payment_code').css('color','green');
				$('#payment_code_alert').css('display','none');
			}
			var patron=/^[0-9]*$/;
			if (id_order_final=="" || id_order_final.length>10 || !patron.test(id_order_final)){
				$('#id_order_final').css('border','1px solid red');
				$('#id_order_final').css('color','red');
				if(id_order_final==""){
					$('#id_order_final_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(id_order_final.length>10){
					$('#id_order_final_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(!patron.test(id_order_final)){
					$('#id_order_final_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}
				$('#id_order_final_alert').css('display','inline');
				$('#id_order_final').focus();
				error = true;
			}else{
				$('#id_order_final').css('border','1px solid green');
				$('#id_order_final').css('color','green');
				$('#id_order_final_alert').css('display','none');
			}
			var patron=/^[0-9]*$/;
			if (client_code=="" || client_code.length>10 || !patron.test(client_code) || client_code!='<?php echo $userdata["client_code"]; ?>'){
				$('#client_code').css('border','1px solid red');
				$('#client_code').css('color','red');
				if(client_code==""){
					$('#client_code_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_code.length>10){
					$('#client_code_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(!patron.test(client_code)){
					$('#client_code_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(client_code!='<?php echo $userdata["client_code"]; ?>'){
					$('#client_code_alert').html('<?php echo $s["alert_payment_other_user"]; ?>');
				}
				$('#client_code_alert').css('display','inline');
				$('#client_code').focus();
				error = true;
			}else{
				$('#client_code').css('border','1px solid green');
				$('#client_code').css('color','green');
				$('#client_code_alert').css('display','none');
			}
			if(!error){
				$('#step_1').submit();
				return true;
			}else{
				return false;
			}
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["payments_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["payments_step_1"]; ?>
		</div>
		<div class='form' id="payment_step_1">
			<form id='step_1' action="./payment_confirm.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["payments_subtitle"]; ?></h3></span>
					<span id="payments_alert" class='form_entry_alert'><?php if(isset($_GET['error'])){ echo $s["payments_error"];} ?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["client_code"]?> <span class='form_isrequired'>*</span></span><input  name="client_code" id="client_code" class='text' type='text' value='<?php echo $_GET["client_code"]; ?>'/>
					<span id="client_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["id_order_final"]?> <span class='form_isrequired'>*</span></span><input name="id_order_final" id="id_order_final" class='text' type='text' value='<?php echo $_GET["order"]; ?>'/>
					<span id="id_order_final_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payment_code"]?> <span class='form_isrequired'>*</span></span><input name="payment_code" id="payment_code" class='text' type='text' value='<?php echo $_GET["code"]; ?>'/>
					<span id="payment_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
					<input type='hidden' name='created' id='created' value=''/>
					<input type='hidden' name='amount' id='amount' value=''/>
					<input type='hidden' name='num_clothes' id='num_clothes' value=''/>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><input id="payments_send_step1" type='submit' value='<?php echo $s["next"]?>'/></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>