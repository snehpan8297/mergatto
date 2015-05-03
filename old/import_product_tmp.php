<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$page = "import";
include ("./include/bdOC.php");
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
	<h1>Listado de Importación</h1>
	<br/>
	<?php print_r($_POST);?>
	<?php
		foreach($_POST["series"] as $key=>$serial_model_code) {
		?>
		<div style='margin:10px;'>
			<i class='fa fa-clock-o'></i> <?php echo $serial_model_code;?>
		</div>
		<?php
			$product_bd = getModelSeason($serial_model_code);
			$product_bd["name"] = str_replace("\xd1", "AÃ‘", $product_bd["name"]);
				if(strstr($product_bd["name"],"-")) {
					$descarray = explode("-", $product_bd["name"]);
				} else {
					$descarray[0] = $product_bd["name"];
					$descarray[1] = $product_bd["name"];
				}
			$modelname = getFamilyName($product_bd["id_family"]) . " " . $descarray[1];

			$product["serial_model_code"] = $serial_model_code;
			$product["web_serial_model_code"] = $serial_model_code;
			$product["id_season"] = $product_bd["id_season"];
			$product["id_family"] = $product_bd["id_family"];
			$product["id_subfamily"] = 0;
			$product["id_category"] = $_POST["id_category"];
			$product["sizable"] = 1;
			$product["id_sizing"] = $product_bd["id_sizing"];
			$product["name_es"] = $modelname;
			$product["name_en"] = strtoupper($si["family_".$product_bd["id_family"]])." ". $descarray[1];
			$product["description_es"] = $descarray[0];
			$product["description_en"] = $descarray[0];
			$product["composition_es"] = $product_bd["description"];
			$product["composition_en"] = $product_bd["description"];
			$product['id_lavado'] = $product_bd["id_lavado"];
			$product['id_lejiado'] = $product_bd["id_lejiado"];
			$product['id_planchado'] = $product_bd["id_planchado"];
			$product['id_lavado_seco'] = $product_bd["id_lavado_seco"];
			$product['id_secado'] = $product_bd["id_secado"];
			$product["pvp"] = $product_bd["client_pvp_9"];
			$product['season_year'] = $newseason_year;
			$product['season_winter'] = $newseason_winter;
			print_r($product);
		}
	?>
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


foreach($_POST["series"] as $key=>$serial_model_code) {

}


?>