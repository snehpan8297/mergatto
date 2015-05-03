<?php
//lang revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
    die();
}
$page = "admin";
include ("header.php");
$orders = listOrders();
?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_orders"];?></a>
		</div>
	</div>
	<div class='contentbox'>
		<h3>
			<?php echo $s["admin_orders_moreinfo"];?>
		</h3>
		
		<div style='padding-top:10px;'>
			<div class='form_entry' style='float:right'>
				<input id="searchbox" class='text' type='text' value='<?php echo $s["search.."];?>'/>
				<?php echo $s["show"]; ?>: <select id="filter_orders">
						<option value="-1"><?php echo $s["all"]; ?></option>
						<option value="0">Nuevos</option>
						<option value="3">Procesando</option>
						<option value="1"><?php echo $s["sent"]; ?></option>
						<option value="2"><?php echo $s["rejected"]; ?></option>
				</select>
			</div>
			<table class='data_table'>
				
					<td colspan="8">
					<table id="order_list" style="width:100%;" class='data_table'>
						<thead>
							<tr>
								<th style='min-width:40px;'></th>
								<th style='min-width:90px;'></th>
								<th style='min-width:70px;'></th>
								<th style='min-width:90px;'>Pago</th>
								<th style='min-width:120px;'></th>
				<th class='client_medium_data' style='width:500px;text-align:left;'><?php echo $s["table_label_client"]; ?></th>
								<th class='client_medium_data text_data'>Fecha</th>
								<th class='client_medium_data text_data'>Total</th>
								<th class='client_icon_data'></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($d = db_fetch($orders)) {
								
								$client["id_client"]=$d["id_client"];

								$client=userData($client);
								if($client["id_elastic"]==0){
									$client["id_elastic"]="000000";
								}
								$destacado = "";
								if($d["order_state"]==0){
									if($client["id_elastic"]=="000000"){
										$destacado="background-color:#fff4d4";
									}else{
										$destacado="background-color:#d4ffff";
									}

								}else if($d["order_state"]==1){
									$destacado="background-color:#ffffff";
								}else if($d["order_state"]==2){
									$destacado="background-color:#ffd4d4";
								}else if($d["order_state"]==3){
									$destacado="background-color:#d4ffff";
								}else if($d["order_state"]==4){
									$destacado="background-color:#ffd4d4";
								}else if($d["order_state"]==8){
									$destacado="background-color:#d4d4d4";
								}
								?>
								<tr id='<?php echo $d["id_order"];?>' class='clickable' style='<?php echo $destacado; ?>'>
									<td style='padding:5px'>
									<div>
									<a href='./admin_show_details.php?id_order=<?php echo $d["id_order"];?>' class='btn btn-white btn-mini' style='padding:10px 10px'><i class='fa fa-search '></i></a>
									</div>
									<td style='text-align:left;padding:5px;'>
									<?php
									if($d["order_state"]==0){
										if($client["id_elastic"]=="000000"){
											?>
											<span style='color:orange'><i class='fa fa-certificate'></i> Nuevo</span>
											<?php	
										}else{
											?>
											<span style='color:green'><i class='fa fa-certificate'></i> Nuevo</span>
											<?php
										}
										
									}else if($d["order_state"]==1){
										?>
										<span style='color:black'><i class='fa fa-truck'></i> Enviado</span>
										<?php 
									}else if($d["order_state"]==2){
										?>										
										<span style='color:red'><i class='fa fa-times'></i> Cancelado</span>
										<?php
									}else if($d["order_state"]==3){
										?>										
										<span style='color:green'><i class='fa fa-dropbox'></i> Procesa.</span>
										<?php
									}else if($d["order_state"]==4){
										?>										
										<span style='color:red;white-space: nowrap;'><i class='fa fa-times'></i> Cancel. Usua.</span>
										<?php
									}else if($d["order_state"]==8){
										?>
										<span style='color:#333333'><i class='fa fa-clock-o'></i> Pago Pen.</span>
										<?php
									}
									?>
									</td>
									<td style='text-align:left;padding:5px;'>
									<?php
										if($d["payed"]==0){
											?>
											<span style='color:red'>
											<?php
										}else if($d["payed"]==1){
											?>
											<span style='color:green'>
											<?php
										}
										if($d["payment_method"]=="bank_transfer"){
											?>
											<i class='fa fa-money'></i> Transf.
											<?php
										}else if($d["payment_method"]=="paypal"){
											?>
											<i class='fa fa-paypal'></i><b style='border:1px solid #000;padding:0px 2px;'>P</b> PayPal
											<?php
										}else{
											?>
											<i class='fa fa-credit-card'></i> Pasarl.
											<?php
										}
									?>
											</span>
									</td>
									<td style='text-align:left;padding:5px;'>
									<?php
										if($d["payed"]==0){
											?>
											<span style='color:red'><i class='fa fa-times'></i> No Confirm.</span>
											<?php
										}else if($d["payed"]==1){
											?>
											<span style='color:green'><i class='fa fa-check'></i> Confirmado</span>
											<?php
										}
									?>
									</td>
									<td style='text-align:left;padding:5px;'>
									<?php
										if($d["exported"]==0){
											?>
									<a href='./exporter.php?order_id=<?php echo $d["id_order"];?>' target="_blank" class='btn btn-white btn-mini'><i class='fa fa-upload '></i> Exportar</a>
											<?php
										}else if($d["payed"]==1){
											?>
											<span style='color:green'><i class='fa fa-check'></i> Exportado</span>
											<?php
										}
									?>
									</td>
									<td class='code_data' style='font-size:11px;text-align:left;padding:5px;'><?php echo "<b>Pedido #".$d["id_order"]."</b><br/><b>(ID W".$d["id_client"]."-E".$client["id_elastic"].")</b> ".htmlentities($d["invoice_address_name"], ENT_QUOTES, "UTF-8")." ".htmlentities($d["invoice_address_subname"], ENT_QUOTES, "UTF-8");?>
									<?php
										if($d["user_type"]==1){
											echo " <b>Retailer</b> ";
										}
									?>
									</td>
									<td class='text_data'style='padding:5px;'><?php echo date("d/m/Y H:i",$d["date"]);?></td>
									<?php
										if($d["user_type"]==1){
											?>
											<td class='text_data' style='padding:5px;'> <?php echo number_format($d["total_with_discount"],2);?>€<br/>(<?php echo $d["num_clothes"]." Pren.";?>)</td>

											<?php
										}else{
											?>
											<td class='text_data' style='padding:5px;'><b><?php echo number_format($d["total_with_discount"],2);?>€<br/>(<?php echo $d["num_clothes"]." Pren.";?>)</td>

											<?php
										}
									?>
									<td style='padding:10px;'><a class="btn btn-danger btn-mini" href='javascript:delete_order("<?php echo $d["id_order"];?>",<?php echo $d["order_state"];?>)'>Eliminar</a></td>
									<td class='text_data'><?php echo $d["order_state"];?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table></td>
				</tr>
				<tr class='general_options'>
					<td></td>
				</tr>
			</table>
		</div>
		<script>
			function delete_order(id_order,order_state){
				if(confirm("<?php echo $s["alert_delete_order"]; ?>")){
					if(order_state!=4){
						if(confirm("<?php echo $s["alert_stock_return"]; ?>")){
						stock_return = 1;
						} else {
							stock_return = 0;
						}	
					}else{
						stock_return=0;
					}
					
					$.ajax({
						type : "POST",
						url : "./functions/order_deletebd.php",
						data : {
							"id_order" : id_order,
							"stock_return": stock_return
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_order).css('display','none');
							}
						}
					});
				}
			}
			var tlistado = null;
			function getRadioButtonSelectedValue(ctrl) {
				for( i = 0; i < ctrl.length; i++)
				if(ctrl[i].checked)
					return ctrl[i].value;
			}
			$(document).ready(function() {
			    $("#searchbox").click(function() {
					if($("#searchbox").val() == "<?php echo $s["search.."];?>")
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
					"aoColumnDefs": [ { "bVisible": false, "aTargets": [ 9 ] }],
					"oLanguage" : {
						"oPaginate" : {
							"sPrevious" : "Anterior",
							"sNext" : "Siguiente",
							"sFirst" : "Primera Página",
							"sLast" : "Última Página"
						}
					}
				});
				$("#filter_orders").change(function() {
					if($("#filter_orders").val() == "-1") {
						tlistado.fnFilter("", 9);
					} else {
						tlistado.fnFilter($("#filter_orders").val(), 9);
					}
				});
			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>