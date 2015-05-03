<?php
//Lang Revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}
$page = "admin";
include_once("include/config.php");

if (isset($_POST["welcome"])) {
	$config["welcome"] = $_POST["welcome"];
	$config["welcome_img"] = $_POST["welcome_img"];
	$config["welcome_text_es"] = $_POST["welcome_text_es"];
	$config["welcome_text_en"] = $_POST["welcome_text_en"];
	setConfig($config);
}
include_once ("include/users.php");
$page = "general_config";
include ("header.php");
//Llamar a la BD pero en realidad ya tienes esos datos…
$config = getConfig();
$system_tmp["welcome"] = $config["welcome"];
$system_tmp["welcome_img"] = $config["welcome_img"];
$system_tmp["welcome_text_es"] = $config["welcome_text_es"];
$system_tmp["welcome_text_en"] = $config["welcome_text_en"];

?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["cover_config"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<form id='step_1' action="./admin_cover_config.php" method="post">
		<div class='form_entry'>
			<div style="overflow:auto">
				<div style='width:40%;float:left'>
					Usar ventana emergente
					<select name='welcome'>
						<option value='1' <?php if($system_tmp["welcome"]==1){echo "selected";}?>>sí</option>
						<option value='0' <?php if($system_tmp["welcome"]==0){echo "selected";}?>>no</option>
					</select>
				</div>
				<div style='width:40%;float:right'>
					Tipo de ventana
					<select name='welcome_img'>
						<option value='1' <?php if($system_tmp["welcome_img"]==1){echo "selected";}?>>Imágenes</option>
						<option value='0' <?php if($system_tmp["welcome_img"]==0){echo "selected";}?>>Texto</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class='form_entry'>
			<span class='label'><h4>Castellano</h4></span>
		</div>
		
		<div class='form_entry' style='height:50px'>
			<img width="50px" style='float:left;margin-right:10px' src='./resources/welcome/es.jpg'/><span class='label'><a href='./admin_add_image_cover.php?lang=es' class='important underline'><?php echo $s["add_new_cover"];?> Castellano</a></span>
		</div>
		<div class='form_entry'>
			<textarea name='welcome_text_es'><?php echo $config["welcome_text_es"]?></textarea>
		</div>
		<div class='form_entry'>
			<span class='label'><h4>Inglés</h4></span>
		</div>
		<div class='form_entry' style='height:50px'>
			<img width="50px" style='float:left;margin-right:10px' src='./resources/welcome/en.jpg'/><span class='label'><a href='./admin_add_image_cover.php?lang=en' class='important underline'><?php echo $s["add_new_cover"];?> Inglés</a></span>
		</div>
		<div class='form_entry'>
			<textarea name='welcome_text_en'><?php echo $config["welcome_text_en"]?></textarea>
		</div>
		<div class='form_submit'>
					<div class='likeabutton'>
						<input type='submit' value='<?php echo $s["accept"]?>'/>
					</div>
				</div>
		</form>
	</div>
</div>
<?php
include ("footer.php");
?>