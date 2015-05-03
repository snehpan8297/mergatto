<?php
//Lang revisado

/*
 Login ADMIN

 ------
 Decripción

 */
@session_start();
if (!(isset($_SESSION['admin']))) {
    header("location:./admin.php");
}
$page = "admin";
include ("header.php");
$tot=0;
?>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
		<div id='page_navigator'><a href='./admin_menu.php'><?php echo $s["admin_menu_title"]; ?></a> / <a href='#' class='important'><?php echo $s["admin_request"]?></a></div>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["admin_request_moreinfo"];?>
		</div>
		<div id='infobox_header' class='infobox_info'>
			<table>
				<tr>
					<td><span class='no_accept_label' style='float:left;'></span></td>
					<td><?php echo $s["client_acces_label"]; ?></td>
				</tr>
				<tr>
					<td><span class='delete_label' style='float:left;'></span></td>
					<td><?php echo $s["delete_acces_label"]; ?></td>
				</tr>
			</table>
		</div>
		<div style='padding-top:10px;'>
			<?php 
			$r = listPendingAccessRequests();
            if (db_count($r)>0) {
            ?>
			<table class='data_table'>
            		<tr>
            			<th class='client_icon_data'></th>
            			<th class='client_icon_data'><?php echo $s["request_label"]; ?></th>
            			<th class='client_small_data'><?php echo $s["costumer_label"]; ?></th>
                		<th class='client_small_data'><?php echo $s["cif_label"]; ?></th>
        				<th class='client_medium_data text_data'><?php echo $s["name_label"]; ?></th>
            			<th class='client_medium_data text_data'><?php echo $s["email_label"]; ?></th>
            			<th class='client_icon_data'><?php echo $s["delete_label"]; ?></th>
            		</tr>
                <?php
                while($d = db_fetch($r)) {
               		$tot++;
                    $users[]=$d;
                    ?>	
                    <tr id='<?php echo $d["id_client"];?>' class='clickable' <?php if($d["client_in_bd"]==0){echo "style='background-color:#ffcccc;'";}?>>
                    	<td><input type='checkbox' id='checkbox_<?php echo $tot; ?>'/></td>
                    	<td class='icon_data access_request'><a class="no_accept_button" href='javascript:verify("<?php echo $d["id_client"];?>","<?php echo $d["client_code"];?>","<?php echo $d["email"];?>",<?php echo $d["client_in_bd"];?>)'></a></td>
                    	<td class='code_data'><?php echo $d["client_code"];?></td>
                    	<td class='code_data'><?php echo $d["cif"];?></td>
                    	<td class='text_data'><?php echo $d["name"];?></td>
                    	<td class='text_data'><?php echo $d["email"];?></td>
                    	<td class='icon_data'><a class="delete_button" href='javascript:delete_client("<?php echo $d["id_client"];?>","<?php echo $d["client_code"];?>")'></a></td>
                    </tr>
                    	
                    <?php
                }
                ?>
                <tr class='general_options'>
					<td colspan='7'>
                    </td>
                </tr>
                </table>
				<?php
			} else {

			?>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["no_requests"]; ?>
				</div>
			<?php
            }
			?>
		</div>
			
		<script>
			var client = Array();

<?php
foreach ($users as $key => $value) {
    echo "client[" . $value["id_client"] . "]= new Array();";
    echo "client[" . $value["id_client"] . "]['client_code']='" . $value["client_code"] . "';";
    echo "client[" . $value["id_client"] . "]['name']='" . $value["name"] . "';";
    echo "client[" . $value["id_client"] . "]['cif']='" . $value["cif"] . "';";
    echo "client[" . $value["id_client"] . "]['email']='" . $value["email"] . "';";
    echo "client[" . $value["id_client"] . "]['id_rate']='" . $value["id_rate"] . "';";
    echo "client[" . $value["id_client"] . "]['id_currency']='" . $value["id_currency"] . "';";
    echo "client[" . $value["id_client"] . "]['client_code']='" . $value["client_code"] . "';";
    echo "var totpends=".$tot.";";

}
?>
</script>
<script>
	function verify(id_client,client_code,email,client_in_bd) {
		if(client_in_bd==1){
			if($('#'+id_client+' .access_request a').attr('class')=='no_accept_button'){
				$('#'+id_client+' .access_request a').attr('class','accept_button');
				web_active="checked";
			}
			$.ajax({
				type : "POST",
				url : "./editclientaccessbd.php",
				data : {
					"client_code" : client_code,
					"email" : email,
					"web_active" : web_active
				},
				success : function(msg) {
					if(msg == "OK"){
						$('#'+id_client+' .access_request a').attr('class','accept_button');
						$('#'+id_client).slideUp('fast');
					}
				}
			});
		}else{
			if(confirm("<?php echo $s["alert_costumer_no_bd"];?>")){
				window.location.href="./admin_add_user.php?client_code="+client_code;
			}
		}
		
	}
	function delete_client(id_client,client_code) {
		if(confirm("<?php echo $s["alert_costumer_delete"];?>")){
			$.ajax({
				type : "POST",
				url : "./deleteclientbd.php",
				data : {
					"client_code" : client_code,
				},
				success : function(msg) {
					if(msg == "OK"){
						$('#'+id_client).slideUp('fast');
					}
				}
			});
		}
		
	}
	function getRadioButtonSelectedValue(ctrl) {
		for( i = 0; i < ctrl.length; i++)
		if(ctrl[i].checked)
			return ctrl[i].value;
	}

		</script>
	</div>
</div>
<?php
include ("footer.php");
