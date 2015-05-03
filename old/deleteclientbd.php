<?php
//Lang confirmado

@session_start();
include("./include/includes.php");
if(isset($_POST["client_code"])){
	deleteUser($_POST["client_code"]);
	echo "OK";
}
?>