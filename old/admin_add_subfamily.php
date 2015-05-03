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
include_once("include/subfamily.php");


if(isset($_POST["id_subfamily"])){
	$subfamily_tmp["id_subfamily"] = $_POST["id_subfamily"];
	$subfamily_tmp["name_es"] = $_POST["name_es"];
	$subfamily_tmp["name_en"] = $_POST["name_en"];
	$subfamily_tmp["id_family"] = $_POST["id_family"];
	updateSubfamily($subfamily_tmp);
	header('location:./admin_list_subfamily.php');
}else if(isset($_POST["name_es"])){
	$subfamily_tmp["name_es"] = $_POST["name_es"];
	$subfamily_tmp["name_en"] = $_POST["name_en"];
	$subfamily_tmp["id_family"] = $_POST["id_family"];
	addSubfamily($subfamily_tmp);
	header('location:./admin_list_subfamily.php');
} else if(isset($_GET["id_subfamily"])){
	$subfamily_tmp["id_subfamily"]=$_GET["id_subfamily"];
	$subfamily_tmp=getSubfamily($subfamily_tmp);
} else {
	$subfamily_tmp["name_es"] = "";
	$subfamily_tmp["name_en"] = "";
	$subfamily_tmp["id_family"] = "";
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
		<h3>Subfamilia</h3>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_subfamily.php" method="post">
				<div class='form_entry'>
					<span class='label'>Familia a la pertenece</span>
					<select name='id_family' id='id_family'>
						<?php
						for ($i=19;$i<64;$i++){
							if(isset($s["family_".$i])){
							?>
						<option value="<?php echo $i;?>"><?php echo $s["family_".$i];?></option>
							
							<?php		
							}
						
						}
						?>
					</select>
				</div>
				<div class='form_entry'>
					<span class='label'>Nombre Castellano</span>
					<input  name="name_es" id="name_es" class='text' type='text' value='<?php echo $subfamily_tmp["name_es"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Nombre Inglés</span>
					<input  name="name_en" id="name_en" class='text' type='text' value='<?php echo $subfamily_tmp["name_en"]; ?>' autocomplete="off"/>
				</div>
				<?php
				if(isset($_GET["id_subfamily"])){
					?>
					<input  name="id_subfamily" id="id_subfamily" type='hidden' value='<?php echo $subfamily_tmp["id_subfamily"]; ?>'/>

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