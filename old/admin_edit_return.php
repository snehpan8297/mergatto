<?php
//Lang revisado
@session_start();
if (!isset($_SESSION['admin_classics'])) {
	header("location:./admin.php");
	die();
}

$page = "admin_add_return";
include ("header.php");

include_once("./include/inbd.php");

$table="returns";
$filter=array();
$filter["id_return"]=array("operation"=>"=","value"=>$_GET["id_return"]);
$return=getInBD($table,$filter);
$return["total_no_tax"] = 0;

$table="return_lines";
$filter=array();
$filter["id_return"]=array("operation"=>"=","value"=>$_GET["id_return"]);
$return_lines=listInBD($table,$filter);
if(!isset($_GET["id_return"])){
?>
<div id='content'>
</div>


<?php	
}
?>
<div id='content'>
	<div class='contentbox'>
		<h1 style='font-size:16px;margin-bottom:10px;'>Devolución #<?php echo $return["id_return"];?> | Código de Envío: <?php echo strtoupper(dechex($return["created"]));?></h1>
		<div style='margin-bottom:20px;overflo:auto;'>
			<?php
				if($return["status"]==1){
					$status_info="<span style='color:orange;white-space: nowrap;font-size:16px;'><i class='fa fa-certificate'></i> Nueva</span>";
				}else if($return["status"]==2){
					$status_info="<span style='color:blue;white-space: nowrap;font-size:16px;'><i class='fa fa-truck'></i> Recogiendo</span>";
				}else if($return["status"]==3){
					$status_info="<span style='color:purple;white-space: nowrap;font-size:16px;'><i class='fa fa-dropbox'></i> Verificada</span>";
				}else if($return["status"]==4){
					$status_info="<span style='white-space: nowrap;font-size:16px;'><i class='fa fa-check'></i> Finalizado</span>";
				}else if($return["status"]==5){
					$status_info="<span style='color:red;white-space: nowrap;font-size:16px;'><i class='fa fa-times'></i> Cancelada</span>";
				}
			?>
			<a href='./admin_show_details.php?id_order=<?php echo $return["id_order"];?>' style='margin-top:7px;margin-right:10px;'class='btn btn-mini btn-dark pull-right'>Ver Pedido</a>
			<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;'>PEDIDO #<?php echo $return["id_order"];?></h4>
			
			<div class='pull-right' style='padding-top:7px;padding-right:10px;'>
				Actualizar estado 
				<select id='return_status' style='margin:0;'>
					<option value='1' <?php if($return["status"]==1) echo "selected";?>>Nueva</option>
					<option value='2' <?php if($return["status"]==2) echo "selected";?>>Recogiendo</option>
					<option value='3' <?php if($return["status"]==3) echo "selected";?>>Verificada</option>
					<option value='4' <?php if($return["status"]==4) echo "selected";?>>Finalizada</option>
					<option value='5' <?php if($return["status"]==5) echo "selected";?>>Cancelada</option>
				</select>
				<a href='javascript:save_status();' class='btn btn-mini btn-dark'>Guardar</a>
				<a href='javascript:show_email_delivery();' class='btn btn-mini btn-dark'>Email Seur</a>
			</div>
			<h4 style='margin-bottom:10px;border: 1px solid #d0d0d0;padding:10px;'>Estado de la Devolución <?php echo $status_info;?></h4>			
		</div>
<style type='text/css'>
	#invoice tr td{
		padding:5px;border:1px solid #aaaaaa;text-align:center;
	}
	#invoice tr th{padding:5px;border:1px solid #aaaaaa;text-align:center;width:12px;}
	#images{width:650PX;margin-top:20px;}
	#images td{width:125px;height:250px;margin-top:10px;text-align:center}
	#images img{width:150px}
</style>
<div style='border:1px solid #d4d4d4; width: 100%; min-width:720px;margin:auto;'>
	<div style='padding:10px;'>
		<div>
			<table>
				<tr>
					<td style='width:680px;'>
						<img src='./img/interface/okycoky-logo.png' style='height:25px;'>
						<br/>
						<div style='font-size:12px;'>
							<strong>ROTELPA S.A.</strong>
							<br>  P. Tec. Log&iacute;stico, calle C, nave C1<br>  36315 VIGO (Spain)<br>  Tlf.: +34 986240001 | Fax: +34 986240449<br>  info@okycoky.com | www.okycoky.com
						</div>
					</td>
					<td style='text-align:right;width:330px;'>
						<div style='border:1px solid #666;width:355px;padding:10px;'>
							<b>DATOS DEL CLIENTE</b><br/>
							<?php echo $return["invoice_address_name"];?> ( #<?php echo $return["id_client"];?> )<br>
							<?php echo $return["invoice_address_DNI"];?><br>
							<?php echo $return["invoice_address_email"];?><br>
							DIRECCIÓN<br/>
							<?php echo $return["invoice_address_address_1"];?><br>
							<?php echo $return["invoice_address_address_2"];?><br>
							<?php echo $return["invoice_address_post_code"];?> - <?php echo $return["invoice_address_city"];?><br>
							<?php echo $return["invoice_address_province"];?> - <?php echo $return["invoice_address_country"];?><br>
							TLF: <?php echo $return["invoice_address_mobile"];?> <?php echo $return["invoice_address_other"];?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<H1 style='padding:20px 0px;text-transform:uppercase;font-size:20px'>DEVOLUCIÓN #<?php echo $return["id_return"];?> | OKY^COKY CLASSICS <?php echo date("Y");?> <span style='float:right'>RETURN CODE <?php echo strtoupper(dechex($return["created"]));?></span></H1>
		<div>
			<table style='border-collapse:collapse;' id='invoice'>
				<tr>
					<td style=';font-size:15px;min-width:150px;'>
						<strong>DEVOLUCIÓN</strong>
						<br/>#<?php echo $return["id_return"];?>
					</td>
					<td style=';font-size:15px;min-width:150px;'>
						<strong>PEDIDO</strong>
						<br/>#<?php echo $return["id_order"];?>
					</td>
					<td style=';font-size:15px;min-width:150px;'>
						<strong>FECHA</strong>
						<br/><?php echo date("d/m/Y",$return["created"]);?>
					</td>
					<td rowspan=2 style='text-align:right;vertical-align:top;width:100%'>
						<b>DIRECCIÓN DE RECOGIDA</b><br/>
						<?php echo $return["shipping_address_name"];?><br>
						<?php echo $return["shipping_address_address_1"];?><br>
						<?php echo $return["shipping_address_address_2"];?><br>
						<?php echo $return["shipping_address_post_code"];?> - <?php echo $return["shipping_address_city"];?><br>
						<?php echo $return["shipping_address_province"];?> - <?php echo $return["shipping_address_country"];?><br>
						TLF: <?php echo $return["shipping_address_mobile"];?>  <?php echo $return["shipping_address_other"];?></b>
					</td>
				</tr>
				<tr>
					<?php
						if((isset($return["user_comment"]))&&(!empty($return["user_comment"]))){
							?>
							<td colspan=3 style='color:orange !important;background-color:#fff4d4;padding:10px;margin-bottom:10px;text-align:left;'>
							<strong>COMENTARIO DEL USUARIO</strong>
							<p><?php echo $return["user_comment"];?></p>
							<?php
						}else{
							?>
							<td colspan=3 style='text-align:left;padding:10px;'>
							<strong>COMENTARIO DEL USUARIO</strong>
							<p>Sin comentario</p>
							<?php
						}
					?>
					
					</td>
				</tr>
			</table>
		</div>
		<div>
			<table class='table' id='invoice' style='margin-top:10px;border-collapse:collapse;font-size:10px !important; color:#000'>
				<thead>
					<tr style='border:1px solid #dddddd'>
						<th style='width:100%;text-align:left'>
							CODIGO
						</th>
						<th style='width:5px'>
							34
						</th>
						<th style='width:5px'>
							36
						</th>
						<th style='width:5px'>
							38
						</th>
						<th style='width:5px'>
							40
						</th>
						<th style='width:5px'>
							42
						</th>
						<th style='width:5px'>
							44
						</th>
						<th style='width:5px'>
							46
						</th>
						<th style='width:5px'>
							48
						</th>
						<th style='width:5px'>
							50
						</th>
						<th style='width:5px'>
							52
						</th>
						<th style='width:5px'>
							CAN
						</th>
						<th style='min-width:60px;text-align:right'>
							PRECIO
						</th>
						<th style='min-width:60px;text-align:right'>
							TOTAL
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($return_lines as $key=>$return_line){
							for($i=1;$i<=10;$i++){
								if($return_line["size_".$i]==0){
									$return_line["size_".$i]="";
								}
							}
							?>
							<tr>
								<td style='text-align:left'><?php echo $return_line["product_code"];?></td>
								<td><?php echo $return_line["size_1"];?></td>
								<td><?php echo $return_line["size_2"];?></td>
								<td><?php echo $return_line["size_3"];?></td>
								<td><?php echo $return_line["size_4"];?></td>
								<td><?php echo $return_line["size_5"];?></td>
								<td><?php echo $return_line["size_6"];?></td>
								<td><?php echo $return_line["size_7"];?></td>
								<td><?php echo $return_line["size_8"];?></td>
								<td><?php echo $return_line["size_9"];?></td>
								<td><?php echo $return_line["size_10"];?></td>
								<td><?php echo $return_line["num_products"];?></td>
								<?php
									$return_line["unitary_price_no_tax"] = number_format($return_line["unitary_price"]/1.21,2);
									$return_line["total_no_tax"] = number_format($return_line["total"]/1.21,2);
									$return["total_no_tax"] += $return_line["total_no_tax"];
								?>
								<td style='text-align:right'><?php echo $return_line["unitary_price_no_tax"];?> €<br/>( <?php echo $return_line["unitary_price"];?>€ )</td>
								<td style='text-align:right'><?php echo $return_line["total_no_tax"];?> €<br/>( <?php echo $return_line["total"];?>€ )</td>
							</tr>
							<?php
						}
					?>
					<tr style='height:30px'>
						<td style='text-align:right' colspan=11>
							<strong>NÚMERO DE PRENDAS</strong>
						</td>
						<td >
							<strong><?php echo $return["num_clothes"];?></strong>
						</td>
						<td style='text-align:right' >
							<strong>TOTAL</strong>
						</td>
						<td style='text-align:right'>
							<strong><?php echo $return["total_no_tax"];?> €<br/>( <?php echo $return["total"];?>€ )</strong>
						</td>
					</tr>
					<tr style='height:30px'>
						<td style='text-align:right' colspan=12>
							METODO DE DEVOLUCIÓN
						</td>
						<td style='text-align:right' colspan=3>
							<strong><?php echo $return_methods_s[$return["return_method"]];?></strong>
						</td>
					</tr>
					<tr style='height:30px'>
						<td style='text-align:right' colspan=15>
							<strong><?php echo $return["return_method_info"];?></strong>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class='form_submit' style='min-width:700x;'>
	<a id="login_send_step_1" class='btn btn-dark btn-small uppercase' href="admin_list_returns.php"><?php echo $s["back"];?></a>
<a class='btn btn-dark btn-small uppercase' target="_blanch" href="javascript:print_return()">IMPRIMIR</a> <a class='btn btn-dark btn-small uppercase' target="_blanch" href="javascript:print_return_label()">ETIQUETA DE ENVIO</a>
</div>
		</div>
</div>
<div id='zoom_window' style='display:none;'>
	<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
	<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left:200px; width:0px; z-index:910;'>
		<div style='position:absolute; text-align: right;width: 100%;'>
			<a class='close_button' href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
		</div>
		<div class='window' style='width:520px;background-color:#ffffff;padding:50px 10px ;overflow:auto;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s["send_email_title"]; ?></a></div>
			</div>
			<div class='contentbox'>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["send_email_moreinfo"]; ?>
				</div>
				<form>
					<div class='form_entry'>
						<span class='label'><?php echo $s["subject"]?> <span class='form_isrequired'>*</span></span><input  name="email_subject" id="email_subject" class='text' type='text' value='<?php echo "Oky^Coky Classics Return: ".'#'.strtoupper(dechex($return["created"])); ?>'/>
						<span id="subject_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["content"]?> <span class='form_isrequired'>*</span></span><textarea style='max-width:500px !important;min-width:500px !important' name="email_content" id="email_content"></textarea>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Recibido aviso de Devolución: <a href="javascript:set_content('es','return');">Castellano</a>
					</div><div style='margin-right:30px;padding-top:10px'>
						<a href="javascript:set_content('en_1','return');">Inglés Esperando Código</a> | <a href="javascript:set_content('en_2','return');">Inglés Código Transporte</a>
					</div>					<div style='margin-right:30px;padding-top:10px'>
						Abono de Devolución: <a href="javascript:set_content('es','return_payment');">Castellano</a> | <a href="javascript:set_content('en','return_payment');">Inglés</a>
					</div>
					<div class='form_submit' style='padding-top:10px'>
					<div class='likeabutton' style='float:right; margin-right:30px;'>
						<a id="send" href="javascript:send_email();"><span class='text'><?php echo $s["send"];?></span></a>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id='stock_window' style='display:none'>
	<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
	<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left:250px; margin-left:-50px;width:0px; z-index:910;'>
		<div class='window' style='width:640px;background-color:#ffffff;padding:20px ;overflow:auto;'>
			
			<div class='contentbox'>
				<div id='infobox_header' style='margin-bottom:10px;' class='infobox_info'>
					<h1>DEVOLVER STOCK</h1>
				</div>
				<form>
					<table style='width:100%'>
						<tr>
							<th style='text-align:left'>Código</th>
							<th>36</th>
							<th>38</th>
							<th>40</th>
							<th>42</th>
							<th>43</th>
							<th>44</th>
							<th>46</th>
							<th>48</th>
							<th>50</th>
							<th>52</th>
							<th>Devolver</th>
						</tr>
					<?php
						foreach($return_lines as $key=>$return_line){
							?>
							<tr style='padding:10px;'>
								<td><?php echo $return_line["product_code"];?></td>
								<?php
								for($i=1;$i<=10;$i++){
									?>
									<td>
										<?php
												$input_type='text';
											if($return_line["size_".$i]==0){
												$input_type='disabled';
											}
										?>
										<input type='text' id='<?php echo $return_line["id_return_line"];?>_size_<?php echo $i;?>' style='width:10px;text-align:center;padding:5px;' value='<?php echo $return_line["size_".$i];?>' <?php echo $input_type;?>/>
									</td>
									<?php
								}
								?>
								<td style='text-align:center'><input type='checkbox' id='<?php echo $return_line["id_return_line"];?>_return_stock' checked/></td>
							</tr>
							<?php
						}
					?>
					</table>
					<div style='text-align:center;margin-top:20px;'>
						<a href='javascript:cancel_stock();' class='btn btn-dark'>Cerrar</a>
						<a href='javascript:return_stock();' class='btn btn-dark'>Devolver Stock</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id='email_delivery' style='display:none;'>
	<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
	<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left:200px; width:0px; z-index:910;'>
		<div style='position:absolute; text-align: right;width: 100%;'>
			<a class='close_button' href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
		</div>
		<div class='window' style='width:520px;background-color:#ffffff;padding:50px 10px ;overflow:auto;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s["send_email_title"]; ?></a></div>
			</div>
			<div class='contentbox'>
				<form>
					<div class='form_entry'>
						<span class='label'>Email<span class='form_isrequired'>*</span></span><input  name="delivery_email" id="delivery_email" class='text' type='text' value='recogidas.vigo@seur.net'/>
						<span id="subject_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'>Título<span class='form_isrequired'>*</span></span><input  name="delivery_email_subject" id="delivery_email_subject" class='text' type='text' value='Solicitud Recogida para ROTELPA SA - OKY^COKY'/>
						<span id="subject_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["content"]?> <span class='form_isrequired'>*</span></span><textarea style='max-width:500px !important;min-width:500px !important' name="delivery_email_content" id="delivery_email_content">
Buenos días, mediante este mensaje, ordenamos la siguiente recogida:

1 bulto (40cmX30cmX8cm) – 1 kgr.
Servicio: SEUR 24 HORAS
Portes: a cargo de ROTELPA, S.A.

RECOGER EN:
<?php echo $return["shipping_address_name"];?>

<?php echo $return["shipping_address_address_1"];?>

<?php
	if((isset($return["shipping_address_address_2"]))&&(!empty($return["shipping_address_address_2"]))){
?>
<?php echo $return["shipping_address_address_2"];?>
	
<?php
	}
?>
<?php echo $return["shipping_address_post_code"];?> - <?php echo $return["shipping_address_city"];?>

<?php echo $return["shipping_address_province"];?> - <?php echo $return["shipping_address_country"];?>

TLF: <?php echo $return["shipping_address_mobile"];?>  <?php echo $return["shipping_address_other"];?>

Email: <?php echo $return["invoice_address_email"];?>


Por favor, pónganse en contacto con el remitente para organizar el horario de recogida.

ENTREGAR EN:
ROTELPA, S.A.
Parque Tec.Logístico Vigo,C, C1
36312 VIGO-SPAIN
TLF: 986240001

Por favor confírmenos la recepción de este mensaje a juantrota@okycoky.com

Muchas gracias
					</textarea>
					</div>
					<div class='form_submit' style='padding-top:10px'>
					<div class='likeabutton' style='float:right; margin-right:30px;'>
						<a id="send" href="javascript:send_email_delivery();"><span class='text'><?php echo $s["send"];?></span></a>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div id='zoom_window' style='display:none;'>
	<div class='background' style='background-color:#000000;opacity:0.5;width:100%;height:100%;z-index:900;position:fixed;top:0;left:0;'></div>
	<div class='window_preview' style='background-color:#ffffff; position:absolute; top:50px; left:200px; width:0px; z-index:910;'>
		<div style='position:absolute; text-align: right;width: 100%;'>
			<a class='close_button' href="javascript:void(0);" style='display:inline-block; overflow: hidden;z-index:909;'><?php echo $s["close"]; ?></a>
		</div>
		<div class='window' style='width:520px;background-color:#ffffff;padding:50px 10px ;overflow:auto;'>
			<div id='page_header'>
				<div id='page_navigator'><a href='' class='important'><?php echo $s["send_email_title"]; ?></a></div>
			</div>
			<div class='contentbox'>
				<div id='infobox_header' class='infobox_info'>
					<?php echo $s["send_email_moreinfo"]; ?>
				</div>
				<form>
					<div class='form_entry'>
						<span class='label'><?php echo $s["subject"]?> <span class='form_isrequired'>*</span></span><input  name="email_subject" id="email_subject" class='text' type='text' value='<?php echo "Oky^Coky Classics Order: ".'#'.$return["id_order"]; ?>'/>
						<span id="subject_alert" class='form_entry_alert'></span>
					</div>
					<div class='form_entry'>
						<span class='label'><?php echo $s["content"]?> <span class='form_isrequired'>*</span></span><textarea style='max-width:500px !important;min-width:500px !important' name="email_content" id="email_content"></textarea>
					</div>
					<div style='margin-right:30px;padding-top:20px'>
						Espera de pago: <a href="javascript:set_content('es','wait_payment');">Castellano</a> | <a href="javascript:set_content('en','wait_payment');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Cancelación Pedido: <a href="javascript:set_content('es','cancel');">Castellano</a> | <a href="javascript:set_content('en','cancel');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Enviando Pedido: <a href="javascript:set_content('es','sending');">Castellano</a> | <a href="javascript:set_content('en','sending');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Recibido aviso de Devolución: <a href="javascript:set_content('es','return');">Castellano</a> | <a href="javascript:set_content('en','return');">Inglés</a>
					</div>
					<div style='margin-right:30px;padding-top:10px'>
						Abono de Devolución: <a href="javascript:set_content('es','return_payment');">Castellano</a> | <a href="javascript:set_content('en','return_payment');">Inglés</a>
					</div>
					<div class='form_submit' style='padding-top:10px'>
					<div class='likeabutton' style='float:right; margin-right:30px;'>
						<a id="send" href="javascript:send_email();"><span class='text'><?php echo $s["send"];?></span></a>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	function print_return(){
		open("export_return.php?code=<?php echo strtoupper(dechex($return["created"]));?>","_blank");
	}
	function print_return_label(){
		open("export_return_label.php?code=<?php echo strtoupper(dechex($return["created"]));?>","_blank");
	}
	function send_email(){
		$("#send").parent().html("Enviando...");
		$.ajax({
			type : "POST",
			url : "./functions/send_email_to_client.php",
			data : {
				"email" : "<?php echo $return["invoice_address_email"];?>",
				"subject" : $('#email_subject').val(),
				"content" : $('#email_content').val(),
				"id_order" : <?php echo $return["id_order"];?>
			},
			success : function(msg) {
				if(msg == "OK"){
					alert("Correo electrónico enviado");
					$('#zoom_window').css('display','none');
					$('#email_content').val("");
					location.reload();						
				}
			}
		});
	}
	function send_email_delivery(){
		$.ajax({
			type : "POST",
			url : "./functions/send_email.php",
			data : {
				"email" : $('#delivery_email').val(),
				"subject" : $('#delivery_email_subject').val(),
				"content" : $('#delivery_email_content').val(),
			},
			success : function(msg) {
				if(msg == "OK"){
					alert("Correo electrónico enviado");
					$('#email_delivery').css('display','none');
					$('#email_content').val("");
					location.reload();						
				}
			}
		});
	}
	function set_content(lang,op){
		if(op=="wait_payment"){
			if(lang=="es"){
				$("#email_content").val("Hola ,\nPonemos este pedido en espera de pago dado a que por algún motivo no has podido hacer el pago.\nPor favor, asegúrate que tu tarjeta de crédito está autenticada-securizada por tu banco para hacer pagos por internet.\nSi no es así, solicítalo en tu banco (en algunos bancos esto puede hacerse por internet) o bien haz el pago por transferencia.\nPuedes intentar el pago de nuevo yendo a MI CUENTA – Mostrar historial de pedidos – IR AL PEDIDO – SELECCIONE UN MÉTODO DE PAGO.\nMuchas gracias y saludos.");
			}else{		
				$("#email_content").val("Hello ,\nyour order is waiting for payment because there was an error in the payment process.\nPlease, make sure your credit card is activated in order to make a purchase on the internet.\nContact your bank to activate your card. You can also pay for your order through a bank transfer.\nYou can retry to make the payment, please go to MY ACCOUNT – Show order list – GO TO YOUR ORDER – CHOOSE A PAYMENT METHOD.\nThank you and kind regards.");
				
			}
		}else if(op=="cancel"){
			
			if(lang=="es"){
				$("#email_content").val("Hola ,\nCancelamos este pedido dado a que por algún motivo no has podido hacer el pago.\nPuedes volver a hacer un nuevo pedido pero antes deberías asegurarte que tu tarjeta de crédito está autenticada-securizada por tu banco para hacer pagos por internet.\nPuedes solicítalo en tu banco (en algunos bancos esto puede hacerse por internet).\nTambién puedes pagar tus pedidos por transferencia.\nMuchas gracias.\nSaludos.");
			}else{		
				$("#email_content").val("Hello ,\nWe cancel your order because there was an error in the payment process.\nYou may put another new order but before please, make sure your credit card is activated in order to make a purchase on the internet.\nContact your bank to activate your card. You can also pay for your order through a bank transfer.\nThank you.");
			}
		}else if(op=="sending"){
			
			if(lang=="es"){
				$("#email_content").val("Hola ,\nhemos enviado hoy tu pedido por Seur, esperamos que te lo entreguen mañana.\nEl número de seguimiento del envío (traking) es:\nMuchas gracias y disfruta de tu compra.");
			}else{		
				$("#email_content").val("Hello ,\nyour order has been sent by Fedex and should arrive next week.\nThe tracking number is:\nThank you and we hope you will love your clothes.");
			}
		}else if(op=="return"){
			
			if(lang=="es"){
				$("#email_content").val("Hola ,\nDamos orden a Seur para que pasen a recoger tu devolución.\nPor favor, pon las prendas a devolver con todas sus etiquetas en la caja en la que fueron entregadas y utiliza la etiqueta de envío que se generó al crear la devolución (si no la has impreso, podrás hacerlo visitando la página de tu pedido).\nRecuerda que las devoluciones no tienen costo para ti, no debes pagar nada al transportista.\nUna vez la devolución llegue a nuestros almacenes, comprobaremos que todo está correcto y procederemos a abonar el importe, bien en la cuenta de tu tarjeta de crédito o débito o bien por transferencia, dependiendo como hayas hecho el pago del pedido.\nMuchas gracias.");
			}else if(lang=="en_1"){		
				$("#email_content").val("Hello ,\nWe order the transport company to make the returning of the goods.\nWe will give you the delivery company's return code and the phone of the transporter, then you must contact him to organize and agree the pickup.\nBefore that, please put the goods to return with all your tags-labels on the same box as delivered and use our delivery return label (if you didn't printed you can do it in your order's page).\nRemember, the returning goods is free for you, you no need to pay anything for the transport.\nOnce the goods arrive to our warehouse, we check it all and proceed to refund the value of the goods using the return payment method that you selected.\nThank you.");
			}else{		
				$("#email_content").val("Hello ,\nWe give you the delivery company's return code and the phone of the transporter, then you must contact them to organize and agree the pickup.\nIMPORTANT: When you contact the delivery company is important that you referd ourself using our company's name ROTELPA insted of our brand Oky^Coky.\n\nTransport company: DPD\nPhone: \nDelivery company's Return code: ROTELPA SA - \n\nRemember, the returning goods is free for you, you no need to pay anything for the transport.\nOnce the goods arrive to our warehouse, we check it all and proceed to refund the value of the goods using the return payment method that you selected.\nThank you.");
			}
		}else if(op=="return_payment"){
			
			if(lang=="es"){
				$("#email_content").val("Hola ,\nHemos recibido la devolución del vestido () y ya hemos abonado en la cuenta de tu tarjeta su importe (€).\nPor favor, compruébalo en tu siguiente extracto.\nMuchas gracias.");
			}else{		
				$("#email_content").val("Hello ,\nWe have received the returned goods () and we have refund the cost (€) on your credit card.\nPlease check it in your next bank statement.\nThank you.");
			}
		}else{
			
		}
		
		
	}
	
	function show_email_delivery(){
		$('#email_delivery').css('display','block');
	}
	
	function show_window(){
		$('#zoom_window').css('display','block');
	}
	var mouse_is_inside=false; 
	$(document).ready(function (){
		center= parseInt($(window).width()/2)-250;
		$('.window_preview').css('left',center);
		$('.close_button').click(function() {
			$('#email_content').val("");
			$('#zoom_window').css('display','none');
			$('#email_delivery').css('display','none');
			location.reload();						
		});
		$('.window').hover(function(){ 
			mouse_is_inside=true; 
		}, function(){ 
			mouse_is_inside=false; 
		});
		$("body").mouseup(function(){ 
			if(! mouse_is_inside) $('#zoom_window').css('display','none');
		});
	});
	
	function return_stock(){
		error=false;
		<?php
			foreach($return_lines as $key=>$return_line){
				
				?>
				if($("#<?php echo $return_line["id_return_line"];?>_return_stock").attr("checked")=="checked"){
					$.ajax({
						type : "POST",
						url : "./functions/return_stock.php",
						data : {
							"id_product" : <?php echo $return_line["id_product"];?>,
							"id_color" : <?php echo $return_line["id_color"];?>,
							"stock_size_1" : $("#<?php echo $return_line["id_return_line"];?>_size_1").val(),
							"stock_size_2" : $("#<?php echo $return_line["id_return_line"];?>_size_2").val(),
							"stock_size_3" : $("#<?php echo $return_line["id_return_line"];?>_size_3").val(),
							"stock_size_4" : $("#<?php echo $return_line["id_return_line"];?>_size_4").val(),
							"stock_size_5" : $("#<?php echo $return_line["id_return_line"];?>_size_5").val(),
							"stock_size_6" : $("#<?php echo $return_line["id_return_line"];?>_size_6").val(),
							"stock_size_7" : $("#<?php echo $return_line["id_return_line"];?>_size_7").val(),
							"stock_size_8" : $("#<?php echo $return_line["id_return_line"];?>_size_8").val(),
							"stock_size_9" : $("#<?php echo $return_line["id_return_line"];?>_size_9").val(),
							"stock_size_10" : $("#<?php echo $return_line["id_return_line"];?>_size_10").val(),
							
						},
						error: function(){
							alert("Ha ocurrido un error y la operación no ha podido realizarse");
						},
						success : function(msg) {
							if(msg == "OK"){
							}else{
								error=true;
							}
						}
					});		
					
				}
				
				
				<?php
			}
		?>
		if(error){
			alert("No se ha podido devolver el Stock");
		}else{
			alert("Stock devuelto");
		}
		cancel_stock();
	}
	
	function cancel_stock(){
		$('#stock_window').css('display','none');
		$.ajax({
				type : "POST",
				url : "./functions/update_return.php",
				data : {
					"id_return" : <?php echo $return["id_return"];?>,
					"status" : $("#return_status").val()
				},
				error: function(){
					alert("Ha ocurrido un error y la operación no ha podido realizarse");
				},
				success : function(msg) {
					if(msg == "OK"){
						if(confirm("¿Quiere enviar un email al cliente?")){
							show_window();
						}else{
							location.reload();						
						}
					}else{
						alert("Ha ocurrido un error y la operación no ha podido realizarse");
					}
				}
			});
	}	
	function save_status(){
		if($("#return_status").val()==4){
				$('#stock_window').css('display','block');
			
		}else{
			$.ajax({
				type : "POST",
				url : "./functions/update_return.php",
				data : {
					"id_return" : <?php echo $return["id_return"];?>,
					"status" : $("#return_status").val()
				},
				error: function(){
					alert("Ha ocurrido un error y la operación no ha podido realizarse");
				},
				success : function(msg) {
					if(msg == "OK"){
						if(confirm("¿Quiere enviar un email al cliente?")){
							show_window();
						}else{
							location.reload();						
						}
					}else{
						alert("Ha ocurrido un error y la operación no ha podido realizarse");
					}
				}
			});
	
		}
	}


</script>


<?php
include ("footer.php");
?>