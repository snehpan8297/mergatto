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
	<div class='contentbox'>
		<div style='padding-top:10px;'>
			<?php
			$table='returns';
			$filter=array();
			$fields=array();
			$table_order="created desc";
            $returns = listInBD($table,$filter,$fields,$table_order);
			?>
			<table class='data_table'>
			<a href='./admin_new_return.php' class='pull-right btn btn-mini btn-dark'>Añadir Devolución</a>
			<tr class='filter_options'>
				<td colspan="8">
					<div class='form_entry'>
						<input id="searchbox" class='text' type='text' value='<?php echo $s["search.."]; ?>'/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="10">
					<table id="list_clients" class="data_table" style=''>
						<thead>
						<tr>
						<th class=' ' style='width:50px;'></th>
						<th class=' ' style='width:50px;'></th>
						<th class=' ' style='width:50px;'></th>
						<th class=' ' style='width:50px;text-align:left;padding-left:10px;'>Código</th>
						<th class=' ' style='width:120px;text-align:left;padding-left:10px;'>Fecha</th>
						<th class=' ' style='width:100%;text-align:left;padding-left:10px;'>Datos</th>
						<th class=' ' style='width:50px;'></th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						foreach ($returns as $key=>$return){
							$row_background="";
							if($return["status"]==1){
								$row_background="background-color:#fffff4";
								$return["status_str"]="<span style='color:orange;white-space: nowrap;'><i class='fa fa-certificate'></i> Nueva</span>";
							}else if($return["status"]==2){
								$row_background="background-color:#f4ffff";
								$return["status_str"]="<span style='color:blue;white-space: nowrap;'><i class='fa fa-truck'></i> Recogiendo</span>";
							}else if($return["status"]==3){
								$row_background="background-color:#fff4ff";
								$return["status_str"]="<span style='color:purple;white-space: nowrap;'><i class='fa fa-dropbox'></i> Verificada</span>";
							}else if($return["status"]==4){
								$row_background="background-color:#ffffff";
								$return["status_str"]="<span style='white-space: nowrap;'><i class='fa fa-check'></i> Finalizada</span>";
							}else if($return["status"]==5){
								$row_background="background-color:#ffffff";
								$return["status_str"]="<span style='color:red;white-space: nowrap;'><i class='fa fa-times'></i> Cancelada</span>";
							}
							
							?>
							<tr id='<?php echo $return["id_return"];?>' style='<?php echo $row_background;?>'class='clickable'>
								<td style='padding:5px;'>
									<a href='./admin_show_return.php?id_return=<?php echo $return["id_return"]; ?>' class='btn btn-white btn-mini '>Ver</a>
								</td>
								<td class='' style='padding:10px;'><?php echo $return["status_str"];?></td>
								<td class='' style='padding:10px;'><span style='white-space: nowrap;'>#<?php echo $return["id_return"];?></span></td>
								<td class='' style='padding:10px;'><span style='white-space: nowrap;'><b><?php echo strtoupper(dechex($return["created"]));?></b></span></td>
								<td class='' style='padding:10px;'><span style='white-space: nowrap;'><?php echo date("d/m/Y H:i",$return["created"]);?></span></td>
								<td class='' style='padding:10px;'>
									Pedido: <b>#<?php echo $return["id_order"];?></b><br/>
									<?php
								$table='clients';
								$filter=array();
								$filter["id_client"]=array("operation"=>"=","value"=>$return["id_client"]);
								$client=getInBD($table,$filter);
							?>
									Usuario: <b>( W<?php echo $return["id_client"];?>-E<?php echo $client["id_elastic"];?> ) <br/><?php echo $return["invoice_address_name"];?></b><br/>
									Método de Devolución: <b><?php echo $s[$return["return_method"]];?></b><br/>
									Cantidad: <b><?php echo $return["total"];?> € ( <?php echo $return["num_clothes"];?> Prend. )</b>
								</td>
								<td style='padding:10px;'><a class='btn btn-danger btn-mini' href='javascript:delete_return("<?php echo $return["id_return"];?>")'>Eliminar</a></td>
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
			function delete_return(id_return){
				if(confirm("Esta operación no podrá deshacerse")){
				
					$.ajax({
						type : "POST",
						url : "./functions/return_deletebd.php",
						data : {
							"id_return" : id_return
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_return).css('display','none');
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