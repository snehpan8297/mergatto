<?php
//Lang revisado
$accesories_families=array(26,29,41,46,47,48,49,50,51,57,58);
$no_clothes=array(26,29,41,46,47,48,49,50,51,57,58,33);
?>
	<div id='menu'>
		
		<?php
			
			include_once("include/inbd.php");
			
			$table='categories';
			$filter=array();
			$filter["main_category"]=array("operation"=>"=","value"=>1);
			$category=getInBD($table,$filter);
			
			$category_list_display=$category["id_category"];
			if(isset($_GET["c"])){
				$category_list_display=$_GET["c"];
			}
			
			$table='categories';
			$filter=array();
			if((isset($userdata['name']))&&(!empty($userdata['name']))){
				$filter["show_in_menu"] = array("operation"=>"=","value"=>1);
				$filter["complex"] = "id_client_group=0 or id_client_group=".$userdata["id_client_group"];
			}else{
				$filter["show_in_menu"] = array("operation"=>"=","value"=>1);
				$filter["id_client_group"] = array("operation"=>"=","value"=>0);
			}
			if(isset($_SESSION['admin_classics'])){
				$filter=array();
			}
			$fields=array();
			$table_order="position asc";
			$categories=listInBD($table,$filter,$fields,$table_order);
			foreach($categories as $key=>$category){
				$table="product_categories";
				$filter=array();
				$filter["id_category"]=array("operation"=>"=","value"=>$category["id_category"]);
				$product_categories=listInBD($table,$filter);
				$complex='false';
				foreach($product_categories as $key => $product_category){
					$complex.=" or id_product='".$product_category["id_product"]."'";
				}
				
				$table="products";
				$filter=array();
				$filter["complex"]=$complex;
				$filter["visible"]=array("operation"=>"=","value"=>1);
				$fields="";
				$table_order="";
				$group_by="id_family";
				$families=listInBD($table,$filter,$fields,$table_order,$group_by);
				?>
				<div id='menu_item' class='title'>
					<?php
					if(sizeof($families)>1){
						?>
						<h3>
							<?php
								$category["name_vector"]=explode("[BR]", $category["name_".$lang]);
								$category["name_".$lang]=$category["name_vector"][0];
								if (isset($category["name_vector"][1])){
									$category["name_".$lang].="<span class='or_badge or_badge-important'>".$category["name_vector"][1]."</span>";
								}
								$category["name_vector"]=explode("[R]", $category["name_".$lang]);
								if (isset($category["name_vector"][1])){
									$category["name_".$lang]="<span style='color:red'>".$category["name_vector"][1]."</span>";
								}
								$category["name_vector"]=explode("[B]", $category["name_".$lang]);
								if (isset($category["name_vector"][1])){
									$category["name_".$lang]="<b style='font-weight:500'>".$category["name_vector"][1]."</b>";
								}
							/*
							<a href='javascript:show_panel("<?php echo $category["id_category"];?>")' id='<?php echo $category["id_category"];?>' class='button_category'><?php echo $category["name_".$lang];?>
							*/

							?>
							<a href='./list.php?c=<?php echo $category["id_category"];?>' id='<?php echo $category["id_category"];?>' class='button_category'><?php echo $category["name_".$lang];?>
						<?php
						if($category["show_num_clothes"]==1){
							 if($category["type"]=="my_favorites"){
								$table="client_favorites";
								$filter=array();
								$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
								$client_favorites=listInBD($table,$filter);
								$table="products";
								$filter=array();
								$filter["complex"] = "";
								$or="";
								$fields=array("id_product","name_en","name_es","serial_model_code","use_discount","pvp","discount");
								$table_order = $category["table_order"];
								foreach ($client_favorites as $key => $client_favorite){
									$filter["complex"] .= $or."id_product = ".$client_favorite["id_product"];
									$or=" or ";
								}
								if($filter["complex"]==""){
									$filter["complex"]="false";
								}
								$num_products=countInBD($table,$filter);
								if($num_products>0){
									echo "".$num_products."";
								}
							}
						}
						?></a></h3>
						<?php
					}else{
								$category["name_vector"]=explode("[BR]", $category["name_".$lang]);
								$category["name_".$lang]=$category["name_vector"][0];
								if (isset($category["name_vector"][1])){
									$category["name_".$lang].="<span class='or_badge or_badge-important'>".$category["name_vector"][1]."</span>";
								}
							?>

						<h3><a href='./list.php?c=<?php echo $category["id_category"];?>' id='<?php echo $category["id_category"];?>' class='button_category'><?php echo $category["name_".$lang];?>
						<?php
						if($category["show_num_clothes"]==1){
							 if(($category["type"]=="my_favorites")&&(isset($_SESSION['user_classics']['id_client']))){
								$table="client_favorites";
								$filter=array();
								$filter["id_client"]=array("operation"=>"=","value"=>$_SESSION['user_classics']['id_client']);
								$client_favorites=listInBD($table,$filter);
								$table="products";
								$filter=array();
								$filter["complex"] = "";
								$or="";
								$fields=array("id_product","name_en","name_es","serial_model_code","use_discount","pvp","discount");
								$table_order = $category["table_order"];
								foreach ($client_favorites as $key => $client_favorite){
									$filter["complex"] .= $or."id_product = ".$client_favorite["id_product"];
									$or=" or ";
								}
								if($filter["complex"]==""){
									$filter["complex"]="false";
								}
								$num_products=countInBD($table,$filter);
								if($num_products>0){
									echo "<span class='or_badge or_badge_left_menu'>".$num_products."</span>";
								}
							}
						}
						?></a></h3>
						<?php
					}
					?>
				</div>
				<div id='menu_item'  class='list panel_main_season'>
					<ul id='category_list_<?php echo $category["id_category"];?>' class='category_list' <?php if($category_list_display!=$category["id_category"]) echo "style='display:none'"?>>
						<?php
							

							if(sizeof($families)>1){
								?>
						<li><a href='list.php?c=<?php echo $category["id_category"];?>' class='menu_subtitle'><?php echo $s["family_all_visible"]; ?></a></li>

								<?php
								$complex="";
								$or="";
								foreach ($families as $key=>$category_family){
									$complex.=$or." id_family=".$category_family["id_family"];
									$or=" or ";
								}
								$table="family";
								$filter=array();	
								$filter["complex"]=$complex;
								$fields=array();
								$table_order="name";
								$families=listInBD($table,$filter,$fields,$table_order);
								foreach ($families as $key=>$category_family){
									?>
						<li><a href='list.php?c=<?php echo $category["id_category"];?>&f=<?php echo $category_family["id_family"];?>' class='menu_subtitle'><?php echo $s["family_".$category_family["id_family"]];?></a></li>

									<ul <?php if((!isset($_GET["f"]))||(($category_family["id_family"]!=$_GET["f"]))) echo "style='display:none'";?>>
									<?php
									
									$table="subfamily";
									$filter=array();	
									$filter["id_family"]=array("operation"=>"=","value"=>$category_family["id_family"]);
									$fields=array();
									$table_order="name_".$lang;
									$family_subfamilies=listInBD($table,$filter,$fields,$table_order);
									foreach ($family_subfamilies as $key=> $family_subfamily){
										?>
										<li style='padding-left:35px;'><a style='font-size:11px;'href='list.php?c=<?php echo $category["id_category"];?>&f=<?php echo $category_family["id_family"];?>&sf=<?php echo $family_subfamily["id_subfamily"];?>' class='menu_subtitle'><?php echo $family_subfamily["name_".$lang];?></a></li>
										<?php	
									}
									?>
									</ul>
									<?php
								}
							}
						?>
					</ul>
				</div>
				<?php
			}
			
			
		?>
		
		<!--<div id='menu_item' class='title'>
			<h3><a href='javascript:show_panel("sizes")' id='button_sizes'><?php echo $s["sizes"]; ?></a></h3>
		</div>
		<div id='menu_item' class='list panel_sizes'>
			<ul id='category_list_sizes' class='category_list' style='display:none'>
				<?php
				for($i=1;$i<=10;$i++){
					echo "<li><a href='list.php?t=".$i."' class='menu_subtitle'>".$s["size"]." ".$s["sizes_".$i]."</a></li>";
				}
				?>
				
			</ul>
		</div>-->
		
		<div style='padding-top:20px'><a class='' style='margin-left:10px;' href='<?php echo $url_actual.$oldget."&lang=ES"; ?>'><img src='./img/es.png'/></a> <a href='<?php echo $url_actual.$oldget."&lang=EN"; ?>'><img src='./img/en.png'/></a>
		</div>
		<script>
			function show_panel(id_category){
				$(".category_list").slideUp('slow',function(){});
				$("#category_list_"+id_category).slideDown();
			}

			panel_accessories=<?php if($show_accessories){echo "true";}else{echo "false";};?>;
			panel_sizes=<?php if($show_sizes){echo "true";}else{echo "false";};?>;
			panel_main_season=<?php if($show_clothes){echo "true";}else{echo "false";};?>;
			panel_last_season=<?php if($show_last){echo "true";}else{echo "false";};?>;
			
			$(document).ready(function(){
				$('#search_input').click(function(){
					if($('#search_input').attr("value")=="<?php echo $s["search.."];?>"){
						$('#search_input').attr("value","");
					}
				});
				
				$('#button_main_season').click(function(){
					if(panel_main_season==false){
						$(".panel_last_season").slideUp('slow',function(){
							$(".panel_accessories").slideUp('slow',function(){
								$(".panel_sizes").slideUp('slow',function(){
									$(".panel_main_season").slideDown();						
								});				
							});
						});
						panel_main_season=true;
						panel_accessories=false;
						panel_sizes=false;
					}
				});
				$('#button_last_season').click(function(){
					
					if(panel_last_season==false){
						$(".panel_main_season").slideUp('slow',function(){
							$(".panel_accessories").slideUp('slow',function(){
								$(".panel_sizes").slideUp('slow',function(){
									$(".panel_last_season").slideDown();						
								});				
							});
						});
							
						panel_main_season=false;
						panel_accessories=false;
						panel_sizes=false;
					}
				});
				$('#button_accessories').click(function(){
					if(panel_accessories==false){
						$(".panel_last_season").slideUp('slow',function(){
							$(".panel_main_season").slideUp('slow',function(){
								$(".panel_sizes").slideUp('slow',function(){
									$(".panel_accessories").slideDown();						
								});				
							});
						});
						panel_accessories=true;
						panel_main_season=false;
						panel_sizes=false;
					}
				});

			});
		</script>
	<div>
		
</div>
	</div>
