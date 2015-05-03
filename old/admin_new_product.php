<?php
//Lang Revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
include ("./include/bdOC.php");
unset($_SESSION['cart_classics']);
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}
include_once("./include/products.php");

$page = "admin_product_validate";
include ("header.php");

$p = array();
$p['name_colors'] = "";
$p['id_colors'] = "";
$p['wash'] = "";
$p['bleach'] = "";
$p['ironing'] = "";
$p['dry_wash'] = "";
$p['drying'] = "";
$p["sizes"] = "";
$p["season_winter"] = 0;
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='./admin_list_products.php'><?php echo $s["admin_products"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_new_product"]; ?></a>
		</div>
	</div>
	<div id='product'>
		<div class='information'>
			<div class='form_entry'>
				<?php echo $s["reference"];?> : <input type='text' class='text' name='serial_model_code' id='serial_model_code' style='width:430px;'/>
			</div>
			<div class='form_entry'>
				Referencia Web : <input type='text' class='text' name='web_serial_model_code' id='web_serial_model_code' style='width:430px;'/>
			</div>
			<div class='form_entry'>
				<?php echo $s["family"]; ?>
				<select id='id_family' name='id_family'>
				<?php
					$families = allFamilies();
					while($f = db_fetch($families)) {
						echo "<option value='".$f["id_family"]."'>".$s["family_".$f["id_family"]]."</option>";
					}
				?> 
				</select>
			</div>
			<div class='form_entry'>
				<?php echo $s["sizing"]; ?>
				<select name='id_sizing' id='id_sizing'>
					<?php
					$sizes = allSizes();
					while($si = db_fetch($sizes)) {
						echo "<option value='".$si["id_sizing"]."'>";
						$coma="";
						foreach ($si as $key=>$value){
							if($key!="id_sizing"){
								if($value!=""){
								echo $coma.$value;
								$coma=",";
								}
							}
						}
						echo "</option>";
					}
					?>
				</select>
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s["product_name"];?> <?php echo $s["spanish"];?><span class='form_isrequired'>*</span></td>
					<td><input style='width:310px;' name="name_es" id="name_es" class='text' type='text' value=''/></td>
				</tr>
				<tr>
					<td><?php echo $s["product_name"];?> <?php echo $s["english"];?><span class='form_isrequired'>*</span></td>
					<td><input style='width:310px;' name="name_en" id="name_en" class='text' type='text' value=''/></td>
				</tr>
				</table>
				<span id="name_alert" class='form_entry_alert'></span>
			</div>
			<div class='form_entry'>
				<span class='label'><?php echo $s["season"];?>
					<select name="season_winter" id="season_winter" class='select'>
						<option value='0' <?php if($p["season_winter"]==0){echo "selected='selected'";}?>><?php echo $season_winter[0]; ?></option>
						<option value='1' <?php if($p["season_winter"]==1){echo "selected='selected'";}?>><?php echo $season_winter[1]; ?></option>
					</select>
					<?php echo $s["year"]; ?> <input name='season_year' id='season_year' class='text' style='width:30px;text-align:right;' value=''/>
				</span>
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s["price"];?></td>
					<td colspan='2'><input style='width:370px;' class='text' type="text" name="pvp" id="pvp" value=""/> &euro;</td>
				</tr>
				<tr>
					<td><input type='checkbox' name='use_discount' id='use_discount' /> <?php echo $s["use_discount"];?></td>
					<td><input style='width:100px;' class='text' type="text" name="discount" id="discount" value=""/> %</td>
					<td style='text-align:right'><?php echo $s["price"];?> <span id='price_with_discount'></span> &euro;</td>
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
								price_with_discount = Math.round(1-parseFloat($('#discount').attr('value'))/100)*parseFloat($('#pvp').attr('value'));
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
								price_with_discount = Math.round(1-parseFloat($('#discount').attr('value'))/100)*parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}else{
								price_with_discount = parseFloat($('#pvp').attr('value'));
								$('#price_with_discount').html(price_with_discount);
							}
						});
					});
				</script>
			</div>
			<div class='add_to_cart'>
				<div class='likeabutton'>
					<a href="javascript:save_and_next();"><span class='text'><?php echo $s["next"];?></span></a>
				</div>
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s['description'];?> <?php echo $s["spanish"];?></td>
					<td><input style='width:360px;' type="text" class="text"  name='descripcion' id='descripcion' value="" /></td>
				</tr>
				<tr>
					<td><?php echo $s['description'];?> <?php echo $s["english"];?></td>
					<td><input style='width:360px;' name="description_en" id="description_en" class='text' type='text' value=''/></td>
				</tr>
				</table>
			</div>
			<div class='form_entry'>
				<table>
				<tr>
					<td><?php echo $s["composition"];?> <?php echo $s["spanish"];?></td>
					<td><input style='width:353px;' type="text" class="text" name='composition' id='composition' value=""/></td>
				</tr>
				<tr>
					<td><?php echo $s["composition"];?> <?php echo $s["english"];?></td>
					<td><input style='width:353px;' name="composition_en" id="composition_en" class='text' type='text' value=''/></td>
				</tr>
				</table>
			</div>
			<div class='form_entry' style='overflow:auto'>
				<div style='float:left;text-align:center; margin:0px 10px 0px 0px;'>
					<span class='label'><?php echo $s["washing"];?></span>
					<input type="text" class="text" name='wash' id='id_wash' value="" style='width:20px;'>
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
					<input type="text" class="text" name='bleach' id='id_bleach' value="" style='width:20px;'>
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
					<input type="text" class="text" name='iron' id='id_iron' value="" style='width:20px;'>
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
					<input type="text" class="text" name='dry_clean' id='id_dry_wash' value="" style='width:20px;'>
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
					<input type="text" class="text" name='dry' id='id_dry' value="" style='width:20px;'>
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
					<a href="javascript:save_and_next();"><span class='text'><?php echo $s["next"];?></span></a>
				</div>
			</div>
			<div id="imageselector" class='zoom_window' style='display:none;'>
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'>
				</div>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:800px; height:650px; margin-left:-400px;z-index:910;'>
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
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'>
				</div>
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
					$("body").mouseup(function(){ 
						if(! mouse_is_inside) $('.zoom_window').css('display','none');
					});
				});
			</script>
			<script>
				function next() {
					window.location="./admin_edit_product.php?action=next";
				}
				function previous() {
					window.location="./admin_edit_product.php?action=previous";
				}
				function save_and_next() {
					var cad = "";
					var coma = "";
					var tot = 0;
					use_discount=0;
					if($('#use_discount').is(":checked")){
						use_discount=1;
					}
					$.ajax({
						type : "POST",
						url : "./newproductbd.php",
						data : {
							"serial_model_code" :  $("#serial_model_code").val(),
							"web_serial_model_code" :  $("#web_serial_model_code").val(),
							"id_family" : $("#id_family").val(),
							"id_sizing" : $("#id_sizing").val(),
							"name_es" : $("#name_es").val(),
							"name_en" : $("#name_en").val(),
							"season_winter" : $("#season_winter").val(),
							"season_year" : $("#season_year").val(),
							"pvp" : $("#pvp").val(),
							"use_discount" : use_discount,
							"discount" : $("#discount").val(),
							"description_es" : $("#descripcion").val(),
							"description_en" : $("#description_en").val(),
							"composition_es" : $("#composition").val(),
							"composition_en" : $("#composition_en").val(),
							"id_dry" : $("#id_dry").val(),
							"id_wash" : $("#id_wash").val(),
							"id_bleach" : $("#id_bleach").val(),
							"id_iron" : $("#id_iron").val(),
							"id_dry_wash" : $("#id_dry_wash").val()
						},
						success : function(msg) {
							var salida=msg.split("||");
							if (salida[0]=="OK"){
								window.location="./admin_edit_product_pop.php?product="+salida[1];
							}
						}
					});
                }
				function chooseimg(position,id_color) {
					$("#iframein").attr("src", "");
					if(position=="material"){
						$("#iframein_material").attr("src", "addimagematerial.php?id_color="+id_color);
						$("#materialselector").css("display", "block");
					}else{
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
<?php
include ("footer.php");
?>