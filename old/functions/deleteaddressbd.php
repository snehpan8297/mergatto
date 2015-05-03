<?php
@session_start();
include("../include/addresses.php");
if(isset($_POST["id_address"])){
	deleteAddress($_POST["id_address"]);
	echo "OK";
}
?>