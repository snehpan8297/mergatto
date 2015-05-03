<?php 
//Lang Revisado
@session_start();
$t=0;
if(!isset($_GET["season"])){
	$_GET["season"]="";
}

include_once("functions/get_lang.php");
$lang_url='./lang/lang_'.$lang.'.php';
include_once($lang_url);
	
if(!isset($_GET["t"])){
	include_once("include/inbd.php");

	$table="categories";
	$filter=array();
	
	if(!isset($_GET["c"])){
		$filter["main_category"]=array("operation"=>"=","value"=>1);
	}else{
		
		$filter["id_category"]=array("operation"=>"=","value"=>$_GET["c"]);
	}
	$category_selected=getInBD($table,$filter);
	if($category_selected["type"]=="normal"){
		
		$_GET["c"]=$category_selected["id_category"];
		$table="product_categories";
		$filter=array();
		$filter["id_category"]=array("operation"=>"=","value"=>$_GET["c"]);
		$product_categories=listInBD($table,$filter);
		$is_product_categories=isInBD($table,$filter);
		if(isset($_GET["sf"])) {
			$table="product_subfamilies";
			$filter=array();
			$filter["id_subfamily"]=array("operation"=>"=","value"=>$_GET["sf"]);
			$product_subfamilies=listInBD($table,$filter);
			$is_product_subfamilies=isInBD($table,$filter);
		
		}
		$table="products";
		$filter=array();
		if($is_product_categories){
			$filter["complex"]="";
			$or="";
			foreach	($product_categories as $key=> $product_category){
				$filter["complex"].=$or."id_product=".$product_category["id_product"];
				$or=" or ";
			}	
		}else{

		}
		//$filter["id_category"]=array("operation"=>"=","value"=>$category_selected["id_category"]);
		$filter["visible"]=array("operation"=>"=","value"=>1);
		$page_title = "Todos";
		$page_description = "OKY^COKY Classics Outlet todas nuestras prendas || All our clothes";
		if(isset($_GET["f"])) {
			$filter["id_family"]=array("operation"=>"=","value"=>$_GET["f"]);
		}
		if(isset($_GET["sf"])) {
			
			//$filter["id_subfamily"]=array("operation"=>"=","value"=>$_GET["sf"]);
			if(($is_product_categories)&&($is_product_subfamilies)){
				$filter["complex"]="";
				$or="";
				foreach	($product_categories as $key=> $product_category){
					$in_subfamily=false;
					foreach ($product_subfamilies as $key2=>$product_subfamily){
						if($product_category["id_product"]==$product_subfamily["id_product"]){
							$filter["complex"].=$or."id_product=".$product_category["id_product"];
							$or=" or ";
						}
					}
				}
				if($filter["complex"]==""){
					$filter["complex"] = "false";
				}
			}
		}
		$fields=array("id_product","name_en","name_es","serial_model_code","use_discount","pvp","discount");
		$table_order = $category_selected["table_order"];
		$products=listInBD($table,$filter,$fields,$table_order);
		
		if((isset($_GET["filter_t"]))&&($_GET["filter_t"]>0)){
			$_SESSION["filter_t"]=$_GET["filter_t"];
			foreach ($products as $key=>$product){
				$table="stocks";
				$filter=array();
				$filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
				$filter["stock_size_".$_GET["filter_t"]]=array("operation"=>">","value"=>0);
				if(!isInBD($table,$filter)){
					unset($products[$key]);
				}
			}
		}
		if(isset($_GET["c"])) {
			$page_title = $category_selected["name_".$lang];
		}
		if(isset($_GET["f"])) {
			$page_title .= " ".$s["family_".$_GET["f"]];
			$page_description = $s["family_".$_GET["f"]]." de OKY^COKY en nuestra tienda online Classics Outlet con descuento";
		}
		if(isset($_GET["sf"])) {			
			$table="subfamily";
			$filter=array();
			$filter["id_subfamily"]=array("operation"=>"=","value"=>$_GET["sf"]);
			$subfamily=getInBD($table,$filter);
			$page_title .=  " ".$subfamily["name_".$lang];
			$page_description =  $s["family_".$_GET["f"]]." ".$subfamily["name_".$lang]." de OKY^COKY en nuestra tienda online Classics Outlet con descuento";
		}	
	}else if($category_selected["type"]=="my_favorites"){
		$table="client_favorites";
		$filter=array();
		$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
		$client_favorites=listInBD($table,$filter);
		$table="products";
		$filter=array();
		$filter["complex"] = "";
		$or="";
		$fields=array("id_product","name_en","name_es","serial_model_code","use_discount","pvp","discount");
		$table_order = $category_selected["table_order"];
		foreach ($client_favorites as $key => $client_favorite){
			$filter["complex"] .= $or."id_product = ".$client_favorite["id_product"];
			$or=" or ";
		}
		if($filter["complex"]==""){
				$filter["complex"]="false";
		}
		$products=listInBD($table,$filter,$fields,$table_order);
		$page_title = $category_selected["name_".$lang];
		$page_description =  $category_selected["name_".$lang]." de OKY^COKY en nuestra tienda online Classics Outlet con descuento";
	}
	
}else{
	$size = $_GET["t"];
	$family="by_size";
	include_once("functions/get_lang.php");
	$lang_url='./lang/lang_'.$lang.'.php';
	include_once($lang_url);
	$page_title = $s["sizes"]." ".$s["sizes_".$_GET["t"]];
	$page_description = "Pendas de la Talla ".$s["sizes_".$_GET["t"]]." de OKY^COKY en nuestra tienda online Classics Outlet con descuento";
	$t=$_GET["t"];
}

if(isset($_GET["sf"])) {
	include_once("include/subfamily.php");
	$subfamily["id_subfamily"] = $_GET["sf"];
	$subfamily=getSubfamily($subfamily);
	$family=$subfamily["id_family"];
	
}else if(isset($_GET["f"])) {
	$family = $_GET["f"];
	include_once("functions/get_lang.php");
	$lang_url='./lang/lang_'.$lang.'.php';
	include_once($lang_url);
	$page_description = $s["family_".$_GET["f"]]." OKY^COKY en nuestra tienda online Classics Outlet con descuento";

}else if(isset($_GET["t"])) {
	$size = $_GET["t"];
	$family="by_size";
	include_once("functions/get_lang.php");
	$lang_url='./lang/lang_'.$lang.'.php';
	include_once($lang_url);
	$page_description = " OKY^COKY en nuestra tienda online Classics Outlet con descuento";
	$t=$_GET["t"];

} else {
	$family = "all_visible";
	$page_description = "OKY^COKY Classics Outlet todas nuestras prendas || All our clothes";
}
$page = "list";

include("header.php");
include_once("include/products.php");
include_once("include/users.php");


$limit = 0;
$pag = 0;
	
if(isset($_GET["t"])) {
	$family="by_size";
	$order = " p.visits desc, product_position asc, p.season_winter desc, p.season_year desc, p.serial_model_code desc";
	
 	$r = listProducts($family,$order);
	$numproducts = db_count($r);
}else{



}

						$count=0;
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><span class='important'><?php echo $s["family_".$family]; ?></span></div>
	</div>
	<div class='contentbox'>
		<div id='section_header'>
			<div class='inner'>
				<?php
					if(isset($_GET["f"])) {
						$table="subfamily";
						$filter= array();
						$filter["id_family"]=array("operation"=>"=","value"=>$_GET["f"]);
						$fields=array();
						$table_order="name_".$lang;
						$subfamilys=listInBD($table,$filter,$fields,$table_order);
						foreach ($subfamilys as $key=>$subfamily){
							?>
							<a style='<?php if((isset($_GET["sf"]))&&($_GET["sf"]==$subfamily["id_subfamily"])) echo "color:black;";?>margin:0px 5px' href='./list.php?c=<?php echo $_GET["c"];?>&f=<?php echo $_GET["f"];?>&sf=<?php echo $subfamily["id_subfamily"];?>'><?php echo $subfamily["name_".$lang];?></a>
							<?php
						}
					}

				?>
			</div>
		</div>
		<div id='item_list'>
			<?php
				if((isset($_GET["c"]))&&(!empty($_GET["c"]))){

					if(file_exists("./images/categories/".$_GET["c"]."_".$lang.".jpg")){
					?>
						<img src='<?php echo "./images/categories/".$_GET["c"]."_".$lang.".jpg";?>' style='width:100%;margin-bottom:10px;'/>
					<?php
					}else if(file_exists("./images/categories/".$_GET["c"].".jpg")){
					?>
						<img src='<?php echo "./images/categories/".$_GET["c"].".jpg";?>' style='width:100%;margin-bottom:10px;'/>
					<?php	
					}						
					
				}
			?>
			<?php
				if(sizeof($products)==0){
					?>
					<div style='text-align:right'>
						<?php echo $s["filter_sizes"];?>
						<select id='filter_t'>
							<option value='0'><?php echo $s["all_sizes"];?></option>
							<option value='1' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==1)){echo "selected";}?>><?php echo $s["size"]." 34";?></option>
							<option value='2' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==2)){echo "selected";}?>><?php echo $s["size"]." 36";?></option>
							<option value='3' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==3)){echo "selected";}?>><?php echo $s["size"]." 38";?></option>
							<option value='4' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==4)){echo "selected";}?>><?php echo $s["size"]." 40";?></option>
							<option value='5' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==5)){echo "selected";}?>><?php echo $s["size"]." 42";?></option>
							<option value='6' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==6)){echo "selected";}?>><?php echo $s["size"]." 44";?></option>
							<option value='7' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==7)){echo "selected";}?>><?php echo $s["size"]." 46";?></option>
							<option value='8' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==8)){echo "selected";}?>><?php echo $s["size"]." 48";?></option>
							<option value='9' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==9)){echo "selected";}?>><?php echo $s["size"]." 50";?></option>
							<option value='10' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==10)){echo "selected";}?>><?php echo $s["size"]." 52";?></option>
						</select>
						<script>
							$(document).ready(function (){
								$('#filter_t').change(function() {
									var $_get_parameters=window.location.search.substring(1);
									  var vars = $_get_parameters.split("&");
									  $_get_parameters_new="";
									  for (var i=0;i<vars.length;i++) {
									    var pair = vars[i].split("=");
									    if (pair[0] != "filter_t") {
											$_get_parameters_new=$_get_parameters_new+pair[0]+"="+pair[1]+"&";
									    }
									  } 

									window.location.assign("./list.php?"+$_get_parameters_new+"filter_t="+$("#filter_t").val())
								});
							});
						</script>
					</div>
					<div style='text-align:center;padding-top:150px;'>
						<?php
							if($category_selected["type"]=="my_favorites"){
								if(!empty($userdata)){
									?>
									<img src='./img/interface/okycoky-logo.png'/><br/><br/><br/>
									<i><?php echo $s["favorites_empty"];?></i>
									<?php
								}else{
									?>
									<img src='./img/interface/okycoky-logo.png'/><br/><br/><br/>
									<i><?php echo $s["favorites_login"];?></i>
									<br/>
									<br/><br/>
									<a class='btn btn-mini btn-dark' href='./login.php'><?php echo $s["login"];?></a> <a class='btn btn-mini btn-dark' href='./signup.php'><?php echo $s["signup"];?></a>
									<?php	
								}
								
							}else{
								?>
								<img src='./img/interface/okycoky-logo.png'/><br/><br/><br/>
								<i><?php echo $s["no_clothes_to_show"];?></i>
								<?php
							}
						?>
					</div>
					<?php
				}else if(isset($_GET["t"])) {
					$count=0;
					$pp = 0;
					while ($p=db_fetch($r)){
						$col = productColorsWithId($p["id_product"]);
						$colors = Array();
						while($colo = db_fetch($col)) {
						
							
							if(strtoupper(substr($colo["name_id_color"],-1)) != "M") {
								$colors[$colo["name_id_color"]]["id"] = $colo["id"];
								$colors[$colo["name_id_color"]]["id_color"] = $colo["id_color"];
								$colors[$colo["name_id_color"]]["name_id_color"] = $colo["name_id_color"];
								$colors[$colo["name_id_color"]]["name"] = $colo["name"];
								$colors[$colo["name_id_color"]]["use_color"] = $colo["use_color"];
								$colors[$colo["name_id_color"]]["stock"] = getStockWithId($p["id_product"],$colo["id_color"]);
							}else{
								$colo["name_id_color"] = substr($colo["name_id_color"],0,strlen($colo["name_id_color"])-1);
								$colors[$colo["name_id_color"]]["stockM"] = getStockWithId($p["id_product"],$colo["id_color"]);
								$colors[$colo["name_id_color"]]["use_colorM"] = $colo["use_color"];
							}
						}
						foreach ($colors as $key=>$value){
							$product_total = 0;
							if(isset($_GET["ww"])){
								if ($p["serial_model_code"]=="4322-NAJ"){
								}
							}
							if(isset($colors[$key]["stock"])){
								foreach ($colors[$key]["stock"] as $key2=>$value2){
									$product_total += $colors[$key]["stock"][$key2];
								}
							}
							if(isset($colors[$key]["stockM"])){
								foreach ($colors[$key]["stockM"] as $key2=>$value2){
									$product_total += $colors[$key]["stockM"][$key2];
								}
							}
							$colors[$key]["products_total"] = $product_total;
						}
						$color_to_show = false;
						foreach ($colors as $key=>$color) {
							if(!isset($colors[$key]["use_color"])){
								$colors[$key]["use_color"]=0;
							}
							if(!isset($colors[$key]["use_colorM"])){
								$colors[$key]["use_colorM"]=0;
							}
		
							if ((($colors[$key]["products_total"]>0) && ($colors[$key]["use_color"]==1 || $colors[$key]["use_colorM"]==1)) || ($colors[$key]["use_color"]==2)){
								$color_to_show = true;
							}
						}
						if($color_to_show){
							$name = $p["name_".$lang];
							if($lang!="es" && $p["name_".$lang]!="") {
								$name=$p["name_".$lang];
							}
							$images = productImages($p["id_product"],2);
							if($count==0){
								echo "<div class='items_row'>";
							}
							$count++;
							$tmp=explode("-", $p["serial_model_code"]);
							$p["serial_code"]=$tmp[0];
							$p["model_code"]=$tmp[1];
							$has_image=false;
							if(file_exists("./images/images/".$p["serial_model_code"]."-1.jpg")){
								$p["image_path"]="./images/images/".$p["serial_model_code"]."-1.jpg";
								$has_image=true;
							}else{
								$p["image_path"]="./img/interface/no_image.jpg'";
							}
							if($has_image){
							echo "<div id='item'>
								<div class='image' style=''>
									<a href='./product.php?p=".$p["id_product"]."&f=".$family."&pag=".$pag."&pp=".$pp."&t=".$t."'>
										<img class='image_link' src='./img/interface/oky_loading.gif' longdesc='".$p["image_path"]."' />
									</a>
								</div>
								<div class='description'>
									<a href='./product.php?p=".$p["id_product"]."&f=".$family."&pag=".$pag."&pp=".$pp."'><span class='item_name important'>".$name."</span>
									<p style='text-align:right;margin-right:15px;margin-top:0px;margin-bottom:0px;'><span";
									if($p["use_discount"]==1) {
										echo " class='old_price'>";
									} else {
										echo ">";
									}
									echo "".$p["pvp"]." ".$c["symbol"]."</span>"; 
									if($p["use_discount"]==1){
										echo "</p><p style='text-align:right;margin-right:15px;margin-top:0px;'><span class='new_price'>";
										printf("%.2f",round($p["pvp"] * $c["exchange"] * (100 - $p["discount"]) / 100));
										echo " ".$c["symbol"]."</span></a> ";
									}
									echo "</p>
								</div>
							</div>";
							if($count==3){
								echo "</div>";
								$count=0;
							}
							$pp++;
							}
						}else{
							if(isset($_GET["ww"])){
								foreach ($colors as $key=>$value){
									$product_total = 0;
									if(isset($colors[$key]["stock"])){
										foreach ($colors[$key]["stock"] as $key2=>$value2){
											$product_total += $colors[$key]["stock"][$key2];
										}
									}
									if(isset($colors[$key]["stockM"])){
										foreach ($colors[$key]["stockM"] as $key2=>$value2){
											$product_total += $colors[$key]["stockM"][$key2];
										}
									}
									$colors[$key]["products_total"] = $product_total;
								}
							}
						}
					}
				}else{
					$count=0;
					$pp = 0;
					?>
					<div style='text-align:right'>
						<?php echo $s["filter_sizes"];?>
						<select id='filter_t'>
							<option value='0'><?php echo $s["all_sizes"];?></option>
							<option value='1' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==1)){echo "selected";}?>><?php echo $s["size"]." 34";?></option>
							<option value='2' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==2)){echo "selected";}?>><?php echo $s["size"]." 36";?></option>
							<option value='3' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==3)){echo "selected";}?>><?php echo $s["size"]." 38";?></option>
							<option value='4' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==4)){echo "selected";}?>><?php echo $s["size"]." 40";?></option>
							<option value='5' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==5)){echo "selected";}?>><?php echo $s["size"]." 42";?></option>
							<option value='6' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==6)){echo "selected";}?>><?php echo $s["size"]." 44";?></option>
							<option value='7' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==7)){echo "selected";}?>><?php echo $s["size"]." 46";?></option>
							<option value='8' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==8)){echo "selected";}?>><?php echo $s["size"]." 48";?></option>
							<option value='9' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==9)){echo "selected";}?>><?php echo $s["size"]." 50";?></option>
							<option value='10' <?php if((isset($_GET["filter_t"]))&&($_GET["filter_t"]==10)){echo "selected";}?>><?php echo $s["size"]." 52";?></option>
						</select>
						<script>
							$(document).ready(function (){
								$('#filter_t').change(function() {
									var $_get_parameters=window.location.search.substring(1);
									  var vars = $_get_parameters.split("&");
									  $_get_parameters_new="";
									  for (var i=0;i<vars.length;i++) {
									    var pair = vars[i].split("=");
									    if (pair[0] != "filter_t") {
											$_get_parameters_new=$_get_parameters_new+pair[0]+"="+pair[1]+"&";
									    }
									  } 

									window.location.assign("./list.php?"+$_get_parameters_new+"filter_t="+$("#filter_t").val())
								});
							});
						</script>
					</div>
					<?php
					foreach($products as $key=>$p) {
						$col = productColorsWithId($p["id_product"]);
						$colors = Array();
						$available_sizes_str = "";
									$coma="";
					$stock_total=0;
						while($colo = db_fetch($col)) {
						
							
							if(strtoupper(substr($colo["name_id_color"],-1)) != "M") {
								$colors[$colo["name_id_color"]]["id"] = $colo["id"];
								$colors[$colo["name_id_color"]]["id_color"] = $colo["id_color"];
								$colors[$colo["name_id_color"]]["name_id_color"] = $colo["name_id_color"];
								$colors[$colo["name_id_color"]]["name"] = $colo["name"];
								$colors[$colo["name_id_color"]]["use_color"] = $colo["use_color"];
								$colors[$colo["name_id_color"]]["stock"] = getStockWithId($p["id_product"],$colo["id_color"]);
								$sizes_patter[0]="";
								$sizes_patter[1]="34";
								$sizes_patter[2]="36";
								$sizes_patter[3]="38";
								$sizes_patter[4]="40";
								$sizes_patter[5]="42";
								$sizes_patter[6]="44";
								$sizes_patter[7]="46";
								$sizes_patter[8]="48";
								$sizes_patter[9]="50";
								$sizes_patter[10]="52";
								foreach($colors[$colo["name_id_color"]]["stock"] as $key=>$prod_stock){
									if($prod_stock>0){
										$available_sizes_str.=$coma.$sizes_patter[$key];
										$coma=",";
										$stock_total+=1;

									}
								}
								
							}else{
								$colo["name_id_color"] = substr($colo["name_id_color"],0,strlen($colo["name_id_color"])-1);
								$colors[$colo["name_id_color"]]["stockM"] = getStockWithId($p["id_product"],$colo["id_color"]);
								$colors[$colo["name_id_color"]]["use_colorM"] = $colo["use_color"];
							}
						}
						foreach ($colors as $key=>$value){
							$product_total = 0;
							if(isset($_GET["ww"])){
								if ($p["serial_model_code"]=="4322-NAJ"){
								}
							}
							if(isset($colors[$key]["stock"])){
								foreach ($colors[$key]["stock"] as $key2=>$value2){
									$product_total += $colors[$key]["stock"][$key2];
								}
							}
							if(isset($colors[$key]["stockM"])){
								foreach ($colors[$key]["stockM"] as $key2=>$value2){
									$product_total += $colors[$key]["stockM"][$key2];
								}
							}
							$colors[$key]["products_total"] = $product_total;
						}
						$color_to_show = false;
						foreach ($colors as $key=>$color) {
							if(!isset($colors[$key]["use_color"])){
								$colors[$key]["use_color"]=0;
							}
							if(!isset($colors[$key]["use_colorM"])){
								$colors[$key]["use_colorM"]=0;
							}
		
							if ((($colors[$key]["products_total"]>0) && ($colors[$key]["use_color"]==1 || $colors[$key]["use_colorM"]==1)) || ($colors[$key]["use_color"]==2)){
								$color_to_show = true;
							}
						}
						if($color_to_show){
							$name = $p["name_".$lang];
							if($lang!="es" && $p["name_".$lang]!="") {
								$name=$p["name_".$lang];
							}
							$images = productImages($p["id_product"],2);
							if($count==0){
								echo "<div class='items_row'>";
							}
							$count++;
							$table="image_products";
							$filter=array();
							$filter["id_product"]=array("operation"=>"=","value"=>$p["id_product"]);
							$fields=array();
							$table_order="imgorder asc";
							$tmp=getInBD($table,$filter,$fields,$table_order);
							$p["id_image"]=$tmp["id_image"];
							$item_width=100/$category_selected["products_per_row"];
							$tmp=explode("-", $p["serial_model_code"]);
							$p["serial_code"]=$tmp[0];
							$p["model_code"]=$tmp[1];
							$has_image=false;
							if(file_exists("./images/images/".$p["serial_model_code"]."-1.jpg")){
								$p["image_path"]="./images/images/".$p["serial_model_code"]."-1.jpg";
								$has_image=true;
							}else{
								$p["image_path"]="./img/interface/no_image.jpg'";
							}
							if($has_image){
							echo "<div id='item' style='width:".$item_width."%' ";
							if($stock_total==0){
								echo "class='no_no_stock'";
							}
							echo">
								";
								if($category_selected["show_product_discount"]==1){
									echo "<div class='or_badge_product or_badge-important' style='position:relative;left:100;";
									if($p["discount"]==0){
										echo "opacity:0;";
									}
									echo "'> - ".$p["discount"]." %</div>";
								}
								echo "
								<div class='image' style=''>
									<a href='./product.php?c=".$_GET["c"]."&p=".$p["id_product"]."&f=".$family."&pag=".$pag."&pp=".$pp."&t=".$t."'>
										<img class='image_link' src='./img/interface/oky_loading.gif' longdesc='".$p["image_path"]."' />
									</a>
								</div>
								<div class='description'>
									<a href='./product.php?p=".$p["id_product"]."&f=".$family."&pag=".$pag."&pp=".$pp."'><span class='item_name important'>".$name."</span> ";	
									
									
									echo "<p style='text-align:right;margin-right:15px;margin-top:0px;margin-bottom:0px;'><span";
									if($p["use_discount"]==1) {
										echo " class='old_price'>";
									} else {
										echo " class='new_price'>";
									}
									echo "".$p["pvp"]." ".$c["symbol"]."</span>";
									
									if($category_selected["show_product_left"]==1){
										echo "</p><p style='margin:0px;'>".$s["size"].": ".$available_sizes_str;
									}
									if($p["use_discount"]==1){
										echo "</p><p style='text-align:right;margin-right:15px;margin-top:0px;'><span class='new_price'>";
										printf("%.2f",round($p["pvp"] * $c["exchange"] * (100 - $p["discount"]) / 100));
										echo " ".$c["symbol"]."</span></a> ";
									}
									echo "</p>
								</div>
							</div>";
							if($count==$category_selected["products_per_row"]){
								echo "</div>";
								$count=0;
							}
							$pp++;
							}
						}else{
							if(isset($_GET["ww"])){
								foreach ($colors as $key=>$value){
									$product_total = 0;
									if(isset($colors[$key]["stock"])){
										foreach ($colors[$key]["stock"] as $key2=>$value2){
											$product_total += $colors[$key]["stock"][$key2];
										}
									}
									if(isset($colors[$key]["stockM"])){
										foreach ($colors[$key]["stockM"] as $key2=>$value2){
											$product_total += $colors[$key]["stockM"][$key2];
										}
									}
									$colors[$key]["products_total"] = $product_total;
								}
							}
						}
					}
					
				}
			?>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function (){
				$('.image_change').mouseover(function() {
					new_image=$(this).attr("on_hover");
					$(this).attr("src",new_image);
					$(this).addClass("image_link2");
					//$('#'+id+'_1').fadeIn('fast');
				});
				$('.image_link2').live("mouseout",function(){
					$(this).removeClass("image_link2");
					new_image=$(this).attr("longdesc");
					$(this).attr("src",new_image);
					//$('#'+id).fadeOut('fast');
				});
				
		
	});
</script>
<?php
include("footer.php");
?>
