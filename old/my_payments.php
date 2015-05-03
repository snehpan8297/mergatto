<?php
//Lang confirmado
/*
 Login ADMIN

 ------
 Decripción

 */
@session_start();

$page = "admin";
include ("header.php");
?>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <a href='#' class='important'><?php echo $s["my_payments"]?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["my_payments_moreinfo"];?>
		</div>
		<div id='infobox_header' class='infobox_info'>
			<table>
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
					<td><?php echo $s["go_payment_process"];?></td>
				</tr>
			</table>
			</table>
		</div>
		<div style='padding-top:10px;'>
			<?php
            $r = listMyPayments($userdata["client_code"]);
            
            ?>
            <table class='data_table'>
             	<tr class='filter_options'>
            		<td colspan="10">
            			<div class='form_entry'>
	            			<input class='text' type='text' value='Buscar...'/>        				
            			</div>
            		</td>
            	</tr>
            	<tr class='filter_options'>
					<td colspan="10"><?php echo $s["show"]; ?>
            			<select>
            				<option value="-1"><?php echo $s["all"]; ?></option>
							<option value="1"><?php echo $s["payment_done"]; ?></option>
							<option value="0"><?php echo $s["waiting_payment"]; ?></option>
            			</select>
            			
            		</td>
            		<tr class='pagination_options'>
                    <td colspan="8">
                    </td>
                </tr>
            	</tr>
				<tr>
            		<th></th>
            		<th></th>
            		<th></th>
					<th class='client_small_data'><?php echo $s["table_label_order"]; ?></th>
					<th class='client_small_data'><?php echo $s["table_label_code"]; ?></th>
					<th class='client_medium_data text_data'><?php echo $s["table_label_created_date"]; ?></th>
					<th class='client_semismall_data text_data'><?php echo $s["table_label_total_and_clothes"]; ?></th>
            	</tr>
            	<span id='datoslista'>
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
                <tr id='<?php echo $d["id_payment"];?>' class='clickable' <?php echo $cad; ?>>
                	<td><input type='checkbox' id='checkbox_<?php echo $tot; ?>'/></td>
					<?php
                		if($d["is_payed"]==0){
                			?>
                			<td><a class="card_button" href='./payments.php?client_code=<?php echo $d['client_code']; ?>&order=<?php echo $d["id_order_final"]; ?>&code=<?php echo $d["payment_code"]; ?>'></a></td>
							<td><span class='no_payment_label' style='float:left;'></span></td>
                			<?php
                		}else{
                		?>
							<td><span class='no_card_button'></span></td>
							<td><span class='payment_label' style='float:left;'></span></td>
                			<?php
                		}
                	?>
                    <td class='code_data'><?php echo $d["id_order_final"];?></td>
                    <td class='code_data'><?php echo $d["payment_code"];?></td>
                    <td class='text_data'><?php echo $d["created"];?></td>
                    <td class='text_data'><?php echo $d["amount_string"];?> € (<?php echo $d["num_clothes"]." ".$s["clothes"];?> )</td>
                </tr>
                <?php
               
            }
            ?>
           		</span>
   			</table>
		</div>
		<script>
			var client = Array();

<?php
foreach ($users as $key => $value) {
    echo "client[" . $value["id_client"] . "]= new Array();";
    echo "client[" . $value["id_client"] . "]['client_code']='" . $value["client_code"] . "';";
    echo "client[" . $value["id_client"] . "]['name']='" . addslashes($value["name"]) . "';";
    echo "client[" . $value["id_client"] . "]['cif']='" . $value["cif"] . "';";
    echo "client[" . $value["id_client"] . "]['email']='" . addslashes($value["email"]) . "';";
    echo "client[" . $value["id_client"] . "]['id_rate']='" . $value["id_rate"] . "';";
    echo "client[" . $value["id_client"] . "]['id_currency']='" . $value["id_currency"] . "';";
    echo "client[" . $value["id_client"] . "]['client_code']='" . $value["client_code"] . "';\n";

}
?></script>
		<script>
    function getRadioButtonSelectedValue(ctrl) {
        for( i = 0; i < ctrl.length; i++)
        if(ctrl[i].checked)
            return ctrl[i].value;
    }

    function edituser(index) {
        $("#user_data").css("display", "block");
        $("#username").val(client[index]['name']);
        $("#client_code").val(client[index]['client_code']);
        $("#cif").val(client[index]['cif']);
        $("#id_client").val(index);
        $("#email").val(client[index]['email']);
        $("#currency").val(client[index]['id_currency']);
        document.userdataform.id_rate[client[index]['id_rate']].checked = true;
    }
    function closeedit() {
        $("#user_data").css("display", "none");
    }
			$(document).ready(function() {
				$("#activos").click(function() {
				    closeedit();
					$(".listrow").each(function() {
						var id = $(this).attr("id");
						var wa = "#" + id + " .web_active";
						var ar = "#" + id + " .access_request";
						var vwa = $(wa).html();
						var arv = $(ar).html();

						if((vwa == "1") && (arv == "0"))
							$(this).css("display", "table-row");
						else
							$(this).css("display", "none");
					});
				});
				$("#pendientes").click(function() {
				    closeedit();
					$(".listrow").each(function() {
						var id = $(this).attr("id");
						var wa = "#" + id + " .web_active";
						var ar = "#" + id + " .access_request";
						var vwa = $(wa).html();
						var arv = $(ar).html();

						if((vwa == "0") && (arv == "1"))
							$(this).css("display", "table-row");
						else
							$(this).css("display", "none");
					});
				});
				$("#rechazados").click(function() {
				    closeedit();
					$(".listrow").each(function() {
						var id = $(this).attr("id");
						var wa = "#" + id + " .web_active";
						var ar = "#" + id + " .access_request";
						var vwa = $(wa).html();
						var arv = $(ar).html();

						if((vwa == "0") && (arv == "0"))
							$(this).css("display", "table-row");
						else
							$(this).css("display", "none");
					});
				});
				$("#todos").click(function() {
					$(".listrow").each(function() {
					    closeedit();
						$(this).css("display", "table-row");
					});
				});
				$("#cancel").click(function () {
				   closeedit(); 
				});
			});

		</script>
	</div>
</div>
<?php
include ("footer.php");
?>