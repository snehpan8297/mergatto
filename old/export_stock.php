<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:./admin.php");
    die();
}
$family = "all";

$s["family_0"] = "";
$s["family_19"]="Varios";
        $s["family_20"]="Tejido";
$s["family_21"]="Componentes";
$s["family_22"]="Tej. Muestrario";
$s["family_23"]="Abrigos";
$s["family_24"]="Blusas";
$s["family_25"]="Camisetas";
$s["family_26"]="Cinturones";
$s["family_27"]="Chaquetas";
$s["family_28"]="Chaq. Ligeras";
$s["family_29"]="Echarpes";
$s["family_30"]="Faldas";
$s["family_31"]="Chalecos";
$s["family_32"]="Pantalones";
$s["family_33"]="Pantalones oky's";
$s["family_36"]="Vestidos";
$s["family_37"]="Tops";
$s["family_38"]="Forros";
$s["family_39"]="Complementos";
$s["family_40"]="Prendas Morocco";
$s["family_41"]="Cuellos";
$s["family_42"]="Blus. Dresslok";
$s["family_43"]="Camisetas Dresslok";
$s["family_44"]="Chaq. Okys";
$s["family_46"]="Guantes";
$s["family_47"]="Collares";
$s["family_48"]="Tocados";
$s["family_49"]="Foulards";
$s["family_50"]="Zapatos";
$s["family_51"]="Estolas";
$s["family_52"]="Shorts";
$s["family_53"]="Boleros";
$s["family_54"]="Cazadoras";
$s["family_55"]="Blazers";
$s["family_56"]="Monos";
$s["family_57"]="Pulseras";
$s["family_58"]="Pendientes";
$s["family_59"]="Capas";
$s["family_60"]="Chaquetones";
$s["family_61"]="Camisas";
$s["family_62"]="Punto";
$s["family_63"]="Sueters";

$s["family_65"]="Conjuntos";
$s["family_69"]="Polos";


include ("include/products.php");
include ("include/stock.php");
include ("include/inbd.php");

$excel_data= "<table><tr><th>Serial Model</th><th>Familia</th><th>Color Code</th><th>Color Name</th><th>Temporada</th><th>Visible</th><th>Stock 1</th><th>Stock 2</th><th>Stock 3</th><th>Stock 4</th><th>Stock 5</th><th>Stock 6</th><th>Stock 7</th><th>Stock 8</th><th>Stock 9</th><th>Stock 10</th><th>Stock 11</th><th>Stock 12</th><th>Total</th><th>Precio</th><th>Precio con Descuento</th><th>% Deescuento</th></tr>";

$table="products";
$products=listInBD($table);
foreach($products as $key=>$product){
	$table="colors";
	$filter=array();
	$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
	$colors=listInBD($table,$filter);
	foreach ($colors as $key=>$color){
		$table="stocks";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
		$stock=getInBD($table,$filter);
		$stock["total"]=0;
		for ($i=1;$i<=12;$i++){
         		$stock["total"]+=$stock["stock_size_".$i];
			$stock[$i]=$stock["stock_size_".$i];
        	}
		$product["season_winter_str"]="SS";
		if($product["season_winter"]==1){
			$product["season_winter_str"]="FW";
		}
                $excel_data.= "<tr><td>".$product["serial_model_code"]."</td><td>".$s["family_".$product["id_family"]]."</td><td>".$product["season_winter_str"]." ".$product["season_year"]."<td>".$color["name_id_color"]."</td><td>".$color["name"]."</td><td>".$product["visible"]."</td><td>".$stock[1]."</td><td>".$stock[2]."</td><td>".$stock[3]."</td><td>".$stock[4]."</td><td>".$stock[5]."</td><td>".$stock[6]."</td><td>".$stock[7]."</td><td>".$stock[8]."</td><td>".$stock[9]."</td><td>".$stock[10]."</td><td>".$stock[11]."</td><td>".$stock[12]."</td><td>".$stock["total"]."</td><td>".$product["pvp"]."</td><td>".round($product["pvp"]*(100-$product["discount"])/100)."</td><td>".$product["discount"]."</td></tr>";

	}
}

/*
$r = listProducts($family);
$excel_data= "<table><tr><th>Serial Model</th><th>Color Code</th><th>Color Name</th><th>Visible</th><th>Stock 1</th><th>Stock 2</th><th>Stock 3</th><th>Stock 4</th><th>Stock 5</th><th>Stock 6</th><th>Stock 7</th><th>Stock 8</th><th>Stock 9</th><th>Stock 10</th><th>Stock 11</th><th>Stock 12</th><th>Total</th></tr>";
while($p = db_fetch($r)) {
	$col = productColors($p["serial_model_code"]);
	$stock_new["total"]=0;
	for ($i=1;$i<=12;$i++){
		$stock_new["total"]+=$stock[$i];
	}
	while($colo = db_fetch($col)) {
		$stock=getStock($p["serial_model_code"],$colo["id_color"]);
		$excel_data.= "<tr><td>".$p["serial_model_code"]."</td><td>".$colo["name_id_color"]."</td><td>".$colo["name"]."</td><td>".$colo["use_color"]."</td><td>".$stock[1]."</td><td>".$stock[2]."</td><td>".$stock[3]."</td><td>".$stock[4]."</td><td>".$stock[5]."</td><td>".$stock[6]."</td><td>".$stock[7];
*/

$excel_data.="</table>";
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $excel_data;
?>
