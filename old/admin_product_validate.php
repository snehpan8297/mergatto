<?php
@session_start();
if (!(isset($_SESSION['admin']))) {
    header("location:./admin.php");
}
include ("./include/bdOC.php");
$si["family_19"] = "Others";
$si["family_23"] = "Coats";
$si["family_24"] = "Shirts";
$si["family_25"] = "T-Shirts";
$si["family_26"] = "Belts";
$si["family_27"] = "Jackets";
$si["family_28"] = "Blazers";
$si["family_29"] = "Scarves";
$si["family_30"] = "Skirts";
$si["family_31"] = "Vests";
$si["family_32"] = "Trousers";
$si["family_33"] = "Trousers DRK";
$si["family_36"] = "Dresses";
$si["family_37"] = "Tops";
$si["family_39"] = "Accessories";
$si["family_40"] = "Morocco Clothes";
$si["family_41"] = "Cuellos";
$si["family_42"] = "Shirts Dresslok";
$si["family_43"] = "T-Shirts Dresslok";
$si["family_44"] = "Jackets Oky's";
$si["family_46"] = "Gloves";
$si["family_47"] = "Necklaces";
$si["family_48"] = "Headdress";
$si["family_49"] = "Foulards";
$si["family_50"] = "Shoes";

if (isset($_POST["new_season_name"])) {
	$listado1 = getPropPedData($_POST["new_season_name"], $_POST["receiptnumber"]);
	while ($d1=mssql_fetch_assoc($listado1)) {
		$listado[]=$d1;
	}
	unset($_SESSION["precargados"]);
	foreach ($listado as $key => $value) {
		$_SESSION["precargados"][$key] = $value;
	}
	$testit=$_SESSION["precargados"];
	foreach ($testit as $key => $value) {
		//echo "cargando ".$value["serial_model_code"];
		$testimages = getIfModelHasImage($value["COD_SERIE_MODELO"]);
		if(sizeof($testimages) != 0) {
			$continue = true;
			foreach($testimages as $t) {
				if(!is_writable("./products/models/original/" . $t . ".img")) {
					$continue = false;
				}
			}
			if($continue) {
				continue;
			}
		}
		if (isset($value["image"]) && $value["image"] == 1) {
			getImageProduct($value["COD_SERIE_MODELO"]);
		}else{
			getImageProductPatron($value["COD_SERIE_MODELO"]);	
		}
	}
	$_SESSION["contador"] = 0;
	unset($_SESSION["precarga"]);
	$_SESSION["precarga"][$_SESSION["contador"]]=getModelSeason($testit[$_SESSION["contador"]]["COD_SERIE_MODELO"]);
	$test=$_SESSION["precarga"];
} else {
	$testit = $_SESSION["precargados"];
	$_SESSION["precarga"][$_SESSION["contador"]]=getModelSeason($testit[$_SESSION["contador"]]["COD_SERIE_MODELO"]);
	$test=$_SESSION["precarga"];
}
if ($_SESSION["contador"] == sizeof($testit)) {
	header("location: ./admin_end_product_validate.php");
}
if (!(isset($_SESSION['admin']))) {
	header("location:./admin.php");
}

$page = "admin_product_validate";
include ("header.php");

//    Aqui se ponen funciones de carga de los datos;

//    Aqui se ponen funciones de adaptacion
$images = getIfModelHasImage($test[$_SESSION["contador"]]["serial_model_code"]);
$descarray = explode("-", $test[$_SESSION["contador"]]["name"]);
if(!isset($descarray[1])) {
	$descarray[1] = "";
}
$modelname = getFamilyName($test[$_SESSION["contador"]]["id_family"]) . " " . $descarray[1];
$p['name_es'] = $modelname;
$p["name_en"]=strtoupper($si["family_".$test[$_SESSION["contador"]]["id_family"]])." ". $descarray[1];
$p['season_year'] = "00";
$p['season_winter'] = 0;
$p['pvp'] = $test[$_SESSION["contador"]]["public_pvp"];
$p['use_discount'] = 0;
$p['discount'] = 0;
$p['reference'] = $test[$_SESSION["contador"]]["serial_model_code"];

$colors = getColor($test[$_SESSION["contador"]]["serial_model_code"],$_SESSION["precargados"][$_SESSION["contador"]]["ID_COLOR_PROD"]);
$p['name_colors'] = $colors["name"];
$p['id_colors'] = $colors["id"];
$p["number"]=$colors["number"];
$p['description_es'] = utf8_encode($descarray[0]);
$p['description_en'] = utf8_encode($descarray[0]);
$p['id_wash'] = $test[$_SESSION["contador"]]["id_lavado"];
$p['id_bleach'] = $test[$_SESSION["contador"]]["id_lejiado"];
$p['id_ironing'] = $test[$_SESSION["contador"]]["id_planchado"];
$p['id_dry_wash'] = $test[$_SESSION["contador"]]["id_lavado_seco"];
$p['id_drying'] = $test[$_SESSION["contador"]]["id_secado"];
$p["sizes"] = getSizesIndex($test[$_SESSION["contador"]]["id_sizing"]);
$p["composition_es"] = utf8_encode($test[$_SESSION["contador"]]["description"]);
$p["composition_en"] = utf8_encode($test[$_SESSION["contador"]]["description"]);
?>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_product_validate_title"] . " " . ($_SESSION["contador"]+1) . "/" . sizeof($testit);?></a>
		</div>
	</div>
	<div id='product'>
		<div class='preview'>
			<!--<div class='product_navigator' style='overflow:auto;padding:2px;'>
				<a href='javascript:chooseimg(0)'><?php echo $s["choose_principal_image"]; ?></a>
			</div>-->
			<div class='principal'>
				<?php
				if (sizeof($images) > 0) {
					$image1 = $images[0];
					echo "<a href='#'><img class='image_link' id='mainphoto' src='./products/models/370/" . $image1 . ".jpg'/></a>";
					echo "<input type='hidden' id='id_mainphoto' value='" . $image1 . "' />";
				} else {
					echo "<a href='#'><img class='image_link' id='mainphoto' src='./img/interface/no_image.jpg'/></a>";
					echo "<input type='hidden' id='id_mainphoto' value='--' />";
				}
				?>
			</div>
		</div>
		<div class='information'>
			<div class='form_entry'>
				<!--<input type='checkbox' name='add_this_product' checked id='add_this_product'/>--> <?php echo $s["add_this_product"];?> | <?php echo $s["reference"]; ?> : <span class='important'><?php echo $p['reference'];?></span> <input type='hidden' id='serial_model_code' value='<?php echo $p['reference'];?>'/>
			</div>
			<div class='form_entry'>
				<table>
					<tr>
						<td><?php echo $s["product_name"];?> <?php echo $s["spanish"];?><span class='form_isrequired'>*</span></td>
						<td><input  name="name_es" id="name_es" class='text' type='text' value='<?php echo $p['name_es'];?>'/> <span id="name_es_alert" class='form_entry_alert'></span></td>
					</tr>
					<tr>
						<td><?php echo $s["product_name"];?> <?php echo $s["english"];?><span class='form_isrequired'>*</span></td>
						<td><input  name="name_en" id="name_en" class='text' type='text' value='<?php if ($p['name_en']!="") echo $p['name_en']; else echo $p['name_es'] ;?>'/> <span id="name_en_alert" class='form_entry_alert'></span></td>
					</tr>
				</table>
				<span id="login_client_code_alert" class='form_entry_alert'></span>
			</div>
			<div class='form_entry'>
				<?php echo $s["family"]; ?>
				<select id='id_family' name='id_family'>
				<?php
					$families = allFamilies();
					while($f = db_fetch($families)) {
						$checked = "";
						if($test[$_SESSION["contador"]]["id_family"] == $f["id_family"])
							$checked = "selected";
						echo "<option value='".$f["id_family"]."' ".$checked.">".$s["family_".$f["id_family"]]."</option>";
					}
				?> 
				</select>
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
			<div class='form_entry'>
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
							$('#pvp').attr('value',$('#pvp').attr('value').replace(',', '.'));
							if($('#pvp').attr('value')==""){
								$('#pvp').attr('value',0);
							}else if(isNaN(parseFloat($('#pvp').attr('value')))){
								$('#pvp').attr('value',0);
							}else if(parseFloat($('#pvp').attr('value'))<0){
								$('#pvp').attr('value',parseFloat($('#pvp').attr('value'))*-1);
							}
							if($('#use_discount').is(":checked")){
								price_with_discount=(1-parseFloat($('#discount').attr('value'))/100)*parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}else{
								price_with_discount=parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}
						});
						$('#use_discount').change(function(){
							$('#discount').attr('value',$('#discount').attr('value').replace(',', '.'));
							if($('#discount').attr('value')==""){
								$('#discount').attr('value',0);
							}else if(isNaN(parseFloat($('#discount').attr('value')))){
								$('#discount').attr('value',0);
							}else if(parseFloat($('#discount').attr('value'))<0){
								$('#discount').attr('value',parseFloat($('#discount').attr('value'))*-1);
							}
							if($('#use_discount').is(":checked")){
								price_with_discount=(1-parseFloat($('#discount').attr('value'))/100)*parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}else{
								price_with_discount=parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}
						});
						$('#discount').change(function(){
							$('#discount').attr('value',$('#discount').attr('value').replace(',', '.'));
							if($('#discount').attr('value')==""){
								$('#discount').attr('value',0);
							}else if(isNaN(parseFloat($('#discount').attr('value')))){
								$('#discount').attr('value',0);
							}else if(parseFloat($('#discount').attr('value'))<0){
								$('#discount').attr('value',parseFloat($('#discount').attr('value'))*-1);
							}
							if($('#use_discount').is(":checked")){
								price_with_discount=(1-parseFloat($('#discount').attr('value'))/100)*parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}else{
								price_with_discount=parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}
						});
					});
				</script>
			</div>
			<div class='add_to_cart'>
				<div class='likeabutton'>
					<a id="next" href="javascript:addcart();"><span class='text'><?php echo $s["next"];?></span></a>
				</div>
			</div>
			<div class='form_entry'>
				<ul>
					<?php
					for($i=0;$i<sizeof($p['id_colors']);$i++){
						$color=explode("-",$p['name_colors'][$i]);
					?>
						<li style='list-style:none;border-bottom:1px solid #333333;padding:5px;margin-bottom:5px;' class="xkcolors" id="<?php echo $p['id_colors'][$i];?>">
						<table>
						<tr>
							<td valign="middle" style='width:500px;'>
								<input type='hidden' class="use_color" checked name='color_checkbox_<?php echo $p['id_colors'][$i];?>' id='color_checkbox_<?php echo $p['id_colors'][$i];?>'/> 
								<?php echo trim($s["code"]); ?>: <input type='text' class='color_name text' name='color_name' value='<?php echo utf8_encode($p["name_colors"][$i]);?>' style='width:100px;'/><input type='hidden' class='original_color_name text' name='color_name' value='<?php echo utf8_encode($p["name_colors"][$i]);?>'/> <br/>
								<?php echo $s["spanish"];?> <input type='text' class='text color_name_es' name='color_name_es' id='color_name_es' value='<?php echo utf8_encode($p["name_colors"][$i]);?>' style='width:150px;'/> | 
								<?php echo $s["english"];?> <input type='text' class='text color_name_en' name='color_name_en' id='color_name_en' value='<?php echo utf8_encode($p["name_colors"][$i]);?>' style='width:150px;'/>
								<!--<input type="hidden" name="color_name_0" id="<?php //echo $colors[$i]['id_color'];?>" value='<?php //echo $colors[$i]['name'];?>' />
								<input type="hidden" name="color_name_0" id="code" value='<?php //echo $colors[$i]['name_id_color'];?>' />-->
							</td>
						</tr>
						</table>
						<div>
							<span class='label'>
								<table style='border-collapse:collapse;'>
								<tr>
									<td rowspan="2" style='padding:0px 10px;'><?php echo $s["add_to_stock"];?></td>
									<!--<input type='hidden' name='id_color' value='<?php //echo $colors[$i]['id_color'];?>' />-->
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
								/*$p["elements"]=getStock($p["serial_model_code"],$colors[$i]["id_color"]);
								//print_r($colors[$i]);
								$a=strpos($colors[$i]["name_id_color"],"M");
								if ($a===false) {
									$p2["elements"]=getStock($p["serial_model_code"],$colors[$i]["name_id_color"]);
									//print_r($p2["elements"]);
								}*/
								
								$tot = 0;
								for($element=0;$element<sizeof($p["sizes"]);$element++){
									$tot += $testit[$_SESSION["contador"]]["TALLA".($element+1)];
									if($first){
									?>
										<td class='important' style='text-align:center; padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' id='stock_size_<?php echo $element+1; ?>' value='<?php echo $testit[$_SESSION["contador"]]["TALLA".($element+1)];?>'/></div></td> <?php
										$first = false;
									}else{
									?>
										<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'><div class='form_entry'><input type='text' style='width:10px;text-align:center' class='stock_size_<?php echo $element+1; ?> text' id='stock_size_<?php echo $element+1; ?>' value='<?php echo $testit[$_SESSION["contador"]]["TALLA".($element+1)];?>'/></div></td>
									<?php
									}
								}
								?>
								<td class='important' style='text-align:center; border-left:1px solid <?php echo $season_color["light"];?>;padding:2px 5px;'><?php echo $tot; ?></td>
								</tr>
								<?php
									for($i=$element+1;$i<=12;$i++){
										?>
										<input type='hidden' class='stock_size_<?php echo $i; ?>' value='<?php echo $testit[$_SESSION["contador"]]["TALLA1"];?>'/>
										<?php
									}
								?>
								</table>
							</span>
						</div>
					</li> 
					<?php } ?>
				</ul>
			</div>
			<div class='form_entry'>
				<table>
					<tr>
						<td><?php echo $s['description'];?> <?php echo $s["spanish"];?></td>
						<td><input style='width:360px;'type="text" class="text"  name='descripcion_es' id='descripcion_es' value="<?php echo $p['description_es'];?>" /></td>
					</tr>
					<tr>
						<td><?php echo $s['description'];?> <?php echo $s["english"];?></td>
						<td><input style='width:360px;' name="description_en" id="description_en" class='text' type='text' value='<?php if ($p['description_en']!="") echo $p['description_en']; else echo $p['description'] ;?>'/></td>
					</tr>
				</table>
			</div>
			<div class='form_entry'>
				<table>
					<tr>
						<td><?php echo $s["composition"];?> <?php echo $s["spanish"];?></td>
						<td><input style='width:353px;' type="text" class="text" name='composition_es' id='composition_es' value="<?php echo $p['composition_es'];?>"/></td>
					</tr>
					<tr>
						<td><?php echo $s["composition"];?> <?php echo $s["english"];?></td>
						<td><input style='width:353px;' name="composition_en" id="composition_en" class='text' type='text' value='<?php if ($p['composition_en']!="") echo $p['composition_en']; else echo $p['composition'] ;?>'/></td>
					</tr>
				</table>
			</div>
			<div class='form_entry' style='overflow:auto'>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["washing"];?></span>
					<input type="text" class="text" name='wash' id='id_wash' value="<?php echo $p["id_wash"];?>" style='width:20px;'>
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
					<input type="text" class="text" name='bleach' id='id_bleach' value="<?php echo $p["id_bleach"];?>" style='width:20px;'>
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
					<input type="text" class="text" name='iron' id='id_iron' value="<?php echo $p["id_ironing"];?>" style='width:20px;'>
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
					<input type="text" class="text" name='dry_clean' id='id_dry_wash' value="<?php echo $p["id_dry_wash"];?>" style='width:20px;'>
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
					<input type="text" class="text" name='dry' id='id_dry' value="<?php echo $p["id_drying"];?>" style='width:20px;'>
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
				<div class='likeabutton'>
					<a id="next" href="javascript:addcart();"><span class='text'><?php echo $s["next"] ?></span></a>
				</div>
			</div>
			<div id="imageselector" class='zoom_window' style='display:none;'>
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'>
				</div>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:800px; height:500px; margin-left:-400px;z-index:910;'>
					<div style='position:absolute; text-align: right;width: 100%;'>
						<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
					</div>
					<div class='contentbox'>
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
			<script>
				var mouse_is_inside = false;
				var subt;
				var subt_num;
				var moneytotal = parseInt(<?php echo $moneytotal; ?>);
				var numtotal = parseInt(<?php echo $numtotal; ?>);

				$(document).ready(function (){
					$('#close_button').click(function() {
						$('.zoom_window').css('display','none');
					});
					$('.window').hover(function(){ 
						mouse_is_inside=true; 
					}, function(){ 
						mouse_is_inside=false; 
					});
					$("body").mouseup(function(){ 
						if(! mouse_is_inside) $('.zoom_window').css('display','none');
					});
				});
				function addcart() {
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
							var salida=$(pre + " .original_color_name").val().split("-");

							var ckn1 = salida[1];
							var ckn = $(pre + " .color_name").val();
							var ckn2 = $(pre + " .color_name_es").val();
							var ckn3 = $(pre + " .color_name_en").val();;
							cad += coma + $(this).attr("id") + "||" + ckn +"||"+ckn1+"||"+ckn2+"||"+ckn3;
							coma = "//";
							if($(pre + " .use_color").attr("checked") == "checked")
								tot++;
						});
						use_discount=0;
						if($('#use_discount').is(":checked")){
							use_discount=1;
						}
						if((tot == 0) && ($("#add_this_product").attr("checked") == "checked")) {
							alert("<?php echo $s["no_color_selected"];?>");
							return false;
						}
						$.ajax({
							type : "POST",
							url : "./addproducttodb.php",
							data : {
								"serial_model_code" : $("#serial_model_code").val(),
								"name_es" : $("#name_es").val(),
								"name_en" : $("#name_en").val(),
								"add" : "checked",
								"id_family" : $("#id_family").val(),
								"id_dry" : $("#id_dry").val(),
								"id_wash" : $("#id_wash").val(),
								"id_bleach" : $("#id_bleach").val(),
								"id_iron" : $("#id_iron").val(),
								"id_dry_wash" : $("#id_dry_wash").val(),
								"composition_es" : $("#composition_es").val(),
								"composition_en" : $("#composition_en").val(),
								"main_photo" : $("#id_mainphoto").val(),
								"colores" : cad,
								"description_es" : $("#descripcion_es").val(),
								"description_en" : $("#description_en").val(),
								"pvp": $("#pvp").val(),
								"use_discount" : use_discount,
								"discount" : $("#discount").val(),
								"season_winter" : $("#season_winter").val(),
								"season_year" : $("#season_year").val(),
								"stock_size_1": $("#stock_size_1").val(),
								"stock_size_2": $("#stock_size_2").val(),
								"stock_size_3": $("#stock_size_3").val(),
								"stock_size_4": $("#stock_size_4").val(),
								"stock_size_5": $("#stock_size_5").val(),
								"stock_size_6": $("#stock_size_6").val(),
								"stock_size_7": $("#stock_size_7").val(),
								"stock_size_8": $("#stock_size_8").val(),
								"stock_size_9": $("#stock_size_9").val(),
								"stock_size_10": $("#stock_size_10").val(),
								"stock_size_11": $("#stock_size_11").val(),
								"stock_size_12": $("#stock_size_12").val(),
							},
							success : function(msg) {
								if(msg == "OK")
									window.location.reload();
							}
						});
					}
				}

				function chooseimg(position) {
					$("#iframein").attr("src", "");
					$("#iframein").attr("src", "addimageproduct.php?type=" + position);
					$("#imageselector").css("display", "block");
				}

				function closeadd() {
					$("#imageselector").css("display", "none");
				}

				function setimage(part, index) {
					var parte = "#" + part;
					$(parte).attr("src", './products/models/370/' + index + '.jpg')
					parte = "#id_" + part;
					$(parte).val(index)
				}
			</script>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>