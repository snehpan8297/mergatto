$_ajax["shipping_address_validation"]=false;
$_ajax["shipping_validation"]=false;
$_ajax["payment_method_validation"]=false;


$(document).ready(function() {
  if(localStorage.logged==1){
    $(".tab-pane.in").toggleClass("in");
    $(".tab-pane.active").toggleClass("active");
    $("#shipping_address").toggleClass("in");
    $("#shipping_address").toggleClass("active");
  }
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/categories/model.php",
    data: {
      action: "list_categories"
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_categories] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["categories-list"]="";
        jQuery.each(response.data,function($_key,$_category){
          $_ajax["categories-list"]+="<li><a href='../../../shop/products/index.html?id_category="+$_category.id_category+"'><span>"+$_category.name_es+"</span></a></li>";
        });
        $(".data-ajax-categories-list").html($_ajax["categories-list"]);
      }else{
        alert("[list_categories] error: "+response.error_code);
      }
    }
  });

  $("#login-form").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        action: "login",
        session_key: $_session_data["session_key"],
        email: $("#login-form #email").val(),
        password: $("#login-form #password").val()
      },
      error: function(data, textStatus, jqXHR) {
        alert("error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.session_key=response.data.session_key;
          localStorage.first_name=response.data.first_name;
          localStorage.last_name=response.data.last_name;
          localStorage.email=response.data.email;
          localStorage.passport=response.data.passport;
          localStorage.street_1=response.data.street_1;
          localStorage.street_2=response.data.street_2;
          localStorage.city=response.data.city;
          localStorage.zip=response.data.zip;
          localStorage.country=response.data.country;
          localStorage.state=response.data.state;
          localStorage.phone=response.data.phone;
          localStorage.size=response.data.size;
          localStorage.cookies_accepted=response.data.cookies_accepted;
          localStorage.logged=response.data.logged;
          $(".tab-pane.in").toggleClass("in");
          $(".tab-pane.active").toggleClass("active");
          $("#shipping_address").toggleClass("in");
          $("#shipping_address").toggleClass("active");
          $_ajax["shipping_address_validation"]=true;
          check_session();
          get_cart();
          scroll_to("top");
        }else{
          //alert("error: "+response.error_code);
        }
      }
    });
  });
});
function validate_shipping_address(){
  $("#session_data_loaded").change(function(){
    $_validate=true;

    if ((!isset_and_not_empty($_session_data["first_name"]))||($_session_data["first_name"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>nombre</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["last_name"]))||($_session_data["last_name"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>apellido</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["email"]))||($_session_data["email"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>correo electrónico</b> es obligatorio</p>");
      $_validate=false;
    }else if(!is_email($_session_data["email"])){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>correo electrónico</b> no tiene formato válido</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["passport"]))||($_session_data["passport"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>DNI/Pasaporte</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["street_1"]))||($_session_data["street_1"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>dirección</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["city"]))||($_session_data["city"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>ciudad</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["zip"]))||($_session_data["zip"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>código postal</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["country"]))||($_session_data["country"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>pais</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["state"]))||($_session_data["state"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>provincia</b> es obligatorio</p>");
      $_validate=false;
    }
    if ((!isset_and_not_empty($_session_data["phone"]))||($_session_data["phone"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>teléfono</b> es obligatorio</p>");
      $_validate=false;
    }

    if($_validate){
      $_need_to_signup=false;
      if($_session_data["logged"]==0){
        $_session_data["password"]=$("#signup_password").val();
        if ((isset_and_not_empty($_session_data["password"]))&&($_session_data["password"]!="")){
          if($("#set_password").hasClass("in")){
            $_need_to_signup=true;

            $.ajax({
              type: "POST",
              dataType: 'json',
              url: $_SERVER_PATH+"server/shop/model/access/model.php",
              data: {
                action: "signup",
                session_key: $_session_data["session_key"],
                password: $_session_data["password"]
              },
              error: function(data, textStatus, jqXHR) {
                alert("Ha ocurrido un error en la conexión cuando se daba de alta tu usuario");
              },
              success: function(response) {
                if(response.result){
                  $_session_data["logged"]=1;
                  localStorage.logged=1;
                  $_session_data["id_client"]=response.data.id_client;
                  localStorage.id_client=response.data.id_client;

                  update_session_data_no_trigger();
                  $("#shipping-address-alert").addClass("hidden");
                  $(".tab-pane.in").toggleClass("in");
                  $(".tab-pane.active").toggleClass("active");
                  $("#shipping_address").toggleClass("in");
                  $("#shipping_address").toggleClass("active");
                  updateSession("id_shipping",0);
                  updateSession("id_payment_method",0);
                  $_ajax["shipping_address_validation"]=true;
                  $_ajax["shipping_validation"]=false;
                  $_ajax["payment_method_validation"]=false;
                  validate_order();
                }else{
                  if(response.error_code=="email_in_use"){
                    alert("No se ha podido regsitrar tu cuenta ya que el correo electrónico ya está en uso.");
                    $("#set_password").removeClass("in");
                    $("#set_password").removeClass("active");


                    $("#shipping-address-alert").addClass("hidden");
                    $(".tab-pane.in").toggleClass("in");
                    $(".tab-pane.active").toggleClass("active");
                    $("#shipping_address").toggleClass("in");
                    $("#shipping_address").toggleClass("active");
                    updateSession("id_shipping",0);
                    updateSession("id_payment_method",0);
                    $_ajax["shipping_address_validation"]=true;
                    $_ajax["shipping_validation"]=false;
                    $_ajax["payment_method_validation"]=false;
                    validate_order();
                  }else{
                    alert("error: "+response.error_code);
                  }
                  $("#signup_password").val("");
                }
              }
            });
          }
        }
      }
      if(!$_need_to_signup){
        $("#shipping-address-alert").addClass("hidden");
        $(".tab-pane.in").toggleClass("in");
        $(".tab-pane.active").toggleClass("active");
        $("#shipping_address").toggleClass("in");
        $("#shipping_address").toggleClass("active");
        updateSession("id_shipping",0);
        updateSession("id_payment_method",0);
        $_ajax["shipping_address_validation"]=true;
        $_ajax["shipping_validation"]=false;
        $_ajax["payment_method_validation"]=false;
        validate_order();
      }
    }
  });
  scroll_to("top");
  check_session();



}
function edit_shipping_address(){
  $(".tab-pane.in").toggleClass("in");
  $(".tab-pane.active").toggleClass("active");
  $("#shipping_address_form").toggleClass("in");
  $("#shipping_address_form").toggleClass("active");
  scroll_to("top");
  $_ajax["shipping_address_validation"]=false;
  validate_order();
}
function process_cart(){
  $("#next-checkout").html("Cargado...");
  $("#next-checkout").attr("href","javascript:void(0)");
  $("#next-checkout").addClass("disabled");

  window.location.href="../../../shop/checkout/2/index.html";

}
function validate_order(){
  if($_ajax["shipping_address_validation"] && $_ajax["shipping_validation"] && $_ajax["payment_method_validation"]){
    if($_session_data["payment_method_value"]=="paypal"){
      $("#next-checkout").html("Confirmar Pedido e ir a Paypal");
    }else if($_session_data["payment_method_value"]=="credit_card"){
      $("#next-checkout").html("Confirmar Pedido e ir a Pasarela de pago");
    }else{
      $("#next-checkout").html("Confirmar Pedido");
    }

    $("#next-checkout").attr("href","javascript:process_cart()");
    $("#next-checkout").removeClass("disabled");
  }else{
    $("#next-checkout").html("Complete todos los campos");
    $("#next-checkout").attr("href","javascript:void(0)");
    $("#next-checkout").addClass("disabled");

  }
}

function delete_form_data($_id_form){
  $("#"+$_id_form+" input").each(function(){
    $(this).val("");
    $(this).change();
  });
}
