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
}

$add_payment=2;
$payment_type="new";

include_once("include/payments.php");
include_once("./include/users.php");
include_once("./include/front_settings.php");

if($_POST["client_code"]){
	if ($_POST["payment_type"]=="new"){
		$payment_tmp["client_code"] = $_POST["client_code"];
		$payment_tmp["id_order_final"] = $_POST["id_order_final"];
		$payment_tmp["client_code"] = $_POST["client_code"];
		$payment_tmp["created"] = date('Y-m-d H:i:s');
		$amount_tmp= explode(".",$_POST["amount"]);
		$payment_tmp["amount"] = $amount_tmp[0].$amount_tmp[1];
		$payment_tmp["num_clothes"] = $_POST["num_clothes"];
		$payment_tmp["is_payed"] = $_POST["is_payed"];
		if(!isset($_POST["payment_code"])|| $_POST["code"]==""){
			$payment_tmp["payment_code"] = substr(md5($_POST["client_code"].$payment_tmp["created"]),0,10);
		}else{
			$payment_tmp["payment_code"] = $_POST["payment_code"];
		}
		$add_payment=addPayment($payment_tmp);
		
		if($add_payment!=0){
			include("./functions/email_payment_request.php");
		}
	}else{
		$payment_tmp["id_payment"] = $_POST["id_payment"];
		$payment_tmp["client_code"] = $_POST["client_code"];
		$payment_tmp["id_order_final"] = $_POST["id_order_final"];
		$payment_tmp["client_code"] = $_POST["client_code"];
		$payment_tmp["created"] = date('Y-m-d H:i:s');
		$amount_tmp=explode(".",$_POST["amount"]);
		$payment_tmp["amount"] = $amount_tmp[0].$amount_tmp[1];
		$payment_tmp["num_clothes"] = $_POST["num_clothes"];
		$payment_tmp["is_payed"] = $_POST["is_payed"];
		if(!isset($_POST["payment_code"])){
			$payment_tmp["payment_code"] = md5($_POST["client_code"].$payment_tmp["created"]);
		}else{
			$payment_tmp["payment_code"] = $_POST["payment_code"];
		}
		$add_payment=updatepayment($payment_tmp);
		if($add_payment!=0){
			include("./functions/email_payment_request.php");
			header('location:./admin_list_payments.php');
		}
	}
}
if($_GET["id_payment"]){
	$payment_tmp['code']=$_GET["id_payment"];
	$payment_tmp=paymentData($payment_tmp['code']);
	$payment_tmp["amount_string"] = "";
	if(strlen($payment_tmp["amount"])>2){
		$payment_tmp["amount_string"]=substr($payment_tmp["amount"], 0, strlen($payment_tmp["amount"])-2 ).".".substr($payment_tmp["amount"], strlen($payment_tmp["amount"])-2, strlen($payment_tmp["amount"]) );
	}else{
		if(strlen($payment_tmp["amount"])==2){
			$payment_tmp["amount_string"]="0.".$payment_tmp["amount"];
		}else{
			$payment_tmp["amount_string"]="0.0".$payment_tmp["amount"];
		}
	}
	$payment_type="edit";
}

$page = "add_payment";
include ("header.php");
?>
<script>
	$(document).ready(function (){
		$('#send_step_1').click(function(){
			id_order_final = $('#id_order_final').val();
			client_code = $('#client_code').val();
			amount = $('#amount').val();
			num_clothes = $('#num_clothes').val();
			error = false;
			var patron=/^[0-9]*$/;
			if (num_clothes=="" || !patron.test(num_clothes)){
				$('#num_clothes').css('border','1px solid red');
				$('#num_clothes').css('color','red');
				if(num_clothes==""){
					$('#num_clothes_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(num_clothes)){
					$('#num_clothes_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}
				$('#num_clothes_alert').css('display','inline');
				$('#num_clothes').focus();
				error = true;
			}else{
				$('#num_clothes').css('border','1px solid green');
				$('#num_clothes').css('color','green');
				$('#num_clothes_alert').css('display','none');
			}
			var patron=/^[0-9][0-9]*[.][0-9][0-9]$/;
			if (amount=="" || !patron.test(amount)){
				$('#amount').css('border','1px solid red');
				$('#amount').css('color','red');
				$('#amount_currency').css('color','red');
				if(amount==""){
					$('#amount_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(amount)){
					$('#amount_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}
				$('#amount_alert').css('display','inline');
				$('#amount').focus();
				error = true;
			}else{
				$('#amount').css('border','1px solid green');
				$('#amount').css('color','green');
				$('#amount_currency').css('color','green');
				$('#amount_alert').css('display','none');
			}
			var patron=/^[0-9]*$/;
			if (client_code=="" || client_code.length>10 || !patron.test(client_code)){
				$('#client_code').css('border','1px solid red');
				$('#client_code').css('color','red');
				if(client_code==""){
					$('#client_code_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(client_code.length>10){
					$('#client_code_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}else if(!patron.test(client_code)){
					$('#client_code_alert').html('<?php echo $s["format_not_valid"]; ?>');
				}
				$('#client_code_alert').css('display','inline');
				$('#client_code').focus();
				error = true;
			}else{
				$('#client_code').css('border','1px solid green');
				$('#client_code').css('color','green');
				$('#client_code_alert').css('display','none');
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
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["add_payment"]; ?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
			if($add_payment==1){
				?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["add_payment_success"];?>
				</div>
				<?php
			}else{
				?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["add_payment_moreinfo"];?>
		</div>
		<div class='form' id="step_1" style="display:block">
			<form id='step_1' action="./admin_add_payment.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["add_payment_subtitle"]; ?></h3></span>
					<?php
						if($add_payment==0){
							?>
							<span id="payment_alert" class='form_entry_alert'><p><?php echo $s["payment_error"]; ?></p></span>
							<?php
						}
					?>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["id_order_final"];?><span class='form_isrequired'>*</span></span><input  name="id_order_final" id="id_order_final" class='text' type='text' value='<?php echo $payment_tmp["id_order_final"]; ?>'/>
					<span id="id_order_final_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["client_code"]?> <span class='form_isrequired'>*</span></span><input  name="client_code" id="client_code" class='text' type='text' value='<?php echo $payment_tmp["client_code"]; ?>'/>
					<span id="client_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["amount"]?> <span class='form_isrequired'>*</span></span><input  name="amount" id="amount" class='text' type='text' value='<?php echo $payment_tmp["amount_string"]; ?>'/> <span id='amount_currency'>€</span>
					<span id="amount_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["num_clothes"]?> <span class='form_isrequired'>*</span></span><input name="num_clothes" id="num_clothes" class='text' type='text' value='<?php echo $payment_tmp["num_clothes"]; ?>'/>
					<span id="num_clothes_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["is_payed"]?> <span class='form_isrequired'>*</span></span>
					<input type="radio" name="is_payed" id="is_payed" <?php if ($payment_tmp["is_payed"]==1) { echo "checked='checked'";} ?>value="1">
					<?php echo $s["yes"];?>
					<input type="radio" name="is_payed" id="is_payed"  <?php if(!isset($payment_tmp["is_payed"]) || $payment_tmp["is_payed"]==0){ echo "checked='checked'";} ?> value='0'>
					<?php echo $s["no"];?>
					<span id="is_payed" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payment_code"]?></span><input name="payment_code" id="payment_code" class='text' type='text' value='<?php echo $payment_tmp["payment_code"]; ?>'/>
					<span id="payment_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"]; ?></span>
				</div>
				<input type='hidden' name='payment_type' value='<?php echo $payment_type; ?>'/>
				<input type='hidden' name='id_payment' value='<?php echo $_GET["id_payment"]; ?>'/>
				<div class='form_submit'>
					<div class='likeabutton'><input id="send_step_1" type='submit' value='<?php echo $s["accept"]?>'/></div>
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