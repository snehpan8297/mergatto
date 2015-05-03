<?php
include("../include/bd.php");
if(!isset($manejador)) {
	$manejador = db_connect();
}

$reoder=$_POST["position"];
$i_fix=1;
for ($i=1;$i<=10;$i++){
	if(file_exists("../images/images/".$_POST["serial_model_code"]."-".$i.".jpg")){
		if($reoder==$i){
			$reoder=$i_fix;
		}
		copy("../images/images/".$_POST["serial_model_code"]."-".$i.".jpg", "../images/images/".$_POST["serial_model_code"]."-temp.jpg");
		unlink("../images/images/".$_POST["serial_model_code"]."-".$i.".jpg");
		copy("../images/images/".$_POST["serial_model_code"]."-temp.jpg", "../images/images/".$_POST["serial_model_code"]."-".$i_fix.".jpg");
			unlink("../images/images/".$_POST["serial_model_code"]."-temp.jpg");
		$i_fix++;
	}
}
if(($reoder>1)&&($_POST["action"]=="up")){
	copy("../images/images/".$_POST["serial_model_code"]."-".($reoder-1).".jpg", "../images/images/".$_POST["serial_model_code"]."-temp.jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-".($reoder-1).".jpg");
	copy("../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg", "../images/images/".$_POST["serial_model_code"]."-".($reoder-1).".jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg");
	copy("../images/images/".$_POST["serial_model_code"]."-temp.jpg", "../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-temp.jpg");
}else if(($reoder<$i_fix)&&($_POST["action"]=="down")){
	copy("../images/images/".$_POST["serial_model_code"]."-".($reoder+1).".jpg", "../images/images/".$_POST["serial_model_code"]."-temp.jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-".($reoder+1).".jpg");
	copy("../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg", "../images/images/".$_POST["serial_model_code"]."-".($reoder+1).".jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg");
	copy("../images/images/".$_POST["serial_model_code"]."-temp.jpg", "../images/images/".$_POST["serial_model_code"]."-".$reoder.".jpg");
	unlink("../images/images/".$_POST["serial_model_code"]."-temp.jpg");	
}
	
	echo "OK";

	die();

$data = explode(",",$_POST["data"]);
foreach($data as $key => $value) {
	$v = explode("_",$value);
	$query = "update ".$conf["bdprefix"]."images set imgorder=".$key." where id_image=".$v[1];
	$r = db_query($query,$manejador);
	$query = "update ".$conf["bdprefix"]."image_products set imgorder=".$key." where id_image=".$v[1];
	$r = db_query($query,$manejador);
}

echo "OK";
?>