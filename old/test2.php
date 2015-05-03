<?php 
	include_once("./include/bdOC.php");
	include_once("./include/inbd.php");
	
	/*
	$table='product_categories';
	$filter=array();
	$filter["id_category"]=array("operation"=>"=","value"=>18);
	$product_categories=listInBD($table,$filter);
	$count=0;
	foreach($product_categories as $key=>$product_category){
		$table="products";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
		$product=getInBD($table,$filter);
		echo $product_category["id_product"]." [".$product["sizable"]."]<br/>";
		$count++;
		
	}
	echo "Count ".$count;
	
	$table='product_categories';
	$filter=array();
	$filter["id_category"]=array("operation"=>"=","value"=>18);
	$product_categories=listInBD($table,$filter);
	foreach($product_categories as $key=>$product_category){
		$table="products";
		$filter=array();
		$filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
		$data=array();
		$data["sizable"]=0;
		updateInBD($table,$filter,$data);
		echo $product_category["id_product"]." [OK]<br/>";
		
	}
	die();
	*/
	/*
	$table='products';
	$filter=array();
	$filter["visible"]=array("operation"=>"=","value"=>0);
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
		$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
		$product=getInBD($table,$filter);
		
		$table="products";
		$data=array();
		$data["id_product"]=$product["id_product"];
		$data["id_category"]=$category;
		addInBD($table,$filter);
		
	}*/
	/*$serial_model_codes=array("3773-IHE","3754-MOK","4707-VOE","4702-ZAS","4705-FIA","3729-FES","3729-AEB","3783-COG","4702-VOE","4751-KIF","4705-ECU","4715-GAF","4720-EGU","3773-BUQ","3763-ARQ","4703-ASP","4720-BEU1","4715-KOF","3773-IFN","3703-OIR","4721-ZOT","4707-EUF","4714-BOQ","4707-MOF","4718-VOE","3720-OFU","4727-OCH","4751-ORU","3757-MOY","3755-NIX","4717-BUY","4717-ALN","4725-REI","3759-BOX","3753-NIM","3753-IME","4704-AEB","4706-WUO","3722-AEB","3738-BIV","3716-KUB","3780-WOR","4704-BEU1","3729-EGU","4727-KOF","4704-FIA","4727-BRI","4702-NIX","3711-MCU","4750-WUO","4750-BEU4","4703-VOE","4703-JAB","4702-BOQ","3720-END","3781-JIJ","4716-JAB","4703-AEB","4703-BRI","4704-ZAS","3726-LOJ","4703-JON","4703-EGU","4702-BRI1","4711-BEU1","4702-KOF","3747-NAC","3751-EOL","3738-MOT","4713-ORU","3751-GUB","3743-BUY","3790-WUO1","3734-FOF","3701-EPU","3720-LLI","3703-CLY","3720-AKR","3714-NEN");
	
	foreach ($serial_model_codes as $key=>$serial_model_code){
		$table="products";
		$filter=array();
		$filter["serial_model_code"]=array("operation"=>"=","value"=>$serial_model_code);
		$data=array();
		$data["visible"]=0;
		updateInBD($table,$filter,$data);
	}*/
	echo "Done!";
		
?>