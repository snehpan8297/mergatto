<?php
include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

function addOrderRequest($request){
	global $manejador;
	global $conf;
	$query = "insert into ".$conf["bdprefix"]."order_request (id_client,date,total,num_clothes,user_comment,invoice_address_name,invoice_address_subname,invoice_address_DNI,invoice_address_address_1,invoice_address_address_2,invoice_address_post_code,invoice_address_city,invoice_address_province,invoice_address_country,invoice_address_mobile,invoice_address_other,shipping_address_name,shipping_address_subname,shipping_address_address_1,shipping_address_address_2,shipping_address_post_code,shipping_address_city,shipping_address_province,shipping_address_country,shipping_address_mobile,shipping_address_other,shipping_method_name,shipping_method_descrip,shipping_method_price,user_type,total_with_discount,discount,promo_code,promo_code_amount,payment_method) VALUES ('".$request["id_client"]."','".$request["date"]."','".$request["total"]."','".$request["num_clothes"]."','".$request["user_comment"]."','".$request["invoice_address_name"]."','".$request["invoice_address_subname"]."','".$request["invoice_address_DNI"]."','".$request["invoice_address_address_1"]."','".$request["invoice_address_address_2"]."','".$request["invoice_address_post_code"]."','".$request["invoice_address_city"]."','".$request["invoice_address_province"]."','".$request["invoice_address_country"]."','".$request["invoice_address_mobile"]."','".$request["invoice_address_other"]."','".$request["shipping_address_name"]."','".$request["shipping_address_subname"]."','".$request["shipping_address_address_1"]."','".$request["shipping_address_address_2"]."','".$request["shipping_address_post_code"]."','".$request["shipping_address_city"]."','".$request["shipping_address_province"]."','".$request["shipping_address_country"]."','".$request["shipping_address_mobile"]."','".$request["shipping_address_other"]."','".$request["shipping_address_method_name"]."','".$request["shipping_address_method_descrip"]."','".$request["shipping_address_method_price"]."','".$request["user_type"]."','".$request["total_with_discount"]."','".$request["discount"]."','".$request["promo_code"]."','".$request["promo_code_amount"]."','".$request["payment_method"]."')";
	
	$r = db_query($query,$manejador);
	return db_last_id();
}
function addOrderLine($line){
	global $manejador;
	global $conf;
	$query = "insert into ".$conf["bdprefix"]."lines_order_request (id_order_request,serial_model_code,id_color,unitary_price,subtotal,subclothes,size_1,size_2,size_3,size_4,size_5,size_6,size_7,size_8,size_9,size_10,size_11,size_12,allsizes) VALUES ('".db_secure_field($line["id_order_request"],$manejador)."','".db_secure_field($line["serial_model_code"],$manejador)."','".db_secure_field($line["id_color"],$manejador)."','".db_secure_field($line["unitary_price"],$manejador)."','".db_secure_field($line["subtotal"],$manejador)."','".db_secure_field($line["subclothes"],$manejador)."','".db_secure_field($line["size_1"],$manejador)."','".db_secure_field($line["size_2"],$manejador)."','".db_secure_field($line["size_3"],$manejador)."','".db_secure_field($line["size_4"],$manejador)."','".db_secure_field($line["size_5"],$manejador)."','".db_secure_field($line["size_6"],$manejador)."','".db_secure_field($line["size_7"],$manejador)."','".db_secure_field($line["size_8"],$manejador)."','".db_secure_field($line["size_9"],$manejador)."','".db_secure_field($line["size_10"],$manejador)."','".db_secure_field($line["size_11"],$manejador)."','".db_secure_field($line["size_12"],$manejador)."','".db_secure_field($line["allsizes"],$manejador)."')";
	//error_log($query);
	$r = db_query($query,$manejador);
	return $r;
}


function addOrderLineWithId($line){
	global $manejador;
	global $conf;
	
	$product = productData($line["id_product"]);
	$line["serial_model_code"]=$product["serial_model_code"];
	
	$query = "insert into ".$conf["bdprefix"]."lines_order_request (id_order_request,serial_model_code,id_product,id_color,unitary_price,subtotal,subclothes,size_1,size_2,size_3,size_4,size_5,size_6,size_7,size_8,size_9,size_10,size_11,size_12,allsizes) VALUES ('".db_secure_field($line["id_order_request"],$manejador)."','".db_secure_field($line["serial_model_code"],$manejador)."','".db_secure_field($line["id_product"],$manejador)."','".db_secure_field($line["id_color"],$manejador)."','".db_secure_field($line["unitary_price"],$manejador)."','".db_secure_field($line["subtotal"],$manejador)."','".db_secure_field($line["subclothes"],$manejador)."','".db_secure_field($line["size_1"],$manejador)."','".db_secure_field($line["size_2"],$manejador)."','".db_secure_field($line["size_3"],$manejador)."','".db_secure_field($line["size_4"],$manejador)."','".db_secure_field($line["size_5"],$manejador)."','".db_secure_field($line["size_6"],$manejador)."','".db_secure_field($line["size_7"],$manejador)."','".db_secure_field($line["size_8"],$manejador)."','".db_secure_field($line["size_9"],$manejador)."','".db_secure_field($line["size_10"],$manejador)."','".db_secure_field($line["size_11"],$manejador)."','".db_secure_field($line["size_12"],$manejador)."','".db_secure_field($line["allsizes"],$manejador)."')";
	//error_log($query);
	$r = db_query($query,$manejador);
	return $r;
}


function listOrders(){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request order by id_order desc";
	$res=db_query($query,$manejador);
	return $res;
}
function listPendingOrders(){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where order_state='0'";
	$res=db_query($query,$manejador);
	return $res;
}
function numPendingOrders(){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where order_state='0'";
	$res=db_query($query,$manejador);
	return db_count($res);
}
function numWaitingOrders($client_code){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where order_state='1' and cod_cli='".db_secure_field($client_code,$manejador)."'";
	$res=db_query($query,$manejador);
	return db_count($res);
}
function numAcceptedWaitingOrders($client_code){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where order_state='2'";
	$res=db_query($query,$manejador);
	return db_count($res);
}
function listMyOrders($id_client){
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where id_client='".db_secure_field($id_client,$manejador)."' order by id_order desc";
	$res=db_query($query,$manejador);
	return $res;
}
function updateOrder($order) {
	global $conf;
	global $manejador;
	$values="";
	$coma="";
	foreach ($order as $key => $value) {
		if ($key=="id_order") continue;
		$values.=$coma.$key."='".db_secure_field($value,$manejador)."'";
		$coma=",";
	}
	$query = "update ".$conf["bdprefix"]."order_request set ".$values." where id_order=" .db_secure_field($order["id_order"],$manejador);
	//error_log($query);
	$res=db_query($query, $manejador);
	return $res;
}
function updateOrderLine($line) {
	global $manejador;
	$values="";
	$coma="";
	foreach ($line as $key=> $value) {
		if ($key=="id_line") continue;
		$values.=$coma.$key."='".db_secure_field($value,$manejador)."'";
		$coma=",";
	}
	$query = "update retailer_lines_order_request set ".$values." where id_line=" . $line["id_line"];
	//error_log($query);
	db_query($query, $manejador);
	return true;
}
function getOrderData($id_order) {
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."order_request where id_order=".db_secure_field($id_order,$manejador);
	$res=db_query($query,$manejador);
	$lin=db_fetch($res);
	return $lin; 
}
function getOrderLines($order) {
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."lines_order_request where id_order_request=".$order;
	$res=db_query($query,$manejador);
	return $res; 
}
function lineData($id_line) {
	global $conf;
	global $manejador;
	$query="select * from ".$conf["bdprefix"]."lines_order_request where id_line=".db_secure_field($id_line,$manejador);
	$res=db_query($query,$manejador);
	$lin=db_fetch($res);
	return $lin; 
}
function deleteOrder($order_code) {
	global $manejador;
	global $conf;

	if(!empty($order_code)) {
		$query = "delete from ".$conf["bdprefix"]."order_request where id_order = '".db_secure_field($order_code,$manejador)."'";
		$r = db_query($query,$manejador);
		$query = "delete from ".$conf["bdprefix"]."lines_order_request where id_order_request = '".db_secure_field($order_code,$manejador)."'";
		$r = db_query($query,$manejador);
		return true;
	}
	return false;
}
function deleteLine($id_line,$vat){
	global $conf;
	global $manejador;
	
	if(!empty($id_line)) {
		$line_tmp=lineData($id_line);
		$order_tmp=getOrderData($line_tmp["id_order_request"]);
		$order_tmp["num_clothes"]=$order_tmp["num_clothes"]-$line_tmp["line_quantity"];
		$order_tmp["subtotal"]=$order_tmp["subtotal"]-$line_tmp["line_quantity"]*$line_tmp["price"];
		$order_tmp["iva"]=$order_tmp["subtotal"]*$vat["iva"];
		$order_tmp["req"]=$order_tmp["subtotal"]*$vat["req"];
		$order_tmp["total"]=$order_tmp["subtotal"]+$order_tmp["iva"]+$order_tmp["req"];
		
		$query="delete from ".$conf["bdprefix"]."lines_order_request where id_line=".db_secure_field($id_line,$manejador);
		$r = db_query($query,$manejador);
		if(updateOrder($order_tmp)){
			echo $order_tmp["subtotal"]."_".$order_tmp["iva"]."_".$order_tmp["req"]."_".$order_tmp["total"]."_".$order_tmp["num_clothes"]."_";
			return true;
		}else{
			return false;
		}
		return $r;
	}
	return false; 
}
function updateLine($id_line,$size,$new_data,$vat){
	global $conf;
	global $manejador;
	
	if(isset($id_line) && isset($size)){
		$line_tmp=lineData($id_line);
		$old_size=$line_tmp["size_".$size];
		$line_tmp["size_".$size]=$new_data;
		$line_tmp["line_quantity"]=$line_tmp["line_quantity"]-$old_size+$new_data;

		$values="";
		$coma="";
		foreach ($line_tmp as $key => $value) {
			if ($key=="id_line") continue;
				$values.=$coma.$key."='".db_secure_field($value,$manejador)."'";
				$coma=",";
			}
		$query = "update ".$conf["bdprefix"]."lines_order_request set ".$values." where id_line=".db_secure_field($id_line,$manejador);
		//error_log($query); 
		$res=db_query($query, $manejador);
		$order_tmp=getOrderData($line_tmp["id_order_request"]);
		$order_tmp["num_clothes"]=$order_tmp["num_clothes"]-$old_size+$new_data;
		$order_tmp["subtotal"]=$order_tmp["subtotal"]-$old_size*$line_tmp["price"]+$new_data*$line_tmp["price"];
		$order_tmp["iva"]=$order_tmp["subtotal"]*$vat["iva"];
		$order_tmp["req"]=$order_tmp["subtotal"]*$vat["req"];
		$order_tmp["total"]=$order_tmp["subtotal"]+$order_tmp["iva"]+$order_tmp["req"];
		
		if(updateOrder($order_tmp)){
		echo ($line_tmp["line_quantity"]*$line_tmp["price"])."_".$order_tmp["subtotal"]."_".$order_tmp["iva"]."_".$order_tmp["req"]."_".$order_tmp["total"]."_".$order_tmp["num_clothes"]."_";
			return true;
		}else{
			return false;
		}
	}
	return false;
}

function getPortageOrder($id_order) {
	global $conf;
	global $manejador;

	$query="select id_line from ".$conf["bdprefix"]."lines_order_request where id_order_request='".$id_order."' and serial_model_code=(select portage_code from ".$conf["bdprefix"]."config where id=1)";
	//error_log($query);
	$res=db_query($query,$manejador);
	if (db_count($res)==0) return false;
	$data1=db_fetch($res);
	return $data1["id_line"];
} 

function getPortageCode() {
	global $conf;
	global $manejador;

	$query="select portage_code from ".$conf["bdprefix"]."config where id=1";
	//error_log($query);
	$res=db_query($query,$manejador);
	if (db_count($res)==0) return false;
	$data1=db_fetch($res);
	return $data1["portage_code"]; 
}
function updatePortage($id_line,$new_data,$vat,$excl=0){
	global $conf;
	global $manejador;
	
	if(isset($id_line)){
		$line_tmp=lineData($id_line);
		$query = "update ".$conf["bdprefix"]."lines_order_request set price=".$new_data." where id_line=".db_secure_field($id_line,$manejador);
		//error_log($query); 
		$res=db_query($query, $manejador);
		$order_tmp=getOrderData($line_tmp["id_order_request"]);
		//$order_tmp["num_clothes"]=$order_tmp["num_clothes"]-$old_size+$new_data;
		if ($excl) $order_tmp["subtotal"]=$order_tmp["subtotal"]+$new_data;
		else $order_tmp["subtotal"]=$order_tmp["subtotal"]-$line_tmp["price"]+$new_data;
		$order_tmp["iva"]=$order_tmp["subtotal"]*$vat["iva"];
		$order_tmp["req"]=$order_tmp["subtotal"]*$vat["req"];
		$order_tmp["total"]=$order_tmp["subtotal"]+$order_tmp["iva"]+$order_tmp["req"];
		
		if(updateOrder($order_tmp)){
		echo $order_tmp["subtotal"]."_".$order_tmp["iva"]."_".$order_tmp["req"]."_".$order_tmp["total"]."_".$order_tmp["num_clothes"]."_";
			return true;
		}else{
			return false;
		}
	}
	
	return false;
}
function deletePortage($id_line){
	global $conf;
	global $manejador;
	
	if(isset($id_line)){
		$line_tmp=lineData($id_line);
		$query = "delete from ".$conf["bdprefix"]."lines_order_request where id_line=".db_secure_field($id_line,$manejador);
		//error_log($query); 
		$res=db_query($query, $manejador);
		$order_tmp=getOrderData($line_tmp["id_order_request"]);
		//$order_tmp["num_clothes"]=$order_tmp["num_clothes"]-$old_size+$new_data;
		$order_tmp["subtotal"]=$order_tmp["subtotal"]-$line_tmp["price"];
		$order_tmp["iva"]=$order_tmp["subtotal"]*$vat["iva"];
		$order_tmp["req"]=$order_tmp["subtotal"]*$vat["req"];
		$order_tmp["total"]=$order_tmp["subtotal"]+$order_tmp["iva"]+$order_tmp["req"];
		
		if(updateOrder($order_tmp)){
		echo ($line_tmp["line_quantity"]*$line_tmp["price"])."_".$order_tmp["subtotal"]."_".$order_tmp["iva"]."_".$order_tmp["req"]."_".$order_tmp["total"]."_".$order_tmp["num_clothes"]."_";
			return true;
		}else{
			return false;
		}
	}
	
	return false;
}


//"Shipping method" functions
//---------------------------
//Get "shipping method" data
function getShipping($id) {
	global $conf;
	global $manejador;

	$query = "select * from ".$conf["bdprefix"]."shipping";
	if($id > 0) {
		$query .= " where id=".$id;
	}
	$query .= " order by id";
	$res = db_query($query,$manejador);
	if(db_count($res) == 0) {
		return false;
	}
	return $res;
}

//Insert new "shipping method"
function addShipping($ship) {
	global $conf;
	global $manejador;

	$query = "insert into ".$conf["bdprefix"]."shipping values(0,'".$ship["name_es"]."','".$ship["name_en"]."','".$ship["descrip_es"]."','".$ship["descrip_en"]."','".$ship["price_es"]."',".$ship["price_type"].",".$ship["price_interval"].",".$ship["price_min"].",".$ship["price_max"].",".$ship["country_include"].",".$ship["country"].",".$ship["province_include"].",".$ship["province"].")";
	$res = db_query($query,$manejador);
	return $res;
}

//Update "shipping method" data
function updateShipping($ship) {
	global $conf;
	global $manejador;

	$query = "update ".$conf["bdprefix"]."shipping set";
	$coma = "";
	foreach($ship as $k => $v) {
		if($k != "id") {
			$query .= $coma." ".$k."='".$v."'";
			$coma = ",";
		}
	}
	$query .= " where id=".$ship["id"];
echo $query;
	$res = db_query($query,$manejador);
	return $res;
}

//Delete "shipping method"
function deleteShipping($id) {
	global $conf;
	global $manejador;

	$query = "delete from ".$conf["bdprefix"]."shipping where id=".$id;
	$res = db_query($query,$manejador);
	return $res;
}

function duplicateOrder($id_old_order){
	$new_order=getOrderData($id_old_order);
	unset($new_order["id_order"]);
	$new_order["order_state"]=0;
	$new_order["id_order"]=addOrderRequest($new_order);
	$res=updateOrder($new_order);
	$new_order_lines=getOrderLines($id_old_order);
	deleteOrder($id_old_order);
	
	while($new_order_line=db_fetch($new_order_lines)){
		$new_order_line["id_order_request"]=$new_order["id_order"];
		$new_order_line["id_order_line"]=addOrderLine($new_order_line);
	}
	
	return $new_order;
}


?>