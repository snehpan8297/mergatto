<?php
include_once ("bd.php");
if (!isset($manejador)) {
	$manejador = db_connect();
}
$id = 2;
// Configuration zone
if ($id == 0) {
	$msconf["host"] = "cernegz.dyndns.org";
	$msconf["port"] = "1433";
	$msconf["user"] = "sa";
	$msconf["pass"] = "farmatic";
	$msconf["dbname"] = "elasticfashion";
} else if ($id == 1) {
	$msconf["host"] = "91.116.135.97";
	$msconf["port"] = "5050";
	$msconf["user"] = "web";
	$msconf["pass"] = "ninktec";
	$msconf["dbname"] = "elasticfashion";
} else if ($id == 2) {
	$msconf["host"] = "91.116.135.97";
	$msconf["port"] = "5060";
	$msconf["user"] = "sa";
	$msconf["pass"] = "1q2w3e4r";
	$msconf["dbname"] = "elasticfashion";
}
//Conection Zone
function conectaDBOkyCoky() {
	global $msconf;
	$server = mssql_connect($msconf["host"] . ":" . $msconf["port"], $msconf["user"], $msconf["pass"]);
	mssql_select_db($msconf["dbname"]);
	return $server;
}

function checkDBOkyCoky() {
	global $msconf;
	$server = mssql_connect($msconf["host"] . ":" . $msconf["port"], $msconf["user"], $msconf["pass"]);
	if ($server == false)
		return false;
	else {
		mssql_close($server);
		return true;
	}
}






function clean_category($category){
		$table="product_categories";
		$filter=array();
		$data["id_category"]=array("operation"=>"=","value"=>$category);
		$products=listInBD($table,$data);
		foreach($products as $key => $product){
			$table='products';
			$filter=array();
			$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
			deleteInBD($table,$filter);
		}
	}

	function review_stock($num_order,$id_season,$discount,$use_discount,$default_visible,$default_category){

		$server = conectaDBOkyCoky();

		$timestamp=strtotime(date("Y-m-d H:i:00"));


		$query = "select pa.DESC_PATRON, p.ID_TEMPORADA as PRODUCTO_ID_TEMPORADA, p.DESC_MODELO as PRODUCTO_DESC_MODELO, p.ID_FAMILIA as PRODUCTO_ID_FAMILIA, p.PVP_ACTUAL as PRODUCTO_PVP_ACTUAL, p.COMPOSICION as PRODUCTO_COMPOSICION,l.*,c.* from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";


		$tb_linea=mssql_query($query, $server);

		$order=array();
		echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Import Elements </em>";
		while($linea_bd = mssql_fetch_assoc($tb_linea)){
			$linea_bd["COD_SERIE_MODELO"]=str_replace("�","N",$linea_bd["COD_SERIE_MODELO"]);
			echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Import ".$linea_bd["COD_SERIE_MODELO"]." </em>";

			$linea_bd["NUM_COLOR"]=str_replace("CRUDO-NEGRO","10",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("M","",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("m","",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("N","",$linea_bd["NUM_COLOR"]);

			for ($i=99;$i>=0;$i--){
				$linea_bd["DESC_COLOR"]=str_replace("-".$i," ",$linea_bd["DESC_COLOR"]);

			}
			$linea_bd["DESC_COLOR"]=str_replace("-M"," ",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("1","BLANCO",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("-"," ",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("+"," ",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("/"," ",$linea_bd["DESC_COLOR"]);


			$product_key=$linea_bd["COD_SERIE_MODELO"]."-".$linea_bd["NUM_COLOR"];


			if(!isset($order[$product_key])){
				$order[$product_key]=array();
				for($i=1;$i<=12;$i++){
					$order[$product_key]["stock_size_".$i]=0;
				}
			}
			$order[$product_key]["serial_model_code"]=$linea_bd["COD_SERIE_MODELO"];
			$order[$product_key]["product_web_serial_model_code"]=$linea_bd["COD_SERIE_MODELO"];

			$order[$product_key]["product_id_family"]=$linea_bd["PRODUCTO_ID_FAMILIA"];
			$order[$product_key]["product_description_es"]=$linea_bd["PRODUCTO_DESC_MODELO"];
			include("./lang/lang_es.php");
			$order[$product_key]["product_name_es"]=strtoupper($s["family_".$linea_bd["PRODUCTO_ID_FAMILIA"]]." ".$linea_bd["DESC_PATRON"]);
			include("./lang/lang_en.php");
			$order[$product_key]["product_name_en"]=strtoupper($s["family_".$linea_bd["PRODUCTO_ID_FAMILIA"]]." ".$linea_bd["DESC_PATRON"]);
			$order[$product_key]["product_pvp"]=$linea_bd["PRODUCTO_PVP_ACTUAL"];
			$order[$product_key]["product_visible"]=$default_visible;
			$order[$product_key]["product_id_season"]=$linea_bd["PRODUCTO_ID_TEMPORADA"];
			$order[$product_key]["product_use_discount"]=$use_discount;
			$order[$product_key]["product_discount"]=$discount;
			$order[$product_key]["product_product_position"]=1000;
			$order[$product_key]["product_last_update"]=$timestamp;

			$order[$product_key]["id_color"]=$linea_bd["ID_COLOR"];
			$order[$product_key]["name_id_color"]=$linea_bd["NUM_COLOR"];
			$order[$product_key]["use_color"]=1;
			$order[$product_key]["name"]=$linea_bd["DESC_COLOR"];
			$order[$product_key]["name_es"]=$linea_bd["DESC_COLOR"];
			$order[$product_key]["name_en"]=$linea_bd["DESC_COLOR"];

			for($i=1;$i<=12;$i++){
				$order[$product_key]["stock_size_".$i]+=$linea_bd["TALLA".$i];
			}

		}
		echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Import Elements </em>";

		$total=0;
		echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Process all lines </em>";

		foreach ($order as $key=>$line){
			$table="colors";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$line["serial_model_code"]);
			if(isInBD($table,$filter)){
				$colors=listInBD($table,$filter);
				foreach ($colors as $key=>$color){

					echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Delete old Colors </em>";
					$table="colors";
					$filter=array();
					$filter["id"]=array("operation"=>"=","value"=>$color["id"]);
					deleteInBD($table,$filter);
					echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Delete old Colors </em>";


					echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Delete old Stock </em>";
					$table="stocks";
					$filter=array();
					$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
					deleteInBD($table,$filter);
					echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Delete old Stock </em>";
				}
			}
		}

		foreach ($order as $key=>$line){
			$table="products";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$line["serial_model_code"]);
			echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Process ".$line["serial_model_code"]." </em>";
			if(isInBD($table,$filter)){

				echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Found in BD, Update </em>";
				$product=getInBD($table,$filter);


				//NEW COLORS
				echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Colors </em>";
				$table="colors";
				$data=array();
				$data["id_color"]=$line["id_color"];
				$data["id_product"]=$product["id_product"];
				$data["use_color"]=$line["use_color"];
				$data["name_id_color"]=$line["name_id_color"];
				$data["serial_model_code"]=$line["serial_model_code"];
				$data["name"]=$line["name"];
				$data["name_es"]=$line["name_es"];
				$data["name_en"]=$line["name_en"];
				$id_color=addInBD($table,$data);


				//NEW STOCK
				$table="stocks";
				$data=array();
				$data["id_product"]=$product["id_product"];
				$data["id_color"]=$id_color;
				$stock_str="";
				for($i=1;$i<=12;$i++){
					$data["stock_size_".$i]=$line["stock_size_".$i];
					$stock_str.=" ".$line["stock_size_".$i];
				}
				$id_color=addInBD($table,$data);
				echo "<em style='display:block'><span style='float:right'></span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> [".$product["id_product"]." | ".$line["name_id_color"]."@".$line["name"]."]".$stock_str."</em>";

				echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Colors </em>";

				$table="products";
				$filter=array();
				$filter["serial_model_code"]=array("operation"=>"=","value"=>$line["serial_model_code"]);
				$data=array();
				$data["last_update"]=$line["last_update"];
				updateInBD($table,$filter,$data);
				echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Found in BD, Update </em>";

			}else{
				echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Not found in BD, Add </em>";

				//NEW PRODUCT
				echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Product </em>";
				$table="products";
				$data=array();
				$data["serial_model_code"]=$line["serial_model_code"];
				$data["web_serial_model_code"]=$line["product_web_serial_model_code"];
				$data["id_family"]=$line["product_id_family"];
				$data["description_es"]=$line["product_description_es"];
				$data["description_en"]=$line["product_description_es"];
				$data["name_es"]=$line["product_name_es"];
				$data["name_en"]=$line["product_name_en"];
				$data["pvp"]=$line["product_pvp"];
				$data["id_sizing"]=1;
				$data["sizable"]=1;
				$data["visible"]=$line["product_visible"];
				$data["id_season"]=$line["product_id_season"];
				$data["use_discount"]=$line["product_use_discount"];
				$data["discount"]=$line["product_discount"];
				$data["product_position"]=$line["product_product_position"];
				$data["last_update"]=$line["product_last_update"];
				$data["id_season"]=$line["product_id_season"];
				$data["season_winter"]=(intval($line["product_id_season"])-1)%2;
				$data["season_year"]=intval((intval($line["product_id_season"])-1)/2);

				$product=array();
				$product["id_product"]=addInBd($table,$data);



				echo "<em style='display:block'><span style='float:right'></span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> [".$product["id_product"]." | ".$line["serial_model_code"]." ]</em>";
				echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Product </em>";

				//NEW COLORS
				echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Colors </em>";
				$table="colors";
				$data=array();
				$data["id_color"]=$line["id_color"];
				$data["id_product"]=$product["id_product"];
				$data["use_color"]=$line["use_color"];
				$data["name_id_color"]=$line["name_id_color"];
				$data["serial_model_code"]=$line["serial_model_code"];
				$data["name"]=$line["name"];
				$data["name_es"]=$line["name_es"];
				$data["name_en"]=$line["name_en"];
				$id_color=addInBD($table,$data);


				//NEW STOCK
				$table="stocks";
				$data=array();
				$data["id_product"]=$product["id_product"];
				$data["id_color"]=$id_color;
				$stock_str="";
				for($i=1;$i<=12;$i++){
					$data["stock_size_".$i]=$line["stock_size_".$i];
					$stock_str.=" ".$line["stock_size_".$i];
				}
				$id_color=addInBD($table,$data);
				echo "<em style='display:block'><span style='float:right'></span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> [".$product["id_product"]." | ".$line["name_id_color"]."@".$line["name"]."]".$stock_str."</em>";
				echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Add new Colors </em>";
				if($default_category>0){
					$table="product_categories";
					$data=array();
					$data["id_product"]=$product["id_product"];
					$data["id_category"]=$default_category;
					addInBD($table,$data);
				}


				echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Not found in BD, Add </em>";
			}
			echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Process ".$line["serial_model_code"]." </em>";

		}
		echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Process all lines </em>";

	}



function check_stock($num_order,$id_season){


		$server = conectaDBOkyCoky();

		$timestamp=strtotime(date("Y-m-d H:i:00"));


		$query = "select pa.DESC_PATRON, p.ID_TEMPORADA as PRODUCTO_ID_TEMPORADA, p.DESC_MODELO as PRODUCTO_DESC_MODELO, p.ID_FAMILIA as PRODUCTO_ID_FAMILIA, p.PVP_ACTUAL as PRODUCTO_PVP_ACTUAL, p.COMPOSICION as PRODUCTO_COMPOSICION,l.*,c.* from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";


		$tb_linea=mssql_query($query, $server);

		$order=array();
		echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Import Elements </em>";
		while($linea_bd = mssql_fetch_assoc($tb_linea)){
			$linea_bd["COD_SERIE_MODELO"]=str_replace("�","N",$linea_bd["COD_SERIE_MODELO"]);

			$linea_bd["NUM_COLOR"]=str_replace("CRUDO-NEGRO","10",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("M","",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("m","",$linea_bd["NUM_COLOR"]);
			$linea_bd["NUM_COLOR"]=str_replace("N","",$linea_bd["NUM_COLOR"]);

			for ($i=99;$i>=0;$i--){
				$linea_bd["DESC_COLOR"]=str_replace("-".$i,"",$linea_bd["DESC_COLOR"]);

			}
			$linea_bd["DESC_COLOR"]=str_replace("-M","",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("1","BLANCO",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("-"," ",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("+"," ",$linea_bd["DESC_COLOR"]);
			$linea_bd["DESC_COLOR"]=str_replace("/"," ",$linea_bd["DESC_COLOR"]);


			$product_key=$linea_bd["COD_SERIE_MODELO"]."-".$linea_bd["NUM_COLOR"];


			if(!isset($order[$product_key])){
				$order[$product_key]=array();
				for($i=1;$i<=12;$i++){
					$order[$product_key]["stock_size_".$i]=0;
				}
			}
			$order[$product_key]["serial_model_code"]=$linea_bd["COD_SERIE_MODELO"];
			$order[$product_key]["product_web_serial_model_code"]=$linea_bd["COD_SERIE_MODELO"];

			$order[$product_key]["product_id_family"]=$linea_bd["PRODUCTO_ID_FAMILIA"];

			$order[$product_key]["product_description_es"]=$linea_bd["PRODUCTO_DESC_MODELO"];
			include("./lang/lang_es.php");
			$order[$product_key]["product_name_es"]=strtoupper($s["family_".$linea_bd["PRODUCTO_ID_FAMILIA"]]." ".$linea_bd["DESC_PATRON"]);
			include("./lang/lang_en.php");
			$order[$product_key]["product_name_en"]=strtoupper($s["family_".$linea_bd["PRODUCTO_ID_FAMILIA"]]." ".$linea_bd["DESC_PATRON"]);
			$order[$product_key]["product_pvp"]=$linea_bd["PRODUCTO_PVP_ACTUAL"];
			$order[$product_key]["product_visible"]=$default_visible;
			$order[$product_key]["product_id_season"]=$linea_bd["PRODUCTO_ID_TEMPORADA"];
			$order[$product_key]["product_use_discount"]=$use_discount;
			$order[$product_key]["product_discount"]=$discount;
			$order[$product_key]["product_product_position"]=1000;
			$order[$product_key]["product_last_update"]=$timestamp;

			$order[$product_key]["id_color"]=$linea_bd["ID_COLOR"];
			$order[$product_key]["name_id_color"]=$linea_bd["NUM_COLOR"];
			$order[$product_key]["use_color"]=1;
			$order[$product_key]["name"]=$linea_bd["DESC_COLOR"];
			$order[$product_key]["name_es"]=$linea_bd["DESC_COLOR"];
			$order[$product_key]["name_en"]=$linea_bd["DESC_COLOR"];

			for($i=1;$i<=12;$i++){
				$order[$product_key]["stock_size_".$i]+=$linea_bd["TALLA".$i];
			}

		}
		echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Import Elements </em>";

		$total=0;

		echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Check all lines </em>";

		$error_total=false;
		$import_stock_total=0;
		$local_stock_total=0;

		foreach ($order as $key=>$line){
			$table="products";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$line["serial_model_code"]);
			echo "<em style='display:block'><span style='float:right'>[<span style='color:black'>START</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> Process ".$line["serial_model_code"]." @ ".$line["id_color"]." ".$line["name_id_color"]."</em>";
			if(isInBD($table,$filter)){

				$product=getInBD($table,$filter);

				$table="colors";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
				$filter["id_color"]=array("operation"=>"=","value"=>$line["id_color"]);
				$color=getInBD($table,$filter);

				$table="stocks";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
				$filter["id_color"]=array("operation"=>"=","value"=>$color["id"]);
				$stock=getInBD($table,$filter);

				$import_stock=0;
				$error=false;
				$local_stock=0;
				$stock_str="";
				for($i=1;$i<=12;$i++){
					if($line["stock_size_".$i]!=$stock["stock_size_".$i]){
						$error=true;
						$error_total=true;
					}
					$import_stock+=intval($line["stock_size_".$i]);
					$local_stock+=intval($stock["stock_size_".$i]);
					$stock_str.=" [".$line["stock_size_".$i]."|".$stock["stock_size_".$i]."]";
				}
				if($error){
					echo "<em style='display:block'><span style='float:right'>[<span style='color:red'>ERROR</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> <span style='color:red'>ERROR [[".$import_stock."||".$local_stock."]] ".$line["serial_model_code"]." ".$color["name_id_color"]." ".$stock_str."</em>";
				}else{
					echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> <span style='color:green'>OK [[".$import_stock."||".$local_stock."]] ".$line["serial_model_code"]." ".$color["name_id_color"]." ".$stock_str."</em>";

				}
			}else{
				$error_total=true;
				$import_stock=0;
				$local_stock=0;
				$stock_str="";
				for($i=1;$i<=12;$i++){
					$import_stock+=intval($line["stock_size_".$i]);
					$stock_str.=" [".$line["stock_size_".$i]."|0]";
				}

				echo "<em style='display:block'><span style='float:right'>[<span style='color:red'>ERROR</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> <span style='color:red'>ERROR  [[".$import_stock."||0]] ".$line["serial_model_code"]." ".$color["name_id_color"]." ".$stock_str."</em>";

			}
			$import_stock_total+=$import_stock;
			$local_stock_total+=$local_stock;

		}

		if($error_total){
			echo "<em style='display:block'><span style='float:right'>[<span style='color:red'>ERROR</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> <span style='color:red'>Check all lines ERROR [[".$import_stock_total."||".$local_stock_total."]]</em>";
		}else{
			echo "<em style='display:block'><span style='float:right'>[<span style='color:green'>OK</span>]</span><span style='color:purple'>[OKYCOKY IMPORT 2.3.1]</span> <span style='color:green'>Check all lines OK [[".$$import_stock_total."||".$import_stock_total."]] </em>";
		}

	}









function plain_str($str){
	$str=str_replace("'", " ", $str);
	return($str);
}

function importBDClients(){

	$query = "SELECT * FROM COM_REPRESENTANTES_CLIENTES";
	//$query = "SELECT * FROM sys.objects";
	$server = conectaDBOkyCoky();

	$rs = mssql_query($query, $server);
	$i=0;

	error_log("[NS][Import Clients] START");
	while ($pc = mssql_fetch_assoc($rs)){



		$query = "SELECT * FROM COM_AGENTES_COMERCIALES WHERE ACTIVO=1 AND ID_AG_COMERCIAL=".$pc["ID_AG_COMERCIAL"];
		$tb_agente=mssql_query($query, $server);
		$agente_bd = mssql_fetch_assoc($tb_agente);


		$query = "SELECT * FROM COM_CLIENTES WHERE ACTIVO=1 AND ID_CLIENTE=".$pc["ID_CLIENTE"];
		$tb_cliente=mssql_query($query, $server);
		$cliente_bd = mssql_fetch_assoc($tb_cliente);

		if((isset($agente_bd["ID_AG_COMERCIAL"]))&&(isset($cliente_bd["ID_CLIENTE"]))){
			$table='salesman';
			$filter=array();
			$filter["id_salesman"]=array("operation"=>"=","value"=>$agente_bd["COD_AGENTE_COMERCIAL"]);
			if(isInBD($table,$filter)){
				error_log("[NS][Import Clients] Salesman Found (".$agente_bd["COD_AGENTE_COMERCIAL"]." ".$agente_bd["DESC_AG_COMERCIAL"].")");
				$data=array();
				$data["name"]=plain_str($agente_bd["DESC_AG_COMERCIAL"]);
				updateInBD($table,$filter,$data);

				error_log("[NS][Import Clients] Salesman Updated (".$agente_bd["COD_AGENTE_COMERCIAL"]." ".$agente_bd["DESC_AG_COMERCIAL"].")");
			}else{
				error_log("[NS][Import Clients] Salesman Not Found (".$agente_bd["COD_AGENTE_COMERCIAL"]." ".$agente_bd["DESC_AG_COMERCIAL"].")");
				$data=array();
				$data["id_salesman"]=$agente_bd["COD_AGENTE_COMERCIAL"];
				$data["email"]=plain_str($agente_bd["EMAIL"]);
				$data["password"]="d0ff746fcbc9abe11d5d3c0bef195709";
				$data["name"]=plain_str($agente_bd["DESC_AG_COMERCIAL"]);
				$data["id_currency"]=$agente_bd["ID_AG_COMERCIAL"];
				$data["rate_1"]=0;
				$data["rate_2"]=0;
				$data["rate_3"]=0;
				$data["rate_4"]=0;
				$data["rate_5"]=0;
				$data["rate_6"]=0;
				$data["rate_7"]=0;
				$data["rate_8"]=0;
				$data["rate_9"]=0;
				$data["rate_10"]=0;
				$data["rate_11"]=0;
				$data["rate_12"]=0;
				$data["prepayment_percent"]=0;
				addInBD($table,$data);
				error_log("[NS][Import Clients] Salesman Added (".$agente_bd["ID_AG_COMERCIAL"]." ".$agente_bd["DESC_AG_COMERCIAL"].")");
			}
			$table='clients';
			$filter=array();
			$filter["code"]=array("operation"=>"=","value"=>$cliente_bd["COD_CLIENTE"]);
			if(isInBD($table,$filter)){
				error_log("[NS][Import Clients] Client Found (".$cliente_bd["COD_CLIENTE"]." ".$cliente_bd["NOMBRE_COMERCIAL_CLIENTE"].")");
				$data=array();
				$data["code"]=$cliente_bd["COD_CLIENTE"];
				$data["id_salesman"]=$agente_bd["COD_AGENTE_COMERCIAL"];
				$data["shop_name"]=plain_str($cliente_bd["NOMBRE_COMERCIAL_CLIENTE"]);
				$data["email"]=plain_str($cliente_bd["EMAIL_CLIENTE"]);
				$data["address_1"]=plain_str($cliente_bd["DIRECCION_CLIENTE"]);
				$data["address_2"]="";
				$data["city"]=plain_str($cliente_bd["LOCALIDAD_CLIENTE"]);
				$data["state"]=plain_str($cliente_bd["LOCALIDAD_CLIENTE"]);
				$data["post_code"]=plain_str($cliente_bd["CODIGO_POSTAL_CLIENTE"]);
				$data["country"]=plain_str($cliente_bd["COD_PAIS"]);
				$data["phone"]=plain_str($cliente_bd["TELEFONO_CLIENTE"]);
				$data["id_rate"]=$cliente_bd["ID_TARIFA"];
				$data["id_currency"]=3;
				$data["iva"]=0;
				$data["req"]=0;
				$data["prepayment_percent"]=0;
				$data["record_request"]=1;
				$data["discount"]=0;
				$data["bank_account"]=$cliente_bd["OFICINA"]." ".$cliente_bd["ENTIDAD"]." ".$cliente_bd["DIG_CONTROL"]." ".$cliente_bd["NUM_CUENTA"];
				$data["active"]=$cliente_bd["ACTIVO"];
				updateInBD($table,$filter,$data);
				error_log("[NS][Import Clients] Client Updated (".$cliente_bd["COD_CLIENTE"]." ".$cliente_bd["NOMBRE_COMERCIAL_CLIENTE"]."))");

			}else{
				error_log("[NS][Import Clients] Client NOT Found (".$cliente_bd["COD_CLIENTE"]." ".$cliente_bd["NOMBRE_COMERCIAL_CLIENTE"]."))");
				$data=array();
				$data["code"]=$cliente_bd["COD_CLIENTE"];
				$data["id_salesman"]=$cliente_bd["ID_AG_COMERCIAL"];
				$data["shop_name"]=plain_str($cliente_bd["NOMBRE_COMERCIAL_CLIENTE"]);
				$data["email"]=plain_str($cliente_bd["EMAIL_CLIENTE"]);
				$data["address_1"]=plain_str($cliente_bd["DIRECCION_CLIENTE"]);
				$data["address_2"]="";
				$data["city"]=plain_str($cliente_bd["LOCALIDAD_CLIENTE"]);
				$data["state"]=plain_str($cliente_bd["LOCALIDAD_CLIENTE"]);
				$data["post_code"]=plain_str($cliente_bd["CODIGO_POSTAL_CLIENTE"]);
				$data["country"]=plain_str($cliente_bd["COD_PAIS"]);
				$data["phone"]=plain_str($cliente_bd["TELEFONO_CLIENTE"]);
				$data["id_rate"]=$cliente_bd["ID_TARIFA"];
				$data["id_currency"]=3;
				$data["iva"]=0;
				$data["req"]=0;
				$data["prepayment_percent"]=0;
				$data["record_request"]=1;
				$data["discount"]=0;
				$data["bank_account"]=$cliente_bd["OFICINA"]." ".$cliente_bd["ENTIDAD"]." ".$cliente_bd["DIG_CONTROL"]." ".$cliente_bd["NUM_CUENTA"];
				$data["active"]=$cliente_bd["ACTIVO"];
				addInBD($table,$data);
				error_log("[NS][Import Clients] Client Updated (".$cliente_bd["COD_CLIENTE"]." ".$cliente_bd["NOMBRE_COMERCIAL_CLIENTE"]."))");

			}
		}



	}
	error_log("[NS][Import Clients] END");



}

function getImageProduct($productserial,$idproduct) {
	global $manejador;


	error_log("[Import Images] Import image from ".$productserial.", save as ".$productserial."-".$image_count.".jpg<br/>");
		$query = "select IMAGEN from PROD_MODELOS where COD_SERIE_MODELO='".$productserial."'";
		$server = conectaDBOkyCoky();
		$tb_linea2=mssql_query($query, $server);
		$product_bd = mssql_fetch_assoc($tb_linea2);
		touch("./tmp/temp_import_image.img");
		$fp = fopen("./tmp/temp_import_image.img", "w");
		fwrite($fp, $product_bd["IMAGEN"]);
		fclose($fp);
		$info = getimagesize("./tmp/temp_import_image.img");
		if (($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_JPEG2000))
			$imageorig = imagecreatefromjpeg("./tmp/temp_import_image.img");
		else if (($info[2] == IMAGETYPE_GIF))
			$imageorig = imagecreatefromgif("./tmp/temp_import_image.img");
		else if (($info[2] == IMAGETYPE_PNG))
			$imageorig = imagecreatefrompng("./tmp/temp_import_image.img");
		imagejpeg($imageorig, "./tmp/" . $productserial."-".$image_count.".jpg");
		rename("./tmp/" . $productserial."-".$image_count.".jpg","./images/images/" . $productserial."-".$image_count.".jpg");
		unlink("./tmp/temp_import_image.img");
		$image_count++;
		error_log("[Import Images] Import sketch from ".$productserial.", save as ".$productserial."-".$image_count.".jpg<br/>");
		$model = explode("-", $productserial);
		$tb_linea3 = mssql_query("select TOP 1 IMAGEN_PATRON from PROD_PATRON WHERE COD_PATRON='" . $model[1] . "' AND IMAGEN_PATRON IS NOT NULL", $server);
		$product_bd = mssql_fetch_assoc($tb_linea3);
		touch("./tmp/temp_import_image.img");
		$fp = fopen("./tmp/temp_import_image.img", "w");
		fwrite($fp, $product_bd["IMAGEN_PATRON"]);
		fclose($fp);
		$info = getimagesize("./tmp/temp_import_image.img");
		if (($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_JPEG2000))
			$imageorig = imagecreatefromjpeg("./tmp/temp_import_image.img");
		else if (($info[2] == IMAGETYPE_GIF))
			$imageorig = imagecreatefromgif("./tmp/temp_import_image.img");
		else if (($info[2] == IMAGETYPE_PNG))
			$imageorig = imagecreatefrompng("./tmp/temp_import_image.img");
		imagejpeg($imageorig, "./tmp/" . $productserial."-".$image_count.".jpg");
		rename("./tmp/" . $productserial."-".$image_count.".jpg","./images/images/" . $productserial."-".$image_count.".jpg");
		unlink("./tmp/temp_import_image.img");

	//$dir = "/var/www/retailers/classics/products/models/";
	$dir = dirname(dirname(__FILE__))."/products/models/";
	//$dir = "/var/www/classics/products/models/";
	$server = conectaDBOkyCoky();

	$productserial = str_replace("\xc3\x91", "\xd1", $productserial);

	$q = mssql_query("select IMAGEN from PROD_MODELOS WHERE COD_SERIE_MODELO='" . $productserial . "' AND IMAGEN IS NOT NULL", $server);
	while($lin = mssql_fetch_assoc($q)){
		//error_log("Importing Image");
			$image = $lin["IMAGEN"];
			db_query("insert into classic_images (def_model) values ('" . $productserial . "')", $manejador);
			$indice = db_last_id();
			db_query("insert into classic_image_products (id_image,id_product) values ('" . $indice . "', '".$idproduct."')", $manejador);
			$tempfile = $dir . "original/" . $indice . ".img";
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
			imagejpeg($imageorig, $dir . "original/" . $indice . ".jpg");
			$grande = imagecreatetruecolor(235, 468);
			$white = imagecolorallocate($grande, 255, 255, 255);
			imagefill($grande, 0, 0, $white);
			$pequena = imagecreatetruecolor(74, 152);
			$imagetam = getimagesize($tempfile);
			$escalado1 = 235 / $imagetam[0];
			$escalado2 = 468 / $imagetam[1];
			//echo "$escalado1 xx $escalado2";
			$escalado = ($escalado1 < $escalado2) ? $escalado1 : $escalado2;
			if ($escalado > 1)
				$escalado = 1;
			$ntams = array("w" => round($escalado * $imagetam[0]), "h" => round($escalado * $imagetam[1]));
			$desp = array("w" => (round(235 - $ntams["w"]) / 2), "h" => round((468 - $ntams["h"]) / 2));
			imagecopyresampled($grande, $imageorig, $desp["w"], $desp["h"], 0, 0, $ntams["w"], $ntams["h"], $imagetam[0], $imagetam[1]);
			imagejpeg($grande, $dir . "370/" . $indice . ".jpg");
			imagecopyresampled($pequena, $grande, 0, 0, 0, 0, 74, 152, 235, 468);
			imagejpeg($pequena, $dir . "74/" . $indice . ".jpg");


	}
	$model = explode("-", $productserial);
	$q = mssql_query("select TOP 1 IMAGEN_PATRON from PROD_PATRON WHERE COD_PATRON='" . $model[1] . "' AND IMAGEN_PATRON IS NOT NULL", $server);
	////error_log("lidos " . mssql_num_rows($q));
	if (mssql_num_rows($q) == 0) {
		return false;
	}
	$lin = mssql_fetch_assoc($q);
	$image = $lin["IMAGEN_PATRON"];
	db_query("insert into classic_images (def_model) values ('" . $productserial . "')", $manejador);
	$indice = db_last_id();
	db_query("insert into classic_image_products (id_image,id_product) values ('" . $indice . "', '".$idproduct."')", $manejador);
	$tempfile = $dir . "original/" . $indice . ".img";
	$fp = fopen($tempfile, "w");
	//if(is_writable($fp)) {
		fwrite($fp, $image);
	//} else {
//		//error_log("no se puede escribir la imagen");
//	}
	fclose($fp);
	$info = getimagesize($tempfile);
	if (($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_JPEG2000))
		$imageorig = imagecreatefromjpeg($tempfile);
	else if (($info[2] == IMAGETYPE_GIF))
		$imageorig = imagecreatefromgif($tempfile);
	else if (($info[2] == IMAGETYPE_PNG))
		$imageorig = imagecreatefrompng($tempfile);
	imagejpeg($imageorig, $dir . "original/" . $indice . ".jpg");
	$grande = imagecreatetruecolor(235, 468);
	$white = imagecolorallocate($grande, 255, 255, 255);
	imagefill($grande, 0, 0, $white);
	$pequena = imagecreatetruecolor(74, 152);
	$imagetam = getimagesize($tempfile);
	$escalado1 = 235 / $imagetam[0];
	$escalado2 = 468 / $imagetam[1];
	//echo "$escalado1 xx $escalado2";
	$escalado = ($escalado1 < $escalado2) ? $escalado1 : $escalado2;
	if ($escalado > 1)
		$escalado = 1;
	$ntams = array("w" => round($escalado * $imagetam[0]), "h" => round($escalado * $imagetam[1]));
	$desp = array("w" => (round(235 - $ntams["w"]) / 2), "h" => round((468 - $ntams["h"]) / 2));
	imagecopyresampled($grande, $imageorig, $desp["w"], $desp["h"], 0, 0, $ntams["w"], $ntams["h"], $imagetam[0], $imagetam[1]);
	imagejpeg($grande, $dir . "370/" . $indice . ".jpg");
	imagecopyresampled($pequena, $grande, 0, 0, 0, 0, 74, 152, 235, 468);
	imagejpeg($pequena, $dir . "74/" . $indice . ".jpg");

		//error_log("End Importing Image");


	//$image=hex2bin($image);
	return $indice;
}

function getImageProductPatron($productserial) {
	global $manejador;
	//$dir = "/var/www/retailers/classics/products/models/";
	$dir = dirname(dirname(__FILE__))."/products/models/";
	//$dir = "/var/www/classics/products/models/";
	$server = conectaDBOkyCoky();
	$model = explode("-", $productserial);
	$q = mssql_query("select TOP 1 IMAGEN_PATRON from PROD_PATRON WHERE COD_PATRON='" . $model[1] . "' AND IMAGEN_PATRON IS NOT NULL", $server);
	////error_log("lidos " . mssql_num_rows($q));
	if (mssql_num_rows($q) == 0) {
		return false;
	}
	$lin = mssql_fetch_assoc($q);
	$image = $lin["IMAGEN_PATRON"];
	$query = "select id_image from classic_images where def_model='".$productserial."'";
	$r = db_query($query, $manejador);
	if(db_count($r) == 0) {
		db_query("insert into classic_images (def_model) values ('" . $productserial . "')", $manejador);
		$indice = db_last_id();
	} else {
		$indice = db_result($r,0,0);
	}
	$tempfile = $dir . "original/" . $indice . ".img";
	$fp = fopen($tempfile, "w");
	//if(is_writable($fp)) {
		fwrite($fp, $image);
	//} else {
//		//error_log("no se puede escribir la imagen");
//	}
	fclose($fp);
	$info = getimagesize($tempfile);
	if (($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_JPEG2000))
		$imageorig = imagecreatefromjpeg($tempfile);
	else if (($info[2] == IMAGETYPE_GIF))
		$imageorig = imagecreatefromgif($tempfile);
	else if (($info[2] == IMAGETYPE_PNG))
		$imageorig = imagecreatefrompng($tempfile);
	imagejpeg($imageorig, $dir . "original/" . $indice . ".jpg");
	$grande = imagecreatetruecolor(235, 468);
	$white = imagecolorallocate($grande, 255, 255, 255);
	imagefill($grande, 0, 0, $white);
	$pequena = imagecreatetruecolor(74, 152);
	$imagetam = getimagesize($tempfile);
	$escalado1 = 235 / $imagetam[0];
	$escalado2 = 468 / $imagetam[1];
	//echo "$escalado1 xx $escalado2";
	$escalado = ($escalado1 < $escalado2) ? $escalado1 : $escalado2;
	if ($escalado > 1)
		$escalado = 1;
	$ntams = array("w" => round($escalado * $imagetam[0]), "h" => round($escalado * $imagetam[1]));
	$desp = array("w" => (round(235 - $ntams["w"]) / 2), "h" => round((468 - $ntams["h"]) / 2));
	imagecopyresampled($grande, $imageorig, $desp["w"], $desp["h"], 0, 0, $ntams["w"], $ntams["h"], $imagetam[0], $imagetam[1]);
	imagejpeg($grande, $dir . "370/" . $indice . ".jpg");
	imagecopyresampled($pequena, $grande, 0, 0, 0, 0, 74, 152, 235, 468);
	imagejpeg($pequena, $dir . "74/" . $indice . ".jpg");
	//$image=hex2bin($image);
	return $indice;
}

function getSeasons() {
	global $manejador;
	$server = conectaDBOkyCoky();
	$rs = mssql_query("select * from GEN_TEMPORADAS", $server);
	$i = 0;
	while ($lin = mssql_fetch_assoc($rs)) {
		$temporadas["id_season"][$i] = $lin["ID_TEMPORADA"];
		$temporadas["name_season"][$i] = $lin["DESC_TEMPORADA"];
		//echo "Temporada: id=$lin[ID_TEMPORADA]  nome=$lin[DESC_TEMPORADA]  marca=$lin[ACRONIMO] <br>";
		$i++;
	}
	return $temporadas;
}

function getModelSeason($model, $lines = array()) {
	if (sizeof($lines) > 0) {
		$cadena = "ID_LINEA IN(";
		$coma = "";
		foreach ($lines as $key => $value) {
			$cadena .= $coma . $value;
			$coma = ",";
		}
		$cadena .= ") AND ";

	} else
		$cadena = "";
	global $manejador;
	$server = conectaDBOkyCoky();
	$model = str_replace("\xc3\x91", "\xd1", $model);
	$query = "select * from PROD_MODELOS where " . $cadena . " COD_SERIE_MODELO LIKE '%" . $model . "%'";
	//error_log($query);
	$rs = mssql_query($query, $server);
	$j = 0;
	$lin = mssql_fetch_assoc($rs);
	foreach ($lin as $key=>$value){
		//error_log($key."=>".$value);
	}

	$imagen = 0;
	if ($lin["IMAGEN"] != "")
		$imagen = 1;
	$modelo = array("id" => $lin["ID"], "serial_model_code" => $lin["COD_SERIE_MODELO"], "id_family" => $lin["ID_FAMILIA"], "id_sizing" => $lin["ID_TALLAJE"], "public_pvp" => $lin["PVP_ACTUAL"], "name" => $lin["DESC_MODELO"], "description" => $lin["COMPOSICION"], "id_lavado" => $lin["SIMBOLO_LAVADO"], "id_lejiado" => $lin["SIMBOLO_LEJIADO"], "id_planchado" => $lin["SIMBOLO_PLANCHADO"], "id_lavado_seco" => $lin["SIMBOLO_LAVADO_SECO"], "id_secado" => $lin["SIMBOLO_SECADO"], "image" => $imagen, "id_season" => $lin["ID_TEMPORADA"]);
	for ($i = 1; $i <= 12; $i++) {
		if ($i == 1)
			$cad1 = "PVP";
		else
			$cad1 = "PVP_" . $i;
		$cad2 = "client_pvp_" . $i;
		$modelo[$cad2] = $lin[$cad1];
	}
	//print_r($modelos);
	return $modelo;

}

function insertModel($model) {
	global $manejador;
	$cad1 = "";
	$cad2 = "";
	$coma = "";
	foreach ($model as $key => $value) {
		if ($key == "image")
			continue;
		if ($key == "id")
			continue;
		$cad1 .= $coma . $key;
		$cad2 .= $coma . "'" . db_secure_field($value,$manejador) . "'";
		$coma = ",";
	}
	////error_log("insert into classic_products (".$cad1.") values (".$cad2.")");
	$query = "insert into classic_products (" . $cad1 . ") values (" . $cad2 . ")";
	db_query($query, $manejador);
	return db_last_id();
}

function updateModel($model) {
	global $manejador;
	$cad1 = "";
	$cad2 = "";
	$coma = "";
	foreach ($model as $key => $value) {
		if ($key == "serial_model_code")
			continue;
		if ($key == "image")
			continue;
		if ($key == "id")
			continue;
		$cad1 .= $coma . $key . "='" . db_secure_field($value, $manejador) . "'";
		$coma = ",";
	}
	error_log("update classic_products set " . $cad1 . " where serial_model_code='" . db_secure_field($model["serial_model_code"], $manejador) . "'");
	db_query("update classic_products set " . $cad1 . " where serial_model_code='" . db_secure_field($model["serial_model_code"], $manejador) . "'", $manejador);
	return $model;
}

function getColors($sercodname) {
	global $manejador;
	$sercodname = str_replace("\xc3\x91", "\xd1", $sercodname);

	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r1 = mssql_query("select t1.ID_COLOR_PROD as id_color,DESC_COLOR as name,NUM_COLOR as number from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where COD_SERIE_MODELO='" . $sercodname . "'", $server);
	$colors = array();
	while ($lin = mssql_fetch_assoc($r1)) {
		////error_log("insert into classic_colors (id_color,serial_model_code,name) values (".$lin["id_color"].",'".$sercodname."','".$lin["name"]."')");
		//*db_query("insert into classic_colors (id_color,serial_model_code,name) values (".$lin["id_color"].",'".$sercodname."','".$lin["name"]."')",$manejador);
		$colors["name"][] = $lin["name"];
		$colors["id"][] = $lin["id_color"];
		$colors["number"][] = $lin["number"];
	}
	return $colors;
}

function getColor($sercodname, $colorcode) {
	global $manejador;
	$sercodname = str_replace("\xc3\x91", "\xd1", $sercodname);
	$server = conectaDBOkyCoky();
	$r1 = mssql_query("select t1.ID_COLOR_PROD as id_color,DESC_COLOR as name,NUM_COLOR as number from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where t1.ID_COLOR_PROD='" . $colorcode . "' and COD_SERIE_MODELO='" . $sercodname . "'", $server);
	$colors = array();
	while ($lin = mssql_fetch_assoc($r1)) {
		$colors["name"][] = $lin["name"];
		$colors["id"][] = $lin["id_color"];
		$colors["number"][] = $lin["number"];
	}
	return $colors;
}

function getSeasonColors($season) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r1 = mssql_query("select t1.ID_COLOR_PROD as id_color,DESC_COLOR as name,NUM_COLOR as number from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where COD_SERIE_MODELO in (select COD_SERIE_MODELO from PROD_MODELOS where ID_TEMPORADA='" . $season . "')", $server);
	while ($lin = mssql_fetch_assoc($r1)) {
		////error_log("insert into classic_colors (id_color,serial_model_code,name) values (".$lin["id_color"].",'".$sercodname."','".$lin["name"]."')");
		//*db_query("insert into classic_colors (id_color,serial_model_code,name) values (".$lin["id_color"].",'".$sercodname."','".$lin["name"]."')",$manejador);
		$colors["name"][] = $lin["name"];
		$colors["id"][] = $lin["id_color"];
		$colors["number"][] = $lin["number"];
	}
	return $colors;
}

function getSeasonLines($season) {
	global $manejador;
	$server = conectaDBOkyCoky();
	$query = "select *,(select count(*) from PROD_MODELOS as t2 where t2.ID_LINEA=t1.ID_LINEA and ID_TEMPORADA=" . $season . ") as totmod from PROD_LINEAS as t1 where ID_LINEA in (select distinct ID_LINEA from PROD_MODELOS where ID_TEMPORADA='" . $season . "')";
	////error_log($query);
	$r1 = mssql_query($query, $server);
	while ($lin = mssql_fetch_assoc($r1)) {
		$lineas["name_season"][] = $lin["DESC_LINEA"];
		$lineas["id_season"][] = $lin["ID_LINEA"];
		$lineas["num_models"][] = $lin["totmod"];
	}
	return $lineas;
}

function getSeasonSeries($season, $filter = array()) {
	global $manejador;
	$server = conectaDBOkyCoky();
	$query = "select distinct COD_SERIE from PROD_MODELOS as t2 where ID_TEMPORADA=" . $season;
	////error_log($query);
	$r1 = mssql_query($query, $server);
	while ($lin = mssql_fetch_assoc($r1)) {
		$lineas["series"][] = $lin["COD_SERIE"];
	}
	return $lineas;
}

function getPropPed($idprop) {
	global $manejador;
	$server = conectaDBOkyCoky();
	$query = "select * from COM_PROPUESTAS_PEDIDOS where ID_PROPUESTA=" . $idprop;
	////error_log($query);
	$qr = mssql_query($query, $server);
	return mssql_fetch_assoc($qr);
}

function creaProPPed($datos) {
	global $manejador;
	$server = conectaDBOkyCoky();
	$res = db_query("insert into classic_order_request (id_client,fecha, total,subtotal,iva,req,num_clothes,user_comments) values ('" . $datos["CODCLI"] . "', NOW(),'" . $datos["total"] . "','" . $datos["subtotal"] . "','" . $datos["iva"] . "','" . $datos["req"] . "'," . $datos["products"] . ",'" . db_secure_field($datos["comments"], $manejador) . "')", $manejador);
	return db_last_id();
}

function addLinePropPed($line) {
	global $manejador;
	$server = conectaDBOkyCoky();
	$query = "insert into classic_lines_order_request (id_order_request, line_quantity, serial_model_code, comments, id_color, price, size_1, size_2, size_3, size_4, size_5, size_6, size_7, size_8, size_9, size_10, size_11, size_12) VALUES ('" . $line["ID_PROPUESTA"] . "', '" . $line["CANTIDAD_LINEA"] . "', '" . $line["COD_SERIE_MODELO"] . "', '' , '" . $line["ID_COLOR_PROD"] . "', '" . $line["PRECIO"] . "', '" . $line["TALLA_1"] . "', '" . $line["TALLA_2"] . "', '" . $line["TALLA_3"] . "', '" . $line["TALLA_4"] . "', '" . $line["TALLA_5"] . "', '" . $line["TALLA_6"] . "', '" . $line["TALLA_7"] . "', '" . $line["TALLA_8"] . "', '" . $line["TALLA_9"] . "', '" . $line["TALLA_10"] . "', '" . $line["TALLA_11"] . "', '" . $line["TALLA_12"] . "')";
	////error_log($query);
	mysql_query($query, $manejador);
}

function getTemporada($model) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select ACRONIMO,ID_TEMPORADA from GEN_TEMPORADAS where ID_TEMPORADA=(select ID_TEMPORADA from PROD_MODELOS where COD_SERIE_MODELO='" . $model . "')", $server);
	$s2 = mssql_fetch_assoc($r2);
	return array($s2["ACRONIMO"], $s2["ID_TEMPORADA"]);
}

function getTemporadaFromID($id) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select * from GEN_TEMPORADAS where ID_TEMPORADA=" . $id, $server);
	$s2 = mssql_fetch_assoc($r2);
	return array($s2["DESC_TEMPORADA"], $s2["ID_TEMPORADA"]);
}

function getProductLinea($model_serie) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select ID_LINEA from PROD_MODELOS where COD_SERIE_MODELO='" . $model_serie . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	return $s2["ID_LINEA"];
}

function getNextNumber($temporada) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select MAX(NUMERO) as numero from COM_PROPUESTAS_PEDIDOS where ID_TEMPORADA='" . $temporada . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	return $s2["numero"];
}

function getNextNumberPedido($temporada) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select MAX(NUM_PEDIDO) as numero from COM_PEDIDOS_CLIENTES where ID_TEMPORADA='" . $temporada . "'");
	$r2 = mssql_query("select MAX(NUM_PEDIDO_CLI) as numero from COM_PEDIDOS_CLIENTES where ID_TEMPORADA='" . $temporada . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	return $s2["numero"];
}

function getSellTypes($clientcode) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select ID_REGIMEN_IVA_1 as iva from COM_CLIENTES where COD_CLIENTE='" . $clientcode . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	return $s2;
}

function getSellTaxes($taxid) {
	global $manejador;
	$server = conectaDBOkyCoky();
	////error_log("select t1.ID_COLOR_SERIE as id_color,DESC_COLOR as name from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where REFERENCIA_PROVEEDOR is not null and COD_SERIE='".$cad[0]."'");
	$r2 = mssql_query("select VALOR from CONF_AUX_TIPO_REC_EQ where ID_TIPO_IVA='" . $taxid . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	$ret["req"] = $s2["VALOR"];
	$r2 = mssql_query("select VALOR from CONF_AUX_TIPO_IVA where ID_TIPO_IVA='" . $taxid . "'", $server);
	$s2 = mssql_fetch_assoc($r2);
	$ret["iva"] = $s2["VALOR"];
	return $ret;
}

function getIfModelHasImage($model) {
	global $manejador;

	$model = str_replace("\xc3\x91", "\xd1", $model);

	$r1 = db_query("select * from classic_image_products where id_product in (select id_product from classic_products where serial_model_code='" . $model . "') order by imgorder", $manejador);
	if (db_count($r1) > 0) {
		$salida = array();
		while ($im = db_fetch($r1)) {
			$salida[] = $im["id_image"];
		}
		return $salida;
	}
	$mr1 = db_query("select * from classic_images where def_model='" . $model . "' order by imgorder", $manejador);
	$salida = array();
	while ($im = db_fetch($mr1)) {
		$salida[] = $im["id_image"];
	}
	return $salida;
}


function getIfModelHasImageWithId($id_product) {
	global $manejador;
	$r1 = db_query("select * from classic_image_products where id_product='" . $id_product . "' order by imgorder", $manejador);
	if (db_count($r1) > 0) {
		$salida = array();
		while ($im = db_fetch($r1)) {
			$salida[] = $im["id_image"];
		}
		return $salida;
	}
	$mr1 = db_query("select * from classic_images where def_model='" . $model . "' order by imgorder", $manejador);
	$salida = array();
	while ($im = db_fetch($mr1)) {
		$salida[] = $im["id_image"];
	}
	return $salida;
}

function getFamilyName($idfam) {
	global $manejador;
	$mr1 = db_query("select * from classic_family where id_family='" . $idfam . "'", $manejador);
	$im = db_fetch($mr1);
	return $im["name"];
}

function addModelColors($model,$id_product, $colors) {
	global $manejador;
	foreach ($colors as $key => $color) {
		if (strtolower(trim($color[1])) == "undefined")
			continue;
		$query = "select id from classic_colors where id_color=".$color[0];
		$r = db_query($query, $manejador);
		if(db_count($r) == 0) {
			db_query("insert into classic_colors (id_color,serial_model_code,id_product,name,name_id_color,name_es,name_en,use_color) values (" . $color[0] . ",'" . $model . "'," . $id_product . ",'" . db_secure_field($color[1], $manejador) . "','" . db_secure_field($color[2], $manejador) . "','" . db_secure_field($color[3], $manejador) . "','" . db_secure_field($color[4], $manejador) . "',1)", $manejador);
			//return db_last_id();
		//} else {
			//return db_result($r,0,0);
		}
	}
}

function getSizesIndex($index) {
	global $manejador;
	$mr1 = db_query("select * from classic_sizings where id_sizing='" . $index . "'", $manejador);
	$im = db_fetch($mr1);
	foreach ($im as $key => $value) {
		if ($key == "id_sizing")
			continue;
		if ($value == "")
			continue;
		$sizes[] = $value;
	}
	return $sizes;
}

/*function getModelColorStock($model, $color) {
	return getModelColorStock2($model, $color);
	global $manejador;
	$server = conectaDBOkyCoky();

	$query = "select count(*) as total from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	////error_log($query);
	$stoc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$r1 = mssql_query($query, $server);
	$l1 = mssql_fetch_assoc($r1);
	if ($l1["total"] == 0) {
		return $stoc;

	}
	$query = "select * from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	////error_log($query);
	$r1 = mssql_query($query, $server);
	$lin = mssql_fetch_assoc($r1);
	$i = 0;
	foreach ($lin as $key => $value) {
		if (($key == "COD_SERIE_MODELO") || ($key == "ID_COLOR_PROD"))
			continue;
		$stoc[$i] = $value;
		$i++;
	}
	return $stoc;
}*/

function getModelColorStock($model, $color) {
	//return getModelColorStock2($model,$color);
	global $manejador;
	$server = conectaDBOkyCoky();

	$query = "select count(*) as total from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	//////error_log($query);
	$stoc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$r1 = mssql_query($query, $server);
	$l1=mssql_fetch_assoc($r1);
	if ($l1["total"]==0) {
		return $stoc;
	}
	$query = "select * from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	//////error_log($query);
	$r1 = mssql_query($query, $server);
	$query = "SELECT * FROM VCOM_LINEAS_PEDIDOS_CLIENTES_NO_ANULADOS_NO_SERVIDOS_AGRUPADO_ARTICULO where COD_SERIE_MODELO = '".$model."' and ID_COLOR_PROD=" . $color;
	$r2 = mssql_query($query, $server);
	$lin = mssql_fetch_assoc($r1);
	$lin2 = mssql_fetch_assoc($r2);
	$i = 0;
	foreach ($lin as $key => $value) {
		if (($key == "COD_SERIE_MODELO") || ($key == "ID_COLOR_PROD")) {
			continue;
		}
		if(strtoupper(substr($key,0,5))=="TALLA") {
			$stoc[$i] = $value - $lin2[$key];
		} else {
			$stoc[$i] = $value;
		}
		$i++;
	}
	return $stoc;
}


function getModelColorStock2($model, $color) {
	global $manejador;
	$server = conectaDBOkyCoky();

	$query = "select count(*) as total from prod_prendas where cod_serie_modelo='" . $model . "' and id_color_prod=" . $color . " and id_linea_pedido is null and id_almacen in (select id_almacen from alm_almacenes where de_prod_terminados=1 and tarado=0)";
	////error_log($query);
	$stoc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$r1 = mssql_query($query, $server);
	$l1 = mssql_fetch_assoc($r1);
	if ($l1["total"] == 0) {
		return $stoc;

	}
	$query = "select * from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	$query = "select sum(tallaje_1),sum(tallaje_2),sum(tallaje_3),sum(tallaje_4),sum(tallaje_5),sum(tallaje_6),sum(tallaje_7),sum(tallaje_8),sum(tallaje_9),sum(tallaje_10),sum(tallaje_11),sum(tallaje_12),sum(tallaje_1+tallaje_2+tallaje_3+tallaje_4+tallaje_5+tallaje_6+tallaje_7+tallaje_8+tallaje_9+tallaje_10+tallaje_11+tallaje_12) from prod_prendas where cod_serie_modelo='" . $model . "' and id_color_prod=" . $color . " and id_linea_pedido is null and id_almacen in (select id_almacen from alm_almacenes where de_prod_terminados=1 and tarado=0)";

	////error_log($query);
	$r1 = mssql_query($query, $server);
	$lin = mssql_fetch_assoc($r1);
	$i = 0;
	foreach ($lin as $key => $value) {
		if (($key == "COD_SERIE_MODELO") || ($key == "ID_COLOR_PROD"))
			continue;
		$stoc[$i] = $value;
		$i++;
	}
	return $stoc;
}

function getCareSymbols() {
	global $manejador;
	$server = conectaDBOkyCoky();
	$rs = mssql_query("select * from SIMBOLOS", $server);
	$i = 0;
	while ($lin = mssql_fetch_assoc($rs)) {
		$mq1 = db_query("select count(*) as total from classic_caresymbols where id_symbol=" . $lin["ID_SIMBOLO"], $manejador);
		$mr1 = db_fetch($mq1);
		if ($mr1["total"] == 0) {
			$mq2 = db_query("insert into classic_caresymbols (id_symbol,description) values('" . $lin["ID_SIMBOLO"] . "','" . db_secure_field($lin["DESC_SIMBOLO"], $manejador) . "')", $manejador);
		} else {
			$mq2 = db_query("update classic_sizings set " . $cad3 . " where id_sizing=" . $lin["ID_TALLAJE"], $manejador);
		}
		$i++;
	}
}

function getTextWash($idsymbol) {
	global $manejador;
	$r1 = db_query("select description from classic_caresymbols where id_symbol=" . $idsymbol, $manejador);
	$s1 = db_fetch($r1);
	return utf8_encode($s1["description"]);
}

function addImageToProduct($idimage, $idproduct) {
	global $manejador;
	$query = "select * from classic_image_products where id_image=".$idimage." and id_product=".$idproduct;
	$r = db_query($query, $manejador);
	if(db_count($r) == 0) {
		$r1 = db_query("insert into classic_image_products (id_image,id_product) values (" . $idimage . "," . $idproduct . ")", $manejador);
		return db_last_id();
	} else {
		return db_result($r,0,0);
	}
}

function getIdProduct($serialcode) {
	global $manejador;
	$r2 = db_query("select id_product from classic_products where serial_model_code='" . $serialcode . "'", $manejador);
	if (db_count($r2)==0) return -1;
	$s2 = db_fetch($r2);
	return $s2["id_product"];
}

function deleteImages($idmodel) {
	global $manejador;
	$r1 = db_query("delete from classic_image_products where id_product=" . $idmodel, $manejador);
	return 1;
}

function deleteModel($idproduct) {
	global $manejador;
	$r1 = db_query("delete from classic_products where serial_model_code='" . $idproduct . "'", $manejador);
	return 1;
}

function deleteColors($idproduct) {
	global $manejador;
	$r1 = db_query("delete from classic_colors where serial_model_code='" . $idproduct . "'", $manejador);
	return 1;
}

function getInstalledSeason() {
	global $manejador;
	$r2 = db_query("select id_season from classic_config", $manejador);
	$s2 = db_fetch($r2);
	return $s2["id_season"];
}

function getAllProductImages() {
	global $manejador;
	$r2 = db_query("select id_image from classic_images where def_model!='---'", $manejador);
	while ($s2 = db_fetch($r2)) {
		$images[]["id"] = $s2["id_image"];
	}
	return $images;
}

function getAllUploadedImages() {
	global $manejador;
	$images = array();
	$r2 = db_query("select id_image from classic_images where def_model='---'", $manejador);
	while ($s2 = db_fetch($r2)) {
		$images[]["id"] = $s2["id_image"];
	}
	return $images;
}

function deleteAllProducts($idtemp) {
	global $manejador;
	$query = "update classic_products set visible=0,old_season=1 where id_season!=" . $idtemp;
	////error_log($query);
	$r = db_query($query, $manejador);
	//$query = "truncate table classic_images";
	//$r = db_query($query, $manejador);
}

function productInDB($codser) {
	global $manejador;
	$r = db_query("select * from classic_products where serial_model_code='" . $codser . "'", $manejador);
	if (db_count($r) > 0)
		return true;
	return false;
}

function updateColorCodes() {
	global $manejador;
	global $conf;
	$server = conectaDBOkyCoky();
	$res = db_query("select * from classic_colors", $manejador);
	while ($lin = db_fetch($res)) {
		$r1 = mssql_query("select NUM_COLOR as number from PROD_COLORES_PRODUCTOS as t1 inner join PROD_COLORES as t2 on t1.ID_COLOR=t2.ID_COLOR where id_color_prod='" . $lin["id_color"] . "'", $server);
		$lin2 = mssql_fetch_assoc($r1);
		////error_log("update classic_colors set name_id_color='".$lin2["number"]."' where id_color=".$lin["id_color"]);
		db_query("update classic_colors set name_id_color='" . $lin2["number"] . "' where id_color=" . $lin["id_color"], $manejador);
	}
}

function getModelColorStockM($codser, $colornumber) {
	global $manejador;
	global $conf;
	$model = $codser;
	$server = conectaDBOkyCoky();
	$query = "select id_color_prod from prod_colores_productos as t1 inner join prod_colores as t2 on t1.id_color=t2.id_color where cod_serie_modelo='" . $model . "' and num_color='" . $colornumber . "M'";
	////error_log($query);
	$resc = mssql_query($query, $server);
	$mcolor = mssql_fetch_assoc($resc);
	$color = $mcolor["id_color_prod"];
	if ($color == "")
		return array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$query = "select count(*) as total from prod_prendas where cod_serie_modelo='" . $model . "' and id_color_prod=" . $color . " and id_linea_pedido is null and id_almacen in (select id_almacen from alm_almacenes where de_prod_terminados=1 and tarado=0)";
	////error_log($query);
	$stoc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$r1 = mssql_query($query, $server);
	$l1 = mssql_fetch_assoc($r1);
	if ($l1["total"] == 0) {
		return $stoc;

	}
	$query = "select * from VALM_EXISTENCIAS_ARTICULOS where COD_SERIE_MODELO='" . $model . "' and ID_COLOR_PROD=" . $color;
	$query = "select sum(tallaje_1),sum(tallaje_2),sum(tallaje_3),sum(tallaje_4),sum(tallaje_5),sum(tallaje_6),sum(tallaje_7),sum(tallaje_8),sum(tallaje_9),sum(tallaje_10),sum(tallaje_11),sum(tallaje_12),sum(tallaje_1+tallaje_2+tallaje_3+tallaje_4+tallaje_5+tallaje_6+tallaje_7+tallaje_8+tallaje_9+tallaje_10+tallaje_11+tallaje_12) from prod_prendas where cod_serie_modelo='" . $model . "' and id_color_prod=" . $color . " and id_linea_pedido is null and id_almacen in (select id_almacen from alm_almacenes where de_prod_terminados=1 and tarado=0)";

	////error_log($query);
	$r1 = mssql_query($query, $server);
	$lin = mssql_fetch_assoc($r1);
	$i = 0;
	foreach ($lin as $key => $value) {
		if (($key == "COD_SERIE_MODELO") || ($key == "ID_COLOR_PROD"))
			continue;
		$stoc[$i] = $value;
		$i++;
	}
	return $stoc;

}

function getPropPedData($season, $number) {
	$server = conectaDBOkyCoky();
	$query = "select * from COM_PEDIDOS_CLIENTES where ID_TEMPORADA='" . $season . "' and NUM_PEDIDO_CLI='" . $number . "'";
	$r1 = mssql_query($query, $server);
	$d1 = mssql_fetch_assoc($r1);
	$query1 = "select COD_SERIE_MODELO from COM_LINEAS_PEDIDOS_CLIENTES where ID_PEDIDO_CLI='".$d1["ID_PEDIDO_CLI"]."' group by COD_SERIE_MODELO";
	$r2 = mssql_query($query1, $server);
	return $r2;
}
function getPedLineData($season, $number, $cod_serie_modelo) {
	$server = conectaDBOkyCoky();
	$query = "select * from COM_PEDIDOS_CLIENTES where ID_TEMPORADA='" . $season . "' and NUM_PEDIDO_CLI='" . $number . "'";
	$r1 = mssql_query($query, $server);
	$d1 = mssql_fetch_assoc($r1);

	$cod_serie_modelo = str_replace("\xc3\x91", "\xd1", $cod_serie_modelo);

	$query1 = "select * from COM_LINEAS_PEDIDOS_CLIENTES where ID_PEDIDO_CLI='".$d1["ID_PEDIDO_CLI"]."' and COD_SERIE_MODELO='".$cod_serie_modelo."'";
	////error_log($query1);
	$r2 = mssql_query($query1, $server);
	return $r2;
}
?>
