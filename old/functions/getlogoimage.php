<?php
header('Content-Type: image/png');
include("../include/config.php");
$config=getConfig();
$r=hexdec("43");
$g=hexdec("45");
$b=hexdec("45");

$image=imagecreatefrompng("../img/interface/logo.png");
imagealphablending($image, false);
imagesavealpha($image, true);
imagetruecolortopalette($image,false,20);
$index = imagecolorresolve($image,$r,$g,$b);
//echo $index;
imagecolorset($image,$index,255,0,0);  //reddish color 
imagepng($image);
?>