<?php
//Lang revisado
/*
 Login ADMIN

 ------
 Decripción

 */
@session_start();
include ("./include/bdOC.php");

if (!(isset($_SESSION['admin']))) {
    header("location:./admin.php");
}

$seasons = getSeasons();
$lines = getSeasonLines($seasons["id_season"][0]);
/*
 $seasons["name_season"] = Array("Primavera/Verano 2009", "Otoño/Invierno 2009","Primavera/Verano 2010", "Otoño/Invierno 2010","Primavera/Verano 2011", "Otoño/Invierno 2011","Primavera/Verano 2012", "Otoño/Invierno 2012");
 $seasons["id_season"] = Array(20,21,22,23,24,25,26,27);
 */

$page = "admin_newseason";
include ("header.php");
?>
<script>
	$(document).ready(function() {
		$("#admin_new_season_step_1").click(function() {
			$("#step_1").submit();
		});
	});
</script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php' class='important'><?php echo $s["admin_menu_title"];?></a> / <a href='' class='important'><?php echo $s["admin_new_season_title"];?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_new_season_moreinfo"];?>
		</div>
		<div class='form' style="display:block">
			<form id='step_1' action="./admin_product_validate.php" method="post">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["admin_new_season_subtitle"];?></h3></span>
					<span id="admin_login_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["admin_new_season_name"];?> <span class='form_isrequired'>*</span></span>
					<select name="new_season_name" id="new_season_name" class="select">
						<?php
						for ($sesion=0;$sesion<sizeof($seasons["name_season"]);$sesion++){
						?>
						<option value='<?php echo $seasons["id_season"][$sesion];?>'><?php echo utf8_encode($seasons["name_season"][$sesion]);?></option> <?php
                        }
						?>
					</select>
					<span class='label'> <?php echo $s["receipt_to_import"]; ?><span class='form_isrequired'>*</span></span>
					<input type="text" name="receiptnumber" />
					<span id="admin_lines"><div class="checkbox_content">
</span>
					<span id="admin_username_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"];?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'>
						<a id="admin_new_season_step_1" href="#"><span class='text'><?php echo $s["next"]
							?></span></a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>