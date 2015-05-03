<?php
//Lang revisado


if (!isset($_SESSION)) {
    @session_start();
}
if(!isset($page) || ($page!="login" && $page!="login_confirm" && $page!="index")) {
    if(!isset($_SESSION['user_classics']['client_code'])) {
        if(!isset($_SESSION['admin_classics'])){
            header("location:login.php");
        }
    }
}
include("functions/get_lang.php");
include("include/bdOC.php");
include("include/includes.php");
$config=getConfig();
define("LIMITUNITTOTAL", $config["limit_unit"]);

$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"]; 
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

   
    $image1=$_FILES['new_image']['name'];
    //if it is not empty
    //get the original name of the file from the clients machine
        $filename = stripslashes($_FILES['new_image']['name']);
    //get the extension of the file in a lower case format
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        //echo "extension: ".$extension."\n";
    //if it is not a known extension, we will suppose it is an error and 
        // will not  upload the file,  
    //otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=
 "png") && ($extension != "gif"))
        {

?>
<html>
	<body>
		<script>
			
			parent.showerror(<?php echo $s["image_error"]; ?>);

		</script>
	</body>
</html>
<?php
die();
}
?>

<?php
global $manejador;
$dir = "./products/models/";

db_query("insert into classic_images (def_model) values ('---')", $manejador);
$indice = db_last_id();
$tempfile = $dir . "original/" . $indice . "." . $extension;
$copied = copy($_FILES['new_image']['tmp_name'], $tempfile);

if (($extension == "jpg") || ($extension == "jpg"))
    $imageorig = imagecreatefromjpeg($tempfile);
else if ($extension == "png")
    $imageorig = imagecreatefrompng($tempfile);
else if ($extension == "gif")
    $imageorig = imagecreatefromgif($tempfile);

$grande = imagecreatetruecolor(370, 760);
$white = imagecolorallocate($grande, 255, 255, 255);
imagefill($grande, 0, 0, $white);
$pequena = imagecreatetruecolor(74, 152);
$imagetam = getimagesize($tempfile);
$escalado1 = 370 / $imagetam[0];
$escalado2 = 760 / $imagetam[1];
//echo "$escalado1 xx $escalado2";
$escalado = ($escalado1 < $escalado2) ? $escalado1 : $escalado2;
if ($escalado > 1)
    $escalado = 1;
$ntams = array("w" => round($escalado * $imagetam[0]), "h" => round($escalado * $imagetam[1]));
$desp = array("w" => (round(370 - $ntams["w"]) / 2), "h" => round((760 - $ntams["h"]) / 2));
imagecopyresampled($grande, $imageorig, $desp["w"], $desp["h"], 0, 0, $ntams["w"], $ntams["h"], $imagetam[0], $imagetam[1]);
imagejpeg($imageorig, $dir . "original/" . $indice . ".jpg");
imagejpeg($grande, $dir . "370/" . $indice . ".jpg");
imagecopyresampled($pequena, $grande, 0, 0, 0, 0, 74, 152, 370, 760);
imagejpeg($pequena, $dir . "74/" . $indice . ".jpg");
//$image=hex2bin($image);
?>

<html>
	<body>
		Hola
		<script>
parent.addnewimage(<?php echo $indice;?>);</script>
	</body>
</html>
