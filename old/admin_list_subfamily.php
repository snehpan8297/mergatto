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
		
		
		<div style='padding-top:10px;'>
			<?php
			$filter=array();
			$filter["id_family"]="all";
            $r = listSubfamily($filter);
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
						<th class='client_icon_data' style='width:5%;'></th>
						<th class='client_small_data ' style='width:30%;text-align:left;'>Castellano</th>
						<th class='client_medium_data ' style='width:30%;text-align:left;'>Inglés</th>
						<th class='client_medium_data ' style='width:30%;text-align:left;'>Familia</th>
						<th class=' ' style='width:5%;'></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$contadoract=0;
						$listactive=array();
						while ($d = db_fetch($r)) {

							$subfamily[] = $d;
							$cad="style='";
							if ($d["web_active"]==1) {
								$cad="display:table-row;";
								$contadoract++;
								array_push($listactive,$d["id_client"]);
							} else {
								$cad="";
							}
							$cad.="'";
							?>
							<tr id='<?php echo $d["id_subfamily"];?>' class='clickable' <?php echo $cad;?>>
								<td style='padding:5px;'>
									<a href='./admin_add_subfamily.php?id_subfamily=<?php echo $d["id_subfamily"]; ?>' class='btn btn-white btn-mini '>Editar</a></td>
								<td class='' style='padding:10px;'><?php echo $d["name_es"];?></td>
								<td class='' style='padding:10px;'><?php echo $d["name_en"];?></td>
								<td class='' style='padding:10px;'><?php echo $s["family_".$d["id_family"]];?></td>
							
								<td style='padding:10px;'><a class='btn btn-danger btn-mini' href='javascript:delete_subfamily("<?php echo $d["id_subfamily"];?>")'>Eliminar</a></td>
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
			function delete_subfamily(id_subfamily){
				if(confirm("Esta operación no podrá deshacerse")){
				
					$.ajax({
						type : "POST",
						url : "./functions/subfamily_deletebd.php",
						data : {
							"id_subfamily" : id_subfamily
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_subfamily).css('display','none');
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
				$("#listfilter").change(function() {
					var indice=$("#listfilter").val();
					if( indice == "0") {
						tlistado.fnFilter('', 5);
					} else if (indice=="1"){
						tlistado.fnFilter('1', 5);
					} else if (indice=="2"){
						tlistado.fnFilter('0', 5);
					}
				});
				tlistado.fnFilter('1', 5);
			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>