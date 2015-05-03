<?php
if (isset($_GET["lang"]) || !empty($_GET["lang"])) {
	$lang = strtolower($_GET["lang"]);
	if (!isset($_COOKIE["lang_classics"]) && empty($_COOKIE["lang_classics"])) {
		setcookie("lang_classics", $lang, 3600 * 24 * 3, "/");
		$_SESSION["lang_classics"] = $lang;
	} else {
		$_COOKIE["lang_classics"] = $lang;
	}
} else {
	if (isset($_COOKIE["lang_classics"]) || !empty($_COOKIE["lang_classics"]) || isset($_SESSION["lang_classics"]) || !empty($_SESSION["lang_classics"])) {
		$lang = $_SESSION["lang_classics"];
	} else {
		$lang ='en';
		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
		}
		if($lang == "es") {
			$lang = "es";
		} else {
			$lang = "en";
		}
		setcookie("lang_classics", $lang, 3600 * 24 * 3, "/");
		$_SESSION["lang_classics"] = $lang;
	}
}
if ($lang != 'es' && $lang != 'en') {
	$lang ='en';
	if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
	}
	if($lang == "es") {
		$lang = "es";
	} else {
		$lang = "en";
	}
	setcookie("lang_classics", $lang, 3600 * 24 * 3, "/");
	$_SESSION["lang_classics"] = $lang;
}
?>