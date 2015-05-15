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
$page = "admin";
include ("header.php");
include_once("include/inbd.php");


?>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div id='page_header'>
		<div id='page_navigator'>
			<a href='./admin_menu.php'><?php echo $s["admin_menu_title"];?></a> / <a href='#' class='important'><?php echo $s["admin_users"] ?></a>
		</div>
	</div>
	<div class='contentbox'>

    <h3><a href='./admin_menu.php'>Admin</a> / Listado de Posts</h3>

		<div style='padding-top:10px;'>
			<?php
			$table='posts';
			$filter=array();
			$fields=array();
			$table_order = "created asc";
      $posts = listInBD($table,$filter,$fields,$table_order);
			?>
			<table class='data_table'>
			<a href='./admin_add_post.php' class='pull-right btn btn-mini btn-dark'>Añadir Post</a>
			<tr class='filter_options'>
				<td colspan="8">
					<div class='form_entry'>
						<input id="searchbox" class='text' type='text' value='<?php echo $s["search.."]; ?>'/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="10">
					<table id="list_clients" class="data_table">
						<thead>
						<tr>
						<th class='client_icon_data' style='width:5%;'></th>
						<th class='client_small_data ' style='width:30%;text-align:left;'>Titulo</th>
						<th class='client_medium_data ' style='width:20%;text-align:left;'>Creación</th>
						<th class=' ' style='width:5%;'></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($posts as $key=>$post){
							?>
							<tr id='<?php echo $post["id_post"];?>' class='clickable'>
								<td style='padding:5px;'><a href='./admin_add_post.php?id_post=<?php echo $post["id_post"]; ?>' class='btn btn-white btn-mini '>Editar</a></td>
								<td class='' style='padding:10px;'><?php echo substr($post["title"],0, 75);?></td>

								<td class='' style='padding:10px;'><?php echo date("Y-m-d",$post["created"]);?></td>
								<td style='padding:10px;'><a class='btn btn-danger btn-mini' href='javascript:delete_post("<?php echo $post["id_post"];?>")'>Eliminar</a></td>
							</tr>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<tr class='general_options'>
				<td></td>
			</tr>
			</table>
		</div>
		<script>
			function delete_post(id_post){
				if(confirm("Desea borrar este post. Esta operación no podrá deshacerse")){

					$.ajax({
						type : "POST",
            dataType: 'json',
						url : "../server/blog/model/posts/model.php",
						data : {
              "action" : "delete_post",
              "id_post" : id_post
						},
						success : function(response) {
							if(response.result){
								$('#'+id_post).css('display','none');
							}else{
                alert("Ha ocurrido un error y no se ha podido realizar la operación");
              }
						}
					});
				}
			}
			$(document).ready(function() {
				$("#searchbox").click(function() {
					if($("#searchbox").val() == "<?php echo $s["search.."]; ?>")
						$("#searchbox").val("");
				})
				$("#searchbox").keyup(function() {
					tlistado.fnFilter($("#searchbox").val());
				})
				tlistado = $('#list_clients').dataTable({
					"bPaginate" : true,
					"iDisplayLength": 20,
					"bLengthChange" : false,
					"bFilter" : true,
					"bSort" : true,
					"bInfo" : false,
					"bAutoWidth" : false,
					"sPaginationType" : "full_numbers",
					"sDom" : '<"top"p>rt<"bottom"><"clear">',
					"oLanguage" : {
						"oPaginate" : {
							"sPrevious" : "Anterior",
							"sNext" : "Siguiente",
							"sFirst" : "Primera Página",
							"sLast" : "Última Página"
						}
					}
				});

			});
		</script>
	</div>
</div>
<?php
include ("footer.php");
?>
