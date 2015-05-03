<?php
//   IMAGE SIZE: 780x500

include_once("bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

function listCovers($lang) {
	global $manejador;
	global $conf;
	
	$query="select t1.*,t2.* from ".$conf["bdprefix"]."covers as t1 left join ".$conf["bdprefix"]."cover_datas as t2 on t2.id_cover=t1.id_cover where t2.lang='".strtoupper($lang)."'";
	//error_log($query);
	$res=db_query($query,$manejador);
	return $res;
}

function getCover($idcover,$lang="ALL") {
	global $manejador;
	global $conf;
	
	$lang=strtoupper($lang);
	$saida=array();
	if ($lang=="ALL") {
		$query="select t1.*,t2.* from ".$conf["bdprefix"]."covers as t1 left join ".$conf["bdprefix"]."cover_datas as t2 on t2.id_cover=t1.id_cover where t1.id_cover='".$idcover."'";
		$res=db_query($query,$manejador);
		while ($data=db_fetch($res)) {
			$saida["id_cover"]=$idcover;
			$saida["url"]=$data["url"];
			$saida["title_".strtolower($data["lang"])]=$data["title"];
			$saida["subtitle_".strtolower($data["lang"])]=$data["description"];
		}
	}
	return($saida);
}

function insertCover($cover) {
	global $manejador;
	global $conf;
	$coma="";
	$colum_names = "";
	$values = "";
	foreach ($cover as $key=>$value) {
		if ($key=="id_cover") continue;
		$colum_names.=$coma.db_secure_field($key,$manejador);
		$values.=$coma."'".db_secure_field($value,$manejador)."'";
		$coma=","; 
	}
	$query="insert into ".$conf["bdprefix"]."covers (".$colum_names.") VALUES (".$values.")";
	//error_log($query);
	$r=db_query($query,$manejador);
	$last=db_last_id();
	return $last;  
}

function insertCoverLangs($cover) {
	global $manejador;
	global $conf;
	$coma="";
	foreach ($cover["lang"] as $langkey => $langdata) {
		$coma=",";
		$colum_names="lang";
		$values="'".strtoupper($langkey)."'";
		foreach ($langdata as $key=>$value) {
			$colum_names.=$coma.db_secure_field($key,$manejador);
			$values.=$coma."'".db_secure_field($value,$manejador)."'";
			$coma=","; 
		}
		$query="insert into ".$conf["bdprefix"]."cover_datas (".$colum_names.") VALUES (".$values.")";
		//error_log($query);
		$r=db_query($query,$manejador);
	}
	return true;  
}

function updateCover($cover) {
	global $manejador;
	global $conf;
	$query="update ".$conf["bdprefix"]."covers set ";
	$coma="";
	foreach ($cover as $key=>$value) {
		if ($key=="id_cover") continue;
		$query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
		$coma=",";
	}
	$query.=" where id_cover='".$cover["id_cover"]."'";
	//error_log($query);
	$r=db_query($query,$manejador);
	return $r;
}

function updateCoverLangs($cover) {
	global $manejador;
	global $conf;
	foreach ($cover["lang"] as $langkey => $coverdata) {
		$query="update ".$conf["bdprefix"]."cover_datas set ";
		$coma="";
		foreach ($coverdata as $key=>$value) {
			if ($key=="id_cover") continue;
			$query.=$coma.$key."='".db_secure_field($value,$manejador)."'";
			$coma=",";
		}
		$query.=" where id_cover='".$coverdata["id_cover"]."' and lang='".strtoupper($langkey)."'";
		//error_log($query);
		$r=db_query($query,$manejador);
	}
	return true;
}

function deleteCover($idcover) {
	global $manejador;
	global $conf;

	if(!empty($idcover)) {
		$query = "delete from ".$conf["bdprefix"]."covers where id_cover=".db_secure_field($idcover,$manejador);
		$r = db_query($query,$manejador);
		return $r;
	}
	return false;
}
?>