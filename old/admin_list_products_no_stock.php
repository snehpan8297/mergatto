<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
    header("location:./admin.php");
    die();
}
$page = "admin";
include("header.php");
include_once("include/inbd.php");
?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_products"] ?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_products_moreinfo"];?>
		</div>
		<div id='infobox_header' class='infobox_info'>
			<table>
			<tr>
				<td colspan="2"><?php echo $s["labels_title"]; ?></td>
			</tr>
			<tr>
				<td><span class='visible_label' style='float:left;'></span></td>
				<td><?php echo $s["visible_product_label"]; ?></td>
			</tr>
			<tr>
				<td><span class='no_visible_label' style='float:left;'></span></td>
				<td><?php echo $s["no_visible_product_label"]; ?></td>
			</tr>
			<tr>
				<td><span class='details_label' style='float:left;'></span></td>
				<td><?php echo $s["details_product_label"]; ?></td>
			</tr>
			</table>
		</div>
		<div style='padding-top:10px;'>
			<?php $r = listProducts("all"); ?>
			<table class='data_table'>
			<tr class='filter_options'>
				<td colspan="8">
				<div class='form_entry'>
					<input class='text' type='text' id="searchbox" value='<?php echo $s["search.."]; ?>'/>
				</div></td>
			</tr>
			<tr class='filter_options'>
				<td colspan="8">
				<a href='./admin_list_products.php'>Todos</a> | <a href='./admin_list_products_stock.php'>Con Stock</a> | <a href='./admin_list_products_no_stock.php' style='color:black'>Sin Stock</a>
				</td>
			</tr>
			<tr class='filter_options'>
				<td colspan="8"><?php echo $s["show"]; ?>
				<select id="listfilter">
					<option value="-1"><?php echo $s["all"]; ?></option>
					<option value="11">En Portada</option>
					<option value="10" selected><?php echo $s["visibles"]; ?></option>
					<option value="00"><?php echo $s["no_visible"]; ?></option>
				</select></td>
			<tr class='pagination_options'>
				<td colspan="8" class="paginator"></td>
			</tr>
			<tr>
				<td>
					<table id="order_list" style="width:100%;" class='data_table'>
						<thead>
							<tr>
								<th class='client_icon_data'></th>
								<th class='client_icon_data'></th>
								<th class='client_icon_data'></th>
								<th class='client_large_data name_product_data'><?php echo $s["table_label_name"]; ?></th>
								<th class='client_small_data' style='width:200px;'><?php echo $s["table_label_code"]; ?></th>
								<th class='client_small_data'>STOCK</th>
								<th class='client_small_data'>PVP</th>
								<th class='client_small_data'>Desc.</th>
								<th class='client_small_data'>PVP Fin</th>
								<th class='client_small_data'>Fav</th>
								<th class='client_icon_data'><?php echo $s["table_label_delete"]; ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						
							<?php
							$contadoract = 0;
																$error_list="";

							while ($d = db_fetch($r)) {
								$products[] = $d;
								$cad = "";
										$table="stocks";
										$filter=array();
										$filter["id_product"]=array("operation"=>"=","value"=>$d["id_product"]);
										$stocks=listInBD($table,$filter);
										$stock_count=0;
										foreach ($stocks as $key=>$stock){
											for ($i=1;$i<=12;$i++){
												$stock_count+=$stock["stock_size_".$i];
											}
										}
								if($stock_count<=0){
									?>
									<tr id='<?php echo $d["id_product"];?>' class='clickable' <?php echo $cad;?>>
									<td>
									<a class="details_button" href='javascript:popup("./admin_edit_product_pop.php?product=<?php echo $d["id_product"];?>")'></a></td>
									<?php if($d['visible']==1) { ?>
										<td class='visible'><span class="visible_label"></span></td>
									<?php } else { ?>
										<td class='visible'><span class="no_visible_label"></span></td>
									<?php
										}
										$img_src="";
									if(file_exists("./images/images/".$d["serial_model_code"]."-1.jpg")){
										$img_src="./images/images/".$d["serial_model_code"]."-1.jpg";
									}else{
										$img_src="./img/interface/no_image.jpg";
									}
									
	
									?>
									
										<td class='image_data'><img style='width:30px;' src='<?php echo $img_src;?>'/></td>
	
									<td class='name_product_data'><?php echo $d["name_".$lang];?></td>
									<?php
										$table="product_categories";
										$filter=array();
										$filter["id_product"]=array("operation"=>"=","value"=>$d["id_product"]);
										$category=array();
										$category_str="";
										if(isInBD($table,$filter)){
											$product_categories=listInBD($table,$filter);
											$br="";
											foreach($product_categories as $key=>$product_category){
												$table="categories";
												$filter=array();
												$filter["id_category"]=array("operation"=>"=","value"=>$product_category["id_category"]);
												$category=getInBD($table,$filter);
												
												$category_str.=$br.$category["name_es"];
												$br=" | ";
											}
											
											
										}else{
											$category["name_es"] = "Sin Categoría";
										}
									?>
									<td class='code_data'>code:<?php echo $d["serial_model_code"];?> <br/>(<?php echo $category_str;?>)</td>
									<td class='code_data'>
										<?php echo "stock:".$stock_count; ?>
									</td>
									<td class='code_data'><?php echo $d["pvp"];?></td>
									<td class='code_data'><?php echo $d["discount"]."%";?></td>
									<td class='code_data'><?php echo round($d["pvp"]-($d["pvp"]*$d["discount"]/100)).".00";?></td>
									<td class='code_data'>
									<?php
										$table='client_favorites';
										$filter=array();
										$filter["id_product"]=array("operation"=>"=","value"=>$d["id_product"]);
										echo countInBD($table,$filter);
									?>
									<td class='icon_data'><a class="delete_button" href='javascript:delete_product(<?php echo $d["id_product"];?>)'></a></td>
									<td style='display:none'><?php echo $d["visible"].$d['cover']; ?></td>
								</tr>
									<?php
								}
							} ?>
						</tbody>
					</table>
				</td>
			</tr>
			
			<tr class='general_options'>
				<td colspan='1'></td>
			</tr>
			</table>
		</div>
<script>
function popup(URL) {
				iz = (screen.width - 600) / 2;
				ar = (screen.height - 550) / 8;
				altura = 650;
				window.open(URL, 'ventana1', 'width=800,height=' + altura + ',top=' + ar + ',left=' + iz + ',scrollbars=YES')
			}
</script>

		<script>
			function delete_product(id_product) {
				if(confirm("<?php echo $s["alert_product_delete"]; ?>")) {
					$.ajax({
						type : "POST",
						url : "./functions/deleteproductbd.php",
						data : {
							"id_product" : id_product,
						},
						success : function(msg) {
							if(msg == "OK") {
								$('#' + id_product).slideUp('fast');
							}
						}
					});
				}
			}
			$.fn.dataTableExt.oApi.fnGetFilteredNodes = function(oSettings) {
				var anRows = [];
				for(var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
					var nRow = oSettings.aoData[oSettings.aiDisplay[i]].nTr;
					anRows.push(nRow);
				}
				return anRows;
			};
			var tlistado = null;
			function getRadioButtonSelectedValue(ctrl) {
				for( i = 0; i < ctrl.length; i++) {
					if(ctrl[i].checked) {
						return ctrl[i].value;
					}
				}
			}
			$(document).ready(function() {

				$("#cancel").click(function() {
					closeedit();
				});
				$("#searchbox").click(function() {
					if($("#searchbox").val() == "<?php echo $s["search"]; ?>")
						$("#searchbox").val("");
				})
				$("#searchbox").keyup(function() {
					tlistado.fnFilter($("#searchbox").val());
				})
				tlistado = $('#order_list').dataTable({
					"bPaginate" : true,
					"bLengthChange" : false,
					"bFilter" : true,
					"iDisplayLength": 20,
					"bSort" : true,
					"bInfo" : false,
					"bAutoWidth" : false,
					"sPaginationType" : "full_numbers",
					"sDom" : '<"top"p>rt<"bottom"><"clear">',
					"aoColumnDefs": [ { "bVisible": false, "aTargets": [ 10 ] }],
					"oLanguage" : {
						"oPaginate" : {
							"sPrevious" : "Anterior",
							"sNext" : "Siguiente",
							"sFirst" : "Primera Página",
							"sLast" : "Última Página"
						}
					}
				});
				$("#listfilter").change(function() {
					if($("#listfilter").val() == "-1") {
						tlistado.fnFilter("", 11);
					} else {
						tlistado.fnFilter($("#listfilter").val(), 11);
					}
				});
				tlistado.fnFilter(1, 11);
			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>