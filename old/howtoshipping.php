<?php 
$page="company";
include("header.php");
$shippings = getShipping(0,$lang);
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['shipping']; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info'>
			<?php echo $s["howtoshipping_info"]; ?>
			<br/>
				<?php
						while ($shipping = db_fetch($shippings)) {

					?>
					<h4 style='margin-bottom:0px;'><?php echo $shipping["name_".$lang];?></h4>
					<p style='margin-top:5px;'><?php echo $shipping["descrip_".$lang]." </p>
						<div style='border:1px solid #000; padding:10px;margin:5px 0px 30px 0px;color:black'>".$shipping["price_es"]."€ ". $s["ship_method_price_variable"].$shipping["price_interval"]." ".$s["ship_method_price_elements"]."</div>";?></p>				
					<?php
				}
				?>
				
		</div>
	</div>
</div>
<?php
include("footer.php");
?>