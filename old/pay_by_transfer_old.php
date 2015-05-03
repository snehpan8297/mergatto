<?php 
$page="company";
include("header.php");


?>
<div id='content'>
	<div id='line_separator'>&nbsp;</div>
	<div id='page_header'>
		<div id='page_navigator'><a href='' class='important'><?php echo $s['pay_by_transfer']; ?></a></div>
	</div>
	<div class='contentbox'>
		<div class='infobox_info'>
			<?php echo $s["bank_transfer_moreinfo"];?>
			<table style='margin:auto;border:1px solid #ccc;padding:20px;background:#fff;font-size:14px;'>
				<tr>
					<td style='text-align:center;padding-bottom:10px;' colspan='2'><b><?php echo $s["bank_transfer_data"];?></b></td>
				</tr>
				<tr>
					<td style='text-align:right;'><b><?php echo $s["bank"];?></b></td>
					<td style=''>La Caixa, Caja de Ahorros y Pensiones de Barcelona</td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["swift"];?>SWIFT</b></td>
					<td>CAIXESBB</td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["iban"];?></b></td>
					<td>ES7021002178030200148419</td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["account_number"];?></b></td>
					<td>2100 2178 03 0200148419</td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["account_owner"];?></b></td>
					<td>ROTELPA, S.A ('Fashion Retail')</td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["concept"];?></b></td>
					<td><?php echo $s["order"];?> <?php echo $_POST["order"];?> </td>
				</tr>
				<tr>
					<td style='text-align:right'><b><?php echo $s["amount_bank"];?></b></td>
					<td><?php echo $_POST["amount"]." €";?></td>
				</tr>
			</table>
			<div style='text-align:center'>
				<a href='<?php echo PATH;?>' class></a>
			</div>
		</div>		
		</div>		
	</div>
</div>
<?php
include("footer.php");
?>

 