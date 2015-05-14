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
          scroll_to("top");
        }else{
          //alert("error: "+response.error_code);
        }
      }
    });
  });
});
function validate_shipping_address(){

  $(".tab-pane.in").toggleClass("in");
  $(".tab-pane.active").toggleClass("active");
  $("#shipping_address").toggleClass("in");
  $("#shipping_address").toggleClass("active");
  $("#next-checkout").html("Siguiente");
  $("#next-checkout").attr("href","javascript:process_cart()");
  $("#next-checkout").removeClass("disabled");
  scroll_to("top");
  updateSession("id_shipping",0);
  updateSession("id_payment_method",0);
  $_ajax["shipping_address_validation"]=true;
  $_ajax["shipping_validation"]=false;
  $_ajax["payment_method_validation"]=false;
  validate_order();
}
function edit_shipping_address(){
  $(".tab-pane.in").toggleClass("in");
  $(".tab-pane.active").toggleClass("active");
  $("#shipping_address_form").toggleClass("in");
  $("#shipping_address_form").toggleClass("active");
  $("#next-checkout").html("Rellena los datos de envío");
  $("#next-checkout").attr("href","javascript:void(0)");
  $("#next-checkout").addClass("disabled");
  scroll_to("top");
  $_ajax["shipping_address_validation"]=false;
  validate_order();
}
function process_cart(){
  $("#next-checkout").html("Cargado...");
  $("#next-checkout").attr("href","javascript:void(0)");
  $("#next-checkout").addClass("disabled");

  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/orders/model.php",
    data: {
      action: "add_order",
      session_key: $_session_data["session_key"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("Ha ocurrido un error en el servidor, vuelva a intentarlo más tarde.");
      validate_order();
    },
    success: function(response) {
      if(response.result){
        updateSession("current_id_order",response.data.id_order);

        window.location.href="../../../shop/checkout/2/index.html";
      }else{
        alert("Ha ocurrido en los datos enviados a nuestro servidor, vuelva a intentarlo más tarde.");
        validate_order();
      }
    }
  });

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
