<?php
include("../include/bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}
for($i=1;$i<=15;$i++){
	if(file_exists("../images/images/".$_POST["serial_model_code"]."-".$i.".jpg")){
		unlink("../images/images/".$_POST["serial_model_code"]."-".$i.".jpg");
	}
}
for($i=1;$i<=15;$i++){
	if(file_exists("../images/images/".$_POST["serial_model_code"]."-".$i."-temp.jpg")){
		copy("../images/images/".$_POST["serial_model_code"]."-".$i."-temp.jpg", "../images/images/".$_POST["serial_model_code"]."-".$i.".jpg");
		unlink("../images/images/".$_POST["serial_model_code"]."-".$i."-temp.jpg");
	}
}

echo "OK";
?>