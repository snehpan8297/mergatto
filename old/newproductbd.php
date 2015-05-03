<?php
//Lang revisado

@session_start();
$lang = "es";
include("./include/includes.php");
include("./include/bdOC.php");

if(isset($_POST["serial_model_code"])){
	$edit["serial_model_code"]=$_POST["serial_model_code"];
	$edit["web_serial_model_code"]=$_POST["web_serial_model_code"];
    $edit["name_es"]=$_POST["name_es"];
    $edit["name_en"]=$_POST["name_en"];
    $edit["description_es"]=$_POST["description_es"];
    $edit["description_en"]=$_POST["description_en"];
    $edit["composition_es"]=$_POST["composition_es"];
    $edit["composition_en"]=$_POST["composition_en"];
    $edit["season_winter"]=$_POST["season_winter"];
    $edit["season_year"]=$_POST["season_year"];
    $edit["pvp"]=$_POST["pvp"];
    $edit["use_discount"]=$_POST["use_discount"];
    $edit["discount"]=$_POST["discount"];
    $edit["id_sizing"]=$_POST["id_sizing"];
    $edit["id_family"]=$_POST["id_family"];
    $edit["id_lavado"]=$_POST["id_wash"];
	$edit["id_lejiado"]=$_POST["id_bleach"];
	$edit["id_planchado"]=$_POST["id_iron"];
	$edit["id_lavado_seco"]=$_POST["id_dry_wash"];
	$edit["id_secado"]=$_POST["id_dry"];
	$edit["visible"]=0;
	
	$edit["id_product"]=addProduct($edit);
	echo "OK||".$edit["id_product"];
}
?>