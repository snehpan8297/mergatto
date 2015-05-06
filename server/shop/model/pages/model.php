<?php

  /************************************************************
  * Mergatto
  * Author: Pablo Gutierrez Alfaro <enrealidadeshotmail@gmail.com.com>
  * Creation Modification:
  * Last Modification:
  * licensed through Copyright 2015
  *
  ************************************************************/


  /*********************************************************
  * ACTIONS
  *
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS, DATA CHECK AND INCLUDES
  *********************************************************/

  define('PATH', '../../');
  $timestamp=strtotime(date("Y-m-d H:i:s"));
  include(PATH."include/inbd.php");
  $page_path="WS::Cover";
  debug_log("START");
  $response=array();

  // Data Checks
  //if(!checkClosed()){echo json_encode($response);die();}
  //if(!checkBDConnection()){echo json_encode($response);die();}
  if(!checkAction()){echo json_encode($response);die();}
  // Get Action Data
  getActionData();


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  switch ($action){

    case "get_page":
      // Check Input Data
      switch ($action_data["page"]){

        case "return-and-shipping":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <h1>Política de Cambios y Devoluciones</h1>
      	        <p>Devolver o cambiar las prendas de tu pedido es muy sencillo. <b>Tienes un plazo de 14 días</b> desde que lo recibes para hacerlo. Solamente tienes que entrar en tu cuenta, ir al <b>TU HISTORIAL DE PEDIDOS</b>, seleccionar el pedido y empezar el proceso de devolución pulsando en <b>QUIERO REALIZAR UNA DEVOLUCIÓN</b> en todo caso siempre puedes ponerte en contacto con nosotros, bien por email (classics@okycoky.com) o por teléfono (986240001) y el proceso se inicia.</p>
      	        <p>Tienes que indicarnos el motivo del cambio o devolución que puede ser:</p>
                <ul>
      		        <li>Si necesitas otra talla&nbsp;/ color de la prenda/s que compraste.</li>
                  <li>Si por alguna razón esa/s prenda/s no te convence/n, no te sienta/n bien.</li>
                  <li>Si la/s prenda/s que recibiste no satisface/n las expectativas de la/s que viste en nuestra web cuando hiciste la compra.</li>
                </ul>
                <p>En todos estos casos, las devoluciones no tienen costo para ti, son gratis.</p>
                <p>Nosotros damos aviso a la compañía de transportes para que se ponga en contacto contigo para poder organizar la recogida de la/s prenda/s. Tu deberás tener las prendas preparadas para entregar al transportista, sin uso, en su embalaje original  y con todas sus etiquetas.</p>
                <p>Una vez que la/s prendas lleguen a nuestros almacenes, nosotros comprobamos que todo está correcto y procedemos a abonar el/los importe/s de la/s prenda/s, - no así el importe del transporte - bien en la cuenta de tu tarjeta de crédito/débito o por transferencia, según hubiera sido pagado el pedido.</p>
                <p><a href='../access/'>PULSA AQUÍ IR A TU HISTORIAL DE PEDIDOS</a></p>
                <h1>¿Qué plazo tengo para hacer un Cambio o Devolución?</h1>
                <p>14 días desde la fecha de recepción del pedido.</p>
                <h1>¿Cómo hago para hacer un Cambio?</h1>
                <p>Haces la devolución de la prenda que quieres cambiar y un nuevo pedido para la nueva talla/color.</p>
	              <h1>¿Dónde puedo recibir mi pedido?</h1>
                <p>En la dirección que elijas (casa, trabajo, etc), pero no enviamos a un código postal</p>
                <h1>¿Se puede enviar a cualquier parte del mundo?</h1>
                <p>Por ahora tenemos limitado el número de paises a los cuales enviamos, si en tu país no existe método de envío contacta con nostros en <a href='mailto:classics@okycoky.com'>classics@okycoky.com</a> y te avisaremos cuando tengamos disponible un método de envío</p>
                <h1>¿Cuánto tardará mi envío en llegar?</h1>
                <p>Los plazos de entega depende del sistema de envío que hayas seleccionado. Después de recibir una orden de pedido, nuestro equipo de Classics tarda entre uno y tres días en preparar todo el pedido y esperar la recogida de la empresa de envíos. Una vez vengan a recoger tu pedido te avisaremos vía email y te ofreceremos los datos de localización si están disponibles.</p>
                <h1>¿Cuánto son los gastos de envío?</h1>
                <p>Depende del sistema de envío que elijas, una vez has confirmado tu carro de la compra y proporciones tus datos de envío el sistema te ofrecerá las diferentes opciones que tienes para realizar el envío. Los costes de importación, tasas y cargos no están incluidos en el precio de los artículos ni en los gastos del pedido. Estos cargos adicionales son responsabilidad de comprador. Por favor, comprueba antes de realizar el pedido los costes en de importación de tu país. La compañía de envío te exigirá el pago de dichas tasas para poder recibir el paquete, no confundir con gastos adicionales de envío. En ningún caso, marcaremos los paquetes como 'regalos' o con un precio inferior al real.</p>
              </div>
            </div>
          </div>
          ";

          break;

        case "terms-and-conditions":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <h1>Condiciones Legales</h1>
                <p>El contenido de la presente Información Legal, junto con las Condiciones Generales de Venta y Política de Privacidad  tienen por finalidad informar, establecer las condiciones de uso y acceso de los usuarios a las páginas web que figuran bajo los dominios http://www.okycoky.net  y okycoky.net/classics. Las páginas y sus contenidos y marcas son propiedad y están gestionados por ROTELPA, S.A.</p>
                <h2>1. DATOS IDENTIFICATIVOS DE ROTELPA, S.A</h2>
                <p>ROTELPA es una Sociedad Anónima española, inscrita en el Registro Mercantil de Pontevedra, al Folio 106, Libro 489 de Sociedades, Hoja PO-5657, con CIF A-36641959 y con domicilio social en Parque Tecnológico Logístico, calle C, Nave C-1 (36315), de Vigo (España).</p>
                <p>Las páginas web htpp://www.okycoky.net y okycoky.net/classics, son propiedad y están gestionadas por ROTELPA SA. Para cualquier tipo de información, consulta o sugerencia, los Usuarios pueden ponerse en contacto con ROTELPA  a través de la dirección de correo electrónico info@okycoky.com o en el teléfono de Atención al Cliente nº (34) 986 240 001 y, previa cita, en la dirección Parque Tecnológico Logístico, Calle C, Nave C-1, (36315) de Vigo. </p>
                <h2>2. CONDICIONES DE USO DE LA PAGINA WEB.</h2>
                <p>La utilización de esta página web por parte del usuario se sujeta a las condiciones de uso contenidas en el presente documento y en las Condiciones Generales de Venta y Política de Privacidad, que figuran en los mentados sitios web. El acceso y navegación por las páginas web www.okycoky.net y okycoky.net/classics, y en su caso la compra de cualquier producto presente en la misma, implica que ha conocido, aceptado y consentido sin reservas la información legal, las condiciones generales de venta y la Política de Privacidad, en la versión publicada por ROTELPA en el momento del acceso a la página.</p>
                <p>ROTELPA SA puede cambiar en cualquier momento el aspecto de la pagina y las condiciones de uso, asi como los términos y condiciones que estime convenientes y producirán efectos desde el mismo momento de su publicación, por lo que es responsabilidad del Usuario leerlas para conocer su contenido.</p>
                <p>El usuario para poder efectuar algún pedido a través de la página web deberá facilitar con carácter previo sus datos personales que le son requeridos a través de un formulario para su registro, siendo responsable de garantizar que la información que ofrezca es cierta, correcta y completa, comprometiéndose a no realizar ningún pedido falso o fraudulento. Al realizar cualquier pedido a través de nuestra página, el cliente declara ser mayor de edad y con capacidad legal para celebrar contratos. El usuario consiente el uso y utilización de la información facilitada a ROTELPA SA conforme a lo establecido en la Política de Privacidad.</p>
                <p>El Usuario se compromete utilizar las páginas web www.okycoky.net y okycoky.net/classics de acuerdo con lo establecido en la legislación vigente, únicamente para realizar consultas o pedidos válidos, absteniéndose de utilizar la misma para actividades contrarias a la Ley o usos lesivos de los derechos de terceros, pudiendo en este caso ROTELPA SA, retirar la condición de cliente del sitio web y negarle al acceso a la misma, respondiendo en ese supuesto el usuario de los daños y perjuicios que pudiera ser ocasionados por el citado incumplimiento.</p>
                <h2>3. PROTECCION, PRIVACIDAD Y CONFIDENCIALIDAD DE LOS DATOS PERSONALES DE LOS USUARIOS POR PARTE DE ROTELPA, S.A. (POLITICA DE PRIVACIDAD)</h2>
                <p>ROTELPA informa que en cumplimiento de lo dispuesto en la Ley Orgánica 15/1999 de 13 de diciembre de Protección de Datos de carácter personal, y el Real Decreto 1720/2007 de 21 de Diciembre, -por el que se aprueba el desarrollo de la Ley Orgánica-, los datos de carácter personal que los Usuarios faciliten a través de la página, serán tratados de manera confidencial y de conformidad con las normas de protección de datos y serán incorporados a ficheros titularidad de ROTELPA, consintiendo expresamente a su recogida y tratamiento y utilización para fines lícitos, que tiene por finalidad la gestión y mantenimiento de nuestros servicios, indispensables para el trámite y envio de pedidos, redacción de facturas, recepción de información y publicidad de productos y servicios de ROTELPA.</p>
                <p>Siendo norma esencial por parte de ROTELPA la seguridad y la garantía y protección de la privacidad de nuestros clientes, es necesario que el Cliente que acceda a la página web para que realizar cualquier pedido que previamente haya leído y aceptado la Política de Privacidad y Protección de Datos aplicable, la cual se puede consultar mediante la activación del link “POLITICA DE PRIVACIDAD”.
                </p><p>El titular de los datos tendrá en todo momento el derecho de acceso e información, rectificación, cancelación y supresión de sus datos personales, pudiendo hacer uso en cualquier momento de la revocación del consentimiento del Usuario para el tratamiento y cesión de sus datos personales. A tales fines, el usuario podrá modificar o cancelar estos datos, bastará para ello con contactar con ROTELPA, S.A. a través del correo electrónico info@okycoky.com o por correo postal a la Att. Departamento de Atención al Cliente en la Calle C, Nave C-1, 36315, Vigo (España).</p>
                <h2>4. PROPIEDAD INTELECTUAL.</h2>
                <p>ROTELPA es titular de todos los derechos de propiedad intelectual o industrial de su página web, asi como de los elementos contenidos en la misma, como son la información de la página, su diseño gráfico y el código. Las marcas OKY ^COKY y OKY´S son también propiedad exclusiva de ROTELPA SA y están protegidas por derechos de autor u otros derechos de protección de la propiedad intelectual.</p>
                <p>En virtud de lo dispuesto en la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, distribución y comunicación pública, incluida su modalidad de puesta a disposición de la totalidad o parte de los contenidos de esta pagina web con fines comerciales en cualquier soporte y por cualquier medio técnico, sin la autorización previa de ROTELPA SA. </p>
                <p>El Usuario, se compromete a respetar los derechos de propiedad intelectual o industrial propiedad de ROTELPA SA y deberá utilizar dicho material para su uso personal y privado, únicamente en la forma que sea autorizada  por nosotros o por quienes nos otorgaron licencia para su uso. El usuario deberá abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protección o sistemas de seguridad que estuviera instalado en las páginas web. </p>
                <p>Cualquier reproducción o copia, distribución o publicación, de cualquier clase, del contenido de la información publicada en la pagina sin autorización previa y por escrito de ROTELPA  queda prohibido. La autorización para la reproducción puede solicitarse a la dirección de correo electrónico, info@okycoky.com. </p>
                <h2>5. EXCLUSION DE GARANTIAS Y RESPONSABILIDAD.</h2>
                <p>ROTELPA SA no garantiza la disponibilidad o continuidad del funcionamiento de su página web ni de la ausencia de fallos o interrupciones del servicio, o la ausencia de virus u otros componentes dañinos, por lo que se excluye cualquier responsabilidad por los daños y/o perjuicios de toda naturaleza que puedan deberse a las citadas causas, aunque intentará facilitar, en la medida de sus posibilidades, ayuda técnica a la persona afectada. </p>
                <p>La responsabilidad de ROTELPA SA respecto a cualquier producto adquirido en la pagina web, estará limitada exclusivamente al precio de compra de dicho producto. El usuario responderá de los daños y/o perjuicios de cualquier naturaleza que ROTELPA pudiera sufrir como consecuencia del incumplimiento por parte del usuario de la ley o de cualquiera de las normas recogidas en el presente Información Legal o en las condiciones generales de Venta. </p>
                <h2>6. CAUSAS DE FUERZA MAYOR.</h2>
                <p>No se podrá considerar responsable a ROTELPA SA del incumplimiento del contrato o retraso en el cumplimiento de sus obligaciones en caso de Fuerza mayor,  o provocados por causas externas  fuera de su control como disturbios, huelga total o parcial, especialmente de los servicios postales o de los medios de transporte y comunicación, accidentes o cualquier otro hecho considerado como fuerza mayor por las leyes.</p>
                <h2>7. LEGISLACION APLICABLE Y JURISDICCION.</h2>
                <p>Estas Normas se rigen por la Ley Española, que será la aplicable en lo no dispuesto en este contrato en materia de interpretación, validez y ejecución. Las presentes condiciones han sido elaboradas de conformidad con lo establecido en la Ley 34/2002, de servicios de la sociedad de la información y comercio electrónico, Ley 7/1998 sobre condiciones Generales de Contratación, la Ley 7/1996 de Comercio Minorista y el R.D.L. 1/2007 de 16 de Noviembre, por le que se aprueba el Texto refundido de la Ley General de Defensa de Consumidores y Usuarios y cuantas disposiciones legales resulten de aplicación.</p>
                <p>ROTELPA, S.A. y los Usuarios, para la resolución de cualquier controversia que pudiera surgir, con respecto a su validez, ejecución, cumplimiento o resolución, total o parcial, se someten, con renuncia expresa a su fuero propio o a cualquier otro que, en su caso, pudiera corresponderles, a la competencia de los Juzgados y Tribunales de Vigo (España). </p>
                <p>© Copyright 2014. ROTELPA, S.A. Inscrita en el Registro Mercantil de Pontevedra, al Folio 106, Libro 489 de Sociedades, Hoja PO-5657 y con CIF nº A-36641959. Versión 2014-1.</p>
              </div>
            </div>
          </div>
          ";
          break;

        case "privacy-policy":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <h1>Política de privacidad</h1>
                <p>ROTELPA SA como titular del sitio web www.okycoky.net/classics cumple todos los requisitos y Directrices de la Ley Orgánica 15/1999 de 13 de Diciembre de Protección de Datos de Carácter personal, el Real Decreto 1720/2007 de 21 de Diciembre por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica, Ley 34/2002 de 11 de Julio de Servicios de la sociedad de la información y de comercio electrónico y demás normativa vigente en cada momento y vela por garantizar un correcto uso y tratamiento de los datos personales del usuario, así como la adecuada protección, secreto y confidencialidad de los datos personales de los clientes. </p>
                <p>La privacidad y confidencialidad del cliente y de sus datos personales es importante para ROTELPA SA, motivo por el cual hemos desarrollado una Política de Privacidad en la que se desglosa como recogemos, utilizamos y almacenamos tus datos personales. </p>
                <p>Por medio de este sitio web www.okycoky.net/classics se recogen a través del formulario de la web sus datos de carácter personal necesarios para la gestión y mantenimiento de algunos de nuestros servicios, indispensables para el trámite y envío de los pedidos, la redacción de facturas, contestación a solicitudes de información, realización de ofertas y el envío de informaciones comerciales y de publicidad de productos. Al registrarse en nuestro sitio web el cliente se compromete a proporcionar sus datos personales válidos y correctos. Dichos datos son incluidos en nuestros ficheros, que se encuentran convenientemente inscritos en el Registro de la Agencia de Protección de Datos. El usuario reconoce haber sido informado por ROTELPA SA y autoriza expresamente a que sus datos de carácter personal sean incorporados a un fichero con datos de carácter personal responsabilidad de ROTELPA SA. </p>
                <p>Para el cumplimiento de sus servicios por parte de ROTELPA SA ésta  necesita la cesión de los datos recogidos a otras empresas que colaboran en la prestación del servicio, como las empresas de transporte y logística encargadas de hacer la entrega y en su caso devolución de la mercancía adquirida a través de la pagina web, e igualmente a la entidad bancaria y otras que pudieran resultar necesarias, todo ello a los únicos efectos de dar cumplimiento del contrato del cliente y las relaciones derivadas del mismo. </p>
                <p>Sin perjuicio de las finalidades que en cada caso se indiquen, dicha información será guardada y gestionada	 con	su debida confidencialidad, aplicando las medidas de	 seguridad informática establecidas en la legislación aplicable para impedir el acceso o uso indebido de sus datos su manipulación, deterioro o pérdida. </p>
                <p>ROTELPA SA adoptará todas las medidas organizativas y técnicas necesarias para evitar la alteración, perdida, tratamiento o acceso no autorizado, habida cuenta del estado de la tecnología. ROTELPA garantiza que ha adoptado las medidas oportunas de seguridad en sus instalaciones, sistemas y ficheros y asimismo, garantiza la confidencialidad de los Datos Personales, incluso una vez finalizada la relación contractual. </p>
                <p>El titular de los datos tendrá en todo momento el derecho de acceso e información, rectificación, cancelación y supresión de sus datos personales, pudiendo hacer uso en cualquier momento de la revocación del consentimiento del Usuario para el tratamiento y cesión de sus datos personales. A tales fines, Ud. podrá modificar o cancelar estos datos, bastará para ello con contactar con ROTELPA, S.A. a través del correo electrónico info@okycoky.com o por correo postal a la Att. Departamento de Atención al Cliente en la Calle C, Nave C-1, 36315, de Vigo (España). </p>
                <p>Puede también encontrar formularios para el ejercicio de sus derechos de acceso, rectificación o cancelación en relación con dichos datos en el sitio web de la Agencia de Protección de Datos. </p>
                <h1>COOKIES</h1>
                <p>Tras su registro en la pagina web www.okycoky.net/classics y durante el transcurso de sus visitas a la pagina, las cookies pueden generar ciertas informaciones que son grabadas en la memoria del disco duro. Estas informaciones son útiles para reconocerle y proponerle productos acordes con los artículos seleccionados en anteriores visitas. Por medio de las cookies, se le permite al sistema obtener información sobre el uso general de internet, ayudándonos a mejorar nuestra pagina web y poder personalizar el mismo. Estas cookies no contienen información confidencial que le pueda concernir y tampoco datos que pueda guardar en su equipo. Puede desactivar las cookies en los parámetros de su ordenador rechazando las mismas. </p>
                <p>©  Copyright 2014. ROTELPA, S.A. Inscrita en el Registro Mercantil de Pontevedra, al Folio 106, Libro 489 de Sociedades, Hoja PO-5657 y con CIF nº A-36.641.959. Versión 2014-1. </p>
              </div>
            </div>
          </div>";

          break;

        case "faq":

          $response["data"]["content"]="<img src='../media/www/photos/shop.jpg' class='product-img img-responsive full-width'/>";

          break;


        case "shop":

          $response["data"]["content"]="<img src='../media/www/photos/shop.jpg' class='product-img img-responsive full-width'/>";

          break;

        case "posts":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>


          ";

          break;

        case "about":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>

          ";

          break;

        case "contact":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>
          ";
          break;

        case "lookbook":

          $response["data"]["content"]="
          <div class='container-fluid'>
          <h1 class='text-center'>Workbook Spring/Summer 2015</h1>
          <div class='col-md-4 padding-20 text-center'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-001-1.jpg'/><br/>Look 1/100</div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-002-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-003-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-004-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-005-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-006-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-007-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-008-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-009-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-010-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-011-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-012-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-013-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-014-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-015-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-016-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-017-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-018-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-019-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-020-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-021-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-022-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-023-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-024-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-025-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-026-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-027-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-028-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-029-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-030-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-031-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-032-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-033-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-034-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-035-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-036-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-037-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-038-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-039-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-040-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-041-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-042-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-043-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-044-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-045-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-046-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-047-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-048-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-049-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-050-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-051-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-052-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-053-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-054-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-055-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-056-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-057-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-058-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-059-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-060-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-061-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-062-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-063-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-064-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-065-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-066-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-067-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-068-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-069-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-070-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-071-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-072-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-073-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-074-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-075-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-076-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-077-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-078-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-079-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-080-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-081-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-082-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-083-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-084-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-085-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-086-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-087-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-088-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-089-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-090-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-091-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-092-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-093-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-094-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-095-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-096-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-097-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-098-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-099-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-100-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-101-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-102-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-103-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-104-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-105-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-106-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-107-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-108-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-109-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-110-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-111-1.jpg'/></div>
          </div>
          ";

          break;
        default:
          $response["data"]=array();
          $response["data"]["content"]="";

      }



      break;


    default:
      notValidAction();echo json_encode($response);die();

  }

  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  debug_log("END");
  echo json_encode($response);
  die();


?>
