<?php
/************************************************************************
 *			Libreria de funciones para manejo de usuarios
 *			Modificado: 09/03/2012 2:52
 ************************************************************************/
include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}
/*
 * Funcion que lista todos los productos de una familia
 * Parametros:
 *		$family: id de familia
 *		$order (opcional): campo por el que ordenar el listado.
 *		$limit (opcional): campo que indica el numero de resultados a devolver (Se utiliza para la paginacion por ejemplo)
 *		$start (opcional): campo que indica desde que registro empezar a devolver los resultados. Este campo va obligatoriamente con el campo $limit.
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
	$no_clothes_display = array(33);
	$accesories_families=array(26,29,41,46,47,48,49,50,51,57,58);

function listProducts($family, $order = " p.season_winter asc, p.season_year desc, p.serial_model_code", $limit = 0, $start = 0,$old_season = 0) {
	global $manejador;
	global $conf;
	global $no_clothes_display;
	global $accesories_families;
	global $_GET;
	
	if ($family=='all'){
		$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products p order by ".db_secure_field($order,$manejador);
	}else if($family=="all_visible"){
		$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products p where p.visible='1'";
		foreach ($no_clothes_display as $key=>$value){
			$query .=" and p.id_family!=".$value;
		}
		foreach ($accesories_families as $key=>$value){
			$query .=" and p.id_family!=".$value;
		}
		$query .=" order by ".db_secure_field($order,$manejador);
	}else if($family=="index"){
		$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products p where p.cover='1' order by rand(".time()." * ". time().")";
	}else if($family=="by_size"){
		$query_old = "SELECT DISTINCT p . * , (SELECT id_image FROM ".$conf["bdprefix"]."image_products ip WHERE ip.id_product = p.id_product ORDER BY imgorder LIMIT 1 ) AS id_image FROM ".$conf["bdprefix"]."products as p INNER JOIN ".$conf["bdprefix"]."stocks AS s ON p.id_product = s.id_product WHERE s.stock_size_".$_GET["t"]." >0 AND  p.visible='1' ORDER BY ".db_secure_field($order,$manejador);
		$query = "SELECT DISTINCT p . * , (SELECT id_image FROM ".$conf["bdprefix"]."image_products ip WHERE ip.id_product = p.id_product ORDER BY imgorder LIMIT 1 ) AS id_image FROM ".$conf["bdprefix"]."products as p, ".$conf["bdprefix"]."stocks AS s, ".$conf["bdprefix"]."categories AS c  WHERE p.id_product = s.id_product and s.stock_size_".$_GET["t"]." >0 AND  p.visible='1'  AND  p.id_category=c.id_category AND c.id_client_group=0 and p.sizable=1 ORDER BY ".db_secure_field($order,$manejador);
	}else{
		$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products p where p.id_family=".$family." and p.visible='1' and p.id_client_group=0 order by ".db_secure_field($order,$manejador);
	}
	if($limit!=0) {
		$query .= " limit ".$start.", ".$limit;
	}
	$r = db_query($query,$manejador);
	return $r;
}

function listProductsSubfamily($subfamily, $order = " p.season_winter asc, p.season_year desc, p.serial_model_code", $limit = 0, $start = 0,$old_season = 0) {
	global $manejador;
	global $conf;
	global $no_clothes_display;
	global $accesories_families;
	global $_GET;
	
	$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products p where p.id_subfamily=".$subfamily["id_subfamily"]." and p.visible='1' order by ".db_secure_field($order,$manejador);
	
	if($limit!=0) {
		$query .= " limit ".$start.", ".$limit;
	}
	$r = db_query($query,$manejador);
	return $r;
}



/*
 * Funcion que lista todos los productos de una familia
 * Parametros:
 *		$family: id de familia
 *		$order (opcional): campo por el que ordenar el listado.
 *		$limit (opcional): campo que indica el numero de resultados a devolver (Se utiliza para la paginacion por ejemplo)
 *		$start (opcional): campo que indica desde que registro empezar a devolver los resultados. Este campo va obligatoriamente con el campo $limit.
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
function searchProducts($search_input, $lang = "es", $limit = 0, $start = 0,$old_season=0,$order = "p.season_winter asc, p.season_year desc, p.serial_model_code") {
	global $manejador;
	global $conf;

	$query = "select p.*,(select id_image from ".$conf["bdprefix"]."image_products ip where ip.id_product=p.id_product order by imgorder limit 1) as id_image from ".$conf["bdprefix"]."products as p,  ".$conf["bdprefix"]."categories as c where (p.serial_model_code like '%".$search_input."%' or p.name_es like '%".$search_input."%' or  p.name_en like '%".$search_input."%') and p.visible='1' and c.id_client_group=0 and p.id_category=c.id_category order by ".db_secure_field($order,$manejador);
	if($limit!=0) {
		$query .= " limit ".$start.", ".$limit;
	}
	$r = db_query($query,$manejador);
	return $r;
}

/*
 * Funcion que devuelve todos los datos de un producto
 * Parametros:
 * 		$idproduct: id del producto que se busca
 * Salidas:
 *		db_fetch($r): array asociativo con todos los campos del producto encontrado
 */
function productData($idproduct) {
	global $manejador;
	global $conf;

	if(!empty($idproduct)) {
		$query = "select p.* from ".$conf["bdprefix"]."products p where p.id_product=".db_secure_field($idproduct,$manejador);
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}

function addProduct($product){
	global $manejador;
	global $conf;
	$query = "insert into ".$conf["bdprefix"]."products (serial_model_code, web_serial_model_code, id_family, id_sizing, description_es, name_es, pvp, id_lavado, id_lejiado, id_planchado, id_lavado_seco, id_secado, composition_es, visible, name_en, description_en, composition_en, season_winter, season_year, use_discount, discount) VALUES ('".db_secure_field($product["serial_model_code"],$manejador)."','".db_secure_field($product["web_serial_model_code"],$manejador)."','".db_secure_field($product["id_family"],$manejador)."','".db_secure_field($product["id_subfamily"],$manejador)."','".db_secure_field($product["id_sizing"],$manejador)."','".db_secure_field($product["description_es"],$manejador)."','".db_secure_field($product["name_es"],$manejador)."','".db_secure_field($product["pvp"],$manejador)."','".db_secure_field($product["id_lavado"],$manejador)."','".db_secure_field($product["id_lejiado"],$manejador)."','".db_secure_field($product["id_planchado"],$manejador)."','".db_secure_field($product["id_lavado_seco"],$manejador)."','".db_secure_field($product["id_secado"],$manejador)."','".db_secure_field($product["composition_es"],$manejador)."','".db_secure_field($product["visible"],$manejador)."','".db_secure_field($product["name_en"],$manejador)."','".db_secure_field($product["description_en"],$manejador)."','".db_secure_field($product["composition_en"],$manejador)."','".db_secure_field($product["season_winter"],$manejador)."','".db_secure_field($product["season_year"],$manejador)."','".db_secure_field($product["use_discount"],$manejador)."','".db_secure_field($product["discount"],$manejador)."')";
	//error_log($query);
	$r = db_query($query,$manejador);
	return db_last_id();
}

function nextProduct($product, $order = "p.serial_model_code asc") {
	global $manejador;
	global $conf;

	if(!empty($product["serial_model_code"])) {
		$query = "select p.* from ".$conf["bdprefix"]."products p where serial_model_code>'".db_secure_field($product["serial_model_code"],$manejador)."' order by ".db_secure_field($order,$manejador)." limit 0,1";
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}
function prevProduct($product, $order = "p.serial_model_code desc") {
	global $manejador;
	global $conf;

	if(!empty($product["serial_model_code"])) {
		$query = "select p.* from ".$conf["bdprefix"]."products p where serial_model_code<'".db_secure_field($product["serial_model_code"],$manejador)."' order by ".db_secure_field($order,$manejador)." limit 0,1";
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}

function nextProductFamily($family, $limit = 0, $start = 0, $order = "p.season_winter asc, p.season_year desc, p.serial_model_code") {
	global $manejador;
	global $conf;
	global $no_clothes_display;
	global $accesories_families;
	global $_GET;

	if(!empty($family)) {
		$query = "select p.id_product from ".$conf["bdprefix"]."products p where";
		if($family == "all_visible") {
			$query .= " p.visible=1";
			foreach ($no_clothes_display as $key=>$value){
				$query .=" and p.id_family!=".$value;
			}
			foreach ($accesories_families as $key=>$value){
				$query .=" and p.id_family!=".$value;
			}
		} else if($family == "index") {
			$query .= " p.cover=1";
		} else {
			$query .= " p.visible=1 and p.id_family=".db_secure_field($family,$manejador);
		}
		$query .= " and (SELECT sum(s.stock_size_1+s.stock_size_2+s.stock_size_3+s.stock_size_4+s.stock_size_5+s.stock_size_6+s.stock_size_7+s.stock_size_8) from ".$conf["bdprefix"]."stocks s where s.id_product=p.id_product group by p.id_product)>0";
		$query .= " order by ".db_secure_field($order,$manejador);
		if($family=="by_size"){
			if((isset($_GET["t"]))&&(!empty($_GET["t"]))){
			$query = "SELECT DISTINCT p . * , (SELECT id_image FROM ".$conf["bdprefix"]."image_products ip WHERE ip.id_product = p.id_product ORDER BY imgorder LIMIT 1 ) AS id_image FROM ".$conf["bdprefix"]."products as p, ".$conf["bdprefix"]."stocks AS s, ".$conf["bdprefix"]."categories AS c  WHERE p.id_product = s.id_product and s.stock_size_".$_GET["t"]." >0 AND  p.visible='1'  AND  p.id_category=c.id_category AND c.id_client_group=0 and p.sizable=1 ORDER BY ".db_secure_field($order,$manejador);
			
			}else{
				$query = "SELECT DISTINCT p . * , (SELECT id_image FROM ".$conf["bdprefix"]."image_products ip WHERE ip.id_product = p.id_product ORDER BY imgorder LIMIT 1 ) AS id_image FROM ".$conf["bdprefix"]."products p INNER JOIN ".$conf["bdprefix"]."stocks AS s ON p.id_product = s.id_product WHERE p.visible='1' ORDER BY ".db_secure_field($order,$manejador);
			}
			
		}
		if($limit != 0) {
			$query .= " limit ".$start.", ".$limit;
		}

		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}
function nextProductSearch($search_input, $limit = 0, $start = 0, $order = "p.season_winter asc, p.season_year desc, p.serial_model_code") {
	global $manejador;
	global $conf;
	global $lang;

	if(!empty($search_input)) {
		$query = "select p.id_product from ".$conf["bdprefix"]."products p where p.visible=1 and (p.serial_model_code like '%".$search_input."%' or p.name_es like '%".$search_input."%' or  p.name_en like '%".$search_input."%')";
		$query .= " and (SELECT sum(s.stock_size_1+s.stock_size_2+s.stock_size_3+s.stock_size_4+s.stock_size_5+s.stock_size_6+s.stock_size_7+s.stock_size_8) from ".$conf["bdprefix"]."stocks s where s.id_product=p.id_product group by p.id_product)>0";
		$query .= " order by ".db_secure_field($order,$manejador);
		if($limit != 0) {
			$query .= " limit ".$start.", ".$limit;
		}
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}

function productDataFromSerialModel($idproduct) {
	global $manejador;
	global $conf;

	if(!empty($idproduct)) {
		$query = "select p.* from ".$conf["bdprefix"]."products p where p.serial_model_code='".db_secure_field($idproduct,$manejador)."'";
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}

/*
 * Funcion que devuelve todas las imagenes de un producto
 * Parametros:
 * 		$idproduct: id del producto que se busca
 * 		$limit: numero de imagenes a devolver
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
function productImages($idproduct, $limit=0) {
	global $manejador;
	global $conf;

	if(!empty($idproduct)) {
		$query = "select ip.* from ".$conf["bdprefix"]."image_products ip where ip.id_product=".db_secure_field($idproduct,$manejador)." order by imgorder";
		if($limit != 0) {
			$query .= " limit ".$limit;
		}
		$r = db_query($query,$manejador);
		return $r;
	}
}

/*
 * Funcion que devuelve las tallas disponibles de un producto
 * Parametros:
 * 		$idsizing: id del tipo de tallas que se busca
 * Salidas:
 *		db_fetch($r): array asociativo con todos los campos
 */
function productSizes($idsizing) {
	global $manejador;
	global $conf;

	if(!empty($idsizing)) {
		$query = "select s.* from ".$conf["bdprefix"]."sizings s where s.id_sizing=".db_secure_field($idsizing,$manejador);
		$r = db_query($query,$manejador);
		return db_fetch($r,MYSQL_NUM);
	}
}

/*
 * Funcion que devuelve todos los colores de un producto
 * Parametros:
 * 		$product_serial: numero de serie del producto que se busca
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
function productColors($product_serial) {
	global $manejador;
	global $conf;

	if(!empty($product_serial)) {
		$query = "select c.* from ".$conf["bdprefix"]."colors c where c.serial_model_code='".db_secure_field($product_serial,$manejador)."'";
		$r = db_query($query,$manejador);
		return $r;
	}
}

/*
 * Funcion que devuelve todos los colores de un producto
 * Parametros:
 * 		$product_serial: numero de serie del producto que se busca
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
function productColorsWithId($id_product) {
	global $manejador;
	global $conf;

	if(!empty($id_product)) {
		$query = "select c.* from ".$conf["bdprefix"]."colors c where c.id_product='".db_secure_field($id_product,$manejador)."'";
		
		$r = db_query($query,$manejador);
		return $r;
	}
}

/*
 * Funcion que devuelve los datos de una moneda
 * Parametros:
 * 		$idcurrency: id de la moneda que se busca
 * Salidas:
 *		db_fetch($r): array asociativo con todos los campos de la moneda encontrada
 */
function currencies($idcurrency) {
	global $manejador;
	global $conf;

	if(!empty($idcurrency)) {
		$query = "select c.* from ".$conf["bdprefix"]."currencies c where c.id_currency=".db_secure_field($idcurrency,$manejador);
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}

function getColorName($idcolor) {
	global $manejador;
	global $conf;

	if(!empty($idcolor)) {
		$query = "select c.name from ".$conf["bdprefix"]."colors c where c.id_color='".db_secure_field($idcolor,$manejador)."'";
		$r = db_query($query,$manejador);
		$colordata=db_fetch($r);
		return $colordata["name"];
	}
}

function updateProduct($product) {
	global $manejador;
	global $conf;
	$query = "update ".$conf["bdprefix"]."products set ";
	$coma = "";
	foreach($product as $key=>$value) {
		if($key=="id_product") {
			continue;
		}
		$query .= $coma.$key."='".db_secure_field($value,$manejador)."'";
		$coma = ",";
	}
	$query.=" where id_product='".$product["id_product"]."'";
	//error_log($query);
	$r=db_query($query,$manejador);
	return $r;
}

function deleteProduct($id_product) {
	global $manejador;
	global $conf;

	if(!empty($id_product)) {
		$query = "delete from ".$conf["bdprefix"]."colors where id_product = '".db_secure_field($id_product,$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."stocks where id_product = '".db_secure_field($id_product,$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."images where id_product = '".db_secure_field($id_product,$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."image_products where id_product = '".db_secure_field($id_product,$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."products where id_product = '".db_secure_field($id_product,$manejador)."'";
		$r = db_query($query,$manejador);
		return $r;
	}
	return false;
}

function deleteImage($image) {
	global $manejador;
	global $conf;

	if(!empty($image["id_image"])) {
		$query = "delete from ".$conf["bdprefix"]."images where id_image = '".db_secure_field($image["id_image"],$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."image_products where id_image = '".db_secure_field($image["id_image"],$manejador)."'";
		$r = db_query($query,$manejador);
		return $r;
	}
	return false;
}

function listImages($product) {
	global $manejador;
	global $conf;

	$query = "select * from ".$conf["bdprefix"]."image_products where id_product = '".db_secure_field($product["id_product"],$manejador)."' order by imgorder";
	$r = db_query($query,$manejador);
	$images = Array();
	$i=0;
	while($image=db_fetch($r)){
		$images[$i]=$image;
		$i++;
	}
	return $images;
}

?>
