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
include_once("include/promocodes.php");
include_once("include/inbd.php");


if(isset($_POST["id_promo_code"])){
	$promocode_tmp["id_promo_code"] = $_POST["id_promo_code"];
	$promocode_tmp["code"] = $_POST["code"];
	$promocode_tmp["comment"] = $_POST["comment"];
	$promocode_tmp["codes_left"] = $_POST["codes_left"];
  $promocode_tmp["amount"] = $_POST["amount"];
  $promocode_tmp["creation"] = strtotime($_POST["creation"]);
	updatePromoCode($promocode_tmp);
	header('location:./admin_list_promo_codes.php');
}else if(isset($_POST["code"])){
	$promocode_tmp["code"] = $_POST["code"];
	$promocode_tmp["comment"] = $_POST["comment"];
	$promocode_tmp["codes_left"] = $_POST["codes_left"];
	$promocode_tmp["amount"] = $_POST["amount"];
  $promocode_tmp["creation"] = strtotime(date("Y-m-d"));
	addPromoCode($promocode_tmp);
	header('location:./admin_list_promo_codes.php');
} else if(isset($_GET["id_promo_code"])){

	$promocode_tmp["id_promo_code"]=$_GET["id_promo_code"];
  $table="promo_codes";
  $filter=array();
  $filter["id_promo_code"]=array("operation"=>"=","value"=>$_GET["id_promo_code"]);
	$promocode_tmp=getInBD($table,$filter);
} else {
	$promocode_tmp["code"] = "";
	$promocode_tmp["comment"] = "";
	$promocode_tmp["codes_left"] = "";
	$promocode_tmp["amount"] = "0.00";
}
$page = "admin";
include ("header.php");
?>
<div id='content'>
	<div id='page_header'>
		<div id='page_navigator'>
			<div class='inner'>
				<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["add_user"]
				?></a>
			</div>
		</div>
	</div>
	<div class='contentbox'>
		<h3>Códigos Promocionales</h3>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_promo_code.php" method="post">
				<?php
				if (isset($_GET["id_promo_code"])){
					?>
          <input type='hidden' name="id_promo_code" id='id_promo_code' value='<?php echo $promocode_tmp["id_promo_code"];?>'/><?php
				}
				?>
				<div class='form_entry'>
					<span class='label'>Código</span>
					<input  name="code" id="code" class='text' type='text' value='<?php echo $promocode_tmp["code"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Número de códigos para usar</span>
					<input  name="codes_left" id="codes_left" class='text' type='text' value='<?php echo $promocode_tmp["codes_left"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Comentario</span>
					<input class='text' name='comment' id='comment' value='<?php echo $promocode_tmp["comment"]; ?>'/>
				</div>
				<div class='form_entry'>
					<span class='label'>Descuento en € con punto</span>
					<input class='text' name='amount' id='amount' value='<?php echo $promocode_tmp["amount"]; ?>'/>
				</div>
        <?php
        if (isset($_GET["id_promo_code"])){
					?>
          <div class='form_entry'>
            <span class='label'>Fecha</span>
            <input class='text' name='creation' id='creation' value='<?php echo date("Y-m-d",$promocode_tmp["creation"]); ?>'/>
          </div>
      	   <?php
        }
				?>
				<div class='form_submit'>
					<input class='btn btn-black' type='submit' value='<?php echo $s["accept"]?>'/>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>
