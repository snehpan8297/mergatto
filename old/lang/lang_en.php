<?php
	$s["payments_client_name"] = "Client's name";
	$s["payments_store_name"] = "Shop's name";
	$s["payments_email"] = "E-mail";
	$s["payments_concept"] = "Reference";
	$s["payments_amount_example"] = "Amount (Ex.: 1900,50)";
	$s["payments_amount"] = "Amount";
	$s["next"] = "Next";
	$s["back"] = "Go Back";
	$s["page"] = "Page";
	$s["articles"] = "Items";
	$s["apparel"] = "Apparel";
	$s["confirm"] = "Confirm";
	$s["exit"] = "Exit";
	$s["404_title"] = "Page not found.";
	$s["404"] = "The page you are looking for is not available.";
	$s["payments_step_1"] ="<p>Welcome to making payments to OKY^COKY.</p><p>Please fill in your name, your shop name, your email, the reference of the payment and the amount.</p><p>If you have any questions, please contact our customer service at <span class='important'>(+34) 986 240001</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	$s["contact_name"] = "Client name";
	$s["contact_shop_name"] = "Shop name";
	$s["contact_phone"] = "Phone";
	$s["contact_email"] = "E-mail";
	$s["contact_country"] = "Country";
	$s["contact_subject"] = "Subject";
	$s["contact_message"] = "Reference";
	$s["contact_send"] = "Send";

	//General
	$s["spring/summer"] = "Spring / Summer";
	$s["fall/winter"] = "Fall / Winter";
	$s["season"] = "Season";
	$s["login"] = "Login";
	$s["signup"] = "Signup";
	$s["logout"] = "Logout";
	$s["buying_guide"] = "Buying guide";
	$s["how_to_buy"] = "How to buy";
	$s["payment"] = "Payment";
	$s["shipping"] = "Shipping";
	$s["returns"] = "Returns";
	$s["exchanges"] = "Exchanges";
	$s["follow_us"] = "Follow us";
	$s["facebook"] = "Facebook";
	$s["twitter"] = "Twitter";
	$s["flickr"] = "Flickr";
	$s["youtube"] = "YouTube";
	$s["policies"] = "Policies";
	$s["environmental_policy"] = "Environmental policy";
	$s["privacy_policy"] = "Privacy policy";
	$s["purchase_conditions"] = "Purchase conditions";
	$s["company"] = "Company";
	$s["okycoky_payments"] = "Oky^Coky Payments";
	$s["about_us"] = "About us";
	$s["offices"] = "Offices";
	$s["stores"] = "Stores";
	$s["contact"] = "Contact";
	$s["language"] = "Language";
	$s["spanish"] = "Spanish";
	$s["english"] = "English";
	$s["order"] = "My order:";
	$s["order_no:"] = "Go to my order";
	$s["format_not_valid"] = "Invalid format";
	$s["obligatory_field"] = "Campo obligatorio";
	$s["name_pass_match"] = "Password can't be the same as the username";
	$s["pass_not_match"] = "Passwords do not match";
	$s["email_not_match"] = "Emails do not match";
	$s["field_too_short"] = "Too short (min. 6 characters)";
	$s["field_too_short_3"] = "Too short (min. 3 characters)";
	$s["field_too_long"] = "Too long (max. 20 characters)";
	$s["field_too_long_22"] = "Too long (max. 22 characters)";
	$s["field_too_long_email"] = "Too long (max. 40 characters)";
	$s["accept"] = "Accept";
	$s["sending"] = "Sending";
	$s["loading"] = "Loading";
	$s["cancel"] = "Cancel";
	$s["welcome"] = "Welcome";
	$s["add_to_cart"] = "Add to cart";
	$s["cart"] = "Order";
	$s["save"] = "Save";

	//Left_menu

	$s["new"] = "New";
	$s["clothes"] = "Clothes";
	$s["coats"] = "Coats";
	$s["blazers"] = "Blazers";
	$s["dresses"] = "Dresses";
	$s["skirts"] = "Skirts";
	$s["trousers"] = "Trousers";
	$s["shirts"] = "Shirts";
	$s["t-shirts"] = "T-Shirts";
	$s["shoes"] = "Shoes";
	$s["accessories"] = "Accessories";
	$s["more.."] = "More..";
	$s["news"] = "News";
	$s["trousers_oky's"] = "Trousers oky's";

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
		$s["family_by_size"] = "Size ".$s["sizes_".$_GET["t"]];
	}else{
		$s["family_by_size"] = "";

	}


	$s["family_all_visible"] = "All";
	$s["family_index"] = "Popular searches";
	$s["family_0"] = "";
$s["family_19"]="Miscellaneous";
$s["family_20"]="Fabric";
$s["family_21"]="Components";
$s["family_22"]="Tej. Muestrario";
$s["family_23"]="Coats";
$s["family_24"]="Blouses";
$s["family_25"]="T-Shirts";
$s["family_26"]="Belts";
						$s["family_27"]="Jackets";
$s["family_28"]="Cardigans";
$s["family_29"]="Scarves";
$s["family_30"]="Skirts";
$s["family_31"]="Vests";
$s["family_32"]="Trousers";
$s["family_33"]="Trousers oky's";
$s["family_36"]="Dresses";
$s["family_37"]="Tops";
$s["family_38"]="Forros";
$s["family_39"]="Accessories";
$s["family_40"]="Morocco Clothes";
$s["family_41"]="Collars";
$s["family_42"]="Shirts Dresslok";
$s["family_43"]="T-Shirts Dresslok";
$s["family_44"]="Jackets Okys";
$s["family_46"]="Gloves";
$s["family_47"]="Necklaces";
$s["family_48"]="Headdress";
$s["family_49"]="Foulards";
$s["family_50"]="Shoes";
$s["family_51"]="Stoles";
$s["family_52"]="Shorts";
$s["family_53"]="Boleros";
$s["family_54"]="Casual Jackets";
$s["family_55"]="Cardigans";
$s["family_56"]="Jumpsuits";
$s["family_57"]="Armbands";
$s["family_58"]="Earrings";
$s["family_59"]="Capes";
$s["family_60"]="Jackets";
$s["family_61"]="Shirts";
$s["family_62"]="Knitwear";
$s["family_63"]="Sweaters";

$s["family_65"]="Outfits";
$s["family_69"]="Polos";


	//Payment_confirm
	$s["payment_confirm_title"] = "Oky^Coky Payment Confirm";
	$s["payment_confirm_subtitle"] = "Confirm data";
	$s["payment_confirm_moreinfo"] = "<p>Payments at OKY^COKY is 100% reliable and secure and entirely covered by our <a href='./privacy_policy.php class='important underline' target='_blank'>privacy and security policy</a>. All personal information and bank details are treated with the utmost discretion and safety.<br/><p class='important'>If you confirm the payment form, you will be redirect to a security payment process by \"La Caixa\". This payment process is totally safe with the following options: Visa, Mastercard, bank transfer, Maestro credit and debit cards.</p><br/><p style='text-align:right;padding-right:50px;'>
		<img src='./img/visa.gif'/>
		<img src='./img/mastercard.gif'/>
	<img style='margin-left:100px' src='https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg'>
		</p><br/>";
		$s["order_confirm_moreinfo"] = "<p>You are a Retailer User, please confirm your order and our retailer team will contact you as soon as posible.</p><br/>";

	$s["pasarela_access"] = "<h3>Accessing to payment gateway..</h3><p>Please do not close this page</p>";
	$s["pasarela_save_and_access"] = "<h3>Saving order data and accessing to payment gateway..</h3><p>Please do not close this page</p>";

	//Payment_error
	$s["payment_error_title"] = "WARNING<BR/><BR/><H2>If you selected payment by transfer the payment process is finished.</H2> <BR/><H2> If you choose payment by credit card there was an error in the payment process</H2>";
	$s["payment_error_moreinfo"] = "<p>Our system had recorder your order, if you selected payment by transfer, as soon as the bank confirm the transfer our team will send your order.</p><p>If you selected payment by credit card, there was an error in the payment process, please try again or contact with our costumer service at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a>.</p><p>Thanks</p>";

	//Payment_post
	$s["payment_post_subject"] = "Oky^Coky Payment Ticket";
	$s["payment_post_title"] = "Thanks for your payment";
	$s["payment_post_subtitle"] = "Below is the Payment information.";
	$s["payment_post_transation_code"] = "Transaction code";
	$s["payment_post_date"] = "Date";
	$s["payment_post_hour"] = "Hour";
	$s["payment_post_client_name"] = "Client's name";
	$s["payment_post_shop_name"] = "Shop's name";
	$s["payment_post_email"] = "e-amil";
	$s["payment_post_concept"] = "Reference";
	$s["payment_post_amount"] = "Amount";
	$s["payment_post_moreinfo"] = "<p>The payment was successful, thanks.</p><p>Please, Do not reply this email. If you have any question send an email to <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Payment_success
	$s["payment_success_title"] = "The payment was successful";
	$s["payment_success_moreinfo"] = "
	<h3>Thanks you for your purchase</h3>
	<p>The payment was successful, thanks. We will contact you to confirm receipt of this payment. We have sent an email with the data from this payment to your email address.</p><p>If you have any question send an email to <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Payments
	$s["payments_title"] = "Oky^Coky payment";
	$s["payments_subtitle"] = "Fill out the following payment details";
	$s["payments_moreinfo"] = "* Required field";

	//Privacy_policy
	$s["privacy_policy_title"] = "Oky^Coky privacy & security policies";
	$s["privacy_policy_moreinfo"] = "<ol class='decimallist'><li>CEvery time you use this Web site will be under the application of the Privacy Policy valid at any time, you should review this text to ensure you agreed with it.</li><li>Personal data that gives us will be processed in a file for ROTELPA, SA (\"Fashion Retail\") whose aims are:</li><ol class='romanlist'><li>the development, implementation and execution of the contract of sale of the products you have purchased or any other contract between the two;</li><li>accommodate requests we raise;</li><li>provide information about products ROTELPA, SA, including, in relation to such products, sending commercial communications by e-mail or any other means of electronic communication (like SMS) and through a phone call . You can change your preferences in respect of receiving such communications by logging into the My Account section.</li></ol><li>ROTELPA, S.A. established in CL. VEIGUIÑA, 40 - LOW, 36212, Vigo (Pontevedra), as the file, undertakes to respect the confidentiality of your personal information and to ensure the exercise of their rights of access, rectification, cancellation and opposition by writing to the above address to the attention of \"LOPD attendant\" or by sending an email to INTERNET@OKYCOKY.COM, in both cases providing a photocopy of your identity card or your passport or other valid form identify. If you decide to exercise those rights and that as part of the personal information you have provided e-mail stating we would appreciate that such communication was made specifically stating that circumstance indicating the email regarding the exercisers rights of access, rectification, cancellation and opposition.</li><li>Cookies:</li><ol class='latinlist'><li>We may collect information about your computer, including, where applicable, your IP address, operating system and browser type, for system administration. This is statistical data about browsing our website.</li><li>For the same reason, we may obtain information about your general internet usage by using a cookie file which is stored on the hard drive of your computer. Cookies contain information that is transferred to your computer's hard disk.</li><li>Cookies help us to improve our Web site and to deliver a better and more personalized service. Specifically, we can:<ol class='dotlist'><li>estimate numbers and patterns.</li><li>Store information about your preferences and customize our site according to your individual interests. Speed ​​up your searches.</li><li>recognize you when you return back to our site.</li></ol></li></ol><br/>You may refuse to accept cookies by activating the setting on your browser which allows you to reject cookies. However, if you select this setting you may be unable to access certain parts of the Website or unable to take advantage of any of our services. Unless you have adjusted your browser setting so that it will refuse cookies, our system will issue cookies when you log on to our site.</ol>";

	//Security_policy
	$s["security_policy_title"] = "Security policies";
	$s["security_policy_moreinfo"] = "<ol class='decimallist'><li>Cada vez que usa este sitio Web estará bajo la aplicación de la Política de Privacidad vigente en cada momento, debiendo revisar dicho texto para comprobar que está conforme con él.</li><li>Los datos personales que nos aporta serán objeto de tratamiento en un fichero responsabilidad de FASHION RETAIL ESPAÑA, S.A (\"Fashion Retail\") cuyas finalidades son:</li><ol class='romanlist'><li>el desarrollo, cumplimiento y ejecución del contrato de compraventa de los productos que ha adquirido o de cualquier otro contrato entre ambos;</li><li>atender las solicitudes que nos plantee;</li><li>proporcionarle información acerca de los productos de Zara o de otras empresas del Grupo Inditex (cuyas actividades se relacionan con los sectores de decoración, textil, de productos acabados de vestir y del hogar, así como con cualesquiera otros complementarios de los anteriores, incluidos los de cosmética y marroquinería), incluyendo, en relación con dichos productos, el envío de comunicaciones comerciales por correo electrónico o por cualquier otro medio de comunicación electrónica equivalente (como SMS) así como a través de la realización de llamadas telefónicas. Puedes cambiar tus preferencias en relación al envío de tales comunicaciones comerciales accediendo a la sección Mi cuenta.</li></ol><li>FASHION RETAIL ESPAÑA, S.A. con domicilio social en Avenida de la Diputación, Edificio Inditex, 15142 Arteixo (A Coruña), como responsable del fichero, se compromete a respetar la confidencialidad de su información de carácter personal y a garantizar el ejercicio de sus derechos de acceso, rectificación, cancelación y oposición, mediante carta dirigida a la dirección anteriormente indicada a la atención de \"Función LOPD\" o mediante el envío de un correo electrónico a funcionlopd@inditex.com, en ambos casos facilitando una fotocopia de su documento nacional de identidad, o de su pasaporte u otro documento válido que lo identifique. En el caso de que decidiese ejercer dichos derechos y que como parte de los datos personales que nos hubiera facilitado conste el correo electrónico le agradeceríamos que en la mencionada comunicación se hiciera constar específicamente esa circunstancia indicando la dirección de correo electrónico respecto de la que se ejercitan los derechos de acceso, rectificación, cancelación y oposición.</li><li>Para cumplir las finalidades anteriores, puede resultar necesario que comuniquemos o cedamos la información que nos ha proporcionado a otras sociedades integrantes del Grupo Inditex del que Fashion Retail forma parte e Industria de Diseño Textil, S.A. (Inditex, S.A.) es la sociedad holding por lo que entendemos que, al registrarse y proporcionarnos información a través de este sitio Web, nos autoriza expresamente para efectuar tales comunicaciones y/o cesiones a cualesquiera sociedades pertenecientes al Grupo Inditex.</li><li>Cookies:</li><ol class='latinlist'><li>Podemos recabar información sobre su ordenador, incluido, en su caso, su dirección de IP, sistema operativo y tipo de navegador, para la administración del sistema. Se trata de datos estadísticos sobre cómo navega por nuestro sitio Web.</li><li>Por la misma razón, podemos obtener información sobre su uso general de Internet mediante un archivo de cookies que se almacena en el disco duro de su ordenador. Las cookies contienen información que se transfiere al disco duro de su ordenador.</li><li>Las cookies nos ayudan a mejorar nuestro sitio Web y a prestar un servicio mejor y más personalizado. En concreto, nos permiten:<ol class='dotlist'><li>Hacer una estimación sobre números y patrones de uso.</li><li>Almacenar información acerca de sus preferencias y personalizar nuestro sitio web de conformidad con sus intereses individuales. Acelerar sus búsquedas.</li><li>Reconocerle cuando regrese de nuevo a nuestro sitio.</li></ol></li></ol><br/>Puede negarse a aceptar cookies activando la configuración en su navegador que permite rechazar las cookies. No obstante, si selecciona esta configuración, quizás no pueda acceder a determinadas partes del Sitio Web o no pueda aprovecharse de alguno de nuestros servicios. A menos que haya ajustado la configuración de su navegador de forma que rechace cookies, nuestro sistema producirá cookies cuando se conecte a nuestro sitio.</ol>";

	//Contact

	//Footer

	//Company
	$s["company_info"]="<p>Since 1986 our aim has been to offer women the necessary tools to be able to dress simply and well. For this we use fabrics, shapes, designs and accessories which make our clothes comfortable but feminine and up to date.</p><p>After more than 25 years working with an experienced team, we believe we have achieved this principal aim alongside the influencing factors of well made clothes and good fit accomplished by developing our manufacturing base with factories and workshops nearby so as to achieve control and consistency of quality.</p><p>The profile of women we create for is defined perfectly by each of our clients. They are who give life to our clothes and permits each collection to have as many facets as there are varieties of women.</p><p>Our Head Office is located in Vigo, Spain. From here we have created a solid commercial distribution based on international expansion having created a full distribution network throughout Spain. Thanks to this dual development OKY COKY can be found not only in Spain but in other countries such as Portugal, United Kingdom, Irealnd, Greece, Belgium, France, Germany, Sweden, Luxemburgh, Italy, Russia, USA, Canada, Mexico, Panama and Japan.</p>";

	//Login
	$s["login_title"] = "Login";
	$s["login_moreinfo"] = "<p>This system is only available for registered users. .If you have already registered in the system enter your user name and password. If you have not yet registered in the system, please make your registration via the next form.</p>";
	$s["login_subtitle"] = "Existing OKY^COKY CUSTOMER";
	$s["login_subtitle_2"] = "Enter your e-mail address and password to log in";
	$s["login_signup_subtitle"] = "New OKY^COKY Customer";
	$s["login_signup_subtitle_2"] = "If you still don't have a OKY^COKY account, use this option to access the registration form.<br/><br/>
By giving us your details, you can purchase in OKY^COKY shop.";
	$s["login_client_code"] = "User code";
	$s["login_client_password"] = "Password";
	$s["login_client_cif"] = "Client Identification Number";
	$s["login_button"] = "Login";

	$s["login_confirm_title"] = "Email and activation's confirm";
	$s["login_confirm_moreinfo"] = "The system will use your email to send notifications, please check the email that we have in our database.";
	$s["login_confirm_subtitle"] = "Your data";
	$s["login_client_email"] = "User email";
	$s["login_client_remail"] = "Repeat email";

	//Signup

	$s["signup_title"] = "Access request";
	$s["signup_moreinfo"] = "<p>You must register to be able to make purchases in the online store Oky Coky Classics. Choose a username and provide us an email address and a password. We will send you an email to confirm registration.</p><p>In case you have any questions please contact our customer service at <span class='important'>(+34) 986 24 00 01</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p><p> If you have not received your activation code or need a new one, request it <a href='./activation_request.php' class='important underline'> here </a></p>";
	$s["signup_subtitle"] = "Access request's data";
	$s["signup_client_code"] = "Client's code";
	$s["signup_client_email"] = "Email";
	$s["signup_client_reemail"] = "Repeat email";
	$s["signup_client_password"] = "Password";
	$s["signup_client_repassword"] = "Repeat password";
	$s["signup_button"] = "Signup";
	$s["access_request_title"] = "Acces request sent successfully";
	$s["access_request_moreinfo"] = "<p>Thanks for send us the access request, you'll receive in a few minutes an email to activate your account <b>if you don't receive an email please check your spam account</b>.</p><p>If you have any questions, please contact our customer service at <span class='important'>(+34) 986 240001</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Header

	$s["header_hello"] = "Hello";
	$s["welcome_info"] = "<p>Welcome.</p><p>You can start your buy process by selecting any of the categories in the left of your screen under \"clothes\".</p><p>if you have any questions, please contact our customer service at <span class='important'>(+34) 986 240 001</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Cart
	$s["cart_moreinfo"] = "Below you can check the order's data. If everything is right, please press next.";
	$s["continue_shopping"] = "Keep buying";

	//Cart_Confirm

	$s["cart_confirm_title"] = "Send order request";
	$s["cart_confirm_moreinfo"] = "<p>The next step will send a order request. The system will send you an email with the order request confirmation, as soon as possible our team will contact you to validate your order.</p>";


	//Admin Login
	$s["admin_login_title"] = "Admin access";
	$s["admin_login_moreinfo"] = "Admin access system";
	$s["admin_login_subtitle"] = "Admin data";
	$s["admin_username"] = "Username";
	$s["admin_password"] = "Password";
	$s["admin_login_error"] = "Username or password are incorrect, please check them and try again later.";

	//Admin password change
	$s["admin_passwd_change"] = "Change admin's password";
	$s["admin_passwd_change_moreinfo"] = "";
	$s["admin_passwd_change_subtitle"] = "New password data";
	$s["admin_passwd_change_success"] = "Password changed successfully";
	$s["admin_passwd_change_error_repasswd"] = "New password fields don't match";
	$s["admin_passwd_change_error_oldpasswd"] = "Old password is wrong";
	$s["old_password"] = "Old password";
	$s["newpassword"] = "New password";
	$s["repassword"] = "Repeat new password";

	//Admin Menu
	$s["admin_menu_title"] = "Administration";
	$s["admin_menu"] = "Admin area";
	$s["admin_menu_subtitle"] = "Choose an action";
	$s["admin_menu_moreinfo"] = "Oky^Coky configuration system";
	$s["admin_new_season_title"] = "Install a new season";
	$s["admin_new_season_subtitle"] = "New season data";
	$s["admin_new_season_moreinfo"] = "New season install System. <span class='important'>The new install will erase all the product information stored.</span>";
	$s["admin_new_season_name"] = "New season's name";
	$s["admin_users"] = "Admin users";
	$s["admin_users_moreinfo"] = "<p>Oky^Coky users administration system.</p><p>The user administration system shows user general information, edit & erase options.</p>";
	$s["admin_request"] = "Admin access request";
	$s["admin_request_moreinfo"] = "<p>The access request system shows a list of the clients who have asked access to Oky^Coky.</p><p>Once verified the customer identity, press the button <span class='important'>Verify</span> so the system will inform the client that access has benn granted by a random password. If you doubt about the customer identity press the button <span class='important'>Block</span> for blocking the request.</p>";
	$s["admin_orders"] = "Admin Orders";
	$s["admin_products"] = "Admin Products";
	$s["admin_products_moreinfo"] = "";
	$s["admin_payments"] = "Admin web process payments";
	$s["header_hello_admin"] = "Hello, Admin";
	$s["admin_product_validate_title"] = "Product Validation";
	$s["price"] = "Price";
	$s["product_name"] = "Product's name";
	$s["reference"] = "Reference";
	$s["colors"] = "Colors";
	$s["description"] = "Description";
	$s["add_this_product"] = "This product has been added to your product list as no visible. Users will be able to see it when you change that state";//"Add this product";
	$s["admin_edit_product"] = "Edit";
	$s["admin_new_product"] = "Add product";
	$s["product_not_found"] = "Product not found";

	//cart_success
	$s["cart_success_title"] = "Oky^Coky order request sended";
	$s["cart_success_moreinfo"] = "<p>Thanks for using Oky^Coky. Our team will contact you as soon as possible to confirm your order. Please, check your eamil the system sent you an email with all the order data.</p><p>If you have any questions, please contact our customer service at <span class='important'>(+34) 986 240001</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	//Products

	$s["add_cart_success"] = "Order updated";
	$s["add_cart_limit"] = "the product number has exceeded the limit";
	$s["add_cart_size"] = "You must select a sizing";

	//Search
	$s["search"] = "Search...";
	$s["search_title"] = "Search";

	//Add_image_product

	$s["add_image_product_title"] = "Add product images";
	$s["add_image_product_moreinfo"] = "Please, choose the images you want to be shown with this product. For a better visualization it is suggested to use an image resolution of 370x760, in case this doesnt fit this size, it will be fitted for a correct page visualization. ";
	$s["add_image_product_subtitle"] = "Choose load system";
	$s["bd_image"] = "Database Image";
	$s["new_image"] = "Upload new image";
	$s["old_image"] = "Image already uploaded";

	$s["add_image_cover_title"] = "Add frontpage images";
	$s["add_image_cover_moreinfo"] = "Please, choose the images you want to be shown at the frontpage. For a better visualization it is suggested to use an image resolution of 780x500, in case this doesnt fit this size, it will be fitted for a correct page visualization. ";
	$s["add_image_cover_subtitle"] = "Choose load system";

	$s["recover_pass_title"] = "Password recovery";
	$s["recover_pass_moreinfo"] = "To use the password recovery system fill the formulary with your email account. The system will send you a link with a code to update the password.";
	$s["recover_pass_subtitle"] = "User data";
	$s["recover_pass_client_email"] = "Email";
	$s["recover_pass_client_reemail"] = "Repeat email";
	$s["recover_pass_change_title"] = "Change your password";
	$s["change_pass_subtitle"] = "New password";
	$s["recover_pass_ok"] = "The recovery security code has been accepted.";
	$s["recover_pass_client_password"] = "New password";
	$s["recover_pass_client_repassword"] = "Repeat new password.";
	$s["recover_pass_expired"] = "Recover code is wrong or has expired.";
	$s["recover_pass_success"] = "Password successfully changed. Press <a href='./login.php' class='underline important'>here</a> for login.";
	$s["recover_pass_sended"] = "An email has been sent to your email address with the steps for password recovery.";

	$s["recover_activation_title"] = "New activation code";
	$s["recover_activation_moreinfo"] = "To get a new activation code fill the formulary with your email account. The system will send you an email with the code.</p>";
	$s["recover_activation_subtitle"] = "Registration data";
	$s["recover_activation_client_email"] = "Email";
	$s["recover_activation_client_reemail"] = "Repeat email";
	$s["recover_activation_sended"] = "An email has been sent to your email address with the steps to activate your account.";
	$s["recover_activation_error_0"] = "Email field can not be empty.";
	$s["recover_activation_error_1"] = "The specified email address is not pending activation. To sign up click <a href='./signup.php' class='important underline'>here</a>";

	//My Account
	$s["my_account"] = "My account";
	$s["my_account_moreinfo"] = "<p>This page lets you follow your orders and check your customer data.</p>";
	$s["my_account_subtitle"] = "Choose an option";
	$s["my_editinfo"] = "Edit my user data";
	$s["my_editinfo_moreinfo"] = "<p>This page show the data we have saved in the system.</p><p>If any of this data is wrong, please contact our customer service at <span class='important'>(+34) 986 240001</span> or email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["my_orderslist"] = "Show order list";
	$s["my_store_info"] = "My customer data";
	$s["change_password"] = "Change password";
	$s["change_email"] = "Change email";
	$s["my_orders"] = "My orders";
	$s["my_user_data"] = "My user data";


	//Edit user info
	$s["client_name"] = "Name";
	$s["client_code"] = "Client code";
	$s["client_email"] = "E-mail";
	$s["client_password"] = "Password";
	$s["client_currency"] = "Currency";
	$s["client_cif"] = "CIF";


	$s["change_pass_title"] = "Change Password";
	$s["change_pass_moreinfo"] = "For changing your password you need to user your actual password.";
	$s["change_pass_client_oldpassword"] = "Actual password";
	$s["change_pass_client_password"] = "New password";
	$s["change_pass_client_repassword"] = "Repeat new password";
	$s["change_pass_success"] = "Successful password save";

	$s["add_user"] = "Add user";
	$s["add_user_moreinfo"] = "<p>This system lets you add user directly to the network without needing the application conection..</p><p>Becaouse <span class='important underline'>They are not in the gestion program</span>, these users <span class='important underline'>are not allowed to finish any order</span>. If you want to let them do these operations, you have to add them to the application, delete them by the administrator and make a new signup.</p>";
	$s["add_user_subtitle"] = "Insert user data";
	$s["add_user_success"] = "</p>The user has been added correctly to the system. <a href='./admin_list_users.php' class='important underline'>Add more users</a></p>";
	$s["add_user_error"] = "Ther was an error and the user has not been added. Please verify the data and try again.";
	$s["add_user_duplicate"] = "E-mail is already in the system.";

	$s["edit_user"] = "Edit user";
	$s["edit_user_moreinfo"] = "";
	$s["edit_user_subtitle"] = "Modify user data";
	$s["edit_user_success"] = "</p>User data has been modified successfully.</p>";
	$s["edit_user_main_address"] = "Main address";
	$s["edit_user_alt_address"] = "Secondary addresses";

	$s["signup_client_name"] = "Customer name";
	$s["signup_client_rate"] = "Rate";
	$s["signup_client_currency"] = "Currency";

	$s["alert_delete_user"]="¿Do you want to delete selected user?. This process can't be undone.";
	$s["alert_delete_user"]="¿Do you want to delete selected order?. This process can't be undone.";
	$s["alert_stock_return"] = "Do you want to return the stock of the order to the system once removed?";
	$s["alert_delete_cartitem"]="¿Do you wish to remove this clothes from the cart?";

	$s["cart_no_allow"] = "<p>To buy from Oky Coky Classics you must be registered in the system. If you are already registered, please log in <a href='login.php' class='important' style='font-weight: bold;'>here</a> in case you have not registered yet you can do <a href='signup.php' class='important' style='font-weight: bold;'>here</a>.</p>
	<p>If you have any question please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";

	$s["add_payment"] = "Add payment process";
	$s["add_payment_moreinfo"] = "<p>This system lets you add direct payments and edit payments already in the system.</p>";
	$s["add_payment_subtitle"] = "Insert data order";
	$s["id_order_final_admin"] = "Order code (Use real code corresponding the order)";
	$s["id_order_final"] = "Order code";

	$s["amount"] = "Amount (use dot as decimal separator i.e. 2310.00)";
	$s["num_clothes"] = "Clothes number";
	$s["is_payed"] = "¿Paid?";
	$s["payment_code"] = "Security code";
	$s["add_payment_success"] = "</p>Payment has been added to the system. <a href='./admin_add_payment.php' class='important underline'>Add more payments</a></p>";

	$s["payments_error"] = "Paymen data is incorrect, please check and try again later";

	$s["no_orders_to_display"] = "You have no orders to show.";

	$s["my_payments"] = "My payments";
	$s["delivery"] = "Sent";

	$s["finish"] = "Finished";
	$s["reject"] = "Reject";
	$s["revision"] = "Review";
	$s["wait_for_user"] = "Wait validation";

	$s["status"][0] = "Review";
	$s["status"][1] = "Modified, waiting for user validation";
	$s["status"][2] = "Validated by the user";
	$s["status"][3] = "Accepted";
	$s["status"][4] = "Sent";
	$s["status"][5] = "Finished";
	$s["status"][6] = "Rejected";

	$s["my_order_error"] = "Error";
	$s["my_order_moreinfo"] = "";

	$s["my_order_state"][0]="<p>This order is under review by our team, We are going to get in touch with you as soon as possible to confirm it.</p>";
	$s["my_order_state"][1]="<p>This order has been modified by our team, please review it and if everything is correct press the accept button.</p><p>If you find any error o you do not agree with the changes made, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a></p>";
	$s["my_order_state"][2]="<p>This order has been modified and changes have been accepted, soon our team will validate your order.</p><p>If you have any doubt, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][3]="<p>This order has been accepted. Our team is preparing the delivery so you can receive it as soon as possible.</p><p>If you have any doubt, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][4]="<p>This order is under delivery process.</p><p>If you have any doubt, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][5]="<p>This order is finished.</p><p>If you have any doubt, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";
	$s["my_order_state"][6]="<p>This order has been rejected by our team.</p><p>If you have any doubt, please contact our customer service at <span class='important'>(+34) 986 240001</span> or by email at <a href='mailto:classics@okycoky.com' class='important underline'>classics@okycoky.com</a> </p>";


	$s["image_error"] = "We only accept images with extension jpg, png or gif";
	$s["too_many_elements_1"]="Too much elements chosen. Max is ";
	$s["too_many_elements_1"]=" per color.";
	$s["client_acces_label"] ="Give access to the new user.";
	$s["delete_acces_label"]="Delete access request.";
	$s["request_label"]="Request";
	$s["costumer_label"]="User";

	$s["cif_label"]="CIF";
	$s["name_label"]="Name";
	$s["email_label"]="Email";
	$s["delete_label"]="Delete";
	$s["no_requests"]="No pending requests.";

	$s["alert_costumer_no_bd"]="The user you want to validate is not at the system database, You have to do a direct signup, this will not let the user to make orders.";
	$s["alert_costumer_delete"]="This request will be deleted from the system. ¿Are you sure?";
	$s["payment_error"]="There was a mistake inserting the payment in the system, check your order code is unique and is from the payment you want to add to the system.";
	$s["yes"]="Yes";
	$s["no"]="No";
	$s["add_client_error"]="New user has not been created because there is another user with the same email or user code.";

	$s["add_client_advice"]="use one you know isn't at the program";

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
	$s["dolar"] = "Dollar";

	$s["choose_principal_image"]="Main image choose";
	$s["visible_to_clients"]="Visible for clients";
	$s["no_more_edit_products"] = "This is the last product of the list.";
	$s["use_this_color"]="Use this color";

	$s["name"]="Name";
	$s["code"]="Code";
	$s["actual_stock"] = "Actual Stock";

	$s["washing"]="Washing";
	$s["bleaching"]="Bleaching";
	$s["ironing"]="Ironing";
	$s["drying"]="Drying";
	$s["dry_cleaning"]="Dry Wash";
	$s["prev"] = "Previous";
	$s["no_color_selected"]="No color picked, product changes to hidden";

	$s["orders_visible_label"]="Pending order review";

	$s["orders_edit_label"]="Order reviewed and waiting for client accept";
	$s["orders_edit_acc_label"]="Order reviewed and client accepted";
	$s["orders_accept_label"]="Order Accepted";
	$s["orders_waiting_label"]="Waiting for payment";
	$s["orders_delevery_label"]="Order sent";
	$s["orders_finish_label"]="Order finished";
	$s["orders_reject_label"]="Order rejected";
	$s["orders_details_label"]="Show order details";
	$s["admin_orders_moreinfo"] = "<p>Orders system admin</p>";
	$s["labels_title"] = "Icon system used:";
	$s["show"] = "Show";

	$s["in_revision"] = "Under revisión";
	$s["modification_request"] = "Modificated waiting accept";
	$s["modification_accepted"] = "Modification accepted";
	$s["accepted"] = "Accepted";
	$s["sent"] = "Sent";
	$s["finished"] = "Finished";
	$s["rejected"] = "Rejected";

	$s["table_label_status"]="Status";
	$s["table_label_image"]="Image";
	$s["table_label_amount"]="Amount";
	$s["table_label_code"]="Code";
	$s["table_label_order"]="Order";
	$s["table_label_client"]="Client";
	$s["table_label_created_date"]="Creation date";
	$s["table_label_total_and_clothes"]="Total and Clothes";
	$s["table_label_delete"] = "Delete";
	$s["table_label_family"] = "Family";
	$s["table_label_name"] = "Name";
	$s["table_label_cif"]="CIF";
	$s["table_label_email"]="Email";
	$s["table_label_active"] = "Active";
	$s["table_label_access_request"] = "Request";
	$s["table_label_name_and_size_selection"]= "Name and size selection";
	$s["table_label_unitary_price"] = "Unitary price";
	$s["table_label_delevery_date"] = "Delivery date";
	$s["table_label_serial_code"] = "Serial code";
	$s["table_label_color"] = "Color";
	$s["table_label_family"] = "Family";
	$s["table_label_num"] = "Quant.";
	$s["table_label_price"] = "Price";
	$s["table_label_total"] = "Total";
	$s["table_label_subtotal"] = "Subtotal:";
	$s["table_label_total_clothes"] = "Total pieces:";
	$s["table_label_last_login"] = "Last Access";


	$s["search.."] = "Search";
	$s["all"] = "All";

	$s["payment_done_label"]="Payment done";
	$s["payment_waiting_label"]="Payment not done";
	$s["view_payment_details"]="View payment details";

	$s["go_payment_process"]="Access payment process";
	$s["payment_done"] = "Payment done";
	$s["waiting_payment"] = "Waiting Payment";
	$s["alert_payment_delete"]="This payment will be deleted from the system. Are you sure you want to continue?";

	$s["no_visible"] = "Hidden";
	$s["visible"] = "Visible";

	$s["visible_product_label"]="Product visible in shop";
	$s["no_visible_product_label"]="Product hidden in shop";
	$s["details_product_label"]="See product details";
	$s["alert_product_delete"]="This product is going to be deleted from the system. Are you sure you want to continue?";

	$s["access_label"]="Full access user.";
	$s["parcial_access_label"]="Partial access user ( It can't buy).";
	$s["no_access_label"]="No access user.";
	$s["user_details_label"]="Show and update client's data";
	$s["active"]="Active";
	$s["inactive"]="Inactive";
	$s["rejected"]="Rejected";

	$s["users"]="Users";
	$s["orders"]="Orders";
	$s["products"]="Products";
	$s["access_request"] = "Access request";
	$s["no_access_request"] = "No access request";
	$s["new_orders"] = "New orders";
	$s["new_modifications_accepted"] = "New modifications accepted";

	$s["progress"] = "Progress:";
	$s["percent_completed"] = "% completed";
	$s["import_msg_exist"] = "Products that already exists on the database:";
	$s["import_msg_error"] = "Products that failed at the import:";
	$s["import_no_msgs"] = "No elements";
	$s["import_season_end"] = "All the products from the selected season have been imported. Press de exit button to see the product list and check any product manually.";
	$s["admin_product_import_title"] = "Import of products";
	$s["import_finished"] = "All imported";

	$s["line_to_import"]="Line to import";
	$s["alert_choose_one_line"]="You have to select at least one line";
	$s["alert_season_installed_1"]="Your current season is";
	$s["alert_season_installed_2"]=". Do you want to delete it and install the season:";

	$s["total"]= "Total";
	$s["status_label"] = "Status";
	$s["client_info_label"] = "Client information";

	$s["name"]= "Name";
	$s["cif"] = "CIF";
	$s["email"] = "Email";
	$s["client_comment"] = "Client's comment";
	$s["no_comment"] = "There isn't comment";
	$s["comment"] = "Comment";
	$s["visible_to_user"] = "Visible to clients";
	$s["no_visible_to_user"] = "Not visible to clients";

	$s["order_comment"] = "Order's Coment";
	$s["line_comment"] = "Line's comment";


	$s["login_error"]="Username or password incorrect";
	$s["login_error_inactive"]="Username waiting for activation";
	$s["forgot_password"]="Did you forget your password?";
	$s["orders_to_validate"]="Orders to validate";
	$s["payment_requests"]="Payment requests";

	$s["alert_payment_other_user"]="You can't pay other user's payment";
	$s["clothes_selector"]="Clothes selector";
	$s["subtotal"] = "Subtotal";
	$s["description"] = "Description";
	$s["composition"] = "Composition";
	$s["care_instructions"] = "Care instructions";

	$s["team_comment"] = "Oky^Coky comment";
	$s["team_info_label"] = "Oky^Coky information";
	$s["alert_order_rejected"] = "The proposed order has been canceled and the stock has been returned to the system automatically.If you re-accept the proposal, it will automatically reduce the stock.In case you want to modify the values ​​of stock, access the management of products.";
	$s["alert_order_update"]="The order request update was successful. ¿Do you want to email the client?";

	$s["alert_delete_line"]="¿Do you want to delete this line?. You can't undo this action.";
	$s["iva"] = "IVA";
	$s["req."] = "Req.";
	$s["signup_error_1"]="Some data may be incorrect, please check your data and try again later.";
	$s["signup_error_2"]="It hasn't been created a new request, that email is already in the system.";
	$s["signup_error_3"]="It hasn't been created a new request, you have already requested and is waiting for activation. If you want a new activation code please click <a href='./activation_request.php' class='important underline'>here</a>";

	$s["add_postage"] = "Add postage";
	$s["postage"] = "Delivery";

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


	$s["insert_season_end"]="The season import had been successful, in 5 seconds you will be redirected to the list of products to check all the data.";
	$s["validate_finished"]=" All validated";
	$s["visibles"]="Visibles";

	$s["select_item"] = "Select an item...";
	$s["select_all"] = "Select all";
	$s["unselect_all"] = "Unselect all";

	$s["system_config"] = "System config";
	$s["general_config"] = "General config";
	$s["general_config_moreinfo"] = "Below you can see all the system's variable values, be careful changing this variables, an error in a field can break the system.";
	$s["general_config_subtitle"] = "General variables";
	$s["activate_maintenance_label"] = "Activate maintenance mode";
	$s["activate_maintenance_btn"] = "Activate";

	$s["notification_email"] = "notifications email";
	$s["url_base"] = "System URL";

	$s["season_colors"] = "Interface colors";
	$s["light"] = "light";
	$s["semilight"] = "Semi-light";
	$s["semidark"] = "Semi-dark";
	$s["dark"] = "dark";

	$s["limit_cart"]="Model items limit";
	$s["limit_color"]="Line items limit";

	$s["insufficient_stock"]="We do not have enough stock for the number of clothes that you selected, reduce the number or contact with our costumer service calling +34 986 240 001 to help you.";
	$s["no_stock"] = "We have not stock of this product.";

	$s["checking_stock"]="Checking Stock";
	$s["order_generating"]="Order is beeing processed";

	$s["cart_review_stock"]="There isn't stock available for the marked products, please change the number of clothes clicking on the product title.";

	$s["stock_update_time"]="Update stock every...";
	$s["minutes"]="Minutes";
	$s["update_stock"]="Update stock";

	$s["general_config_succesful"] = "The new general configuration had been saved";
	$s["cover_config"] = "Cover configuration";

	$s["title"] = "Title";
	$s["subtitle"] = "Subtitle";

	$s["covers_list"] = "Actual cover images list";
	$s["cover_list_moreinfo"] = "To modify a cover image press the more information button or erase it clicking in the bin button.";
	$s["cover_config_moreinfo"] = "";
	$s["cover_url"] = "URL";
	$s["cover_title"] = "Title";
	$s["cover_subtitle"] = "Subtitle";

	$s["cover_options"] = "Cover options";

	$s["add_new_cover"] = "Add new cover image";

	$s["signup_access_data"] = "Sign up access data";
	$s["data_saved_successfully"] = "Data saved successfully";

	$s["signup_address_data"] = "Personal data";

	$s["my_addresses_info"] = "My shipping addresses";
	$s["my_access_info"] = "My access information";
	$s["my_access_info_moreinfo"] = "";
	$s["my_personal_info"] = "My personal information";
	$s["my_personal_moreinfo"] = "Now you can tell us a series of personal data to be recorded in the system to facilitate your purchasing process. The information you provide will be handled according to the provisions of the Organic Law on Data Protection and the Law of Services of the Information Society and Electronic Commerce. You can see our privacy policy at the following <a href='./privacy_policy.php'>link</a>";

	$s["signup_name"] = "Name";
	$s["signup_subname"] = "Subname";
	$s["signup_dni"] = "Passport Number";
	$s["signup_address"] = "Address";
	$s["signup_post_code"] = "Postal code";
	$s["signup_town"] = "City";
	$s["signup_province"] = "Province/State";
	$s["signup_country"] = "Country";
	$s["signup_mobile"] = "Phone (mobile)";
	$s["signup_other"] = "Phone (other)";

	$s["my_address_moreinfo"] ="";

	$s["signup_client_oldemail"] = "Old email";
	$s["signup_client_newemail"] = "New email";
	$s["signup_client_renewemail"] = "Repeat new email";

	$s["table_address"]="Address";
	$s["delete"] = "Delete";
	$s["edit"] = "Edit";
	$s["my_addresses_info_moreinfo"] = "";
	$s["add_new_address"] = "Add address";
	$s["address_data"] = "Shipping address";
	$s["add_edit_address"] = "Edit shipping address";
	$s["client_activation_success"] = "Activation done";
	$s["client_activation_fail"] = "There was an error in the activation";

	$s["client_activation_moreinfo_success"] = "<p>Thanks for signing in Oky Coky.</p><p> From this moment you can shop as a user of the page. <br/>Please click \"NEXT\" to complete the registration process by providing your personal data.</p>";
	$s["client_activation_moreinfo_fail"] = "<p>There was an error in the activation process, please go to your email account and copy the URL address completely or try to signup again. If you tried it before, please contact us at <a href='mailto:classics@okycoky.com'>classics@okycoky.com</a> and we’ll help you.</p> <p>Thanks.</p>";
	$s["thanks_title"] = "Thanks";
	$s["thanks_moreinfo"] = "<p>We want to thank you for your registration, we hope that you will enjoy our clothes selection.</p><p> If you have any question or suggest to improve the shop, please contact us at  <a href='mailto:classics@okycoky.com'>classics@okycoky.com</a>.</p><br/><p>Oky^Coky Team.</p>";
	$s["size"] = "Size";
	$s["admin_import_new_stock"] = "Import Stock from a order proposal";
	$s["admin_import_new_stock_moreinfo"] = "Please fulfill the data to import stock from a order proposal";
	$s["admin_import_new_stock_subtitle"] = "Order proposal data";
	$s["receipt_to_import"] = "Proposal code";
	$s["import_receiptnumber_error"] = "Field cannot be empty";
	$s["import_season_error"] = "A season must be selected";
	$s["admin_import_new_stock_season"] = "Season";
	$s["price_with_discount"] = "Price with discount";
	$s["use_discount"] = "Use discount";
	$s["select_material_image"] = "Choose an image for the material";
	$s["see_details"] = "See details";
	$s["cart_confirm"] = "Confirm cart";
	$s["cart_empty"] = "The cart is empty";
	$s["order_success_title"] = "Payment Success";
	$s["order_success_moreinfo"] = "
		<h3>Thanks you for your purchase on our online shop</h3>
		<p>Your order was successfully payed, our team will start right now to package your order to send it to you as soon as possible. Your purchase will be dispatched within 2 to 3 working days (most of the time, it's faster!), we will send you an email to confirm that your order has been shipped.</p><p><br/> Thanks.</p>";
	$s["retailer_success_title"] = "Order Added";
	$s["retailer_success_moreinfo"] = "Thanks for your order, as soon as possible our team will contact you.";
	$s["order_address_title"] = "Invoice and shipping addresses";
	$s["order_address_moreinfo"] = "";
	$s["receipt_data"] = "Facturing address";
	$s["receipt_data_subtitle"] = "Indicate the address to which you want us to send the invoice for your purchase.";
	$s["use_same_address"] = "Use invoice address";
	$s["select_address"] = "Select";
	$s["cart_address_title"] = "Invoice and shipping addresses";
	$s["cart_address_moreinfo"] = "";
	$season_winter[0]="Spring / Summer";
	$season_winter[1]="Autumn / Winter";
	$s["now"] = "Now";
	$s["before"] = "Bofore";
	$s['new_user_title'] = "Thanks to sign up in Oky^Coky";
	$s['new_user_moreinfo'] = "Please, fulfill the user data";

	$s["finish_it"] = "Finish";

	$s["invalid_format"] = "Invalid format";
	$s["too_long"] = "Too long";
	$s["from_stored_addresses"] = "Stored addresses";
	$s["there_isnt_addresses_stored"] = "There is no address stored";
	$s["signup_city"] = "City";
	$s["close"]= "Close";
	$s["year"]= "Year";
	$s["add_material_image_title"] = "Add material image";
	$s["add_material_image_moreinfo"] = "Please, select an image for the material. The image has to be 370x370, for a better aspect.";

	$s["subname"] = "Subname";
	$s["password"] = "Password";

	$s["invoice_address"] = "Invoice address";
	$s["shipping_address"] = "Shipping address";

	$s["ship_method"] = "Shipping method";
	$s["ship_methods"] = "Shipping methods";
	$s["ship_cost"] = "Shippment";
	$s["admin_ship_methods"] = "Admin shipping methods";
	$s["add_ship_method"] = "Add shipping method";
	$s["add_ship_method_subtitle"] = "Shipping method data";
	$s["add_ship_error"] = "There was an error";
	$s["add_ship_success"] = "Shipping method stored";
	$s["ship_free"] = "Free";
	$s["ship_free_note"] = "* for free shipping use a 0.";
	$s["ship_method_name_es"] = "Spanish name";
	$s["ship_method_descrip_es"] = "Spanish description";
	$s["ship_method_price_es"] = "Price";
	$s["ship_method_name_en"] = "English name";
	$s["ship_method_descrip_en"] = "English description";
	$s["ship_method_price_en"] = "English price";
	$s["ship_method_price_variable"] = "The price changes with the number of products. Every ";
	$s["ship_method_price_fixed"] = "The price is the same for a maximum number of products.";
	$s["ship_method_price_fixed_all"] = "The price is the same for the order, without consider the number of products.";
	$s["ship_method_price_min"] = "Min";
	$s["ship_method_price_max"] = "Max";
	$s["ship_method_price_elements"] = "element(s).";
	$s["ship_method_country_filter"] = "Filter by country";
	$s["ship_method_country_include"] = "Only for this country.";
	$s["ship_method_country_exclude"] = "All countries except this one.";

	$s["ship_method_province_filter"] = "Filter by province";
	$s["ship_method_province_include"] = "Only for this province.";
	$s["ship_method_province_exclude"] = "All provinces except this one.";

	$s["ship_method_not_defined"] = "No one has been selected.";
	$s["ship_method_not_suitable"] = "No hay métodos de envío disponibles para su pedido.";
	$s["ship_method_not_suitable_country"] = "You didn't give us the shipping address to deliver your clothes, please fullfil the shipping address form in this webpage at the right, <a href='#shipping_form'>click here to fulfill the form</a>.";
	$s["ship_method_name"] = "Name";
	$s["ship_method_descrip"] = "Description";
	$s["ship_method_price"] = "Price";
	$s["ship_method_details_label"] = "See or edit the shipping method";
	$s["admin_ship_method_moreinfo"] = "<p>Este sistema permite añadir métodos de envío directamente a la red sin necesidad de conexión con la Aplicación.</p>";

	$s["send_email"] = "Do you want to send an email to the costumer?";
	$s["send"] = "Send";
	$s["content"] = "Content";
	$s["subject"] = "Topic";
	$s["send_email_title"] = "Send email to costumer";
	$s["send_email_moreinfo"] = "This system is destinated to contact with the costumer to inform about order details information or the reason to be cancel.";
	$s["send_email_button"] = "Send email";
	$s["add_products"] = "Add Product";
	$s["family"] = "Family";
	$s["sizing"] = "Sizing";

	$s["status"][0] = "Revision";
	$s["status"][1] = "Acepted";
	$s["status"][2] = "Cancel";
	$s["sizes"][0] = "CT";
	$s["sizes"][1] = "34, 36, 38...";
	$s["sizes"][2] = "XS, S, M...";
	$s["sizes"][3] = "--";
	$s["sizes"][4] = "70, 75, 80...";
	$s["sizes"][5] = "35, 36, 37...";

	$s["add_color"] = "Add Color";
	$s["internal_code"] = "Internal Code";
	$s["add_to_stock"] = "Add to stock";
	$s["howtobuy_info"] = "<h3>How to buy</h3><p>The purchase process is simple in Oky Coky Classics.</p><p>1. - Once you got registered in the system simply select the model you wish to purchase and add to your order.</p><p>2. - To check the items you've added select 'my order', where you can also edit them.</p><p>3. - Once you are satisfied with your order click 'NEXT' to confirm.</p><p>4. - At this point you can select different shipping methods and indicate which direction to send the invoice or order (if it is different from billing).</p><p>5. - Receive an invoice confirming your order and the purchase in a couple of days.</p>";
	$s["howtopay_info"]="<p>You can make your purchases by credit card, for which we have enabled a payment gateway to the secure site of LA CAIXA. In this gateway the secure payment is guaranteed by the following options: Visa, Mastercard, Maestro credit and debit cards.</p>";
	$s["howtoshipping_info"]="<h3>Where can I receive my order?</h3><p>We can sent your order to an address selected by you (home, work, etc), but we never sent to a PO Box.</p><h3>Can you sent to any country?</h3><p>There is a limitation in which country can we sent, if there isn’t shipping method for your country, please contact us <a href=’mailto:classics@okycoky.com’>classics@okycoky.com</a> and we’ll tell you when are we available to sent to your country</p><h3>How long will my order take to arrive?</h3><p>Depends of the shipping method that you had choose. After we recibe your order it’ll take us around 1 or 3 days to set everything and contact with the delivery company. After the company have your order, we’ll send you an email and we’ll provide you the track number if it’s avaliable</p><h3>How much do I pay for delivery service?</h3><p>Depends of the shipping method that you had choose, after you confirm your order and write the shipping address the system will provide you the different delivery options. Import duties, taxes and charges are not included in the item price or shipping charges. These charges are the buyer's responsibility. Please check with your country's customs office to determine what these additional costs will be prior to make the purchase. These charges are normally collected by the delivering freight (shipping) company or when you pick the item up - do not confuse them for additional shipping charges. We do not mark merchandise values below value or mark items as 'gifts'.</p>";
	$s["howtoreturn_info"]="<h3>EXCHANGES AND RETURNS</h3>
	<p>Making a return or exchange is easy and FREE.<b>You have 14 days</b> since the day you received your order to request your return or exchange. Click on <b>YOUR ACCOUNT</b> and visit your <b>ORDER LIST</b>, once you selected your order you have to click on <b>START A RETURN</b> if you find any problem with this method, your can contact us in our email (classics@okycoky.com) o or by phone (+34 986240001).</p>
	<p>Your have to indicate us why you request a exchange or return, you can request when:
	<ul style='margin-left:35px;'>
		<li>You need another size or colour.</li>
		<li>You are not totally satisfaced with the clothes, or they don't fit you perfectly.</li>
		<li>The clothes didn't reach what you were expecting when you bought them.</li>
	</ul>
	<p>Whatever it's your case, all the exchanges and returns are free.</p>
	<p>We'll contact the delivery company, and they will contact you to choose when is the best time for you to pick up the package. All the clothes that you want to exhange or return had to be packed in our box, without use and with all the labels.</p>
	<p>When the clothes are back in OKY^COKY, we will check the clothes and if everything is right we will return you the amount that you paid for the clothes that you give us back, using the same payment method that you used when you paid the order - the shipping cost won't be refund - as it was the order payed</p>
	 <p style='text-align:center;margin:20px;'><a href='./my_orderlist.php' CLASS='btn btn-dark btn-mini'>GO TO YOUR ORDERS LIST</a></p>

	<h3>HOW LONG DO I HAVE TO RETURN MY ORDER?</h3>
	<p>Items may be returned or exchanged within 14 days after delivery.</p>
	<h3>CAN I EXCHANGE MY ORDER?</h3>
	<p>Yes, you can return the clothes that you want to exchange, after we refund you the money, you can purchase new order with the sizes or colors that you prefer.</p>";

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

	$s["size_guide"] = "What's my size?";

	$s["spain"] = "Spain";
	$s["france"] = "France";
	$s["uk"] = "UK";
	$s["italy"] = "Italy";
	$s["usa"] = "USA";
	$s["japan"] = "Japan";
	$s["denmark"] = "Denmark";
	$s["australia"] = "Australia";

	$s["size_conversion"] = "Size Conversion";
	$s["measure_table"] = "Measure table";
	$s["chest"] = "Chest";
	$s["waist"] = "Waist";
	$s["hips"] = "Hips";
	$s["sizes"] = "Sizes";

	$s["share_with_friends"] = "Share with your friends";

	$s["no_stock_small"] = "Out of stock";

	$s["base_imponible"] = "Base Imponible";

	$s["send_cart_alert"]  = "ATTENTION:\n\nPlease, be sure that your credit card is \"authenticated\" by your bank to make payments through internet.\n\nIf not, ask your bank (in some banks this may be done through internet), or you can do the payment by bank transfer.";

$s["go_to_payment_process"]="Start Payment Process";
	$s["discount"]="Discount";

	$s["more_images"] = "Product Images";
	$s["exchanges_and_returns"] = "Exchanges and Returns";
	$s["exchanges_and_returns_info"] ="";
	$s["finish_order"]="Finish order";
	$s['pay_by_transfer'] ="";
	$s["pay_by_transfer_info"] = "";
	$s["bank_transfer"] = "Bank Transfer";
	$s["credit_card"] = "Pay with Credit Card";
	$s["paypal"] = "PayPal";
	$s["drop_comment"] = "Do you need to add a comment in your order? write it here.";

	$s["bank_transfer_moreinfo"] = "
	<h3>Thanks you for your purchase on our online shop</h3>
	<p>We included here all the data that you need to finish your purchase using a bank transfer. After we received the bank transfer our team will start to package your order to send it to you as soon as possible. This payment method use to take around 3 or 5 working days (most of the time, it's faster!), we will send you an email to confirm that your order has been shipped.</p><p style='color:#000 !important; font-size:12px;'><br/> Thanks.</p>";
	$s["bank_transfer_moreinfo_mail"] = "
	<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Thanks you for your purchase on our online shop</h3>
	<p style='color:#000 !important; font-size:12px;'>We included here all the data that you need to finish your purchase using a bank transfer. After we received the bank transfer our team will start to package your order to send it to you as soon as possible. This payment method use to take around 3 or 5 working days (most of the time, it's faster!), we will send you an email to confirm that your order has been shipped.</p><p style='color:#000 !important; font-size:12px;'><br/> Thanks.</p>";
	$s["paypal_moreinfo_mail"] = "
	<h3 style='text-transform:uppercase;font-size:20px;margin:10px 0px;font-weight:100'>Thanks you for your purchase on our online shop</h3>
	<p style='color:#000 !important; font-size:12px;'>Your order has been submitted and is in the queue to be processed. It will take about 1 - 2 business days for your order to be processed and marked as shipped. This time does not include ship time. We will be sending you another email when we ship your order.</p><p style='color:#000 !important; font-size:12px;'><br/> Thanks.</p>";
	$s["bank_transfer_data"]="BANK TRANSFER DATA";
	$s["bank"] = "Bank";
	$s["swift"] = "SWIFT";
	$s["iban"]="IBAN";
	$s["account_number"]="Account Number";
	$s["account_owner"] = "Beneficiary";
	$s["concept"] = "Transfer Concept";
	$s["amount_bank"] = "Amount";
	$s["go_to_order"] = "Go to your order";
	$s["bank_access"] = "<h3>Creating bank transfer data</h3><p>Please wait, don't close this window</p>";
	$s["use_code"] = "Validate";
	$s["return/exchange"] = "Return/exchange";
	$s["captcha_wrong"] = "The Captcha code is not valid";
	$s["captcha_empty"] = "The Captcha code is a required field";
	$s["captcha_label"] = "Captcha code";

	$s["legal_conditions"] = "Legal Conditions";
	$s["privacy_policy"] = "Privacy Policy";
	$s["purchase_conditions"] = "Purchase Conditions";
	$s["accept_purchase_and_legal_policies"]="Accept the <a href='http://www.okycoky.net/classics/purchase_conditions.php'>purchase</a> & <a href='http://www.okycoky.net/classics/legal.php'>legal</a> policies";
	$s["order_details"] = "Order Details";
	$s["order_comments"] = "Oky^Coky Messages";
	$s["there_is_not_messages"] = "There isn't messages";
	$s["promo_code"]="Promocode";
	$s["promo_code_error"] = "The Promocode is not valid<br/><br/>Please try again.";
	$s["waiting_payment"] = "Waiting payment confirmation";
	$s["payed"] = "Payment Confirmed";
		$s["bank_transf"] = "Bank Transf.";
	$s["payment_gateway"] = "Payment Gateway";

$s["payment_method"] = "Payment Method";
	$s["pending"] = "Pending";

	$s["sended"] = "Sended";
	$s["cancel"] = "Cancel";
	$s["processing"] = "Proccesing";

		$s["choose_a_payment_method"] = "Choose a payment method";

		$s["this_order_is_not_payed"] = "This order is not payed, if you want to start the payment process again,<br/>choose a payment method";

			$s["this_order_is_not_payed_short"] = "This order is not payed, if you want to start the payment process again: ";
		$s["other_seasons"] = "Other Seasons";
	$s["previous"] = "Previous";

	$return_methods_s["credit_card"]="Reintegro Tarjeta";
	$return_methods_s["bank_transfer"]="Ingreso Cuenta Bancaria";
	$return_methods_s["gift_card"]="Tarjeta Regalo";

	$s["start_return"] = "Tramitar Devolución";




$s["returns"]="Returns";
$s["are_you_dissapointed_with_clothes"]="Aren't you totally satisfacted with your purchase?";
$s["return_moreinfo"]="If the clothes don't fit you perfectly or they didn't reach your expectations, you have a 14 days period to return the clothes <b>for free</b>";
$s["order_problems_title"]="Do you have any question about your order?";
$s["order_problems_subtitle"]="If you have any question or you need some help, please contact us, we'll happy to help you.";
$s["returns_done"]="Returns Created";
$s["pending"]="Pending";
$s["picking_up"]="Picking up";
$s["verifying"]="Verifying";
$s["terminated"]="Terminated";
$s["cancela"] = "Cancelled";
$s["return_status"] = "Status";
$s["created"] = "Sent";
$s["start_a_return"]="Start the Return Process";


$s["return_order"] = "Return Order";
$s["return_reason_title"]="Please, explain us the return reason.";
$s["return_reason_help"]="This few lines are so important to us. We always want to improve our client relationship and our products.";
$s["return_select_clothes_title"]="Select the clothes that you want to return";
$s["return_select_clothes_help"]="Here you can find all the clothes that you order, check the clothes that you want to return clicking on the checkbox.";
$s["Amou."] = "Amou.";
$s["amount_clothes"] = "Clothes";
$s["return_pickup_address_title"]=" Where can we pick up the clothes?";
$s["shipping_address"] = "Pick up address";
$s["address"] = "Address";
$s["post_code"] = "Post Code";
$s["city"] = "City";
$s["province"] = "Province";
$s["country"] = "Country";
$s["phone"] = "Phone";
$s["return_pickup_address_help"]="It's very important that you choose a place where the delivery company can find you on delevery hours.<br/><br/>Don't forget to wirte your phone, the delivery company will use it to contact you.";
$s["return_method_title"]="Which return method do you prefer?";
$s["return_method"]="Return method";
$s["no_clothes_to_return"]="You did not choose any clothes to return.";
$s["important"] = "IMPORTANT";
$s["print_label_info"]="You must print the shipping label & put all the clothes in the same box that we used. The shipping label has a especial code that identifies your return.";
$s["print_shipping_label"]="PRINT SHIPPING LABEL";

$s["if_you_want_to_cancel"] = "If you want to cancel this order, please press the button";
$s["cancel_order"] = "Cancel Order";
$s["alert_prices_discount_ajustment"]="WARNING: This order used a promo code, the prices had been recalculated";
$s["add_to_favorites"] = "Add to Favorites";
$s["add_to_favorites_help"] = "In our shop, you can choose which clothes are part of your favorite ones, it'll help you to select and decide which one stole your heart.";

$s["add_to_favorites_help_no_login"] = "Login or Signup and create your own collection with your favorite ones.";
$s["people_with_this_clothe_as_favorite"] = "People added this clothe";

$s["remove_favorite"] = "Delete from favorites";

$s["bank_transfer_warning"] = "Once you made the bank transfer, please send us an email to classics@okycoky.com with the payment receipt attached.";

$s["bank_transfer_warning"] = "<span style='font-size:24px;'>IMPORTANT</span><BR/><BR/>TO SEND YOUR CLOTHES AS SOON AS POSSIBLE.<br/><br/> Send us the payment receipt to our mail classics@okycoky.com, also you can send us a mobile photo of it.";


//$s["shipping_offer"]="SPECIAL SALE: YOUR EXPRESS SHIPPING ONLY 1€ MORE";
$s["shipping_offer"]="";
$s["24_shipping"]="2 to 3 DAY SHIPPING AVAILABLE";

$s["24_shipping_display"] = "This product can be shipped using our express method, if you finish your order before 12:00 you will receive your clothes within 2-3 business days.";
$s["5_shipping"]="AVAILABLE IN 5 DAYS";

$s["5_shipping_display"] = "This product will be available in 5 days.";
$s["free_return"]="FREE RETURN";
$s["free_return_display"] = "If you are not totally satisfaced with the clothes, they don't fit you perfectly or you need another size our color, you can return your clothes <b>totally free</b>. You will have 14 days since the day you received your clothes to request your return. For more information, visit our <a href='./howtoreturn.php'>exchanges and return policy</a>";
$s["need_help"]="NEED HELP?";
$s["need_help_display"] = "If you need any help, you can contact our costumer service from monday to friday at (+34) 986 24 00 01 or you can send an email to classics@okycoky.com ";

$s["product_added"]="The product had been added to your shopping cart";

$s["vat_included"] = "VAT included";
$s["you_may_also_like"] = "You may also like";
$s["filter_sizes"] = "Filter by Size: ";
$s["all_sizes"] = "Todas las tallas";
$s["favorites_empty"] = "Add clothes in your favorite section clicking on the button add to favorites that you will find in each product";
$s["favorites_login"] = "This section allow you to add your clothes and create your own selection. Login or Sign up to use this section";
$s["no_clothes_to_show"] = "We are sorry, but there aren't products to show";
$s["shipping_cost"] = "Shipping methods available";
$s["customer_care"] = "Customer care";
?>
