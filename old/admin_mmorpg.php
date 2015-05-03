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
    die();
}
					$last_id=0;

include_once("include/users.php");
$page = "admin";
include ("header.php");
?>
<div id='content'>
	<div id='line_separator'>
		&nbsp;
	</div>
	<div class='contentbox'>
		<h1>Actividad de los Usuarios en tiempo real</h1>
		<div style='margin-top:10px;width:100%;height:500px;border:1px solid #e4e4e4;backgroun-color:#f4f4f4;overflow-y:scroll;overflow-x:hidden'>
			<div style='padding:10px;'>
				<pre id='terminal_mmorpg'><?php
					$table='mmorpg';
					$filter=array();
					$fields=array();
					$order="id_mmorpg desc";
					$group_by="";
					$limit=20;
					$mmorpgs=listInBD($table,$filter,$fields,$order,$group_by,$limit);
					$last_id=0;
					foreach($mmorpgs as $key=>$mmorpg){
						if($last_id==0){
							$last_id=$mmorpg["id_mmorpg"];
						}
						$colors=explode(".", $mmorpg["identification"]);
						$background_color="rgba(".$colors[1].",".$colors[2].",".$colors[3].",1)";
						echo "<span style='color:blue'>[".$mmorpg["time"]."]</span> <span style='color:black;background-color:".$background_color."'>".$mmorpg["identification"]."</span> ".$mmorpg["action"]."
";
					}
				?></pre>
				
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			function update_mmorpg(last_id){
				$.ajax({
					type: "POST",
					url: 'functions/update_mmorpg.php',
					dataType: 'json',
					data: {
						'last_id':last_id
					},
					success: function(response) {
						if(response.result){
							$("#terminal_mmorpg").prepend(response.data.mmorpg_terminal);
							last_id=response.data.last_id;
						}
						update_mmorpg(last_id);

					}

				});
			}
			update_mmorpg(<?php echo $last_id;?>);
		});
	</script>
</div>
<?php
include ("footer.php");
?>