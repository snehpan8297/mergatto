<?php
//Lang confirmado
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/bd.php");
include("../include/cover.php");
if(isset($_POST["id_cover"])){
	deleteCover($_POST["id_cover"]);
	echo "OK";
}
?>