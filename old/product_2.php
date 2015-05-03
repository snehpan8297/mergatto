<?php
@session_start();
$not_found = false;
if(!isset($_GET["p"])) {
	header("location:404.php");
	die("Producto no encontrado");
}

$pag = "";
$product = $_GET["p"];
if(isset($_GET["pp"])) {
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
include("functions/get_lang.php");
$lang_url='./lang/lang_'.$lang.'.php';
include_once($lang_url);
include_once('./include/front_settings.php');

$product_object = productData($product);
if(isset($product_object) && !empty($product_object)) {
	$product_object["season"] = $season_winter[$product_object["season_winter"]]." '".$product_object["season_year"];
	
	$name = "OKY COKY ".stripslashes($product_object["name_es"]);
	if($lang!="es" && $product_object["name_".$lang]!="") {
		$name = "OKY COKY ".stripslashes($product_object["name_".$lang]);
	}
	$images = productImages($product);
	$sizes = productSizes($product_object["id_sizing"]);
	$colors = productColorsWithId($product_object["id_product"]);
	$producto['price'] = $product_object["pvp"];
	$script = "";
	$search_field = "";
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
		$nextp = nextProductFamily($family,1,$pp+1);
		if($pp > 0) {
			$prevp = nextProductFamily($family,1,$pp-1);
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
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<?php 
			if(!$not_found) {
				if($family == 'search'){
					echo "<a href='./search.php?search_input=".$_GET["search_input"]."'>".$s["search_title"]."</a>";
					$link = "./search.php?search_input=".$_GET["search_input"]."";
				}else{
					if($family == 'by_size'){
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
			<table style='width: 235px;'>
			<tr>
				<td width='100%'><a class="back" href="<?php echo $link; ?>"><img src='./img/interface/arrow_back.png' alt='Back'/>​</a>​</td>
				<td width='10' style='text-align: right;'>
				<?php 
				if (isset($prevp["id_product"])){
					echo "<a href='./product.php?p=".$prevp["id_product"]."&pp=".($pp-1)."&f=".$family.$search_field."&t=".$t."' style='background: url(./img/interface/arrows_pager.png) 0 0; display:block; line-height: 10px; margin-right: 10px;width:8px; height:10px;'> </a>";
				} else {
					echo "<a href='javascript:void(0)' style='background: url(./img/interface/arrows_pager.png) 0 -20px; display:block; line-height: 10px; margin-right: 10px;width:8px; height:10px;'> </a>";
				}
				echo "</td><td width='10' style='text-align: left;'>";
				if (isset($nextp["id_product"])){
					echo "<a href='./product.php?p=".$nextp["id_product"]."&pp=".($pp+1)."&f=".$family.$search_field."&t=".$t."' style='background: url(./img/interface/arrows_pager.png) -8px 0; display:block; line-height: 10px; width:8px; height:10px;'> </a>";
				} else {
					echo "<a href='javascript:void(0)' style='background: url(./img/interface/arrows_pager.png) -8px -20px; display:block; line-height: 10px;width:8px; height:10px;'> </a>";
				}
				?>
				</td>
			</tr>
			</table>
			<div class='principal'>
				<?php
					$imagewidth = array();
					if(db_count($images) > 0){
						$image1 = db_result($images,1);
						echo "<a href='#'><img class='image_link' id='".$image1."' src='./img/interface/oky_loading.gif' longdesc='./products/models/370/".$image1.".jpg' alt='Oky Coky ".$page_description."'/></a>";
						list($width, $height, $type, $attr) = getimagesize('./products/models/original/'.$image1.'.jpg');
						$imagewidth[$image1] = $width;
					} else {
						echo "<img class='image_link' src='./img/interface/no_image.jpg'/>";
					}
				?>
			</div>
			<?php
				if(db_count($images) > 1){
					?>
					<div class='secondaries'>
						<ul>
						<?php
							while($i = db_fetch($images)) {
								echo "<li><a href='#'><img class='image_link'  id='".$i["id_image"]."' src='./img/interface/oky_loading.gif' longdesc='./products/models/370/".$i["id_image"].".jpg' /></a></li>";
								list($width, $height, $type, $attr) = getimagesize('./products/models/original/'.$i["id_image"].'.jpg');
								$imagewidth[$i["id_image"]] = $width;
							}
						?>
						</ul>
					</div>
			<?php } ?>
		</div>
		<div class='information'>
			<div class='name'>
				<div>
					<h1 style='font-size:25px;'><?php echo $name; ?></h1>
				</div>
			</div>
			<div class='name'><h2>Ref.: <?php echo $product_object["serial_model_code"]; ?></h2></div>
			<div class='name'><?php echo $product_object["season"]; ?></div>
			<div class='price'>
				<?php
					if($product_object["use_discount"]==1){
						?>
						<span class='old_price'><?php echo $s["before"]." ".$producto['price'];?> <?php echo $c['name'];?>s</span>
						<h3><?php echo $s["now"]." "; printf("%.2f",round($product_object["pvp"]*$c["exchange"]*(100-$product_object["discount"])/100));?> <?php echo $c['name'];?>s (-<?php echo $product_object["discount"]; ?>%)</h3>
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

						$col = productColorsWithId($product_object["id_product"]);
						$colors = Array();
						while($colo = db_fetch($col)) {
						
							if(strtoupper(substr($colo["name_id_color"],-1)) != "M") {
								if(!isset($colors[$colo["name_id_color"]]["stock"])){
									$colors[$colo["name_id_color"]]["stock"]=Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
									$colors[$colo["name_id_color"]]["products_total"]=0;
								}
								$colors[$colo["name_id_color"]]["id"] = $colo["id"];
								$colors[$colo["name_id_color"]]["id_color"] = $colo["id_color"];
								$colors[$colo["name_id_color"]]["name_id_color"] = $colo["name_id_color"];
								$colors[$colo["name_id_color"]]["name_es"] = $colo["name_es"];
								$colors[$colo["name_id_color"]]["name_en"] = $colo["name_en"];
								$colors[$colo["name_id_color"]]["use_color"] = $colo["use_color"];
								$colors[$colo["name_id_color"]]["has_image"] = $colo["has_image"];
								$colors[$colo["name_id_color"]]["use_color"] = $colo["use_color"];
								$stock_to_add = getStockWithId($product_object["id_product"],$colo["id_color"]);
								foreach ($stock_to_add as $key=>$value){
									$colors[$colo["name_id_color"]]["stock"][$key]+=$value;
									$colors[$colo["name_id_color"]]["products_total"]+=$value;
									$colors[$colo["name_id_color"]]["use_color"] = $colo["use_color"];
								}
							}else{
								$original_name_id_color=substr($colo["name_id_color"],0,strlen($colo["name_id_color"])-1);
								if(!isset($colors[$original_name_id_color]["stock"])){
									$colors[$original_name_id_color]["stock"]=Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
									$colors[$original_name_id_color]["products_total"]=0;
									}
								$stock_to_add = getStockWithId($product_object["id_product"],$colo["id_color"]);
								foreach ($stock_to_add as $key=>$value){
									$colors[$original_name_id_color]["stock"][$key]+=$value;
									$colors[$original_name_id_color]["products_total"]+=$value;
								}
							}
						}
						foreach ($colors as $key=>$color){
							$product_total = $colors[$key]["products_total"];
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
											if($color["has_image"]==1){
												echo "<img class='image_color' src='./materials/".$color["id_color"].".jpg?".date("YmdHi")."'>";
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
										
											if($color["has_image"]==1){
												?>
												( <a class='underline detail_link' id='<?php echo $color["id_color"];?>' href='javascript:void(0)'><?php echo $s["see_details"];?></a> )
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
							$stock=$color["stock"];
							
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
									$stock_string.="><a href='javascript:setsize(".($i).",\"".$sizes[$i]."\")'>&nbsp;".$sizes[$i]."</a><span style='display:none' id='stock_".$color["id_color"]."_".$i."'>".$stock[$i]."</span><span style='display:none' id='cart_items_".$color["id_color"]."_".$i."'>".$cart_items[$i]."</span></li>";
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
				<div style='float:right;background:url("./img/interface/icon_percha.png");display:block;width:140px;height:20px;text-align:center;padding-top:10px;margin-right:90px;margin-top:-5px;'>
					<b><a href="javascript:popup('./size_guide.php?lang=<?php echo $lang;?>')" style='font-size:14px;'><?php echo $s["size_guide"];?></a></b>
				</div>
				<div class='size_selector'>
					<div class='select'>
						<div id='size_selector' class='select_head'>
							<a href='javascript:void(0);'><span class='arrow icon_arrow_down'></span><span class='text' id='sizeseletor'><?php echo $s["size"]; ?></span></a>
						</div>
						<?php echo $stock_string; ?>
						<script>
							$(document).ready(function (){
								$("#size_selector").click(function(){
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
			<div id='add_to_cart_infobox' style='margin-top:10px;color: red;'> </div>
			<input type="hidden" id='allsizes' value='<?php echo $all_sizes; ?>'/>
			<div class='add_to_cart'>
				<div class='likeabutton' id="add_to_cart_button" style='float:left;'><a id="payments_send_step1" href="javascript:addcart();"><span class='text'><span class='left_decoration'></span><?php echo $s["add_to_cart"]?></span><span class='right_decoration'></span></a></div>
				<?php
				if($family=='search'){
					$l = "./search.php?search_input=".$_GET["search_input"]."";
				}else{
					$l = "./list.php?f=".$family."&pag=".$pag."";
				} 
				?>
				<div class='likeabutton likeabutton_dark' id="continue_shopping_button" style='display:none;float:left;'><a href="<?php echo $l; ?>"><span class='left_decoration'></span><span class='text'><?php echo $s["back"]?></span><span class='right_decoration'></span></a></div>
			</div>
			<div style='height:25px;'>
				<div style='float:left;padding-top:3px;padding-right:5px;'></div>
				<div class="fb-like" data-href="<?php echo $url_base; ?>product.php?p=<?php echo $_GET["p"]; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>
			</div>
			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<?php echo $s["description"]; ?>
					</div>
					<div style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
						<?php echo $description; ?><br/><br/>OKY COKY SHOP <?php echo $product_object["name_".$lang];?> <?php echo $product_object["id_product"];?>
					</div>
				</div>
			</div>
			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<?php echo $s["composition"]; ?>
					</div>
					<div style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
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
		<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left: 50%; z-index:910;'>
			<div style='position:absolute; text-align: right;width: 100%;'>
				<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
			</div>
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
			} else {
				$("#size_selector").attr("style","border-color:red");
				$(".select_child").css("border-color","red");
				$("#add_to_cart_infobox").css("display","block");
				$("#add_to_cart_infobox").text("<?php echo $s["add_cart_size"]; ?>");
				$("#add_to_cart_infobox").fadeIn('fast');
			}
		}
		$(document).ready(function (){
			<?php echo $script; ?>
			subt = parseInt($("#subtotal_amount").text());
			subt_num = parseInt($("#subtotal_num").text());
			$('.image_link').click(function(){
				$('#zoom_image').attr('src',"./products/models/original/" + $(this).attr('id') + ".jpg" );
				$('#zoom_window').css('display','block');
				center = 0 - widths[$(this).attr('id')]/2;
				$('.window_preview').css('margin-left',center);
			});
			$('.detail_link').click(function(){
				$('#zoom_image').attr('src',"./materials/" + $(this).attr('id') + ".jpg?<?php echo date("YmdHm");?>" );
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