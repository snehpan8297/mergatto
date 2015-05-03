<?php
@session_start();
$not_found = false;
if((!isset($_GET["p"]))||(empty($_GET["p"]))) {
	header("location:404.php");
	die();
}

$pag = "";
$product = $_GET["p"];
if((isset($_GET["pp"]))&&(!empty($_GET["pp"]))) {
	$pp = $_GET["pp"];
} else {
	$pp = 0;
}
$t=0;
if(isset($_GET["t"])) {
	$t = $_GET["t"];	
}
if(isset($_GET["f"])) {
	$family = $_GET["f"];	
}
if(isset($_GET["pag"])) {
	$pag = $_GET["pag"];
}
include_once("include/products.php");
include_once("include/users.php");
include_once("include/inbd.php");
include("functions/get_lang.php");
$lang_url='./lang/lang_'.$lang.'.php';
include_once($lang_url);
include_once('./include/front_settings.php');

$product_object = productData($product);
if(!isset($product_object["serial_model_code"])){
	header("location:404.php");
	die();
}

$tmp=explode("-", $product_object["serial_model_code"]);
$product_object["serial_code"]=$tmp[0];
$product_object["model_code"]=$tmp[1];


if(isset($product_object) && !empty($product_object)) {
	
	
	$table='products';
	$filter=array();
	$filter["id_product"]=array("operation"=>"=","value"=>$_GET["p"]);
	$tmp_data=getInBD($table,$filter);
	$update_data=Array();
	$update_data["visits"]=$tmp_data["visits"]+1;
	updateInBD($table,$filter,$update_data);
	
	
	
	$product_object["season"] = $season_winter[$product_object["season_winter"]]." '".$product_object["season_year"];
	
	$name = "OKY^COKY - ".stripslashes($product_object["name_es"]);
	if($lang!="es" && $product_object["name_".$lang]!="") {
		$name = "OKY^COKY - ".stripslashes($product_object["name_".$lang]);
	}
	$images = productImages($product);
	$sizes = productSizes($product_object["id_sizing"]);
	$colors = productColorsWithId($product_object["id_product"]);
	$producto['price'] = $product_object["pvp"];
	$script = "";
	$search_field = "";
	$nextp="";
	$prevp="";
	if(!isset($family)){
		if($_GET["f"]=="by_size"){
			$nextp = nextProductFamily("by_size",1,$pp+1);
			if($pp > 0) {
				$prevp = nextProductFamily("by_size",1,$pp-1);
			}
		}else{
			$family=$product_object["id_family"];
		}
	}else if($family!='search') {
		if($_GET["f"]=="by_size"){
			$nextp = nextProductFamily("by_size",1,$pp+1);
			if($pp > 0) {
				$prevp = nextProductFamily("by_size",1,$pp-1);
			}
		}else{
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
				$table="products";
				$filter=array();
				$filter["id_category"]=array("operation"=>"=","value"=>$category_selected["id_category"]);
				$filter["visible"]=array("operation"=>"=","value"=>1);
				if((isset($_GET["f"]))&&($_GET["f"]!="all_visible")) {
					$filter["id_family"]=array("operation"=>"=","value"=>$_GET["f"]);
				}
				if(isset($_GET["sf"])) {
					$filter["id_subcategory"]=array("operation"=>"=","value"=>$_GET["sf"]);
				}
				$fields="";
				$table_order = $category_selected["table_order"];
				if(!isset($_GET["pp"])){
					$_GET["pp"]=0;
				}
				$limit=($_GET["pp"]+1).",1";
				$nextp=getInBD($table,$filter,$fields,$table_order,$limit);
				if($_GET["pp"]>0){
					$limit=($_GET["pp"]-1).",1";
					$prevp=getInBD($table,$filter,$fields,$table_order,$limit);
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
				$limit=($_GET["pp"]+1).",1";
				foreach ($client_favorites as $key => $client_favorite){
					$filter["complex"] .= $or."id_product = ".$client_favorite["id_product"];
					$or=" or ";
				}
				if($filter["complex"]==""){
					$filter["complex"]="false";
				}
				$nextp=getInBD($table,$filter,$fields,$table_order,$limit);
				if($_GET["pp"]>0){
					$limit=($_GET["pp"]-1).",1";
					$prevp=getInBD($table,$filter,$fields,$table_order,$limit);
				}
			}
			
						
		}
	}else{
		$nextp = nextProductSearch($_GET["search_input"],1,$pp+1);
		if($pp > 0) {
			$prevp = nextProductSearch($_GET["search_input"],1,$pp-1);
		}
		$search_field = "&search_input=".$_GET["search_input"];
	}
	$description = stripslashes($product_object["description_".$lang]);
	$composition = $product_object["composition_".$lang];
	if(mb_detect_encoding($composition, 'UTF-8', true) === FALSE) { 
		$composition = stripslashes(utf8_encode($composition));
	}
} else {
	$not_found = true;
}

$imagewidth = array();
if(db_count($images) > 0){
	$image1 = db_result($images,1);
	$page_image_src= $url_base."products/models/370/".$image1.".jpg";
} else {
	$page_image_src= $url_base."img/interface/no_image.jpg";
}
$page = "product";
$page_title = $product_object["name_es"]." ".$product_object["serial_model_code"];
$page_keywords = $product_object["name_es"]." ".$product_object["name_en"]." ".$product_object["serial_model_code"];

$page_description = $product_object["name_es"]." OKY^COKY (".$product_object["serial_model_code"].") en nuestra tienda Online Classics Outlet encuentralo al mejor precio | ".$product_object["name_en"]." OKY^COKY (".$product_object["serial_model_code"].") en our online shop Classics Outlet find it at the best price";
include("header.php");
?>
<script>
	var stocks=new Array();
	var size=-1;
	var color="";
	var model="<?php echo $product_object["serial_model_code"];?>";
	var price=<?php if($product_object["use_discount"]==1){echo round((1-$product_object["discount"]/100)*$product_object["pvp"]);}else{echo $product_object["pvp"];} ?>
</script>
<div id='content'>
	<div id='section_header'>
		<div class='inner'>
			<?php
				if(!isset($_GET["c"])){
					$_GET["c"]=0;
				}
				/*
				
				if (isset($prevp["id_product"])){
					?>
					<a style='margin:0px 5px' href='<?php echo "./product.php?c=".$_GET["c"]."&p=".$prevp["id_product"]."&pp=".($pp-1)."&f=".$family.$search_field."&t=".$t;?>'><?php echo $s["previous"];?></a>
					<?php
				}else{
					?>
					<a style='margin:0px 5px' href='#' class='text-muted'><?php echo $s["previous"];?></a>
					<?php
				}
				
				if (isset($nextp["id_product"])){
					?>
					<a style='margin:0px 5px' href='<?php echo "./product.php?c=".$_GET["c"]."&p=".$nextp["id_product"]."&pp=".($pp+1)."&f=".$family.$search_field."&t=".$t;?>'><?php echo $s["next"];?></a>
					<?php
				}else{
					?>
					<a style='margin:0px 5px' href='#' class='text-muted'><?php echo $s["next"];?></a>
					<?php
				}
				*/
				?>
		</div>
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<?php 
			if(!$not_found) {
				if($family == 'search'){
					echo "<a href='./search.php?search_input=".$_GET["search_input"]."'>".$s["search_title"]."</a>";
					$link = "./search.php?search_input=".$_GET["search_input"]."";
				}else{
					if(($family == 'by_size')&&(isset($_GET["t"]))){
						echo "<a href='./list.php?t=".$_GET["t"]."'>".$s["family_by_size"]."</a>";
						$link = "./list.php?t=".$_GET["t"]."";
						
					}else{
					echo "<a href='./list.php?f=".$family."&pag=".$pag."'>".$s["family_".$family]."</a>";
					$link = "./list.php?f=".$family."&pag=".$pag."";	
					}
					
				}
				//echo " <span class='important'>".$name."</span>";
			}
			?>
		</div>
	</div>
	<div id='product' style='padding-top:10px;'>
		<?php
		if($not_found) {
			echo "<div style='text-align: center; padding-top: 40px;'><span class='important' style='font-weight: bold; font-size: 22px;'>".$s["product_not_found"]."</span></div>";
		} else {
			if(isset($prevp["id_product"]) || isset($nextp["id_product"])) {
		?>
		<?php } ?>
		<div class='preview'>
			<?php

						
					if(file_exists("./images/videos/".$product_object["serial_model_code"].".mov")){
						?>
						<a href='#'><img style='position:absolute;' class='video_link' src='./img/interface/video-icon.png'/>
						<?php
					}	
				
			?>
			<div class='principal'>
				<?php
					
					$imagewidth = array();
					if(file_exists("./images/images/".$product_object["serial_model_code"]."-1.jpg")){
						echo "<a href='#'><img class='image_link image_preview' id='./images/images/".$product_object["serial_model_code"]."-1.jpg' src='./img/interface/oky_loading.gif' longdesc='./images/images/".$product_object["serial_model_code"]."-1.jpg'/></a>";
					}else{
						echo "<img class='image_link' src='./img/interface/no_image.jpg'/>";
					}
				
				?>				
				<?php
			/*
			*/
			
					if(file_exists("./images/videos/".$product_object["serial_model_code"].".mov")){
						?>
							<a href='#' class='video_link_close' style='display:none;font-size:14px;padding:10px 0px;color:#999'><i class='fa fa-stop'></i> STOP</a>
							<video   class="video video_preview" id='video' muted preload="auto" loop controls style="display:none;width:380px;height:auto;">
							
								<source src="./images/videos/<?php echo $product_object["serial_model_code"];?>.mp4" type="video/mp4">
								<source src="./images/videos/<?php echo $product_object["serial_model_code"];?>.mov">
							</video>
							
						<?php
					}
				
			?>
			</div>
			
		</div>
		<div class='information'>
			<div class='name'>
				<div>
					<h1 style='font-size:25px !important;text-weight:bold'><?php echo $name; ?></h1>
				</div>
			</div>
			<div class='price'>
				<?php
					if($product_object["use_discount"]==1){
						?>
						<h4 style='margin-top:5px;font-size:12px;'><span class='old_price'><?php echo $s["before"]." ".$producto['price'];?> <?php echo $c['name'];?>s</span><!-- ( <?php echo $product_object["discount"]; ?>% <?php echo $s["discount"];?> ) --></h4>
						<h3 style='font-size:30px;text-align:left;'><?php printf("%.2f",round($product_object["pvp"]*$c["exchange"]*(100-$product_object["discount"])/100));?> <?php echo $c['symbol'];?> </h3>
						<?php
					}else{
						?>
						<h3><?php echo $producto['price'];?> <?php echo $c['name'];?>s</h3>
						<?php
					}
				?>
			</div>
			<div class='color_selector'>
				<ul>
					<?php
						$first=true;
						$stock_string="";
						while($color = db_fetch($colors)) {
							$stock=getStockWithId($product_object["id_product"],$color["id_color"]);
							if(isset($_GET["ww"])){
								echo $product_object["id_product"];
							}
							$product_total = 0;
							foreach ($stock as $key=>$value){
								$product_total += $value;
							}
							
				
							if($color["use_color"]==1){
							if($first){
								?>
								<script>
									color="<?php echo $color["id_color"];?>";
								</script>
								<?php
							}
							?>
							<li id='color_<?php echo $color["id_color"];?>' <?php if ($first) echo "class='selected'";?>>
								<table>
									<tr>
										<td><a href='javascript:setcolor("<?php echo $color["id_color"];?>")'>
										<?php
											$product_object["serial_code"]=substr($product_object["serial_model_code"], 0,4);
											$color["name_id_color"]=str_replace("M","",$color["name_id_color"]);
											$color["name_id_color"]=str_replace("m","",$color["name_id_color"]);
											$color["name_id_color"]=str_replace("N","",$color["name_id_color"]);
											$color["name_id_color"]=intval($color["name_id_color"]);

											if(file_exists("./images/colors/".$product_object["serial_code"]."-".$color["name_id_color"].".jpg")){
												echo "<img class='image_color' src='./images/colors/".$product_object["serial_code"]."-".$color["name_id_color"].".jpg'>";
											}else{
												echo "<span class='no_image_color'></span>";
											}

									
										?>
										</a></td>
										<td>
										<?php
										if($product_total==0){
											?><a style='text-decoration: line-through !important;' href='javascript:setcolor("<?php echo $color["id_color"];?>")'><?php echo $color["name_".$lang]; ?></a> (<?php echo $s["no_stock_small"]; ?>)<?
										}else{
											?><a href='javascript:setcolor("<?php echo $color["id_color"];?>")'><?php echo $color["name_".$lang]; ?></a><?php
										}
										?>
										
										<?php
											if(file_exists("./images/colors/".$product_object["serial_code"]."-".$color["name_id_color"].".jpg")){
												?>
												( <a class='underline detail_link' id='<?php echo "./images/colors/".$product_object["serial_code"]."-".$color["name_id_color"].".jpg";?>' href='javascript:void(0)'><?php echo $s["see_details"];?></a> )
												<?php

											}
											
										?>
										</td>
									</tr>
								</table>
							</li>
							<?php
							$stock_string.="<div id='size_options_".$color["id_color"]."' class='select_child' style='display:none;'>
								<ul>";
							$stock=getStockWithId($product_object["id_product"],$color["id_color"]);
							for($i=1;$i<=12;$i++){
								$cart_items[$i]=0;
							}
							if(isset($_SESSION['cart_classics'])) {
								foreach ($_SESSION['cart_classics'] as $key => $cartitem) {
									if($cartitem["id_product"]==$product_object["id_product"]){
										if($cartitem["id_color"]==$color["id_color"]){
											for($i=1;$i<=12;$i++){
												$cart_items[$i]=$cartitem["sizes"][$i];
											}
										}
									}
								}
							}
							$coma = "";
							$all_sizes = "";
															$no_stock=true;

							for($i=1;$i<sizeof($sizes);$i++){
								if ($sizes[$i]=="") continue;
								/*$stock_string.="<li id='no_stock_".$color["id_color"]."_".$i."'"; 
								if (($stock[$i]-$cart_items[$i])>0){
									$stock_string.="style='display:none;'";
								}
								$stock_string.="><span>&nbsp;".$sizes[$i]."</span></li>";
								$stock_string.="<li id='yes_stock_".$color["id_color"]."_".$i."'";
								if (($stock[$i]-$cart_items[$i])<=0){
									$stock_string.="style='display:none;'";
								}
								$stock_string.="><a href='javascript:setsize(".($i).",\"".$sizes[$i]."\")'>&nbsp;".$sizes[$i]."</a><span style='display:none' id='stock_".$color["id_color"]."_".$i."'>".$stock[$i]."</span><span style='display:none' id='cart_items_".$color["id_color"]."_".$i."'>".$cart_items[$i]."</span></li>";*/
								//CAMBIO DE CODIGO. SE COMENTA EL ANTIGUO POR SI ACASO.
								if (($stock[$i]-$cart_items[$i])>0){
									$no_stock=false;
									$stock_string.="<li id='yes_stock_".$color["id_color"]."_".$i."'";
									$stock_string.="><a style='color:black;font-weight:bold;' href='javascript:setsize(".($i).",\"".$sizes[$i]."\")'>&nbsp;".$sizes[$i]."</a><span style='display:none' id='stock_".$color["id_color"]."_".$i."'>".$stock[$i]."</span><span style='display:none' id='cart_items_".$color["id_color"]."_".$i."'>".$cart_items[$i]."</span></li>";
								}
								$all_sizes .= $coma.$sizes[$i];
								$coma = ",";
							}
							$stock_string.="
								</ul>
							</div>
							";
							$first=false;
							}
						}
						$first=true;
						$colores=array();
						$colors_copy=$colors;
						while($coloro = db_fetch($colors)) {
						    $dividido=explode("-",$coloro["name"]);
							if (sizeof($dividido)==1) $dividido[]="0";
							$colores["c".$dividido[sizeof($dividido)-1]]=$coloro;                        
							ksort($colores);
							foreach ($colores as $key=>$color) {
							$colora=$color;
							if ($first) {
								?>
								<script>
									color="<?php echo $color["id_color"];?>";
								</script>
								
								<?php
							}
							?>
							<li id='color_<?php echo $color["id_color"];?>' <?php if ($first) echo "class='selected'";?>>
								<table>
								<tr>
									<td><a href='javascript:setcolor("<?php echo $color["id_color"];?>")'><img class='image_link_selected' src='./materials/<?php echo $color["id"];?>.jpg'></a></td>
									<td><a href='javascript:setcolor("<?php echo $color["id_color"];?>")'><?php echo $color["name_".$lang]; ?></a> ( <a class='underline detail_link' id='<?php echo $color["id"];?>' href='javascript:void(0)'><?php echo $s["see_details"];?></a> )</td>
								</tr>
								</table>
							</li>
							<?php
							$first=false;
							}
						}
					?>
				</ul>
			</div>
			<div>
				
					<div id='add_to_cart_infobox' style='margin-top:10px;color: red;'></div>
		<div class='size_selector'>
					<div class='select'>
						<div id='size_selector' class='select_head'>
							<a href='javascript:void(0);'><span class='arrow icon_arrow_down'></span><span class='text' id='sizeseletor'><?php echo $s["size"]; ?></span></a>
						</div>
						<?php echo $stock_string; ?>
						<script>
							$(document).ready(function (){
								$("#size_selector").click(function(){
									$.ajax({
										type: "POST",
										url: 'functions/mmorpg.php',
										data: {
											'action':"check_sizes",
											'serial_model_code':"<?echo $product_object["serial_model_code"]?>"
										},
										success: function(msg) {
											if(msg=="OK"){
												location.reload();
											}
										}
									});
									if($('#size_options_'+color).css('display')!='block'){
										$('#size_options_'+color).css('display','block');
									}else if($('#size_options_'+color).css('display')=='block'){
										$('#size_options_'+color).css('display','none');
									}
									return false;
								});
							});
						</script>
					</div>
				</div>
			</div>
			<div class='no_stock' style='display: none; padding: 40px 0px;'><?php echo $s["no_stock"]; ?></div>
			<input type="hidden" id='allsizes' value='<?php echo $all_sizes; ?>'/>
			
			
			<a id="payments_send_step1" href="javascript:addcart();" class='btn btn-dark' style='margin-top:15px;'><?php echo $s["add_to_cart"]?></a>
			<div class='' id="continue_shopping_button" style='display:none;margin-top:10px;border:1px solid #d4d4d4;padding:10px;backgound-color:#f4f4f4;padding-bottom:14px;margin-bottom:10px;'>
				<p style='margin:5px 0px 0px 0px'><?php echo $s["product_added"];?></p><br/>
				<a href="./cart.php" class="btn btn-mini btn-dark">Finalizar Pedido</a>
			</div>
			<?php
				if(isset($_SESSION['user_classics']['id_client'])){
					?>
					<div style='padding-top:20px;'>
						<h4 style='font-size:12px;margin-bottom:10px;'><?php echo $s["add_to_favorites_help"];?></h4>
						<?php
							$table="client_favorites";
							$filter=array();
							$filter["id_product"]=array("operation"=>"=","value"=>$product_object["id_product"]);
							$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
							if(isInBD($table,$filter)){
								?>
								<a href='javascript:add_to_favorites()' class='btn btn-mini btn-dark'><i class='fa fa-star'></i> <?php echo $s["remove_favorite"];?></a>
								<?php
							}else{
								?>
								<a href='javascript:add_to_favorites()' class='btn btn-mini btn-warning'><i class='fa fa-star'></i> <?php echo $s["add_to_favorites"];?></a>
								<?php
							}
						?>
						<?php
							$table="client_favorites";
							$filter=array();
							$filter["id_product"]=array("operation"=>"=","value"=>$product_object["id_product"]);
							$num_favorites=countInBD($table,$filter);
							if($num_favorites>0){
								?>
								<div style='float:right;font-size:12px;padding-top:5px;'>
									<?php echo $num_favorites;?>  <?php echo $s["people_with_this_clothe_as_favorite"];?>
								</div>
								<?php
							}
							?>
						
					</div>	
					<?php
				}else{
					?>
					<div style='padding-top:20px;'>
						<h4 style='font-size:12px;margin-bottom:10px;'><?php echo $s["add_to_favorites_help_no_login"];?></h4>
						<a href='./login.php' class='btn btn-mini btn-dark'><?php echo $s["login"];?></a>
						<?php
							$table="client_favorites";
							$filter=array();
							$filter["id_product"]=array("operation"=>"=","value"=>$product_object["id_product"]);
							$num_favorites=countInBD($table,$filter);
							if($num_favorites>0){
								?>
								<div style='float:right;font-size:12px;padding-top:5px;'>
									<?php echo $num_favorites;?> <?php echo $s["people_with_this_clothe_as_favorite"];?>
								</div>
								<?php
							}
							?>
					</div>
					<?php
				}
			?>
			<script>
				var displays = new Array();
				displays["24_shipping"]=false;
				displays["free_return"]=false;
				displays["need_help"]=false;
				function display_hidden(div_id){
					$.ajax({
						type: "POST",
						url: 'functions/mmorpg.php',
						data: {
							'action':"check_"+div_id,
							'serial_model_code':"<?echo $product_object["serial_model_code"]?>"
						},
						success: function(msg) {
						}
					});
					$("#24_shipping").css("display","none");
					$("#free_return").css("display","none");
					$("#need_help").css("display","none");
					if(displays[div_id]){
						$("#"+div_id).fadeOut();
						displays[div_id]=false;
					}else{
						$("#"+div_id).fadeIn();
						displays[div_id]=true;
					}
				}
			</script>
			<p style='text-align:right;margin-top:20px;font-size:11px'>
				<a class='' target="_blank" style='text-transform:uppercase' href='http://www.okycoky.net/classics/size_guide_page.php'><?php echo $s["size_guide"];?></a> | <a href='javascript:display_hidden("24_shipping")'><?php
				if($_GET["p"]=="139"){
						echo $s["5_shipping"];
					}else{
						echo $s["24_shipping"];	
					}
				?></a> | <a href='javascript:display_hidden("free_return")'><?php echo $s["free_return"];?></a> | <a href='javascript:display_hidden("need_help")'><?php echo $s["need_help"];?></a>


			</p>
			<div id='24_shipping' style='display:none;margin-bottom:10px;font-size:14px;border:1px solid #d4d4d4;padding:10px;background-color:#f4f4f4;'>
				<?php 
					if($_GET["p"]=="139"){
						echo $s["5_shipping_display"];
					}else{
						echo $s["24_shipping_display"];	
					}?>
			</div>
			<div id='free_return' style='display:none;margin-bottom:10px;font-size:14px;border:1px solid #d4d4d4;padding:10px;background-color:#f4f4f4;'>
				<?php echo $s["free_return_display"];?>
			</div>
			<div id='need_help' style='display:none;margin-bottom:10px;font-size:14px;border:1px solid #d4d4d4;padding:10px;background-color:#f4f4f4;'>
				<?php echo $s["need_help_display"];?>
			</div>
					
		
					
					<div class='more_info'>
						<div id='more_info_panel'>
							<div class='title'>
								<?php echo $s["more_images"]; ?>
							</div>
							<div class='secondaries'>
						<ul>
							
							<?php
								
								
								for($i=1;$i<=20;$i++){
									if(file_exists("./images/images/".$product_object["serial_model_code"]."-".$i.".jpg")){
										echo "<li><a href='#'><img class='image_link'  id='./images/images/".$product_object["serial_model_code"]."-".$i.".jpg' src='./img/interface/oky_loading.gif' longdesc='./images/images/".$product_object["serial_model_code"]."-".$i.".jpg?".date("YmdHis")."'/></a></li>";
									}
								}
							?>
						</ul>
					</div>
					
							</div>
					</div>
					
					
			
			<!--<table style='margin:20px 0px;'>
				<tr>
					<td style='padding-right:10px;'><img src='./img/like_<?php echo $lang;?>.png' style='height:80px'/></td>
					<td>				<div class="fb-like" data-href="<?php echo $url_base; ?>product.php?p=<?php echo $_GET["p"]; ?>" data-send="false" data-layout="box_count" data-width="450" data-show-faces="true" data-font="arial"></div>
</td>
				</tr>
			</table>-->
			<?php
				
				$count_also_like=0;
				
				?>
				<div class='more_info'>
					<div id='more_info_panel'>
						<div class='title'>
							<?php echo $s["you_may_also_like"];?>
						</div>
						<br/>
						<div style='text-align:l'>
				<?php
				
				if($count_also_like<5){
					$table="related_products";
					$filter=array();
					$filter["product"]=array("operation"=>"=","value"=>$product_object["serial_model_code"]);
					
					if(isInBD($table,$filter)){
						
						
						$relateds=listInBD($table,$filter);
						foreach ($relateds as $key => $related){
							$table="products";
							$filter=array();
							$filter["serial_model_code"]=array("operation"=>"=","value"=>$related["related"]);
							$filter["visible"]=array("operation"=>"=","value"=>1);
							
							if(isInBD($table,$filter)){
								$related_product=getInBD($table,$filter);
								?>
									<a href='./product.php?p=<?php echo $related_product["id_product"];?>&var=related' style='margin-right:10px;'>
										<img src='./images/images/<?php echo $related["related"];?>-1.jpg' height="200px"/>
									</a>
								
								<?php
								$count_also_like+=1;
							}
						}
						
					}
					
				}
				if($count_also_like<5){
					$table="products";
					$filter=array();
					$tmp=explode("-", $product_object["serial_model_code"]);
					$model_code=$tmp[1];
					$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>"%".$model_code."%");
					$filter["visible"]=array("operation"=>"=","value"=>1);
					$filter["id_product"]=array("operation"=>"<>","value"=>$product_object["id_product"]);
					$fields=array();
					$order="visits desc";
					$group="";
					$limit=5-$count_also_like;
					if(isInBD($table,$filter)){
						$relateds=listInBD($table,$filter,$fields,$order,$group,$limit);
						foreach ($relateds as $key => $related){
							?>
							<a href='./product.php?p=<?php echo $related["id_product"];?>&var=related' style='margin-right:10px;'>
								<img src='./images/images/<?php echo $related["serial_model_code"];?>-1.jpg' height="200px"/>
							</a>
							<?php	
							$count_also_like+=1;
						}
					}
				}
				
				if($count_also_like<5){
					$table="products";
					$filter=array();
					$tmp=explode("-", $product_object["serial_model_code"]);
					$serial_code=$tmp[0];
					$filter["serial_model_code"]=array("operation"=>"LIKE","value"=>"%".$serial_code."%");
					$filter["visible"]=array("operation"=>"=","value"=>1);
					$filter["id_product"]=array("operation"=>"<>","value"=>$product_object["id_product"]);
					$fields=array();
					$order="visits desc";
					$group="";
					$limit=5-$count_also_like;
					if(isInBD($table,$filter)){
						$relateds=listInBD($table,$filter,$fields,$order,$group,$limit);
						foreach ($relateds as $key => $related){
							?>
							<a href='./product.php?p=<?php echo $related["id_product"];?>&var=related' style='margin-right:10px;'>
								<img src='./images/images/<?php echo $related["serial_model_code"];?>-1.jpg' height="200px"/>
							</a>
							<?php	
							$count_also_like+=1;
						}
					}
								
				}
				
				if($count_also_like<5){
					$table="products";
					$filter=array();
					$filter["id_family"]=array("operation"=>"=","value"=>$product_object["id_family"]);
					$filter["visible"]=array("operation"=>"=","value"=>1);
					$filter["id_product"]=array("operation"=>"<>","value"=>$product_object["id_product"]);
					$fields=array();
					$order="visits desc";
					$group="";
					$limit=5-$count_also_like;
					if(isInBD($table,$filter)){
						$relateds=listInBD($table,$filter,$fields,$order,$group,$limit);
						foreach ($relateds as $key => $related){
							?>
							<a href='./product.php?p=<?php echo $related["id_product"];?>&var=related' style='margin-right:10px;'>
								<img src='./images/images/<?php echo $related["serial_model_code"];?>-1.jpg' height="200px"/>
							</a>
							<?php	
							$count_also_like+=1;
						}
					}
				}
							
				
				?>
						</div>
					</div>
				</div>
			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<?php echo $s["description"]; ?>
					</div>
								<div class='name'><h2>Ref.: <?php echo $product_object["serial_model_code"]; ?></h2></div>

					<div class='more' style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
						<?php echo $description; ?>
					</div>
				</div>
			</div>
			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<?php echo $s["composition"]; ?>
					</div>
					<div class='more style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
						<?php echo $composition; ?>

					</div>
				</div>
			</div>
			<?php
				if (!($product_object['id_lavado']==0 && $product_object['id_lejiado']==0 && $product_object['id_planchado']==0 && $product_object['id_lavado_seco']==0)){
			?>
			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<?php echo $s["care_instructions"]; ?>
					</div>
					<div style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
						<?php 
							if($product_object['id_lavado']!=0&&file_exists("./img/care_symbols/".$product_object["id_lavado"].".gif")){
								?>
								<img class='care_symbol' src='./img/care_symbols/<?php echo $product_object['id_lavado']; ?>.gif'/>
								<?php
							}
						?>
						<?php 
							if($product_object['id_lejiado']!=0&&file_exists("./img/care_symbols/".$product_object["id_lejiado"].".gif")){
								?>
								<img class='care_symbol' src='./img/care_symbols/<?php echo $product_object['id_lejiado']; ?>.gif'/>
								<?php
							}
						?>
						<?php 
							if($product_object['id_planchado']!=0&&file_exists("./img/care_symbols/".$product_object["id_planchado"].".gif")){
								?>
								<img class='care_symbol' src='./img/care_symbols/<?php echo $product_object['id_planchado']; ?>.gif'/>
								<?php
							}
						?>
						<?php 
							if($product_object['id_lavado_seco']!=0&&file_exists("./img/care_symbols/".$product_object["id_lavado_seco"].".gif")){
								?>
								<img class='care_symbol' src='./img/care_symbols/<?php echo $product_object['id_lavado_seco']; ?>.gif'/>
								<?php
							}
						?>
						<?php 
							if($product_object['id_secado']!=0&&file_exists("./img/care_symbols/".$product_object["id_secado"].".gif")){
								?>
								<img class='care_symbol' src='./img/care_symbols/<?php echo $product_object['id_secado']; ?>.gif'/>
								<?php
							}
						?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php
if(!$not_found) {
?>
<script>
	<?php
		//ALEX: Comentado porque devolvia error de $stocks no definido, por lo que realmente no hace nada este codigo.
		/*foreach ($stocks as $namemodel=>$model) {
			foreach ($model as $nameidcolor=>$idcolor) {
				$i=1;
				echo "stocks[$nameidcolor]=new Array();\n";
				foreach ($idcolor as $namesize => $thissize) {
					echo "stocks[".$nameidcolor."][$i]=".$thissize."\n";
					$i++;
				}
			}
		}*/
	?>
	var product_list = new Array();
	<?php
		mysql_data_seek($colors,0); //Rebobinar el resultset
		while($color = db_fetch($colors)) {
			echo "product_list['".$color['id_color']."'] = new Array();";
			for($i=0;$i<12;$i++){
				    echo "product_list['".$color['id_color']."'][".$i."] = 0;";
			}
		}
	?>
	$(document).mouseup(function (e) {
		var container = $(".select_child");
		if (container.has(e.target).length === 0) {
			container.hide();
		}
	});
	function setsize(id_size,size_string) {
		
		size=id_size;
		if($('#size_options_'+color).css('display')!='block'){
			$('#size_options_'+color).css('display','block');
		}else if($('#size_options_'+color).css('display')=='block'){
			$('#size_options_'+color).css('display','none');
		}
		$("#sizeseletor").html(size_string);
	}
	function setcolor(scolor) {
		if($('#size_options_'+color).css('display')=='block'){
			$('#size_options_'+color).css('display','none');
		}
		size=-1;
		$("#sizeseletor").html('<?php echo $s["size"]; ?>');
		color=scolor;
		if($.trim($('#size_options_'+color).text())==''){
			$('.size_selector').hide();
			$('.no_stock').show();
			$('#add_to_cart_button').hide();
		} else {
			$('.size_selector').show();
			$('.no_stock').hide();
			$('#add_to_cart_button').show();
		}
		$('.selected').removeClass('selected');
		$('#color_'+scolor).addClass('selected');
	}
	function add_to_favorites(){
		$.ajax({
			type: "POST",
			url: 'functions/add_favorite.php',
			data: {
				'id_product':"<?echo $product_object["id_product"]?>"
			},
			success: function(msg) {
				if(msg=="OK"){
					location.reload();
				}
			}
		});
	}
	function new_data(id_color,num_size,id){
		if ((!isNaN(parseInt($(id).attr('value'))))&&(parseInt($(id).attr('value'))>=0)){
			if (parseInt($(id).attr('value'))>stocks[id_color][num_size]) {
				$(id).attr("class","stockOut")
				$("#add_to_cart_infobox").attr("style","color:red");
				$("#add_to_cart_infobox").text("<?php echo $s["insufficient_stock"]; ?>");
				$("#add_to_cart_infobox").fadeIn('fast');
				$("#add_to_cart_button").css("display","none");
			} else {
				$(id).attr("class","stockIn");
				var okcount=0;;
				$(".stockOut").each(function() {
				okcount++;
				});
				if (okcount>0) {
					$("#add_to_cart_button").css("display","none");
				} else {
					$("#add_to_cart_button").css("display","block");
				}
			}
			old_number=product_list[id_color][num_size];
			subtotal=parseInt($('#subtotal_amount').html());
			subtotal_num=parseInt($('#subtotal_num').html())
			//if((subtotal_num+(parseInt($(id).attr('value')))) < <?php echo LIMITUNITTOTAL; ?>) {
				subtotal=subtotal-(old_number*price);
				subtotal_num=subtotal_num-(old_number);
				product_list[id_color][num_size]=parseInt($(id).attr('value'));
				subtotal=subtotal+(product_list[id_color][num_size]*price);
				subtotal_num=subtotal_num+(product_list[id_color][num_size]);
				$('#subtotal_amount').html(subtotal);
				$('#subtotal_num').html(subtotal_num);
			/*} else {
				$("#add_to_cart_infobox").attr("style","color:red");
				$("#add_to_cart_infobox").text("<?php echo $s["add_cart_limit"]; ?>");
				$("#add_to_cart_infobox").fadeIn('fast').delay(3000).fadeOut('fast');
			}*/
			$(id).attr('value',product_list[id_color][num_size]);
		}else{
			if ($(id).val()=="X") return;
			$(id).attr('value',product_list[id_color][num_size]);
		}
	}
	</script>
	<div id='zoom_window' style='display:none;'>
		<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'>
		</div>
		<div class='window_preview' style=' position:absolute; top:50px; z-index:910;width:100%'>
			<div class='contentbox'>
				<div class='image_zoom' style='text-align:center;'>
					<img id='zoom_image' src=''/>
				</div>
			</div>
		</div>
	</div>
	<script>
		var widths = new Array();
		<?php
		foreach($imagewidth as $k => $v) {
			echo "widths['".$k."'] = ".$v.";";
		}
		?>
		var mouse_is_inside = false;
		var subt;
		var subt_num;
		var moneytotal = parseFloat(<?php echo str_replace(",","",$moneytotal); ?>);
		var numtotal = parseInt(<?php echo $numtotal; ?>);
		function addcart() {
			if(size!=-1){
				m = parseFloat($('#moneytotal').html().replace(",", ""))+price;
				n = parseInt($('#numtotal').html())+1;
				$("#moneytotal").text(m.toFixed(2))
				$("#numtotal").text(n)
				$(".unitbox-disabled").attr("disabled",false);
				var allsizes = $("#allsizes").val();
				$(".unitbox-disabled").attr("disabled",true);
				tmp_size = size;
				$.ajax({
					type: "POST",
					url: 'addtocart_n.php',
					data: {
						'size': size,
						'color':color,
						'allsizes': allsizes,
						'id_product':"<?echo $product_object["id_product"]?>"
					},
					success: function(msg) {
						//alert(msg);
						if(msg!="") {
							$("#moneytotal").text(moneytotal);
							$("#numtotal").text(numtotal);
							$("#add_to_cart_infobox").css("display","block");
							$("#add_to_cart_infobox").text("<?php echo $s["add_cart_limit"]; ?>");
						} else {
							$("#size_selector").attr("style","border-color:<?php echo $season_color["semilight"]; ?>");
							$(".select_child").css("border-color","<?php echo $season_color["semilight"]; ?>");
							$("#add_to_cart_infobox").css("display","none");
							$('#continue_shopping_button').fadeIn('slow');
							stock = parseInt($('#stock_'+color+'_'+tmp_size).html());
							cart_items = parseInt($('#cart_items_'+color+'_'+tmp_size).html())+1;
							if(cart_items>=stock){
								$('#no_stock_'+color+'_'+tmp_size).css('display','block');
								$('#yes_stock_'+color+'_'+tmp_size).css('display','none');
							}
							$('#cart_items_'+color+'_'+tmp_size).html(cart_items);
						}
						$("#cartspan").fadeOut(500).fadeIn(500);
					}
				});
				size=-1;
				$("#sizeseletor").html('<?php echo $s["size"]; ?>');
				$.ajax({
					type: "POST",
					url: 'functions/mmorpg.php',
					data: {
						'action':"add_to_cart",
						'serial_model_code':"<?echo $product_object["serial_model_code"]?>"
					},
					success: function(msg) {
						if(msg=="OK"){
							location.reload();
						}
					}
				});
			} else {
				$.ajax({
					type: "POST",
					url: 'functions/mmorpg.php',
					data: {
						'action':"add_to_cart_no_size",
						'serial_model_code':"<?echo $product_object["serial_model_code"]?>"
					},
					success: function(msg) {
						if(msg=="OK"){
							location.reload();
						}
					}
				});
				$("#size_selector").attr("style","border-color:red");
				$(".select_child").css("border-color","red");
				$("#add_to_cart_infobox").css("display","block");
				$("#add_to_cart_infobox").text("<?php echo $s["add_cart_size"]; ?>");
				$("#add_to_cart_infobox").fadeIn('fast');
			}
		}
		 <?php	

		        if(file_exists("./images/videos/".$product_object["serial_model_code"].".mov")){
		        	?>
					var myVideo=document.getElementById("video");
					myVideo.muted= "muted";
					<?php
			}
        ?>
		$(document).ready(function (){
			<?php echo $script; ?>
			<?php

					if(file_exists("./images/videos/".$product_object["serial_model_code"].".mov")){
						?>
						$('.video_link').click(function(){
							
							$('.image_preview').css('display','none');
							  $('.video_preview').css('display','block');
							  $('.video_link').css('display','none');
							  $('.video_link_close').css('display','block');
							myVideo.play();
						
						});
						myVideo.addEventListener('volumechange', function() {
					      myVideo.volume=0;
					    }, false);
						$('.video_link_close').click(function(){
							$('.image_preview').css('display','block');
							$('.video_preview').css('display','none');
							$('.video_link').css('display','block');
							$('.video_link_close').css('display','none');
							myVideo.pause();
						});
						<?php
				}
			?>
			subt = parseInt($("#subtotal_amount").text());
			subt_num = parseInt($("#subtotal_num").text());
			$('.image_link').click(function(){
				$.ajax({
					type: "POST",
					url: 'functions/mmorpg.php?1',
					data: {
						'action':"view_image",
						'serial_model_code':"<?echo $product_object["serial_model_code"]?>"
					},
					success: function(msg) {
						if(msg=="OK"){
							location.reload();
						}
					}
				});
				$('#zoom_image').attr('src',$(this).attr('id'));
				$('#zoom_window').css('display','block');
				center = 0 - widths[$(this).attr('id')]/2;
				$('.window_preview').css('margin-left',center);
			});
			$('.detail_link').click(function(){
				$('#zoom_image').attr('src',$(this).attr('id'));
				$('#zoom_window').css('display','block');
				center = 0 - widths[$(this).attr('id')]/2;
				$('.window_preview').css('margin-left',center);
			});
			$(window).resize(function() {
				center = 0 - widths[$(this).attr('id')]/2;
				$('.window_preview').css('margin-left',center);
			});
			$('#close_button').click(function() {
				$('#zoom_window').css('display','none');
			});
			$('.window').hover(function(){ 
				mouse_is_inside=true; 
			}, function(){ 
				mouse_is_inside=false; 
			});
			$("body").mouseup(function(){ 
				if(! mouse_is_inside) $('#zoom_window').css('display','none');
			});
		});
	</script>
<?php
}
include("footer.php");
?>
