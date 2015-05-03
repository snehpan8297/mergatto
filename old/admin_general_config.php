<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
include_once("include/config.php");
if (isset($_POST["enviado"])) {
	$config["contact_email"] = $_POST["contact_email"];
	$config["url_base"] = $_POST["url_base"];
	$config["keywords"] = $_POST["keywords"];
	$config["description"] = $_POST["description"];
	$config["footer_text"] = $_POST["footer_text"];
	$config["color_dark"] = $_POST["season_color_dark"];
	$config["color_semidark"] = $_POST["season_color_semidark"];
	$config["color_light"] = $_POST["season_color_light"];
	$config["color_semilight"] = $_POST["season_color_semilight"];
	setConfig($config);
}
include_once ("include/users.php");
$page = "general_config";
include ("header.php");
//Llamar a la BD pero en realidad ya tienes esos datos…
$config = getConfig();
$system_tmp["contact_email"] = $config["contact_email"];
$system_tmp["url_base"] = $config["url_base"];
$system_tmp["keywords"] = $config["keywords"];
$system_tmp["description"] = $config["description"];
$system_tmp["footer_text"] = $config["footer_text"];
$system_tmp["season_color"]["light"] = $config["color_light"];
$system_tmp["season_color"]["semilight"] = $config["color_semilight"];
$system_tmp["season_color"]["semidark"] = $config["color_semidark"];
$system_tmp["season_color"]["dark"] = $config["color_dark"];
?>
<link rel="stylesheet" href="./js/css/jPicker-1.1.6.css" type="text/css" />
<script type="text/javascript" src="./js/jpicker-1.1.6.min.js"></script>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["general_config"];?></a>
		</div>
	</div>
	<div class='contentbox'>
		<?php
		if (isset($_POST["enviado"])) {
			?>
			<div id='infobox_header_save' class='infobox_info'>
				<h3 style='color: green;'><?php echo $s["general_config_succesful"];?></h3>
			</div>
			<?php
		} ?>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["general_config_moreinfo"];?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id="maintenance" name="maintenance" action="functions/maintenancemode.php" method="POST">
				<?php
					include("maintenancedb.php");
					$checked = "";
					if($maintenance) {
						$checked = "checked='checked'";
					}
				?>
				<div class='form_submit'>
					<label for="maintenance_mode"><?php echo $s["activate_maintenance_label"]; ?></label>
					<input type="checkbox" name="maintenance_mode" id='maintenance_mode' <?php echo $checked; ?> ><br/><br/>
					<div class='likeabutton'>
						<input id="signup_save" type='button' value='<?php echo $s["save"]?>'/>
					</div>
				</div>
			</form>
			<form id='step_1' action="./admin_general_config.php" method="post">
				<input type="hidden" name="enviado" value="1">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["general_config_subtitle"];?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["notification_email"];?><span class='form_isrequired'> *</span></span>
					<input  name="contact_email" id="contact_email" class='text' type='text' value='<?php echo $system_tmp["contact_email"];?>'/>
					<span id="contact_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'>Keywords<span class='form_isrequired'> *</span></span>
					<input  name="keywords" id="keywords" class='text' type='text' value='<?php echo $system_tmp["keywords"];?>'/>
					<span id="contact_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'>Descripcion<span class='form_isrequired'> *</span></span>
					<input  name="description" id="keywords" class='text' type='text' value='<?php echo $system_tmp["description"];?>'/>
					<span id="contact_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'>Texto Pié de página<span class='form_isrequired'> *</span></span>
					<input  name="footer_text" id="footer_text" class='text' type='text' value='<?php echo $system_tmp["footer_text"];?>'/>
					<span id="contact_email_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["url_base"];?><span class='form_isrequired'> *</span> ( Ej: http://www.okycokyshop.com/classics/ )</span>
					<input  name="url_base" id="url_base" class='text' type='text' value='<?php echo $system_tmp["url_base"];?>'/>
					<span id="url_base_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["season_colors"];?></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["light"];?><span class='form_isrequired'> *</span></span><div id='season_color_light_preview'></div>
					#<span id="light_value"><?php echo $system_tmp["season_color"]["light"];?></span>
					<input  name="season_color_light" id="season_color_light" class='text' type='hidden' value='<?php echo $system_tmp["season_color"]["light"];?>'/>
					<span id="season_color_light_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["semilight"];?><span class='form_isrequired'> *</span></span><div id='season_color_semilight_preview'></div>
					#<span id="semilight_value"><?php echo $system_tmp["season_color"]["semilight"];?></span>
					<input  name="season_color_semilight" id="season_color_semilight" class='text' type='hidden' value='<?php echo $system_tmp["season_color"]["semilight"];?>'/>
					<span id="season_color_semilight_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["semidark"];?><span class='form_isrequired'> *</span></span><div id='season_color_semidark_preview'></div>
					#<span id="semidark_value"><?php echo $system_tmp["season_color"]["semidark"];?></span>
					<input  name="season_color_semidark" id="season_color_semidark" class='text' type='hidden' value='<?php echo $system_tmp["season_color"]["semidark"];?>'/>
					<span id="season_color_semidark_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["dark"];?><span class='form_isrequired'> *</span></span><div id='season_color_dark_preview'></div>
					#<span id="dark_value"><?php echo $system_tmp["season_color"]["dark"];?></span>
					<input  name="season_color_dark" id="season_color_dark" class='text' type='hidden' value='<?php echo $system_tmp["season_color"]["dark"];?>'/>
					<span id="season_color_dark_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["payments_moreinfo"];?></span>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'>
						<input id="signup_send_step_1" type='submit' value='<?php echo $s["accept"]?>'/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	var colordark = "<?php echo $system_tmp["season_color"]["dark"];?>";
	var colorlight = "<?php echo $system_tmp["season_color"]["light"];?>";
	var colorsemidark = "<?php echo $system_tmp["season_color"]["semidark"];?>";
	var colorsemilight = "<?php echo $system_tmp["season_color"]["semilight"];?>";
	$(document).ready(function() {
		$("#season_color_dark_preview").jPicker({
				window : {
				expandable : true
				},
				images : {
				clientPath : 'js/images/'
				},
				color: {
				active: new $.jPicker.Color({ hex: colordark})
				}
			},
			function () {
			$("#season_color_dark").val($.jPicker.List[0].color.active.val('hex'))
			$("#dark_value").html($.jPicker.List[0].color.active.val('hex'))
			return false;
		}
		);
		$("#season_color_semidark_preview").jPicker({
				window : {
				expandable : true
				},
				images : {
				clientPath : 'js/images/'
				},
				color: {
				active: new $.jPicker.Color({ hex: colorsemidark})
				}
			},
			function () {
			$("#season_color_semidark").val($.jPicker.List[1].color.active.val('hex'))
			$("#semidark_value").html($.jPicker.List[1].color.active.val('hex'))
			return false;
		}
		);
		$("#season_color_semilight_preview").jPicker({
				window : {
				expandable : true
				},
				images : {
				clientPath : 'js/images/'
				},
				color: {
				active: new $.jPicker.Color({ hex: colorsemilight})
				}
			},
			function () {
			$("#season_color_semilight").val($.jPicker.List[2].color.active.val('hex'))
			$("#semilight_value").html($.jPicker.List[2].color.active.val('hex'))
			return false;
		}
		);
		$("#season_color_light_preview").jPicker({
				window : {
				expandable : true
				},
				images : {
				clientPath : 'js/images/'
				},
				color: {
				active: new $.jPicker.Color({ hex: colorlight})
				}
			},
			function () {
			$("#season_color_light").val($.jPicker.List[3].color.active.val('hex'))
			$("#light_value").html($.jPicker.List[3].color.active.val('hex'))
			return false;
		}
		);
		$("#signup_send_step_1").click(function() {
			if ($("#contact_email").val()=="") {
				alert("Rellene email");
				return false;
			} 
			if ($("#url_base").val()=="") {
				alert("Rellene url");
				return false;
			}
			return true; 
		})
	});
	function update_stock() {
		$("#stockupimg").css("display","block");
		$.ajax({
			type: "POST",
			url: 'functions/update_stock.php',
			success: function(msg) {
				$("#stockupimg").css("display","none");
				alert("Actualizado");
			}
		});
	}
	$("#signup_save").click(function() {
		maintenance_mode = 0;
		if($('#maintenance_mode').is(":checked")){
			maintenance_mode = 1;
		}
		$.ajax({
			type: "POST",
			data: {
				"maintenance_mode" : maintenance_mode
			},
			url: 'maintenancedbchange.php',
			success: function(msg) {
				$(".contentbox").prepend("<div id='infobox_header_save' class='infobox_info' style='display:none'><h3 style='color: green;'><?php echo $s["general_config_succesful"];?></h3></div>");
				$("#infobox_header_save").fadeIn().delay(2000).fadeOut();
			}
		});
	});
</script>
<?php
include ("footer.php");
?>