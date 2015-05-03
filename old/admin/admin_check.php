<?php
//Lang revisado
	@session_start();
	unset($_SESSION['admin_classics']);
	if($_POST["admin_username"]=="admin" && $_POST["admin_password"]=="sandro"){
		$_SESSION['admin_classics'] = "admin";
		echo "true";
	}else{
		if($_POST["admin_username"]=="elogia" && $_POST["admin_password"]=="classicselogia"){
			$_SESSION['admin_classics'] = "admin";
			echo "true";
		}else{
			echo "false";
			
		}
	}
?>
