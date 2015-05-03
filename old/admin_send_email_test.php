<?php
/*


Versión: 1.0.2

*/

@session_start();
if(!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}
$send_email=2;
$user_type="new";
include_once("include/users.php");
if(isset($_POST["title"])){
	$send_email=1;
	$i=0;
	$content=nl2br($_POST["mail_content"]);
	$sustituye = array("\r\n", "\n\r", "\n", "\r");
    $content = str_replace($sustituye, "", $content);  
	
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
		<?php
			if($send_email==1){
				?>
				<div id='infobox_header' class='infobox_info'>
					<center><h3>Enviando Emails</h3></center>
					<center><span id='info'>0 / xx</span></center>
					
				</div>
				<?php
			}else{
				?>
				<script src="./js/tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({
        selector: 'textarea',
plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"
  ],     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
    relative_urls: false

    });
</script>
		<div id='infobox_header' class='infobox_info'>
			<?php echo $s["send_email_moreinfo"];?>
		</div>
		<div class='form' id="signup_step_1" style="display:block">
			<form id='step_1' action="./admin_send_email_test.php?news_lang=<?php echo $_GET["news_lang"];?>" method="post" autocomplete='off'>
				<div class='form_entry'>
					<span class='label'><?php echo $s["email"];?> <span class='form_isrequired'>*</span></span><input  name="email" id="email" class='text' type='text' value=''/>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["title"];?> <span class='form_isrequired'>*</span></span><input  name="title" id="title" class='text' type='text' value=''/>
					<span id="signup_client_code_alert" class='form_entry_alert'></span>
				</div>
				<div class='form_entry'>
					<span class='label'><?php echo $s["content"]?> <span class='form_isrequired'>*</span></span><textarea  name="mail_content" id="mail_content" class='text' value=''></textarea>
				</div>
				
				<div class='form_submit'>
					<div class='likeabutton'><input id="signup_send_step_1" type='submit' value='<?php echo $s["accept"]?>'/></div>
				</div>
			</form>
			<iframe id="form_target" name="form_target" style="display:none"></iframe>

<form id="my_form" action="/classics/news/upload.php" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden"><input name="image" type="file" onchange="$('#my_form').submit();this.value='';"></form>
		</div>
		<?php } ?>
	</div>
</div>
<?php
	if($send_email==1){
	?>
	<script>
		var	emails=new Array();
		
		$("#info").html("0 / 1")
		$(document).ready(function(){
				$.ajax({
					type : "POST",
					url : "./functions/sendemails.php",
					data : {
						"email" :  "<?php echo $_POST["email"];?>",
						"title" : "<?php echo $_POST["title"];?>",
						"content" : '<?php echo $content;?>',
					},
					success : function(msg) {
						if(msg == "OK") {
							i_str=i+1;
							$("#info").html(i_str+" / <?php echo $i;?>");
							if(i_str><?php echo $i;?>){
								$("#info").html("Completado");
							}
						}
					}
				});
				
			

		});
	</script>
	<?php
	}
include ("footer.php");
?>