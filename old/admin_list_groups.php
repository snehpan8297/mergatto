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
<script>
	listproducts = Array();
</script>
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
		<a href='./admin_add_client_group.php' class='btn btn-mini btn-dark pull-right'>Añadir Grupo</a>
		<div style='padding-top:10px;'>
			<?php
			$table = "client_groups";
			$client_groups =listInBD($table);
			?>
			<table class='data_table'>
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
							<th class='client_icon_data'></th>
							<th style=';text-align:left'><?php echo $s["name"]; ?></th>
							<th class='client_icon_data'><?php echo $s["table_label_delete"]; ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$contadoract=0;
						foreach ($client_groups as $client_group){
							?>
							<tr id='<?php echo $client_group["id_client_group"];?>' class='clickable'>
								<td style="padding:10px">
									<a href='./admin_add_client_group.php?id_client_group=<?php echo $client_group["id_client_group"]; ?>' class='btn btn-white btn-mini '>Editar</a>
								</td>
								<td style='padding:10px;width:100%;text-align:left'><?php echo $client_group["name"];?> (Ratio: <?php echo $client_group["base_price"];?> * <?php echo $client_group["modificator_price"];?>)</td>
								<td style="padding:10px">
									<a class='btn btn-danger btn-mini' href='javascript:delete_client_group("<?php echo $client_group["id_client_group"];?>")'>Eliminar</a>
								</td>
							</tr>
							<?php
						}
						?>
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
			function delete_client_group(id_client_group){
				if(confirm("<?php echo $s["alert_delete_client_group"]; ?>")){
					$.ajax({
						type : "POST",
						url : "./functions/client_group_deletebd.php",
						data : {
							"id_client_group" : id_client_group
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_client_group).css('display','none');
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