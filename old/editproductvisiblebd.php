<?php
//Lang Revisado

@session_start();
include("./include/includes.php");

if(isset($_POST["serial_model_code"])){
	$edit["serial_model_code"]=$_POST["serial_model_code"];
	
	if($_POST["visible"]=="checked"){
		$edit["visible"]=1;
	}else{
		$edit["visible"]=0;
	}

	updateProduct($edit);
echo "OK";
}

?>