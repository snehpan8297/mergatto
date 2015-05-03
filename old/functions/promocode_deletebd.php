<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:../admin.php");
    die();
}
include("../include/promocodes.php");
include("../include/inbd.php");
if(isset($_POST["id_promo_code"])){
  $table="promo_codes";
  $filter=array();
  $filter["id_promo_code"]=array("operation"=>"=","value"=>$_POST["id_promo_code"]);
  deleteInBD($table,$filter);
	echo "OK";
}
?>
