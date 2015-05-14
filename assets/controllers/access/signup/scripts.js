
$(document).ready(function() {


  $("#signup-form").submit(function(e){

    e.preventDefault();
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
    $_session_data["password"]=$("#signup_password").val();

    if ((!isset_and_not_empty($_session_data["password"]))||($_session_data["password"]=="")){
      $("#shipping-address-alert").removeClass("hidden");
      $("#shipping-address-alert").append("<p>El campo <b>contraseña</b> es obligatorio</p>");
      $_validate=false;
    }



    if($_validate){
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
          $("#shipping-address-alert").removeClass("hidden");
          $("#shipping-address-alert").append("<p>No se ha podido establecer conexión con el servidor.</p>");
          $_validate=false;
        },
        success: function(response) {
          if(response.result){
            $_session_data["logged"]=1;
            localStorage.logged=1;
            $_session_data["id_client"]=response.data.id_client;
            localStorage.id_client=response.data.id_client;

            update_session_data_no_trigger();

            window.location.href="../../access/home/index.html";
          }else{
            if(response.error_code=="email_in_use"){
              $("#shipping-address-alert").removeClass("hidden");
              $("#shipping-address-alert").append("<p>No se ha podido regsitrar tu cuenta ya que el correo electrónico ya está en uso.</p>");
              $_validate=false;

            }else{
              $("#shipping-address-alert").removeClass("hidden");
              $("#shipping-address-alert").append("<p>Ha ocurrido un error [CODE:"+response.error_code+"]</p>");
              $_validate=false;
            }
            $("#signup_password").val("");
          }
        }
      });
    }

  });
});
