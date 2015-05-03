<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$page = "import";
include ("./include/bdOC.php");
include ("./include/inbd.php");
?>
<style type="text/css">
	.ProgressBar     { width: 500px; border: 1px solid black; background: #eef; height: 2.5em; display: block; margin: auto; }
	.ProgressBarText { position: absolute; font-size: 2em; width: 500px; text-align: center; font-weight: normal; color: black; }
	.ProgressBarFill { height: 100%; background: #aae; display: block; overflow: visible; }
</style>
<?php
include ("./header.php");
?>
<script language="javascript">
//Creo una función que imprimira en la hoja el valor del porcentanje asi como el relleno de la barra de progreso
function callprogress(vValor,cont,total,serial){
	document.getElementById("getprogress").innerHTML = vValor;
	document.getElementById("ProgressBarCount").innerHTML = cont;
	document.getElementById("ProgressBarTotal").innerHTML = total;
	document.getElementById("ProgressBarSerial").innerHTML = serial;
	document.getElementById("getProgressBarFill").innerHTML = '<div class="ProgressBarFill" style="width: '+vValor+'%;"></div>';
}
//Funcion para mostrar el botón de siguiente
function showNext() {
	$("#nextButton").show();
}
</script>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php' class='important'><?php echo $s["admin_menu_title"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_product_import_title"];?></a>
		</div>
	</div>
	<b><?php echo $s["progress"]; ?></b> <span id="ProgressBarSerial"></span> [<span id="ProgressBarCount"></span> / <span id="ProgressBarTotal"></span>]<br/><br/>
	<div class="ProgressBar">
		<div class="ProgressBarText"><span id="getprogress"></span>&nbsp;<?php echo $s["percent_completed"]; ?></div>
		<div id="getProgressBarFill"></div>
	</div>
	<div id='nextButton' style='display:none; margin-top: 100px;'>
		<div class='likeabutton'>
			<a id="next" href="import_product_end.php"><span class='text'><?php echo $s["next"];?></span></a>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>
<?php
$s["family_19"]="Miscellaneous";
$s["family_20"]="Fabric";
$s["family_21"]="Components";
$s["family_22"]="Tej. Muestrario";
$s["family_23"]="Coats";
$s["family_24"]="Blouses";
$s["family_25"]="T-Shirts";
$s["family_26"]="Belts";
$s["family_27"]="Jackets";
$s["family_28"]="Cardigans";
$s["family_29"]="Scarves";
$s["family_30"]="Skirts";
$s["family_31"]="Vests";
$s["family_32"]="Trousers";
$s["family_33"]="Trousers oky's";
$s["family_36"]="Dresses";
$s["family_37"]="Tops";
$s["family_38"]="Forros";
$s["family_39"]="Accessories";
$s["family_40"]="Morocco Clothes";
$s["family_41"]="Collars";
$s["family_42"]="Shirts Dresslok";
$s["family_43"]="T-Shirts Dresslok";
$s["family_44"]="Jackets Okys";
$s["family_46"]="Gloves";
$s["family_47"]="Necklaces";
$s["family_48"]="Headdress";
$s["family_49"]="Foulards";
$s["family_50"]="Shoes";
$s["family_51"]="Stoles";
$s["family_52"]="Shorts";
$s["family_53"]="Boleros";
$s["family_54"]="Jackets";
$s["family_55"]="Cardigans";
$s["family_56"]="Jumpsuits";
$s["family_57"]="Armbands";
$s["family_58"]="Earrings";
$s["family_59"]="Capes";
$s["family_60"]="Jackets";
$s["family_61"]="Shirts";
$s["family_62"]="Knitwear";
$s["family_63"]="Sweaters";
$s["family_65"]="Outfit";



if(isset($_POST["new_season_name"])) {
	$total = count($_POST["series"]);
	$seasons = getSeasons();
	$newseason_year = "";
	$newseason_winter = 0;
	for($i = 0; $i < count($seasons["id_season"]); $i++) {
		if($seasons["id_season"][$i] == $_POST["new_season_name"]){
			$newseason = explode(" ",$seasons["name_season"][$i]);
			if($newseason[0] == "PRIMAVERA-VERANO" || $newseason[0] == "*PRIMAVERA-VERANO") {
				$newseason_winter = 0;
			} else {
				$newseason_winter = 1;
			}
			$newseason_year = substr($newseason[1],2);
			break;
		}
	}
	$cont = 0;
	//deleteAllProducts($_POST["new_season_name"]);
	$error = array();
	$exist = array();
	error_log("[Classics - IMPORT] Start ");
	foreach($_POST["series"] as $key=>$serial_model_code) {
		$product = array();
		$serial_model_code = str_replace("\xef\xbf\xbd", "Ñ", $serial_model_code);
		$cont++;
		$porcentaje = $cont * 100 / $total;
		echo "<script>callprogress(".round($porcentaje).",".$cont.",".$total.",'".$serial_model_code."')</script>";
		//try {
			error_log("[Classics - IMPORT] Start Import ".$serial_model_code);
			
			
			if(!productInDB(trim($serial_model_code))) {
				error_log("[Classics - IMPORT] Product ".$serial_model_code." NOT IN BD");
			
			
			
				$p = getModelSeason($serial_model_code);
				$p["name"] = str_replace("\xd1", "AÃ‘", $p["name"]);
				if(strstr($p["name"],"-")) {
					$descarray = explode("-", $p["name"]);
				} else {
					$descarray[0] = $p["name"];
					$descarray[1] = $p["name"];
				}
				/*echo "<pre>";
				print_r($p);
				die;*/
				$modelname = getFamilyName($p["id_family"]) . " " . $descarray[1];
				$product["serial_model_code"] = $serial_model_code;
				$product["web_serial_model_code"] = $serial_model_code;
				$product["id_season"] = $p["id_season"];
				$product["id_family"] = $p["id_family"];
				$product["id_subfamily"] = 0;
				$product["id_category"] = $_POST["id_category"];
				$product["sizable"] = 1;
				$product["id_sizing"] = $p["id_sizing"];
				$product["name_es"] = $modelname;
				$product["name_en"] = strtoupper($s["family_".$p["id_family"]])." ". $descarray[1];
				$product["description_es"] = $descarray[0];
				$product["description_en"] = $descarray[0];
				$product["composition_es"] = $p["description"];
				$product["composition_en"] = $p["description"];
				$product['id_lavado'] = $p["id_lavado"];
				$product['id_lejiado'] = $p["id_lejiado"];
				$product['id_planchado'] = $p["id_planchado"];
				$product['id_lavado_seco'] = $p["id_lavado_seco"];
				$product['id_secado'] = $p["id_secado"];
				//$product["pvp"] = $p["public_pvp"];
				$product["pvp"] = $p["client_pvp_9"];
				$product['season_year'] = $newseason_year;
				$product['season_winter'] = $newseason_winter;
				/*for ($i = 1; $i <= 12; $i++) {
					if(isset($p["client_pvp_" . $i])) {
						$product["client_pvp_" . $i] = $p["client_pvp_" . $i];
					} else {
						$product["client_pvp_" . $i] = 0;
					}
				}*/
				$product["visible"] = 0;
				//$product["old_season"] = 0;
				
				$idmodel = getIdProduct($serial_model_code);
				if($idmodel == -1) {
					$idmodel = insertModel($product);
				} else {
					updateModel($product);
					deleteImages($idmodel);
					deleteColors($serial_model_code);
				}
				$images = getIfModelHasImage($serial_model_code);
				if(sizeof($images) == 0) {
					if($p["image"] == 1) {
						getImageProduct($serial_model_code,$idmodel);
						//getImageProductPatron($serial_model_code);
					} else {
						getImageProductPatron($serial_model_code);
					}
				}
			
				$images = getIfModelHasImage($serial_model_code);
				if(sizeof($images) > 0) {
					addImageToProduct($images[0],$idmodel);
				}
			
				$colorstock = getPedLineData($_POST["new_season_name"],$_POST["receiptnumber"],$serial_model_code);

				error_log("[Classics - IMPORT] IMPORT COLORS");
				while($value = mssql_fetch_assoc($colorstock)) {
					error_log("[Classics - IMPORT] IMPORT COLOR ".$value["ID_COLOR_PROD"]);
					$colors = getColor($serial_model_code,$value["ID_COLOR_PROD"]);
					$prod['name_colors'] = $colors["name"];
					$prod['id_colors'] = $colors["id"];
					$prod["number"] = $colors["number"];
					$colores = array();
					$colores[] = array($prod["id_colors"][0],$prod["name_colors"][0],$prod["number"][0],$prod["name_colors"][0],$prod["name_colors"][0]);
					addModelColors($serial_model_code,$idmodel,$colores);
					$colordata = colordata($value["ID_COLOR_PROD"]);
					$stock=array();
					$stock["id_color"] = $colordata["id"];
					$stock["id_product"] = $idmodel;
					
					
					$table="stocks";
					$filter=array();
					$filter["id_product"]= array("operation"=>"=","value"=>$stock["id_product"]);
					$filter["id_color"]= array("operation"=>"=","value"=>$stock["id_color"]);
					if(isInBD($table,$filter)){
						$stock=getInBD($table,$filter);
						$stock["stock_size_1"] += $value["TALLA1"];
						$stock["stock_size_2"] += $value["TALLA2"];
						$stock["stock_size_3"] += $value["TALLA3"];
						$stock["stock_size_4"] += $value["TALLA4"];
						$stock["stock_size_5"] += $value["TALLA5"];
						$stock["stock_size_6"] += $value["TALLA6"];
						$stock["stock_size_7"] += $value["TALLA7"];
						$stock["stock_size_8"] += $value["TALLA8"];
						$stock["stock_size_9"] += $value["TALLA9"];
						$stock["stock_size_10"] += $value["TALLA10"];
						$stock["stock_size_11"] += $value["TALLA11"];
						$stock["stock_size_12"] += $value["TALLA12"];
						updateInBD($table,$filter,$stock);
						error_log("[Classics - IMPORT] ".$serial_model_code." (NEW PRODUCT) - ".$prod["name_colors"][0]." Update Stock Ok");
						error_log("[Classics - IMPORT] ".$serial_model_code." NEW [ ".$value["TALLA1"]." ".$value["TALLA2"]." ".$value["TALLA3"]." ".$value["TALLA4"]."  ".$value["TALLA5"]." ".$value["TALLA6"]."  ".$value["TALLA7"]."  ".$value["TALLA8"]."  ".$value["TALLA8"]."  ".$value["TALLA10"]." ] ");
						error_log("[Classics - IMPORT] ".$serial_model_code." [ ".$stock["stock_size_1"]." ".$stock["stock_size_2"]." ".$stock["stock_size_3"]." ".$stock["stock_size_4"]."  ".$stock["stock_size_5"]." ".$stock["stock_size_6"]."  ".$stock["stock_size_7"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_10"]." ] ");
						$stock=array();
					}else{
						$stock["stock_size_1"] = $value["TALLA1"];
						$stock["stock_size_2"] = $value["TALLA2"];
						$stock["stock_size_3"] = $value["TALLA3"];
						$stock["stock_size_4"] = $value["TALLA4"];
						$stock["stock_size_5"] = $value["TALLA5"];
						$stock["stock_size_6"] = $value["TALLA6"];
						$stock["stock_size_7"] = $value["TALLA7"];
						$stock["stock_size_8"] = $value["TALLA8"];
						$stock["stock_size_9"] = $value["TALLA9"];
						$stock["stock_size_10"] = $value["TALLA10"];
						$stock["stock_size_11"] = $value["TALLA11"];
						$stock["stock_size_12"] = $value["TALLA12"];
						addInBD($table,$stock);
						error_log("[Classics - IMPORT] ".$serial_model_code." (NEW PRODUCT) - ".$prod["name_colors"][0]." Insert Stock Ok");
						error_log("[Classics - IMPORT] ".$serial_model_code." [ ".$stock["stock_size_1"]." ".$stock["stock_size_2"]." ".$stock["stock_size_3"]." ".$stock["stock_size_4"]."  ".$stock["stock_size_5"]." ".$stock["stock_size_6"]."  ".$stock["stock_size_7"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_10"]." ] ");
						$stock=array();
					}
					
					
				}
				/*$colors = productColors($serial_model_code);
				while($color = db_fetch($colors)) {
					$stock = getModelColorStock($serial_model_code, $color["id_color"]);
					$a = strpos($color["name_id_color"],"M");
					if($a === true) {
						$stock = getModelColorStockM($serial_model_code,$color["name_id_color"]);
					//} else {
						//$stockM = array(0,0,0,0,0,0,0,0,0,0,0,0);
					}
					$istock = array();
					$istock["id_product"] = $idmodel;
					$istock["id_color"] = $color["id"];
					for($i=1;$i<=12;$i++) {
						$istock["stock_size_".$i] = $stock[$i-1];//+$stockM[$i-1];
					}
					$idstock = existStock($idmodel,$color["id"]);
					if($idstock != false) {
						$istock["id_stock"] = $idstock;
						updateStock($istock);
					} else {
						insertStock($istock);
					}
				}*/
			} else {
				error_log("[Classics - IMPORT] Product ".$serial_model_code." IN BD");
			
			
				$exist[] = $serial_model_code;
				$product = productDataFromSerialModel($serial_model_code);
				$idmodel = $product["id_product"];
				$colorstock = getPedLineData($_POST["new_season_name"],$_POST["receiptnumber"],$serial_model_code);
				while($value = mssql_fetch_assoc($colorstock)) {
					$colors = getColor($serial_model_code,$value["ID_COLOR_PROD"]);
					$prod['name_colors'] = $colors["name"];
					$prod['id_colors'] = $colors["id"];
					$prod["number"] = $colors["number"];
					$colores = array();
					$colores[] = array($prod["id_colors"][0],$prod["name_colors"][0],$prod["number"][0],$prod["name_colors"][0],$prod["name_colors"][0]);
					addModelColors($serial_model_code,$idmodel,$colores);
					$colordata = colordata($value["ID_COLOR_PROD"]);
					
					
					
					
					$stock=array();
					$stock["id_color"] = $colordata["id"];
					$stock["id_product"] = $idmodel;

					$table="stocks";
					$filter=array();
					$filter["id_product"]= array("operation"=>"=","value"=>$stock["id_product"]);
					$filter["id_color"]= array("operation"=>"=","value"=>$stock["id_color"]);
					if(isInBD($table,$filter)){
						$stock=getInBD($table,$filter);
						$stock["stock_size_1"] += $value["TALLA1"];
						$stock["stock_size_2"] += $value["TALLA2"];
						$stock["stock_size_3"] += $value["TALLA3"];
						$stock["stock_size_4"] += $value["TALLA4"];
						$stock["stock_size_5"] += $value["TALLA5"];
						$stock["stock_size_6"] += $value["TALLA6"];
						$stock["stock_size_7"] += $value["TALLA7"];
						$stock["stock_size_8"] += $value["TALLA8"];
						$stock["stock_size_9"] += $value["TALLA9"];
						$stock["stock_size_10"] += $value["TALLA10"];
						$stock["stock_size_11"] += $value["TALLA11"];
						$stock["stock_size_12"] += $value["TALLA12"];
						updateInBD($table,$filter,$stock);
						error_log("[Classics - IMPORT] ".$serial_model_code." (OLD PRODUCT) - ".$prod["name_colors"][0]." Update Stock Ok");
						error_log("[Classics - IMPORT] ".$serial_model_code." NEW [ ".$value["TALLA1"]." ".$value["TALLA2"]." ".$value["TALLA3"]." ".$value["TALLA4"]."  ".$value["TALLA5"]." ".$value["TALLA6"]."  ".$value["TALLA7"]."  ".$value["TALLA8"]."  ".$value["TALLA8"]."  ".$value["TALLA10"]." ] ");
						error_log("[Classics - IMPORT] ".$serial_model_code." [ ".$stock["stock_size_1"]." ".$stock["stock_size_2"]." ".$stock["stock_size_3"]." ".$stock["stock_size_4"]."  ".$stock["stock_size_5"]." ".$stock["stock_size_6"]."  ".$stock["stock_size_7"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_10"]." ] ");
						$stock=array();
					}else{
						$stock["stock_size_1"] = $value["TALLA1"];
						$stock["stock_size_2"] = $value["TALLA2"];
						$stock["stock_size_3"] = $value["TALLA3"];
						$stock["stock_size_4"] = $value["TALLA4"];
						$stock["stock_size_5"] = $value["TALLA5"];
						$stock["stock_size_6"] = $value["TALLA6"];
						$stock["stock_size_7"] = $value["TALLA7"];
						$stock["stock_size_8"] = $value["TALLA8"];
						$stock["stock_size_9"] = $value["TALLA9"];
						$stock["stock_size_10"] = $value["TALLA10"];
						$stock["stock_size_11"] = $value["TALLA11"];
						$stock["stock_size_12"] = $value["TALLA12"];
						addInBD($table,$stock);
						error_log("[Classics - IMPORT] ".$serial_model_code." (OLD PRODUCT) - ".$prod["name_colors"][0]." Insert Stock Ok");
						error_log("[Classics - IMPORT] ".$serial_model_code." RESULT [ ".$stock["stock_size_1"]." ".$stock["stock_size_2"]." ".$stock["stock_size_3"]." ".$stock["stock_size_4"]."  ".$stock["stock_size_5"]." ".$stock["stock_size_6"]."  ".$stock["stock_size_7"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_8"]."  ".$stock["stock_size_10"]." ] ");
						$stock=array();
					}
					
					
					
				}
			}
		/*} catch(Exception $e) {
			$error[] = array($serial_model_code,$e->getMessage());
		}*/
		flush();
		ob_flush();
	}
	
	
	error_log("[Clothes Importer] [START] Delete DB");
	$table="colors_new";
	deleteInBD($table);
	$table="stocks_new";
	deleteInBD($table);
	error_log("[Clothes Importer] [END] Delete DB");
	error_log("[Clothes Importer] [START] Update Colors & Stocks");
	$table="products";
	$products=listInBD($table);
	foreach($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		if(isInBD($table,$filter)){
			error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START]");
			if(isInBD($table,$filter)){
				$colors=listInBD($table,$filter);
				$colors_new=array();
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START] Get Colors Data");
	
				foreach($colors as $key=>$color){
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] [START] Get Color");
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Translate id_color");
					$color["name_id_color"]=str_replace("CRUDO-NEGRO","10",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("M","",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("m","",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("N","",$color["name_id_color"]);
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Get Color");
					
					
					if(empty($colors_new[$color["name_id_color"]])){
						error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Add Color in new colors");
						$colors_new[$color["name_id_color"]]=array();
						$colors_new[$color["name_id_color"]]["color_data"]=array();
						
						$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
						$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
						$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
						$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
						$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;
						
						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
						$colors_new[$color["name_id_color"]]["stock_data"]=array();

						$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$product["id_product"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=0;
						
						if(isInBD($table,$filter)){
							$stock=getInBD($table,$filter);
							
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=$stock["stock_size_1"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=$stock["stock_size_2"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=$stock["stock_size_3"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=$stock["stock_size_4"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=$stock["stock_size_5"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=$stock["stock_size_6"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=$stock["stock_size_7"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=$stock["stock_size_8"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=$stock["stock_size_9"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=$stock["stock_size_10"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=$stock["stock_size_11"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=$stock["stock_size_12"];
													}
						
					}else{
						error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Update Color in new colors");
	
						$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
						$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
						$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
						$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
						$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;
						
						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
						
						if(isInBD($table,$filter)){
							$stock=getInBD($table,$filter);
							
							$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$color["id_product"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]+=$stock["stock_size_1"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]+=$stock["stock_size_2"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]+=$stock["stock_size_3"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]+=$stock["stock_size_4"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]+=$stock["stock_size_5"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]+=$stock["stock_size_6"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]+=$stock["stock_size_7"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]+=$stock["stock_size_8"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]+=$stock["stock_size_9"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]+=$stock["stock_size_10"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]+=$stock["stock_size_11"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]+=$stock["stock_size_12"];
						}
					}
					
					
				}
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END] Get Colors Data");	
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START] Update BD");
				foreach($colors_new as $key=>$color_new){
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Color data");
					$table="colors_new";
					addInBD($table,$color_new["color_data"]);
					$table="colors_new";
					$filter=array();
					$filter["id_color"]=array("operation"=>"=","value"=>$color_new["color_data"]["id_color"]);
					$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
					$color_tmp=getInBD($table,$filter);
						
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Stock data");
					$table="stocks_new";
					$color_new["stock_data"]["id_color"]=$color_tmp["id"];
					addInBD($table,$color_new["stock_data"]);
				}
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END] Update BD");
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END]");
				
				
			}
					
		}
	}
	error_log("[Clothes Importer] [END] Update Colors & Stocks");
	
	$table="products";
	$products=listInBD($table);
	foreach($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$colors=listInBD($table,$filter);
		$stock_total=0;
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			if(isInBD($table,$filter)){
				$stock=getInBD($table,$filter);
				$stock_total+=$stock["stock_size_1"];
				$stock_total+=$stock["stock_size_2"];
				$stock_total+=$stock["stock_size_3"];
				$stock_total+=$stock["stock_size_4"];
				$stock_total+=$stock["stock_size_5"];
				$stock_total+=$stock["stock_size_6"];
				$stock_total+=$stock["stock_size_7"];
				$stock_total+=$stock["stock_size_8"];
				$stock_total+=$stock["stock_size_9"];
				$stock_total+=$stock["stock_size_10"];
				$stock_total+=$stock["stock_size_11"];
				$stock_total+=$stock["stock_size_12"];
			}
		}
		$table="colors_new";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$colors=listInBD($table,$filter);
		$stock_total_new=0;
		foreach($colors as $key=>$color){
			$table="stocks_new";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
			if(isInBD($table,$filter)){
				$stock=getInBD($table,$filter);
				$stock_total_new+=$stock["stock_size_1"];
				$stock_total_new+=$stock["stock_size_2"];
				$stock_total_new+=$stock["stock_size_3"];
				$stock_total_new+=$stock["stock_size_4"];
				$stock_total_new+=$stock["stock_size_5"];
				$stock_total_new+=$stock["stock_size_6"];
				$stock_total_new+=$stock["stock_size_7"];
				$stock_total_new+=$stock["stock_size_8"];
				$stock_total_new+=$stock["stock_size_9"];
				$stock_total_new+=$stock["stock_size_10"];
				$stock_total_new+=$stock["stock_size_11"];
				$stock_total_new+=$stock["stock_size_12"];
			}else{
				error_log("[Clothes Importer] Not in bd (".$color["id"].",".$product["id_product"].")");
			}
		}
		if($stock_total==$stock_total_new){
			error_log("[Clothes Importer] [Check] ".$product["serial_model_code"]." ( ".$product["id_product"]." ) OK");
		}else{
			error_log("[Clothes Importer] [Check] ".$product["serial_model_code"]." ( ".$product["id_product"]." ) ERROR");
			die();
		}
	}
	
	
	
	error_log("[Clothes Importer] [START] Import new colors to colors table");
	
	$table="colors";
	deleteInBD($table);
	$table="colors_new";
	$colors=listInBD($table);
	foreach ($colors as $key=>$color){
		$table="colors";
		addInBD($table,$color);
	}
	$table="stocks";
	deleteInBD($table);
	$table="stocks_new";
	$stocks=listInBD($table);
	foreach ($stocks as $key=>$stock){
		$table="stocks";
		addInBD($table,$stock);
	}

	error_log("[Clothes Importer] [END] Import new colors to colors table");

	error_log("[Clothes Importer] [END] Done! ");
	
	$table="products";
	$filter=array();
	$products=listInBD($table);
	foreach ($products as $key=>$product){
		$server = conectaDBOkyCoky();
		$query = "select PVP from PROD_MODELOS where cod_serie_modelo='".$product["serial_model_code"]."'";
		$q = mssql_query($query, $server);
		while($lin = mssql_fetch_assoc($q)){
			if($product["id_season"]>=31){
				$pvp_new=intval($lin["PVP"]*1.1*2.7);
			}else{
				$pvp_new=intval($lin["PVP"]*2.5);	
			}
			$table="products";
			$filter=array();
			$filter["serial_model_code"] = array("operation"=>"=","value"=>$product["serial_model_code"]);
			$data=array();
			$data["pvp"]=$pvp_new;
			updateInBD($table,$filter,$data);
			
		}
	}
	
	// Set colors ID
	
	$table="colors";
	$colors=listInBD($table);
	$count_colors=countInBD($table);
	$count=1;
	foreach ($colors as $key=>$color){
		$color_found=false;
		$server = conectaDBOkyCoky();
		$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";

		$q = mssql_query($query, $server);
		while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
			//print_r($lin);
			$color_found=true;
			$color_bd=$lin;
		}
		if(!$color_found){
			$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."M'";
			$q = mssql_query($query, $server);
			while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
				//print_r($lin);
				$color_found=true;
				$color_bd=$lin;
			}
			if(!$color_found){
				if($color["name_id_color"]=="10"){
					$color["name_id_color"]="CRUDO-NEGRO";
				}
				if($color["name_id_color"]=="UI"){
					$color["name_id_color"]="UNI";
				}
				$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";
				$q = mssql_query($query, $server);
				while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
					//print_r($lin);
					$color_found=true;
					$color_bd=$lin;
				}
				if(!$color_found){
					/*echo $color["serial_model_code"]."@".$color["name_id_color"]." color not found!<br/>";
					$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";
					$q = mssql_query($query, $server);
					while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
						print_r($lin);
						//$color_found=true;
					}*/
				}else{
				}
			}else{
			}
		}else{
		
		}
		
		if($color_found){
			error_log($color["serial_model_code"]."@".$color["name_id_color"]." color found!");
			$table="colors";
			$filter=array();
			$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
			$data=array();
			$data["id_color"]=$color_bd["ID_COLOR_PROD"];
			updateInBD($table,$filter,$data);			
		}
	}
		
	
	
	
	unset($_SESSION["import_msgs_classics"]);
	$_SESSION["import_msgs_classics"] = array($error,$exist);
	echo "<script>showNext();</script>";
}
?>