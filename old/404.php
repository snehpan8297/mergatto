<?php 
$page="404";
include("header.php");
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['404_title']; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info' style='text-align:center;'>
			<p><img src='./img/interface/logo.png' alt='Logo Oky^Coky Classics' width='400'/><br/></p>
			<p class='important'><?php echo $s["404"]; ?></p>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>