<?php
//Lang revisado

@session_start();
include("../include/products.php");
if(isset($_POST["url"])){
		unlink("../".$_POST["url"]);

	echo "OK";
}
$i_fix=1;
for ($i=1;$i<=10;$i++){
	if(file_exists("../../images/secondaries/".$_POST["serial_model_code"]."-".$i.".jpg")){
		if($reoder==$i){
			$reoder=$i_fix;
		}
		copy("../../images/secondaries/".$_POST["serial_model_code"]."-".$i.".jpg", "../../images/secondaries/".$_POST["serial_model_code"]."-temp.jpg");
		unlink("../../images/secondaries/".$_POST["serial_model_code"]."-".$i.".jpg");
		copy("../../images/secondaries/".$_POST["serial_model_code"]."-temp.jpg", "../../images/secondaries/".$_POST["serial_model_code"]."-".$i_fix.".jpg");
		unlink("../../images/secondaries/".$_POST["serial_model_code"]."-temp.jpg");
		$i_fix++;
	}
}
?>