<?php
@session_start();
include ("./include/bdOC.php");
unset($_SESSION['cart_classics']);
if (!isset($_SESSION['admin_classics'])) {
    header("location:./admin.php");
    die();
}
include_once("./include/products.php");
include_once("./include/inbd.php");
if(isset($_GET["product"])){
	$p = productData($_GET["product"]);
	$next = nextProduct($p);
} else if (isset($_GET["action"])) {
	if ($_GET["action"]=="next") $_SESSION["listing_counter"]++;
	if ($_GET["action"]=="previous") $_SESSION["listing_counter"]--;
	if ($_SESSION["listing_counter"]<0) $_SESSION["listing_counter"]=sizeof($_SESSION["listing"])-1;
	if ($_SESSION["listing_counter"]==sizeof($_SESSION["listing"])) $_SESSION["listing_counter"]=0;
	$p = productData($_SESSION["listing"][$_SESSION["listing_counter"]]);
} else {
	header("location: ./admin_list_products.php");
	die();
}
$page = "admin_product_validate";
include("header_pop.php");
$images = getIfModelHasImageWithId($p["id_product"]);


$p['reference'] = $p["serial_model_code"];
$colors_server = getColors($p["serial_model_code"]);
$col = productColorsWithId($p["id_product"]);
$i = 0;
$colors = array();
while($color = db_fetch($col)) {
	$colors[$i]['id_color'] = $color["id_color"];
	$colors[$i]['name_id_color'] = $color["name_id_color"];
	$colors[$i]['use_color'] = $color["use_color"];
	$colors[$i]['name'] = $color["name"];
	$colors[$i]['name_es'] = $color["name_es"];
	$colors[$i]['name_en'] = $color["name_en"];
	$colors[$i]['has_image'] = $color["has_image"];
	$i++;
}
$p['wash'] = $p["id_lavado"];
$p['bleach'] = $p["id_lejiado"];
$p['ironing'] = $p["id_planchado"];
$p['dry_wash'] = $p["id_lavado_seco"];
$p['drying'] = $p["id_secado"];
$p["sizes"] = getSizesIndex($p["id_sizing"]);
?>
<link rel="stylesheet" href="./theme/droparea.css" type="text/css" />
<div id='content' style='padding:0;'>

	<div id='product'>
		<div class='preview'>
			<script src="./js/droparea/droparea.js"></script>
			
			
			<div style='width:100px;'>
				<div id='areas' style='overflow:hidden;'>
                <input id='droparea' type="file" class="droparea spot" name="xfile" data-post="./js/droparea/upload.php?status=images&def_model=<?php echo $p["serial_model_code"]; ?>&id_product=<?php echo $p["id_product"];?>&position=1" />
			</div>
						
			
						
			</div>
			
			<div class='secondaries' style='margin-top:120px;'>
				<?php
					for($i=1;$i<=20;$i++){
						$img_src="";
						if(file_exists("./images/images/".$p["serial_model_code"]."-".$i.".jpg")){
							$img_src="./images/images/".$p["serial_model_code"]."-".$i.".jpg";
							?>
							<div style='display:block;overflow:auto;margin:20px 0px;'>
							
							<img style='float:left;width:90px;height:auto' src='<?php echo $img_src;?>'>
							<div style='margin-left:100px;'>
							<a class='btn btn-white ' style='display:block' href='javascript:up("<?php echo $p["serial_model_code"];?>",<?php echo $i;?>)' style='margin-top:10px;'>
								Up
							</a>
							<a class='btn btn-danger' style='display:block' href='javascript:deleteimg("images/images/<?php echo $p["serial_model_code"]."-".$i;?>.jpg")'>
								Borrar
							</a>
							<a class='btn btn-white' style='display:block' href='javascript:down("<?php echo $p["serial_model_code"];?>",<?php echo $i;?>)' style='margin-top:10px;'>
								Down
							</a>
							</div>
							</div>
							<?php
						}	
					}
				?>
				<img src='<?php echo $img_src;?>'/>
			</div>
			<script>
				function up(serial_model_code,position){
					$.ajax({
						type : "POST",
						url : "./functions/reorderimages.php",
						data : {
							"serial_model_code" : serial_model_code,
							"position" : position,
							"action" : "up"
							
						},
						success : function(msg) {
							location.reload();
							
						}
						});
				}
				function down(serial_model_code,position){
					$.ajax({
						type : "POST",
						url : "./functions/reorderimages.php",
						data : {
							"serial_model_code" : serial_model_code,
							"position" : position,
							"action" : "down"
							
						},
						success : function(msg) {
							location.reload();
							
						}
						});
				}
			</script>
			
		</div>
		<script>
			// Calling jQuery "droparea" plugin
			$('.droparea').droparea({
				'instructions': '<br/><h1 style="padding-top:10px">IM&Aacute;GENES</h1><br/>Arrastra aqu&iacute; las im&aacutegenes',
				'init' : function(result){
				},
				'start' : function(area){
					area.find('.error').remove(); 
				},
				'error' : function(result, input, area){
					$('<div class="error">').html(result.error).prependTo(area); 
					return 0;
				},
				'complete' : function(result, file, input, area){
					location.reload();
				}
			});
			$(function() {
				$(".sortable").sortable({
					//placeholder: "ui-state-highlight",
					stop: function(event,ui) {
						imgOrder();
						var columns = [];
						columns = $(this).sortable('toArray').join(',');
						$.ajax({
							type : "POST",
							url : "./functions/reorderimages.php",
							data : {
								"data" : columns
							},
							success : function(msg) {
								if(msg == "OK"){
									//Posiciones guardadas
								}
							}
						});
					}
				});
				$(".sortable").disableSelection();
			});
			</script>
		<div class='information'>
			<div class='form_entry'>
				<input type='checkbox' name='visible' id='visible' <?php if($p['visible']==1) echo "checked";?> id='add_this_product'/>
				<?php echo $s["visible_to_clients"];?> | <?php echo $s["reference"];?> : <span class='important'><?php echo $p['reference'];?></span>
			</div>
			<div class='form_entry'>
				<label>Referencia web </label><input type='text' name='web_serial_model_code' id='web_serial_model_code' value='<?php echo $p["web_serial_model_code"];?>'/>
			</div>
			<div class='form_entry'>
				<input type='checkbox' name='cover' id='cover' <?php if($p['cover']==1) echo "checked";?> id='cover'/>
				Visible en Portada
			</div>
			<div class='form_entry'>
				<input type='checkbox' name='sizable' id='sizable' <?php if($p['sizable']==1) echo "checked";?> id='cover'/>
				Visible en Secci&oacute;n Tallas
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s["product_name"];?> <?php echo $s["spanish"];?><span class='form_isrequired'>*</span></td>
					<td><input style='width:310px;' name="name_es" id="name_es" class='text' type='text' value='<?php echo stripslashes($p['name_es']);?>'/> <span id="name_es_alert" class='form_entry_alert'></span></td>
				</tr>
				<tr>
					<td><?php echo $s["product_name"];?> <?php echo $s["english"];?><span class='form_isrequired'>*</span></td>
					<td><input style='width:310px;' name="name_en" id="name_en" class='text' type='text' value='<?php if ($p['name_en']!="") echo stripslashes($p['name_en']); else echo stripslashes($p['name_es']); ?>'/> <span id="name_en_alert" class='form_entry_alert'></span></td>
				</tr>
				</table>
				<span id="name_alert" class='form_entry_alert'></span>
			</div>
			<div class='form_entry'>
				Categor&iacute;a<br/>
				
				
				<?php
					$table='categories';
					$filter=array();
					$filter["type"]=array("operation"=>"=","value"=>"normal");
					$categories=listInBD($table,$filter);
					
					$table ="product_categories";
					$filter=array();
					$filter["id_product"]=array("operation"=>"=","value"=>$p["id_product"]);
					$product_categories = listInBD($table,$filter);
					
					foreach ($categories as $key => $category){
						?>
						<input type="checkbox" id='category_<?php echo $category["id_category"];?>'
						<?php
							$is_category=false;
							foreach ($product_categories as $key => $product_category){
								if($product_category["id_category"]==$category["id_category"]){
									?> checked <?php
								}
							}
						?>
						><?php echo $category["name_es"];?><br/>
						<?php
					}
				?>
			</div>
			<div class='form_entry'>
				<?php echo $s["family"]; ?>
				<select id='id_family' name='id_family'>
				<?php
					$families = allFamilies();
					while($f = db_fetch($families)) {
						$checked = "";
						if($p["id_family"] == $f["id_family"])
							$checked = "selected";
						echo "<option value='".$f["id_family"]."' ".$checked.">".$s["family_".$f["id_family"]]."</option>";
					}
				?> 
				</select>
			</div>
			<div class='form_entry'>
				Subfamilia<br/>
				
				<?php
					$table='subfamily';
					$filter=array();
					$filter["id_family"]=array("operation"=>"=","value"=>$p["id_family"]);
					$subfamilys=listInBD($table,$filter);
					
					$table ="product_subfamilies";
					$filter=array();
					$filter["id_product"]=array("operation"=>"=","value"=>$p["id_product"]);
					$product_subfamilies = listInBD($table,$filter);
					
					foreach ($subfamilys as $key => $subfamily){
						?>
						<input type="checkbox" id='subfamily_<?php echo $subfamily["id_subfamily"];?>'
						<?php
							$is_subfamily=false;
							foreach ($product_subfamilies as $key => $product_subfamily){
								if($product_subfamily["id_subfamily"]==$subfamily["id_subfamily"]){
									?> checked <?php
								}
							}
						?>
						><?php echo $subfamily["name_es"];?><br/>
						<?php
					}
				?>
			</div>
			
			
			
			
			
			
			
			
			<div class='add_to_cart'>
			<?php
			if(isset($_GET["product"])){
			?>
				<div class='likeabutton'>
					<a id="next" href="javascript:save('exit');"><span class='text'><?php echo $s["save"]." & ".$s["exit"];?></span></a>
				</div>
				<div class='likeabutton'>
					<a href="javascript:save('next');"><span class='text'><?php echo $s["save"]." & ".$s["next"];?></span></a>
				</div>
			<?php } ?>
		</div>
			
			
			
			
			
			
			
			
			<div class='form_entry' style='margin-top:10px;'>
				Posici&oacute;n en listado
				<input type='text' name='product_position' class='text' id='product_position' value='<?php echo $p["product_position"];?>' />
			</div>
			<div class='form_entry'>
				<span class='label'><?php echo $s["season"];?>
					<select name="season_winter" id="season_winter" class='select'>
						<option value='0' <?php if($p["season_winter"]==0){echo "selected='selected'";}?>><?php echo $season_winter[0]; ?></option>
						<option value='1' <?php if($p["season_winter"]==1){echo "selected='selected'";}?>><?php echo $season_winter[1]; ?></option>
					</select>
					<?php echo $s["year"]; ?> <input name='season_year' id='season_year' class='text' style='width:30px;text-align:right;' value='<?php echo $p["season_year"]; ?>'/>
				</span>
			</div>
			<?php
				
			?>
			<div class='form_entry'>
				Precios por Grupos
				<table style='width:500px;border-collapse:collapse'>
					<tr style='background-color:#f0f0f0;'>
						<th style='width:20%'>Grupo</th>
						<th style='width:15%'>Precio</th>
						<th style='width:15%'>Descuento</th>
						<th style='width:15%'>Precio Final</th>
					</tr>
					<?php
					$table="product_prices";
					$filter=array();
					$filter["id_product"]=array("operation"=>"=","value"=>$_GET["product"]);
					$filter["id_client_group"]=array("operation"=>"=","value"=>0);
					$product_price=getInBD($table,$filter);
					?>
					<tr>
						<td style='background-color:#f4f4f4;'>Por Defecto</td>
						<td><input type='text' name='pvp_0' id='pvp_0' style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["pvp"];?>'/></td>
						<td><input type='text' name='discount_0' id='discount_0' onchange='javascript:$("#pvp_with_discount_0").val($("#pvp_0").val()*(100-$("#discount_0").val())/100);' style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["discount"];?>' style='width:90%;text-align:right;'/></td>
						<td><input type='text' name='pvp_with_discount_0' id='pvp_with_discount_0' style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["pvp_with_discount"];?>' style='width:90%;text-align:right;'/></td>
					</tr>
					
			<?php
				$table="client_groups";
				$client_groups=listInBD($table);
				foreach ($client_groups as $key=>$client_group){
					$table="product_prices";
					$filter=array();
					$filter["id_product"]=array("operation"=>"=","value"=>$_GET["product"]);
					$filter["id_client_group"]=array("operation"=>"=","value"=>$client_group["id_client_group"]);
					$product_price=getInBD($table,$filter);
					?>
					<tr>
						<td style='background-color:#f4f4f4;'><?php echo $client_group["name"];?></td>
						<td><input type='text' name='pvp_<?php echo $client_group["id_client_group"];?>' id='pvp_<?php echo $client_group["id_client_group"];?>' style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["pvp"];?>'/></td>
						<td><input type='text' name='discount_<?php echo $client_group["id_client_group"];?>' id='discount_<?php echo $client_group["id_client_group"];?>' onchange='javascript:$("#pvp_with_discount_<?php echo $client_group["id_client_group"];?>").val($("#pvp_<?php echo $client_group["id_client_group"];?>").val()*(100-$("#discount_<?php echo $client_group["id_client_group"];?>").val())/100);'style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["discount"];?>' style='width:90%;text-align:right;'/></td>
						<td><input type='text' name='pvp_with_discount_<?php echo $client_group["id_client_group"];?>' id='pvp_with_discount_<?php echo $client_group["id_client_group"];?>' style='width:90%;text-align:right;margin-bottom:0;padding:0;' value='<?php echo $product_price["pvp_with_discount"];?>' style='width:90%;text-align:right;'/></td>
					</tr>
					<?php
				}
			?>
			</table>


			
			<table>
			<tr>
				<td><?php echo $s["price"];?></td>
				<td colspan='2'><input style='width:370px;' class='text' type="text" name="pvp" id="pvp" value="<?php echo $p["pvp"];?>"/> &euro;</td>
			</tr>
			<tr>
				<td><input type='checkbox' name='use_discount' id='use_discount' <?php if($p['use_discount']==1) echo "checked";?> /> <?php echo $s["use_discount"];?></td>
				<td><input style='width:100px;' class='text' type="text" name="discount" id="discount" value="<?php echo $p["discount"];?>"/> %</td>
				<td style='text-align:right'><?php echo $s["price"];?> <span id='price_with_discount'><?php if($p['use_discount']==1) {echo round($p['pvp']*(100-$p["discount"])/100,2);} else { echo $p["pvp"];} ?></span> &euro;</td>
			</tr>
			</table>
			<script>
				$(document).ready(function (){
					$('#pvp').change(function(){
						$('#discount').val($('#discount').val().replace(',', '.'));
						if($('#discount').val()==""){
							$('#discount').val(0);
						}else if(isNaN(parseFloat($('#discount').attr('value')))){
							$('#discount').attr('value',0);
						}else if(parseFloat($('#discount').attr('value'))<0){
							$('#discount').attr('value',parseFloat($('#discount').attr('value'))*-1);
						}
						if($('#use_discount').is(":checked")) {
							price_with_discount = (1 - parseFloat($('#discount').val()) /100) * parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						} else {
							price_with_discount = parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						}
					});
					$('#use_discount').change(function(){
						$('#discount').val($('#discount').val().replace(',', '.'));
						if($('#discount').val()==""){
							$('#discount').val(0);
						}else if(isNaN(parseFloat($('#discount').attr('value')))){
							$('#discount').attr('value',0);
						}else if(parseFloat($('#discount').attr('value'))<0){
							$('#discount').attr('value',parseFloat($('#discount').attr('value'))*-1);
						}
						if($('#use_discount').is(":checked")) {
							price_with_discount = (1 - parseFloat($('#discount').val()) /100) * parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						} else {
							price_with_discount = parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						}
					});
					$('#discount').change(function(){
						$('#discount').val($('#discount').val().replace(',', '.'));
						if($('#discount').val()==""){
							$('#discount').val(0);
						}else if(isNaN(parseFloat($('#discount').attr('value')))){
							$('#discount').attr('value',0);
						}else if(parseFloat($('#discount').attr('value'))<0){
							$('#discount').attr('value',parseFloat($('#discount').attr('value'))*-1);
						}
						if($('#use_discount').is(":checked")) {
							price_with_discount = (1 - parseFloat($('#discount').val()) /100) * parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						} else {
							price_with_discount = parseFloat($('#pvp').val());
							$('#price_with_discount').html(Math.round(price_with_discount*Math.pow(10,2))/Math.pow(10,2));
						}
					});
				});
			</script>
		</div>
		<div class='add_to_cart'>
			<?php
			if(isset($_GET["product"])){
			?>
				<div class='likeabutton'>
					<a id="next" href="javascript:save('exit');"><span class='text'><?php echo $s["save"]." & ".$s["exit"];?></span></a>
				</div>
				<div class='likeabutton'>
					<a href="javascript:save('next');"><span class='text'><?php echo $s["save"]." & ".$s["next"];?></span></a>
				</div>
			<?php } ?>
		</div>
		<div class='form_entry'>
			<ul>
			<?php foreach ($colors as $i=>$val){ ?>
				<li style='list-style:none;border-bottom:1px solid #333333;padding:5px;margin-bottom:5px;' class="xkcolors" id="<?php echo $colors[$i]['id_color'];?>">
					<table>
					<tr>
						<td valign="middle" style='width:500px;'>
							<input type='checkbox' class="use_color" <?php if($colors[$i]['use_color']) echo "checked"; ?> name='color_checkbox_<?php echo $colors[$i]['id_color'];?>' id='color_checkbox_<?php echo $colors[$i]['id_color'];?>'/> 
							<?php echo $s["use_this_color"]; ?> | <?php echo $s["code"]; ?>: <input type='text' class='color_name text' name='color_name_<?php echo $colors[$i]['id_color'];?>' value='<?php echo $colors[$i]['name'];?>' style='width:100px;'/> <br/>
							<?php echo $s["spanish"];?> <input type='text' class='text color_name_es' name='color_name_es' id='color_name_es' value='<?php echo $colors[$i]["name_es"]; ?>' style='width:150px;'/> | 
							<?php echo $s["english"];?> <input type='text' class='text color_name_en' name='color_name_en' id='color_name_en' value='<?php echo $colors[$i]["name_en"]; ?>' style='width:150px;'/>
							<input type="hidden" name="color_name_0" id="<?php echo $colors[$i]['id_color'];?>" value='<?php echo $colors[$i]['name'];?>' />
							<input type="hidden" name="color_name_0" id="code_<?php echo $colors[$i]['id_color'];?>" value='<?php echo $colors[$i]['name_id_color'];?>' />
						</td>
						<td valign="middle">
							<?php if($colors[$i]['has_image']==1){ ?>
								<a href='javascript:chooseimg("material","<?php echo $colors[$i]['id_color'];?>")'><img id='color_preview_<?php echo $colors[$i]['id_color']?>' class='image_link_selected' src='./materials/<?php echo $colors[$i]['id_color']; ?>.jpg' style='width:30px;'></a>
							<?php } else { ?>
								<a href='javascript:chooseimg("material","<?php echo $colors[$i]['id_color'];?>")'><img id='color_preview_<?php echo $colors[$i]['id_color']?>' class='image_link_selected' src='./materials/no_image.jpg' style='width:30px;'></a>
							<?php } ?>
							<input type='hidden' name='has_image_<?php echo $colors[$i]['id_color'];?>' class='has_image' id='has_image_<?php echo $colors[$i]['id_color'];?>' value='<?php echo $colors[$i]['has_image']?>' />
						</td>
					</tr>
					</table>
					<div>
						<span class='label'>
					<table style='border-collapse:collapse;'>
					<tr>
						<td rowspan="2" style='padding:0px 10px;'><?php echo $s["actual_stock"];?></td>
						<input type='hidden' name='id_color_<?php echo $colors[$i]['id_color'];?>' value='<?php echo $colors[$i]['id_color'];?>' />
					<?php
					for($size=0;$size<sizeof($p["sizes"]);$size++){
						?>
						<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"];?>; color:#ffffff;;padding:2px 5px;'><?php echo $p["sizes"][$size];?></td> 
					<?php } ?>
					<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"];?>; color:#ffffff;;padding:2px 5px;'><?php echo $s["total"] ?></td>
					</tr>
					<tr>
						<?php
						$first=true;
						//print_r($colors);
						$p["elements"]=getStockWithId($p["id_product"],$colors[$i]["id_color"]);
						
						//print_r($colors[$i]);
						$a=strpos($colors[$i]["name_id_color"],"M");
						for($element=0;$element<sizeof($p["sizes"]);$element++){
							if($first){
							?>
							<td class='important' style='text-align:center; padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' id='stock_size_<?php echo $element+1; ?>_<?php echo $colors[$i]['id_color'];?>' value='<?php echo $p["elements"][$element+1];?>'/></div></td> <?php
							$first = false;
							}else{
							?>
							<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' id='stock_size_<?php echo $element+1; ?>_<?php echo $colors[$i]['id_color'];?>' value='<?php echo $p["elements"][$element+1];?>'/></div></td>
							<?php
							}
						}
						?>
						<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'><?php echo array_sum($p["elements"]);?></td>
					</tr>
					<?php
						for($f=$element+1;$f<=12;$f++){
							?>
							<input type='hidden' class='stock_size_<?php echo $f; ?>' value='<?php echo $p["elements"][$f];?>'/>
							<?php
						}
					?>
					</table>
							</span>
						</div>
					</li>
					 <?php
                    }
					?>
				</ul>
			</div>
			<div>
				<ul id='new_colors_base' style='display:none'>
					<?php if(isset($colors[$i]) && !empty($colors[$i])) { ?>
					<li style='list-style:none;border-bottom:1px solid #333333;padding:5px;margin-bottom:5px;' class="newcolors" id="<?php echo $colors[$i]['id_color'];?>">
						<div>
							<table>
								<tr>
									<td valign="middle" style='width:500px;'>
										<div class='form_entry'>
											<input type='checkbox' class="use_color"/> <?php echo $s["use_this_color"]; ?>
										</div>
										<div class='form_entry'>
											<span><?php echo $s["internal_code"]; ?></span> <input class='id_color text' type='text' style='width:100px;' />
											| <span><?php echo $s["code"]; ?></span> <input class='name text' type='text' style='width:100px;' />
										</div>
										<div class='form_entry'>
											<?php echo $s["spanish"];?> <input type='text' class='text color_name_es' style='width:150px;'/> | 
											<?php echo $s["english"];?> <input type='text' class='text color_name_en' style='width:150px;'/>
										</div>
									</td>
										<td valign="middle">
									<span id='new_color_preview'></span>
									<input type='hidden' class='has_image' value='0' />
									</td>
								</tr>
							</table>
						</div>
						<div>
						<table style='border-collapse:collapse;'>
						<tr>
							<td rowspan="2" style='padding:0px 10px;'><?php echo $s["actual_stock"];?></td>
							<?php
							for($size=0;$size<sizeof($p["sizes"]);$size++){
								?>
								<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"];?>; color:#ffffff;;padding:2px 5px;'><?php echo $p["sizes"][$size];?></td> 
							<?php
							}
							?>
							<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"];?>; color:#ffffff;;padding:2px 5px;'><?php echo $s["total"] ?></td>
						</tr>
						<tr>
							<?
							$first=true;
							for($element=0;$element<sizeof($p["sizes"]);$element++){
								if($first){
								?>
									<td class='important' style='text-align:center; padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' value='0'/></div></td> <?php
									$first = false;
								}else{
								?>
									<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' value='0'/></div></td>
									<?php
								}
							}
							?>
							<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'>--</td>
						</tr>
						</table>
						<?php
						for($f=$element+1;$f<=12;$f++){
							?>
							<input type='hidden' class='stock_size_<?php echo $f; ?>' value='<?php echo $p["elements"][$f];?>'/>
							<?php
						}
						?>
						</div>
					</li>
					<?php } ?>
				</ul>
				<ul>
					<li style='list-style:none;border-bottom:1px solid #333333;padding:5px;margin-bottom:5px;' class="newcolors" id="newcolor">
						<a class='underline' href='javascript:addColor();'><?php echo $s["add_color"]; ?></a>
					</li>
				</ul>
			</div>
			<script>
				function addColor(){
					old_html=$('#new_colors_list').html();
					$.ajax({
						type : "POST",
						url : "./functions/create_new_color.php",
						data:{
							"serial_model_code":'<?php echo $p["serial_model_code"]; ?>',
							"id_product":'<?php echo $p["id_product"]; ?>',
						},
						success : function(msg) {
							var salida=msg.split("||");
							if (salida[0]=="OK"){
								location.reload(true);
							}
						}
					});
				}
			</script>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s['description'];?> <?php echo $s["spanish"];?></td>
					<td><input style='width:360px;' type="text" class="text"  name='descripcion' id='descripcion' value="<?php echo stripslashes($p['description_es']); ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $s['description'];?> <?php echo $s["english"];?></td>
					<td><input style='width:360px;' name="description_en" id="description_en" class='text' type='text' value='<?php if ($p['description_en']!="") echo $p['description_en']; else echo stripslashes($p['description_es']);?>'/></td>
				</tr>
				</table>
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s["composition"];?> <?php echo $s["spanish"];?></td>
					<td><input style='width:353px;' type="text" class="text" name='composition' id='composition' value="<?php 
						$composition = $p['composition_es'];
						if(mb_detect_encoding($composition, 'UTF-8', true) === FALSE) { 
							$composition = stripslashes(utf8_encode($composition));
						}
						echo $composition;?>"/></td>
				</tr>
				<tr>
					<td><?php echo $s["composition"];?> <?php echo $s["english"];?></td>
					<td><input style='width:353px;' name="composition_en" id="composition_en" class='text' type='text' value='<?php 
						if($p['composition_en']!="") {
							$composition = $p['composition_en'];
						} else {
							$composition = $p['composition_es'];
						}
						if(mb_detect_encoding($composition, 'UTF-8', true) === FALSE) { 
							$composition = stripslashes(utf8_encode($composition));
						}
						echo $composition;?>'/></td>
				</tr>
				</table>
			</div>
			<div class='form_entry' style='overflow:auto'>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["washing"];?></span>
					<?php
						if (($p["wash"] != "")&&($p["wash"]!=0)&&file_exists("./img/care_symbols/".$p["wash"].".gif"))
							echo "<img src='./img/care_symbols/".$p["wash"].".gif' />";
						else
							echo "----";
					?>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["bleaching"];?></span>
					<?php
					if (($p["bleach"] != "")&&($p["bleach"]!=0)&&file_exists("./img/care_symbols/".$p["bleach"].".gif"))
						echo "<img src='./img/care_symbols/".$p["bleach"].".gif' />";
					else
						echo "----";
					?>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["ironing"];?></span>
					<?php
					if (($p["ironing"] != "")&&($p["ironing"]!=0)&&file_exists("./img/care_symbols/".$p["ironing"].".gif"))
						echo "<img src='./img/care_symbols/".$p["ironing"].".gif' />";
					else
						echo "----";
					?>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label' style='text-align:center;'><?php echo $s["dry_cleaning"];?></span>
					<?php
					if (($p["dry_wash"] != "")&&($p["dry_wash"]!=0)&&file_exists("./img/care_symbols/".$p["dry_wash"].".gif"))
						echo "<img src='./img/care_symbols/".$p["dry_wash"].".gif' />";
					else
						echo "----";
					?>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["drying"];?></span>
					<?php
					if (($p["drying"] != "")&&($p["drying"]!=0)&&file_exists("./img/care_symbols/".$p["drying"].".gif"))
						echo "<img src='./img/care_symbols/".$p["drying"].".gif' />";
					else
						echo "----";
					?>
				</div>
			</div>
			<div class='form_entry' style='overflow:auto'>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["washing"];?></span>
					<input type="text" class="text" name='wash' id='id_wash' value="<?php echo $p["wash"];?>" style='width:20px;'>
					<div>
						<table>
							<tr>
								<td><img src='./img/care_symbols/1.gif' style='width:30px'/></td>
								<td>1</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/2.gif' style='width:30px'/></td>
								<td>2</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/3.gif' style='width:30px'/></td>
								<td>3</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/4.gif' style='width:30px'/></td>
								<td>4</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/19.gif' style='width:30px'/></td>
								<td>19</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/22.gif' style='width:30px'/></td>
								<td>22</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/23.gif' style='width:30px'/></td>
								<td>23</td>
							</tr>
						</table>
					</div>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["bleaching"];?></span>
					<input type="text" class="text" name='bleach' id='id_bleach' value="<?php echo $p["bleach"];?>" style='width:20px;'>
					<div>
						<table>
							<tr>
								<td><img src='./img/care_symbols/5.gif' style='width:30px'/></td>
								<td>5</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/6.gif' style='width:30px'/></td>
								<td>6</td>
							</tr>
						</table>
					</div>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["ironing"];?></span>
					<input type="text" class="text" name='iron' id='id_iron' value="<?php echo $p["ironing"];?>" style='width:20px;'>
					<div>
						<table>
							<tr>
								<td><img src='./img/care_symbols/7.gif' style='width:30px'/></td>
								<td>7</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/8.gif' style='width:30px'/></td>
								<td>8</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/9.gif' style='width:30px'/></td>
								<td>9</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/10.gif' style='width:30px'/></td>
								<td>10</td>
							</tr>
						</table>
					</div>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["dry_cleaning"];?></span>
					<input type="text" class="text" name='dry_clean' id='id_dry_wash' value="<?php echo $p["dry_wash"];?>" style='width:20px;'>
					<div>
						<table>
							<tr>
								<td><img src='./img/care_symbols/11.gif' style='width:30px'/></td>
								<td>11</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/12.gif' style='width:30px'/></td>
								<td>12</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/13.gif' style='width:30px'/></td>
								<td>13</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/20.gif' style='width:30px'/></td>
								<td>20</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/21.gif' style='width:30px'/></td>
								<td>21</td>
							</tr>
						</table>
					</div>
				</div>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["drying"];?></span>
					<input type="text" class="text" name='dry' id='id_dry' value="<?php echo $p["drying"];?>" style='width:20px;'>
					<div>
						<table>
							<tr>
								<td><img src='./img/care_symbols/14.gif' style='width:30px'/></td>
								<td>14</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/15.gif' style='width:30px'/></td>
								<td>15</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/16.gif' style='width:30px'/></td>
								<td>16</td>
							</tr>
							<tr>
								<td><img src='./img/care_symbols/17.gif' style='width:30px'/></td>
								<td>17</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class='add_to_cart'>
				<?php
					if(isset($_GET["product"])){
						?>
                		<div class='likeabutton'>
                			<a id="next" href="javascript:save('exit');"><span class='text'><?php echo $s["save"]." & ".$s["exit"];?></span></a>
                		</div>
                		<div class='likeabutton'>
                    		<a href="javascript:save('next');"><span class='text'><?php echo $s["save"]." & ".$s["next"];?></span></a>
                		</div>
						<?php
					}
				?>
			</div>
			<div id="imageselector" class='zoom_window' style='display:none;'>
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:800px; height:650px; margin-left:-400px; z-index:910;'>
					<div style='position:absolute; text-align: right;width: 100%;'>
						<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
					</div>
					<div class='contentbox' style='height: 530px;'>
						<div style='padding:20px; padding-bottom:0px'>
							<div id='page_header'>
								<div id='page_navigator'><a href='' class='important'><?php echo $s["add_image_product_title"]; ?></a></div>
							</div>
							<div id='infobox_header' class='infobox_info'>
								<?php echo $s["add_image_product_moreinfo"]; ?>
							</div>
						</div>
						<iframe id="iframein" src="" style="background-color: white;width:100%;height:100%;border:none;"></iframe>
					</div>
				</div>
			</div>
			<div id="materialselector" class='zoom_window' style='display:none;'>
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:800px; height:500px; margin-left:-400px;z-index:910;'>
					<div style='position:absolute; text-align: right;width: 100%;'>
						<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
					</div>
					<div class='contentbox'>
						<div style='padding:20px; padding-bottom:0px'>
							<div id='page_header'>
								<div id='page_navigator'><a href='' class='important'><?php echo $s["add_material_image_title"]; ?></a></div>
							</div>
							<div id='infobox_header' class='infobox_info'>
								<?php echo $s["add_material_image_moreinfo"]; ?>
							</div>
						</div>
						<iframe id="iframein_material" src="" style="background-color: white;width:100%;height:100%;border:none;"></iframe>
					</div>
				</div>
			</div>
			<script>
				var mouse_is_inside = false;
				var subt;
				var subt_num;
				var moneytotal = parseInt(<?php echo $moneytotal; ?>);
				var numtotal = parseInt(<?php echo $numtotal; ?>);
				
				$(document).ready(function (){
					$('.close_button').click(function() {
						$('.zoom_window').css('display','none');
					});
					$('.window').hover(function(){ 
						mouse_is_inside=true; 
					}, function(){ 
						mouse_is_inside=false; 
					});
					$('.sortable li').live({
						mouseenter:
						function() {
							$(this).children("div").show();
						},
						mouseleave:
						function() {
							$(this).children("div").hide();
						}
					});
					$('.del_img').live("click",function() {
						deleteimage($(this).attr("id"));
						imgOrder();
					});
					$("body").mouseup(function(){ 
						if(! mouse_is_inside) $('.zoom_window').css('display','none');
					});
				});
				function imgOrder() {
					$('.sortable img').each(function(index, value){
						if(index == 0) {
							$(this).css("width","235px");
							$(this).css("height","auto");
						} else {
							$(this).css("width","auto");
							$(this).css("height","115px");
						}
					});
				}
				function next() {
					window.location="./admin_edit_product.php?action=next";
				}
				function previous() {
					window.location="./admin_edit_product.php?action=previous";
				}
				function save(action) {
					product_name_es = $('#name_es').val();
					product_name_en = $('#name_en').val();
					error = false;
					if(product_name_es.length>22){
						$('#name_es').css('border','1px solid red');
						$('#name_es').css('color','red');
						$('#name_es_alert').html('<?php echo $s["field_too_long_22"]; ?>');
						$('#name_es_alert').css('display','inline');
						$('#name_es').focus();
						error=true;
					} else {
						$('#name_es').css('border','1px solid green');
						$('#name_es').css('color','green');
						$('#name_es_alert').css('display','none');
					}
					if(product_name_en.length>22){
						$('#name_en').css('border','1px solid red');
						$('#name_en').css('color','red');
						$('#name_en_alert').html('<?php echo $s["field_too_long_22"]; ?>');
						$('#name_en_alert').css('display','inline');
						$('#name_en').focus();
						error=true;
					} else {
						$('#name_en').css('border','1px solid green');
						$('#name_en').css('color','green');
						$('#name_en_alert').css('display','none');
					}
					if(!error) {
						var cad = "";
						var coma = "";
						var tot = 0;
						$(".xkcolors").each(function() {
							var pre = "#" + $(this).attr("id");
							var ckd = 0;
							if($(pre + " .use_color").is(":checked")){
								ckd = 1;
							}
							var ckn = $(pre + " .color_name").val();
							var ckn1 = $(pre + " .color_name_es").val();
							var ckn2 = $(pre + " .color_name_en").val();
							var ckn3 = $(pre + " .has_image").val();
							var sz1 = $(pre + " .stock_size_1").val();
							var sz2 = $(pre + " .stock_size_2").val();
							var sz3 = $(pre + " .stock_size_3").val();
							var sz4 = $(pre + " .stock_size_4").val();
							var sz5 = $(pre + " .stock_size_5").val();
							var sz6 = $(pre + " .stock_size_6").val();
							var sz7 = $(pre + " .stock_size_7").val();
							var sz8 = $(pre + " .stock_size_8").val();
							var sz9 = $(pre + " .stock_size_9").val();
							var sz10 = $(pre + " .stock_size_10").val();
							var sz11 = $(pre + " .stock_size_11").val();
							var sz12 = $(pre + " .stock_size_12").val();
							cad += coma + $(this).attr("id") + "||" + ckd + "||" + ckn +"||"+ckn1+"||"+ckn2+"||"+ckn3+"||"+sz1+"||"+sz2+"||"+sz3+"||"+sz4+"||"+sz5+"||"+sz6+"||"+sz7+"||"+sz8+"||"+sz9+"||"+sz10+"||"+sz11+"||"+sz12;
							coma = "//";
							if($(pre + " .use_color").attr("checked") == "checked")
								tot++;
						});
						if((tot == 0) && ($("#visible").attr("checked") == "checked")) {
							alert("<?php echo $s["no_color_selected"];?>");
							visible='0';
						}else{
							visible=$("#visible").attr("checked");
						}
						use_discount=0;
						if($('#use_discount').is(":checked")){
							use_discount=1;
						}
						cover=0;
						if($('#cover').is(":checked")){
							cover=1;
						}
						sizable=0;
						if($('#sizable').is(":checked")){
							sizable=1;
						}
						categories="";
						separator="";
						<?php
							foreach ($categories as $key => $category){
							?>
						if($("#category_<?php echo $category["id_category"];?>").is(':checked')){
							categories=categories+separator+"<?php echo $category["id_category"];?>";
							separator="||";
						}
					
							<?php
							}
						?>
						subfamilies="";
						separator="";
						<?php
							foreach ($subfamilys as $key => $subfamily){
							?>
						if($("#subfamily_<?php echo $subfamily["id_subfamily"];?>").is(':checked')){
							subfamilies=subfamilies+separator+"<?php echo $subfamily["id_subfamily"];?>";
							separator="||";
						}
					
							<?php
							}
						?>
						
						$.ajax({
							type : "POST",
							url : "./function/add_product_price.php",
							data : {
								"id_product" : <?php echo $_GET["product"];?>,
								"id_client_group" : 0,
								"pvp" : $("#pvp_0").val(),
								"discount" : $("#discount_0").val(),
								"use_discount" : $("#use_discount_0").val(),
								"pvp_with_discount" : $("#pvp_with_discount_0").val()
							},
							success : function(msg) {
								if(msg == "OK"){
								}
							}
						});
						<?php
							$table="client_groups";
							$client_groups=listInBD($table);
							foreach ($client_groups as $key=>$client_group){
								?>
						$.ajax({
							type : "POST",
							url : "./functions/add_product_price.php",
							data : {
								"id_product" : <?php echo $_GET["product"];?>,
								"id_client_group" : <?php echo $client_group["id_client_group"];?>,
								"pvp" : $("#pvp_<?php echo $client_group["id_client_group"];?>").val(),
								"discount" : $("#discount_<?php echo $client_group["id_client_group"];?>").val(),
								"use_discount" : $("#use_discount_<?php echo $client_group["id_client_group"];?>").val(),
								"pvp_with_discount" : $("#pvp_with_discount_<?php echo $client_group["id_client_group"];?>").val()
							},
							success : function(msg) {
								if(msg == "OK"){
								}
							}
						});
								
								<?php
							}
						?>
						
						
						$.ajax({
							type : "POST",
							url : "./editproductbd.php",
							data : {
								"id_product" : <?php echo $p["id_product"];?>,
								"serial_model_code" :  '<?php echo $p["serial_model_code"];?>',
								"web_serial_model_code" :  $("#web_serial_model_code").val(),
								"name_es" : $("#name_es").val(),
								"name_en" : $("#name_en").val(),
								"id_family" : $("#id_family").val(),
								"subfamilies" : subfamilies,
								"categories" : categories,
								"product_position" : $("#product_position").val(),
								"sizable" : sizable,
								"composition_es" : $("#composition").val(),
								"composition_en" : $("#composition_en").val(),
								"visible" : visible,
								"colores" : cad,
								"description_es" : $("#descripcion").val(),
								"description_en" : $("#description_en").val(),
								"season_winter" : $("#season_winter").val(),
								"season_year" : $("#season_year").val(),
								"pvp" : $("#pvp").val(),
								"use_discount" : use_discount,
								"cover" : cover,
								"discount" : $("#discount").val(),
								"id_dry" : $("#id_dry").val(),
								"id_wash" : $("#id_wash").val(),
								"id_bleach" : $("#id_bleach").val(),
								"id_iron" : $("#id_iron").val(),
								"id_dry_wash" : $("#id_dry_wash").val()
							},
							success : function(msg) {
								if(msg == "OK"){
									if(action == "exit") {
										window.close();
									} else if(action == "next") {
										<?php
											if(isset($next["id_product"])){
											?>
												window.location="./admin_edit_product_pop.php?product=<?php echo $next["id_product"]?>";
											<?php
											}else{
											?>
												alert('<?php echo $s["no_more_edit_products"]; ?>');
												window.location="./admin_list_products.php";
											<?php
											}
										?>
									}
								}else{
									alert(msg);
								}
							}
						});
						
					}
				}
				function chooseimg(position,id_color) {
					$("#iframein").attr("src", "");
					if(position=="material") {
						$("#iframein_material").attr("src", "addimagematerial.php?id_color="+id_color);
						$("#materialselector").css("display", "block");
					} else {
						$("#iframein").attr("src", "addimageproduct.php?type=" + position);
						$("#imageselector").css("display", "block");
					}
				}
				function closeadd() {
					$("#imageselector").css("display", "none");
					$("#materialselector").css("display", "none");
				}
				function setimage(part, index) {
					if (part=="mainphoto") {
						var parte = "#" + part;
						$(parte).attr("src", './products/models/370/' + index + '.jpg');
						parte = "#id_" + part;
						$(parte).val(index);
					}
					if(part=="material"){
						$('#color_preview_'+index).attr("src", './materials/' + index + '.jpg')
						$('#has_image_'+index).attr("value","1");
					}
					var parte=part.split("_");
					if (parte[1]==-1) {
						var indice=0;
						$(".secondaries ul li").each(function () {
							indice++;
						});
						var agregado="<li><a href='javascript:chooseimg("+indice+")'><img class='image_link' id='subphoto_"+indice+"' src='./products/models/370/"+index+".jpg'/></a><input type='hidden' class='subphoto' id='id_subphoto_"+indice+"' value='"+index+"' /></li>";
						$("#selectedphotos").html($("#selectedphotos").html()+agregado);
					} else {
						var parte = "#" + part;
						$(parte).attr("src", './products/models/370/' + index + '.jpg')
						parte = "#id_" + part;
						$(parte).val(index);
					}
				}
				function deleteimage(url) {
					$.ajax({
						type : "POST",
						url : "./functions/delete_image.php",
						data : {
							"id_image" : id_image
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#image_'+id_image).fadeOut('slow').remove();
							}
						}
					});
				}
				function deleteimg(url) {
					$.ajax({
						type : "POST",
						url : "./functions/delete_image.php",
						data : {
							"url" : url
						},
						success : function(msg) {
							location.reload();
						}
					});
				}
				function delimage(part,id_color) {
					var partes=part.split("_");
					if(part=="material"){
						$("#color_preview_"+id_color).attr("src","./materials/no_image.jpg");
						$('#has_image_'+id_color).attr("value","0");
					}else if (partes[1]>0) {
						var parte="#"+part;
						$(parte).parent().parent().remove();
					} else {
						var parte="#mainphoto";
						if ($(".secondaries ul li").first().attr("id")=="imageadder") {
							$(parte).attr("src","./img/interface/no_image.jpg");
							$("#id_mainphoto").val("--");
						} else {
							$(parte).attr("src",$(".secondaries ul li").find("img").attr("src"));
							$("#id_mainphoto").val($(".secondaries ul li").find("input").val());
							$(".secondaries ul li").first().remove();
						}
					}
					closeadd();
				}
			</script>
		</div>
	</div>
</div>
