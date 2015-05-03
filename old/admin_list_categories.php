<?php
//Lang revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}
$page = "admin";
include ("header.php");
include_once("include/inbd.php");


?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_users"] ?></a>
		</div>
	</div>
	<div class='contentbox'>
		
		
		<div style='padding-top:10px;'>
			<?php
			$table='categories';
			$filter=array();
			$fields=array();
			$table_order = "position asc";
            $categories = listInBD($table,$filter,$fields,$table_order);
			?>
			<table class='data_table'>
			<a href='./admin_add_category.php' class='pull-right btn btn-mini btn-dark'>Añadir Categoría</a>
			<tr class='filter_options'>
				<td colspan="8">
					<div class='form_entry'>
						<input id="searchbox" class='text' type='text' value='<?php echo $s["search.."]; ?>'/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="10">
					<table id="list_clients" class="data_table">
						<thead>
						<tr>
						<th class='client_icon_data' style='width:5%;'></th>
						<th class='client_small_data ' style='width:30%;text-align:left;'>Castellano</th>
						<th class='client_medium_data ' style='width:30%;text-align:left;'>Inglés</th>
						<th class='client_medium_data ' style='width:10%;text-align:left;'>Posición</th>
						<th class='client_medium_data ' style='width:20%;text-align:left;'>Grupo</th>
						<th class=' ' style='width:5%;'></th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						foreach ($categories as $key=>$category){
							?>
							<tr id='<?php echo $category["id_category"];?>' class='clickable'>
								<td style='padding:5px;'>
									<a href='./admin_add_category.php?id_category=<?php echo $category["id_category"]; ?>' class='btn btn-white btn-mini '>Editar</a></td>
								<td class='' style='padding:10px;'><?php echo $category["name_es"];?></td>
								<td class='' style='padding:10px;'><?php echo $category["name_en"];?></td>
								<td class='' style='padding:10px;'><?php echo $category["position"];?></td>
								
								<?php
									$table="client_groups";
									$filter=array();
									$filter["id_client_group"]=array("operation"=>"=","value"=>$category["id_client_group"]);
									if(isInBD($table,$filter)){
										$client_group=getInBD($table,$filter);
									}else{
										$client_group=array();
										$client_group["name"] = "todos";
									}
								?>
								<td class='' style='padding:10px;'><?php echo $client_group["name"];?></td>
							
								<td style='padding:10px;'><a class='btn btn-danger btn-mini' href='javascript:delete_subfamily("<?php echo $category["id_category"];?>")'>Eliminar</a></td>
							</tr>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<tr class='general_options'>
				<td></td>
			</tr>
			</table>
		</div>
		<script>
			function delete_subfamily(id_category){
				if(confirm("Esta operación no podrá deshacerse")){
				
					$.ajax({
						type : "POST",
						url : "./functions/category_deletebd.php",
						data : {
							"id_category" : id_category
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_category).css('display','none');
							}
						}
					});
				}
			}
			$(document).ready(function() {
				$("#searchbox").click(function() {
					if($("#searchbox").val() == "<?php echo $s["search.."]; ?>")
						$("#searchbox").val("");
				})
				$("#searchbox").keyup(function() {
					tlistado.fnFilter($("#searchbox").val());
				})
				tlistado = $('#list_clients').dataTable({
					"bPaginate" : true,
					"iDisplayLength": 20,
					"bLengthChange" : false,
					"bFilter" : true,
					"bSort" : true,
					"bInfo" : false,
					"bAutoWidth" : false,
					"sPaginationType" : "full_numbers",
					"sDom" : '<"top"p>rt<"bottom"><"clear">',
					"oLanguage" : {
						"oPaginate" : {
							"sPrevious" : "Anterior",
							"sNext" : "Siguiente",
							"sFirst" : "Primera Página",
							"sLast" : "Última Página"
						}
					}
				});
				
			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>