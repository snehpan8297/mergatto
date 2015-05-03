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
			
			parent.showerror("<?php echo $s["image_error"]; ?>");

		</script>
	</body>
</html>
<?php
die();
}
?>

<?php
global $manejador;
$dir = "./materials/";

$tempfile = $dir . $_POST["id_color"] . "." . $extension;

if (($extension == "jpg") || ($extension == "jpg"))
    $imageorig = imagecreatefromjpeg($_FILES['new_image']['tmp_name']);
else if ($extension == "png")
    $imageorig = imagecreatefrompng($_FILES['new_image']['tmp_name']);
else if ($extension == "gif")
    $imageorig = imagecreatefromgif($_FILES['new_image']['tmp_name']);

$grande = imagecreatetruecolor(370, 370);
$white = imagecolorallocate($grande, 255, 255, 255);
imagefill($grande, 0, 0, $white);
imagecopy($grande, $imageorig,0,0,0,0,370,370);
imagejpeg($grande, $dir . $_POST["id_color"] . ".jpg");




//$image=hex2bin($image);
?>

<html>
	<body>
		<script>
		parent.addnewimage("material","<?php echo $_POST["id_color"];?>");</script>
	</body>
</html>

