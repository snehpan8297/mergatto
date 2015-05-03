<?php
if (!isset($_SESSION)) {
    @session_start();
}
if(!isset($page) || ($page!="login" && $page!="login_confirm" && $page!="index")) {
    if(!isset($_SESSION['user_classics']['id_client'])) {
        if(!isset($_SESSION['admin_classics'])){
            header("location:login.php");
        }
    }
}
include("functions/get_lang.php");
include("./include/bdOC.php");
$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>" 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:data='http://www.google.com/2005/gml/data' 
xmlns:expr='http://www.google.com/2005/gml/expr' 
xmlns:og='http://opengraphprotocol.org/schema/'>
<head>
    <meta content="Oky^Coky classics" property='og:site_name'/>
    <meta content="Ninktec Community Technologies S.L." property='og:author'/>
    <meta name="description" content="Oky^Coky classics Shop"/>
    <meta name="title" content="OKY^COKY classics Shop" />
    <meta name="author" content="NinkTec Community Technologies S.L." />
    <meta name="keywords" content="Oky Coky Okycoky" />
    <meta name="rating" content="General" />
    <meta name="robots" content="INDEX, FOLLOW" />
    <meta name="copyright" content="Ninktec Community Technologies 2012" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="img/interface/okycockyclassics.ico" /> 
    <script type="text/javascript" src="./js/capsule_preload.js"></script>
    <script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
    <title>Oky^Coky classics</title>
</head>
<body>
<?php
include('./include/includes.php');
include('./theme/styles.php');

$type=$_GET["type"];
if ($type==0) {
	$varname="mainphoto";
} else {
	$varname="subphoto_".$type;
}
/*
Ass Image Product
------
Decripción
*/
$page="addimageproduct";
//include("header.php");
//Cargar $bd_images[posición]["id"]=id_de_la_imagen (estas son las que han importado)

$bd_images=getAllProductImages();
$old_images=getAllUploadedImages();
?>
<script>
	$(document).ready(function (){
		$('#new_image_option').click(function(){
			$('#old_image_selector').slideUp('fast');
			$('#bd_image_selector').slideUp('fast');
			if($('#new_image_selector').css('display')=='none'){
				$('#new_image_selector').slideDown('fast');
			}else{
				$('#new_image_selector').slideUp('fast');
			}
		});
		$('#new_image').change(function(){
			image_option='new_image';
			image_info=$('#new_image').val();
			if($('#add_image_accept_button').css('display')=='none'){
				$('#add_image_accept_button').css('display','block');
			}
		});
		$('.image_link').click(function(){
			$('.image_selected').removeClass('image_selected');
			$(this).addClass('image_selected');
			
			image_option='bd_old_image';
			image_info=$(this).attr('title');
			if($('#add_image_accept_button').css('display')=='none'){
				$('#add_image_accept_button').css('display','block');
			}
		});
		$('#add_image_accept').click(function(){
		    $("#step_1").submit();
		});
	});
	function showerror(text) {
	    alert(text);
	}
	function addnewimage() {
		parent.setimage();
		//alert( image_option + " - " + image_info);
		parent.closeadd(); 
	}
</script>
<div style="top:0px;left:0px;position:absolute;padding:20px;padding-top:0px;">
	<div class='contentbox'>
		<div class='form' id="login_step_1" style="display:block" >
			<form id='step_1' action="./addnewimagecover.php" method="post" target="uploadimagefrm" enctype="multipart/form-data">
				<div class='form_entry'>
					<span class='label'><h3><?php echo $s["add_image_cover_subtitle"]; ?></h3></span>
				</div>
				<div class='form_entry'>
					<span class='label'><a class='underline' id='new_image_option' href='#'><?php echo $s["new_image"]?></a></span>
					<div id='new_image_selector' class='upload_selector'  style='display:none;'>
						<div class=''>
							<input id='new_image' name='new_image' type='file'/>
						</div>
						<span id="new_image_alert" class='form_entry_alert'></span>
						<!--<div id='new_image_preview' class='image_preview'>
								<a href='#'><img class='image_link' src='./img/interface/oky_loading.gif' longdesc='./img/interface/no_image.jpg' /></a>
						</div>
						-->
						<iframe style="display:none;" id="uploadimagefrm" name="uploadimagefrm"></iframe>
						<p class='important' style='padding-left:20px'><?php echo $s["image_error"]; ?></p>
					</div>
				</div>
				<div class='form_submit'>
					<div class='likeabutton'><a id="add_image_cancel" href="javascript:parent.closeadd()"><span class='text'><?php echo $s["cancel"]?></span></a></div>
					<div class='likeabutton' id="add_image_accept_button" style='display:none;'><a id="add_image_accept" href="javascript:void(0)"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</form>
		</div>
	</div>
</div>
<? include("./functions/capsule_preload.php"); ?>