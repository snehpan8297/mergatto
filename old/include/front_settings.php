<?php

	//Llamar a la BD para coger los datos
	include_once("config.php");
	$config=getConfig();
	$contact_email=$config["contact_email"];
	
	$season_color["dark"] = "#".$config["color_dark"];
	$season_color["semidark"] = "#".$config["color_semidark"];
	$season_color["semilight"] = "#".$config["color_semilight"];
	$season_color["light"] = "#".$config["color_light"];
	
	$url_base = $config["url_base"];// "http://www.okycokyshop.com/";
?>