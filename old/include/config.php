<?php
include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}
function getConfig() {
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."config";
	$res=db_query($query,$manejador);
	return db_fetch($res);
}

function setConfig($config) {
	global $manejador;
	global $conf;
	$values="";
	$coma="";
	foreach ($config as $key => $value) {
		$values.=$coma.$key."='".db_secure_field($value,$manejador)."'";
		$coma=",";
	}
	$query = "update ".$conf["bdprefix"]."config set ".$values." where id=1";
	error_log($query); 
	$res=db_query($query, $manejador); 
	return $res;
}
?>