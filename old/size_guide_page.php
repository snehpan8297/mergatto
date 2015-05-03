<?php 
$page="company";
include("header.php");
$shippings = getShipping(0,$lang);
?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['shipping']; ?></a></div>
	</div>
	<div class='contentbox'>
		<h3><?php echo $s["size_conversion"]; ?></h3>
		<table class='sizes_table'>
			<tr>
				<th>
				</th>
				<th>
					XXS
				</th>
				<th>
					XS
				</th>
				<th>
					S
				</th>
				<th>
					M
				</th>
				<th>
					L
				</th>
				<th>
					XL
				</th>
				<th>
					XXL
				</th>
				<th>
					XXXL
				</th>
			</tr>
			<TR>
				<td class='first'>
					<?php echo $s["spain"];?>
				</td>
				<td>
					34
				</td>
				<td>
					36
				</td>
				<td>
					38
				</td>
				<td>
					40
				</td>
				<td>
					42
				</td>
				<td>
					44
				</td>
				<td>
					46
				</td>
				<td>
					48
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["france"];?>
				</td>
				<td>
					34
				</td>
				<td>
					36
				</td>
				<td>
					38
				</td>
				<td>
					40
				</td>
				<td>
					42
				</td>
				<td>
					44
				</td>
				<td>
					46
				</td>
				<td>
					48
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["uk"];?>
				</td>
				<td>
					6
				</td>
				<td>
					8
				</td>
				<td>
					10
				</td>
				<td>
					12
				</td>
				<td>
					14
				</td>
				<td>
					16
				</td>
				<td>
					18
				</td>
				<td>
					20
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["italy"];?>
				</td>
				<td>
					38
				</td>
				<td>
					40
				</td>
				<td>
					42
				</td>
				<td>
					44
				</td>
				<td>
					46
				</td>
				<td>
					48
				</td>
				<td>
					50
				</td>
				<td>
					52
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["usa"];?>
				</td>
				<td>
					2
				</td>
				<td>
					4
				</td>
				<td>
					6
				</td>
				<td>
					8
				</td>
				<td>
					10
				</td>
				<td>
					12
				</td>
				<td>
					14
				</td>
				<td>
					16
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["japan"];?>
				</td>
				<td>
					5
				</td>
				<td>
					7
				</td>
				<td>
					9
				</td>
				<td>
					11
				</td>
				<td>
					13
				</td>
				<td>
					15
				</td>
				<td>
					17
				</td>
				<td>
					19
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["denmark"];?>
				</td>
				<td>
					32
				</td>
				<td>
					34
				</td>
				<td>
					36
				</td>
				<td>
					38
				</td>
				<td>
					40
				</td>
				<td>
					42
				</td>
				<td>
					44
				</td>
				<td>
					46
				</td>
			</tr>
			<tr>
				<td class='first'>
					<?php echo $s["australia"];?>
				</td>
				<td>
					6
				</td>
				<td>
					8
				</td>
				<td>
					10
				</td>
				<td>
					12
				</td>
				<td>
					14
				</td>
				<td>
					16
				</td>
				<td>
					18
				</td>
				<td>
					20
				</td>
			</tr>
			<tr>
			</TR>
		</table>
		<br/>
		<h3><?php echo $s["measure_table"]; ?></h3>
		<table class='sizes_table'>
			<tr>
				<th>
					<?php echo $s["sizes"]; ?>
				</th>
				<th>
					<?php echo $s["chest"]; ?>
				</th>
				<th>
					<?php echo $s["waist"]; ?>
				</th>
				<th>
					<?php echo $s["hips"]; ?>
				</th>
			</tr>
			<tr>
				<td class='first'>
					34
				</td>
				<td>
					84 cm.
				</td>
				<td>
					62 cm.
				</td>
				<td>
					88 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					36
				</td>
				<td>
					88 cm.
				</td>
				<td>
					66 cm.
				</td>
				<td>
					91 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					38
				</td>
				<td>
					92 cm.
				</td>
				<td>
					70 cm.
				</td>
				<td>
					96 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					40
				</td>
				<td>
					96 cm.
				</td>
				<td>
					74 cm.
				</td>
				<td>
					100 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					42
				</td>
				<td>
					100 cm.
				</td>
				<td>
					78 cm.
				</td>
				<td>
					104 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					44
				</td>
				<td>
					104 cm.
				</td>
				<td>
					82 cm.
				</td>
				<td>
					108 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					46
				</td>
				<td>
					108 cm.
				</td>
				<td>
					86 cm.
				</td>
				<td>
					112 cm.
				</td>
			</tr>
			<tr>
				<td class='first'>
					48
				</td>
				<td>
					112 cm.
				</td>
				<td>
					90 cm.
				</td>
				<td>
					116 cm.
				</td>
			</tr>
		</table>

	</div>
</div>
<?php
include("footer.php");
?>