<?php
/************************************************************************
 *			Libreria de funciones para manejo de familias
 *			Modificado: 09/03/2012 2:52
 ************************************************************************/

include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

/*
 * Funcion que lista todas las familias que contienen productos
 * Parametros:
 *		$order (opcional): campo por el que ordenar el listado.
 *		$limit (opcional): campo que indica el numero de resultados a devolver (Se utiliza para la paginacion por ejemplo)
 *		$start (opcional): campo que indica desde que registro empezar a devolver los resultados. Este campo va obligatoriamente con el campo $limit.
 * Salidas:
 *		$r: recordset con todos los valores a devolver
 */
function listFamilies($order = "name", $limit = 0, $start = 0, $season="") {
	global $manejador;
	global $conf;

	if($season==""){
		$query = "select f.* from ".$conf["bdprefix"]."family f where (select count(*) from ".$conf["bdprefix"]."products where id_family=f.id_family and visible=1 limit 1)>0 order by f.".db_secure_field($order,$manejador);
	}else{
		if($season=="main"){
			$query = "select f.* from ".$conf["bdprefix"]."family f where (select count(*) from ".$conf["bdprefix"]."products where id_family=f.id_family and visible=1 and id_season=27 limit 1)>0 order by f.".db_secure_field($order,$manejador);
		}else{
			$query = "select f.* from ".$conf["bdprefix"]."family f where (select count(*) from ".$conf["bdprefix"]."products where id_family=f.id_family and visible=1 and id_season<>27 limit 1)>0 order by f.".db_secure_field($order,$manejador);
		}
	}
	if($limit!=0) {
		$query .= " limit ".$start.", ".$limit;
	}
	$r = db_query($query,$manejador);
	return $r;
}
function allFamilies() {
	global $manejador;
	global $conf;

	$query = "select f.* from ".$conf["bdprefix"]."family f where 1";

	$r = db_query($query,$manejador);
	return $r;
}
function allSizes() {
	global $manejador;
	global $conf;

	$query = "select s.* from ".$conf["bdprefix"]."sizings s where 1";
	$r = db_query($query,$manejador);
	return $r;
}

?>