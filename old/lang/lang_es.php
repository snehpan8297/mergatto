<?php
	$s["payments_client_name"] = "Nombre del cliente";
	$s["payments_store_name"] = "Nombre de la tienda";
	$s["payments_email"] = "Correo electrónico";
	$s["payments_concept"] = "Concepto";
	$s["payments_amount_example"] = "Importe (Ej.: 1900,50)";
	$s["payments_amount"] = "Importe";
	$s["next"] = "Siguiente";
	$s["back"] = "Volver";
	$s["page"] = "Página";
	$s["articles"] = "Artículos";
	$s["apparel"] = "Prendas";
	$s["confirm"] = "Confirmar";
	$s["exit"] = "Salir";
	$s["404_title"] = "Página no encontrada.";
	$s["404"] = "La página que estás buscando no está disponible.";
	$s["payments_step_1"] ="<p>Bienvenido al sistema de realización de pagos de OKY^COKY.</p><p>Para realizar este pago necesitará introducir su nombre, el nombre de su tienda, su correo electrónico, el concepto de pago y el importe.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	$s["contact_name"] = "Nombre del cliente";
	$s["contact_shop_name"] = "Nombre de la tienda";
	$s["contact_phone"] = "Teléfono";
	$s["contact_email"] = "Correo Electrónico";
	$s["contact_country"] = "País";
	$s["contact_subject"] = "Asunto";
	$s["contact_message"] = "Mensaje";
	$s["contact_send"] = "Enviar";

	//General
	$s["spring/summer"] = "Primavera / Verano";
	$s["fall/winter"] = "Otoño / Invierno";
	$s["season"] = "Temporada";
	$s["login"] = "Identificate";
	$s["signup"] = "Registrarse";
	$s["logout"] = "Cerrar Sesión";
	$s["buying_guide"] = "Guía de compra";
	$s["how_to_buy"] = "Cómo comprar";
	$s["payment"] = "Cómo pagar";
	$s["shipping"] = "Envío";
	$s["returns"] = "Devoluciones";
	$s["exchanges"] = "Cambios";
	$s["follow_us"] = "Síguenos";
	$s["facebook"] = "Facebook";
	$s["twitter"] = "Twitter";
	$s["flickr"] = "Flickr";
	$s["youtube"] = "YouTube";
	$s["policies"] = "Políticas";
	$s["environmental_policy"] = "Política Medioambiental";
	$s["privacy_policy"] = "Políticas de Privacidad";
	$s["purchase_conditions"] = "Condiciones de Compra";
	$s["company"] = "Empresa";
	$s["okycoky_payments"] = "Pagos a Oky^Coky";
	$s["about_us"] = "Quiénes somos";
	$s["offices"] = "Oficinas";
	$s["stores"] = "Tiendas";
	$s["contact"] = "Contacto";
	$s["language"] = "Idioma";
	$s["spanish"] = "Castellano";
	$s["english"] = "Inglés";
	$s["order"] = "Mi pedido:";
	$s["order_no:"] = "Ver mi pedido";
	$s["format_not_valid"] = "Formato no válido";
	$s["obligatory_field"] = "Campo obligatorio";
	$s["name_pass_match"] = "La contraseña no puede coincidir con el nombre de usuario";
	$s["pass_not_match"] = "Las contraseñas no coinciden";
	$s["email_not_match"] = "El correo electrónico no coincide";
	$s["field_too_short"] = "Demasiado corto (mínimo 6 caracteres)";
	$s["field_too_short_3"] = "Demasiado corto (mínimo 3 caracteres)";
	$s["field_too_long"] = "Demasiado largo (máximo 20 caracteres)";
	$s["field_too_long_22"] = "Demasiado largo (máximo 22 caracteres)";
	$s["field_too_long_email"] = "Demasiado largo (máximo 40 caracteres)";
	$s["accept"] = "Aceptar";
	$s["sending"] = "Enviando";
	$s["loading"] = "Cargando";
	$s["cancel"] = "Cancelar";
	$s["welcome"] = "Bienvenido";
	$s["add_to_cart"] = "Añadir al Pedido";
	$s["cart"] = "Pedido";
	$s["save"] = "Guardar";

	//Left_menu

	$s["new"] = "Novedades";
	$s["clothes"] = "Prendas";

	$s["coats"] = "Abrigos";
	$s["blazers"] = "Chaquetas";
	$s["dresses"] = "Vestidos";
	$s["skirts"] = "Faldas";
	$s["trousers"] = "Pantalones";
	$s["shirts"] = "Blusas";
	$s["t-shirts"] = "Camisetas";
	$s["shoes"] = "Zapatos";
	$s["accessories"] = "Complementos";
	$s["more.."] = "Más..";
	$s["news"] = "Noticias";
	$s["trousers_oky's"] = "Pantalones oky's";

	//Families
	$s["sizes_1"]="34";
	$s["sizes_2"]="36";
	$s["sizes_3"]="38";
	$s["sizes_4"]="40";
	$s["sizes_5"]="42";
	$s["sizes_6"]="44";
	$s["sizes_7"]="46";
	$s["sizes_8"]="48";
	$s["sizes_9"]="50";
	$s["sizes_10"]="52";
	if((isset($_GET["t"]))&&(!empty($_GET["t"]))){
		$s["family_by_size"] = "Talla ".$s["sizes_".$_GET["t"]];
	}else{
		$s["family_by_size"] = "";
	}
	$s["family_all_visible"] = "Todos";
	$s["family_index"] = "Lo más buscado";
	$s["family_0"] = "";
$s["family_19"]="Varios";
	$s["family_20"]="Tejido";
$s["family_21"]="Componentes";
$s["family_22"]="Tej. Muestrario";
$s["family_23"]="Abrigos";
$s["family_24"]="Blusas";
$s["family_25"]="Camisetas";
$s["family_26"]="Cinturones";
$s["family_27"]="Chaquetas";
$s["family_28"]="Chaq. Ligeras";
$s["family_29"]="Echarpes";
$s["family_30"]="Faldas";
$s["family_31"]="Chalecos";
$s["family_32"]="Pantalones";
$s["family_33"]="Pantalones oky's";
$s["family_36"]="Vestidos";
$s["family_37"]="Tops";
$s["family_38"]="Forros";
$s["family_39"]="Complementos";
$s["family_40"]="Prendas Morocco";
$s["family_41"]="Cuellos";
$s["family_42"]="Blus. Dresslok";
$s["family_43"]="Camisetas Dresslok";
$s["family_44"]="Chaq. Okys";
$s["family_46"]="Guantes";
$s["family_47"]="Collares";
$s["family_48"]="Tocados";
$s["family_49"]="Foulards";
$s["family_50"]="Zapatos";
$s["family_51"]="Estolas";
$s["family_52"]="Shorts";
$s["family_53"]="Boleros";
$s["family_54"]="Cazadoras";
$s["family_55"]="Blazers";
$s["family_56"]="Monos";
$s["family_57"]="Pulseras";
$s["family_58"]="Pendientes";
$s["family_59"]="Capas";
$s["family_60"]="Chaquetones";
$s["family_61"]="Camisas";
$s["family_62"]="Punto";
$s["family_63"]="Sueters";

$s["family_65"]="Conjuntos";
$s["family_69"]="Polos";

	//Payment_confirm
	$s["payment_confirm_title"] = "Confirmación de pago a Oky^Coky";
	$s["payment_confirm_subtitle"] = "Confirme los datos";
	$s["payment_confirm_moreinfo"] = "<p>Los pagos en OKY^COKY son 100% confiables y seguros y están totalmente cubiertos por nuestra <a href='./privacy_policy.php class='important underline' target='_blank'>política de privacidad y seguridad</a>. Toda la información personal y datos bancarios son tratados con la máxima discreción y seguridad.</p><p class='important'>En caso de confirmar los datos se le redireccionará a la pasarela de pago virtual proporcionada por \"La Caixa\". En dicha pasarela se garantiza el pago seguro con los siguientes opciones: Visa, Mastercard, Maestro credito y tarjetas de débito.</p><p style='text-align:right;padding-right:50px;'><img src='./img/visa.gif'/>
	<img src='./img/mastercard.gif'/>
	<img style='margin-left:100px' src='https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg'>

	</p>";
		$s["order_confirm_moreinfo"] = "<p>Tu cuenta de usuario es Retailer, por favor confirma tu pedido y nuestro equipo se pondrá en contacto contigo lo antes posible.</p><br/>";
	$s["pasarela_access"] = "<h3>Accediendo a pasarela de pago</h3><p>Por favor, no cierre esta ventana</p>";
	$s["pasarela_save_and_access"] = "<h3>Guardando datos del pedido y accediendo a pasarela de pago</h3><p>Por favor, no cierre esta ventana</p>";

	//Payment_error
	$s["payment_error_title"] = "ATENCIÓN<BR/><BR/><H2>Si ha seleccionado Transferencia el proceso de pago ha finalizado.</H2> <BR/><H2> Si ha escogido pago mediante tarjeta ha ocurrido un error.</H2>";
	$s["payment_error_moreinfo"] = "<p>Nuestro sistema ha grabado su pedido, en caso de que haya elegido pago por transferencia, una vez tengamos confirmación del pago nuestro equipo enviará su pedido.</p><p>En caso de haber escogido pago mediante tarjeta, el sistema no ha podido finalizar la compra debido a algún error, por favor vuelva a intentarlo o contacte con nuestro servicio de atención al cliente en <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a>.</p><p>Muchas gracias.</p>";

	//Payment_post
	$s["payment_post_subject"] = "Recibo de pago a OkyCoky";
	$s["payment_post_title"] = "Gracias por realizar el pago a Oky^Coky";
	$s["payment_post_subtitle"] = "A continuación se encuentra toda la información del pago realizado.";
	$s["payment_post_transation_code"] = "Código de Transacción";
	$s["payment_post_date"] = "Fecha";
	$s["payment_post_hour"] = "Hora";
	$s["payment_post_client_name"] = "Nombre del cliente";
	$s["payment_post_shop_name"] = "Nombre de la tienda";
	$s["payment_post_email"] = "Correo Electrónico";
	$s["payment_post_concept"] = "Concepto";
	$s["payment_post_amount"] = "Importe";
	$s["payment_post_moreinfo"] = "<p>Muchas gracias, el pago se ha realizado.</p><p>Por favor, no conteste a este correo electrónico. En caso de alguna duda envié un email a <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Payment_success
	$s["payment_success_title"] = "Finalizado Proceso de pago a Oky^Coky";
	$s["payment_success_moreinfo"] = "
	<h3>Muchas gracias por su compra</h3>
	<p>Nos pondremos en contacto con usted para confirmar la recepción de este pago. Le hemos enviado un correo electrónico con los datos de este pago a la dirección que nos ha indicado.</p><p>En caso de alguna duda envié un email a <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["order_success_moreinfo"] = "
	<h3>Muchas gracias por comprar en nuestra tienda online</h3>
		<p>Tu pedido ha sido pagado correctamente y nuestro equipo ya ha empezado a procesar tu pedido para que puedas tenerlo lo antes posible. Normalmente procesar un pedido nos lleva entre 2 a 3 días laborales (aunque muchas veces nos lleva incluso menos), cuando el servicio de mensajería recoja el paquete en nuestro almacén, te enviaremos un email para confirmar que tu pedido ha sido enviado.</p><p><br/>Gracias.</p>";



	//Payments
	$s["payments_title"] = "Pagos a Oky^Coky";
	$s["payments_subtitle"] = "Introduzca los datos del pago";
	$s["payments_moreinfo"] = "Los campos con * son campos obligatorios";

	//Privacy_policy
	$s["privacy_policy_title"] = "Política de Privacidad y seguridad de Oky^Coky";
	$s["privacy_policy_moreinfo"] = "<ol class='decimallist'><li>Cada vez que usa este sitio Web estará bajo la aplicación de la Política de Privacidad vigente en cada momento, debiendo revisar dicho texto para comprobar que está conforme con él.</li><li>Los datos personales que nos aporta serán objeto de tratamiento en un fichero responsabilidad de ROTELPA, S.A (\"Fashion Retail\") cuyas finalidades son:</li><ol class='romanlist'><li>el desarrollo, cumplimiento y ejecución del contrato de compraventa de los productos que ha adquirido o de cualquier otro contrato entre ambos;</li><li>atender las solicitudes que nos plantee;</li><li>proporcionarle información acerca de los productos de ROTELPA, S.A., incluyendo, en relación con dichos productos, el envío de comunicaciones comerciales por correo electrónico o por cualquier otro medio de comunicación electrónica equivalente (como SMS) así como a través de la realización de llamadas telefónicas. Puedes cambiar tus preferencias en relación al envío de tales comunicaciones comerciales accediendo a la sección Mi cuenta.</li></ol><li>ROTELPA, S.A. con domicilio social en CL. VEIGUIÑA, 40 - BAJO, 36212, VIGO (PONTEVEDRA), como responsable del fichero, se compromete a respetar la confidencialidad de su información de carácter personal y a garantizar el ejercicio de sus derechos de acceso, rectificación, cancelación y oposición, mediante carta dirigida a la dirección anteriormente indicada a la atención de \"Responsable LOPD\" o mediante el envío de un correo electrónico a INTERNET@OKYCOKY.COM, en ambos casos facilitando una fotocopia de su documento nacional de identidad, o de su pasaporte u otro documento válido que lo identifique. En el caso de que decidiese ejercer dichos derechos y que como parte de los datos personales que nos hubiera facilitado conste el correo electrónico le agradeceríamos que en la mencionada comunicación se hiciera constar específicamente esa circunstancia indicando la dirección de correo electrónico respecto de la que se ejercitan los derechos de acceso, rectificación, cancelación y oposición.</li><li>Cookies:</li><ol class='latinlist'><li>Podemos recabar información sobre su ordenador, incluido, en su caso, su dirección de IP, sistema operativo y tipo de navegador, para la administración del sistema. Se trata de datos estadísticos sobre cómo navega por nuestro sitio Web.</li><li>Por la misma razón, podemos obtener información sobre su uso general de Internet mediante un archivo de cookies que se almacena en el disco duro de su ordenador. Las cookies contienen información que se transfiere al disco duro de su ordenador.</li><li>Las cookies nos ayudan a mejorar nuestro sitio Web y a prestar un servicio mejor y más personalizado. En concreto, nos permiten:<ol class='dotlist'><li>Hacer una estimación sobre números y patrones de uso.</li><li>Almacenar información acerca de sus preferencias y personalizar nuestro sitio web de conformidad con sus intereses individuales. Acelerar sus búsquedas.</li><li>Reconocerle cuando regrese de nuevo a nuestro sitio.</li></ol></li></ol><br/>Puede negarse a aceptar cookies activando la configuración en su navegador que permite rechazar las cookies. No obstante, si selecciona esta configuración, quizás no pueda acceder a determinadas partes del Sitio Web o no pueda aprovecharse de alguno de nuestros servicios. A menos que haya ajustado la configuración de su navegador de forma que rechace cookies, nuestro sistema producirá cookies cuando se conecte a nuestro sitio.</ol>";

	//Security_policy
	$s["security_policy_title"] = "Políticas de Seguridad";
	$s["security_policy_moreinfo"] = "<ol class='decimallist'><li>Cada vez que usa este sitio Web estará bajo la aplicación de la Política de Privacidad vigente en cada momento, debiendo revisar dicho texto para comprobar que está conforme con él.</li><li>Los datos personales que nos aporta serán objeto de tratamiento en un fichero responsabilidad de FASHION RETAIL ESPAÑA, S.A (\"Fashion Retail\") cuyas finalidades son:</li><ol class='romanlist'><li>el desarrollo, cumplimiento y ejecución del contrato de compraventa de los productos que ha adquirido o de cualquier otro contrato entre ambos;</li><li>atender las solicitudes que nos plantee;</li><li>proporcionarle información acerca de los productos de Zara o de otras empresas del Grupo Inditex (cuyas actividades se relacionan con los sectores de decoración, textil, de productos acabados de vestir y del hogar, así como con cualesquiera otros complementarios de los anteriores, incluidos los de cosmética y marroquinería), incluyendo, en relación con dichos productos, el envío de comunicaciones comerciales por correo electrónico o por cualquier otro medio de comunicación electrónica equivalente (como SMS) así como a través de la realización de llamadas telefónicas. Puedes cambiar tus preferencias en relación al envío de tales comunicaciones comerciales accediendo a la sección Mi cuenta.</li></ol><li>FASHION RETAIL ESPAÑA, S.A. con domicilio social en Avenida de la Diputación, Edificio Inditex, 15142 Arteixo (A Coruña), como responsable del fichero, se compromete a respetar la confidencialidad de su información de carácter personal y a garantizar el ejercicio de sus derechos de acceso, rectificación, cancelación y oposición, mediante carta dirigida a la dirección anteriormente indicada a la atención de \"Función LOPD\" o mediante el envío de un correo electrónico a funcionlopd@inditex.com, en ambos casos facilitando una fotocopia de su documento nacional de identidad, o de su pasaporte u otro documento válido que lo identifique. En el caso de que decidiese ejercer dichos derechos y que como parte de los datos personales que nos hubiera facilitado conste el correo electrónico le agradeceríamos que en la mencionada comunicación se hiciera constar específicamente esa circunstancia indicando la dirección de correo electrónico respecto de la que se ejercitan los derechos de acceso, rectificación, cancelación y oposición.</li><li>Para cumplir las finalidades anteriores, puede resultar necesario que comuniquemos o cedamos la información que nos ha proporcionado a otras sociedades integrantes del Grupo Inditex del que Fashion Retail forma parte e Industria de Diseño Textil, S.A. (Inditex, S.A.) es la sociedad holding por lo que entendemos que, al registrarse y proporcionarnos información a través de este sitio Web, nos autoriza expresamente para efectuar tales comunicaciones y/o cesiones a cualesquiera sociedades pertenecientes al Grupo Inditex.</li><li>Cookies:</li><ol class='latinlist'><li>Podemos recabar información sobre su ordenador, incluido, en su caso, su dirección de IP, sistema operativo y tipo de navegador, para la administración del sistema. Se trata de datos estadísticos sobre cómo navega por nuestro sitio Web.</li><li>Por la misma razón, podemos obtener información sobre su uso general de Internet mediante un archivo de cookies que se almacena en el disco duro de su ordenador. Las cookies contienen información que se transfiere al disco duro de su ordenador.</li><li>Las cookies nos ayudan a mejorar nuestro sitio Web y a prestar un servicio mejor y más personalizado. En concreto, nos permiten:<ol class='dotlist'><li>Hacer una estimación sobre números y patrones de uso.</li><li>Almacenar información acerca de sus preferencias y personalizar nuestro sitio web de conformidad con sus intereses individuales. Acelerar sus búsquedas.</li><li>Reconocerlte cuando regrese de nuevo a nuestro sitio.</li></ol></li></ol><br/>Puede negarse a aceptar cookies activando la configuración en su navegador que permite rechazar las cookies. No obstante, si selecciona esta configuración, quizás no pueda acceder a determinadas partes del Sitio Web o no pueda aprovecharse de alguno de nuestros servicios. A menos que haya ajustado la configuración de su navegador de forma que rechace cookies, nuestro sistema producirá cookies cuando se conecte a nuestro sitio.</ol>";

	//Contact

	//Footer

	//Company
	$s["company_info"]="<p>Desde 1986, nuestro trabajo se centra en ofrecer a la mujer las armas necesarias para poder sentirse sencillamente bien. Para ello utilizamos tejidos, patrones, diseños y complementos que conforman prendas en las que se revaloriza una silueta lo más femenina y contemporánea posible.</p><p>Tras más de 25 años trabajando con un experimentado equipo, apostando por la elaboración de prendas en talleres próximos a nuestra ubicación y ofreciendo colecciones en las que el denominador común es tanto el buen patronaje como la buena costura, creemos que hemos logrado nuestro principal objetivo. La profesionalidad, calidad y esmero con el que confeccionamos hacen que nuestra marca sea reconocida y reconocible.</p><p>La filosofía de trabajo y el perfil de mujer al que nos dirigimos, se define perfectamente por cada una de nuestras clientas. Ellas son las que le dan vida a cada prenda y las que hacen que cada colección tenga tantos significados como perfiles de mujeres existen.</p><p>Nuestra sede principal se sitúa en Vigo, desde donde hemos ido creando una sólida red comercial, en la que el concepto de internacionalización se convierte en uno de los más sólidos pilares dentro de nuestra visión empresarial. Gracias a ella, OKY^COKY está presente en diferentes puntos de venta españoles, así como en países como Portugal, Reino Unido, Irlanda, Grecia, Bélgica, Francia, Alemania, Suecia, Luxemburgo, Italia, Rusia, EEUU, Canadá, Méjico, Panamá o Japón.</p>";

	//Login
	$s["login_title"] = "Acceso";
	$s["login_moreinfo"] = "<p>Este sistema sólo está disponible para usuarios registrados. Si ya se ha registrado en el sistema introduzca su nombre de usuario y contraseña. Si no se ha registrado aún en el sistema, por favor, realice su registro a través del siguiente formulario.</p>";
	$s["login_subtitle"] = "Ya soy usuario de OKY^COKY";
	$s["login_subtitle_2"] = "Introduce tu dirección y contraseña para entrar";
	$s["login_signup_subtitle"] = "Quiero ser Usuario de OKY^COKY";
	$s["login_signup_subtitle_2"] = "Si todavía no tienes una cuenta de usuario de OKY^COKY utiliza esta opción para acceder al formulario de registro.<br/><br/>Te solicitaremos la información imprescindible para poder realizar tu compra.";
	$s["login_client_code"] = "Código de usuario";
	$s["login_client_password"] = "Contraseña";
	$s["login_client_cif"] = "CIF de cliente";
	$s["login_button"] = "Identificarme";

	$s["login_confirm_title"] = "Confirmación de email y activación";
	$s["login_confirm_moreinfo"] = "El sistema hará uso de email para enviar notificaciones, por favor revise el email que tenemos almacenado.";
	$s["login_confirm_subtitle"] = "Introduzca sus datos";
	$s["login_client_email"] = "Correo electrónico";
	$s["login_client_remail"] = "Repita correo electrónico";

	//Signup

	$s["signup_title"] = "Solicitud de acceso";
	$s["signup_moreinfo"] = "<p>Es necesario registrarse para poder realizar compras en la tienda online de Oky Coky Classics. Escoja un nombre de usuario e indíquenos una dirección de correo electrónico y una contraseña. Le enviaremos un correo electrónico para confirmar el registro.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 24 00 01</span> o en el correo electrónico <a href='mailto:classics.web@okycoky.com' class='important underline'>classics.web@okycoky.com</a></p><p>Si no ha recibido su código de activación o necesita uno nuevo, pídalo <a href='./activation_request.php' class='important underline'>aquí</a></p>";
	$s["signup_subtitle"] = "Introduzca sus datos de solicitud";
	$s["signup_client_code"] = "Código de usuario";
	$s["signup_client_email"] = "Correo electrónico";
	$s["signup_client_reemail"] = "Repetir correo electrónico";
	$s["signup_client_password"] = "Contraseña";
	$s["signup_client_repassword"] = "Repetir contraseña";
	$s["signup_button"] = "Registrarse";
	$s["access_request_title"] = "Activación Necesaria";
	$s["access_request_moreinfo"] = "<h3>Revisa tu correo, te hemos enviado un mail para que actives tu cuenta</h3><br/><h4 style='color:red'>Puede que esté en la carpeta SPAM o Correo No Deseado</h4><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Header

	$s["header_hello"] = "Hola";
	$s["welcome_info"] = "<p>Bienvenido</p><p>Puede empezar su proceso de compra seleccionando cualquiera de las categorías que se encuentran a la izquierda de su pantalla debajo de la sección “prendas”.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Cart
	$s["cart_moreinfo"] = "A continuación se muestran los detalles de su pedido, en caso de que todos los datos sean correctos pulse el botón Siguiente.";
	$s["continue_shopping"] = "Seguir comprando";

	//Cart_Confirm

	$s["cart_confirm_title"] = "Procesar propuesta de pedido";
	$s["cart_confirm_moreinfo"] = "A continuación se procederá a enviar su propuesta de pedido. Recibirá en su correo la confirmación de dicho envío y uno de nuestros comerciales se podrá en contracto con usted lo antes posible.";


	//Admin Login
	$s["admin_login_title"] = "Acceso para Administrador";
	$s["admin_login_moreinfo"] = "Sistema de acceso de administración";
	$s["admin_login_subtitle"] = "Introduzca sus datos de administrador";
	$s["admin_username"] = "Nombre de usuario";
	$s["admin_password"] = "Contraseña";
	$s["admin_login_error"] = "El nombre de usuario o la contraseña introducidos no son correctos.";

	//Admin password change
	$s["admin_passwd_change"] = "Cambiar contraseña de administrador";
	$s["admin_passwd_change_moreinfo"] = "";
	$s["admin_passwd_change_subtitle"] = "Datos de la nueva contraseña";
	$s["admin_passwd_change_success"] = "Contraseña cambiada con éxito";
	$s["admin_passwd_change_error_repasswd"] = "La contraseña nueva no coincide en ambos campos";
	$s["admin_passwd_change_error_oldpasswd"] = "La contraseña antigua es erronea";
	$s["old_password"] = "Antigua contraseña";
	$s["newpassword"] = "Nueva contraseña";
	$s["repassword"] = "Repita la nueva contraseña";

	//Admin Menu
	$s["admin_menu_title"] = "Administración";
	$s["admin_menu"] = "Área de Administración";
	$s["admin_menu_subtitle"] = "Elija una de las acciones que desea realizar";
	$s["admin_menu_moreinfo"] = "Sistema de configuración de la página de Oky^Coky";
	$s["admin_new_season_title"] = "Instalar nueva temporada";
	$s["admin_new_season_subtitle"] = "Introduzca los datos de la nueva temporada";
	$s["admin_new_season_moreinfo"] = "Sistema de instalación de nuevas temporadas. <span class='important'>La instalación de una nueva temporada eliminará los datos de la temporada anterior.</span>";
	$s["admin_new_season_name"] = "Nombre de la nueva temporada";
	$s["admin_users"] = "Administrar Usuarios";
	$s["admin_users_moreinfo"] = "<p>El sistema de administración de usuarios dentro de Oky^Coky.</p><p>El sistema de administarción de usuarios muestra información de los usuarios y las opciones de edición de sus datos (sólo los que son propios de Oky^Coky), la opción de eliminar y la de actualizar datos de la base de datos del programa de gestión de Oky^Coky.</p>";
	$s["admin_request"] = "Administrar Solicitudes";
	$s["admin_request_moreinfo"] = "<p>El sistema de administración de solicitudes muestra el listado de los clientes que han solicitado acceso al Oky^Coky.</p><p>Una vez verificada la identidad real del cliente, pulse el botón <span class='important'>Verificar</span> para que el sistema informe automáticamente al cliente que tiene acceso mediante una clave aleatoria. En caso de que dude de la identidad del cliente pulse el botón <span class='important'>Bloquear</span> para bloquear la solicitud.</p>";
	$s["admin_orders"] = "Administrar Pedidos";
	$s["admin_products"] = "Administrar Productos";
	$s["admin_products_moreinfo"] = "";
	$s["admin_payments"] = "Administrar pagos de pasarela web";
	$s["header_hello_admin"] = "Hola, Administrador";
	$s["admin_product_validate_title"] = "Validación de productos";
	$s["price"] = "Precio";
	$s["product_name"] = "Nombre del producto";
	$s["reference"] = "Referencia";
	$s["colors"] = "Colores";
	$s["description"] = "Descripción";
	$s["add_this_product"] = "Este producto se ha importado a su lista de productos en estado no visible. Los usuarios podrán verlo cuando cambie dicho estado";//"Añadir este producto";
	$s["admin_edit_product"] = "Editar";
	$s["admin_new_product"] = "Añadir producto";
	$s["product_not_found"] = "Producto no encontrado";

	//Payment_success
	$s["cart_success_title"] = "Finalizada la propuesta de pedido a Oky^Coky";
	$s["cart_success_moreinfo"] = "<p>Muchas gracias, realizar la propuesta de pedido. Nos pondremos en contacto con usted para confirmar la recepción de esta propuesta. Le hemos enviado un correo electrónico con los datos de esta propuesta a la dirección que nos ha indicado.</p><p>En caso de alguna duda envié un email a <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Products

	$s["add_cart_success"] = "Pedido actualizado";
	$s["add_cart_limit"] = "Se ha sobrepasado el límite de productos";
	$s["add_cart_size"] = "Debe elegir una talla";

	//Search
	$s["search"] = "Buscar...";
	$s["search_title"] = "Búsqueda";

	//Add_image_product

	$s["add_image_product_title"] = "Añadir imágenes del producto";
	$s["add_image_product_moreinfo"] = "Por favor, seleccione las imágenes que quiere que se muestren con este producto. Para un mejor funcionamiento del sistema, se aconseja que la resolución de las imágenes sea de 370x760, en caso de que no cumpla estás características se ajustará automáticamente, para un correcto funcionamiento de la página. ";
	$s["add_image_product_subtitle"] = "Seleccione sistema de carga";
	$s["bd_image"] = "Imagen almacenada en la base de datos";
	$s["new_image"] = "Subir nueva imagen";
	$s["old_image"] = "Imagen ya subida";

	$s["add_image_cover_title"] = "Añadir imágenes de portada";
	$s["add_image_cover_moreinfo"] = "Por favor, seleccione las imágenes que quiere que se muestren en la portada de la página. Para un mejor funcionamiento del sistema, se aconseja que la resolución de las imágenes sea de 780x500, en caso de que no cumpla estás características se ajustará automáticamente, para un correcto funcionamiento de la página.";
	$s["add_image_cover_subtitle"] = "Seleccione sistema de carga";

	$s["recover_pass_title"] = "Recuperar contraseña";
	$s["recover_pass_moreinfo"] = "Para recuperar su contraseña, introduzca su dirección de correo electrónico y se le enviará un código para que pueda cambiarla.";
	$s["recover_pass_subtitle"] = "Introduzca sus datos de usuario";
	$s["recover_pass_client_email"] = "Dirección de correo electrónico";
	$s["recover_pass_client_reemail"] = "Repita dirección de correo electrónico";
	$s["recover_pass_change_title"] = "Cambiar contraseña";
	$s["change_pass_subtitle"] = "Introduzca su nueva contraseña";
	$s["recover_pass_ok"] = "El código de recuperación ha sido aceptado.";
	$s["recover_pass_client_password"] = "Nueva contraseña";
	$s["recover_pass_client_repassword"] = "Repita nueva contraseña";
	$s["recover_pass_expired"] = "El código de recuperación ha expirado o es erroneo.";
	$s["recover_pass_success"] = "Contraseña cambiada con éxito. Pulse <a href='./login.php' class='underline important'>aquí</a> para identificarse.";
	$s["recover_pass_sended"] = "Se ha enviado a su dirección de correo electrónico un email con los pasos para recuperar la contraseña.";

	$s["recover_activation_title"] = "Nuevo código de activación";
	$s["recover_activation_moreinfo"] = "Para conseguir un nuevo código de activación, introduzca su dirección de correo electrónico. El sistema le enviará un correo con el código.";
	$s["recover_activation_subtitle"] = "Introduzca sus datos de registro";
	$s["recover_activation_client_email"] = "Dirección de correo electrónico";
	$s["recover_activation_client_reemail"] = "Repita dirección de correo electrónico";
	$s["recover_activation_sended"] = "Se ha enviado a su dirección de correo electrónico un email con los pasos para activar su cuenta.";
	$s["recover_activation_error_0"] = "No puede dejar el campo de la dirección de correo vacío.";
	$s["recover_activation_error_1"] = "La dirección de correo especificada no se encuentra pendiente de activación. Para darse de alta pinche <a href='./signup.php' class='important underline'>aquí</a>";

	//My Account
	$s["my_account"] = "Mi Cuenta";
	$s["my_account_moreinfo"] = "<p>En está página podrá hacer un seguimiento de sus pedidos y comprobar sus datos de usuario.</p>";
	$s["my_account_subtitle"] = "Elija una de las opciones que desea realizar";
	$s["my_editinfo"] = "Editar mis datos";
	$s["my_editinfo_moreinfo"] = "<p>En esta página se muestran los datos que tenemos almacenados en el sistema.</p><p>En caso de que alguno de estos datos no sea correcto o desee cambiarlo, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["my_orderslist"] = "Mostrar historial de pedidos";
	$s["my_store_info"] = "Mis datos de cliente";
	$s["change_password"] = "Cambiar contraseña";
	$s["change_email"] = "Cambiar correo electrónico";
	$s["my_orders"] = "Mis Pedidos";
	$s["my_user_data"] = "Mis Datos de usuario";


	//Edit user info
	$s["client_name"] = "Nombre";
	$s["client_code"] = "C&oacute;digo de cliente";
	$s["client_email"] = "Correo electrónico";
	$s["client_password"] = "Contrase&ntilde;a";
	$s["client_currency"] = "Moneda";
	$s["client_cif"] = "CIF";


	$s["change_pass_title"] = "Cambiar contraseña";
	$s["change_pass_moreinfo"] = "Para poder cambiar su contraseña, es necesario que nos indique también su contraseña actual.";
	$s["change_pass_client_oldpassword"] = "Contraseña actual";
	$s["change_pass_client_password"] = "Nueva contraseña";
	$s["change_pass_client_repassword"] = "Repira la nueva contraseña";
	$s["change_pass_success"] = "La nueva contraseña ha sido almacenada con éxito";

	$s["add_user"] = "Añadir usuario";
	$s["add_user_moreinfo"] = "<p>Este sistema permite añadir usuarios directamente a la red sin necesidad de conexión con la Aplicación.</p><p>Debido a que <span class='important underline'>no se encuentran dentro del programa de gestión</span>, estos usuarios <span class='important underline'>no pueden finalizar ningún pedido</span>. Para que puedan realizar estas operaciones es necesario que sean añadidos en la aplicación, que sean eliminados por el administrador y se den de alta mediante el método que siguen el resto de usuarios.</p>";
	$s["add_user_subtitle"] = "Introduzca los datos del nuevo usuario";
	$s["add_user_success"] = "</p>El usuario ha sido añadido correctamente al sistema. <a href='./admin_list_users.php' class='important underline'>Añadir más usuarios</a></p>";
	$s["add_user_error"] = "No se ha podido dar de alta el usuario. Revise los datos y vuelva a intentarlo.";
	$s["add_user_duplicate"] = "La dirección de correo electrónico ya existe en el sistema.";

	$s["edit_user"] = "Editar usuario";
	$s["edit_user_moreinfo"] = "";
	$s["edit_user_subtitle"] = "Modifique los datos del usuario";
	$s["edit_user_success"] = "</p>El usuario ha sido modificado correctamente.</p>";
	$s["edit_user_main_address"] = "Dirección principal";
	$s["edit_user_alt_address"] = "Direcciones secundarias";

	$s["signup_client_name"] = "Nombre del cliente";
	$s["signup_client_rate"] = "Tarifa";
	$s["signup_client_currency"] = "Moneda";

	$s["alert_delete_user"]="¿Quiere borrar el usuario seleccionado?. Este proceso no podrá deshacerse.";
	$s["alert_delete_order"]="¿Quiere borrar el pedido seleccionado?. Este proceso no podrá deshacerse.";
	$s["alert_stock_return"] = "¿Desea devolver el stock del pedido al sistema una vez eliminado?";
	$s["alert_delete_cartitem"]="¿Desea eliminar la prenda seleccionada del carro?";

	$s["cart_no_allow"] = "<p>Para poder comprar en Oky Coky Classics es necesario estar registrado en el sistema. Si ya estás registrado, por favor, identifícate <a href='login.php' class='important' style='font-weight: bold;'>aquí</a>, en el caso de que no te hayas registrado aún puedes hacerlo <a href='signup.php' class='important' style='font-weight: bold;'>aquí</a>.</p> <p>Para cualquier consulta contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	$s["add_payment"] = "Añadir pago mediante pasarela";
	$s["add_payment_moreinfo"] = "<p>Este sistema permite añadir pagos directos y editar los pagos ya introducidos en el sistema.</p>";
	$s["add_payment_subtitle"] = "Introduzca los datos del pedido";
	$s["id_order_final_admin"] = "Código de pedido (Utilice el código real que corresponda con el pedido)";
	$s["id_order_final"] = "Código de pedido";

	$s["amount"] = "Cantidad (Utilizar como separador decimal el punto Ej.: 2310.00)";
	$s["num_clothes"] = "Número de prendas";
	$s["is_payed"] = "¿Pagado?";
	$s["payment_code"] = "Código de seguridad";
	$s["add_payment_success"] = "</p>El pago ha sido añadido correctamente al sistema. <a href='./admin_add_payment.php' class='important underline'>Añadir más pagos</a></p>";

	$s["payments_error"] = "Los datos de pago son incorrectos, por favor revíselos y vuelva a intentarlo más tarde";

	$s["no_orders_to_display"] = "No tiene ningún pedido para mostrar.";

	$s["my_payments"] = "Mis Pagos";
	$s["delivery"] = "Enviado";

	$s["finish"] = "Finalizado";
	$s["reject"] = "Rechazar";
	$s["revision"] = "Revision";
	$s["wait_for_user"] = "Esperar validación";

	$s["status"][0] = "Revisión";
	$s["status"][1] = "Modificado y esperando revisión";
	$s["status"][2] = "Validado por el usuario";
	$s["status"][3] = "Aceptado";
	$s["status"][4] = "Enviado";
	$s["status"][5] = "Terminado";
	$s["status"][6] = "Rechazado";

	$s["my_order_error"] = "Error";
	$s["my_order_moreinfo"] = "";

	$s["my_order_state"][0]="<p>Este pedido se encuentra en proceso de revisión por nuestro equipo, lo antes posible se pondrán en contacto con usted para confirmarlo.</p>";
	$s["my_order_state"][1]="<p>Este pedido ha sido modificado por nuestro equipo, por favor revíselo y si está todo correcto pulse el botón aceptar.</p><p>En caso de que encuentre un fallo o no esté de acuerdo con los cambios realizados, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["my_order_state"][2]="<p>Este pedido ha sido modificado y aceptado sus cambios, en breve nuestro equipo validará su aceptación.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][3]="<p>Este pedido ha sido aceptado. Nuestro equipo está preparando el envío para que pueda recibirlo lo antes posible.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][4]="<p>Este pedido se encuentra en proceso de envío.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][5]="<p>Este pedido está finalizado.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][6]="<p>Este pedido ha sido rechazado por nuestro equipo.</p><p>En caso de que tenga alguna duda, por favor contacte con nuestro servicio de atención al cliente en el número <span class='important'>(+34) 986 240001</span> o en el correo electrónico <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";


	$s["image_error"] = "Solo se aceptan imágenes con extensión jpg, png o gif";
	$s["too_many_elements_1"]="Demasiados elementos seleccionados. El máximo es de ";
	$s["too_many_elements_1"]=" por color.";
	$s["client_acces_label"] ="Dar acceso al nuevo cliente.";
	$s["delete_acces_label"]="Borrar la solicitud de acceso.";
	$s["request_label"]="Solicitud";
	$s["costumer_label"]="Cliente";

	$s["cif_label"]="CIF";
	$s["name_label"]="Nombre";
	$s["email_label"]="Email";
	$s["delete_label"]="Eliminar";
	$s["no_requests"]="No hay solicitudes pendientes.";

	$s["alert_costumer_no_bd"]="El usuario que quiere validar no se encuentra en la base de datos del sistema. Es necesario realizar un alta directa, lo cual no permitirá a este usuario realizar pedidos.";
	$s["alert_costumer_delete"]="Esta solicitud se borrará del sistema. ¿Está seguro de continuar?";
	$s["payment_error"]="Ha ocurrido un error al introducir el pago en el sistema, compruebe que el código de pedido introducido es un número único y corresponde con el pago que quiere añadir al sistema.";
	$s["yes"]="Sí";
	$s["no"]="No";
	$s["add_client_error"]="No se ha creado al nuevo usuario ya que se encuentra otro usuario con correo electrónico o código de cliente igual.";

	$s["add_client_advice"]="utilice uno que sepa que no se encuentra en el programa";

	$rate_str[1] = "1";
	$rate_str[2] = "2";
	$rate_str[3] = "3";
	$rate_str[4] = "4";
	$rate_str[5] = "5";
	$rate_str[6] = "6";
	$rate_str[7] = "7";
	$rate_str[8] = "8";
	$rate_str[9] = "9";
	$rate_str[10] = "10";
	$rate_str[11] = "11";
	$rate_str[12] = "12";

	$s["euro"] = "Euro";
	$s["dolar"] = "Dolar";

	$s["choose_principal_image"]="Elegir imagen principal";
	$s["visible_to_clients"]="Visible para los clientes";
	$s["no_more_edit_products"] = "Este es el último producto de la lista.";
	$s["use_this_color"]="Usar este color";

	$s["name"]="Nombre";
	$s["code"]="Código";
	$s["actual_stock"] = "Stock actual";

	$s["washing"]="Lavado";
	$s["bleaching"]="Lejiado";
	$s["ironing"]="Planchado";
	$s["drying"]="Secado";
	$s["dry_cleaning"]="Lavado en seco";
	$s["prev"] = "Previo";
	$s["no_color_selected"]="No ha seleccionado ningún color, el artículo pasará a no estar visible";

	$s["orders_visible_label"]="Pedido pendiente de revisión";

	$s["orders_edit_label"]="Pedido revisado y en espera de que el cliente acepte el cambio";
	$s["orders_edit_acc_label"]="Pedido revisado aceptado por el cliente";
	$s["orders_accept_label"]="Pedido aceptado";
	$s["orders_waiting_label"]="Esperando pago";
	$s["orders_delevery_label"]="Pedido enviado";
	$s["orders_finish_label"]="Pedido finalizado";
	$s["orders_reject_label"]="Pedido Rechazado";
	$s["orders_details_label"]="Ver detalles del pedido";
	$s["admin_orders_moreinfo"] = "<p>Sistema de administración de pedidos</p>";
	$s["labels_title"] = "Sistema de iconos utilizados:";
	$s["show"] = "Mostrar";

	$s["in_revision"] = "En revisión";
	$s["modification_request"] = "Modificados en espera";
	$s["modification_accepted"] = "Modificados aceptados";
	$s["accepted"] = "Aceptados";
	$s["sent"] = "Enviados";
	$s["finished"] = "Finalizados";
	$s["rejected"] = "Rechazados";

	$s["table_label_status"]="Estado";
	$s["table_label_image"]="Imagen";
	$s["table_label_amount"]="Importe";
	$s["table_label_code"]="Código";
	$s["table_label_order"]="Pedido";
	$s["table_label_client"]="Cliente";
	$s["table_label_created_date"]="Fecha de creación";
	$s["table_label_total_and_clothes"]="Total y Prendas";
	$s["table_label_delete"] = "Eliminar";
	$s["table_label_family"] = "Familia";
	$s["table_label_name"] = "Nombre";
	$s["table_label_cif"]="CIF";
	$s["table_label_email"]="Email";
	$s["table_label_active"] = "Activo";
	$s["table_label_access_request"] = "Solicitud";
	$s["table_label_name_and_size_selection"]= "Nombre y selección de tallas";
	$s["table_label_unitary_price"] = "Precio unitario";
	$s["table_label_delevery_date"] = "Fecha de entrega";
	$s["table_label_serial_code"] = "Código";
	$s["table_label_color"] = "Color";
	$s["table_label_family"] = "Prenda";
	$s["table_label_num"] = "Cant.";
	$s["table_label_price"] = "Precio";
	$s["table_label_total"] = "Total";
	$s["table_label_subtotal"] = "Subtotal:";
	$s["table_label_total_clothes"] = "Total prendas:";
	$s["table_label_last_login"] = "Último Acceso";


	$s["search.."] = "Buscar...";
	$s["all"] = "Todos";

	$s["payment_done_label"]="Pago realizado";
	$s["payment_waiting_label"]="Pago no realizado";
	$s["view_payment_details"]="Ver detalles del pago";

	$s["go_payment_process"]="Acceder a pasarela de pago";
	$s["payment_done"] = "Pago realizado";
	$s["waiting_payment"] = "Esperando pago";
	$s["alert_payment_delete"]="Este pago se borrará del sistema. ¿Está seguro que desea de continuar?";

	$s["no_visible"] = "No visible";
	$s["visible"] = "Visible";

	$s["visible_product_label"]="Producto visible en tienda";
	$s["no_visible_product_label"]="Producto no visible en tienda";
	$s["details_product_label"]="Ver detalles de producto";
	$s["alert_product_delete"]="Este producto se borrará del sistema. ¿Está seguro que desea de continuar?";

	$s["access_label"]="Usuario con permiso de access completo.";
	$s["parcial_access_label"]="Usuario con permiso de access parcial (no puede realizar compras).";
	$s["no_access_label"]="Usuario sin permiso de accesso.";
	$s["user_details_label"]="Mostrar y modificar datos de un cliente";
	$s["active"]="Activo";
	$s["inactive"]="Inactivo";
	$s["rejected"]="Rechazado";

	$s["users"]="Usuarios";
	$s["orders"]="Pedidos";
	$s["products"]="Productos";
	$s["access_request"] = "Solicitud pendiente";
	$s["no_access_request"] = "Ninguna solicitud pendiente";
	$s["new_orders"] = "Nuevos pedidos";
	$s["new_modifications_accepted"] = "Nuevas revisiones aceptadas";

	$s["progress"] = "Progreso:";
	$s["percent_completed"] = "% completado";
	$s["import_msg_exist"] = "Productos que ya existían en la base de datos:";
	$s["import_msg_error"] = "Productos que han dado errores:";
	$s["import_no_msgs"] = "No hay elementos";
	$s["import_season_end"] = "Se ha terminado de importar todos los productos seleccionados de esta temporada. Pulse el botón de salir para ir al listado de productos y poder revisarlos manualmente.";
	$s["admin_product_import_title"] = "Importación de articulos";
	$s["import_finished"] = "Todos importados";

	$s["line_to_import"]="Linea a importar";
	$s["alert_choose_one_line"]="Debe seleccionar al menos una linea";
	$s["alert_season_installed_1"]="Usted va a instalar la temporada ";
	$s["alert_season_installed_2"]=". Cualquier prenda de otras temporadas será eliminada. Si esta es la temporada activa, solo se mostraran los productos aun no importados.";

	$s["total"]= "Total";
	$s["status_label"] = "Estado";
	$s["client_info_label"] = "Información del cliente";

	$s["name"]= "Nombre";
	$s["cif"] = "CIF";
	$s["email"] = "Dirección de correo electrónico";
	$s["client_comment"] = "Comentario del cliente";
	$s["no_comment"] = "Ningún comentario";
	$s["comment"] = "Comentario";
	$s["visible_to_user"] = "Visible al usuario";
	$s["no_visible_to_user"] = "No visible al usuario";

	$s["order_comment"] = "Comentario del pedido";
	$s["line_comment"] = "Comentario de línea";


	$s["login_error"]="Nombre de usuario y/o contraseña incorrectos";
	$s["login_error_inactive"]="Nombre de usuario en proceso de activación";
	$s["forgot_password"]="¿Ha perdido su contraseña?";
	$s["orders_to_validate"]="Validaciones pendientes";
	$s["payment_requests"]="Pagos pendiente";

	$s["alert_payment_other_user"]="No se pueden realizar pagos de pedidos de otros usuarios";
	$s["clothes_selector"]="Selector de prendas";
	$s["subtotal"] = "Subtotal";
	$s["description"] = "Descripción";
	$s["composition"] = "Composición";
	$s["care_instructions"] = "Instrucciones de cuidado";

	$s["team_comment"] = "Comentario de Oky^Coky";
	$s["team_info_label"] = "Información de Oky^Coky";
	$s["alert_order_rejected"] = "La propuesta de pedido ha sido cancelada y el stock ha sido devuelto automáticamente al sistema. Si vuelve a aceptar la propuesta se volverá a disminuir el stock automáticamente. En caso de que quiera modificar los valores de stock acceda a la administración de productos.";
	$s["alert_order_update"]="La propuesta de pedido ha sido actualizada correctamente. ¿Desea enviar un email al cliente?";

	$s["alert_delete_line"]="¿Quiere borrar la línea seleccionada?. Este proceso no podrá deshacerse.";
	$s["iva"] = "IVA";
	$s["req."] = "Req.";
	$s["signup_error_1"]="Puede que alguno alguno de los datos introducidos no sean correctos, revise sus datos y vuelva a intentarlo más tarde.";
	$s["signup_error_2"]="No se ha creado una nueva solicitud ya que el correo ya existe en el sistema.";
	$s["signup_error_3"]="No se ha creado una nueva solicitud ya que se hizo con anterioridad y se encuentra en espera de activación por parte del usuario. Para recibir un nuevo código de activación pulse <a href='./activation_request.php' class='important underline'>aquí</a>";

	$s["add_postage"] = "Añadir portes";
	$s["postage"] = "Portes";


	$s["front_iamge"][1]["title"] = "Vestido 3411-Gisto (Negro-M)";
	$s["front_iamge"][1]["subtitle"] = "Voile Algodón Seda";
	$s["front_iamge"][2]["title"] = "Vestido Bica 3420-BIC (Salmón-M)";
	$s["front_iamge"][2]["subtitle"] = "Satén Lunares";
	$s["front_iamge"][3]["title"] = "Pantalón Dulce 4402-Dulce (Negro-M)";
	$s["front_iamge"][3]["subtitle"] = "Algodón elástico";
	$s["front_iamge"][4]["title"] = "Blusa Pavo 3450-PAV (Verde-M)";
	$s["front_iamge"][4]["subtitle"] = "Satén volatil";
	$s["front_iamge"][5]["title"] = "Chaqueta Saxo 3404-SAX (Vainilla-M)";
	$s["front_iamge"][5]["subtitle"] = "Lino falso liso";


	$s["insert_season_end"]="Se ha finalizado de instalar la temporada, en 5 segundos será redirigido al listado de productos para revisar los datos insertados";
	$s["validate_finished"]=" Todos Revisados";
	$s["visibles"]="Visibles";

	$s["select_item"] = "Seleccione un elemento...";
	$s["select_all"] = "Marcar todos";
	$s["unselect_all"] = "Desmarcar todos";

	$s["system_config"] = "Configuración del sistema";
	$s["general_config"] = "Configuración general";
	$s["general_config_moreinfo"] = "A continuación se muestran los valores de la variables del sistema, tenga cuidado al realizar dichos cambios, ya que pueden provocar un mal funcionamiento.";
	$s["general_config_subtitle"] = "Variables generales";
	$s["activate_maintenance_label"] = "Activar modo de mantenimiento de la web";
	$s["activate_maintenance_btn"] = "Activar";

	$s["notification_email"] = "Correo electrónico de notificaciones";
	$s["url_base"] = "Ruta URL del sistema";

	$s["season_colors"] = "Colores del interfaz";
	$s["light"] = "Claro";
	$s["semilight"] = "Semi-claro";
	$s["semidark"] = "Semi-oscuro";
	$s["dark"] = "Oscuro";

	$s["limit_cart"]="Limite total de unidades por modelo";
	$s["limit_color"]="Limite de unidades por linea";

	$s["insufficient_stock"]="Una o varias de las prendas que has elegido superan nuestro stock actual, reduce el número o contacta con nuestro servicio de atención al cliente en el teléfono +34 986 240 001 para poder ayudarte.";
	$s["no_stock"] = "No tenemos stock de este producto.";

	$s["checking_stock"]="Comprobando el stock";
	$s["order_generating"]="Generando pedido";

	$s["cart_review_stock"]="No disponemos de stock para los productos marcados, pulsa en el título del artículo para ir a la página del producto.";

	$s["stock_update_time"]="Actualizar stock cada...";
	$s["minutes"]="minutos";
	$s["update_stock"]="Actualizar stock";

	$s["general_config_succesful"] = "La nueva configuración ha sido almacenada";
	$s["cover_config"] = "Configurar portada";

	$s["title"] = "Título";
	$s["subtitle"] = "Subtitulo";

	$s["covers_list"] = "Imágenes de portada actuales";
	$s["cover_list_moreinfo"] = "Para modificar una imagen de portada pulse en la lupa o elimínela pulsado en el papelera";
	$s["cover_config_moreinfo"] = "";
	$s["cover_url"] = "URL a la que apunta la imagen";
	$s["cover_title"] = "Título";
	$s["cover_subtitle"] = "Subtítulo";

	$s["cover_options"] = "Opciones de portada";

	$s["add_new_cover"] = "Añadir nueva imagen de portada";

	$s["signup_access_data"] = "Datos de acceso";
	$s["data_saved_successfully"] = "Datos guardados correctamente";

	$s["signup_address_data"] = "Datos de contacto";

	$s["my_addresses_info"] = "Mis direcciónes de envío";
	$s["my_access_info"] = "Mi información de acceso";
	$s["my_access_info_moreinfo"] = "";
	$s["my_personal_info"] = "Mi información personal";
	$s["my_personal_moreinfo"] = "Ahora puedes indicarnos una serie de datos personales que se grabarán en el sistema para facilitar tus procesos de compra. La información que nos proporciones será tratada de acuerdo a lo establecido en la Ley Orgánica de Protección de Datos y la Ley de Servicios de la Sociedad de la Información y de Comercio Electrónico. Puedes consultar nuestra política de privacidad en el siguiente <a href='./privacy_policy.php'>enlace</a>";

	$s["signup_name"] = "Nombre";
	$s["signup_subname"] = "Apellidos";
	$s["signup_dni"] = "DNI o Pasaporte";
	$s["signup_address"] = "Dirección";
	$s["signup_post_code"] = "Código Postal";
	$s["signup_town"] = "Ciudad";
	$s["signup_province"] = "Provincia";
	$s["signup_country"] = "País";
	$s["signup_mobile"] = "Teléfono (móvil)";
	$s["signup_other"] = "Teléfono (otro)";

	$s["my_address_moreinfo"] ="";

	$s["signup_client_oldemail"] = "Dirección de correo electrónico actual";
	$s["signup_client_newemail"] = "Nueva dirección de correo electrónico";
	$s["signup_client_renewemail"] = "Repetir nueva dirección de correo";

	$s["table_address"]="Dirección";
	$s["delete"] = "Eliminar";
	$s["edit"] = "Editar";
	$s["my_addresses_info_moreinfo"] = "";
	$s["add_new_address"] = "Añadir dirección";
	$s["address_data"] = "Dirección de envío";
	$s["add_edit_address"] = "Editar dirección de envío";
	$s["client_activation_success"] = "Activación realizada con éxito";
	$s["client_activation_fail"] = "Ha ocurrido un problema con su activación";

	$s["client_activation_moreinfo_success"] = "<p>Gracias por registrarse en Oky Coky.</p><p>A partir de este momento podrá realizar sus compras como usuario de la página.<br/>Por favor, pulse en \"SIGUIENTE\" para finalizar el proceso de registro aportando sus datos personales.</p>";
	$s["client_activation_moreinfo_fail"] = "<p>Ha ocurrido un error en el proceso de activación, por favor vuelva a comprar su correo electrónico y pegue la dirección URL al completo o pruebe a volver a registrarse. En caso de que este error continúe, por favor pongase en contacto con nosotros en <a href='mailto:classics@okycoky.com'>classics@okycoky.com</a>.</p><p>Muchas gracias.</p>";
	$s["thanks_title"] = "Muchas Gracias";
	$s["thanks_moreinfo"] = "<p>Queremos darte las gracias por registrarte en nuestra página, esperamos que disfrutes de nuestra selección de prendas.</p><p>En caso de que tengas alguna duda sobre el funcionamiento de la página o algún comentario que pueda ayudar a mejorarla, no dudes en contactar en <a href='mailto:classics@okycoky.com'>classics@okycoky.com</a>.</p><br/><p>El equipo de Oky^Coky.</p>";
	$s["size"] = "Talla";
	$s["admin_import_new_stock"] = "Importar Stock desde una propuesta de pedido";
	$s["admin_import_new_stock_moreinfo"] = "Importar Stock desde una propuesta de pedido";
	$s["admin_import_new_stock_subtitle"] = "Introduzca los datos de la propuesta de pedido";
	$s["receipt_to_import"] = "Código de la propuesta";
	$s["import_receiptnumber_error"] = "El campo no puede estar vacío";
	$s["import_season_error"] = "Debe seleccionar una temporada";
	$s["admin_import_new_stock_season"] = "Temporada a la que pertenece la propuesta";
	$s["price_with_discount"] = "Precio con descuento";
	$s["use_discount"] = "Usar Descuento";
	$s["select_material_image"] = "Seleccione una imagen para el material";
	$s["see_details"] = "Ver detalles";
	$s["cart_confirm"] = "Confirmar pedido";
	$s["cart_empty"] = "El carro está vacío";
	$s["order_success_title"] = "Pago realizado con éxito";
	$s["retailer_success_title"] = "Pedido añadido con éxito";
	$s["retailer_success_moreinfo"] = "Muchas gracias por tu pedido, lo antes posible nuestro equipo se pondrá en contacto contigo.";
	$s["order_address_title"] = "Datos de envío y facturación";
	$s["order_address_moreinfo"] = "Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Aenean lacinia bibendum nulla sed consectetur. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam id dolor id nibh ultricies vehicula ut id elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.";
	$s["receipt_data"] = "Datos de facturación";
	$s["receipt_data_subtitle"] = "Indique la dirección a la que desea que le enviemos la factura de su compra.";
	$s["use_same_address"] = "Usar dirección de facturación";
	$s["select_address"] = "Seleccionar";
	$s["cart_address_title"] = "Dirección de facturación y envío";
	$s["cart_address_moreinfo"] = "";
	$season_winter[0]="Primavera / Verano";
	$season_winter[1]="Otoño / Invierno";
	$s["now"] = "Ahora";
	$s["before"] = "Antes";
	$s['new_user_title'] = "Gracias por registrarte en Oky^Coky";
	$s['new_user_moreinfo'] = "Por favor, rellena tus datos de usuario.";

	$s["finish_it"] = "Finalizar";

	$s["invalid_format"] = "Formato no válido";
	$s["too_long"] = "Demasiado largo";
	$s["from_stored_addresses"] = "Direcciones almacenadas";
	$s["there_isnt_addresses_stored"] = "No hay direcciones almacenadas";
	$s["signup_city"] = "Ciudad";
	$s["close"]= "Cerrar";
	$s["year"]= "Año";
	$s["add_material_image_title"] = "Añadir imagen del material";
	$s["add_material_image_moreinfo"] = "Por favor, seleccione la imagen que quiere que se muestren con este material. Para un mejor funcionamiento del sistema, se aconseja que la resolución de las imágenes sea de 370x370.";

	$s["subname"] = "Apellidos";
	$s["password"] = "Contraseña";

	$s["invoice_address"] = "Dirección de facturación";
	$s["shipping_address"] = "Dirección de envío";

	$s["ship_method"] = "Método de envío";
	$s["ship_methods"] = "Métodos de envío";
	$s["ship_cost"] = "Gastos de envío";
	$s["admin_ship_methods"] = "Administrar métodos de envío";
	$s["add_ship_method"] = "Añadir método de envío";
	$s["add_ship_method_subtitle"] = "Introduzca los datos del método de envío";
	$s["add_ship_error"] = "Ha ocurrido un error";
	$s["add_ship_success"] = "Se ha añadido correctamente";
	$s["ship_free"] = "Gratis";
	$s["ship_free_note"] = "* para envíos gratuitos poner un 0.";
	$s["ship_method_name_es"] = "Nombre";
	$s["ship_method_descrip_es"] = "Descripción";
	$s["ship_method_price_es"] = "Precio";
	$s["ship_method_name_en"] = "Nombre en inglés";
	$s["ship_method_descrip_en"] = "Descripción en inglés";
	$s["ship_method_price_en"] = "Precio en inglés";
	$s["ship_method_price_variable"] = "El precio varía según el número de elementos. Cada ";
	$s["ship_method_price_fixed"] = "El precio es el mismo para un número máximo de elementos.";
	$s["ship_method_price_fixed_all"] = "El precio es el mismo para todo el pedido sin importar el número de elementos.";
	$s["ship_method_price_min"] = "Mínimo";
	$s["ship_method_price_max"] = "Máximo";
	$s["ship_method_price_elements"] = "elemento(s).";
	$s["ship_method_country_filter"] = "Filtrar por país";
	$s["ship_method_country_include"] = "Solo para este país.";
	$s["ship_method_country_exclude"] = "Todos los países menos este.";

	$s["ship_method_province_filter"] = "Filtrar por provincia";
	$s["ship_method_province_include"] = "Solo para esta provincia";
	$s["ship_method_province_exclude"] = "Todas las provincias menos esta";

	$s["ship_method_not_defined"] = "No se ha elegido ninguno.";
	$s["ship_method_not_suitable"] = "No hay métodos de envío disponibles para su pedido.";
	$s["ship_method_not_suitable_country"] = "No ha selecciona una dirección de envío, por favor rellene el formulario de la derecha donde se indica a dónde vamos a enviar sus prendas, <a href='#shipping_form'>pinche aquí para rellenar el formulario</a>.";
	$s["ship_method_name"] = "Nombre";
	$s["ship_method_descrip"] = "Descripción";
	$s["ship_method_price"] = "Precio";
	$s["ship_method_details_label"] = "Ver o editar datos del método de envío";
	$s["admin_ship_method_moreinfo"] = "<p>Este sistema permite añadir métodos de envío directamente a la red sin necesidad de conexión con la Aplicación.</p>";

	$s["send_email"] = "¿Desea enviar un email al cliente informándole de los cambios realizados en el pedido?";
	$s["send"] = "Enviar";
	$s["content"] = "Contenido";
	$s["subject"] = "Asunto";
	$s["send_email_title"] = "Enviar email al cliente";
	$s["send_email_moreinfo"] = "Este sistema está creado para informar a los clientes sobre datos de su pedido o razones por las que ha sido rechazado.";
	$s["send_email_button"] = "Enviar email";
	$s["add_products"] = "Añadir Producto";
	$s["family"] = "Familia";
	$s["sizing"] = "Tallaje";

	$s["status"][0] = "Revisión";
	$s["status"][1] = "Aceptado";
	$s["status"][2] = "Rechazado";
	$s["sizes"][0] = "CT";
	$s["sizes"][1] = "34, 36, 38...";
	$s["sizes"][2] = "XS, S, M...";
	$s["sizes"][3] = "--";
	$s["sizes"][4] = "70, 75, 80...";
	$s["sizes"][5] = "35, 36, 37...";

	$s["add_color"] = "Añadir Color";
	$s["internal_code"] = "Código Interno";
	$s["add_to_stock"] = "Añadir al stock";
		$s["howtobuy_info"] = "<h3>Cómo comprar en nuestra tienda online</h3><p>El proceso de compra en Oky Coky Classics es sencillo.</p><p>1.- Una vez te registres en el sistema basta con seleccionar el modelo que quieras comprar y añadirlo a tu pedido.</p><p>2.- Para comprobar las prendas que has añadido selecciona “MI PEDIDO” donde podrás, además, modificarlas.</p><p>3.- Una vez estés conforme con el pedido pulsa “SIGUIENTE” para confirmarlo.</p><p></p><p>4.- En ese momento podrás seleccionar las distintas formas de envío e indicarnos una dirección a la que enviarte la factura o el pedido (en el caso de que sea diferente a la de facturación).</p><p>5.- Recibirás una factura confirmando tu pedido y tu compra en un par de días.</p>";
	$s["howtopay_info"]="<p>Puedes realizar tus compras con Tarjeta de Crédito, para lo que hemos habilitado una pasarela de pagos al sitio seguro de LA CAIXA. En dicha pasarela se garantiza el pago seguro con los siguientes opciones: Visa, Mastercard, Maestro crédito y tarjetas de débito.</p>";
	$s["howtoshipping_info"]="
	<h3>¿Dónde puedo recibir mi pedido?</h3>
	<p>En la dirección que elijas (casa, trabajo, etc), pero no enviamos a un código postal</p>
	<h3>¿Se puede enviar a cualquier parte del mundo?</h3>
	<p>Por ahora tenemos limitado el número de paises a los cuales enviamos, si en tu país no existe método de envío contacta con nostros en <a href=’mailto:classics@okycoky.com’>classics@okycoky.com</a> y te avisaremos cuando tengamos disponible un método de envío</p>
	<h3>¿Cuánto tardará mi envío en llegar?</h3>
	<p>Los plazos de entega depende del sistema de envío que hayas seleccionado. Después de recibir una orden de pedido, nuestro equipo de Classics tarda entre uno y tres días en preparar todo el pedido y esperar la recogida de la empresa de envíos. Una vez vengan a recoger tu pedido te avisaremos vía email y te ofreceremos los datos de localización si están disponibles.</p>
	<h3>¿Cuánto son los gastos de envío?</h3>
	<p>Depende del sistema de envío que elijas, una vez has confirmado tu carro de la compra y proporciones tus datos de envío el sistema te ofrecerá las diferentes opciones que tienes para realizar el envío. Los costes de importación, tasas y cargos no están incluidos en el precio de los artículos ni en los gastos del pedido. Estos cargos adicionales son responsabilidad de comprador. Por favor, comprueba antes de realizar el pedido los costes en de importación de tu país. La compañía de envío te exigirá el pago de dichas tasas para poder recibir el paquete, no confundir con gastos adicionales de envío. En ningún caso, marcaremos los paquetes como 'regalos' o con un precio inferior al real.</p>";
	$s["howtoreturn_info"]="<h3>Política de Cambios y Devoluciones</h3>
	<p>Devolver o cambiar las prendas de tu pedido es muy sencillo. <b>Tienes un plazo de 14 días</b> desde que lo recibes para hacerlo. Solamente tienes que entrar en tu cuenta, ir al <b>TU HISTORIAL DE PEDIDOS</b>, seleccionar el pedido y empezar el proceso de devolución pulsando en <B>QUIERO REALIZAR UNA DEVOLUCIÓN</B> en todo caso siempre puedes ponerte en contacto con nosotros, bien por email (classics@okycoky.com) o por teléfono (986240001) y el proceso se inicia.</p>
	<p>Tienes que indicarnos el motivo del cambio o devolución que puede ser:
	<ul style='margin-left:35px;'>
		<li>Si necesitas otra talla / color de la prenda/s que compraste.</li>
		<li>Si por alguna razón esa/s prenda/s no te convence/n, no te sienta/n bien.</li>
		<li>Si la/s prenda/s que recibiste no satisface/n las expectativas de la/s que viste en nuestra web cuando hiciste la compra.</li>
	</ul>
	<p>En todos estos casos, las devoluciones no tienen costo para ti, son gratis.</p>
	<p>Nosotros damos aviso a la compañía de transportes para que se ponga en contacto contigo para poder organizar la recogida de la/s prenda/s. Tu deberás tener las prendas preparadas para entregar al transportista, sin uso, en su embalaje original  y con todas sus etiquetas.</p>
	<p>Una vez que la/s prendas lleguen a nuestros almacenes, nosotros comprobamos que todo está correcto y procedemos a abonar el/los importe/s de la/s prenda/s, - no así el importe del transporte - bien en la cuenta de tu tarjeta de crédito/débito o por transferencia, según hubiera sido pagado el pedido.</p>
		<p style='text-align:center;margin:20px;'><a href='./my_orderlist.php' CLASS='btn btn-dark btn-mini'>PULSA AQUÍ IR A TU HISTORIAL DE PEDIDOS</a></p>

	<h3>¿Qué plazo tengo para hacer un Cambio o Devolución?</h3>
	<p>14 días desde la fecha de recepción del pedido.</p>
	<h3>¿Cómo hago para hacer un Cambio?</h3>
	<p>Haces la devolución de la prenda que quieres cambiar y un nuevo pedido para la nueva talla/color.</p>";
	$s["contact_info"]="<p>Puede contactar con nosotros a través de nuestro servicio telefónico de atención al cliente: <span class='important'>(+34) 986 24 00 01</span> o si lo prefiere enviarnos un correo electrónico a: <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["offices_info"]="<p>Parque Tecnológico Logístico de Vigo</br>Calle C, nave C1</br>36315 VIGO</br>ESPAÑA</p>";


	$provinces[1]["value"]='01';
	$provinces[1]["name"]='Álava';
	$provinces[2]["value"]='02';
	$provinces[2]["name"]='Albacete';
	$provinces[3]["value"]='03';
	$provinces[3]["name"]='Alicante';
	$provinces[4]["value"]='04';
	$provinces[4]["name"]='Almería';
	$provinces[5]["value"]='05';
	$provinces[5]["name"]='Ávila';
	$provinces[6]["value"]='06';
	$provinces[6]["name"]='Badajoz';
	$provinces[7]["value"]='07';
	$provinces[7]["name"]='Baleares (Illes)';
	$provinces[8]["value"]='08';
	$provinces[8]["name"]='Barcelona';
	$provinces[9]["value"]='09';
	$provinces[9]["name"]='Burgos';
	$provinces[10]["value"]='10';
	$provinces[10]["name"]='Cáceres';
	$provinces[11]["value"]='11';
	$provinces[11]["name"]='Cádiz';
	$provinces[12]["value"]='12';
	$provinces[12]["name"]='Castellón';
	$provinces[13]["value"]='13';
	$provinces[13]["name"]='Ciudad Real';
	$provinces[14]["value"]='14';
	$provinces[14]["name"]='Córdoba';
	$provinces[15]["value"]='15';
	$provinces[15]["name"]='A Coruña';
	$provinces[16]["value"]='16';
	$provinces[16]["name"]='Cuenca';
	$provinces[17]["value"]='17';
	$provinces[17]["name"]='Girona';
	$provinces[18]["value"]='18';
	$provinces[18]["name"]='Granada';
	$provinces[19]["value"]='19';
	$provinces[19]["name"]='Guadalajara';
	$provinces[20]["value"]='20';
	$provinces[20]["name"]='Guipúzcoa';

	$provinces[21]["value"]='21';
	$provinces[21]["name"]='Huelva';
	$provinces[22]["value"]='22';
	$provinces[22]["name"]='Huesca';
	$provinces[23]["value"]='23';
	$provinces[23]["name"]='Jaén';
	$provinces[24]["value"]='24';
	$provinces[24]["name"]='León';
	$provinces[25]["value"]='25';
	$provinces[25]["name"]='Lleida';
	$provinces[26]["value"]='26';
	$provinces[26]["name"]='La Rioja';
	$provinces[27]["value"]='27';
	$provinces[27]["name"]='Lugo';
	$provinces[28]["value"]='28';
	$provinces[28]["name"]='Madrid';
	$provinces[29]["value"]='29';
	$provinces[29]["name"]='Málaga';
	$provinces[30]["value"]='30';
	$provinces[30]["name"]='Murcia';
	$provinces[31]["value"]='31';
	$provinces[31]["name"]='Navarra';
	$provinces[32]["value"]='32';
	$provinces[32]["name"]='Ourense';
	$provinces[33]["value"]='33';
	$provinces[33]["name"]='Asturias';
	$provinces[34]["value"]='34';
	$provinces[34]["name"]='Palencia';
	//$provinces[35]["value"]='35';
	//$provinces[35]["name"]='Las Palmas';
	$provinces[36]["value"]='36';
	$provinces[36]["name"]='Pontevedra';
	$provinces[37]["value"]='37';
	$provinces[37]["name"]='Salamanca';
	$provinces[38]["value"]='38';
	$provinces[38]["name"]='Islas Canarias ( Tenerife y Las Palmas )';
	$provinces[39]["value"]='39';
	$provinces[39]["name"]='Cantabria';
	$provinces[40]["value"]='40';
	$provinces[40]["name"]='Segovia';

	$provinces[41]["value"]='41';
	$provinces[41]["name"]='Sevilla';
	$provinces[42]["value"]='42';
	$provinces[42]["name"]='Soria';
	$provinces[43]["value"]='43';
	$provinces[43]["name"]='Tarragona';
	$provinces[44]["value"]='44';
	$provinces[44]["name"]='Teruel';
	$provinces[45]["value"]='45';
	$provinces[45]["name"]='Toledo';
	$provinces[46]["value"]='46';
	$provinces[46]["name"]='Valencia';
	$provinces[47]["value"]='47';
	$provinces[47]["name"]='Valladolid';
	$provinces[48]["value"]='48';
	$provinces[48]["name"]='Vizcaya';
	$provinces[49]["value"]='49';
	$provinces[49]["name"]='Zamora';
	$provinces[50]["value"]='50';
	$provinces[50]["name"]='Zaragoza';
	$provinces[51]["value"]='51';
	$provinces[51]["name"]='Ceuta';
	$provinces[52]["value"]='52';
	$provinces[52]["name"]='Melilla';

	$provinces_russia[1]["name"]='Adygeya';
	$provinces_russia[2]["name"]='Arkhangelsk';
	$provinces_russia[3]["name"]='Astrakhan';
	$provinces_russia[4]["name"]='Belgorad';
	$provinces_russia[5]["name"]='Bryansk';
	$provinces_russia[6]["name"]='Chechnya';
	$provinces_russia[7]["name"]='Ingushetia';
	$provinces_russia[8]["name"]='Ivanovo';
	$provinces_russia[9]["name"]='Kabardino-Balkaria';
	$provinces_russia[10]["name"]='Kalingrad';
	$provinces_russia[11]["name"]='Kalmykia';
	$provinces_russia[12]["name"]='Kaluga';
	$provinces_russia[13]["name"]='Karachay-Cherkessia';
	$provinces_russia[14]["name"]='Karelia';
	$provinces_russia[15]["name"]='Kostroma';
	$provinces_russia[16]["name"]='Krasnodar';
	$provinces_russia[17]["name"]='Kursk';
	$provinces_russia[18]["name"]='Leningrad';
	$provinces_russia[19]["name"]='Lipetsk';
	$provinces_russia[20]["name"]='Moscow';
	$provinces_russia[21]["name"]='Murmansk';
	$provinces_russia[22]["name"]='Nizhny Novgorod';
	$provinces_russia[23]["name"]='North Ossetia-Alania';
	$provinces_russia[24]["name"]='Novgorod';
	$provinces_russia[25]["name"]='Oryol';
	$provinces_russia[26]["name"]='Penza';
	$provinces_russia[27]["name"]='Pskov';
	$provinces_russia[28]["name"]='Rostov';
	$provinces_russia[29]["name"]='Ryazan';
	$provinces_russia[30]["name"]='Ryazan';
	$provinces_russia[31]["name"]='Saratov';
	$provinces_russia[32]["name"]='Smolensk';
	$provinces_russia[33]["name"]='St. Petersburg';
	$provinces_russia[34]["name"]='Tambov';
	$provinces_russia[35]["name"]='Tula';
	$provinces_russia[36]["name"]='Tver';
	$provinces_russia[37]["name"]='Vladmi';
	$provinces_russia[38]["name"]='Volgograd';
	$provinces_russia[39]["name"]='Vologda';
	$provinces_russia[40]["name"]='Voronezh';
	$provinces_russia[41]["name"]='Yaroslavl';
	$provinces_russia[42]["name"]='Other Óblast (Provinces)';
	$provinces_russia[43]["name"]='';


	$countries[0]["value"]='ES';
	$countries[0]["name"]='España';
	$countries[2]["value"]='DZ';
	$countries[2]["name"]='Algeria';
	$countries[3]["value"]='AD';
	$countries[3]["name"]='Andorra';
	$countries[4]["value"]='AO';
	$countries[4]["name"]='Angola';
	$countries[5]["value"]='AI';
	$countries[5]["name"]='Anguilla';
	$countries[6]["value"]='AG';
	$countries[6]["name"]='Antigua and Barbuda';
	$countries[7]["value"]='AR';
	$countries[7]["name"]='Argentina';
	$countries[8]["value"]='AM';
	$countries[8]["name"]='Armenia';
	$countries[9]["value"]='AW';
	$countries[9]["name"]='Aruba';
	$countries[10]["value"]='AU';
	$countries[10]["name"]='Australia';
	$countries[11]["value"]='AT';
	$countries[11]["name"]='Austria';
	$countries[12]["value"]='AZ';
	$countries[12]["name"]='Azerbaijan Republic';
	$countries[13]["value"]='BS';
	$countries[13]["name"]='Bahamas';
	$countries[14]["value"]='BH';
	$countries[14]["name"]='Bahrain';
	$countries[15]["value"]='BB';
	$countries[15]["name"]='Barbados';
	$countries[16]["value"]='BE';
	$countries[16]["name"]='Belgium';
	$countries[17]["value"]='BZ';
	$countries[17]["name"]='Belize';
	$countries[18]["value"]='BJ';
	$countries[18]["name"]='Benin';
	$countries[19]["value"]='BM';
	$countries[19]["name"]='Bermuda';
	$countries[20]["value"]='BT';
	$countries[20]["name"]='Bhutan';
	$countries[21]["value"]='BO';
	$countries[21]["name"]='Bolivia';
	$countries[22]["value"]='BA';
	$countries[22]["name"]='Bosnia and Herzegovina';
	$countries[23]["value"]='BW';
	$countries[23]["name"]='Botswana';
	$countries[24]["value"]='BR';
	$countries[24]["name"]='Brazil';
	$countries[25]["value"]='VG';
	$countries[25]["name"]='British Virgin Islands';
	$countries[26]["value"]='BN';
	$countries[26]["name"]='Brunei';
	$countries[27]["value"]='BG';
	$countries[27]["name"]='Bulgaria';
	$countries[28]["value"]='BF';
	$countries[28]["name"]='Burkina Faso';
	$countries[29]["value"]='BI';
	$countries[29]["name"]='Burundi';
	$countries[30]["value"]='KH';
	$countries[30]["name"]='Cambodia';
	$countries[31]["value"]='CA';
	$countries[31]["name"]='Canada';
	$countries[32]["value"]='CV';
	$countries[32]["name"]='Cape Verde';
	$countries[33]["value"]='KY';
	$countries[33]["name"]='Cayman Islands';
	$countries[34]["value"]='TD';
	$countries[34]["name"]='Chad';
	$countries[35]["value"]='CL';
	$countries[35]["name"]='Chile';
	$countries[36]["value"]='C2';
	$countries[36]["name"]='China';
	$countries[37]["value"]='CO';
	$countries[37]["name"]='Colombia';
	$countries[38]["value"]='KM';
	$countries[38]["name"]='Comoros';
	$countries[39]["value"]='CK';
	$countries[39]["name"]='Cook Islands';
	$countries[40]["value"]='CR';
	$countries[40]["name"]='Costa Rica';
	$countries[41]["value"]='HR';
	$countries[41]["name"]='Croatia';
	$countries[42]["value"]='CY';
	$countries[42]["name"]='Cyprus';
	$countries[43]["value"]='CZ';
	$countries[43]["name"]='Czech Republic';
	$countries[44]["value"]='CD';
	$countries[44]["name"]='Democratic Republic of the Congo';
	$countries[45]["value"]='DK';
	$countries[45]["name"]='Denmark';
	$countries[46]["value"]='DJ';
	$countries[46]["name"]='Djibouti';
	$countries[47]["value"]='DM';
	$countries[47]["name"]='Dominica';
	$countries[48]["value"]='DO';
	$countries[48]["name"]='Dominican Republic';
	$countries[49]["value"]='EC';
	$countries[49]["name"]='Ecuador';
	$countries[50]["value"]='SV';
	$countries[50]["name"]='El Salvador';
	$countries[51]["value"]='ER';
	$countries[51]["name"]='Eritrea';


	$countries[52]["value"]='ES';
	$countries[52]["name"]='España';
	$countries[53]["value"]='EE';
	$countries[53]["name"]='Estonia';
	$countries[54]["value"]='ET';
	$countries[54]["name"]='Ethiopia';
	$countries[55]["value"]='FK';
	$countries[55]["name"]='Falkland Islands';
	$countries[56]["value"]='FO';
	$countries[56]["name"]='Faroe Islands';
	$countries[57]["value"]='FM';
	$countries[57]["name"]='Federated States of Micronesia';
	$countries[58]["value"]='FJ';
	$countries[58]["name"]='Fiji';
	$countries[59]["value"]='FI';
	$countries[59]["name"]='Finland';
	$countries[60]["value"]='FR';
	$countries[60]["name"]='France';
	$countries[61]["value"]='GF';
	$countries[61]["name"]='French Guiana';
	$countries[62]["value"]='PF';
	$countries[62]["name"]='French Polynesia';
	$countries[63]["value"]='GA';
	$countries[63]["name"]='Gabon Republic';
	$countries[64]["value"]='GM';
	$countries[64]["name"]='Gambia';
	$countries[65]["value"]='DE';
	$countries[65]["name"]='Germany';
	$countries[66]["value"]='GI';
	$countries[66]["name"]='Gibraltar';
	$countries[67]["value"]='GR';
	$countries[67]["name"]='Greece';
	$countries[68]["value"]='GL';
	$countries[68]["name"]='Greenland';
	$countries[69]["value"]='GD';
	$countries[69]["name"]='Grenada';
	$countries[70]["value"]='GP';
	$countries[70]["name"]='Guadeloupe';
	$countries[71]["value"]='GT';
	$countries[71]["name"]='Guatemala';
	$countries[72]["value"]='GN';
	$countries[72]["name"]='Guinea';
	$countries[73]["value"]='GW';
	$countries[73]["name"]='Guinea Bissau';
	$countries[74]["value"]='GY';
	$countries[74]["name"]='Guyana';
	$countries[75]["value"]='HN';
	$countries[75]["name"]='Honduras';
	$countries[76]["value"]='HK';
	$countries[76]["name"]='Hong Kong';
	$countries[77]["value"]='HU';
	$countries[77]["name"]='Hungary';
	$countries[78]["value"]='IS';
	$countries[78]["name"]='Iceland';
	$countries[79]["value"]='IN';
	$countries[79]["name"]='India';
	$countries[80]["value"]='ID';
	$countries[80]["name"]='Indonesia';
	$countries[81]["value"]='IE';
	$countries[81]["name"]='Ireland';
	$countries[82]["value"]='IL';
	$countries[82]["name"]='Israel';
	$countries[83]["value"]='IT';
	$countries[83]["name"]='Italy';
	$countries[84]["value"]='JM';
	$countries[84]["name"]='Jamaica';
	$countries[85]["value"]='JP';
	$countries[85]["name"]='Japan';
	$countries[86]["value"]='JO';
	$countries[86]["name"]='Jordan';
	$countries[87]["value"]='KZ';
	$countries[87]["name"]='Kazakhstan';
	$countries[88]["value"]='KE';
	$countries[88]["name"]='Kenya';
	$countries[89]["value"]='KI';
	$countries[89]["name"]='Kiribati';
	$countries[90]["value"]='KW';
	$countries[90]["name"]='Kuwait';
	$countries[91]["value"]='KG';
	$countries[91]["name"]='Kyrgyzstan';
	$countries[92]["value"]='LA';
	$countries[92]["name"]='Laos';
	$countries[93]["value"]='LV';
	$countries[93]["name"]='Latvia';
	$countries[94]["value"]='LS';
	$countries[94]["name"]='Lesotho';
	$countries[95]["value"]='LI';
	$countries[95]["name"]='Liechtenstein';
	$countries[96]["value"]='LT';
	$countries[96]["name"]='Lithuania';
	$countries[97]["value"]='LU';
	$countries[97]["name"]='Luxembourg';
	$countries[98]["value"]='MG';
	$countries[98]["name"]='Madagascar';
	$countries[99]["value"]='MW';
	$countries[99]["name"]='Malawi';
	$countries[100]["value"]='MY';
	$countries[100]["name"]='Malaysia';
	$countries[101]["value"]='MV';
	$countries[101]["name"]='Maldives';
	$countries[102]["value"]='ML';
	$countries[102]["name"]='Mali';
	$countries[103]["value"]='MT';
	$countries[103]["name"]='Malta';
	$countries[104]["value"]='MH';
	$countries[104]["name"]='Marshall Islands';
	$countries[105]["value"]='MQ';
	$countries[105]["name"]='Martinique';
	$countries[106]["value"]='MR';
	$countries[106]["name"]='Mauritania';
	$countries[107]["value"]='MU';
	$countries[107]["name"]='Mauritius';
	$countries[108]["value"]='YT';
	$countries[108]["name"]='Mayotte';
	$countries[109]["value"]='MX';
	$countries[109]["name"]='Mexico';
	$countries[110]["value"]='MN';
	$countries[110]["name"]='Mongolia';
	$countries[111]["value"]='MS';
	$countries[111]["name"]='Montserrat';
	$countries[112]["value"]='MA';
	$countries[112]["name"]='Morocco';
	$countries[113]["value"]='MZ';
	$countries[113]["name"]='Mozambique';
	$countries[114]["value"]='NA';
	$countries[114]["name"]='Namibia';
	$countries[115]["value"]='NR';
	$countries[115]["name"]='Nauru';
	$countries[116]["value"]='NP';
	$countries[116]["name"]='Nepal';
	$countries[117]["value"]='NL';
	$countries[117]["name"]='Netherlands';
	$countries[118]["value"]='AN';
	$countries[118]["name"]='Netherlands Antilles';
	$countries[119]["value"]='NC';
	$countries[119]["name"]='New Caledonia';
	$countries[120]["value"]='NZ';
	$countries[120]["name"]='New Zealand';
	$countries[121]["value"]='NI';
	$countries[121]["name"]='Nicaragua';
	$countries[122]["value"]='NE';
	$countries[122]["name"]='Niger';
	$countries[123]["value"]='NU';
	$countries[123]["name"]='Niue';
	$countries[124]["value"]='NF';
	$countries[124]["name"]='Norfolk Island';
	$countries[125]["value"]='NO';
	$countries[125]["name"]='Norway';
	$countries[126]["value"]='OM';
	$countries[126]["name"]='Oman';
	$countries[127]["value"]='PW';
	$countries[127]["name"]='Palau';
	$countries[128]["value"]='PA';
	$countries[128]["name"]='Panama';
	$countries[129]["value"]='PG';
	$countries[129]["name"]='Papua New Guinea';
	$countries[130]["value"]='PE';
	$countries[130]["name"]='Peru';
	$countries[131]["value"]='PH';
	$countries[131]["name"]='Philippines';
	$countries[132]["value"]='PN';
	$countries[132]["name"]='Pitcairn Islands';
	$countries[133]["value"]='PL';
	$countries[133]["name"]='Poland';
	$countries[134]["value"]='PT';
	$countries[134]["name"]='Portugal';
	$countries[135]["value"]='QA';
	$countries[135]["name"]='Qatar';
	$countries[136]["value"]='CG';
	$countries[136]["name"]='Republic of the Congo';
	$countries[137]["value"]='RE';
	$countries[137]["name"]='Reunion';
	$countries[138]["value"]='RO';
	$countries[138]["name"]='Romania';
	$countries[139]["value"]='RU';
	$countries[139]["name"]='Russia';
	$countries[140]["value"]='RW';
	$countries[140]["name"]='Rwanda';
	$countries[141]["value"]='VC';
	$countries[141]["name"]='Saint Vincent and the Grenadines';
	$countries[142]["value"]='WS';
	$countries[142]["name"]='Samoa';
	$countries[143]["value"]='SM';
	$countries[143]["name"]='San Marino';
	$countries[144]["value"]='ST';
	$countries[144]["name"]='São Tomé and Príncipe';
	$countries[145]["value"]='SA';
	$countries[145]["name"]='Saudi Arabia';
	$countries[146]["value"]='SN';
	$countries[146]["name"]='Senegal';
	$countries[147]["value"]='SC';
	$countries[147]["name"]='Seychelles';
	$countries[148]["value"]='SL';
	$countries[148]["name"]='Sierra Leone';
	$countries[149]["value"]='SG';
	$countries[149]["name"]='Singapore';
	$countries[150]["value"]='SK';
	$countries[150]["name"]='Slovakia';
	$countries[151]["value"]='SI';
	$countries[151]["name"]='Slovenia';
	$countries[152]["value"]='SB';
	$countries[152]["name"]='Solomon Islands';
	$countries[153]["value"]='SO';
	$countries[153]["name"]='Somalia';
	$countries[154]["value"]='ZA';
	$countries[154]["name"]='South Africa';
	$countries[155]["value"]='KR';
	$countries[155]["name"]='South Korea';
	$countries[156]["value"]='AL';
	$countries[156]["name"]='Albania';
	$countries[157]["value"]='LK';
	$countries[157]["name"]='Sri Lanka';
	$countries[158]["value"]='SH';
	$countries[158]["name"]='St. Helena';
	$countries[159]["value"]='KN';
	$countries[159]["name"]='St. Kitts and Nevis';
	$countries[160]["value"]='LC';
	$countries[160]["name"]='St. Lucia';
	$countries[161]["value"]='PM';
	$countries[161]["name"]='St. Pierre and Miquelon';
	$countries[162]["value"]='SR';
	$countries[162]["name"]='Suriname';
	$countries[163]["value"]='SJ';
	$countries[163]["name"]='Svalbard and Jan Mayen Islands';
	$countries[164]["value"]='SZ';
	$countries[164]["name"]='Swaziland';
	$countries[165]["value"]='SE';
	$countries[165]["name"]='Sweden';
	$countries[166]["value"]='CH';
	$countries[166]["name"]='Switzerland';
	$countries[167]["value"]='TW';
	$countries[167]["name"]='Taiwan';
	$countries[168]["value"]='TJ';
	$countries[168]["name"]='Tajikistan';
	$countries[169]["value"]='TZ';
	$countries[169]["name"]='Tanzania';
	$countries[170]["value"]='TH';
	$countries[170]["name"]='Thailand';
	$countries[171]["value"]='TG';
	$countries[171]["name"]='Togo';
	$countries[172]["value"]='TO';
	$countries[172]["name"]='Tonga';
	$countries[173]["value"]='TT';
	$countries[173]["name"]='Trinidad and Tobago';
	$countries[174]["value"]='TN';
	$countries[174]["name"]='Tunisia';
	$countries[175]["value"]='TR';
	$countries[175]["name"]='Turkey';
	$countries[176]["value"]='TM';
	$countries[176]["name"]='Turkmenistan';
	$countries[177]["value"]='TC';
	$countries[177]["name"]='Turks and Caicos Islands';
	$countries[178]["value"]='TV';
	$countries[178]["name"]='Tuvalu';
	$countries[179]["value"]='UG';
	$countries[179]["name"]='Uganda';
	$countries[180]["value"]='UA';
	$countries[180]["name"]='Ukraine';
	$countries[181]["value"]='AE';
	$countries[181]["name"]='United Arab Emirates';
	$countries[182]["value"]='GB';
	$countries[182]["name"]='United Kingdom';
	$countries[183]["value"]='US';
	$countries[183]["name"]='United States';
	$countries[184]["value"]='UY';
	$countries[184]["name"]='Uruguay';
	$countries[185]["value"]='VU';
	$countries[185]["name"]='Vanuatu';
	$countries[186]["value"]='VA';
	$countries[186]["name"]='Vatican City State';
	$countries[187]["value"]='VE';
	$countries[187]["name"]='Venezuela';
	$countries[188]["value"]='VN';
	$countries[188]["name"]='Vietnam';
	$countries[189]["value"]='WF';
	$countries[189]["name"]='Wallis and Futuna Islands';
	$countries[190]["value"]='YE';
	$countries[190]["name"]='Yemen';
	$countries[191]["value"]='ZM';
	$countries[191]["name"]='Zambia';


	$s["size_guide"] = "¿Qué talla escoger?";

	$s["spain"] = "España";
	$s["france"] = "Francia";
	$s["uk"] = "R. Unido";
	$s["italy"] = "Italia";
	$s["usa"] = "USA";
	$s["japan"] = "Japón";
	$s["denmark"] = "Dinamarca";
	$s["australia"] = "Australia";

	$s["size_conversion"] = "Correspondecia de tallas";
	$s["measure_table"] = "Tabla de medidas";
	$s["chest"] = "Pecho";
	$s["waist"] = "Cintura";
	$s["hips"] = "Caderas";
	$s["sizes"] = "Tallas";

	$s["share_with_friends"] = "Compártelo con tus amigos";

	$s["no_stock_small"] = "Stock no disponible";
	$s["base_imponible"] = "Base Imponible";

	$s["send_cart_alert"] = "ATENCION:\n\nSi va ha realizar el pago con tarjeta de crédito asegúrese de que está \"autenticada\" por su banco para hacer pagos por internet.\n\nSi no es así, solicítelo en su banco (en algunos bancos se puede hacer por internet) o bien haga el pago por transferencia.\n\nMuchas gracias.";
	$s["go_to_payment_process"]="Acceder a Pasarela de Pago";
	$s["discount"]="Descuento";

	$s["more_images"] = "Imágenes del producto";

	$s["exchanges_and_returns"] = "Exchanges and Returns";
	$s["exchanges_and_returns_info"] ="";
	$s["finish_order"]="Finalizar Pedido";
	$s["bank_transfer"] = "Transferencia Bancaria";
	$s["credit_card"] = "Tarjeta de Crédito";
	$s["paypal"] = "Paypal";
	$s["drop_comment"] = "Necesitas hacernos algún comentario sobre tu pedido, escríbelo aquí";

	$s["bank_transfer_moreinfo"] = "
	<h3>Muchas gracias por comprar en nuestra tienda online</h3>
	<p>A continuación se muestran los datos necesarios para realizar el pago mediante transferencia. Una vez hayamos confirmado que la transferencia se ha hecho correctamente, nuestro equipo empezara a procesar tu pedido para que puedas tenerlo lo antes posible. Una vez hecha la transferencia procesar un pedido nos lleva entre 3 a 5 días laborales (aunque muchas veces nos lleva incluso menos), cuando el servicio de mensajería recoja el paquete en nuestro almacén, te enviaremos un email para confirmar que tu pedido ha sido enviado.</p><p><br/>Gracias.</p>";
	$s["bank_transfer_moreinfo_mail"] = "
	<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Muchas gracias por comprar en nuestra tienda online</h3>
	<p style='color:#000 !important; font-size:12px;'>A continuación se muestran los datos necesarios para realizar el pago mediante transferencia. Una vez hayamos confirmado que la transferencia se ha hecho correctamente, nuestro equipo empezara a procesar tu pedido para que puedas tenerlo lo antes posible. Una vez hecha la transferencia procesar un pedido nos lleva entre 3 a 5 días laborales (aunque muchas veces nos lleva incluso menos), cuando el servicio de mensajería recoja el paquete en nuestro almacén, te enviaremos un email para confirmar que tu pedido ha sido enviado.</p><p><br/>Gracias.</p>";

	$s["paypal_moreinfo_mail"] = "
	<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Muchas gracias por comprar en nuestra tienda online</h3>
	<p style='color:#000 !important; font-size:12px;'>El pago de tu pedido ha sido confirmado y añadido a nuestra cola de procesamiento. Nos suele llevar entre 0 y 2 días laborables preparar todo tu pedido y enviarlo. Cuando el servicio de mensajería pase a recoger tu pedido, te enviaremos un mail con los datos del envío.</p><p style='color:#000 !important; font-size:12px;'><br/> Gracias.</p>";


	$s["bank_transfer_data"]="DATOS PARA REALIZAR LA TRANSFERENCIA";
	$s["bank"] = "Banco";
	$s["swift"] = "SWIFT";
	$s["iban"]="IBAN";
	$s["account_number"]="Cuenta Beneficiario";
	$s["account_owner"] = "Beneficiario";
	$s["concept"] = "Concepto";
	$s["amount_bank"] = "Importe";
	$s["go_to_order"] = "Ir al pedido";
	$s["bank_access"] = "<h3>Generando datos para la transferencia</h3><p>Por favor, no cierre esta ventana</p>";
	$s["use_code"] = "Validar";
	$s["return/exchange"] = "Cambio/devolución";
	$s["captcha_wrong"] = "El código Captcha introducido no es válido";
	$s["captcha_empty"] = "El código Captcha es onbligatorio";
	$s["captcha_label"] = "Código Captcha";
	$s["legal_conditions"] = "Condiciones Legales";
	$s["privacy_policy"] = "Política de Privacidad";
	$s["purchase_conditions"] = "Condiciones de compra";
	$s["accept_purchase_and_legal_policies"]="Acepto las <a href='http://www.okycoky.net/classics/purchase_conditions.php'>condiciones de compra</a> y <a href='http://www.okycoky.net/classics/legal.php'>legales</a>";
		$s["order_details"] = "Detalles del Pedido";
	$s["order_comments"] = "Mensajes de Oky^Coky";
	$s["there_is_not_messages"] = "No hay ningún mensaje";
	$s["promo_code"]="Código Promoción";
	$s["promo_code_error"] = "El código promoción que ha introducido no es válido<br/><br/>Por favor, vuelva a intentarlo.";

	$s["waiting_payment"] = "Esperando confirmación de pago";
	$s["payed"] = "Pago Confirmado";
	$s["bank_transf"] = "Transf.";
	$s["payment_gateway"] = "Pasarela de Pago";

	$s["payment_method"] = "Método de Pago";

	$s["pending"] = "Pendiente";
	$s["sended"] = "Enviado";
	$s["cancel"] = "Cancelado";
	$s["processing"] = "Procesando";

	$s["choose_a_payment_method"] = "Seleccione un método de pago";

			$s["this_order_is_not_payed"] = "Este pedido no tiene el pago confirmado, si quieres volver a empezar el proceso de pago,<br/>por favor seleccione un método de pago";
			$s["this_order_is_not_payed_short"] = "Este pedido no tiene el pago confirmado, si quieres volver a empezar el proceso de pago: ";

			$s["comment_sended"] = "Comentario enviado el ";
		$s["other_seasons"] = "Otras Temporadas";



	$s["admin_client_groups"] = "Administrar grupos";
	$s["edit_client_group"] = "Editar grupo";
	$s["edit_client_group_moreinfo"] = "Editar grupo";
	$s["edit_client_group_subtitle"] = "";
	$s["add_client_group_subtitle"] = "Añadir grupo";
	$s["alert_delete_client_group"] = "Está seguro de que quiere eliminar este grupo?";
	$s["previous"] = "Anterior";

	$return_methods_s["credit_card"]="Reintegro Tarjeta";
$return_methods_s["bank_transfer"]="Ingreso Cuenta Bancaria";
$return_methods_s["gift_card"]="Tarjeta Regalo";

	$s["start_return"] = "Tramitar Devolución";


	$s["returns"]="Devoluciones";
$s["are_you_dissapointed_with_clothes"]="¿No has quedado totalmente satisfecha con las prendas?";
$s["return_moreinfo"]="Si alguna prenda no te sienta bien o no era lo que esperabas, recuerda que tienes un plazo de 14 días para realizar la devolución <b>sin ningún coste</b>";
$s["order_problems_title"]="¿Tienes alguna duda o problema con tu pedido?";
$s["order_problems_subtitle"]="Siempre puedes contactar con nosotros para que podamos ayudarte con tu pedido";
$s["returns_done"]="Devoluciones Realizadas";
$s["pending"]="Pendiente";
$s["picking_up"]="Recogiendo";
$s["verifying"]="Verificando";
$s["terminated"]="Finalizada";
$s["cancela"] = "Cancelada";
$s["return_status"] = "Estado";
$s["created"] = "Creada el";
$s["start_a_return"]="Quiero hacer una devolución";
$s["return_order"] = "Devolución Pedido";
$s["return_reason_title"]="Indícanos el motivo de tu devolución";
$s["return_reason_help"]="Siempre queremos mejorar para que disfrutes de tu compra, nuestro equipo estará encantado de intentar ayudarte para que en tu próxima compra no encuentres ningún problema";
$s["return_select_clothes_title"]="Selecciona las prendas que quieres devolver";
$s["return_select_clothes_help"]="Estas son las prendas que componen tu pedido, utiliza el selector de unidades para indicar las prendas que quieres devolver.";
$s["Amou."] = "Cant.";
$s["amount_clothes"] = "Número de Prendas";
$s["return_pickup_address_title"]="¿Dónde podemos recoger las prendas?";
$s["shipping_address"] = "Dirección de Envío";
$s["address"] = "Dirección";
$s["post_code"] = "Código Postal";
$s["city"] = "Ciudad";
$s["province"] = "Provincia";
$s["country"] = "Pais";
$s["phone"] = "Teléfono";
$s["return_pickup_address_help"]="Una vez hayas finalizado el proceso de solicitud de devolución, enviaremos a un servicio de mensajería a buscarlo a tu casa, al trabajo o a donde nos indiques.<br/><br/>No olvides incluir el teléfono móvil para que puedan localizarte en caso de tener algún problema.";
$s["return_method_title"]="Selecciona un método de Devolución";
$s["return_method"]="Método de Devolución";
$s["no_clothes_to_return"]="No se ha escogido ninguna prenda para devolver";
$s["important"] = "IMPORTANTE";
$s["print_label_info"]="Es necesario que imprimas la etiqueta de envío y que utilices la misma caja donde te hemos enviado las prendas. La etiqueta contiene un código que nos permitirá agilizar tu devolución.";
$s["print_shipping_label"]="IMPRIMIR ETIQUETA DE ENVÍO";
$s["if_you_want_to_cancel"] = "Si quieres cancelar el pedido, puedes hacerlo pulsando en el botón";
$s["cancel_order"] = "Cancelar Pedido";
$s["alert_prices_discount_ajustment"]="ATENCIÓN: Este pedido se ha realizado con código descuento, los precios han sido ajustados";
$s["add_to_favorites"] = "Añadir a Favoritos";
$s["add_to_favorites_help"] = "Dentro de nuestra tienda, puedes escoger tus prendas favoritas, así te será más fácil decidirte por las que de verdad te enamoran.";
$s["add_to_favorites_help_no_login"] = "Regístrate y podrás seleccionar tus prendas favoritas y hacer su propia colección.";
$s["people_with_this_clothe_as_favorite"] = "Personas han marcado como favorita";
$s["remove_favorite"] = "Quitar de favoritos";


$s["bank_transfer_warning"] = "<span style='font-size:24px;'>IMPORTANTE</span><BR/><BR/> PARA TENER TUS PRENDAS LO ANTES POSIBLE.<br/><br/> Envíanos el justificante de pago a classics@okycoky.com, también puedes hacerle una foto con el móvil.";

//$s["shipping_offer"]="Aprovéchate de nuestro envío Express por sólo 1€ más";
$s["shipping_offer"]="";
$s["24_shipping"]="ENVIO EN 1 - 3 DÍAS";
$s["24_shipping_display"] = "ENVÍO NAVIDAD: El envío 1 a 3 días está disponible para este producto, si realizas tu pedido antes de las 12:00 del medio día, tendrás tu pedido en 1 a 3 días en tu casa.";
$s["5_shipping"]="ENVÍO EN 5 DÍAS";
$s["5_shipping_display"] = "Los envíos que incluyan este producto estarán disponibles en 5 días.";
$s["free_return"]="DEVOLUCIÓN GRATUITA";
$s["free_return_display"] = "Si no te sienta bien la prenda, necesitas otra talla, quieres otro color o simplemente no te satisface, podrás realizar una devolución <b>totalmente gratuita de las prendas</b>. Para todos nuestros productos siempre tendrás un plazo de 14 días para realizar la devolución desde que recibes las prendas en tu casa. Para saber más lee nuestra <a href='./howtoreturn.php'> política de devoluciones</a>";
$s["need_help"]="¿NECESITAS AYUDA?";
$s["need_help_display"] = "Si tienes alguna duda, nuestro servicio de atención al cliente es de lunes a viernes de 9:00 a 15:00 en el teléfono (+34) 986 24 00 01 o si quieres contactar con nosotros vía email, envíanos un correo a classics@okycoky.com ";

$s["product_added"]="El producto ha sido añadido a su carro de la compra";

$s["vat_included"] = "IVA incluido";
$s["you_may_also_like"] = "También puede gustarte";

$s["filter_sizes"] = "Filtrar por talla: ";
$s["all_sizes"] = "Todas las tallas";
$s["favorites_empty"] = "Añade ropa a tu sección de favoritos pulsado el botón añadir a favoritos que encontrarás en cada penda";
$s["favorites_login"] = "Esta categoría permite a los usuarios registrados crear listas con sus prendas favoritas, logueate o regístrate para empezar a usarla";
$s["no_clothes_to_show"] = "Lo sentimos pero no existen productos para mostrar que se ajusten a los filtros que has seleccionado";
$s["shipping_cost"]="Métodos de envío disponibles:";
$s["customer_care"] = "Atención al cliente";
?>
