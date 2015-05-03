<?php
$filename = "./maintenancedb.php";
$file = file_get_contents($filename);
if(isset($_POST["maintenance_mode"]) && $_POST["maintenance_mode"]==1) {
	$file = str_replace("false","true",$file);
} else {
	$file = str_replace("true","false",$file);
}
file_put_contents($filename, $file);
?>