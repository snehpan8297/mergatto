<?php
@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
include ("./include/bdOC.php");
if(isset($_POST["id_season"]) && isset($_POST["receiptnumber"])) {
	include ("./lang/lang_".$_POST["lang"].".php");
	$r1 = getPropPedData($_POST["id_season"], $_POST["receiptnumber"]);
	$total_models = mssql_num_rows($r1);
	$content = "<span class='label'><span style='font-weight: bold; font-size: 14px;'>Modelos (".$total_models."):</span> <span class='form_isrequired'>*</span><br/><a class='important underline' href='javascript:selectseries(1)'>".$s["select_all"]."</a> / <a class='important underline' href='javascript:selectseries(0)'>".$s["unselect_all"]."</a></span><div class='checkbox_content'>";
	while ($value = mssql_fetch_assoc($r1)) {
		$content .= "<span class='checkbox'><input type='checkbox' class='chline1' name='series[]' checked value='".$value["COD_SERIE_MODELO"]."'>".utf8_encode($value["COD_SERIE_MODELO"])."</span>";
	}
	echo $content;
}
?>