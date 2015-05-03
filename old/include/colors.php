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
 * Funcion que devuelve todos los datos de un producto
 * Parametros:
 * 		$idproduct: id del producto que se busca
 * Salidas:
 *		db_fetch($r): array asociativo con todos los campos del producto encontrado
 */
function colorData($idcolor) {
	global $manejador;
	global $conf;

	if(!empty($idcolor)) {
		$query = "select p.* from ".$conf["bdprefix"]."colors p where p.id_color=".db_secure_field($idcolor,$manejador);
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}
function addNewColor($serial_model_code,$id_product) {
	global $manejador;
	global $conf;

		$query = "insert into ".$conf["bdprefix"]."colors (serial_model_code) VALUES ('".db_secure_field($serial_model_code,$manejador)."')";
		$r = db_query($query,$manejador);
		$id = db_last_id();
		$color["id"] = $id;
		$color["id_color"]=999000000+$id;
		$color["use_color"] = 0;
		$color["name_id_color"] = 0;
		$color["name"] = "noname";
		$color["name_es"] = "noname";
		$color["name_en"] = "noname";
		$color["has_image"] = 0;

		$query="update ".$conf["bdprefix"]."colors set ";
    	$coma="";
    	foreach ($color as $key=>$value) {
       		if ($key=="id") continue;
        	$query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        	$coma=",";
    	}
    	$query.=" where id='".$color["id"]."'";
		//error_log($query);
    	$r=db_query($query,$manejador);
    	$query = "insert into ".$conf["bdprefix"]."stocks (id_product,id_color,stock_size_1,stock_size_2,stock_size_3,stock_size_4,stock_size_5,stock_size_6,stock_size_7,stock_size_8,stock_size_9,stock_size_10,stock_size_11,stock_size_12) VALUES ('".db_secure_field($id_product,$manejador)."','".db_secure_field($color["id"],$manejador)."','0','0','0','0','0','0','0','0','0','0','0','0')";
    	$r=db_query($query,$manejador);

    	return $color["id_color"];

}

function addNewColorWithId($serial_model_code,$id_product) {
	global $manejador;
	global $conf;

		$query = "insert into ".$conf["bdprefix"]."colors (serial_model_code,id_product) VALUES ('".db_secure_field($serial_model_code,$manejador)."','".db_secure_field($id_product,$manejador)."')";
		$r = db_query($query,$manejador);
		$id = db_last_id();
		$color["id"] = $id;
		$color["id_color"]=999000000+$id;
		$color["use_color"] = 0;
		$color["name_id_color"] = 0;
		$color["name"] = "noname";
		$color["name_es"] = "noname";
		$color["name_en"] = "noname";
		$color["has_image"] = 0;

		$query="update ".$conf["bdprefix"]."colors set ";
    	$coma="";
    	foreach ($color as $key=>$value) {
       		if ($key=="id") continue;
        	$query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        	$coma=",";
    	}
    	$query.=" where id='".$color["id"]."'";
		//error_log($query);
    	$r=db_query($query,$manejador);
    	$query = "insert into ".$conf["bdprefix"]."stocks (id_product,id_color,stock_size_1,stock_size_2,stock_size_3,stock_size_4,stock_size_5,stock_size_6,stock_size_7,stock_size_8,stock_size_9,stock_size_10,stock_size_11,stock_size_12) VALUES ('".db_secure_field($id_product,$manejador)."','".db_secure_field($color["id"],$manejador)."','0','0','0','0','0','0','0','0','0','0','0','0')";
    	$r=db_query($query,$manejador);

    	return $color["id_color"];

}



function getAllColorImages() {
	global $manejador;
    global $conf;
    $query = "select id_image from ".$conf["bdprefix"]."image_colors";
    $res=db_query($query, $manejador); 
	while ($s2 = db_fetch($res)) {
		$images[]["id"] = $s2["id_image"];
	}
	return $images;
}

function  updateColor($color){
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."colors set ";
    $coma="";
    foreach ($color as $key=>$value) {
        if ($key=="id_color") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_color='".$color["id_color"]."'";
	//error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}
?>