<?php
//Lang revisado
	@session_start();
	unset($_SESSION['admin_classics']);
	if($_POST["admin_username"]=="admin" && $_POST["admin_password"]=="sandro"){
		$_SESSION['admin_classics'] = "admin";
		echo "true";
	}else{
		if($_POST["admin_username"]=="okycoky86@gmail.com" && $_POST["admin_password"]=="in24hRrSs"){
			$_SESSION['admin_classics'] = "admin";
			echo "true";
		}else{
			echo "false";

		}
	}
?>
