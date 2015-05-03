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
unset($_SESSION["precarga"]);

$page = "admin_product_validate";
include ("header.php");
$testit=$_SESSION["precargados"];
//print_r($testit);
?>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php' class='important'><?php echo $s["admin_menu_title"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_product_validate_title"] . " " . $_SESSION["contador"] . "/" . sizeof($testit)." - ".$s["validate_finished"];?></a>
		</div>
	</div>
	<div id='product'>
		<?php echo $s["insert_season_end"];?>
	</div>
</div>
<script>
	setTimeout("location.href='./admin_list_products.php'", 5000);
</script>
<?php
include ("footer.php");
?>