<?php
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    echo "NOOK";
    die();
}
include_once ("../include/inbd.php");
$table="stocks";
$filter=array();
$filter["id_product"]=array("operation"=>"=","value"=>$_POST["id_product"]);
$filter["id_color"]=array("operation"=>"=","value"=>$_POST["id_color"]);

$stock_now=getInBD($table,$filter);
error_log("[Classic - Returns] STOCK - id_product:".$_POST["id_product"]." id_color:".$_POST["id_color"]);

unset($_POST["id_product"]);
unset($_POST["id_color"]);

$data=array();
$old_stock_string="";
$return_stock_string="";
$total_stock_string="";

for($i=1;$i<=10;$i++){
	$data["stock_size_".$i]=$stock_now["stock_size_".$i]+$_POST["stock_size_".$i];
	$old_stock_string.=$stock_now["stock_size_".$i]." ";
	$return_stock_string.=$_POST["stock_size_".$i]." ";
	$total_stock_string.=$data["stock_size_".$i]." ";
}
error_log("[Classic - Returns] Return STOCK");
error_log("[Classic - Returns] OLD STOCK ".$old_stock_string);
error_log("[Classic - Returns] RETURN STOCK ".$return_stock_string);
error_log("[Classic - Returns] TOTAL STOCK ".$total_stock_string);

updateInBD($table,$filter,$data);
echo "OK";
?>