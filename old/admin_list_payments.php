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
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_payments"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_payments_moreinfo"];?>
		</div>
		<div id='infobox_header' class='infobox_info'>
			<table>
				<tr>
					<td colspan="2"><?php echo $s["labels_title"]; ?></td>
				</tr>
				<tr>
					<td><span class='payment_label' style='float:left;'></span></td>
					<td><?php echo $s["payment_done_label"];?></td>
				</tr>
				<tr>
					<td><span class='no_payment_label' style='float:left;'></span></td>
					<td><?php echo $s["payment_waiting_label"];?></td>
				</tr>
				<tr>
					<td><span class='details_label' style='float:left;'></span></td>
					<td><?php echo $s["view_payment_details"];?></td>
				</tr>
			</table>
		</div>
		<div style='padding-top:10px;'>
			<?php
            $r = listPayments();
			?>
			<table class='data_table'>
				<tr class='filter_options'>
					<td colspan="10">
					<div class='form_entry'>
						<input class='text' type='text' id="searchbox" value='<?php echo $s["search.."]; ?>'/>
					</div></td>
				</tr>
				<tr class='filter_options'>
					<td colspan="10"><?php echo $s["show"]; ?>
					<select id="filter_payments">
						<option value="-1"><?php echo $s["all"]; ?></option>
						<option value="1"><?php echo $s["payment_done"]; ?></option>
						<option value="0"><?php echo $s["waiting_payment"]; ?></option>
					</select></td>
				<tr class='pagination_options'>
					<td colspan="8"></td>
				</tr>
				</tr>
				<tr>
					<table class="data_table" id="paymentstable">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th class='client_small_data'><?php echo $s["table_label_order"]; ?></th>
								<th class='client_small_data'><?php echo $s["table_label_client"]; ?></th>
								<th class='client_small_data'><?php echo $s["table_label_code"]; ?></th>
								<th class='client_medium_data text_data'><?php echo $s["table_label_created_date"]; ?></th>
								<th class='client_semismall_data text_data'><?php echo $s["table_label_total_and_clothes"]; ?></th>
								<th class='client_icon_data'><?php echo $s["table_label_delete"]; ?></th>
								<th style="display:none;"></th>
							</tr>
						</thead>
						<tbody>
							<?php
while ($d = db_fetch($r)) {
$users[] = $d;
$cad = "";
$d["amount_string"] = "";
if(strlen($d["amount"])>2){
$d["amount_string"]=substr( $d["amount"], 0, strlen($d["amount"])-2 ).".".substr( $d["amount"], strlen($d["amount"])-2, strlen($d["amount"]) );
}else{
if(strlen($d["amount"])==2){
$d["amount_string"]="0.".$d["amount"];
}else{
$d["amount_string"]="0.0".$d["amount"];
}
}
							?>
							<tr id='<?php echo $d["id_payment"];?>' class='clickable' <?php echo $cad;?>>
								<td>
								<input type='checkbox' id='checkbox_<?php echo $tot;?>'/>
								</td>
								<td><a class="details_button" target='_black' href='./admin_add_payment.php?id_payment=<?php echo $d["id_payment"];?>'></a></td>
								<?php
                                if ($d["is_payed"] == 0) {
                                    echo "<td><span class='no_payment_label' style='float:left;'></span></td>";
                                } else {
                                    echo "<td><span class='payment_label' style='float:left;'></span></td>";
                                }
								?>
								<td class='code_data'><?php echo $d["id_order_final"];?></td>
								<td class='code_data'><?php echo $d["client_code"];?></td>
								<td class='code_data'><?php echo $d["payment_code"];?></td>
								<td class='text_data'><?php echo $d["created"];?></td>
								<td class='text_data'><?php echo $d["amount_string"];?>€ (<?php echo $d["num_clothes"];?>P.)</td>
								<td><a class="delete_button" href='javascript:delete_payment(<?php echo $d["id_payment"];?>)'></a></td>
								<td style="display:none;"><?php echo $d["is_payed"];?></td>
							</tr>
							<?php

                            }
							?>
						</tbody>
					</table>
				</tr>
				<tr class='general_options'>
					<td colspan='9'></td>
				</tr>
			</table>
		</div>
		<script>
            var tlistado=null;
			function delete_payment(id_payment) {
				if(confirm("<?php echo $s["alert_payment_delete"]; ?>")) {
					$.ajax({
						type : "POST",
						url : "./functions/payment_deletebd.php",
						data : {
							"id_payment" : id_payment
						},
						success : function(msg) {
							if(msg == "OK") {
								$('#' + id_payment).css('display', 'none');
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
				tlistado = $('#paymentstable').dataTable({
					"bPaginate" : true,
					"bLengthChange" : false,
					"bFilter" : true,
					"bSort" : true,
					"bInfo" : false,
					"bAutoWidth" : false,
					"sPaginationType" : "full_numbers",
					"sDom" : '<"top"p>rt<"bottom"><"clear">',
					//"aoColumnDefs" : [{"bVisible" : false,"aTargets" : [7]}],
					"oLanguage" : {
						"oPaginate" : {
							"sPrevious" : "Anterior",
							"sNext" : "Siguiente",
							"sFirst" : "Primera Página",
							"sLast" : "Última Página"
						}
					}
				});
				$("#filter_payments").change(function() {
					if($("#filter_payments").val() == "-1") {
						tlistado.fnFilter("", 9);
					} else {
						tlistado.fnFilter($("#filter_payments").val(), 9);
					}
				});
			});

		</script>
	</div>
</div>
<?php
include ("footer.php");
?>