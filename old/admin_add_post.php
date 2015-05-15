
<?php
/*


Versión: 1.0.2

*/

@session_start();
if (!(isset($_SESSION['admin_classics']))) {
    header("location:./admin.php");
}
include_once("include/inbd.php");


if(isset($_POST["id_post"])){
	$table="posts";
	$filter=array();
	$filter["id_post"] = array("operation"=>"=","value"=>$_POST["id_post"]);
  $data=array();
	$data["title"] = $_POST["title"];
	$data["author"] = $_POST["author"];
	$data["header_image"] = $_POST["header_image"];
	$data["header_content"] = $_POST["header_content"];
	$data["content"] = $_POST["content"];
	updateInBD($table,$filter,$data);

	header('location:./admin_list_posts.php');
	die();
}else if(isset($_POST["title"])){
	$table="posts";
  $data=array();
  $data["created"]=strtotime(date("Y-m-d H:i:s"));

  $id_post=addInBD($table,$data);
  $filter=array();
	$filter["id_post"] = array("operation"=>"=","value"=>$id_post);
  $data=array();
  $data["title"] = $_POST["title"];
	$data["author"] = $_POST["author"];
	$data["header_image"] = $_POST["header_image"];
	$data["header_content"] = $_POST["header_content"];
	$data["content"] = $_POST["content"];
  updateInBD($table,$filter,$data);
	header('location:./admin_list_posts.php');
	die();
} else if(isset($_GET["id_post"])){
	$table="posts";
	$filter=array();
	$filter["id_post"] = array("operation"=>"=","value"=>$_GET["id_post"]);
	$post_tmp=getInBD($table,$filter);
} else {
  $post_tmp["title"] = "";
	$post_tmp["author"] = "";
	$post_tmp["header_content"] = "";
	$post_tmp["content"] = "";

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
			<form id='step_1' action="./admin_add_post.php" method="post" autocomplete='off'>
        <div class='form_entry'>
          <span class='label'>Título</span>
          <input  name="title" id="title" class='text' type='text' value='<?php echo $post_tmp["title"]; ?>' autocomplete="off"/>
        </div>
        <div class='form_entry'>
          <span class='label'>Autor</span>
          <input  name="author" id="author" class='text' type='text' value='<?php echo $post_tmp["author"]; ?>' autocomplete="off"/>
        </div>

				<div class='form_entry'>
					<span class='label'>Preview</span><textarea  name="header_content" id="html_es" class='text' value=''><?php echo $post_tmp["header_content"];?></textarea>
				</div>
				<div class='form_entry'>
					<span class='label'>Contenido</span><textarea  name="content" class='text' value=''><?php echo $post_tmp["content"];?></textarea>
				</div>
        <?php
				if(isset($_GET["id_post"])){
					?>
					<input  name="id_post" type='hidden' value='<?php echo $post_tmp["id_post"]; ?>'/>

					<?php
				}
				?>
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
