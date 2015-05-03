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
            $r = listUsers();
			?>
			<table class='data_table'>
			<tr class='filter_options'>
				<td colspan="8">
					<div class='form_entry'>
						<input id="searchbox" class='text' type='text' value='<?php echo $s["search.."]; ?>'/>
					</div>
				</td>
			</tr>
			<tr class='filter_options'>
				<td colspan="8"><?php echo $s["show"]; ?>
					<select id="listfilter">
						<option value="0"><?php echo $s["all"]; ?></option>
						<option value="1" selected><?php echo $s["active"]; ?></option>
						<option value="2"><?php echo $s["inactive"]; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="10">
					<table id="list_clients" class="data_table">
						<thead><tr>
						<th class='client_icon_data'></th>
						<th class='client_small_data'><?php echo $s["code"]; ?></th>
						<th class=''><?php echo $s["name"]; ?></th>
            <th class='client_medium_data text_data'>Ciudad</th>
            <th class='client_medium_data text_data'>Facturado</th>
						<th class='client_medium_data text_data'><?php echo $s["table_label_last_login"]; ?></th>
						<th class='client_icon_data'><?php echo $s["table_label_delete"]; ?></th>
						<th style="display:none;"><?php echo $s["table_label_active"]; ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$contadoract=0;
						$listactive=array();
						while ($d = db_fetch($r)) {

							$users[] = $d;
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
							<tr id='<?php echo $d["id_client"];?>' class='clickable' <?php echo $cad;?>>
								<td style='padding:10px;'><a class="details_button" href='./admin_edit_user.php?id_client=<?php echo $d["id_client"]; ?>'></a></td>
								<td class=''><?php echo $d["id_client"];?>
								<?php
									if((isset($d["id_elastic"]))&&(!empty($d["id_elastic"]))){
										?><br/>(Elastic: <?php echo $d["id_elastic"];?>)<?php
									}
								?>
								</td>
                <td class=''><b style='font-size:14px;'><?php echo $d["name"];?> <?php echo $d["subname"];?></b><br><?php echo $d["email"];?></td>
                <td class=''><?php echo "Cid:<b>".$d["city"]."</b><br/>(Prov:<b>".$d["province"]."<b>)";?></td>
								<td class='text_data'><?php
									$total=0;
									$table='order_request';
									$filter=array();
									$filter["id_client"]=array("operation"=>"=","value"=>$d["id_client"]);
									$filter["payed"]=array("operation"=>"=","value"=>1);
									$field="total_with_discount";
									$total=sumInBD($table,$filter,$field);
									if(!isset($total)){
										$total=0;
									}
									echo $total;
								?></td>
								<td class='text_data'><?php if($d["last_login"] != "0000-00-00 00:00:00") echo date("d-m-Y H:i:s",strtotime($d["last_login"]));?></td>

								<td style="display:none;" class='web_active'><?php echo $d["web_active"];?></td>
								<td><a class="delete_button" href='javascript:delete_user("<?php echo $d["id_client"];?>")'></a></td>
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
			function delete_user(id_client){
				if(confirm("<?php echo $s["alert_delete_user"]; ?>")){
					$.ajax({
						type : "POST",
						url : "./functions/user_deletebd.php",
						data : {
							"id_client" : id_client
						},
						success : function(msg) {
							if(msg == "OK"){
								$('#'+id_client).css('display','none');
							}
						}
					});
				}
			}
			var actualpage = 0;
			var itemsperpage = 20;
			var client = Array();
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
