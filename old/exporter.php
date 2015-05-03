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

		$server = conectaDBOkyCoky();
		if(!isset($_GET["order_id"])){
			?>
	<div style='text-align:center;margin-top:20px'>
		<img src='./img/interface/okycoky-logo.png'/>
	</div>
	<h1 style='text-align:center;font-size:25px;margin-top:20px'>Elastic - EXPORTER</h1>
	<div style='text-align:center;margin-top:20px;background-color:#f4f4f4;border:1px solid #d4d4d4;width:600px;padding:20px;margin:20px auto;'>
		<div>
			Pedido #??????
		</div>
		<div>
			<i class='fa fa-times' style='font-size:100px;color:red'></i>
		</div>
		<p>
			No se ha podido Exportar el pedido
		</p>

	</div>

			<?php
			die();
		}
		$order_id=$_GET["order_id"];

?>
	<div style='text-align:center;margin-top:20px'>
		<img src='./img/interface/okycoky-logo.png'/>
	</div>
	<h1 style='text-align:center;font-size:25px;margin-top:20px'>Elastic - EXPORTER</h1>
	<div style='text-align:center;margin-top:20px;background-color:#f4f4f4;border:1px solid #d4d4d4;width:600px;padding:20px;margin:20px auto;'>
		<div>
			Pedido #<?php echo $order_id;?>
		</div>
		<div>
			<i class='fa fa-check' style='font-size:100px;color:green'></i>
		</div>
		<p>
			El pedido ha sido Exportado
		</p>
		<h4  style='text-align:left;'>Consola</h4>
		<pre style='text-align:left;font-size:11px;background-color:white;border:1px solid #d4d4d4;width:560px;padding:20px;margin:10px auto;overflow:auto;'>
		<?php

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
	$order_elastic["DIRECCION_CLI"]=$client_elastic["DIRECCION_CLIENTE"];
	$order_elastic["LOCALIDAD_CLI"]=$client_elastic["LOCALIDAD_CLIENTE"];
	$order_elastic["COD_POSTAL_CLI"]=$client_elastic["CODIGO_POSTAL_CLIENTE"];
	$order_elastic["COD_PROVINCIA_CLI"]=$client_elastic["COD_PROVINCIA"];
	$order_elastic["BASE_IMPONIBLE"]=$order["total_with_discount_no_iva"];
	$order_elastic["IMPORTE_LINEAS"]=$order["total_with_discount"];
	$order_elastic["SUBTOTAL"]=$order["total_with_discount"];
	$order_elastic["CON_DESCUENTO"]=$order["total_with_discount_no_iva"];
	$order_elastic["IMPORTE_IVA"]=$order["total_with_discount_iva"];
	$order_elastic["ARTICULOS_PEDIDOS"]=$order["num_clothes"];
	$order_elastic["IMPORTE_ARTICULOS_PEDIDOS"]=$order["total_with_discount_no_iva"];
	$order_elastic["CANTIDAD_PRENDAS"]=$order["num_clothes"];
	$order_elastic["NOMBRE_CLIENTE"]=$client_elastic["NOMBRE_CLIENTE"];
	$order_elastic["CIF_CLI"]=$client_elastic["CIF_CLIENTE"];
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

	    $query="select p.*,cp.* from PROD_PRENDAS as p,PROD_COLORES_PRODUCTOS as cp WHERE p.COD_SERIE_MODELO='".$order_line["serial_model_code"]."' AND p.SERVIDA=0 AND cp.ID_COLOR_PROD=".$order_line["id_color"]." AND p.COD_SERIE_MODELO=cp.COD_SERIE_MODELO ";
		echo $query."<br><br><br>";

		$q = mssql_query($query, $server);

		while($lin = mssql_fetch_assoc($q)){
			$product_elastic=$lin;

		}


	    $linea_order_elastic["PRECIO"]=$order_line["unitary_price_no_iva"];
	    $linea_order_elastic["ID_COLOR_PROD"]=$product_elastic["ID_COLOR_PROD"];
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

	$table="order_request";
	$filter=array();
	$filter["id_order"]=array("operation"=>"=","value"=>$order_id);
	$data=array();
	$data["exported"]=1;
	updateInBD($table,$filter,$data);


		?>
		</pre>
	</div>

</body>
