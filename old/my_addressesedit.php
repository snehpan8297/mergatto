<?php 
//Lang confirmado
$interface_options["cart_menu_hidden"]=1;
$page="my_editinfo";
include("header.php");

$addresses = listAddresses($userdata);
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./my_account.php'><?php echo $s["my_account"]; ?></a> / <span class='important'><?php echo $s["my_addresses_info"]; ?></span>
		</div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["my_addresses_info_moreinfo"];?>
		</div>
		<div class='main_option'>
			<div class='likeabutton'>
				<a href='./my_addressedit.php'><span class='text'>
					<span class='left_decoration'></span><?php echo $s["add_new_address"];?>
					<span class='right_decoration'></span>
				</span></a>
			</div>
		</div>
		<table id="order_list" style="width:100%;" class='data_table'>
		<thead>
			<tr>
				<th style='text-align:left; width:100%;padding-left:10px;'><?php echo $s["table_address"]; ?></th>
				<th class=''></th>
				<th class=''></th>
			</tr>
		</thead>
		<tbody>
			<?php while($a = db_fetch($addresses)) { ?>
				<tr id='address_<?php echo $a["id_address"]; ?>'>
					<td style='padding:5px 0px;'>
						<B><?php echo $a["name"]." ".$a["subname"]; ?></B> <?php echo $a["address_1"]; ?> <?php echo $a["address_2"]; ?><br/>
						<?php echo $a["post_code"]; ?> - <?php echo $a["city"];
						if(isset($provinces[$a["province"]]["name"]) && $countries[$a["country"]]["name"] == "España") {
							echo " - ".$provinces[$a["province"]]["name"];
						} elseif(!is_numeric($a["province"])) {
							echo " - ".$a["province"];
						} ?>
						
					</td>
					<td> <a class='btn btn-white btn-mini' href='javascript:delete_address(<?php echo $a["id_address"]; ?>)'><?php echo $s["delete"];?></a></td>
					<td><a class='btn btn-white btn-mini' href='./my_addressedit.php?id=<?php echo $a["id_address"]; ?>'><?php echo $s["edit"];?></a></td>
				</tr>
			<?php } ?>
		</tbody>
		</table>
	</div>
</div>
<script>
	function delete_address(id_address) {
		$.ajax({
			type: "POST",
			url: './functions/deleteaddressbd.php',
			data: { 'id_address': id_address },
			success: function(msg) {
				if(msg=="OK") {
					$('#address_'+id_address).css('display','none');
				}
			}
		});
	}
</script>
<?php
include("footer.php");
?>