<?php
//Lang confirmado
$interface_options["cart_menu_hidden"]=1;

@session_start();
$page_title="mi cuenta";
$page = "my_account";
if(!isset($_SESSION['user_classics'])) {
	header("location: login.php");
	die();
}
include("header.php");
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='#' class='important'><?php echo $s["my_account"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div id='infobox_header' class='infobox_info'><?php echo $s["my_account_moreinfo"]; ?></div>
		<div>
		
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["my_orders"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./my_orderlist.php'><?php echo $s["my_orderslist"]; ?>
				<?php
				if($num_waiting_orders>0){
					echo " ( ".$num_waiting_orders." ".$s["orders_to_validate"]." ) ";
				}
				?>
				</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["my_user_data"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./my_accessedit.php'><?php echo $s["my_access_info"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./my_personaledit.php'><?php echo $s["my_personal_info"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./my_addressesedit.php'><?php echo $s["my_addresses_info"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./change_password.php'><?php echo $s["change_password"]; ?></a></span>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>