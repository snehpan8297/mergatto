<?php
if (!isset($_SESSION)) {
	@session_start();
}
include("maintenancedb.php");
if($maintenance==true && !isset($_SESSION['admin_classics']) && (!isset($page) || $page!="admin")) {
	header("location: maintenance.php");
	die();
}
/*
if(!isset($page) || ($page!="login" && $page!="login_confirm" && $page!="index" && $page!="signup" && $page!="access_request" && $page!="recover_pass")) {
	if(!isset($_SESSION['user_classics']['client_code'])) {
		if(!isset($_SESSION['admin_classics'])){
			header("location:login.php");
		}
	}
}
*/
$oldget = '?old=old';
foreach ($_GET as $get => $value) {
	if (($get <> "o") && ($get <> "lang")) {
		$oldget = $oldget . '&' . $get . "=" . $value;
	}
}

$oldget2 = '?old=old';
foreach ($_GET as $get => $value) {
	if (($get <> "d") && ($get <> "lang")) {
		$oldget2 = $oldget2 . '&' . $get . "=" . $value;
	}
}

include("functions/get_lang.php");

$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];   
$c["name"] = "Euro";
$c["symbol"] = "€";
$c["exchange"] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php include('./include/includes.php'); ?>
<?php include_once('./include/orders.php'); ?>
<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>" 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:b='http://www.google.com/2005/gml/b' 
xmlns:data='http://www.google.com/2005/gml/data' 
xmlns:expr='http://www.google.com/2005/gml/expr' 
xmlns:og='http://opengraphprotocol.org/schema/'>
<head>
	<meta content="Ninktec Community Technologies S.L." property='og:author'/>
	<meta name="description" content="<?php 
	if(isset($page_description)){
		echo $page_description;
	}else{
		echo $config["description"];
	}?>"/>
	<meta name="title" content="OKY COKY CLASSICS | OUTLET SHOP <?php 
	if(isset($page_title)){
		echo " - ".$page_title;
	} ?>" />
	<meta name="author" content="NinkTec Community Technologies S.L." />
	<meta name="keywords" content="<?php echo $config["keywords"];?>" />
	<meta name="rating" content="General" />
	<meta name="robots" content="index,all" />
	<meta name="copyright" content="Ninktec Community Technologies 2012" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="./theme/font-awesome.css" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="./img/interface/okycokyclassics.ico" /> 
	<link rel="stylesheet" href="./js/chocoslider/chocoslider.css" type="text/css" />
	<link rel="stylesheet" href="./theme/ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
	<?php if(isset($page_image_src)) { ?>
		<link href='<?php echo $page_image_src; ?>' rel='image_src' />
	<?php } else { ?>
		<link href='<?php echo $url_base; ?>img/interface/logo.png' rel='image_src' />
	<?php } ?>
	<script type="text/javascript" src="./js/capsule_preload.js"></script>
	<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="./js/jquery.chocoslider.js"></script>
	<script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
	<title>OKY COKY CLASSICS | OUTLET SHOP <?php 
	if(isset($page_title)){
		echo " - ".$page_title;
	} ?></title>
</head>
<body>
<?php include('./theme/styles_old.php'); ?>

<?php
	if($page == "product"){
		?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=161936633895153";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>		
		
		<?php
	}

?>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35971078-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script>
function popup(URL) {
				iz = (screen.width - 600) / 4;
				ar = (screen.height - 550) / 8;
				altura = 650;
				window.open(URL, 'ventana1', 'width=700,height=' + altura + ',top=' + ar + ',left=' + iz + ',scrollbars=YES')
			}
</script>
<?php
$config=getConfig();
define("LIMITUNITTOTAL", $config["limit_item"]);
if(isset($_SESSION['user_classics']['id_client'])){
	$user["id_client"] = $_SESSION['user_classics']['id_client'];
} else {
	$user["id_client"] = 0;
}
$userdata = userData($user);

$num_waiting_orders=0;
if(isset($userdata["client_code"])){
	$num_waiting_orders=numWaitingOrders($userdata["id_client"]);
}
$num_new_payments=0;
if(isset($userdata["client_code"])){
	$num_new_payments=numMyNewPayments($userdata["id_client"]);
}
					include("include/family.php");
					$families = listFamilies();

?>
	<div id='main' style='width:800px;'>
		

