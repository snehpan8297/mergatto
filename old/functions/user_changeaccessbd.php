<?php
@session_start();

include("../include/users.php");
if(isset($_POST["client_code"])){
	if (updateUser($_POST)){
		echo "OK";
	}else{
		echo "NoOK";
	}
}
?>