<?php
//Lang revisado
@session_start();

include_once("./include/inbd.php");
$page = "add_return";
include ("header.php");


$table="returns";
$filter=array();
$filter["id_return"]=array("operation"=>"=","value"=>$_GET["id_return"]);
$return=getInBD($table,$filter);
?>
<div id='content'>
	<div class='contentbox'>
		<div style='text-align:center;'>
			<div style='margin-bottom:20px;border: 1px solid orange;background-color: #fff4d4;padding:10px;width:500px;margin:auto;color:orange'>
				<i class='fa fa-exclamation-circle fa-3x'></i>
				<h1 style='margin:10px 0px;color:orange;font-size:20px;'><?php echo $s["important"];?></h1>
				<p style='color:orange;'><?php echo $s["print_label_info"];?></p>
			</div>
			<p style='margin:30px;'><img src='./img/box.png'/></p>
			<a href='javascript:print_return_label()' class='btn btn-dark'><?php echo $s["print_shipping_label"];?></a>
			<a href='./show_details.php?id_order=<?php echo $return["id_order"];?>' class='btn btn-dark'><?php echo $s["close"];?></a>
		</div>
	</div>
</div>
<script>
	function print_return(){
	
	}
	function print_return_label(){
		open("print_return_label.php?code=<?php echo strtoupper(dechex($return["created"]));?>","_blank");
	}


</script>


<?php
include ("footer.php");
?>