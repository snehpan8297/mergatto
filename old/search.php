<?php
//Lang confirm
@session_start();
$page = "list";
$page_title = "Buscar";

include("header.php");
if(isset($_GET["search_input"])) {
	$search = $_GET["search_input"];
} else {
	$search = "";
}
$limit = 0;
$pag = 0;
$table='products';

$complex_str="";
$not_serial_model_code=false;

if((strlen($search)==8)||(strlen($search)==9)){
	$array_search=explode("-", $search);
	if((strlen($array_search[0])==4)&&((strlen($array_search[1])==3)||(strlen($array_search[1])==4))){
		$complex_str="(serial_model_code = '".$search."' and visible=1)";
	}else{
		$not_serial_model_code=true;
	}
}else{
	$not_serial_model_code=true;
}
if($not_serial_model_code){
	$search=strtoupper($search);
	$search=str_replace("-", "|", $search);
	$search=str_replace("_", "|", $search);
	$search=str_replace("�", "N", $search);
	$search=str_replace(" ", "|", $search);
	$array_search=explode("|", $search);
	$and="";
	$bracket="(";
	$or="";


	foreach ($array_search as $key => $value){
		$complex_str .= $bracket.$or."serial_model_code LIKE '%".$value."%'";
		$or=" or ";
		$bracket="";
		$complex_str .= $or."name_es LIKE '%".$value."%'";
		$complex_str .= $or."name_en LIKE '%".$value."%'";
		$complex_str .= $or."description_es LIKE '%".$value."%'";
		$complex_str .= $or."description_en LIKE '%".$value."%'";
		$complex_str .= $or."hidden_description LIKE '%".$value."%'";

	}
	$complex_str .= ") and visible=1";
}


$filter=array();


$filter["complex"]=$complex_str;
error_log($complex_str);
$products=listInBD($table,$filter);
$r = searchProducts($search);
?>
<div id='content'>
	<div id="section_header">
		<div class="inner">
		</div>
	</div>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><span class='important'><?php echo $s["search_title"].": ".$search; ?></span></div>
	</div>
	<div class='contentbox'>
		<div id='item_list'>
			<?php
				$count=0;
			$pp = 0;
			foreach ($products as $key => $p){
				$table="product_categories";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$p["id_product"]);
				$product_categories=listInBD($table,$filter);
				$show_category=false;
				foreach ($product_categories as $key=>$product_category){
					$table="categories";
					$filter=array();
					$filter["id_category"]=array("operation"=>"=","value"=>$product_category["id_category"]);
					$category=getInBD($table,$filter);

					if(!((isset($userdata['name']))&&(!empty($userdata['name'])))){
						$userdata["id_client_group"]=0;
					}
					if(($category["show_in_menu"]==1)&&(($category["id_client_group"]==0)||($category["id_client_group"]==$userdata["id_client_group"]))){
						$show_category=true;
					}
				}
				if($show_category){
					$table='stocks';
					$filter=array();
					$name = $p["name_".$lang];
					if($lang!="es" && $p["name_".$lang]!="") {
						$name = $p["name_".$lang];
					}
					if($count==0){
						echo "<div class='items_row'>";
					}
					$count++;
					echo "<div id='item'>
							<div class='image'>
								<a href='./product.php?p=".$p["id_product"]."&f=search&pag=".$pag."&pp=".$pp."&search_input=".$_GET["search_input"]."'>";
								if(file_exists("./images/images/".$p["serial_model_code"]."-1.jpg")){
							echo "<img class='image_link image_preview' id='./images/images/".$p["serial_model_code"]."-1.jpg' src='./img/interface/oky_loading.gif' longdesc='./images/images/".$p["serial_model_code"]."-1.jpg'/>";
						}else{
							echo "<img class='image_link' src='./img/interface/no_image.jpg'/>";
						}

					echo "
								</a>
							</div>
							<div class='description'>
								<a href='./product.php?p=".$p["id_product"]."&f=search&pag=".$pag."&pp=".$pp."&search_input=".$_GET["search_input"]."'><span class='item_name important'>".utf8_encode($name)."</span></a>
								<p style='text-align:right;margin-right:15px;margin-top:0px;'><span";
								if($p["use_discount"]==1){
									echo " class='old_price'>";
								}else{
									echo ">";
								}
								echo "".$p["pvp"]." ".$c["symbol"]."</span>";
								if($p["use_discount"]==1){
									echo " </p><p style='text-align:right;margin-right:15px;margin-top:-10px;'><span class='new_price'>";
									printf("%.2f",round($p["pvp"]*$c["exchange"]*(100-$p["discount"])/100));
									echo " ".$c["symbol"]."";
								}
								echo "</p>
							</div>
						</div>";
					$pp++;
					if($count==3){
						echo "</div>";
						$count=0;
					}
				}

			}
			?>
		</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
