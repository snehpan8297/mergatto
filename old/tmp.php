<?php
	include_once("./include/bdOC.php");
	include_once("./include/inbd.php");

 	die();

	$products=array();

	$id_season=29;
	$num_order=5135;
	$query = "select p.COD_SERIE_MODELO,l.*,c.* from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";
	$server = conectaDBOkyCoky();
	$tb_linea=mssql_query($query, $server);
	echo "---<br/>";
	while($linea_bd = mssql_fetch_assoc($tb_linea)){
		$linea_bd["NUM_COLOR"]=str_replace("M","",$linea_bd["NUM_COLOR"]);
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_1"]+=$linea_bd["TALLA1"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_2"]+=$linea_bd["TALLA2"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_3"]+=$linea_bd["TALLA3"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_4"]+=$linea_bd["TALLA4"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_5"]+=$linea_bd["TALLA5"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_6"]+=$linea_bd["TALLA6"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_7"]+=$linea_bd["TALLA7"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_8"]+=$linea_bd["TALLA8"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_9"]+=$linea_bd["TALLA9"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_10"]+=$linea_bd["TALLA10"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_11"]+=$linea_bd["TALLA11"];
		$products[$linea_bd["COD_SERIE_MODELO"]][$linea_bd["NUM_COLOR"]]["stock_12"]+=$linea_bd["TALLA12"];
	}


	foreach ($products as $serial_model_code => $product){
		foreach ($product as $color=>$stock){

			echo "[".$serial_model_code." - ".$color."]<br/>";
			echo "<table>";
			echo "<tr>";
			echo "<td>Original</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_1"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_2"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_3"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_4"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_5"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_6"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_7"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_8"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_9"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_10"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_11"]."</td>";
			echo "<td>".$products[$serial_model_code][$color]["stock_12"]."</td>";
			echo "</tr>";


			$table="colors";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
			$filter["name_id_color"]=array("operation"=>"=","value"=>$color);
			$color_db=getInBD($table,$filter);

			$table="lines_order_request";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
			if($color_db["id_color"]!=""){
				$filter["complex"]="id_color=".$color_db["id_color"]." or name_color='".$color."'";
			}else{
				$filter["complex"]="name_color='".$color."'";
			}

			if(isInBD($table,$filter)){
				$lines_order=listInBD($table,$filter);
				foreach ($lines_order as $key=>$line_order){

					$table="order_request";
					$filter=array();
					$filter["id_order"]=array("operation"=>"=","value"=>$line_order["id_order_request"]);
					$filter["date"]=array("operation"=>">","value"=>1422576000);
					$order=getInBD($table,$filter);
					echo "<tr>";
					echo "<td>Order (".$order["id_order"].")</td>";
					for($i=1;$i<=12;$i++){
						$products[$serial_model_code][$color]["stock_".$i]-=$line_order["size_".$i];
						if ($products[$serial_model_code][$color]["stock_".$i]<0){
							$products[$serial_model_code][$color]["stock_".$i]=0;
						}
						echo "<td>".$products[$serial_model_code][$color]["stock_".$i]."</td>";
					}
					echo "</tr>";

				}


			}

			$table="colors";
			$filter=array();
			$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
			$filter["name_id_color"]=array("operation"=>"=","value"=>$color);
			if(isInBD($table,$filter)){
				$color_db=getInBD($table,$filter);

				$table="stocks";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$color_db["id_product"]);
				$filter["id_color"]=array("operation"=>"=","value"=>$color_db["id"]);
				if(isInBD($table,$filter)){
					$stock_db=getInBD($table,$filter);
					echo "<tr>";
					echo "<td>DB</td>";
					$data=array();
					for($i=1;$i<=12;$i++){
						echo "<td";
						if($stock_db["stock_size_".$i]!=$products[$serial_model_code][$color]["stock_".$i]){
							echo " style='color:red' ";
						}else{
							echo " style='color:green' ";
						}
						echo ">".$stock_db["stock_size_".$i]."</td>";
						$data["stock_size_".$i]=$products[$serial_model_code][$color]["stock_".$i];
					}
					updateInBD($table,$filter,$data);
					echo "</tr>";
				}
			}
			echo "</table>";



		}
	}

	echo "---<br/>";
	die();

	$query = "select p.COD_SERIE_MODELO,p.PVP, p.PVP_3 from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";
	$server = conectaDBOkyCoky();
	$tb_linea=mssql_query($query, $server);
	echo "---<br/>";
	while($linea_bd = mssql_fetch_assoc($tb_linea)){
		echo $linea_bd["COD_SERIE_MODELO"]." - ".$linea_bd["PVP"]." x 2.5 = ".($linea_bd["PVP"]*2.5)." | ".$linea_bd["PVP_3"]." x 2.5 = ".($linea_bd["PVP_3"]*2.5)." | ".$linea_bd["PVP_3"]." x 2.7 = ".($linea_bd["PVP_3"]*2.7)."<br/>";
	}
	echo "---<br/>";
	/*
	echo "<pre>";
	echo "[Import Images] START<br/>";
	while($linea_bd = mssql_fetch_assoc($tb_linea)){
		$image_count=1;
		for($i=1;$i<=12;$i++){
			if(!file_exists("./images/images/".$linea_bd["COD_SERIE_MODELO"]."-".$i.".jpg")){
				$image_count=$i;
				$i=15;
			}
		}

		echo "[Import Images] Import image from ".$linea_bd["COD_SERIE_MODELO"].", save as ".$linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg<br/>";
		$query = "select IMAGEN from PROD_MODELOS where COD_SERIE_MODELO='".$linea_bd["COD_SERIE_MODELO"]."'";
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
		imagejpeg($imageorig, "./tmp/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg");
		rename("./tmp/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg","./images/images/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg");
		unlink("./tmp/temp_import_image.img");
		$image_count++;
		echo "[Import Images] Import sketch from ".$linea_bd["COD_SERIE_MODELO"].", save as ".$linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg<br/>";
		$model = explode("-", $linea_bd["COD_SERIE_MODELO"]);
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
		imagejpeg($imageorig, "./tmp/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg");
		rename("./tmp/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg","./images/images/" . $linea_bd["COD_SERIE_MODELO"]."-".$image_count.".jpg");
		unlink("./tmp/temp_import_image.img");

	}
	echo "[Import Images] END<br/>";
	echo "</pre>";
	die();
*/
	/*$table='products';
	$products=listInBD($table);
	foreach ($products as $key => $product){
		$product["serial_model_code"]=strtoupper($product["serial_model_code"]);
		$query = "select p.PVP from PROD_MODELOS as p where p.COD_SERIE_MODELO='".$product["serial_model_code"]."'";
		$server = conectaDBOkyCoky();
		$tb_linea=mssql_query($query, $server);
		$product_bd = mssql_fetch_assoc($tb_linea);
		if($product_bd["PVP"]==0){
			$product["serial_model_code"]=str_replace("N", "�", $product["serial_model_code"]);
			$query = "select p.PVP from PROD_MODELOS as p where p.COD_SERIE_MODELO='".$product["serial_model_code"]."'";
			$server = conectaDBOkyCoky();
			$tb_linea=mssql_query($query, $server);
			$product_bd = mssql_fetch_assoc($tb_linea);
		}
		$max_pvp_bd=$product_bd["PVP"]*2.5;

		$table='products';
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
		$data=array();
		$data["pvp"]=$max_pvp_bd;
		updateInBD($table,$filter,$data);

		if($max_pvp_bd>$product["pvp"]){
			error_log("[2.2.1] UP [".$product["serial_model_code"]."] ".$product["pvp"]." => ".$max_pvp_bd);
		}else if($max_pvp_bd==$product["pvp"]){
			error_log("[2.2.1] EQUAL [".$product["serial_model_code"]."] ".$product["pvp"]." => ".$max_pvp_bd);
		}else{
			error_log("[2.2.1] DOWN [".$product["serial_model_code"]."] ".$product["pvp"]." => ".$max_pvp_bd);

		}
	}*/
	/*$serial_model_codes=array("3605-ADL","3620-LUQ","3701-EPU","3704-ATT","3704-CIL","3704-ENI","3704-EYE","3704-GIF","3704-IBI","3704-JOC","3704-LAP","3705-ENH","3705-FUK","3705-OCT","3706-EIX","3706-YOE","3707-ABY","3707-CIL","3707-EYE","3707-HIZ","3707-HOM","3707-JES","3707-OZE","3709-KOB","3709-NIB","3709-XOU","3711-AHU","3711-EPS","3711-EXO","3711-GET","3711-HIZ","3711-MAH","3711-MAT","3713-FUC","3713-IAS","3714-LAP","3715-ACI","3715-GET","3715-GOG","3716-GEC","3716-NIM","3718-ABY","3718-HOM","3720-LEE","3720-ONZ","3721-RAK","3722-CUP","3722-LLO","3722-LOS","3722-MCU","3722-MJE","3723-KIT","3723-OTI","3723-RIO","3725-EGL","3725-NUI","3726-XUO","3727-NUG","3728-ERE","3728-FAT","3728-NUG","3729-FES","3729-NIM","3731-ABY","3731-FEB","3731-TIZ","3733-XUO","3740-IGA","3740-ILA","3743-AIB","3743-RIJ","3745-JEB","3745-NIZ","3745-ORS","3745-OTI","3745-XAI","3748-ILA","3748-IME","3749-IWA","3749-OER","3751-DOV","3751-OWE","3751-ZAF","3752-ERE","3753-ESQ","3754-LEJ","3755-DEV","3755-JAG","3758-ISA","3758-OYE","3759-JUC","3759-OWE","3761-CIL","3761-ENI","3761-HOK","3761-JUK","3761-XOU","3763-AJI","3763-ISC","3763-JIP","3766-JUC","3773-GNO");
	$category=8;
	$table="product_categories";
	$filter=array();
	$filter["id_category"]=array("operation"=>"=","value"=>$category);
	deleteInBD($table,$filter);

	foreach ($serial_model_codes as $key=>$serial_model_code){
		$table="products";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
		$product=getInBD($table,$filter);


		$table="product_categories";
		$data=array();
		$data["id_product"]=$product["id_product"];
		$data["id_category"]=$category;
		addInBD($table,$data);
	}
	*/
	?>
