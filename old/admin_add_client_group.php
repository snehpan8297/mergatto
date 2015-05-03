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
include_once("include/inbd.php");
$signup=0;

if(isset($_POST["id_client_group"])){
	$table="client_groups";
	$filter=array();
	$filter["id_client_group"] = array("operation"=>"=","value"=>$_POST["id_client_group"]);
	$data=array();
	$data["name"] = $_POST["name"];
	$data["base_price"] = $_POST["base_price"];
	$data["modificator_price"] = $_POST["modificator_price"];
	$signup=updateInBD($table,$filter,$data);
	header('location:./admin_list_groups.php');
	die();

} else if(isset($_POST["name"])){
	$table="client_groups";
	$data=array();
	$data["name"] = $_POST["name"];
	$data["base_price"] = $_POST["base_price"];
	$data["modificator_price"] = $_POST["modificator_price"];
	$signup=addInBD($table,$data);
	header('location:./admin_list_groups.php');
	die();

} else if(isset($_GET["id_client_group"])){
	$table="client_groups";
	$filter=array();
	$filter['id_client_group'] = array("operation"=>"=","value"=>$_GET["id_client_group"]);
	$client_group_tmp=getInBD($table,$filter);
}else{
	$client_group_tmp["name"]="";
	$client_group_tmp["base_price"]=0;
	$client_group_tmp["modificator_price"]=1;
}

$page = "admin";
include ("header.php");
?>
<script>
	$(document).ready(function (){
		$('#signup_send_step_1').click(function(){
			client_group_name = $('#name').val();
			error = false;
			var patron=/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ. ]*[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/;
			if(client_group_name=="" || !patron.test(client_group_name) || client_group_name.length<3 || client_group_name.length>40 ){
				$('#name').css('border','1px solid red');
				$('#name').css('color','red');
				if(client_group_name==""){
					$('#name_alert').html('<?php echo $s["obligatory_field"]; ?>');
				}else if(!patron.test(client_group_name)){
					$('#name_alert').html('<?php echo $s["invalid_format"]; ?>');
				}else if(client_group_name.length<3){
					$('#name_alert').html('<?php echo $s["field_too_short_3"]; ?>');
				}else if(client_group_name.length>20 ){
					$('#name_alert').html('<?php echo $s["field_too_long_email"]; ?>');
				}
				$('#name_alert').css('display','inline');
				$('#name').focus();
				error = true;
			}else{
				$('#name').css('border','1px solid green');
				$('#name').css('color','green');
				$('#name_alert').css('display','none');
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
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["add_client_group"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_client_group.php" method="post">
				<div class='form_entry'>
					<span class='label'><?php echo $s["name"];?> <span class='form_isrequired'>*</span></span><input  name="name" id="name" class='text' type='text' autocomplete="off" value='<?php echo $client_group_tmp["name"];?>'/>
					<span id="name_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'>Precio Base Importación<span class='form_isrequired'>*</span></span>
						<select name="base_price" id="base_price">
							<?php
							for($i=1;$i<=12;$i++){
								?>
								<option value='<?php echo $i;?>' <?php if($client_group_tmp["base_price"]==$i) echo "selected";?>><?php echo $i;?></option>
								<?php
							}
							?>
						</select>
					<span id="name_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'>Modificador Precio (Ej.: 2.5) <span class='form_isrequired'>*</span></span><input  name="modificator_price" id="modificator_price" class='text' type='text' value='<?php echo $client_group_tmp["modificator_price"];?>' autocomplete="off"/>
				</div>
				<?php
					if(isset($_GET["id_client_group"])){
					?>
					<input type='hidden' name='id_client_group' id='id_client_group' value='<?php echo $_GET["id_client_group"];?>'/>
					<?php
					}
				?>
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='submit' value='<?php echo $s["accept"]?>'/></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>