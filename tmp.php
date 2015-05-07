<?php
	echo "<pre>";
	$response="";
	for($i=1;$i<=111;$i++){
		$i_zero=str_pad($i, 3, '0', STR_PAD_LEFT);
		echo "&lt;div class='col-md-4 padding-20 text-center'>&lt;img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-".$i_zero."-1.jpg'/>&lt;br/>Look ".$i."/100&lt;/div><br/>";
	}

?>
