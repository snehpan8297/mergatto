<?php
/*
 *     select * from vista_alm_existencias_almacen_de_materiales where cod_material='2929'
 */
include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

function getPromoCode($data) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."promo_codes where id_promo_code=".db_secure_field($data["id_promo_code"],$manejador);
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    return $lin;    
}
function isPromoCode($data) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."promo_codes where codes_left>0 and code='".db_secure_field($data["code"],$manejador)."'";
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    return $lin;    
}
function listPromoCodes() {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."promo_codes where 1";
    $res=db_query($query,$manejador);
    return $res;    
}

function addPromoCode($data) {
    global $manejador;
    global $conf;

    $coma="";
    $colum_names="";
    $values="";
    foreach ($data as $key=>$value) {
        $colum_names.=$coma.db_secure_field($key,$manejador);
        $values.=$coma."'".db_secure_field($value,$manejador)."'";
        $coma=","; 
    }
    $query="insert into ".$conf["bdprefix"]."promo_codes (".$colum_names.") VALUES (".$values.")";
    $r=db_query($query,$manejador);
    return $r;  
}
function updatePromoCode($data) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."promo_codes set ";
    $coma="";
    foreach ($data as $key=>$value) {
        if ($key=="id_promo_code") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_promo_code='".$data["id_promo_code"]."'";
    error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

function deletePromoCode($data) {
    global $manejador;
    global $conf;
  
    $query="delete from ".$conf["bdprefix"]."promo_codes where id_promo_code=".db_secure_field($data["id_promo_code"],$manejador);
    $r=db_query($query,$manejador);
    return $r;
}

function updateAllPromoCode() {
    
}

?>