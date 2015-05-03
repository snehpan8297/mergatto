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
            $r = listPromoCodes();
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
						<th class='client_medium_data ' style='width:10%;text-align:left;'>Código</th>
            <th class='client_medium_data ' style='width:10%;text-align:left;'>Fecha</th>
						<th class='client_medium_data ' style='width:30%;text-align:left;'>Comentario</th>
						<th class='client_medium_data ' style='width:10%;text-align:left;'>Códigos por usar</th>
            <th class='client_medium_data ' style='width:10%;text-align:left;'>Descuento</th>
						<th class=' ' style='width:5%;'></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$contadoract=0;
						$listactive=array();
						while ($d = db_fetch($r)) {

						?>
							<tr id='<?php echo $d["id_promo_code"];?>'>
								<td style='padding:5px;'>
									<a href='./admin_add_promo_code.php?id_promo_code=<?php echo $d["id_promo_code"]; ?>' class='btn btn-white btn-mini '>Editar</a></td>
								<td class='' style='padding:10px;'><?php echo $d["code"];?></td>
                <td class='' style='padding:10px;'><?php echo date("Y-m-d",$d["creation"]);?></td>
								<td class='' style='padding:10px;'><?php echo $d["comment"];?></td>
								<td class='' style='padding:10px;'><?php echo $d["codes_left"];?></td>
                <td class='' style='padding:10px;'><?php echo $d["amount"];?>€</td>

								<td style='padding:10px;'><a class='btn btn-danger btn-mini' href='javascript:delete_subfamily("<?php echo $d["id_promo_code"];?>")'>Eliminar</a></td>
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
			function delete_subfamily(id_promo_code){
				if(confirm("Esta operación no podrá deshacerse")){
					$.ajax({
						type : "POST",
						url : "./functions/promocode_deletebd.php",
						data : {
							"id_promo_code" : id_promo_code
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_promo_code).css('display','none');
							}
						}
					});
				}
			}
			var actualpage = 0;
			var itemsperpage = 20;
			var contadorlist = <?php echo $contadoract;?>;
			var totpagesfloat = (contadorlist / itemsperpage);
			var totpages = Math.ceil(totpagesfloat);
			var actpage = 1;
			function getRadioButtonSelectedValue(ctrl) {
				for( i = 0; i < ctrl.length; i++)
					if(ctrl[i].checked)
						return ctrl[i].value;
			}
			var tlistado = null;
			function getRadioButtonSelectedValue(ctrl) {
				for( i = 0; i < ctrl.length; i++)
				if(ctrl[i].checked)
					return ctrl[i].value;
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

					tlistado.fnFilter('1', 5);
				});
			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>
