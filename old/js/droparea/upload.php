<?php
/*$fp = fopen('upload-log.txt', 'a');
fwrite($fp, $log);
fclose($fp);*/

// Result object
$res = new stdClass();
// Result content type
header('content-type: application/json');

// Maximum file size
$maxsize = 10; //Mb
// File size control
if ($_FILES['xfile']['size'] > ($maxsize * 1048576)) {
    $res->error = "Max file size: $maxsize MB";
}

include("../../include/bd.php");

if(!isset($manejador)) {
	$manejador = db_connect();
}

if($_GET["status"]=="principal"){
	if(file_exists("../../images/principal/".$_GET["def_model"].".jpg")){
		unlink("../../images/principal/".$_GET["def_model"].".jpg");
	}
	$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
	$filename = "../../images/principal/".$_GET["def_model"].".jpg";
	imageresize($source, $filename);
	$res->filename = $filename;
	$res->indice = 0;
	$res->path = "./images/principal/";
	$res->img = '<img src="./images/principal/'.$_GET["def_model"].'.jpg" alt="image" />';
	echo json_encode($res);
	die();
}else if($_GET["status"]=="images"){
	$i_fix=1;
	for ($i=1;$i<=10;$i++){
		if(file_exists("../../images/images/".$_GET["def_model"]."-".$i.".jpg")){
			copy("../../images/images/".$_GET["def_model"]."-".$i.".jpg", "../../images/images/".$_GET["def_model"]."-temp.jpg");
			unlink("../../images/images/".$_GET["def_model"]."-".$i.".jpg");
			copy("../../images/images/".$_GET["def_model"]."-temp.jpg", "../../images/images/".$_GET["def_model"]."-".$i_fix.".jpg");
			unlink("../../images/images/".$_GET["def_model"]."-temp.jpg");
			$i_fix++;
		}
	}
	$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
	$filename = "../../images/images/".$_GET["def_model"]."-".$i_fix.".jpg";
	imageresize($source, $filename);
	$res->filename = $filename;
	$res->indice = 0;
	$res->path = "./images/images/";
	$res->img = '<img src="./images/images/'.$_GET["def_model"].'-'.$i_fix.'.jpg" alt="image" />';
	echo json_encode($res);
	die();
}else{
	$i_fix=1;
	for ($i=1;$i<=10;$i++){
		if(file_exists("../../images/secondaries/".$_GET["def_model"]."-".$i.".jpg")){
			copy("../../images/secondaries/".$_GET["def_model"]."-".$i.".jpg", "../../images/secondaries/".$_GET["def_model"]."-temp.jpg");
			unlink("../../images/secondaries/".$_GET["def_model"]."-".$i.".jpg");
			copy("../../images/secondaries/".$_GET["def_model"]."-temp.jpg", "../../images/secondaries/".$_GET["def_model"]."-".$i_fix.".jpg");
			unlink("../../images/secondaries/".$_GET["def_model"]."-temp.jpg");
			$i_fix++;
		}
	}
	$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
	$filename = "../../images/secondaries/".$_GET["def_model"]."-".$i_fix.".jpg";
	imageresize($source, $filename);
	$res->filename = $filename;
	$res->indice = 0;
	$res->path = "./images/secondaries/";
	$res->img = '<img src="./images/secondaries/'.$_GET["def_model"].'-'.$i_fix.'.jpg" alt="image" />';
	echo json_encode($res);
	die();
}

$query = "select count(*) as num from ".$conf["bdprefix"]."images where def_model = '".db_secure_field($_GET["def_model"],$manejador)."'";
$r = db_query($query,$manejador);
//if(db_count($r) > 0) {
	/*$old_image=db_fetch($r);
	$query = "delete from ".$conf["bdprefix"]."images where id_image = '".db_secure_field($old_image["id_image"],$manejador)."'";
	$r = db_query($query,$manejador);
	$query = "delete from ".$conf["bdprefix"]."image_products where id_image = '".db_secure_field($old_image["id_image"],$manejador)."'";
	$r = db_query($query,$manejador);*/
//}
$count = db_fetch($r);

$query = "insert into ".$conf["bdprefix"]."images (def_model,imgorder) values ('".$_GET["def_model"]."',".($count["num"]+1).")";
$r = db_query($query,$manejador);
$indice = db_last_id();
$query = "insert into ".$conf["bdprefix"]."image_products (id_image,id_product,imgorder) values ('".$indice."','".$_GET["id_product"]."',".($count["num"]+1).")";
$r = db_query($query,$manejador);

$types = Array('image/png', 'image/gif', 'image/jpeg');

$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
$folder = '../../products/models/original/';
//$filename = $_POST['value'] ? $_POST['value'] : $folder . $indice . '.jpg';
$filename = $folder . $indice . '.jpg';

imageresize($source, $filename);

$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);

$folder = '../../products/models/370/';
$filename = $folder . $indice . '.jpg';

imageresize($source, $filename, "370");

$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);

$folder = '../../products/models/74/';
$filename = $folder . $indice . '.jpg';

imageresize($source, $filename, "74");

$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);

// Result data
$res->filename = $filename;
$res->indice = $indice;
$res->path = "./products/models/370/";
$res->img = '<img src="./products/models/370/' . $indice . '.jpg" alt="image" />';

// Return to JSON
echo json_encode($res);

// Image resize function with php + gd2 lib
function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 100) {
    $quality = $quality ? $quality : 100;
    $image = imagecreatefromstring($source);
    if ($image) {
        // Get dimensions
        $w = imagesx($image);
        $h = imagesy($image);
        if (($width && $w > $width) || ($height && $h > $height)) {
            $ratio = $w / $h;
            if (($ratio >= 1 || $height == 0) && $width && !$crop) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } elseif ($crop && $ratio <= ($width / $height)) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } else {
                $new_width = $height * $ratio;
                $new_height = $height;
            }
        } else {
            $new_width = $w;
            $new_height = $h;
        }
        $x_mid = $new_width * .5;  //horizontal middle
        $y_mid = $new_height * .5; //vertical middle
        // Resample
        //error_log('height: ' . $new_height . ' - width: ' . $new_width);
        $new = imagecreatetruecolor(round($new_width), round($new_height));
		$color = imagecolorallocate($new, 255, 255, 255);
		imagefill($new, 0, 0, $color);
        imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        // Crop
        if ($crop) {
            $crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
            imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
            //($y_mid - ($height * .5))
        }
        // Output
        // Enable interlancing [for progressive JPEG]
        imageinterlace($crop ? $crop : $new, true);

        $dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        if ($dext == '') {
            $dext = $ext;
            $destination .= '.' . $ext;
        }
        switch ($dext) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($crop ? $crop : $new, $destination, $quality);
                break;
            case 'png':
                $pngQuality = ($quality - 100) / 11.111111;
                $pngQuality = round(abs($pngQuality));
                imagepng($crop ? $crop : $new, $destination, $pngQuality);
                break;
            case 'gif':
                imagegif($crop ? $crop : $new, $destination);
                break;
        }
        @imagedestroy($image);
        @imagedestroy($new);
        @imagedestroy($crop);
    }
}
?>