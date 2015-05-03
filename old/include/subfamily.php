<?php
/*
 *     select * from vista_alm_existencias_almacen_de_materiales where cod_material='2929'
 */
include_once("bd.php");
if(!isset($manejador)) {
    $manejador = db_connect();
}

function getSubfamily($data) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."subfamily where id_subfamily=".db_secure_field($data["id_subfamily"],$manejador);
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    return $lin;    
}
function listSubfamily($data) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."subfamily where ";
    if ($data["id_family"]=="all"){
	    $query.="1";
    }else{
	 $query.="id_family=".db_secure_field($data["id_family"],$manejador);   
    }
    error_log($query);
    $res=db_query($query,$manejador);
    return $res;    
}

function countSubfamilyProducts($data) {
    global $manejador;
    global $conf;

    $query="select count(*)  from ".$conf["bdprefix"]."products where id_subfamily=".db_secure_field($data["id_subfamily"],$manejador);   
    error_log($query);
    $res=db_query($query,$manejador);
    
    return db_count($res);    
}

function addSubfamily($data) {
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
    $query="insert into ".$conf["bdprefix"]."subfamily (".$colum_names.") VALUES (".$values.")";
    $r=db_query($query,$manejador);
    return $r;  
}
function updateSubfamily($data) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."subfamily set ";
    $coma="";
    foreach ($data as $key=>$value) {
        if ($key=="id_subfamily") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_subfamily='".$data["id_subfamily"]."'";
    $r=db_query($query,$manejador);
    return $r;
}

function deleteSubfamily($data) {
     global $manejador;
    global $conf;
        $query="delete from ".$conf["bdprefix"]."subfamily where id_subfamily=".db_secure_field($data["id_subfamily"],$manejador);
    $r=db_query($query,$manejador);
    return $r;
}

function updateAllSubfamily() {
    
}

?>