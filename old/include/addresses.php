<?php
/************************************************************************
 *			Libreria de funciones para manejo de usuarios
 *			Modificado: 09/03/2012 2:52
 ************************************************************************/

include_once("bd.php");
//include_once("../include/front_settings.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

/*
 * Funcion que comprueba si un codigo de cliente y un cif estan en la base de datos y si coinciden con un usuario activo.
 * Parametros:
 *		$codcli: nombre de usuario que tiene que coincidir exactamente con uno de la base de datos.
 *		$cifcli: contraseña correspondiente al nombre de usuario que tiene que coincidir exactamente con la asociada a ese nombre de usuario.
 *		$remember (opcional): 0 el usuario solo es recordado en la sesion activa, 1 el usuario es recordado mediante cookies 1 semana
 * Salidas:
 *		0: login fail.
 *		1: login ok.
 *		2: login ok, usuario no activo.
 */


function deleteAddress($id_address){
	global $manejador;
	global $conf;
	if(!empty($id_address)){
		$query = "delete from ".$conf["bdprefix"]."addresses where id_address = ".db_secure_field($id_address,$manejador);
		$r = db_query($query,$manejador);
		return 1;
	}
	return 0;
}
function listAddresses($user) {
    global $manejador;
    global $conf;
    $query="select * from ".$conf["bdprefix"]."addresses where id_client = '".db_secure_field($user["id_client"],$manejador)."'";
    $r1=db_query($query,$manejador);
    return $r1;
}

function addAddress($address) {
    global $manejador;
    global $conf;
	$query = "insert into ".$conf["bdprefix"]."addresses (id_client,name,subname,address_1,address_2,post_code,city,province,country,mobile,other) VALUES('".db_secure_field($address['id_client'],$manejador)."','".db_secure_field($address['name'],$manejador)."','".db_secure_field($address['subname'],$manejador)."','".db_secure_field($address['address_1'],$manejador)."','".db_secure_field($address['address_2'],$manejador)."','".db_secure_field($address['post_code'],$manejador)."','".db_secure_field($address['city'],$manejador)."','".db_secure_field($address['province'],$manejador)."',".db_secure_field($address['country'],$manejador).",'".db_secure_field($address['mobile'],$manejador)."','".db_secure_field($address['other'],$manejador)."')";
    $r=db_query($query,$manejador);
    return $r;
}

function addressData($user,$id_address) {
    global $manejador;
    global $conf;
    $query="select * from ".$conf["bdprefix"]."addresses where id_client = '".db_secure_field($user["id_client"],$manejador)."' and id_address='".db_secure_field($id_address,$manejador)."'";
    $r=db_query($query,$manejador);
    if(db_count($r) > 0) {
			return db_fetch($r);
		}
}

function updateAddress($address) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."addresses set ";
    $coma="";
    foreach ($address as $key=>$value) {
        if ($key=="id_address") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_address=".$address["id_address"];
    error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

?>