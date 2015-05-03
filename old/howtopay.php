<?php 
$page="company";
include("header.php");
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['payment']; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info'>
			<?php echo $s["howtopay_info"]; ?>
		</div>		
	</div>
</div>
<?php
include("footer.php");
?>