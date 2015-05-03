<?php
//Lang revisado
@session_start();
include("../include/inbd.php");
$table="mmorpg";
$filter=array();
$filter["id_mmorpg"]=array("operation"=>">","value"=>$_POST["last_id"]);
if(isInBD($table,$filter)){
	$response["result"]=true;
	$response["data"]["last_id"]=0;
	$fields=array();
	$order="id_mmorpg desc";
	$mmorpgs=listInBD($table,$filter,$fields,$order);
	$response["data"]["mmorpg_terminal"]="";
	$last_id=0;
	foreach($mmorpgs as $key=>$mmorpg){
		if($last_id==0){
			$response["data"]["last_id"]=$mmorpg["id_mmorpg"];
		}
		$colors=explode(".", $mmorpg["identification"]);
		$background_color="rgba(".$colors[1].",".$colors[2].",".$colors[3].",1)";

		$response["data"]["mmorpg_terminal"].="<span style='color:blue'>[".$mmorpg["time"]."]</span> <span style='color:black;background-color:".$background_color."'>".$mmorpg["identification"]."</span> ".$mmorpg["action"]."
";
	}	
}else{
	$response["result"]=false;
}
echo json_encode($response);

?>