<?php
//Lang revisado

@session_start();
include("./include/bdOC.php");
include("./include/stock.php");
include("./include/colors.php");

$cont=$_SESSION["contador"];
$test=$_SESSION["precarga"];
$idmodel=getIdProduct($test[$cont]["serial_model_code"]);

if ($_POST["add"]=="checked") {
	//$testo["serial_model_code"]=$test[$cont]["serial_model_code"];
	$testo["serial_model_code"]=$_POST["serial_model_code"];
	$testo["name_es"]=$_POST["name_es"];
	$testo["name_en"]=$_POST["name_en"];
	$testo["description_es"]=$_POST["description_es"];
	$testo["composition_es"]=$_POST["composition_es"];
	$testo["description_en"]=$_POST["description_en"];
	$testo["composition_en"]=$_POST["composition_en"];
	$testo["visible"]=0;
	$testo["id_family"]=$_POST["id_family"];
	if(isset($_POST["id_sizing"])) {
		$testo["id_sizing"]=$_POST["id_sizing"];
	} else {
		if(isset($test[$cont]["id_sizing"])) {
			$testo["id_sizing"]=$test[$cont]["id_sizing"];
		}
	}
	$testo["pvp"]=$_POST["pvp"];
	$testo["id_lavado"]=$_POST["id_wash"];
	$testo["id_lejiado"]=$_POST["id_bleach"];
	$testo["id_planchado"]=$_POST["id_iron"];
	$testo["id_lavado_seco"]=$_POST["id_dry_wash"];
	$testo["id_secado"]=$_POST["id_dry"];
	if(isset($test[$cont]["id_season"])) {
		$testo["id_season"]=$test[$cont]["id_season"];
	}
	$testo["season_year"]=$_POST["season_year"];
	$testo["season_winter"]=$_POST["season_winter"];
	$testo["use_discount"]=$_POST["use_discount"];
	$testo["discount"]=$_POST["discount"];

	if ($idmodel==-1) {
		$idmodel=insertModel($testo);
	} else {
		updateModel($testo);
	}
	if(isset($_POST["colores"])) {
		$colores = explode("//",$_POST["colores"]);
		foreach ($colores as $key=>$value) {
			$colores[$key]=explode("||",$value);
		}
		$idstock=checkStock($test[$cont]["serial_model_code"],$colores[0][0]);
		for($i=1;$i<=12;$i++){
			if(isset($_POST["stock_size_".$i])&&!empty($_POST["stock_size_".$i])){
				$stock["stock_size_".$i]=$_POST["stock_size_".$i];	
			}else{
				$stock["stock_size_".$i]=0;
			}
		
		}
		if ($idstock) {
			$stock["id_stock"]=$idstock;
			addStock($stock);
		} else {
			$idc=addModelColors($test[$cont]["serial_model_code"],$colores);
			$stock["id_product"]=$idmodel;
			$stock["id_color"]=$idc;
			insertStock($stock);
		}
	}
	if ($_POST["main_photo"]!="--") {
		addImageToProduct($_POST["main_photo"],$idmodel);
	}
}
$_SESSION["contador"]++;
echo "OK";
?>