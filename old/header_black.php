<?php
	/*if((isset($_GET["admin"]))&&($_GET["admin"]=="sandro")&&($page=="admin")){
		
	}else{
		if(isset($_SESSION['admin_classics'])){
		}else{
						header("Location: http://www.okycoky.net/classics/closed.php");	
			die();	

		}
		
	}*/
//		header("Location: http://www.okycoky.net/classics/closed.php");	

		

if($_SERVER['HTTP_HOST']=="www.okycokyshop.com"){
	header("Location: http://www.okycoky.net".$_SERVER['REQUEST_URI']);	
	die();
}
if (!isset($_SESSION)) {
	@session_start();
}
$show_clothes=true;
$show_accessories=false;
$show_sizes=false;
$show_last=false;
if(isset($_GET["f"])){
	$accesories_families=array(26,29,41,46,47,48,49,50,51,57,58);
	if(in_array($_GET["f"],$accesories_families)){
		$show_clothes=false;
		$show_accessories=true;
		$show_sizes=false;
		$show_last=false;
	}
	$no_clothes=array(33);
	if(in_array($_GET["f"],$no_clothes)){
		$show_clothes=false;
		$show_accessories=false;
		$show_sizes=false;
		$show_last=false;
	}
}
if((isset($_GET["t"]))&&(!empty($_GET["t"]))){
	$show_clothes=false;
	$show_accessories=false;
	$show_sizes=true;
	$show_last=false;
}
if((isset($_GET["season"]))&&(!empty($_GET["season"]))){
	$show_clothes=false;
	$show_accessories=false;
	$show_sizes=false;
	$show_last=true;
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
		if(isset($_GET["source"])){
			$page_title.=" [".$_GET["source"]."]";
		}
		echo " - ".$page_title;
	} ?>" />
	<meta name="author" content="NinkTec Community Technologies S.L." />
	<meta name="keywords" content="<?php echo $config["keywords"];?>" />
	<meta name="rating" content="General" />
	<meta name="robots" content="index,all" />
	<meta name="copyright" content="Ninktec Community Technologies 2012" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />


        <link rel="stylesheet" href="assets/countdown/jquery.countdown.css" />

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
	<link rel="stylesheet" href="./theme/font-awesome.css" type="text/css" />
	<link rel="apple-touch-icon" href="../touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../touch-icon-ipad-retina.png">
	<title>OKY COKY CLASSICS | OUTLET SHOP <?php 
	if(isset($page_title)){
		echo " - ".$page_title;
	} ?></title>
</head>
<body>
<?php 

	include('./theme/styles_black.php');
?>

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
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';

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
?>
	<div id='main'>
	<?php
			?>
			<div id='top_menu' style='background-color:black !important'>
				<div class='user_panel'>
						<?php
					if(isset($_SESSION['user_classics']['id_client'])){
					
						if((!isset($page_title))||(empty($page_title))){
							$page_title="pagina desconocida";
						}
						$page_title_log=htmlentities($page_title, ENT_QUOTES, "UTF-8");
						$page_title_log=str_replace("&", "", $page_title_log);
						$page_title_log=str_replace("acute", "", $page_title_log);
						$page_title_log=str_replace(";", "", $page_title_log);
						$page_title_log=str_replace("tilde", "", $page_title_log);
						$page_title_log=htmlentities($page_title, ENT_QUOTES, "UTF-8");
						
						$user_name_log=htmlentities($userdata['name'], ENT_QUOTES, "UTF-8");
						$user_name_log=str_replace("&", "", $userdata['name']);
						$user_name_log=str_replace("acute", "", $user_name_log);
						$user_name_log=str_replace(";", "", $user_name_log);
						$user_name_log=str_replace("tilde", "", $user_name_log);
						
						include_once("./include/inbd.php");
						$table='mmorpg';
						$data=array();
						$data["time"]=date("Y-m-d H:i");
						$data["identification"]=$user_name_log;
						$data["action"]="esta viendo "."<b>".$page_title_log."</b>";
						addInBD($table,$data);
						
						
						
						if((isset($userdata['name']))&&(!empty($userdata['name']))){
						echo "<a class='btn btn-dark' href='my_account.php'>".$s["my_account"]." ";
						}else{
												echo "<a class='btn btn-dark' href='my_account.php'>".$s["my_account"]." ";

						}
						echo "</a> <a href='./logout.php' class='btn btn-dark'>".$s["logout"]."</a> ";
		
					}else if(isset($_SESSION['admin_classics'])){
						echo $s["header_hello_admin"]." <span class='important'>|</span> <a href='./admin_menu.php' class='important'>".$s["admin_menu"]."</a> <span class='important'>|</span> <a href='./admin_logout.php' class='important'>".$s["logout"]."</a> ";
					}else{
						if((!isset($page_title))||(empty($page_title))){
							$page_title="pagina desconocida";
						}
						$page_title_log=htmlentities($page_title, ENT_QUOTES, "UTF-8");
						$page_title_log=str_replace("&", "", $page_title_log);
						$page_title_log=str_replace("acute", "", $page_title_log);
						$page_title_log=str_replace(";", "", $page_title_log);
						$page_title_log=str_replace("tilde", "", $page_title_log);
						
						$user_name_log= "Desconocido";
						if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					    	$ip = $_SERVER['HTTP_CLIENT_IP'];
						} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
						} else {
						    $ip = $_SERVER['REMOTE_ADDR'];
						}
						$user_name_log=$ip;
												include_once("./include/inbd.php");

						$table='mmorpg';
						$data=array();
						$data["time"]=date("Y-m-d H:i");
						$data["identification"]=$user_name_log;
						$data["action"]="esta viendo "."<b>".$page_title_log."</b>";
						addInBD($table,$data);
						echo "<a href='./login.php' class='btn btn-dark'>".$s["login"]."</a> <a href='./signup.php' class='btn btn-dark'>".$s["signup"]."</a> ";
					}
				?>
			
				</div>
				<a href='http://www.okycoky.net/classics/?action=none' class='logo'><img src='./img/interface/okycoky-logo-black.png'/></a>

			</div>
			<?php include('./left_menu.php');?>
			<div id='user_menu' style='background-color:#222 !important;'>
				
	
	<div class='uppercase' id='cart_menu'>
	<?php
		if(!isset($interface_options["cart_menu_hidden"])){
		?>
		<?php
			$numtotal = 0;
			$moneytotal = 0;
			include_once("include/products.php");
			include_once("include/users.php");
			if(isset($_SESSION['user_classics'])) {
				$user = array("id_client" => $_SESSION['user_classics']['id_client']);
				$u = userData($user);
			}
			if(isset($_SESSION['cart_classics'])) {
				foreach($_SESSION['cart_classics'] as $ca) {
					$num = array_sum($ca["sizes"]);
					$numtotal += $num;
					$p = productData($ca["id_product"]);
					if($p["use_discount"]==1){
						$moneytotal += round((1-$p["discount"]/100)*$p["pvp"])*$num;
					}else{
						$moneytotal += $p["pvp"]*$num;
					}
				}
				$moneytotal = number_format(round($moneytotal),2, '.', '');
			}
		?>
		<span id='cartspan'>
		<form id='search' action='search.php' method='get'/>
				<input style='float:left' style='width:100px;background-color:#222 !important' id='search_input' name='search_input' type='text' class='text' placeholder='<?php echo $s["search.."];?>'/>		
		</form>
		
		<a href='./cart.php' class='important icon_cart' style='color:#fff !important'><i class='fa fa-shopping-cart'></i> <?php echo "( <span id='numtotal'>".$numtotal."</span> ) <span id='moneytotal'>".$moneytotal."</span> ".$c['symbol']."  "; ?>
			<?php
				if((isset($userdata["discount"]))&&($userdata["discount"]!=0)){
					echo "<b>".$s["discount"]." ".$userdata["discount"]."%"."<b>";
				}
			?>
		</a>
		<a href='./cart.php' class='btn btn-mini btn-dark'><?php echo $s["finish_order"];?></a>
		</span>
	<?php
			}
	?>
	</div>

			
</div>
<div class='modal_window' style='display:none'>
	<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:400px; padding:20px; z-index:910;left:50%;margin-left:-200px;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['thanks_title']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info' style='text-align:center'>
					<div style='text-align:center;margin-bottom:10px;'><i class='fa fa-times fa-4x'></i></div>
					<?php echo $s["promo_code_error"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="" style='margin:auto;' href="./cart.php"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>
<?php
	if((isset($_GET['action']))&&($_GET['action']=='welcome' && isset($_SESSION['user_classics']))){
?>
	<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; padding:20px; z-index:910;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['welcome']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info'>
					<?php echo $s["welcome_info"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="javascript:void(0);"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});
			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
	}else if((isset($_GET['action']))&&($_GET['action']=='new')){
?>
	<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; padding:20px; z-index:910;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['new_user_title']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info'>
					<?php echo $s["new_user_moreinfo"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="javascript:void(0);"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});

			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
	}else if((isset($_SESSION['user_classics']))&&(empty($userdata["name"]))&&($page!="my_editinfo")){
?>
	<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; padding:20px; z-index:910;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['new_user_title']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info'>
					<?php echo $s["new_user_moreinfo"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="http://www.okycoky.net/classics/my_personaledit.php"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});

			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
	}else if((isset($_GET['action']))&&($_GET['action']=='thanks')){
?>
	<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; padding:20px; z-index:910;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['thanks_title']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info'>
					<?php echo $s["thanks_moreinfo"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="javascript:void(0);"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});
			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
	}else if(($page=="index")&&($config["welcome"]==1)&&(empty($_GET))){
?>
			<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		
		<?php
			if($config["welcome_img"]==1){
				?>
				<div class='window' style='position:fixed; top:100px; width:720px; z-index:910;'>
					<div style='position:absolute;right:0;padding:10px 15px'>
						<a id="accept_button" style='font-size:20px;' href="javascript:void(0);">X</a>
					</div>
					<img style='width:720px;' src="./resources/welcome/<?php echo $lang;?>.jpg"/>
				<?php
			}else{
				?>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; z-index:910;'>

				<div class='contentbox' style='padding:20px;'>

				<?php echo $config["welcome_text_".$lang];?>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="javascript:void(0);"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
				</div>
				<?php
				
			}
		?>
		
				
		</div>
	</div>
	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});
			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
						$('.modal-background').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
		
	}else if($page=="access_request"){

?>
<div class='float_alert'>
		<div class='background modal-background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:600px; padding:20px; z-index:910;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s['access_request_title']; ?></a></div>
			</div>
			<div class='contentbox'>
				<div class='infobox_info'>
					<?php echo $s["access_request_moreinfo"]; ?>
				</div>
				<div style="padding-top:20px;overflow:auto;">
					<div style='text-align:center;' class='likeabutton'><a id="accept_button" style='margin:auto;' href="javascript:void(0);"><span class='text'><?php echo $s["accept"]?></span></a></div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function (){
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});
			$('#close_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('#accept_button').click(function() {
				$('.float_alert').css('display','none');
			});
			$('.modal-background').click(function() {
				$('.float_alert').css('display','none');
			});
			$(document).bind('keyup', function(e) {
				if(e.keyCode==13){
					$('#accept_button').click();
				}
			});
		});
	</script>
<?php
	}
?>