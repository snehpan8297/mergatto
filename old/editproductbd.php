<?php
//Lang revisado

@session_start();
$lang = "es";
include("./include/includes.php");
include("./include/inbd.php");
include("./include/bdOC.php");
if(isset($_POST["serial_model_code"])){
	$table="products";
	$filter=array();
	$filter["id_product"] = array("operation"=>"=","value"=>$_POST["id_product"]);
	$edit=array();
	$edit["serial_model_code"] = $_POST["serial_model_code"];
	$edit["web_serial_model_code"] = $_POST["web_serial_model_code"];
	$edit["id_product"] = $_POST["id_product"];
	$edit["name_es"] = addslashes($_POST["name_es"]);
	$edit["name_en"] = addslashes($_POST["name_en"]);
	$edit["id_family"] = $_POST["id_family"];
	$edit["product_position"] = $_POST["product_position"];
	$edit["sizable"] = $_POST["sizable"];
    $edit["id_lavado"] = $_POST["id_wash"];
    $edit["id_lejiado"] = $_POST["id_bleach"];
    $edit["id_planchado"] = $_POST["id_iron"];
    $edit["id_lavado_seco"] = $_POST["id_dry_wash"];
    $edit["id_secado"] = $_POST["id_dry"];
    $edit["description_es"] = addslashes($_POST["description_es"]);
	$edit["description_en"] = addslashes($_POST["description_en"]);
	$edit["hidden_description"] = addslashes($_POST["hidden_description"]);
	$edit["composition_es"] = addslashes($_POST["composition_es"]);
	$edit["composition_en"] = addslashes($_POST["composition_en"]);
	$edit["season_winter"] = $_POST["season_winter"];
	$edit["season_year"] = $_POST["season_year"];
	$edit["pvp"] = $_POST["pvp"];
	$edit["use_discount"] = $_POST["use_discount"];
	$edit["cover"] = $_POST["cover"];
	$edit["discount"] = $_POST["discount"];

	if(isset($_POST["visible"]) && !empty($_POST["visible"])){
		$edit["visible"]=1;
	}else{
		$edit["visible"]=0;
	}

	updateInBD($table,$filter,$edit);
	$edit["colores"] = $_POST["colores"];
	$colores=explode("//",$_POST["colores"]);
	foreach ($colores as $key=>$value) {
		$colores[$key]=explode("||",$value);
		$color["id_color"] = $colores[$key][0];
		$color["use_color"] = $colores[$key][1];
		$color["name"] = $colores[$key][2];
		$color["name_es"] = $colores[$key][3];
		$color["name_en"] = $colores[$key][4];
		$color["has_image"] = $colores[$key][5];
		updateColor($color);
		$stock["id_color"] = $colores[$key][0];
		$stock["id_product"] = $_POST["id_product"];
		$stock["stock_size_1"] = $colores[$key][6];
		$stock["stock_size_2"] = $colores[$key][7];
		$stock["stock_size_3"] = $colores[$key][8];
		$stock["stock_size_4"] = $colores[$key][9];
		$stock["stock_size_5"] = $colores[$key][10];
		$stock["stock_size_6"] = $colores[$key][11];
		$stock["stock_size_7"] = $colores[$key][12];
		$stock["stock_size_8"] = $colores[$key][13];
		$stock["stock_size_9"] = $colores[$key][14];
		$stock["stock_size_10"] = $colores[$key][15];
		$stock["stock_size_11"] = $colores[$key][16];
		$stock["stock_size_12"] = $colores[$key][17];
		updateStockidColor($stock);
	}
	echo "OK";
	
	$table="product_categories";
	$filter=array();
	$filter["id_product"]=array("operation"=>"=","value"=>$_POST["id_product"]);
	deleteInBD($table,$filter);
	$categories_selected = explode("||",$_POST["categories"]);
	foreach ($categories_selected as $key => $category_selected){
		$data=array();
		$data["id_product"] = $_POST["id_product"];
		$data["id_category"] = $category_selected;
		addInBD($table,$data);
	}
	$table="product_subfamilies";
	$filter["id_product"]=array("operation"=>"=","value"=>$_POST["id_product"]);
	deleteInBD($table,$filter);
	$subfamilies_selected = explode("||",$_POST["subfamilies"]);
	foreach ($subfamilies_selected as $key => $subfamily_selected){
		$data=array();
		$data["id_product"] = $_POST["id_product"];
		$data["id_subfamily"] = $subfamily_selected;
		addInBD($table,$data);
	}
}
?>