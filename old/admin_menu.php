<?php
//Lang revisado
/*
	Login ADMIN
	------
	Decripción

*/
@session_start();

if (!(isset($_SESSION['admin_classics']))){
	header("location:./admin.php");
}
$page="admin";
include("header.php");
include_once("include/inbd.php");
$table='returns';
$filter=array();
$filter["status"]=array("operation"=>"=","value"=>1);
$returns_num=countInBD($table,$filter);
$returns_num_str="";
if($returns_num>0){
	if($returns_num==1){
		$returns_num_str="<span class='or_badge or_badge-warning'>".$returns_num." Nueva</span>";
	}else{
		$returns_num_str="<span class='or_badge or_badge-warning'>".$returns_num." Nuevas</span>";
	}
}
$filter=array();
$filter["status"]=array("operation"=>"=","value"=>2);
$returns_num=countInBD($table,$filter);
if($returns_num>0){
	$returns_num_str.=" <span class='or_badge or_badge-info'>".$returns_num." Recogiendo</span>";
}
$filter=array();
$filter["status"]=array("operation"=>"=","value"=>3);
$returns_num=countInBD($table,$filter);
if($returns_num>0){
	if($returns_num==1){
		$returns_num_str.=" <span class='or_badge or_badge-success'>".$returns_num." Verificada</span>";
	}else{
		$returns_num_str.=" <span class='or_badge or_badge-success'>".$returns_num." Verificadas</span>";
	}
}

$table='order_request';
$filter=array();
$filter["order_state"]=array("operation"=>"=","value"=>0);
$orders_list=listInBD($table,$filter);
$new_order_elastic_user=0;
$new_order_not_elastic_user=0;
foreach($orders_list as $key=>$order){
	$table='clients';
	$filter=array();
	$filter["id_client"]=array("operation"=>"=","value"=>$order["id_client"]);
	$client_tmp=getInBD($table,$filter);
	if($client_tmp["id_elastic"]==0){
		$new_order_not_elastic_user++;
	}else{
		$new_order_elastic_user++;
	}
}

if($new_order_not_elastic_user>0){
	$new_order_not_elastic_user_str=" <span class='or_badge or_badge-warning'>".$new_order_not_elastic_user." Nuevos</span>";
}
if($new_order_elastic_user>0){
	$new_order_elastic_user_str=" <span class='or_badge or_badge-success'>".$new_order_elastic_user." Nuevos</span>";
}
//Carga datos de nuevas entradas
$res=listPendingOrders();
$orders_num=db_count($res);
if($orders_num>0){
	$orders_num_str=" <span class='or_badge or_badge-warning'>".$orders_num." Nuevos</span>";
}
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='#' class='important'><?php echo $s["admin_menu_title"]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div>
			<div class='form_entry'>
				<span class='label'><h3>Blog</h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_posts.php'>Listar Posts</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_add_post.php'>Añadir Post</a></span>
			</div>



			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["users"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_mmorpg.php'>Actividad en tiempo Real</a></span>
			</div>

			<div class='form_entry'>
				<span class='label'><a href='./admin_list_users.php'><?php echo $s["admin_users"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_add_user.php'><?php echo $s["add_user"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_passwd_change.php'><?php echo $s["admin_passwd_change"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_groups.php'>Administrar Grupos</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["orders"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_orders.php'><?php echo $s["admin_orders"].$new_order_not_elastic_user_str." ".$new_order_elastic_user_str;?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_returns.php'>Administrar Devoluciones <?php echo $returns_num_str;?></a></span>
			</div>
			<!--<div class='form_entry'>
				<span class='label'><a target="_black" href='./promo_emails.php'>BLACK FRIDAY enviar cupones (automático)</a></span>
			</div>-->
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["products"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_products.php'><?php echo $s["admin_products"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_new_product.php?action=add'><?php echo $s["add_products"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./select_to_import.php'><?php echo $s["admin_import_new_stock"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./export_stock.php'>Exportar Stock</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3>Categorías, Familias y Subfamilias</h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_categories.php'>Administrar Categorías</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_subfamily.php'>Listar Subfamilias</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_add_subfamily.php'>Añadir Subfamilia</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3>Códigos Promocionales</h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_promo_codes.php'>Listar Códigos Promocionales</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_add_promo_code.php'>Añadir Código Promocional</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["ship_methods"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_list_ship.php'><?php echo $s["admin_ship_methods"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_add_ship.php'><?php echo $s["add_ship_method"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3><?php echo $s["system_config"]; ?></h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_general_config.php'><?php echo $s["general_config"]; ?></a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_index_config.php'>Portada</a> | <a href='./admin_cover_config.php'>Ventana emergente</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3>NewsLetters</h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_send_email_test.php'>Newsletter Pruebas</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_send_email.php?news_lang=es'>Newsletter Activos Castellano</a> | <a href='./admin_send_email.php?news_lang=en'>Newsletter Activos Inglés</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><a href='./admin_send_email_no_active.php'>Newsletter No Activos</a></span>
			</div>
			<div class='form_entry'>
				<span class='label'><h3>Puntos de Venta</h3></span>
			</div>
			<div class='form_entry'>
				<span class='label'>(Clave: 1231sa) <a target="_blank" href='http://www.okycoky.net/?page_id=1485'>España</a> | <a target="_blank" href='http://www.okycoky.net/?page_id=2120'>Portugal</a> | <a target="_blank" href='http://www.okycoky.net/?page_id=2122'>UK</a> | <a target="_blank" href='http://www.okycoky.net/?page_id=2112'>Bélgica</a> | <a target="_blank" href='http://www.okycoky.net/?page_id=2116'>Irlanda</a> | <a target="_blank" href='http://www.okycoky.net/?page_id=2124'>Otros</a></span>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
