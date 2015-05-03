<?php
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    echo "NOOK";
    die();
}
if (!(isset($_POST['id_return']))) {
    echo "NOOK";
    die();
}
include_once ("../include/inbd.php");
$table="returns";
$filter=array();
$filter["id_return"]=array("operation"=>"=","value"=>$_POST["id_return"]);
unset($_POST["id_return"]);
$data=$_POST;
updateInBD($table,$filter,$data);
echo "OK";
?>