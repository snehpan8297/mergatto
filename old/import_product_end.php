<?php
@session_start();
unset($_SESSION["precarga"]);
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$page = "admin_product_validate";
include ("header.php");
$msgs = $_SESSION["import_msgs_classics"];
?>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php' class='important'><?php echo $s["admin_menu_title"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_product_import_title"] . " - ".$s["import_finished"];?></a>
		</div>
	</div>
	<div id='product'>
		<?php echo $s["import_season_end"];?>
	</div>
	<div id='product'>
		<?php 
		echo "<p><b>".$s["import_msg_error"]."</b></p>";
		$cont = 0;
		foreach($msgs[0] as $er) {
			$cont++;
			echo $er[0]." ".$er[1]."<br/>";
		}
		if($cont == 0) {
			echo $s["import_no_msgs"];
		}
		?>
	</div>
	<div id='product'>
		<?php 
		echo "<p><b>".$s["import_msg_exist"]."</b></p>";
		$cont = 0;
		foreach($msgs[1] as $ex) {
			$cont++;
			echo $ex."<br/>";
		}
		if($cont == 0) {
			echo $s["import_no_msgs"];
		}
		?>
	</div>
	<div id='exitButton' style='margin-top: 50px;'>
		<div class='likeabutton'>
			<a id="next" href="admin_list_products.php"><span class='text'><?php echo $s["exit"];?></span></a>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>