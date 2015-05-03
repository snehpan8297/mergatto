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
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_ship_methods"]
			?></a>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_ship_method_moreinfo"];?>
		</div>
		<div id='infobox_header' class='infobox_info'>
			<table>
				<tr>
					<td colspan="2"><?php echo $s["labels_title"]; ?></td>
				</tr>
				<tr>
					<td><span class='details_label' style='float:left;'></span></td>
					<td><?php echo $s["ship_method_details_label"]; ?></td>
				</tr>
			</table>
		</div>
		<div style='padding-top:10px;'>
			<?php
            $r = getShipping(0,$lang);
			?>
			<table class='data_table'>
				<tr><td colspan="10">
				<table id="list_clients" class="data_table">
				    <thead><tr>
						<th class='client_icon_data'></th>
						<th class='client_medium_data'><?php echo $s["ship_method_name"]; ?></th>
						<th class='client_large_data text_data'><?php echo $s["ship_method_descrip"]; ?></th>
						<th class='client_small_data text_data'><?php echo $s["ship_method_price"]; ?></th>
						<th class='client_icon_data'><?php echo $s["table_label_delete"]; ?></th>
					</tr>
					</thead>
				<tbody>
				<?php
					if($r) {
						while ($d = db_fetch($r)) {
						?>
						<tr id='<?php echo $d["id"];?>' class='clickable'>
							<td><a class="details_button" href='./admin_add_ship.php?id_ship=<?php echo $d["id"]; ?>'></a></td>
							<td class='code_data'><?php echo $d["name_es"];?></td>
							<td class='text_data'><?php echo $d["descrip_es"];?></td>
							<td class='text_data'><?php echo $d["price_es"];?></td>
							<td><a class="delete_button" href='javascript:delete_ship("<?php echo $d["id"];?>")'></a></td>
						</tr> <?php
						}
                    }
					?>
					</tbody></table></td></tr>
				<tr class='general_options'>
					<td></td>
				</tr>
			</table>
		</div>

		<script>
			function delete_ship(id){
				if(confirm("Este método se borrará del sistema.\n\n¿Está seguro que desea de continuar?")){
					$.ajax({
						type : "POST",
						url : "./functions/ship_deletebd.php",
						data : {
							"id_ship" : id
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id).css('display','none');
							}
						}
					});
				}
			}
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>