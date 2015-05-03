<?php
//Lang confirmado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
$interface_options["cart_menu_hidden"]=1;

$page = "my_orderlist";
$page_title= "historial de pedidos";
include ("header.php");
include_once("include/inbd.php");
$table="order_request";
$filter=array();
$filter["id_client"]=array("operation"=>"=","value"=>$userdata["id_client"]);
$filter["complex"]="order_state <> 2 and order_state <> 4";
$fields = array();
$table_order = "id_order desc";
$orders = listInBD($table,$filter,$fields,$table_order);
?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <a href='#' class='important'><?php echo $s["my_orders"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>

		
		<?php
		if(countInBD($table,$filter)==0){
			?>
			<div id='infobox_header' class='infobox_info'>
				<?php echo $s["no_orders_to_display"]; ?>
			</div>
			<?php
		}else{
		?>
		<div style='padding-top:10px;'>
			<table class='data_table'>
			
			
				<td colspan="8">
				<table id="order_list" style="width:100%;" class='data_table'>
					<thead>
						<tr>
							<th  style='width:100px;'><?php echo $s["table_label_order"]; ?></th>
							<th style='width:230px;'class='client_small_data'><?php echo $s["table_label_status"]; ?></th>
							<th class='client_medium_data text_data'><?php echo $s["table_label_created_date"]; ?></th>
							<th class='client_medium_data text_data'><?php echo $s["table_label_total_and_clothes"]; ?></th>
							<th style='width:180px;'></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($orders as $key=>$d){
								$cad = "";
								?>
								<tr>
									<td style='text-align:left;padding:10px;font-size:14px;color:#000;'>Id #<?php echo $d["id_order"];?></td>
									<td style='text-align:left'>
										<?php
										if($d["order_state"]==0){
					?>
										<span style='color:orange'><i class='fa fa-certificate'></i> <?php echo $s["pending"];?></span>
										<?php
									}else if($d["order_state"]==1){
										?>
										<span style='color:black'><i class='fa fa-truck'></i> <?php echo $s["sended"];?></span>
										<?php 
									}else if($d["order_state"]==2){
										?>										
										<span style='color:red'><i class='fa fa-times'></i> <?php echo $s["cancel"];?></span>
										<?php
									}else if($d["order_state"]==3){
										?>										
										<span style='color:green'><i class='fa fa-dropbox'></i> <?php echo $s["processing"];?></span>
										<?php
									}else if($d["order_state"]==8){
										?>
										<span style='color:#333333'><i class='fa fa-clock-o'></i> Pago Pendiente</span>
										<?php
									}

				?> <br/> <?php
										if($d["payed"]==0){
											?>
											<span style='color:red'>
											<?php
										}else if($d["payed"]==1){
											?>
											<span style='color:green'>
											<?php
										}
										if($d["payed"]==0){
											?>
											<span style='color:red'><?php echo $s["waiting_payment"];?></span>
											<?php
										}else if($d["payed"]==1){
											?>
											<span style='color:green'> <?php echo $s["payed"];?></span>
											<?php
										}
									?>
										
									</td>
								
									<td class='text_data'><?php echo date("d/m/Y H:i",$d["date"]);?></td>
									<td class='text_data'><?php echo $d["total"];?>€ ( <?php echo $d["num_clothes"];?> <?php echo $s["clothes"];?> )</td>
									<td style='padding:10px 0px;text-align:right;'><a class="btn btn-white btn-mini" href='./show_details.php?id_order=<?php echo $d["id_order"];?>'><?php echo $s["go_to_order"];?></a><!--<br/><br/> <a class="btn btn-dark btn-mini" href='#'><?php echo $s["return/exchange"];?></a>--></td>
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
			<div>
				<a href='./my_account.php' class='btn btn-dark'><?php echo $s["back"];?></a>
			</div>
		</div>
		<script>
			var tlistado = null;
			function getRadioButtonSelectedValue(ctrl) {
				for( i = 0; i < ctrl.length; i++)
				if(ctrl[i].checked)
					return ctrl[i].value;
			}
			$(document).ready(function() {
				
				tlistado = $('#order_list').dataTable({
					"bPaginate" : true,
					"bInfo" : false,
					"bAutoWidth" : false,
					"sPaginationType" : "full_numbers",
					"sDom" : '<"top"p>rt<"bottom"><"clear">',
					//"aoColumnDefs": [ { "bVisible": false, "aTargets": [ 7 ] }],
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
	<?php } ?>
	</div>
</div>
<?php
include ("footer.php");
?>