<?php 
//Lang Revisado
$page="index";
$page_title = "Portada";
include("header_black.php");
include_once("include/products.php");
include_once("include/inbd.php");
$family = "index";
$page = "list";
$pag = 0;
$limit = 12;
$r = listProducts($family,"serial_model_code",$limit,$pag * $limit);
?>
		<?php
		if($config["index_type"]=="html"){
			?>
			<div id='content' style='padding-top:55px'>

					<div class='contentbox'>

						<div id="countdown" style='margin-top:20px;'></div>
					<div id="section_header">
						<div class="inner">
						</div>
					</div>
					<?php
					$config["html_".$lang]=str_replace('img src', 'img style="width:100%" src', $config["html_".$lang]);
					$config["html_".$lang]=str_replace('.php?', '.php?source=portada&', $config["html_".$lang]);
	
					echo $config["html_".$lang];?>
				</div>
			</div>
			<?php
			
		}else if($config["index_type"]=="products"){
			?>
			<div id='content'>

			<div class='contentbox'>
			<div id="section_header">
			<div class="inner">
							</div>
				</div>
				<div id='item_list' class='index' style='overflow:hidden;margin-bottom:40px;'>
					<?php
					$count=0;
					while($p = db_fetch($r)) {
						$name = $p["name_".$lang];
						if($lang!="es" && $p["name_".$lang]!="") {
							$name=$p["name_".$lang];
						}
						$images = productImages($p["id_product"],2);
						if($count==0){
							echo "<div class='items_row'>";
						}
						$count++;
						echo "<div id='item'>
							<div class='image' style='position: relative;'>
								<a href='./product.php?p=".$p["id_product"]."&f=".$family."&pag=".$pag."'><img class='image_link";
								$image1["id_image"]=0;
								if((db_count($images) > 1)&&!((isset($_GET["season"]))&&($_GET["season"]=="other"))){
									$image1 = db_fetch($images);
									$image1 = db_fetch($images);
									echo " image_change ";
								}	
								echo "' id='".$p["id_image"]."' "; 
								if(isset($p["id_image"])) {
									echo "src='./img/interface/oky_loading.gif' longdesc='./products/models/370/".$p["id_image"].".jpg' on_hover='./products/models/370/".$image1["id_image"].".jpg'"; 
								} else {
									echo "src='./img/interface/oky_loading.gif' longdesc='./img/interface/no_image.jpg'"; 
								}
								echo " />";
								
							echo "</a>
							</div>
					<!--<div class='description'>
								<center><a href='./product.php?p=".$p["id_product"]."&f=".$family."&pag=".$pag."'><span class='item_name important'>".$name."</span></a><br/><span></center>
								
							</div>-->
						</div>";
						if($count==3){
							echo "</div>";
							$count=0;
						}
					}
					?>
				</div>
			</div>
			</div>
			<?php
		}
?>
</div>
<script>
	$(document).ready(function (){
			$('.image_change').mouseover(function() {
					new_image=$(this).attr("on_hover");
					$(this).attr("src",new_image);
					$(this).addClass("image_link2");
					//$('#'+id+'_1').fadeIn('fast');
				});
				$('.image_link2').live("mouseout",function(){
					$(this).removeClass("image_link2");
					new_image=$(this).attr("longdesc");
					$(this).attr("src",new_image);
					//$('#'+id).fadeOut('fast');
				});

	});
</script>
<?php
include("footer.php");
?>