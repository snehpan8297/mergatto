<?php
//lang confirm
/*
    Login ADMIN
    
    ------
    Decripción

*/
@session_start();
if (!(isset($_SESSION['admin']))){
    header("location:./admin.php");
}
$page = "admin";
include ("./include/bdOC.php");
?>

