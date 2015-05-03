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
 * Salidas:
 */
function loginEmail($email, $pass, $remember = 0) {
	global $manejador;
	global $conf;

	if(!empty($email) && !empty($pass)) {
		$query = "select web_active, id_client, name from ".$conf["bdprefix"]."clients where email = '".db_secure_field($email,$manejador)."' and password like '".db_secure_field(md5($pass),$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			if(db_result($r,0) == 1) {
				$u = array('id_client' => db_result($r,1));
				$user_login["id_client"] = $u["id_client"];
				$user_login["last_login"] = date("Y-m-d H:i:s",strtotime("now"));
				$user_login["lang"] ='en';
				if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
					$user_login["lang"] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
				}
				if($user_login["lang"] != "es") {
					$user_login["lang"]="en";
				}
				
				
				$r = updateUser($user_login);
				$_SESSION['user_classics'] = $u;
				if(!isset($_SESSION['cart_classics'])) {
					$_SESSION['cart_classics'] = array();
				}
				if($remember == 1) {
					setcookie("id_client_classics", $_SESSION['user_classics']['id_client'], time()+60*60*24*7); //7 dias
				}
				return 1;
			} else {
				return 3;
			}
		}
	}
	return 0;
}

/*
 * Funcion que activa un usuario
 * Parametros:
 *		$user: array de datos del usuario
 *		$user['code']: client_code del usuario a activar
 *		$user['mail']: email del usuario
 *		$user['remail']: repeticion del email del usuario para hacer comprobacion
 * Salidas:
 *		true: ok.
 *		false: fail.
 */
function accessRequest($user) {
	global $manejador;
	global $conf;
	if(!empty($user["email"]) && !empty($user["password"]) &&  $user["password"]===$user["repassword"]) {
		$query = "select * from ".$conf["bdprefix"]."clients where email = '".db_secure_field($user["email"],$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) == 0) {
			$query = "insert into ".$conf["bdprefix"]."clients (password,email,web_active) VALUES('".db_secure_field(md5($user["password"]),$manejador)."','".db_secure_field($user["email"],$manejador)."','1')";
			//error_log($query);
			$r = db_query($query,$manejador);
			$key = md5($user["email"]);
			$query = "insert into ".$conf["bdprefix"]."signup_token (token,email) VALUES('".db_secure_field($key,$manejador)."','".db_secure_field($user["email"],$manejador)."')";
			$r = db_query($query,$manejador);
			include("./functions/welcome_email.php");
			return 2;
		} else {
			$d = db_fetch($r);
			if($d["web_active"]==1) {
				return 1;
			} else {
				return 3;
			}
		}
	}
	return 0;
}

function activation($email,$key){
	global $manejador;
	global $conf;
	if(!empty($email)&&!empty($key)){
		$query = "select * from ".$conf["bdprefix"]."signup_token where email = '".db_secure_field($email,$manejador)."' and token = '".db_secure_field($key,$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			$query = "delete from ".$conf["bdprefix"]."signup_token where email = '".db_secure_field($email,$manejador)."'";
			$r = db_query($query,$manejador);
			$query="update ".$conf["bdprefix"]."clients set web_active = 1 where email = '".db_secure_field($email,$manejador)."'";
			$r = db_query($query,$manejador);
			$query = "select id_client, name from ".$conf["bdprefix"]."clients where email = '".db_secure_field($email,$manejador)."' and web_active = 1";
			$r = db_query($query,$manejador);
			if(db_count($r) > 0) {
				$u = array('id_client' => db_result($r,0));
				$_SESSION['user_classics'] = $u;
				if(!isset($_SESSION['cart_classics'])) {
					$_SESSION['cart_classics'] = array();
				}
				return 1;
			}
			return 1;
		}
		return 0;
	}
	return 0;
}

/*
 * Funcion para volver a enviar el codigo de activacion de cuenta al usuario
 */
function recoverActivation($email) {
	global $manejador;
	global $conf;
	if(!empty($email)) {
		$query = "select * from ".$conf["bdprefix"]."signup_token where email = '".db_secure_field($email,$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			$key = md5($email);
			$query = "update ".$conf["bdprefix"]."signup_token set token='".db_secure_field($key,$manejador)."' where email='".db_secure_field($email,$manejador)."'";
			$r = db_query($query,$manejador);
			$user["email"] = $email;
			include("./functions/welcome_email.php");
			return 2;
		}
		return 1;
	}
	return 0;
}

function recoverPass($email) {
	global $manejador;
	global $conf;
	if(!empty($email)) {
		$query = "select id_client from ".$conf["bdprefix"]."clients where email = '".db_secure_field($email,$manejador)."' and web_active='1'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			$c = db_fetch($r);
			$query = "select * from ".$conf["bdprefix"]."recovery_codes where id_client = '".db_secure_field($c['id_client'],$manejador)."'";
			$r2 = db_query($query,$manejador);
			if(db_count($r2) > 0) {
				$query = "delete from ".$conf["bdprefix"]."recovery_codes where id_client = '".db_secure_field($c['id_client'],$manejador)."'";
				$r3 = db_query($query,$manejador);
			}
			$code = md5($c['id_client'].$email.date('hms'));
			$query = "insert into ".$conf["bdprefix"]."recovery_codes (id_client,code) VALUES('".db_secure_field($c['id_client'],$manejador)."','".db_secure_field($code,$manejador)."')";
			$r4 = db_query($query,$manejador);
			include("./functions/recovery_email.php");;
			return 1;
		}
		return 0;
	}
	return 0;
}

function isARecoverCode($code) {
	global $manejador;
	global $conf;
	if (!empty($code)) {
		$query = "select id_client from ".$conf["bdprefix"]."recovery_codes where code = '".db_secure_field($code,$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			return 1;
		}
		return 0;
	}
	return 0;
}

function newRecoverPassword($code,$password) {
	global $manejador;
	global $conf;
	if (!empty($code)) {
		$query = "select id_client from ".$conf["bdprefix"]."recovery_codes where code = '".db_secure_field($code,$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			$c = db_fetch($r);
			$query="update ".$conf["bdprefix"]."clients set password = '".db_secure_field(md5($password),$manejador)."' where id_client = ".db_secure_field($c['id_client'],$manejador);
			$r = db_query($query,$manejador);
			$query="delete from ".$conf["bdprefix"]."recovery_codes where code = '".db_secure_field($code,$manejador)."'";
			$r = db_query($query,$manejador);
			return 1;
		}
		return 0;
	}
	return 0;
}

/*
 * Funcion que devuelve todos los campos de un usuario
 * Parametros:
 *		$user: array de datos del usuario
 *		$user['code']: client_code del usuario
 * Salidas:
 *		db_fetch($r): array asociativo con todos los campos del usuario encontrado
 */
function userData($user) {
	global $manejador;
	global $conf;

	if(!empty($user["id_client"])) {
		$query = "select c.* from ".$conf["bdprefix"]."clients c where c.id_client = '".db_secure_field($user["id_client"],$manejador)."'";
		$r = db_query($query,$manejador);
		if(db_count($r) > 0) {
			return db_fetch($r);
		}
	}
	return false;
}

function deleteUser($client_code) {
	global $manejador;
	global $conf;

	if(!empty($client_code)) {
		$query = "delete from ".$conf["bdprefix"]."clients where id_client = '".db_secure_field($client_code,$manejador)."'";
		$r = db_query($query,$manejador);
		return $r;
	}
	return false;
}

/*
 * Funcion que lista todos los usuarios con todos sus datos. (No muestra al usuario 'admin')
 * Parametros:
 *		$filter (opcional): cadena de filtro para nombre de usuario. El nombre de usuario tiene que contener esta cadena.
 *		$active (opcional): 1 usuarios activos, 0 usuarios inactivos, 2 todos los usuarios
 *		$order (opcional): campo por el que ordenar el listado.
 * Salidas:
 *		$r: resulset con los usuarios devueltos por la consulta que contienen $filter en su nombre.
 */
function listUsers($filter = "", $active = 2, $order = "last_login desc") {
	global $manejador;
	global $conf;

	$query = "select c.* from ".$conf["bdprefix"]."clients c where c.name like '%".mysql_real_escape_string($filter,$manejador)."%' ";
	if($active != 2)
		$query .= " and c.web_active=".$active;
	$query .= " order by c.".db_secure_field($order,$manejador);
	//echo $query;
	$r = db_query($query,$manejador);
	return $r;
}
function listPendingAccessRequests() {
    global $manejador;
    global $conf;
    $query="select c.*, (select name from ".$conf["bdprefix"]."currencies where id_currency=c.id_currency) as currency from ".$conf["bdprefix"]."clients c where access_request=1";
    $r1=db_query($query,$manejador);
    return $r1;
}

function updateUser($user) {
    global $manejador;
    global $conf;
    $query="update ".$conf["bdprefix"]."clients set ";
    $coma="";
    foreach ($user as $key=>$value) {
        if ($key=="id_client") continue;
        $query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
        $coma=",";
    }
    $query.=" where id_client=".$user["id_client"];
    //error_log($query);
    $r=db_query($query,$manejador);
    return $r;
}

function adminAddUser($user) {
	global $manejador;
	global $conf;
    
	$query = "select * from ".$conf["bdprefix"]."clients where email = '".db_secure_field($user["email"],$manejador)."'";
	$r = db_query($query,$manejador);
	if(db_count($r) == 0) {
		$query="insert into ".$conf["bdprefix"]."clients (name,subname,password,email,web_active) VALUES ('".db_secure_field($user["name"],$manejador)."','".db_secure_field($user["subname"],$manejador)."','".db_secure_field(md5($user["password"]),$manejador)."','".db_secure_field($user["email"],$manejador)."','".db_secure_field($user["web_active"],$manejador)."') ";
		//error_log($query);
		$r=db_query($query,$manejador);
		$key = md5($user["email"]);
		$query = "insert into ".$conf["bdprefix"]."signup_token (token,email) VALUES('".db_secure_field($key,$manejador)."','".db_secure_field($user["email"],$manejador)."')";
		$r = db_query($query,$manejador);
		include("./functions/welcome_email.php");;
		return 1;
	}else{
		return 3;
	}
}

function listCurrencies() {
    global $manejador;
    global $conf;
    $query="select * from ".$conf["bdprefix"]."currencies";
    $r1=db_query($query,$manejador);
    return $r1;
}

function activateUser($code) {
	global $manejador;
    global $conf;
    
    $query = "select * from ".$conf["bdprefix"]."signup_token where token = '".db_secure_field($code,$manejador)."'";
	$r = db_query($query,$manejador);
	if(db_count($r) == 0) return false;
	$lin=db_fetch($r);
    $query = "update ".$conf["bdprefix"]."clients set web_active=1 where id_client = '".db_secure_field($lin["id_client"],$manejador)."'";
	$r = db_query($query,$manejador);
	return true;
}

?>