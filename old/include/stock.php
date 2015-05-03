<?php
/*
 *     select * from vista_alm_existencias_almacen_de_materiales where cod_material='2929'
 */
include_once("bd.php");
if(!isset($manejador)) {
    $manejador = db_connect();
}

function existStock($idproduct,$idcolor) {
    global $manejador;
    global $conf;
    $query="select * from ".$conf["bdprefix"]."stocks where id_product='".$idproduct."' and id_color='".$idcolor."'";
    $res=db_query($query,$manejador);
    if (db_count($res)==0) return false;
    $lin=db_fetch($res);
    return $lin["id_stock"];
}

function checkStock($codser,$colorid) {
    global $manejador;
    global $conf;
    $query="select * from ".$conf["bdprefix"]."stocks where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$colorid."' and serial_model_code='".$codser."')";
    $res=db_query($query,$manejador);
    if (db_count($res)==0) return false;
    $lin=db_fetch($res);
    return $lin["id_stock"];
}

function checkStockWithId($id_product,$colorid) {
    global $manejador;
    global $conf;
    
    $query="select * from ".$conf["bdprefix"]."stocks where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$colorid."' and id_product='".$id_product."')";
    $res=db_query($query,$manejador);
    if (db_count($res)==0) return false;
    $lin=db_fetch($res);
    return $lin["id_stock"];
}

function checkStockWithId2($id_product,$colorid) {
    global $manejador;
    global $conf;
    
    $query = "select p.* from ".$conf["bdprefix"]."colors p where p.id_color=".db_secure_field($colorid,$manejador);
	$r = db_query($query,$manejador);
	$tmp_color=db_fetch($r);
	
	

    $query="select * from ".$conf["bdprefix"]."stocks where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$colorid."' and id_product='".$id_product."')";
    $res=db_query($query,$manejador);
    if (db_count($res)==0) return false;
    $lin=db_fetch($res);
    return $lin["id_stock"];
}

function getStock($codser,$colorid) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."stocks where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$colorid."' and serial_model_code='".$codser."')";
    ////error_log($query);
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    $stock=array();
    for ($i=1;$i<=12;$i++) {
        $stock[$i]=$lin["stock_size_".$i];
    }
    return $stock;    
}
function getStockIdStock($id_stock) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."stocks where id_stock=".db_secure_field($id_stock,$manejador);
    ////error_log($query);
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    $stock=array();
    for ($i=1;$i<=12;$i++) {
        $stock[$i]=$lin["stock_size_".$i];
    }
    return $stock;    
}

function getStockWithId($id_product,$colorid) {
    global $manejador;
    global $conf;

    $query="select * from ".$conf["bdprefix"]."stocks where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$colorid."' and id_product='".$id_product."')";
    ////error_log($query);
    $res=db_query($query,$manejador);
    $lin=db_fetch($res);
    $stock=array();
    for ($i=1;$i<=12;$i++) {
        $stock[$i]=$lin["stock_size_".$i];
    }
    return $stock;    
}



function insertStock($istock) {
    if (sizeof($istock)==0) return false;
    global $manejador;
    global $conf;
    $coma="";
    $colum_names="";
    $values="";
    foreach ($istock as $key=>$value) {
        $colum_names.=$coma.db_secure_field($key,$manejador);
        $values.=$coma."'".db_secure_field($value,$manejador)."'";
        $coma=","; 
    }
    $query="insert into ".$conf["bdprefix"]."stocks (".$colum_names.") VALUES (".$values.")";
    ////error_log($query);
    $r=db_query($query,$manejador);
    return $r;  
}
function updateStock($istock) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."stocks set ";
    $coma="";
    foreach ($istock as $key=>$value) {
        if ($key=="id_stock") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_stock='".$istock["id_stock"]."'";
    ////error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

function reduceStock($reduce_stock, $serial_model_code) {
    global $manejador;
    global $conf;
    
    $old_stock = getStock($serial_model_code,$reduce_stock["id_color"]);
    
    $i=1;
    $query="update ".$conf["bdprefix"]."stocks set ";
    $coma="";
    foreach ($reduce_stock as $key=>$value) {
        if ($key=="id_color") continue;
        $new_stock=$old_stock[$i]-$value;
        $i++;
        $query.=$coma.$key."='".db_secure_field($new_stock,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$reduce_stock["id_color"]."' and serial_model_code='".$serial_model_code."')";
    ////error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

function reduceStockWithId($reduce_stock, $id_product) {
    global $manejador;
    global $conf;
    
    $old_stock = getStockWithId($id_product,$reduce_stock["id_color"]);
    
    $i=1;
    $query="update ".$conf["bdprefix"]."stocks set ";
    $coma="";
    foreach ($reduce_stock as $key=>$value) {
        if ($key=="id_color") continue;
        $new_stock=$old_stock[$i]-$value;
        $i++;
        $query.=$coma.$key."='".db_secure_field($new_stock,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_color=(select id from ".$conf["bdprefix"]."colors where id_color='".$reduce_stock["id_color"]."' and id_product='".$id_product."')";
    ////error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}


function updateStockidColor($istock) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."stocks set ";
    $coma="";
    $id = $istock["id_color"];
    $id_product = $istock["id_product"];
    foreach ($istock as $key=>$value) {
        if ($key=="id_color") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_color=(select id from classic_colors where id_product='".$id_product."' and id_color='".$id."')";
    //error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}
function addStock($istock) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."stocks set ";
    $coma="";
    foreach ($istock as $key=>$value) {
        if ($key=="id_stock") continue;
        $query.=$coma.$key."=".$key."+'".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_stock='".$istock["id_stock"]."'";
    $r=db_query($query,$manejador);
    return $r;
}

function updateAllStock() {
    
}

?>