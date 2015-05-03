<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/users.php");
if(isset($_POST["id_client"])){
	if (deleteUser($_POST["id_client"])){
		echo "OK";
	}else{
		echo "NoOK";
	}
}
?>