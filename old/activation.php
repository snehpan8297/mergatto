<?php 
$page="company";
include("header.php");
$activation="fail";
if (isset($_GET["email"])&&isset($_GET["key"])){
	if(activation($_GET["email"],$_GET["key"])==1){
		$activation = "success";
	}else{
		$activation = "fail";
	}
}
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['client_activation_'.$activation]; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info'>
			<?php echo $s["client_activation_moreinfo_".$activation]; ?>
		</div>
		<?php if($activation!="fail") { ?>
			<div class='likeabutton' style='float:left;'><a href="./my_personaledit.php?action=new"><span class='text'><span class='left_decoration'></span><?php echo $s["next"]?></span><span class='right_decoration'></span></a></div>
		<?php } ?>
	</div>
</div>
<?php
include("footer.php");
?>