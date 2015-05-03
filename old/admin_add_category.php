<?php
//Lang revisado
/*
 Login ADMIN
 ------
 Decripción
 */
@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}
include_once("include/inbd.php");


if(isset($_POST["id_category"])){
	$table="categories";
	$filter=array();
	$filter["id_category"] = array("operation"=>"=","value"=>$_POST["id_category"]);
	$data["name_es"] = $_POST["name_es"];
	$data["name_en"] = $_POST["name_en"];
	$data["id_client_group"] = $_POST["id_client_group"];
	$data["type"] = $_POST["type"];
	$data["position"] = $_POST["position"];
	$data["show_in_menu"] = 0;
	if(isset($_POST["show_in_menu"])){
		$data["show_in_menu"] = 1;
	}
	$data["main_category"] = 0;
	if(isset($_POST["main_category"])){
		$data["main_category"] = 1;
	}
	$data["display_two_images"] = 0;
	if(isset($_POST["display_two_images"])){
		$data["display_two_images"] = 1;
	}
	$data["table_order"] = $_POST["table_order"];
	$data["products_per_row"] = $_POST["products_per_row"];
	updateInBD($table,$filter,$data);
	header('location:./admin_list_categories.php');
	die();
}else if(isset($_POST["name_es"])){
	$table="categories";
	$data["name_es"] = $_POST["name_es"];
	$data["name_en"] = $_POST["name_en"];
	$data["id_client_group"] = $_POST["id_client_group"];
	$data["type"] = $_POST["type"];
	$data["position"] = $_POST["position"];
	$data["main_category"] = 0;
	if(isset($_POST["show_in_menu"])){
		$data["show_in_menu"] = 1;
	}
	if(isset($_POST["main_category"])){
		$data["main_category"] = 1;
	}
	$data["display_two_images"] = 0;
	if(isset($_POST["display_two_images"])){
		$data["display_two_images"] = 1;
	}
	$data["table_order"] = $_POST["table_order"];
	$data["products_per_row"] = $_POST["products_per_row"];

	addInBD($table,$data);
	header('location:./admin_list_categories.php');
	die();
} else if(isset($_GET["id_category"])){
	$table="categories";
	$filter=array();
	$filter["id_category"] = array("operation"=>"=","value"=>$_GET["id_category"]);
	$category_tmp=getInBD($table,$filter);
} else {
	$category_tmp["type"] = "";
	$category_tmp["name_es"] = "";
	$category_tmp["name_en"] = "";
	$category_tmp["id_client_group"] = "";
	$category_tmp["position"] = "";
	$category_tmp["products_per_row"] = 3;
}
$page = "admin";
include ("header.php");
?>
<div id='content'>
	<div class='contentbox'>
		<h3>Categoría</h3>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_add_category.php" method="post">
				<div class='form_entry'>
					<span class='label'>Grupo de usuarios</span>
					<select name='id_client_group' id='id_client_group'>
						<option value='0'>Todos los usuarios</option>
						<?php
							$table='client_groups';
							$client_groups =listInBD($table);
							foreach($client_groups as $key=>$client_group){
								?>
								<option value='<?php echo $client_group["id_client_group"];?>' <?php if($category_tmp["id_client_group"]==$client_group["id_client_group"]) echo "selected";?>><?php echo $client_group["name"];?></option>
								<?php		
							}
						?>
					</select>
				</div>
				<div class='form_entry'>
					<span class='label'>Tipo de Categoría</span>
					<select name='type' id='type'>
						<option value='normal' <?php if($category_tmp["type"]=="normal") echo "selected";?>>Categoría Normal</option>
						<option value='my_favorites' <?php if($category_tmp["type"]=="my_favorites") echo "selected";?>>Mis Favoritos</option>
					</select>
				</div>
				<div class='form_entry'>
					<span class='label'>Nombre Castellano</span>
					<input  name="name_es" id="name_es" class='text' type='text' value='<?php echo $category_tmp["name_es"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Nombre Inglés</span>
					<input  name="name_en" id="name_en" class='text' type='text' value='<?php echo $category_tmp["name_en"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Posición en el menú</span>
					<input  name="position" id="position" class='text' type='text' value='<?php echo $category_tmp["position"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Opciones</span>
					<div style='margin:5px 10px'>
						<input  name="show_in_menu" id="show_in_menu" type='checkbox' <?php if($category_tmp["show_in_menu"]==1) echo "checked";?>/> Mostar en menú
					</div>
					<div style='margin:5px 10px'>
						<input  name="main_category" id="main_category" type='checkbox' <?php if($category_tmp["main_category"]==1) echo "checked";?>/> Categoría Principal
					</div>
					<div style='margin:5px 10px'>
						<input  name="display_two_images" id="display_two_images" type='checkbox' <?php if($category_tmp["display_two_images"]==1) echo "checked";?>/> Mostrar Productos con cambio de imagen
					</div>
				</div>
				<div class='form_entry'>
					<span class='label'>Ordenación de tabla (Ej.: product_position asc, season_winter asc, season_year desc, serial_model_code desc)</span>
					<input  name="table_order" id="table_order" class='text' type='text' value='<?php echo $category_tmp["table_order"]; ?>' autocomplete="off"/>
				</div>
				<div class='form_entry'>
					<span class='label'>Número de productos por fila</span>
					<select name='products_per_row' id='products_per_row'>
						<?php
							for($i=1;$i<=5;$i++){
								?>
								<option value='<?php echo $i;?>' <?php if($i==$category_tmp["products_per_row"]) echo "selected";?>><?php echo $i;?></option>
								<?php
							}
						?>
					</select>
				</div>
				<?php
				if(isset($_GET["id_category"])){
					?>
					<input  name="id_category" id="id_category" type='hidden' value='<?php echo $category_tmp["id_category"]; ?>'/>

					<?php
				} 
				?>
				<div class='form_submit'>
					<input class='btn btn-black' type='submit' value='<?php echo $s["accept"]?>'/>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>