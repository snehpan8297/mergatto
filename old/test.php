<?php
	include_once("./include/bdOC.php");
	include_once("./include/inbd.php");
	$num_clothes=0;

	die();

	
	for($i=30;$i<=36;$i++){
		$table="colors";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>$i."%");
		$colors=listInBD($table,$filter);
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$color["id_product"]);
			if(!isInBD($table,$filter)){
				echo $color["serial_molde_code"]."-".$color["name_id_color"]." Stock not found!<br/>";
			}else{
				$stock=getInBD($table,$filter);
				for($j=1;$j<=12;$j++){
					$num_clothes+=$stock["stock_size_".$j];
				}
			}
		}
	}
	for($i=40;$i<=46;$i++){
		$table="colors";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>$i."%");
		$colors=listInBD($table,$filter);
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$color["id_product"]);
			if(!isInBD($table,$filter)){
				echo $color["serial_molde_code"]."-".$color["name_id_color"]." Stock not found!<br/>";
			}else{
				$stock=getInBD($table,$filter);
				for($j=1;$j<=12;$j++){
					$num_clothes+=$stock["stock_size_".$j];
				}
			}
		}

	}
	echo "TOTAL: ".$num_clothes;


	die();
	for($i=30;$i<=36;$i++){
		$table="colors";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>$i."%");
		$colors=listInBD($table,$filter);
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$color["id_product"]);
			if(!isInBD($table,$filter)){
				echo $color["serial_molde_code"]."-".$color["name_id_color"]." Stock not found!<br/>";
			}else{
				$data=array();
				for($j=1;$j<=12;$j++){
					$data["stock_size_".$j]=0;
				}
				updateInBD($table,$filter,$data);
				echo $color["serial_model_code"]."-".$color["name_id_color"]." Stock Updated to 0<br/>";
			}
		}
	}
	for($i=40;$i<=46;$i++){
		$table="colors";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>$i."%");
		$colors=listInBD($table,$filter);
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$color["id_product"]);
			if(!isInBD($table,$filter)){
				echo $color["serial_molde_code"]."-".$color["name_id_color"]." Stock not found!<br/>";
			}else{
				$data=array();
				for($j=1;$j<=12;$j++){
					$data["stock_size_".$j]=0;
				}
				updateInBD($table,$filter,$data);
				echo $color["serial_model_code"]."-".$color["name_id_color"]." Stock Updated to 0<br/>";
			}
		}

	}

$table="colors";
$color_updated=array();

$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3107-URS";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3107-VEK";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3121-GLU";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3121-ONO";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3137-COS";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3142-BAG";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3152-QUI";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3154-UMA";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3161-YAZ";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3162-CUS";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="2";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3165-LEA";
$color_data[]="54";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3166-FAS";
$color_data[]="5";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3166-RUA";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3166-YEN";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3167-BLI";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3171-LIS";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3172-LAF";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3187-CRO";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="2";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3187-CRO";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3187-JAS";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3187-JAS";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3187-JAS";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3193-SYS";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3208-XOP";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3209-RAI";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3211-POB";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3213-FIO";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3221-ZAH";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3225-ZUF";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3228-VEJ";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3242-MYC";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3244-EMU";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3245-NIC";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3253-BAE";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3268-KOD";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3296-FLO";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3301-DAR";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3301-EMO";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3301-NAK";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3301-OMP";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3303-MUS";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3305-EVA";
$color_data[]="2";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3311-BIX";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3315-AMB";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3316-ESN";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3316-ZOY";
$color_data[]="7";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3317-MAR";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3317-MAR";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3318-ROI";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3322-POM";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3322-POM";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3326-EID";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3330-ARV";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3339-CEI";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3343-ARA";
$color_data[]="45";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3349-ALU";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3353-ARL";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3357-OMP";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3359-CAD";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3359-EGA";
$color_data[]="6";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3361-ARP";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3366-AVI";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3366-AVI";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3373-MOD";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3376-ANG";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3380-ALH";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3383-XOA";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3384-INS";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3384-VIN";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3386-ALH";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3406-ALL";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3407-DIC";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3407-SAX";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3407-URB";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3408-CIT";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3410-LEC";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3414-AYE";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3414-BEQ";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3423-BEQ";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3423-URB";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3429-BAX";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3430-NEV";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3432-PAE";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3434-ENR";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3434-ENR";
$color_data[]="8";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3437-RAD";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3439-BAC";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3442-ETE";
$color_data[]="82";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3449-CAN";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3456-ATO";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3459-COX";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3465-JUI";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3467-RIR";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3475-PAT";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3511-XUI";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3523-APS";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3539-JEU";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3541-ZAY";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3545-AUN";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3546-MIA";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3546-SIU";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3548-KUE";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3563-XOU";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3569-NUI";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3571-LAI";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3579-OBE";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3579-OBE";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3581-MIG";
$color_data[]="34";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3601-ELL";
$color_data[]="24";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3602-GAG";
$color_data[]="4";
$color_data[]="0";
$color_data[]="1";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3602-OMI";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="5";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3604-HEC";
$color_data[]="97";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="3";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3604-HEC";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3604-ODR";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3605-ADL";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3605-DIH";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3605-IXI";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3605-LLO";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3605-MUF";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3607-MOV";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3608-EDO";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3610-COS";
$color_data[]="14";
$color_data[]="0";
$color_data[]="1";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3610-NAC";
$color_data[]="16";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3610-NAC";
$color_data[]="14";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="2";
$color_data[]="2";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3610-OME";
$color_data[]="16";
$color_data[]="0";
$color_data[]="0";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3611-JED";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3611-OST";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3613-AIM";
$color_data[]="16";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3613-AIM";
$color_data[]="14";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3613-NIH";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3613-WAN";
$color_data[]="14";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3613-WAN";
$color_data[]="18";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3614-MUY";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3616-ITE";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3625-FUZ";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="3";
$color_data[]="3";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3627-YUA";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3628-JOR";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3628-NAC";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3630-OTS";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3633-NAC";
$color_data[]="6";
$color_data[]="0";
$color_data[]="1";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3635-YUA";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3636-NOK";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="3";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3638-ECT";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3638-LOW";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3640-KUR";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3641-GEP";
$color_data[]="98";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3641-MOV";
$color_data[]="96";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3641-VES";
$color_data[]="98";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3644-RAO";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3645-ILD";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3645-RAD";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3646-ACI";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3647-KAK";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="6";
$color_data[]="2";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3653-EDN";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3653-KUC";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3653-OBT";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3657-HON";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3659-OMN";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3660-ODR";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3661-DIH";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3661-GET";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3661-JOK";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3662-JEL";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="2";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3662-JEL";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3673-ISM";
$color_data[]="6";
$color_data[]="1";
$color_data[]="2";
$color_data[]="1";
$color_data[]="1";
$color_data[]="3";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3681-AEL";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3681-NES";
$color_data[]="9";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3681-NES";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="3682-OCI";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4101-PIL";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4106-GRA";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4114-ADR";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4127-ISA";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4127-ISA";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4127-LEY";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4127-LEY";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4150-SGI";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4205-UKE";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4211-UKE";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4212-UKE";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4212-UKE";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4308-ALG";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="3";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4421-TUZ";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4450-UKE";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4450-UKE";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4505-ODA";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4506-SOE";
$color_data[]="7";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4511-NIE";
$color_data[]="10";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4511-NIE";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4513-AEB";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4513-ZOT";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-NIE";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-REI";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-RUS";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-RUS";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-VOE";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-VOE";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4515-ZAS";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4516-TUA";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4516-ZAS";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4601-BOV";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="5";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4601-EJE";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="5";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4601-FEY";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4602-BOW";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4604-UKE";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4605-EUP";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4605-UKE";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4608-AIZ";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4608-FEY";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4613-AEB";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4613-OXF";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4614-ALN";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="4";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4617-CDU";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-EJE";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-ETI";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-FIA";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-LUD";
$color_data[]="6";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-NOC";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4620-ZAS";
$color_data[]="8";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4625-MEM";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4625-NEB";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="3";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4626-HIC";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4632-GRA";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4632-NOC";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4634-GOI";
$color_data[]="02";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="1";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4634-OSB";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="2";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}
$table="colors";
$filter=array();
$color_data=array();
$color_data[]="4652-ELB";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="5";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
$color_data[]="0";
if(in_array($color_data[0]."-".$color_data[1],$color_updated)){
echo $color_data[0]."-".$color_data[1]." Duplicated";
}else{
$color_updated[]=$color_data[0]."-".$color_data[1];
}
$filter["serial_model_code"]=array("operation"=>"=","value"=>$color_data[0]);
$filter["name_id_color"]=array("operation"=>"=","value"=>$color_data[1]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Not found<br/>";
}else{
$product_color=getInBD($table,$filter);
$table="stocks";
$filter=array();
$filter["id_color"]=array("operation"=>"=","value"=>$product_color["id"]);
$filter["id_product"]=array("operation"=>"=","value"=>$product_color["id_product"]);
if(!isInBD($table,$filter)){
echo $color_data[0]." ".$color_data[1]." Stock Not Found<br/>";
}else{
$data=array();
$data["stock_size_1"]=$color_data[2];
$data["stock_size_2"]=$color_data[3];
$data["stock_size_3"]=$color_data[4];
$data["stock_size_4"]=$color_data[5];
$data["stock_size_5"]=$color_data[6];
$data["stock_size_6"]=$color_data[7];
$data["stock_size_7"]=$color_data[8];
$data["stock_size_8"]=$color_data[9];
$data["stock_size_9"]=$color_data[10];
$data["stock_size_10"]=$color_data[11];
$data["stock_size_11"]=0;
$data["stock_size_12"]=0;
updateInBD($table,$filter,$data);
echo "<br/><br/><br/>";
}
}

die();





	die();
	$query="select p.*,cp.* from PROD_PRENDAS as p,PROD_COLORES_PRODUCTOS as cp WHERE p.COD_SERIE_MODELO='5001-URDA' AND p.SERVIDA=0 AND cp.ID_COLOR=128872 AND p.COD_SERIE_MODELO=cp.COD_SERIE_MODELO";
	$q = mssql_query($query, $server);
	while($lin = mssql_fetch_assoc($q)){
		foreach ($lin as $key=>$value){
			error_log($lin." -> ".$value);
		}
	}

	die();
	echo "<pre>";

	$table="lines_order_request";
	$lines_order=listInBD($table);
	$positive=0;
	$negative=0;
	foreach($lines_order as $key=>$line_order){
		$server = conectaDBOkyCoky();
		$query="select * from PROD_COLORES_PRODUCTOS as cp,PROD_COLORES as c WHERE cp.ID_COLOR_PROD=".$line_order["id_color"]." and c.ID_COLOR=cp.ID_COLOR";
		$q = mssql_query($query, $server);
		while($lin = mssql_fetch_assoc($q)){
			$color_elastic=$lin;
		}
		$table="colors";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"=","value"=>$line_order["serial_model_code"]);
		$color_elastic["NUM_COLOR_NEW"]=str_replace("CRUDO-NEGRO", "10", $color_elastic["NUM_COLOR"]);
		$color_elastic["NUM_COLOR_NEW"]=str_replace("M", "", $color_elastic["NUM_COLOR"]);
		$color_elastic["NUM_COLOR_NEW"]=str_replace("m", "", $color_elastic["NUM_COLOR"]);
		$color_elastic["NUM_COLOR_NEW"]=str_replace("N", "", $color_elastic["NUM_COLOR"]);
		$filter["name_id_color"]=array("operation"=>"=","value"=>$color_elastic["NUM_COLOR_NEW"]);
		if(isInBD($table,$filter)){
			$color=getInBD($table,$filter);
			$table="lines_order_request";
			$data=array();
			$data["id_color"]=$color["id_color"];
			$data["name_color"]=$color["name_id_color"];
			$filter=array();
			$filter["id_line"]=array("operation"=>"=","value"=>$line_order["id_line"]);
			updateInBD($table,$filter,$data);
			echo "<p style='color:green'>Update Line (OLD:".$line_order["id_color"].") (NEW:".$data["id_color"].")</p>";
			$positive++;
		}else{
			$color_elastic["NUM_COLOR"]=str_replace("M", "", $color_elastic["NUM_COLOR"]);
			$color_elastic["NUM_COLOR"]=str_replace("m", "", $color_elastic["NUM_COLOR"]);
			$color_elastic["NUM_COLOR"]=str_replace("N", "", $color_elastic["NUM_COLOR"]);
			$color_elastic["NUM_COLOR"]=str_replace("CRUDO-EGRO", "CRUDO-NEGRO", $color_elastic["NUM_COLOR"]);
			error_log("Not in BD (".$line_order["serial_model_code"]."@".$color_elastic["NUM_COLOR"].")");
			$query="select * from PROD_COLORES_PRODUCTOS as cp,PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$line_order["serial_model_code"]."' and c.ID_COLOR=cp.ID_COLOR and c.NUM_COLOR='".$color_elastic["NUM_COLOR"]."'";
			$q = mssql_query($query, $server);
			$color_elastic2=array();
			while($lin = mssql_fetch_assoc($q)){
				//print_r($lin);
				$color_elastic2=$lin;
			}
			if(empty($color_elastic2)){
				echo "<p style='color:red'>Not in BD (".$line_order["serial_model_code"]."@".$color_elastic["NUM_COLOR"].")</p>";
			}else{
				$table="lines_order_request";
				$data=array();
				$data["id_color"]=$color_elastic2["ID_COLOR_PROD"];
				$data["name_color"]=$color_elastic2["NUM_COLOR"];
				$filter=array();
				$filter["id_line"]=array("operation"=>"=","value"=>$line_order["id_line"]);
				updateInBD($table,$filter,$data);

				echo "<p style='color:green'>Update Line (OLD:".$line_order["id_color"].") (NEW:".$color_elastic2["ID_COLOR_PROD"].")</p>";
			}

		}

	}
	echo "<p style='color:red'>NEGATIVE: ".$negative."</p>";
	echo "<p style='color:green'>POSITIVE: ".$positive."</p>";
	die();
	$server = conectaDBOkyCoky();

	$query="select * from COM_PEDIDOS_CLIENTES WHERE NUM_PEDIDO_CLI=2064 AND ID_TEMPORADA=37";
	$query="select * from COM_LINEAS_PEDIDOS_CLIENTES WHERE ID_PEDIDO_CLI=24858";
	$query="select * from PROD_COLORES_PRODUCTOS as cp,PROD_COLORES as c WHERE cp.ID_COLOR_PROD=108330 and ";
	$query="select * from PROD_COLORES WHERE ID_COLOR=53084";
	$q = mssql_query($query, $server);
	while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
		print_r($lin);
	}
	die();



	$table="colors";
	$colors=listInBD($table);
	$count_colors=countInBD($table);
	$count=1;
	foreach ($colors as $key=>$color){
		$color_found=false;
		$server = conectaDBOkyCoky();
		$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";

		$q = mssql_query($query, $server);
		while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
			//print_r($lin);
			$color_found=true;
			$color_bd=$lin;
		}
		if(!$color_found){
			$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."M'";
			$q = mssql_query($query, $server);
			while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
				//print_r($lin);
				$color_found=true;
				$color_bd=$lin;
			}
			if(!$color_found){
				if($color["name_id_color"]=="10"){
					$color["name_id_color"]="CRUDO-NEGRO";
				}
				if($color["name_id_color"]=="UI"){
					$color["name_id_color"]="UNI";
				}
				$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";
				$q = mssql_query($query, $server);
				while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
					//print_r($lin);
					$color_found=true;
					$color_bd=$lin;
				}
				if(!$color_found){
					/*echo $color["serial_model_code"]."@".$color["name_id_color"]." color not found!<br/>";
					$query="select * from PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c WHERE cp.COD_SERIE_MODELO='".$color["serial_model_code"]."' and cp.ID_COLOR=c.ID_COLOR and c.NUM_COLOR = '".$color["name_id_color"]."'";
					$q = mssql_query($query, $server);
					while(($lin = mssql_fetch_assoc($q))&&(!$color_found)){
						print_r($lin);
						//$color_found=true;
					}*/
				}else{
				}
			}else{
			}
		}else{

		}

		if($color_found){
			error_log($color["serial_model_code"]."@".$color["name_id_color"]." color found!");
			$table="colors";
			$filter=array();
			$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
			$data=array();
			$data["id_color"]=$color_bd["ID_COLOR_PROD"];
			updateInBD($table,$filter,$data);
		}
	}

	die();



	/*


	$table="product_categories";
	deleteInBD($table);
	$table="products";
	$filter=array();
	$products=listInBD($table);
	foreach ($products as $key=>$product){
		echo $product["serial_model_code"]." ".(intval(intval($product["serial_model_code"])/100)%2)."<br/>";
		if((intval(intval($product["serial_model_code"])/100)%2)==0){
			$table="product_categories";
			$data=array();
			$data["id_product"]=$product["id_product"];
			$data["id_category"]=25;
			addInBD($table,$data);
		}else{
			$table="product_categories";
			$data=array();
			$data["id_product"]=$product["id_product"];
			$data["id_category"]=24;
			addInBD($table,$data);
		}

	}
	$table="products";
	$filter=array();
	$filter["id_season"]=array("operation"=>"=","value"=>31);
	$products=listInBD($table,$filter);
	foreach ($products as $key=>$product){
		$table="product_categories";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		deleteInBD($table,$filter);
		$table="product_categories";
		$data=array();
		$data["id_product"]=$product["id_product"];
		$data["id_category"]=26;
		addInBD($table,$data);
	}
	die();
	*/


	/*
	$table="products";
	$filter=array();
	$products=listInBD($table);
	echo "Productos en analisis: ".countInBD($table,$filter);
	foreach ($products as $key=>$product){
		$server = conectaDBOkyCoky();
		$query = "select PVP from PROD_MODELOS where cod_serie_modelo='".$product["serial_model_code"]."'";
		$q = mssql_query($query, $server);
		while($lin = mssql_fetch_assoc($q)){
			if($product["id_season"]>=31){
				$pvp_new=intval($lin["PVP"]*1.1*2.7);
				echo "[".$product["serial_model_code"]."] Precio Europa ".$pvp_new."<br/>";
			}else{
				$pvp_new=intval($lin["PVP"]*2.5);
				echo "[".$product["serial_model_code"]."] Precio Espana ".$pvp_new."<br/>";

			}

			$table="products";
			$filter=array();
			$filter["serial_model_code"] = array("operation"=>"=","value"=>$product["serial_model_code"]);
			$data=array();
			$data["pvp"]=$pvp_new;
			updateInBD($table,$filter,$data);

		}
	}
	die();


	$server = conectaDBOkyCoky();
	$query = "select * from PROD_MODELOS where cod_serie_modelo='3958-MEF'";
	$q = mssql_query($query, $server);

	while($lin = mssql_fetch_assoc($q)){
		print_r($lin);
		$pvp=$lin["PVP"]*1.1*2.7;
		$pvp_spain=$lin["PVP"]*2.4;
		echo $pvp." | ".$pvp_spain."<br/>";
		die();
	}
	echo "</pre>";


	die();

	die();


	echo "<pre>";

	/************************************
	*
	* Limpiar Colores sin productos, Stock sin productos y productos sin colores o sin stock
	*
	************************************/
		/*

	$table="products";
	$products=listInBD($table);
	foreach($products as $key =>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		if(!isInBd($table,$filter)){
			echo "[Delete] Product with no color ".$product["serial_model_code"]."<br/>";
			$table="products";
			$filter=array();
			$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
			deleteInBD($table,$filter);
		}

		$table="stocks";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		if(!isInBd($table,$filter)){
			echo "[Delete] Product with no stock ".$product["serial_model_code"]."<br/>";
			$table="products";
			$filter=array();
			$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
			deleteInBD($table,$filter);
		}
	}

	$table="colors";
	$colors=listInBD($table);
	foreach($colors as $key =>$color){
		$table="products";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"=","value"=>$color["serial_model_code"]);
		if(!isInBd($table,$filter)){
			echo "[Delete] Color with no product ".$color["serial_model_code"]."<br/>";
			$table="colors";
			$filter=array();
			$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
			deleteInBD($table,$filter);
		}

	}

	$table="stocks";
	$stocks=listInBD($table);
	foreach($stocks as $key =>$stock){
		$table="products";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$stock["id_product"]);
		if(!isInBd($table,$filter)){
			$table="colors";
			$filter=array();
			$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
			deleteInBD($table,$filter);
			echo "[Delete] Stock with no product ".$stock["id_product"]."<br/>";
		}
	}
	*/




	/************************************
	*
	* Eliminar colores M que tengan color base
	*
	************************************/
	/*

	$table="products";
	$products=listInBD($table);
	foreach ($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$filter["name_id_color"]=array("operation"=>"LIKE","value"=>"%M%");
		if(isInBD($table,$filter)){
			$colors=listInBD($table,$filter);
			foreach ($colors as $key=>$color){
				echo "[Message] Product ".$product["serial_model_code"]." with ".$color["name_id_color"]." color<br/>";
				$table="colors";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
				$filter["name_id_color"]=array("operation"=>"=","value"=>str_replace("M","",$color["name_id_color"]));
				if(!isInBD($table,$filter)){
					echo "[Error] Product ".$product["serial_model_code"]." with only M color<br/>";
				}else{
					echo "[Delete] Product ".$product["serial_model_code"]." with ".$color["name_id_color"]." & base ".$filter["name_id_color"]["value"]."<br/>";
					$table="colors";
					$filter=array();
					$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
					deleteInBD($table,$filter);
				}
			}

		}
	}




	error_log("[Clothes Importer] [START] Delete DB");
	$table="colors_new";
	deleteInBD($table);
	$table="stocks_new";
	deleteInBD($table);
	error_log("[Clothes Importer] [END] Delete DB");
	error_log("[Clothes Importer] [START] Update Colors & Stocks");
	$table="products";
	$products=listInBD($table);
	foreach($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		if(isInBD($table,$filter)){
			error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START]");
			if(isInBD($table,$filter)){
				$colors=listInBD($table,$filter);
				$colors_new=array();
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START] Get Colors Data");

				foreach($colors as $key=>$color){
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] [START] Get Color");
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Translate id_color");
					$color["name_id_color"]=str_replace("CRUDO-NEGRO","10",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("M","",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("m","",$color["name_id_color"]);
					$color["name_id_color"]=str_replace("N","",$color["name_id_color"]);
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Get Color");


					if(empty($colors_new[$color["name_id_color"]])){
						error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Add Color in new colors");
						$colors_new[$color["name_id_color"]]=array();
						$colors_new[$color["name_id_color"]]["color_data"]=array();

						$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
						$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
						$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
						$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
						$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;

						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
						$colors_new[$color["name_id_color"]]["stock_data"]=array();

						$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$product["id_product"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=0;
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=0;

						if(isInBD($table,$filter)){
							$stock=getInBD($table,$filter);

							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=$stock["stock_size_1"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=$stock["stock_size_2"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=$stock["stock_size_3"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=$stock["stock_size_4"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=$stock["stock_size_5"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=$stock["stock_size_6"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=$stock["stock_size_7"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=$stock["stock_size_8"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=$stock["stock_size_9"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=$stock["stock_size_10"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=$stock["stock_size_11"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=$stock["stock_size_12"];
													}

					}else{
						error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Update Color in new colors");

						$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
						$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
						$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
						$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
						$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
						$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
						$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;

						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);

						if(isInBD($table,$filter)){
							$stock=getInBD($table,$filter);

							$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$color["id_product"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]+=$stock["stock_size_1"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]+=$stock["stock_size_2"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]+=$stock["stock_size_3"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]+=$stock["stock_size_4"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]+=$stock["stock_size_5"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]+=$stock["stock_size_6"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]+=$stock["stock_size_7"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]+=$stock["stock_size_8"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]+=$stock["stock_size_9"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]+=$stock["stock_size_10"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]+=$stock["stock_size_11"];
							$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]+=$stock["stock_size_12"];
						}
					}


				}
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END] Get Colors Data");
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [START] Update BD");
				foreach($colors_new as $key=>$color_new){
					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Color data");
					$table="colors_new";
					addInBD($table,$color_new["color_data"]);
					$table="colors_new";
					$filter=array();
					$filter["id_color"]=array("operation"=>"=","value"=>$color_new["color_data"]["id_color"]);
					$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
					$color_tmp=getInBD($table,$filter);

					error_log("[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Stock data");
					$table="stocks_new";
					$color_new["stock_data"]["id_color"]=$color_tmp["id"];
					addInBD($table,$color_new["stock_data"]);
				}
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END] Update BD");
				error_log("[Clothes Importer] [".$product["serial_model_code"]."] [END]");


			}

		}
	}
	error_log("[Clothes Importer] [END] Update Colors & Stocks");

	$table="products";
	$products=listInBD($table);
	foreach($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$colors=listInBD($table,$filter);
		$stock_total=0;
		foreach($colors as $key=>$color){
			$table="stocks";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			if(isInBD($table,$filter)){
				$stock=getInBD($table,$filter);
				$stock_total+=$stock["stock_size_1"];
				$stock_total+=$stock["stock_size_2"];
				$stock_total+=$stock["stock_size_3"];
				$stock_total+=$stock["stock_size_4"];
				$stock_total+=$stock["stock_size_5"];
				$stock_total+=$stock["stock_size_6"];
				$stock_total+=$stock["stock_size_7"];
				$stock_total+=$stock["stock_size_8"];
				$stock_total+=$stock["stock_size_9"];
				$stock_total+=$stock["stock_size_10"];
				$stock_total+=$stock["stock_size_11"];
				$stock_total+=$stock["stock_size_12"];
			}
		}
		$table="colors_new";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$colors=listInBD($table,$filter);
		$stock_total_new=0;
		foreach($colors as $key=>$color){
			$table="stocks_new";
			$filter=array();
			$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
			$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
			if(isInBD($table,$filter)){
				$stock=getInBD($table,$filter);
				$stock_total_new+=$stock["stock_size_1"];
				$stock_total_new+=$stock["stock_size_2"];
				$stock_total_new+=$stock["stock_size_3"];
				$stock_total_new+=$stock["stock_size_4"];
				$stock_total_new+=$stock["stock_size_5"];
				$stock_total_new+=$stock["stock_size_6"];
				$stock_total_new+=$stock["stock_size_7"];
				$stock_total_new+=$stock["stock_size_8"];
				$stock_total_new+=$stock["stock_size_9"];
				$stock_total_new+=$stock["stock_size_10"];
				$stock_total_new+=$stock["stock_size_11"];
				$stock_total_new+=$stock["stock_size_12"];
			}else{
				error_log("[Clothes Importer] Not in bd (".$color["id"].",".$product["id_product"].")");
			}
		}
		if($stock_total==$stock_total_new){
			error_log("[Clothes Importer] [Check] ".$product["serial_model_code"]." ( ".$product["id_product"]." ) OK");
		}else{
			error_log("[Clothes Importer] [Check] ".$product["serial_model_code"]." ( ".$product["id_product"]." ) ERROR");
			die();
		}
	}



	error_log("[Clothes Importer] [START] Import new colors to colors table");

	$table="colors";
	deleteInBD($table);
	$table="colors_new";
	$colors=listInBD($table);
	foreach ($colors as $key=>$color){
		$table="colors";
		addInBD($table,$color);
	}
	$table="stocks";
	deleteInBD($table);
	$table="stocks_new";
	$stocks=listInBD($table);
	foreach ($stocks as $key=>$stock){
		$table="stocks";
		addInBD($table,$stock);
	}

	error_log("[Clothes Importer] [END] Import new colors to colors table");

	error_log("[Clothes Importer] [END] Done! ");



	*/


	/*


	echo "[Clothes Importer] [START] Delete DB<br/>";
	$table="colors_new";
	deleteInBD($table);
	$table="stocks_new";
	deleteInBD($table);
	echo "[Clothes Importer] [END] Delete DB<br/>";
	echo "[Clothes Importer] [START] Update Colors & Stocks<br/>";
	$table="products";
	$products=listInBD($table);
	foreach($products as $key=>$product){
		$table="colors";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		if(isInBD($table,$filter)){
			echo "[Clothes Importer] [".$product["serial_model_code"]."] [START]<br/>";
			$colors=listInBD($table,$filter);
			$colors_new=array();
			echo "[Clothes Importer] [".$product["serial_model_code"]."] [START] Get Colors Data<br/>";

			foreach($colors as $key=>$color){
				echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] [START] Get Color<br/>";
				echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Translate id_color<br/>";
				$color["name_id_color"]=str_replace("CRUDO-NEGRO","10",$color["name_id_color"]);
				$color["name_id_color"]=str_replace("M","",$color["name_id_color"]);
				$color["name_id_color"]=str_replace("m","",$color["name_id_color"]);
				$color["name_id_color"]=str_replace("N","",$color["name_id_color"]);
				echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Get Color<br/>";


				if(empty($colors_new[$color["name_id_color"]])){
					echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Add Color in new colors<br/>";
					$colors_new[$color["name_id_color"]]=array();
					$colors_new[$color["name_id_color"]]["color_data"]=array();

					$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
					$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
					$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
					$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
					$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;

					$table="stocks";
					$filter=array();
					$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
					$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$color["id_product"];
					$colors_new[$color["name_id_color"]]["stock_data"]=array();
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=0;
					$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=0;

					if(isInBD($table,$filter)){
						$stock=getInBD($table,$filter);

						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]=$stock["stock_size_1"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]=$stock["stock_size_2"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]=$stock["stock_size_3"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]=$stock["stock_size_4"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]=$stock["stock_size_5"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]=$stock["stock_size_6"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]=$stock["stock_size_7"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]=$stock["stock_size_8"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]=$stock["stock_size_9"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]=$stock["stock_size_10"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]=$stock["stock_size_11"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]=$stock["stock_size_12"];

						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
					}

				}else{
					echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$color["name_id_color"]."] Update Color in new colors<br/>";

					$colors_new[$color["name_id_color"]]["color_data"]["use_color"]=1;
					$colors_new[$color["name_id_color"]]["color_data"]["id_color"]=$color["id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_id_color"]=$color["name_id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["id_product"]=$color["id_product"];
					$colors_new[$color["name_id_color"]]["color_data"]["serial_model_code"]=$color["serial_model_code"];
					$colors_new[$color["name_id_color"]]["color_data"]["name"]=$color["name_id_color"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_es"]=$color["name_es"];
					$colors_new[$color["name_id_color"]]["color_data"]["name_en"]=$color["name_en"];
					$colors_new[$color["name_id_color"]]["color_data"]["has_image"]=0;

					$table="stocks";
					$filter=array();
					$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);

					if(isInBD($table,$filter)){
						$stock=getInBD($table,$filter);

						$colors_new[$color["name_id_color"]]["stock_data"]["id_product"]=$color["id_product"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_1"]+=$stock["stock_size_1"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_2"]+=$stock["stock_size_2"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_3"]+=$stock["stock_size_3"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_4"]+=$stock["stock_size_4"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_5"]+=$stock["stock_size_5"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_6"]+=$stock["stock_size_6"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_7"]+=$stock["stock_size_7"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_8"]+=$stock["stock_size_8"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_9"]+=$stock["stock_size_9"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_10"]+=$stock["stock_size_10"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_11"]+=$stock["stock_size_11"];
						$colors_new[$color["name_id_color"]]["stock_data"]["stock_size_12"]+=$stock["stock_size_12"];

						$table="stocks";
						$filter=array();
						$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
					}
				}


			}
			echo "[Clothes Importer] [".$product["serial_model_code"]."] [END] Get Colors Data<br/>";



			echo "[Clothes Importer] [".$product["serial_model_code"]."] [START] Update BD<br/>";
			foreach($colors_new as $key=>$color_new){
				echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Color data<br/>";
				$table="colors_new";
				addInBD($table,$color_new["color_data"]);
				$table="colors_new";
				$filter=array();
				$filter["id_color"]=array("operation"=>"=","value"=>$color_new["color_data"]["id_color"]);
				$color_tmp=getInBD($table,$filter);

				echo "[Clothes Importer] [".$product["serial_model_code"]."] [".$key."] Add Stock data<br/>";
				$table="stocks_new";
				$color_new["stock_data"]["id_color"]=$color_tmp["id"];
				addInBD($table,$color_new["stock_data"]);
			}
			echo "[Clothes Importer] [".$product["serial_model_code"]."] [END] Update BD<br/>";
			echo "[Clothes Importer] [".$product["serial_model_code"]."] [END]<br/>";

		}
	}
	echo "[Clothes Importer] [END] Update Colors & Stocks<br/>";

	*/











	/*

	include_once("./include/bdOC.php");

	$server = conectaDBOkyCoky();
	echo "<pre>";

	$order_id=2023;

	$query="select * from COM_COLORES WHERE ID_COLOR=15627";
	$query="select * from COM_CLIENTES WHERE COD_CLIENTE=890619";
	$query="select * from COM_PEDIDOS_CLIENTES WHERE NUM_PEDIDO_CLI=2030 AND ID_TEMPORADA=37";
	//$query="select * from COM_LINEAS_PEDIDOS_CLIENTES WHERE ID_PEDIDO_CLI=24825";
	//$query="select p.*,cp.* from PROD_PRENDAS as p,PROD_COLORES_PRODUCTOS as cp WHERE p.COD_SERIE_MODELO='3441-POE' AND p.SERVIDA=0 AND cp.ID_COLOR=8149 AND p.COD_SERIE_MODELO=cp.COD_SERIE_MODELO";
	//$query="select p.*,cp.* from PROD_PRENDAS as p,PROD_COLORES_PRODUCTOS as cp WHERE p.COD_SERIE_MODELO='3465-AKI' AND p.SERVIDA=0 AND cp.ID_COLOR=15625 AND p.COD_SERIE_MODELO=cp.COD_SERIE_MODELO AND p.TALLAJE_5=0";
	//$query="select p.*,cp.* from PROD_PRENDAS as p,PROD_COLORES_PRODUCTOS as cp WHERE p.COD_SERIE_MODELO='3441-POE' AND p.SERVIDA=0 AND cp.ID_COLOR= AND p.COD_SERIE_MODELO=cp.COD_SERIE_MODELO AND p.TALLAJE_1=0 AND p.TALLAJE_2=0 AND p.TALLAJE_3=0 AND p.TALLAJE_4=0 AND p.TALLAJE_5=1 AND p.TALLAJE_6=0 AND p.TALLAJE_7=0 AND p.TALLAJE_8=0 AND p.TALLAJE_9=0 AND p.TALLAJE_10=0 AND p.TALLAJE_11=0 AND p.TALLAJE_12=0";
	//$query="select * from PROD_COLORES WHERE ID_COLOR=15625";
	//$query="select * from PROD_COLORES_PRODUCTOS WHERE ID_COLOR=15625";
	//$query="select * from COM_CLIENTES WHERE COD_CLIENTE=890619";


	echo $query."<br><br><br>";

	$q = mssql_query($query, $server);

	while($lin = mssql_fetch_assoc($q)){
		print_r($lin);
	}
	die();




	$table="order_request";
	$filter=array();
	$filter["id_order"]=array("operation"=>"=","value"=>$order_id);
	$order=getInBD($table,$filter);
	$order["total_with_discount_no_iva"]=round(($order["total_with_discount"]*100/121),2);
	$order["total_with_discount_iva"]=$order["total_with_discount"]-$order["total_with_discount_no_iva"];
	echo "<pre>";
	$table="clients";
	$filter=array();
	$filter["id_client"]=array("operation"=>"=","value"=>$order["id_client"]);
	$client=getInBD($table,$filter);


	$order_elastic=array();
	$order_elastic["ID_TEMPORADA"]=37;
	$order_elastic["ID_EMPRESA"]=1;
	$order_elastic["SERVIDO"]=0;
	$order_elastic["REPETICION"]=0;
	$order_elastic["DESCUENTO_COMERCIAL"]=0;
	$order_elastic["IMPORTE_DTO_COMERCIAL"]=0;
	$order_elastic["DESCUENTO_PP"]=0;
	$order_elastic["IMPORTE_DTO_PP"]=0;
	$order_elastic["ID_AG_COMERCIAL"]=1;
	$order_elastic["ID_TRANSPORTISTA"]=4;
	$order_elastic["ID_PORTE"]=1;
	$order_elastic["PORC_PARTIDA"]=1;
	$order_elastic["ID_REGIMEN_IVA_1"]=1;
	$order_elastic["ID_FORMA_PAGO_1"]=7;
	$order_elastic["DIF_PAGO_1_1"]=0;
	$order_elastic["DIF_PAGO_2_1"]=0;
	$order_elastic["DIF_PAGO_3_1"]=0;
	$order_elastic["DIF_PAGO_4_1"]=0;
	$order_elastic["ID_TARIFA"]=1;
	$order_elastic["IMPORTE_RE"]=0;
	$order_elastic["ARTICULOS_SERVIDOS"]=0;
	$order_elastic["CREADO_POR"]=1000012;
	$order_elastic["IMPORTE_COMISION"]=0;
	$order_elastic["DESCUENTO_COMISION"]=0;
	$order_elastic["ANULADO"]=0;
	$order_elastic["IMPORTE_ARTICULOS_SERVIDOS"]=0;
	$order_elastic["RETENER"]=0;
	$order_elastic["HISTORICO"]=0;
	$order_elastic["PORC_PARTIDA_2"]=0;
	$order_elastic["IMPORTE_DTO_COMISION"]=0;
	$order_elastic["PORCENTAJE_COMISION"]=0;


	$order_elastic["NUM_PEDIDO_CLI"]=$order["id_order"];
	$order["date_elastic"]=date("M d Y h:i:00:000A",$order["date"]);
	$order_elastic["FECHA_PEDIDO"]=$order["date_elastic"];

	$query="select * from COM_CLIENTES WHERE COD_CLIENTE=".$client["id_elastic"];
	echo $query."<br><br><br>";

	$q = mssql_query($query, $server);

	while($lin = mssql_fetch_assoc($q)){
		$client_elastic=$lin;
	}

	$order_elastic["ID_CLIENTE"]=$client_elastic["ID_CLIENTE"];
	$order_elastic["DIRECCION_CLI"]=$order["invoice_address_address_1"]." ".$order["invoice_address_address_2"];
	$order_elastic["LOCALIDAD_CLI"]=$order["invoice_address_city"];
	$order_elastic["COD_POSTAL_CLI"]=$order["invoice_address_post_code"];
	$order_elastic["COD_PROVINCIA_CLI"]=59;
	$order_elastic["BASE_IMPONIBLE"]=$order["total_with_discount_no_iva"];
	$order_elastic["IMPORTE_LINEAS"]=$order["total_with_discount"];
	$order_elastic["SUBTOTAL"]=$order["total_with_discount"];
	$order_elastic["CON_DESCUENTO"]=$order["total_with_discount_no_iva"];
	$order_elastic["IMPORTE_IVA"]=$order["total_with_discount_iva"];
	$order_elastic["ARTICULOS_PEDIDOS"]=$order["num_clothes"];
	$order_elastic["IMPORTE_ARTICULOS_PEDIDOS"]=$order["total_with_discount_no_iva"];
	$order_elastic["CANTIDAD_PRENDAS"]=$order["num_clothes"];
	$order_elastic["NOMBRE_CLIENTE"]=$order["invoice_address_name"]." ".$order["invoice_address_subname"];
	$order_elastic["CIF_CLI"]=$order["invoice_address_DNI"];
	$order_elastic["COMENTARIOS_PEDIDO"]=$order["user_comment"];


	$r1 = mssql_query("update AUTONUMERICO set COM_PEDIDOS_CLIENTES=COM_PEDIDOS_CLIENTES+1", $server);
	$r2 = mssql_query("select COM_PEDIDOS_CLIENTES from AUTONUMERICO", $server);
	$s2 = mssql_fetch_assoc($r2);
	$order_elastic["ID_PEDIDO_CLI"]=$s2["COM_PEDIDOS_CLIENTES"];


	$table="COM_PEDIDOS_CLIENTES";
	$query = "insert into ".$table."  (";
	$coma = "";
	$values = "";
	foreach($order_elastic as $key => $value) {
		$query .= $coma.$key;
		$values .= $coma."'".db_secure_field($value,$manejador)."'";
		$coma = ",";
	}
	$query .= ") VALUES (".$values.")";
	echo $query."<br><br><br>";
	mssql_query($query, $server);


	$table="lines_order_request";
	$filter=array();
	$filter["id_order_request"]=array("operation"=>"=","value"=>$order["id_order"]);
	$order_lines=listInBD($table,$filter);
	foreach ($order_lines as $key=>$order_line){
		$linea_order_elastic=array();
	    $linea_order_elastic["ID_TIPO_REC_EQ"]=1;


	    $linea_order_elastic["ID_PEDIDO_CLI"]=$order_elastic["ID_PEDIDO_CLI"];
	    $linea_order_elastic["ID_TIPO_IVA"]=10;


	    $linea_order_elastic["COD_SERIE_MODELO"]=$order_line["serial_model_code"];
	    $linea_order_elastic["CANTIDAD_LINEA"]=$order_line["subclothes"];
	    $order_line["unitary_price_no_iva"]=round(($order_line["unitary_price"]*100/121),2);

	    $linea_order_elastic["PRECIO"]=$order_line["unitary_price_no_iva"];
	    $linea_order_elastic["ID_COLOR_PROD"]=$order_line["id_color"];
	    $linea_order_elastic["TALLA1"]=$order_line["size_1"];
	    $linea_order_elastic["TALLA2"]=$order_line["size_2"];
	    $linea_order_elastic["TALLA3"]=$order_line["size_3"];
	    $linea_order_elastic["TALLA4"]=$order_line["size_4"];
	    $linea_order_elastic["TALLA5"]=$order_line["size_5"];
	    $linea_order_elastic["TALLA6"]=$order_line["size_6"];
	    $linea_order_elastic["TALLA7"]=$order_line["size_7"];
	    $linea_order_elastic["TALLA8"]=$order_line["size_8"];
	    $linea_order_elastic["TALLA9"]=$order_line["size_9"];
	    $linea_order_elastic["TALLA10"]=$order_line["size_10"];
	    $linea_order_elastic["TALLA11"]=$order_line["size_11"];
	    $linea_order_elastic["TALLA12"]=$order_line["size_12"];


	    $r1 = mssql_query("update AUTONUMERICO set COM_LINEAS_PEDIDOS_CLIENTES=COM_LINEAS_PEDIDOS_CLIENTES+1", $server);
		$r2 = mssql_query("select COM_LINEAS_PEDIDOS_CLIENTES from AUTONUMERICO", $server);
		$s2 = mssql_fetch_assoc($r2);
		$linea_order_elastic["ID_LINEA_PEDIDO"]=$s2["COM_LINEAS_PEDIDOS_CLIENTES"];

		$table="COM_LINEAS_PEDIDOS_CLIENTES";
	    $query = "insert into ".$table."  (";
		$coma = "";
		$values = "";
		foreach($linea_order_elastic as $key => $value) {
			$query .= $coma.$key;
			$values .= $coma."'".db_secure_field($value,$manejador)."'";
			$coma = ",";
		}
		$query .= ") VALUES (".$values.")";
		echo $query."<br><br><br>";
		mssql_query($query, $server);

	}


    if($order["promo_code_amount"]>0){
		//Promo code
	    $linea_order_elastic=array();

	    $linea_order_elastic["ID_PEDIDO_CLI"]=$order_elastic["ID_PEDIDO_CLI"];
	    $linea_order_elastic["ID_TIPO_IVA"]=10;

	    $linea_order_elastic["COD_SERIE_MODELO"]="PROMO-CODE WEB";
	    $linea_order_elastic["CANTIDAD_LINEA"]=1;
	    $order["promo_code_amount_no_iva"]=round(($order["promo_code_amount"]*100/121),2);
	    $linea_order_elastic["PRECIO"]=($order["promo_code_amount_no_iva"]*-1);
	    $linea_order_elastic["TALLA1"]=1;
	    $linea_order_elastic["TALLA2"]=0;
	    $linea_order_elastic["TALLA3"]=0;
	    $linea_order_elastic["TALLA4"]=0;
	    $linea_order_elastic["TALLA5"]=0;
	    $linea_order_elastic["TALLA6"]=0;
	    $linea_order_elastic["TALLA7"]=0;
	    $linea_order_elastic["TALLA8"]=0;
	    $linea_order_elastic["TALLA9"]=0;
	    $linea_order_elastic["TALLA10"]=0;
	    $linea_order_elastic["TALLA11"]=0;
	    $linea_order_elastic["TALLA12"]=0;

  	    $r1 = mssql_query("update AUTONUMERICO set COM_LINEAS_PEDIDOS_CLIENTES=COM_LINEAS_PEDIDOS_CLIENTES+1", $server);
		$r2 = mssql_query("select COM_LINEAS_PEDIDOS_CLIENTES from AUTONUMERICO", $server);
		$s2 = mssql_fetch_assoc($r2);
		$linea_order_elastic["ID_LINEA_PEDIDO"]=$s2["COM_LINEAS_PEDIDOS_CLIENTES"];


	    $table="COM_LINEAS_PEDIDOS_CLIENTES";
	    $query = "insert into ".$table."  (";
		$coma = "";
		$values = "";
		foreach($linea_order_elastic as $key => $value) {
			$query .= $coma.$key;
			$values .= $coma."'".db_secure_field($value,$manejador)."'";
			$coma = ",";
		}
		$query .= ") VALUES (".$values.")";
		echo $query."<br><br><br>";
		mssql_query($query, $server);
    }



    //Portes Web
    $linea_order_elastic=array();


    $linea_order_elastic["ID_PEDIDO_CLI"]=$order_elastic["ID_PEDIDO_CLI"];
    $linea_order_elastic["ID_TIPO_IVA"]=10;

    $linea_order_elastic["COD_SERIE_MODELO"]="PORTES WEB";
    $linea_order_elastic["CANTIDAD_LINEA"]=1;
	$order["shipping_method_price_no_iva"]=round(($order["shipping_method_price"]*100/121),2);
    $linea_order_elastic["PRECIO"]=$order["shipping_method_price_no_iva"];
    $linea_order_elastic["TALLA1"]=1;
    $linea_order_elastic["TALLA2"]=0;
    $linea_order_elastic["TALLA3"]=0;
    $linea_order_elastic["TALLA4"]=0;
    $linea_order_elastic["TALLA5"]=0;
    $linea_order_elastic["TALLA6"]=0;
    $linea_order_elastic["TALLA7"]=0;
    $linea_order_elastic["TALLA8"]=0;
    $linea_order_elastic["TALLA9"]=0;
    $linea_order_elastic["TALLA10"]=0;
    $linea_order_elastic["TALLA11"]=0;
    $linea_order_elastic["TALLA12"]=0;

	$r1 = mssql_query("update AUTONUMERICO set COM_LINEAS_PEDIDOS_CLIENTES=COM_LINEAS_PEDIDOS_CLIENTES+1", $server);
	$r2 = mssql_query("select COM_LINEAS_PEDIDOS_CLIENTES from AUTONUMERICO", $server);
	$s2 = mssql_fetch_assoc($r2);
	$linea_order_elastic["ID_LINEA_PEDIDO"]=$s2["COM_LINEAS_PEDIDOS_CLIENTES"];


	$table="COM_LINEAS_PEDIDOS_CLIENTES";
	$query = "insert into ".$table."  (";
	$coma = "";
	$values = "";
	foreach($linea_order_elastic as $key => $value) {
		$query .= $coma.$key;
		$values .= $coma."'".db_secure_field($value,$manejador)."'";
		$coma = ",";
	}
	$query .= ") VALUES (".$values.")";
	echo $query."<br><br><br>";
	mssql_query($query, $server);

	echo "</pre>";



	*/
	/*
	$table='product_categories';
	$filter=array();
	$filter["id_category""]=array("operation"=>"=","value"=>18);
	$product_categories=listInBD($table,$filter);
	$count=0;
	foreach($product_categories as $key=>$product_category){
		$table="products";
		$filter=array();
		$filter["id_product""]=array("operation"=>"=","value"=>$product_category["id_product"]);
		$product=getInBD($table,$filter);
		echo $product_category["id_product"]." [".$product["sizable"]."]<br/>";
		$count++;

	}
	echo "Count ".$count;

	$table='product_categories';
	$filter=array();
	$filter["id_category""]=array("operation"=>"=","value"=>18);
	$product_categories=listInBD($table,$filter);
	foreach($product_categories as $key=>$product_category){
		$table="products";
		$filter=array();
		$filter["id_product""]=array("operation"=>"=","value"=>$product_category["id_product"]);
		$data=array();
		$data["sizable""]=0;
		updateInBD($table,$filter,$data);
		echo $product_category["id_product"]." [OK]<br/>";

	}
	die();
	*/
	/*
	$table='products';
	$filter=array();
	$filter["visible""]=array("operation"=>"=","value"=>0);
	$products=listInBD($table,$filter);
	foreach ($products as $key=>$product){
		if(!file_exists("images/principal/".$product["serial_model_code"].".jpg")){
			echo $product["serial_model_code"]."<br/>";
			$server = conectaDBOkyCoky();

			$timestamp=strtotime(date("Y-m-d H:i:00"));

			$q = mssql_query("select IMAGEN from PROD_MODELOS WHERE COD_SERIE_MODELO='" . $product["serial_model_code"] . "'", $server);

			$count=0;
			while($lin = mssql_fetch_assoc($q)){
				$image = $lin["IMAGEN"];
				$tempfile = "images/tmp.img";
				$fp = fopen($tempfile, "w");
				//if(is_writable($fp)) {
					fwrite($fp, $image);
				//} else {
					////error_log("no se puede escribir la imagen");
				//}
				fclose($fp);
				$info = getimagesize($tempfile);
				if (($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_JPEG2000))
					$imageorig = imagecreatefromjpeg($tempfile);
				else if (($info[2] == IMAGETYPE_GIF))
					$imageorig = imagecreatefromgif($tempfile);
				else if (($info[2] == IMAGETYPE_PNG))
					$imageorig = imagecreatefrompng($tempfile);
				imagejpeg($imageorig, "images/".$product["serial_model_code"].".jpg");
				unlink("images/tmp.img");
			}

		}

	}
		die();
	*/

	//clean_category(3);
	//review_stock(5060,28,50,1,1,3);
	//clean_category(5);
	//review_stock(4064,27,75,1,1,5);
	//check_stock(5062,28);
	//clean_category(16);
	//review_stock(5062,28,50,1,1,16);

	/*$serial_model_codes=array("3605-ADL","3620-LUQ","3701-EPU","3704-ATT","3704-CIL","3704-ENI","3704-EYE","3704-GIF","3704-IBI","3704-JOC","3704-LAP","3705-ENH","3705-FUK","3705-OCT","3706-EIX","3706-YOE","3707-ABY","3707-CIL","3707-EYE","3707-HIZ","3707-HOM","3707-JES","3707-OZE","3709-KOB","3709-NIB","3709-XOU","3711-AHU","3711-EPS","3711-EXO","3711-GET","3711-HIZ","3711-MAH","3711-MAT","3713-FUC","3713-IAS","3714-LAP","3715-ACI","3715-GET","3715-GOG","3716-GEC","3716-NIM","3718-ABY","3718-HOM","3720-LEE","3720-ONZ","3721-RAK","3722-CUP","3722-LLO","3722-LOS","3722-MCU","3722-MJE","3723-KIT","3723-OTI","3723-RIO","3725-EGL","3725-NUI","3726-XUO","3727-NUG","3728-ERE","3728-FAT","3728-NUG","3729-FES","3729-NIM","3731-ABY","3731-FEB","3731-TIZ","3733-XUO","3740-IGA","3740-ILA","3743-AIB","3743-RIJ","3745-JEB","3745-NIZ","3745-ORS","3745-OTI","3745-XAI","3748-ILA","3748-IME","3749-IWA","3749-OER","3751-DOV","3751-OWE","3751-ZAF","3752-ERE","3753-ESQ","3754-LEJ","3755-DEV","3755-JAG","3758-ISA","3758-OYE","3759-JUC","3759-OWE","3761-CIL","3761-ENI","3761-HOK","3761-JUK","3761-XOU","3763-AJI","3763-ISC","3763-JIP","3766-JUC","3773-GNO");
	$category=8;
	foreach ($serial_model_codes as $key=>$serial_model_code){
		$table="products";
		$filter=array();
		$filter["serial_model_code""]=array("operation"=>"=","value"=>$serial_model_code);
		$product=getInBD($table,$filter);

		$table="products";
		$data=array();
		$data["id_product""]=$product["id_product"];
		$data["id_category""]=$category;
		addInBD($table,$filter);

	}*/
	/*$serial_model_codes=array("3773-IHE","3754-MOK","4707-VOE","4702-ZAS","4705-FIA","3729-FES","3729-AEB","3783-COG","4702-VOE","4751-KIF","4705-ECU","4715-GAF","4720-EGU","3773-BUQ","3763-ARQ","4703-ASP","4720-BEU1","4715-KOF","3773-IFN","3703-OIR","4721-ZOT","4707-EUF","4714-BOQ","4707-MOF","4718-VOE","3720-OFU","4727-OCH","4751-ORU","3757-MOY","3755-NIX","4717-BUY","4717-ALN","4725-REI","3759-BOX","3753-NIM","3753-IME","4704-AEB","4706-WUO","3722-AEB","3738-BIV","3716-KUB","3780-WOR","4704-BEU1","3729-EGU","4727-KOF","4704-FIA","4727-BRI","4702-NIX","3711-MCU","4750-WUO","4750-BEU4","4703-VOE","4703-JAB","4702-BOQ","3720-END","3781-JIJ","4716-JAB","4703-AEB","4703-BRI","4704-ZAS","3726-LOJ","4703-JON","4703-EGU","4702-BRI1","4711-BEU1","4702-KOF","3747-NAC","3751-EOL","3738-MOT","4713-ORU","3751-GUB","3743-BUY","3790-WUO1","3734-FOF","3701-EPU","3720-LLI","3703-CLY","3720-AKR","3714-NEN");

	foreach ($serial_model_codes as $key=>$serial_model_code){
		$table="products";
		$filter=array();
		$filter["serial_model_code""]=array("operation"=>"=","value"=>$serial_model_code);
		$data=array();
		$data["visible""]=0;
		updateInBD($table,$filter,$data);
	}*/
	echo "Done!";

?>
