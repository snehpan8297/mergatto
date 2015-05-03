<?php
include("../include/bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}
if(file_exists("../images/images/".$_POST["serial_model_code"]."-".$_POST["old"].".jpg")){
	copy("../images/images/".$_POST["serial_model_code"]."-".$_POST["old"].".jpg", "../images/images/".$_POST["serial_model_code"]."-".$_POST["new"]."-temp.jpg");
}

echo "OK";
?>