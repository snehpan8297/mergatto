<?php


include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}


function listPayments() {
	global $manejador;
	global $conf;
	$query = "select p.* from ".$conf["bdprefix"]."payments p order by p.created desc";
	$r = db_query($query,$manejador);
	return $r;
}


function listMyPayments($client_code) {
	global $manejador;
	global $conf;
	$query = "select p.* from ".$conf["bdprefix"]."payments p where p.client_code='".db_secure_field($client_code,$manejador)."' order by p.created desc";
	$r = db_query($query,$manejador);
	return $r;
}
function numMyNewPayments($client_code) {
	global $manejador;
	global $conf;
	$query = "select p.* from ".$conf["bdprefix"]."payments p where p.client_code='".db_secure_field($client_code,$manejador)."' and p.is_payed='0'";
	$res=db_query($query,$manejador);
    return db_count($res);
}

function paymentData($idpayment) {
	global $manejador;
	global $conf;

	if(!empty($idpayment)) {
		$query = "select p.* from ".$conf["bdprefix"]."payments p where p.id_payment=".db_secure_field($idpayment,$manejador);
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}
function paymentDataUser($payment) {
	global $manejador;
	global $conf;

	if(isset($payment)) {
		$query = "select p.* from ".$conf["bdprefix"]."payments p where p.client_code='".db_secure_field($payment["client_code"],$manejador)."' and p.id_order_final='".db_secure_field($payment["id_order_final"],$manejador)."' and p.payment_code='".db_secure_field($payment["payment_code"],$manejador)."' and is_payed='0'";
		$r = db_query($query,$manejador);
		return db_fetch($r);
	}
}
function deletePayment($idpayment) {
	global $manejador;
	global $conf;

	if(!empty($idpayment)) {
		$query = "delete from ".$conf["bdprefix"]."payments where id_payment=".db_secure_field($idpayment,$manejador);
		$r = db_query($query,$manejador);
		return $r;
	}
	return false;
}

function updatePayment($payment) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."payments set ";
    $coma="";
    foreach ($payment as $key=>$value) {
        if ($key=="id_payment") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_payment='".$payment["id_payment"]."'";
	error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

function payPayment($payment) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."payments set is_payed='1' where client_code='".$payment["client_code"]."' and id_order_final='".$payment["id_order_final"]."'";
	error_log($query);
	echo $query;
    $r=db_query($query,$manejador);
    return $r;
}


function existPayment($payment){
    global $manejador;
    global $conf;
	$query = "select p.* from ".$conf["bdprefix"]."payments p where p.client_code='".db_secure_field($payment["client_code"],$manejador)."' and p.id_order_final='".db_secure_field($payment["id_order_final"],$manejador)."'";
	$r = db_query($query,$manejador);
	if(db_count($r) > 0) {
		return true;
	}else{
		return false;
	}
}
function existPaymentCode($payment){
    global $manejador;
    global $conf;
	$query = "select p.* from ".$conf["bdprefix"]."payments p where p.client_code='".db_secure_field($payment["client_code"],$manejador)."' and p.id_order_final='".db_secure_field($payment["id_order_final"],$manejador)."' and p.payment_code='".db_secure_field($payment["payment_code"],$manejador)."' and is_payed='0'";
	$r = db_query($query,$manejador);
	if(db_count($r) > 0) {
		return true;
	}else{
		return false;
	}
}
function addPayment($payment) {
    global $manejador;
    global $conf;
	$coma="";
	if (!existPayment($payment)){
		foreach ($payment as $key=>$value) {
			$colum_names.=$coma.db_secure_field($key,$manejador);
			$values.=$coma."'".db_secure_field($value,$manejador)."'";
			$coma=","; 
		}
		$query="insert into ".$conf["bdprefix"]."payments (".$colum_names.") VALUES (".$values.")";
	
		error_log($query);
		$r=db_query($query,$manejador);
   		return $r;	
	}
	return 0;

}



?>