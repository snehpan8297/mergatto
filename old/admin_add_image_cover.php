<?php
@session_start();
include ("./include/bdOC.php");
unset($_SESSION['cart_classics']);
if(!isset($_SESSION['admin_classics'])) {
    header("location:./admin.php");
    die();
}
include_once("./include/cover.php");

$page = "admin_product_validate";
include ("header.php");
$c=array(
	"id_cover"=>"-1",
	"url"=>"",
	"title_es"=>"",
	"subtitle_es"=>"",
	"title_en"=>"",
	"subtitle_en"=>""
);
if (isset($_GET["cover"])) {
	$c = getCover($_GET["cover"]);
}
?>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='./admin_cover_config.php'><?php echo $s["cover_config"];?></a> / <a href='javascript:void(0)' class='important'><?php echo $s["admin_edit_product"]; ?></a>
		</div>
	</div>
	<div>
		<div class='preview' >
		    <input type="hidden" id="id_cover" value="<?php echo $c["id_cover"];?>">
			<div class='product_navigator' style='overflow:auto;padding:2px;'>
				<a href='javascript:chooseimg(0)'>Pulsa aqui para elegir la imagen</a>
			</div>
			<div class='principal'>
				<center><a href='javascript:chooseimg(0)'><img id='mainphoto' style='height:100px;' src='<?php if ($c["id_cover"]==-1) echo "./img/interface/no_image.jpg";else echo "./covers/".$c["id_cover"].".jpg"; ?>'/></a>
				<input type='hidden' id='temp_mainphoto' value='<?php echo $c["id_cover"];?>' /></center>
			</div>
		</div>
		<div class='information' style='margin-top:20px;'>
			
			<div>
				<div class='likeabutton'>
					<a id="next" href="javascript:save();"><span class='text'><?php echo $s["save"];?></span></a>
				</div>
				<div class='likeabutton'>
					<a href="javascript:window.location.href='admin_cover_config.php';"><span class='text'><?php echo $s["back"];?></span></a>
				</div>
			</div>
			<div id="imageselector" class='zoom_window' style='display:none;'>
				<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
				<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:fixed; top:100px; width:800px; height:500px; margin-left:-400px;z-index:910;'>
					<div style='position:absolute; text-align: right;width: 100%;'>
						<a class='close_button' id="close_button" href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
					</div>
					<div class='contentbox'>
						<div style='padding:20px; padding-bottom:0px'>
							<div id='page_header'>
								<div id='page_navigator'>
									<a href='' class='important'><?php echo $s["add_image_cover_title"]; ?></a>
								</div>
							</div>
							<div id='infobox_header' class='infobox_info'>
								<?php echo $s["add_image_cover_moreinfo"]; ?>
							</div>
						</div>
						<iframe id="iframein" src="" style="background-color: white;width:100%;height:100%;border:none;"></iframe>
					</div>
				</div>
			</div>
			<script>
				var mouse_is_inside = false;
				var subt;
				var subt_num;
				var moneytotal = parseInt(<?php echo $moneytotal; ?>);
				var numtotal = parseInt(<?php echo $numtotal; ?>);
				$(document).ready(function (){
					$('#close_button').click(function() {
						$('.zoom_window').css('display','none');
					});
					$('.window').hover(function(){ 
						mouse_is_inside=true; 
					}, function(){ 
						mouse_is_inside=false; 
					});
					$("body").mouseup(function(){ 
						if(! mouse_is_inside) $('.zoom_window').css('display','none');
					});
				});
				function next() {
					window.location="./admin_edit_product.php?action=next";
				}
				function previous() {
					window.location="./admin_edit_product.php?action=previous";
				}
				function save() {
					$.ajax({
						type : "POST",
						url : "./editcoverbd.php",
						data : {
							"foto": $("#temp_mainphoto").val(),
							"lang": "<?php echo $_GET["lang"];?>",
						},
						success : function(msg) {
							if(msg == "OK"){
								window.location="./admin_cover_config.php";
							}
						}
					});
				}
				function chooseimg(position) {
					$("#iframein").attr("src", "");
					$("#iframein").attr("src", "addimagecover.php?type=" + position);
					$("#imageselector").css("display", "block");
				}
				function closeadd() {
					$("#imageselector").css("display", "none");
				}
				function setimage() {
						var parte = "#mainphoto";
						$(parte).attr("src", './tmp/grande.jpg')
						parte = "#temp_mainphoto";
						$(parte).val(-5);
				}
				function delimage(part) {
					var partes=part.split("_");
					if (partes[1]>0) {
						var parte="#"+part;
						$(parte).parent().parent().remove();
					} else {
						var parte="#mainphoto";
						if ($(".secondaries ul li").first().attr("id")=="imageadder") {
							$(parte).attr("src","./img/interface/no_image.jpg");
							$("#id_mainphoto").val("--");
						} else {
							$(parte).attr("src",$(".secondaries ul li").find("img").attr("src"));
							$("#id_mainphoto").val($(".secondaries ul li").find("input").val());
							$(".secondaries ul li").first().remove();
						}
					}
					closeadd();
				}
			</script>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>