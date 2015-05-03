<?php 
$page="product";
include("header.php");

$product['name']='LINO ESTAMPADO BICOLOR-AIKO';
$product['client_pvps']=Array(119,125,149,131,0,119.55,0,0,0,0,0,0);
$product['serial_model_code']='3401-AIK';
$product['sizes']=Array('36','38','40','42','44','46','48','50','52');
$product['colors']['code']=Array('1059204','1059235','1059266');
$product['colors']['name']=Array('CRUDO-1','ROJO-4','AZUL-5');
$product['description']='50% ALGODON - 35% VISCOSA - 15% LINO';
$product['images']=Array('2','5','7');


$client['currency_name']='Euro';
$client['currency_excange']=1;
$client['currency_symbol']='€';

$client['id_rate']=1;

$product['price']=$product['client_pvps'][$client['id_rate']]*$client['currency_excange'];
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='product'>
		<div class='preview'>
			<div class='principal'>
				<div class='product_navigator' style='overflow:auto;padding:2px;'>
					<a href='./list.php' style='float:left;display:block; width:16px; height:12px; background-image:url("./img/interface/arrow_back.png")'></a>
					<a href='./next.php' style='margin:1px 2px;float:right;display:block; width:8px; height:10px; background-image:url("./img/interface/arrows_pager.png"); background-position: 8px 0px;'></a>
					<a href='./pre.php' style='margin:1px 2px;float:right;display:block; width:8px; height:10px; background-image:url("./img/interface/arrows_pager.png"); background-position: 0px 0px;'></a>
				</div>
				<?php
					if(sizeof($product['images'])>0){
						?>
						<a href='#'><img class='image_link' src='./products/models/<?php echo $product['images'][0]; ?>.jpg'/></a>
						<?php
					}else{
						?>
						<img class='image_link' src='./img/interface/no_image.jpg'/>
						<?php
					}
				?>
			</div>
			<?php
				if(sizeof($product['images'])>1){
					?>
					<div class='secondaries'>
						<ul>
						<?php
							for($i=1;$i<sizeof($product['images']);$i++){
								?>
									<li><a href='#'><img class='image_link' src='./products/models/<?php echo $product['images'][$i]; ?>.jpg'/></a></li>
								<?php
							}
						?>
						</ul>
					</div>
					<?php
				}
			?>
		</div>
		<div class='information'>
			<div class='information_header'>&nbsp;</div>
			<div class='name'><h2><?php echo $product['name']; ?></h2></div>
			<div class='price'><h3><?php echo $product['price'];?> <?php echo $client['currency_name'];?>s</h3></div>
			<div class='collection'>Ref.: <?php echo $product['serial_model_code']; ?></div>
			<div class='table_selector'>
				<h3 style='padding:10px 0px 5px 0px'>Selector de prendas</h3>
				<table style='border-collapse:collapse; background-color:<?php echo $season_color["light"]; ?>'>
					<tr>
						<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"]; ?>; color:#ffffff;'></td>
						<?php
							for($i=0;$i<sizeof($product['sizes']);$i++){
								?>
								<td class='important' style='text-align:center; background-color:<?php echo $season_color["dark"]; ?>; color:#ffffff;padding:2px 5px;''><?php echo $product['sizes'][$i];?></td>
								<?php
							}
						?>
					</tr>
					<?php
						for($color=0;$color<sizeof($product['colors']['code']);$color++){
						?>
							<tr>
							<td class='important' style='text-align:left; background-color:<?php echo $season_color["dark"]; ?>; color:#ffffff; padding:2px 15px;'><?php echo $product['colors']['name'][$color]; ?></td>
							<?php
								for($i=0;$i<sizeof($product['sizes']);$i++){
									?>
									<td><input id='cell_<?php echo $product['colors']['code'][$color]; ?>_<?php echo $i; ?>'onchange="new_data(<?php echo $product['colors']['code'][$color]; ?>,<?php echo $i; ?>,'#cell_<?php echo $product['colors']['code'][$color]; ?>_<?php echo $i; ?>');" value='0' style='border:none; border: 1px solid <?php echo $season_color["light"]; ?>; width:30px; height:25px; text-align:center;margin:0;padding:0;'/></td>
									<?php
								}
							?>
							</tr>
						<?php
						}
					?>
				</table>
			</div>
			<div class='subtotal' style='padding:10px 0px;'>
				<div>
					<h3>Subtotal: <span id='subtotal_amount' class='important'>0</span> <?php echo $client['currency_symbol'];?> ( <span id='subtotal_num' class='important'>0</span> Prendas)</h3>
				</div>
			</div>
				
			<div class='add_to_cart'>
					<div class='likeabutton'><a id="payments_send_step1" href="javascript:void(0);"><span class='text'><?php echo $s["add_to_cart"]?></span></a></div>
			</div>

			<div class='more_info'>
				<div id='more_info_panel'>
					<div class='title'>
						<a href='' class=''>Descripción</a>
					</div>
					<div style='text-align:justify; margin-top:10px; padding:0px 5px 0px 0px:'>
						<?php echo $product['description']; ?>
					</div>
				</div>
			</div>
					
		</div>
	</div>
	
</div>

<script>
	var price = <?php echo $product['price']; ?>;
	var product_list = new Array();
	<?php
		for($color=0;$color<sizeof($product['colors']['code']);$color++){
			?>
			product_list['<?php echo $product['colors']['code'][$color]; ?>']=new Array();
			<?php
			for($i=0;$i<12;$i++){

		?>
			
			product_list['<?php echo $product['colors']['code'][$color]; ?>'][<?php echo $i; ?>]= 0;
		<?php
			}
		}
	?>
	function new_data(id_color,num_size,id){
		if ((!isNaN(parseInt($(id).attr('value'))))&&(parseInt($(id).attr('value'))>=0)){
			
			old_number=product_list[id_color][num_size];
			subtotal=parseInt($('#subtotal_amount').html());
			subtotal_num=parseInt($('#subtotal_num').html())
			subtotal=subtotal-(old_number*price);	
			subtotal_num=subtotal_num-(old_number);	
			product_list[id_color][num_size]=parseInt($(id).attr('value'));
			subtotal=subtotal+(product_list[id_color][num_size]*price);
			subtotal_num=subtotal_num+(product_list[id_color][num_size]);
			$('#subtotal_amount').html(subtotal);
			$('#subtotal_num').html(subtotal_num);
			$(id).attr('value',product_list[id_color][num_size]);
		}else{
			$(id).attr('value',product_list[id_color][num_size]);
		}

	}
</script>


<div id='zoom_window' style='display:none;'>
		<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:absolute;top:0;left:0;'>
			
		</div>
		<div class='window' style='background-color:#ffffff; border:3px solid <?php echo $season_color["light"]; ?>; position:absolute; top:100px; width:600px; padding:20px; z-index:910;'>
			<div class='close_button' style='float:right;'>
				<a id="close_button" href="javascript:void(0);" style='display:block; overflow: hidden;background:url("./img/interface/close_button.png");background-position:-8px -7px;'><?php echo $s["close"]; ?></a>
			</div>
			<div class='contentbox'>
				<div class='image_zoom' style='text-align:center;'>
					<img id='zoom_image' src='./products/models/<?php echo $product['images'][0]; ?>.jpg'/>
				</div>
				
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function (){
				
			$('.image_link').click(function(){
				$('#zoom_image').attr('src',$(this).attr('src'))
				$('#zoom_window').css('display','block');
			});
		
			center= parseInt($(window).width()/2)-320;
			$('.window').css('left',center);
			$(window).resize(function() {
				center= parseInt($(window).width()/2)-320;
				$('.window').css('left',center);
			});
			$('#close_button').click(function() {
				$('#zoom_window').css('display','none');
			});
		});
	</script>
<?php
include("footer.php");
?>