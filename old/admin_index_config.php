<?php
/*


Versión: 1.0.2

*/

@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
include_once ("include/inbd.php");
if(isset($_POST["id"])){
	$table="config";
	$filter=array();
	$filter["id"]=array("operation"=>"=","value"=>$_POST["id"]);
	unset($_POST["id"]);
	$data=$_POST;
	updateInBD($table,$filter,$data);
}
$page = "admin";
include ("header.php");
?>
<div id='content'>
	<div id='line_separator'> &nbsp; </div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'>Newsletter Activos</a>
		</div>
	</div>
	<div class='contentbox'>
		<script src="./js/tinymce/tinymce.min.js"></script>
		<script>
        	tinymce.init({
				selector: 'textarea',
				plugins: [
						    "advlist autolink lists link image charmap print preview anchor",
						    "searchreplace visualblocks code fullscreen",
						    "insertdatetime media table contextmenu paste jbimages"
						  ],
  				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
  				relative_urls: false

  			});
  		</script>
		
  		

		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_index_config.php" method="post" autocomplete='off'>
				<div class='form_entry'>
					<span class='label'>Tipo de Portada
					<select id='index_type' name='index_type'>
						<option value='products' <?php if($config["index_type"]=="products") echo "selected";?>>Productos Destacados</option>
						<option value='html' <?php if($config["index_type"]=="html") echo "selected";?>>Página Web</option>
					</select>
				</div>
				<div class='form_entry'>
					<span class='label'>Castellano</span><textarea  name="html_es" id="html_es" class='text' value=''><?php echo $config["html_es"];?></textarea>
				</div>
				<div class='form_entry'>
					<span class='label'>Inglés</span><textarea  name="html_en" id="html_en" class='text' value=''><?php echo $config["html_en"];?></textarea>
				</div>
				<input type='hidden' name='id' id='id' value='<?php echo $config["id"];?>'/>
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='submit' value='<?php echo $s["accept"]?>'/></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include ("footer.php");
?>