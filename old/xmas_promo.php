<?php 
//Lang Revisado
$page="Xmas Promo";
$page_title = "Promoción Navidad";
include("header.php");
include_once("include/products.php");
include_once("include/inbd.php");
$family = "index";
$page = "Xmas Promo";
?>
<div id='content' style='padding-top:55px'>
	<div id='index'>
		<div id="section_header">

		</div>
		<div style='padding-top:40px;'>
			<h1 style='font-size:120px'><i class='fa fa-check'></i></h1>
			<h3 style='margin-bottom:30px;'>La tarjeta regalo ha sido enviada</h3>
			<p style='margin-bottom:30px;'>En pocos minutos la persona que hayas elegido la recibirá en su correo eletrónico</p>
			<p><a href="./index.php" class='btn btn-white'>Volver</a></p>
		</div>
		
		<div style='padding-top:40px;'>
			<h3>Estas navidades queremos ayudarte con los regalos</h3>
			<p style='margin-bottom:30px;'>
				Envía una tarjeta regalo de <b>15€</b> para utilizar en nuestra tienda online a quien más quieras<br/>
				Escribe la dirección de correo y pulsa el botón enviar tarjeta
			</p>
			<div style='border:1px solid #d4d4d4;padding:10px;width:500px;margin:auto'>
				<p>
					<img src='./img/interface/okycoky-logo.png'/>
				</p>
				<h1>Tarjeta regalo</h1>
				<h1 style='font-size:80px;'>15 € </h1>
				<p style='text-align:left;margin-left:20px;'>De:</p>
				<input type="text" name="promo_from" style='padding:10px;font-size:16px;width:440px'/>
				<p style='text-align:left;margin-left:20px;'>Escribe una dedicatoria</p>
				<textarea type="text" name="promo_content" style='padding:10px;font-size:12px;width:440px;height:60px;'/></textarea>
				<br/>
				<p style='font-size:12px;'>* Tarjeta regalo válida hasta el 31 de Diciembre de 2014</p>
			</div>
			<p>Correo electrónico</p>
			<input type="text" name="promo_email" style='padding:10px;font-size:16px;width:300px'/>

			<p><input type="submit" class='btn btn-white' value="Enviar Tarjeta"/></p>
		</div>
		
	</div>
</div>
<?php
include("footer.php");
?>