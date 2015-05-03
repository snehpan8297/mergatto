<?php
	@session_start();
	if (!(isset($_SESSION['admin_classics']))) {
	    header("location:./admin.php");
	}
?>

<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es" xml:lang="es" 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:data='http://www.google.com/2005/gml/data' 
xmlns:expr='http://www.google.com/2005/gml/expr' 
xmlns:og='http://opengraphprotocol.org/schema/'>
<head>
	<meta content="Ninktec Community Technologies S.L." property='og:author'/>
	<meta name="title" content="OKY COKY CLASSICS | OUTLET SHOP IMPORTER" />
	<meta name="author" content="NinkTec Community Technologies S.L." />
	<meta name="rating" content="General" />
	<meta name="copyright" content="Ninktec Community Technologies 2012" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="assets/countdown/jquery.countdown.css" />

	<link rel="shortcut icon" type="image/x-icon" href="./img/interface/okycokyclassics.ico" /> 
	<link rel="stylesheet" href="./js/chocoslider/chocoslider.css" type="text/css" />
	<link rel="stylesheet" href="./theme/ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
	<script type="text/javascript" src="./js/capsule_preload.js"></script>
	<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="./js/jquery.chocoslider.js"></script>
	<script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
	<link rel="stylesheet" href="./theme/font-awesome.css" type="text/css" />
	<link rel="apple-touch-icon" href="../touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../touch-icon-ipad-retina.png">
	<title>OKY COKY CLASSICS | OUTLET SHOP IMPORTER</title>
</head>
<body>
<?php 
	include('./theme/styles.php');
	include_once("./include/bdOC.php");
	include_once("./include/inbd.php");

	if(!isset($_POST["step"])){
		$step=1;
	}else{
		$step=$_POST["step"];
	}
	
	if($step==2){
		if((!isset($_POST["id_order"]))||(empty($_POST["id_order"]))){
			$step=1;
		}else{
			$id_season=$_POST["id_season"];
			$num_order=$_POST["id_order"];
			$query = "select pa.DESC_PATRON, p.ID_TEMPORADA as PRODUCTO_ID_TEMPORADA, p.DESC_MODELO as PRODUCTO_DESC_MODELO, p.ID_FAMILIA as PRODUCTO_ID_FAMILIA, p.PVP_ACTUAL as PRODUCTO_PVP_ACTUAL, p.COMPOSICION as PRODUCTO_COMPOSICION,l.*,c.* from PROD_PATRON as pa, PROD_MODELOS as p, COM_PEDIDOS_CLIENTES as pc,COM_LINEAS_PEDIDOS_CLIENTES as l, PROD_COLORES_PRODUCTOS as cp, PROD_COLORES as c  where pc.ID_TEMPORADA='".$id_season."' and pc.NUM_PEDIDO_CLI='".$num_order ."' and l.ID_PEDIDO_CLI=pc.ID_PEDIDO_CLI and cp.ID_COLOR_PROD=l.ID_COLOR_PROD and cp.ID_COLOR=c.ID_COLOR and p.COD_SERIE_MODELO=l.COD_SERIE_MODELO and pa.COD_PATRON=p.COD_PATRON";
			$server = conectaDBOkyCoky();
			$tb_linea=mssql_query($query, $server);
			while($linea_bd = mssql_fetch_assoc($tb_linea)){
				$products[]=$linea_bd;	
			}
		}
	}

?>
	<div style='text-align:center;margin-top:20px'>
		<img src='./img/interface/okycoky-logo.png'/>
	</div>
	<h1 style='text-align:center;font-size:25px;margin-top:20px'>Elastic - IMPORTER</h1>
	<?
	if($step==1){
	?>
		<div style='text-align:center;margin-top:20px' id='super_main'>
			<form id='step_1' action="./importer.php" method="POST">
				<div style='margin-bottom:20px'>
					Order id#
				</div>
				<div style='margin-bottom:20px'>
					<input style='font-size:14px;padding:5px 10px;' type='text' name="id_order"/>
				</div>
				<div style='margin-bottom:10px'>
					Season
				</div>
				<div style='margin-bottom:20px'>
					<?php
					$seasons = getSeasons();
					?>
					<select name='id_season'>
						<?php
							for($sesion = 0; $sesion < sizeof($seasons["name_season"]); $sesion++) {
								echo "<option value='".$seasons["id_season"][$sesion]."'>".utf8_encode($seasons["name_season"][$sesion])."</option>";
							}
						?>
					</select>
				</div>
				<div style='margin-bottom:20px'>
					<input type='hidden' name='step' value='2'/>
					<input type='submit' class='btn btn-dark' value='import'/>
				</div>
			</form>
		</div>
	<?php
	}else if($step==2){
		?>
		<div style='text-align:center;margin-top:20px' id='super_main'>
			<table>
				<tr>
					<th><input type='checkbox' id='check_all'</th>
					<th>Estado</th>
					<th>Code</th>
					<th>Imagen en sistema</th>
					<th>Imagenes en importadas</th>
					<th>Precio</th>
					<th>Descuento</th>
					<th>Precio Final</th>
				</tr>
			<?php
			foreach ($products as $key=>$product){
				?>
				<tr>
					<td><input type='checkbox' class='import' name='import_<?php echo $key;?>'/></td>
					<td>
						<?php
						$table="products";
						$filter=array();
						$filter["serial_model_code"]=array("operation"=>"=","value"=>$product["PRODUCTO_PVP_ACTUAL"]);
						if(isInBD($table,$filter)){
							echo "<span style='color:green'>Actualizar</span>";	
						}else{
							echo "<span style='color:orange'>Nuevo</span>";
						}
						?>
					</td>
					<td><input type='text' name='serial_model_code_<?php echo $key;?>' value='<?php echo $product["COD_SERIE_MODELO"];?>'/></td>
					<td>
					<?php
						if(file_exists("./images/images/".$product["COD_SERIE_MODELO"]."-1.jpg")){
							?>
							<img src="./images/images/<?php echo $product["COD_SERIE_MODELO"];?>-1.jpg" height=100px;/>
							<?php
						}else{
							echo "";
						}
					?>
					</td>
					<td></td>
					<td><input type='text' style='text-align:right;width:50px;' name='serial_model_code_<?php echo $key;?>' value='<?php echo $product["PRODUCTO_PVP_ACTUAL"];?>'/> &euro;</td>
					<td><input type='text' style='text-align:right;width:50px;' name='discount_<?php echo $key;?>' value='0'/> %</td>
					<td><input type='text' style='text-align:right;width:50px;' name='price_with_discount_<?php echo $key;?>' value='<?php echo $product["PRODUCTO_PVP_ACTUAL"];?>'/> &euro;</td>
				</tr>
				<?php
			}	
			?>
			</table>
			<script>
				$(document).ready(function(){
					$("#check_all").click(function(){
						if($("#check_all").is(":checked")){
							$(".import").prop("checked","checked");
						}else{
							$(".import").prop("checked","");
						}
					});
				});
			</script>
		</div>
		<?php	
	}
	?>
</body>

<?php
?>
<?php
	/*
	$id_season=31;
	$num_order=5481;
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
	/*$table='products';
	$products=listInBD($table);
	foreach ($products as $key => $product){
		$product["serial_model_code"]=strtoupper($product["serial_model_code"]);
		$query = "select p.PVP from PROD_MODELOS as p where p.COD_SERIE_MODELO='".$product["serial_model_code"]."'";
		$server = conectaDBOkyCoky();
		$tb_linea=mssql_query($query, $server);
		$product_bd = mssql_fetch_assoc($tb_linea);
		if($product_bd["PVP"]==0){
			$product["serial_model_code"]=str_replace("N", "Ñ", $product["serial_model_code"]);
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