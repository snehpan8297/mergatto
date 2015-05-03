<?php 
//Lang Confirmado

$page="payments";
include("header.php");
?>

<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s["retailer_success_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info'>
			<?php echo $s["retailer_success_moreinfo"]; ?>
		</div>
		<div class='ticket' id='payment_step_3' style="display:block">
			<div class='form_submit'>
				<div class='likeabutton'><a id="payments_back_step2" href="./index.php"><span class='text'><?php echo $s["exit"]?></span></a></div>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>