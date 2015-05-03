<?php
	include_once("../../include/bdOC.php");
	include_once("../../include/inbd.php");
	
	//$id_season=31;
	//$num_order=5481;
	
	/*
	$query = "select pa.DESC_PATRON, p.ID_TEMPORADA as PRODUCTO_ID_TEMPORADA, p.DESC_MODELO as PRODUCTO_DESC_MODELO, p.ID_FAMILIA as PRODUCTO_ID_FAMILIA, p.PVP_ACTUAL as PRODUCTO_PVP_ACTUAL, p.COMPOSICION as PRODUCTO_COMPOSICION,l.*,c.* from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";
	$server = conectaDBOkyCoky();
	$tb_linea=mssql_query($query, $server);
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

?>