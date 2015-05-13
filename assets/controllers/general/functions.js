/*********************************************************
* FUNCTION: session_destroy
* DATA:
* DESCRIPTION:
*
*********************************************************/

function session_destroy(){
  localStorage.session_key=null;
}

/*********************************************************
* FUNCTION: logout
* DATA:
* DESCRIPTION:
*
*********************************************************/

function logout(){
  session_destroy();
  window.location.href = $_PATH+"access/login/";
}

/*********************************************************
* FUNCTION: check_session
* DATA:
* DESCRIPTION:
*
*********************************************************/

function check_session(){

  $_session_data=new Array();
  if ((typeof localStorage.session_key == 'undefined')||(localStorage.session_key == null)||(localStorage.session_key == "null")){
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        "action":"add_session"
      },
      error: function(data, textStatus, jqXHR) {
        alert("[get_session] error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.session_key=response.data.session_key;
          localStorage.first_name="";
          localStorage.last_name="";
          localStorage.email="";
          localStorage.passport="";
          localStorage.street_1="";
          localStorage.street_2="";
          localStorage.city="";
          localStorage.zip="";
          localStorage.state="";
          localStorage.phone="";
          localStorage.id_shipping=0
          localStorage.shipping_title="";
          localStorage.shipping_price="";
          localStorage.id_payment_method=0
          localStorage.payment_method_title="";
          localStorage.payment_method_value="";
          localStorage.size="";
          localStorage.cookies_accepted=0;
          localStorage.logged=0;
          localStorage.id_client="-----";
          localStorage.session_menu_link="<li><a href='"+$_PATH+"access/login/index.html'><span>Indentifícate</span></a></li>";
          $_session_data["session_key"]=localStorage.session_key;
          update_session_data();

        }else{
          alert("[get_session] error: "+response.error_code);
        }
      }
    });

  }else{
    $_session_data["session_key"]=localStorage.session_key;
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        "action":"get_session",
        "session_key":$_session_data["session_key"]
      },
      error: function(data, textStatus, jqXHR) {
        alert("[get_session] error: ajax call error");
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
          localStorage.id_shipping=response.data.id_shipping;
          localStorage.shipping_title=response.data.shipping_title;
          localStorage.shipping_price=response.data.shipping_price;
          localStorage.id_payment_method=response.data.id_payment_method;
          localStorage.payment_method_title=response.data.payment_method_title;
          localStorage.payment_method_value=response.data.payment_method_value;
          localStorage.size=response.data.size;
          localStorage.cookies_accepted=response.data.cookies_accepted;
          localStorage.logged=response.data.logged;
          localStorage.id_client="#W"+response.data.id_client;

          if(localStorage.logged==1){
            localStorage.session_menu_link="<li><a href='"+$_PATH+"access/home/index.html'><span>Mi Cuenta</span></a></li>";
          }else{
            localStorage.session_menu_link="<li><a href='"+$_PATH+"access/login/index.html'><span>Indentifícate</span></a></li>";
          }
          update_session_data();
        }else{
          if(response.error_code=="session_key_not_valid"){
            localStorage.session_key=null;
            check_session();
          }else{
            alert("[get_session] error: "+response.error_code);
          }
        }
      }
    });
  }

}

function update_session_data(){

  $_session_data["first_name"]=localStorage.first_name;
  $_session_data["last_name"]=localStorage.last_name;
  $_session_data["email"]=localStorage.email;
  $_session_data["passport"]=localStorage.passport;
  $_session_data["street_1"]=localStorage.street_1;
  $_session_data["street_2"]=localStorage.street_2;
  $_session_data["city"]=localStorage.city;
  $_session_data["zip"]=localStorage.zip;
  $_session_data["country"]=localStorage.country;
  $_session_data["state"]=localStorage.state;
  $_session_data["phone"]=localStorage.phone;
  $_session_data["id_shipping"]=localStorage.id_shipping;
  $_session_data["shipping_title"]=localStorage.shipping_title;
  $_session_data["shipping_price"]=localStorage.shipping_price;
  $_session_data["id_payment_method"]=localStorage.id_payment_method;
  $_session_data["payment_method_title"]=localStorage.payment_method_title;
  $_session_data["payment_method_value"]=localStorage.payment_method_value;
  $_session_data["size"]=localStorage.size;
  $_session_data["cookies_accepted"]=localStorage.cookies_accepted;
  $_session_data["logged"]=localStorage.logged;
  $_session_data["id_client"]=localStorage.id_client;
  $_session_data["session_menu_link"]=localStorage.session_menu_link;
  if($_session_data["cookies_accepted"]=="0"){
    $("#cookies_footer").removeClass("hidden");
  }

  $(".input-data-session-data").each(function(){
    $_index=$(this).attr("input-data-session-data");
    $(this).val($_session_data[$_index]);
  });
  $(".data-ajax").each(function(){
    $_index=$(this).attr("data-ajax");
    if(isset_and_not_empty($_session_data[$_index])){
      $(this).html($_session_data[$_index]);
    }
  });
  if(localStorage.logged==1){
    $(".visible-logged").each(function(){
      $(this).removeClass("hidden");
      $(this).addClass("visible");
      $(this).removeClass("visible-logged");
      $(this).addClass("visible-logged-checked");
    });
    $(".hidden-logged").each(function(){
      $(this).removeClass("visible");
      $(this).addClass("hidden");
      $(this).removeClass("hidden-logged");
      $(this).addClass("hidden-logged-checked");
    });
    $(".visible-logged-checked").each(function(){
      $(this).removeClass("hidden");
      $(this).addClass("visible");
    });
    $(".hidden-logged-checked").each(function(){
      $(this).removeClass("visible");
      $(this).addClass("hidden");
    });
  }else{
    $(".hidden-logged").each(function(){
      $(this).removeClass("hidden");
      $(this).addClass("visible");
      $(this).removeClass("hidden-logged");
      $(this).addClass("hidden-logged-checked");
    });
    $(".visible-logged").each(function(){
      $(this).removeClass("visible");
      $(this).addClass("hidden");
      $(this).removeClass("visible-logged");
      $(this).addClass("visible-logged-checked");
    });
    $(".hidden-logged-checked").each(function(){
      $(this).removeClass("hidden");
      $(this).addClass("visible");
    });
    $(".visible-logged-checked").each(function(){
      $(this).removeClass("visible");
      $(this).addClass("hidden");
    });
  }

  addInputListeners();
  $("#session_data_loaded").change();

}



function get_cart(){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "list_cart_items",
      session_key: localStorage.session_key
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_cart_items] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["cart-items-count"]=response.data.cart_items_count;
        $(".data-ajax-cart-items-count").html($_ajax["cart-items-count"]);
        if($_PAGE=="/shop/cart/"){
          $_ajax["cart-items-list"]="";
          $_ajax["cart-items-list-small"]="";
          $_ajax["cart-subtotal"]=0;
          $_ajax["cart-items"]=response.data.cart_items;

          jQuery.each(response.data.cart_items,function($_key,$_cart_item){
            $_ajax["cart-items-list"]+="<tr>";
            $_ajax["cart-items-list"]+="  <td class='vert-align'><a href='../../shop/product/index.html?id_product="+$_cart_item.id_product+"'>"+$_cart_item.product.name_es+"</a></td>";
            $_ajax["cart-items-list"]+="  <td class='vert-align'>"+$_cart_item.color.name_es+"</td>";
            $_ajax["cart-items-list"]+="  <td class='vert-align text-center'>"+$_s["sizes_guide_"+$_cart_item.size]+"</td>";
            if($_cart_item.product.use_discount==1){
              $_ajax["cart-items-list"]+="  <td class='vert-align cart-price text-right'>"+$_cart_item.product.price_with_discount+"€ <span class='original-price'>"+$_cart_item.product.pvp+"€</span></td>";
            }else{
              $_ajax["cart-items-list"]+="  <td class='vert-align cart-price text-right'>"+$_cart_item.product.price_with_discount+"€</td>";
            }
            $_ajax["cart-items-list"]+="  <td class='text-center vert-align'>";
            $_ajax["cart-items-list"]+="    <select class='form-control form-control-inline input-cart-quantity' data-cart-item='"+$_key+"'>";
            for ( $_i=0;$_i<=9;$_i++){
              $_option_selected="";
              if($_cart_item.quantity==$_i){$_option_selected="selected"}
              $_ajax["cart-items-list"]+="      <option value='"+$_i+"' "+$_option_selected+">"+$_i+"</option>";
            }

            $_ajax["cart-items-list"]+="    </select>";
            $_ajax["cart-items-list"]+="  </td>";


            $_ajax["cart-items-list"]+="  <td class='text-right vert-align'>"+$_cart_item.total+"€</td>";
            $_ajax["cart-items-list"]+="  <td class='text-center vert-align'><a href='javascript:delete_cart_item("+$_cart_item.id_product+","+$_cart_item.id_color+","+$_cart_item.size+")' class='remove-item'><i class='icon-close'></i></a></td>";
            $_ajax["cart-items-list"]+="</tr>";

            $_ajax["cart-items-list-small"]+="<tr>";
            $_ajax["cart-items-list-small"]+="  <td class='vert-align'><a href='../../shop/product/index.html?id_product="+$_cart_item.id_product+"'>"+$_cart_item.product.name_es+" "+$_cart_item.color.name_es+"<br/>(Talla: "+$_s["sizes_guide_"+$_cart_item.size]+")</a></td>";

            $_ajax["cart-items-list-small"]+="  <td class='text-center vert-align'>";
            $_ajax["cart-items-list-small"]+="    <select class='form-control form-control-inline input-cart-quantity' data-cart-item='"+$_key+"'>";
            for ( $_i=0;$_i<=9;$_i++){
              $_option_selected="";
              if($_cart_item.quantity==$_i){$_option_selected="selected"}
              $_ajax["cart-items-list-small"]+="      <option value='"+$_i+"' "+$_option_selected+">"+$_i+"</option>";
            }

            $_ajax["cart-items-list-small"]+="    </select>";
            $_ajax["cart-items-list-small"]+="  </td>";

            $_ajax["cart-items-list-small"]+="  <td class='text-center vert-align'>"+$_cart_item.total+"€</td>";
            $_ajax["cart-items-list-small"]+="  <td class='text-center vert-align'><a href='javascript:delete_cart_item("+$_cart_item.id_product+","+$_cart_item.id_color+","+$_cart_item.size+")' class='remove-item'><i class='icon-close'></i></a></td>";
            $_ajax["cart-items-list-small"]+="</tr>";

            $_ajax["cart-subtotal"]+=$_cart_item.total;
          });



          $(".data-ajax-cart-items-list").html($_ajax["cart-items-list"]);

          $_ajax["cart-subtotal"]=parseInt($_ajax["cart-subtotal"]);
          $(".data-ajax-cart-subtotal").html($_ajax["cart-subtotal"]);
          $_ajax["cart-shipping"]=9;
          $(".data-ajax-cart-shipping").html($_ajax["cart-shipping"]);
          $_ajax["cart-total"]=$_ajax["cart-subtotal"]+$_ajax["cart-shipping"];
          $(".data-ajax-cart-total").html($_ajax["cart-total"]);

          $_ajax["cart-items-list-small"]+="";
          $_ajax["cart-items-list-small"]+="<tr>";
          $_ajax["cart-items-list-small"]+="  <td>Subtotal:</td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="  <td class='text-right'><b>"+$_ajax["cart-subtotal"]+"€</b></td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="</tr>";
          $_ajax["cart-items-list-small"]+="<tr>";
          $_ajax["cart-items-list-small"]+="  <td>Envío:</td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="  <td class='text-right'>"+$_ajax["cart-shipping"]+"€</td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="</tr>";
          $_ajax["cart-items-list-small"]+="<tr>";
          $_ajax["cart-items-list-small"]+="  <td>Total*:</td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="  <td id='total' class='text-right'>"+$_ajax["cart-total"]+"€</td>";
          $_ajax["cart-items-list-small"]+="  <td></td>";
          $_ajax["cart-items-list-small"]+="</tr>";
          $(".data-ajax-cart-items-list-small").html($_ajax["cart-items-list-small"]);

          $(".input-cart-quantity").change(function(){
            $_key=$(this).attr("data-cart-item");
            $_id_product=$_ajax["cart-items"][$_key]["id_product"];
            $_id_color=$_ajax["cart-items"][$_key]["id_color"];
            $_size=$_ajax["cart-items"][$_key]["size"];
            $_quantity=$(this).val();
            update_quantity_cart_item($_id_product,$_id_color,$_size,$_quantity)
          });
      }

        if($_PAGE=="/shop/checkout/1/"){
          if(localStorage.logged==1){
            $_ajax["shipping_address_validation"]=true;
          }
          $_ajax["order-items-list"]="";
          $_ajax["order-subtotal"]=0;

          jQuery.each(response.data.cart_items,function($_key,$_cart_item){
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align'>"+$_cart_item.product.name_es+"</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align'>"+$_cart_item.quantity+"x</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_cart_item.total+"€</td>";
            $_ajax["order-items-list"]+="</tr>";
            $_ajax["order-subtotal"]+=$_cart_item.total;
          });

          $_ajax["order-subtotal"]=parseInt($_ajax["order-subtotal"]);

          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td class='vert-align'><b>Subtotal</b></td>";
          $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_ajax["order-subtotal"]+"€</td>";
          $_ajax["order-items-list"]+="</tr>";



          if(response.data.shipping.is_selected){
            $_ajax["shipping_price"]=parseInt(response.data.shipping.selected.shipping_price);
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align'>Coste de envío (<a href='javascript:$(\".shipping-alternative\").removeClass(\"hidden\");'>Cambiar</a>)</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+response.data.shipping.selected.shipping_title+"</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+response.data.shipping.selected.shipping_price+"€</td>";
            $_ajax["order-items-list"]+="</tr>";
            $_ajax["cart-total"]=$_ajax["order-subtotal"]+$_ajax["shipping_price"];
            $_ajax["shipping_validation"]=true;


          }else{
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align' colspan='3'>Seleccione un método de envío</td>";
            $_ajax["order-items-list"]+="</tr>";
            $_ajax["cart-total"]="- - ";
          }
          if(response.data.shipping.has_alternatives){

            jQuery.each(response.data.shipping.alternatives,function($_key,$_alternative){
              $_style="";
              if(response.data.shipping.is_selected){
                $_style="class='hidden shipping-alternative'";
              }
              $_ajax["order-items-list"]+="<tr "+$_style+">";
              $_ajax["order-items-list"]+="  <td class='vert-align text-left' colspan='2'><div class='radio margin-0'><label><input type='radio'  name='id_shipping' class='input-data-session-data' input-data-session-data='id_shipping' value='"+$_alternative.id_shipping+"'><span>"+$_alternative.shipping_title+"</span></label></div></td>";
              $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_alternative.shipping_price+"€</td>";
              $_ajax["order-items-list"]+="</tr>";
            });

          }else{
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right' colspan='3'><span class='text-danger'>No enviamos al país que nos ha indicado</span></td>";
            $_ajax["order-items-list"]+="</tr>";
          }




          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td class='vert-align'>Total</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>"+$_ajax["cart-total"]+"€</td>";
          $_ajax["order-items-list"]+="</tr>";

          $_style="";
          if(response.data.payment_method.is_selected){
            $_ajax["order-items-list"]+="<tr class=''>";
            $_ajax["order-items-list"]+="  <td class='vert-align' colspan='3'>Método de pago: <b>"+response.data.payment_method.selected.payment_method_title+"</b> (<a href='javascript:$(\".payment_method-alternative\").toggleClass(\"hidden\");'>Cambiar</a>)</td>";
            $_ajax["order-items-list"]+="</tr>";
            $_style="hidden";
            $_ajax["payment_method_validation"]=true;
          }
          $_ajax["order-items-list"]+="<tr class='payment_method-alternative "+$_style+"'>";
          $_ajax["order-items-list"]+="  <td class='vert-align' colspan='3'>Seleccione un método de pago</td>";
          $_ajax["order-items-list"]+="</tr>";

          if(response.data.payment_method.has_alternatives){

            jQuery.each(response.data.payment_method.alternatives,function($_key,$_alternative){
              $_ajax["order-items-list"]+="<tr class='payment_method-alternative "+$_style+"'>";
              $_ajax["order-items-list"]+="  <td class='vert-align text-left' colspan='3'><div class='radio margin-0'><label><input type='radio'  name='id_payment_method' class='input-data-session-data' input-data-session-data='id_payment_method' value='"+$_alternative.id_payment_method+"'><span>"+$_alternative.payment_method_title+"</span></label></div></td>";
              $_ajax["order-items-list"]+="</tr>";
            });

          }else{
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right' colspan='3'><span class='text-danger'>No existen métodos de pago disponibles</span></td>";
            $_ajax["order-items-list"]+="</tr>";
          }

          $(".data-ajax-order-items-list").html($_ajax["order-items-list"]);
          addInputListeners();
          validate_order();
        }

      }else{
        if(response.error_code=="cart_items_list_empty"){
          $_ajax["cart-items-count"]="";
          $(".data-ajax-cart-items-count").html($_ajax["cart-items-count"]);
          if($_PAGE=="/shop/cart/"){
            $_ajax["cart-items-list"]="";
            $_ajax["cart-items-list"]+="<tr>";
            $_ajax["cart-items-list"]+="  <td colspan='5'>";
            $_ajax["cart-items-list"]+="    <h2 class='text-center'><span data-lang='your-cart-is-empty'>El carro está vacío</span></h2>";
            $_ajax["cart-items-list"]+="  </td>";
            $_ajax["cart-items-list"]+="</tr>";
            $(".data-ajax-cart-items-list").html($_ajax["cart-items-list"]);
            $_ajax["cart-subtotal"]=0;
            $(".data-ajax-cart-subtotal").html($_ajax["cart-subtotal"]);
            $_ajax["cart-shipping"]=0;
            $(".data-ajax-cart-shipping").html($_ajax["cart-shipping"]);
            $_ajax["cart-total"]=0;
            $(".data-ajax-cart-total").html($_ajax["cart-total"]);
            $_ajax["cart-items-count"]="";
            $(".data-ajax-cart-items-count").html($_ajax["cart-items-count"]);

            $_ajax["cart-items-list-small"]="";
            $_ajax["cart-items-list-small"]+="<tr>";
            $_ajax["cart-items-list-small"]+="  <td>Subtotal:</td>";
            $_ajax["cart-items-list-small"]+="  <td></td>";
            $_ajax["cart-items-list-small"]+="  <td class='text-right'><b>"+$_ajax["cart-subtotal"]+"€</b></td>";
            $_ajax["cart-items-list-small"]+="</tr>";
            $_ajax["cart-items-list-small"]+="<tr>";
            $_ajax["cart-items-list-small"]+="  <td>Envío:</td>";
            $_ajax["cart-items-list-small"]+="  <td></td>";
            $_ajax["cart-items-list-small"]+="  <td class='text-right'>"+$_ajax["cart-shipping"]+"€</td>";
            $_ajax["cart-items-list-small"]+="</tr>";
            $_ajax["cart-items-list-small"]+="<tr>";
            $_ajax["cart-items-list-small"]+="  <td>Total*:</td>";
            $_ajax["cart-items-list-small"]+="  <td></td>";
            $_ajax["cart-items-list-small"]+="  <td id='total' class='text-right'>"+$_ajax["cart-total"]+"€</td>";
            $_ajax["cart-items-list-small"]+="</tr>";
            $(".data-ajax-cart-items-list-small").html($_ajax["cart-items-list-small"]);
          }

          if($_PAGE=="/shop/checkout/1/"){
            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align'><b>Subtotal</b></td>";
            $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right'>0€</td>";
            $_ajax["order-items-list"]+="</tr>";

            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align'>Coste de envío</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right'>0€</td>";
            $_ajax["order-items-list"]+="</tr>";

            $_ajax["order-items-list"]+="<tr>";
            $_ajax["order-items-list"]+="  <td class='vert-align'>Coste de envío</td>";
            $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
            $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>0€</td>";
            $_ajax["order-items-list"]+="</tr>";

            $(".data-ajax-order-items-list").html($_ajax["order-items-list"]);
          }

        }

      }
    }
  });
}

function add_to_cart($_id_product,$_id_color,$_size,$_quantity){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "add_cart_item",
      session_key: localStorage.session_key,
      id_product: $_id_product,
      id_color: $_id_color,
      size: $_size,
      quantity: $_quantity,
    },
    error: function(data, textStatus, jqXHR) {
      alert("[add_cart_item] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        get_cart();
        $('.cart').fadeOut(400).delay(100).fadeIn(400).delay(100).fadeOut(400).delay(100).fadeIn(400);

      }else{
        alert("[add_cart_item] error: "+response.error_code);
      }
    }
  });
}

function delete_cart_item($_id_product,$_id_color,$_size){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "delete_cart_item",
      session_key: localStorage.session_key,
      id_product: $_id_product,
      id_color: $_id_color,
      size: $_size
    },
    error: function(data, textStatus, jqXHR) {
      alert("[add_cart_item] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        get_cart();
      }else{
        alert("[add_cart_item] error: "+response.error_code);
      }
    }
  });
}
function update_quantity_cart_item($_id_product,$_id_color,$_size,$_quantity){
  if($_quantity==0){
    delete_cart_item($_id_product,$_id_color,$_size);
  }else{
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/cart/model.php",
      data: {
        action: "update_quantity_cart_item",
        session_key: localStorage.session_key,
        id_product: $_id_product,
        id_color: $_id_color,
        size: $_size,
        quantity: $_quantity
      },
      error: function(data, textStatus, jqXHR) {
        alert("[add_cart_item] error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          get_cart();
        }else{
          alert("[add_cart_item] error: "+response.error_code);
        }
      }
    });
  }
}
function accept_cookies(){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/access/model.php",
    data: {
      "action":"update_session",
      "session_key":$_session_data["session_key"],
      "index":"cookies_accepted",
      "value":"1"
    },
    error: function(data, textStatus, jqXHR) {
      alert("[get_session] error: ajax call error");
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
        localStorage.id_shipping=response.data.id_shipping;
        localStorage.shipping_title=response.data.shipping_title;
        localStorage.shipping_price=response.data.shipping_price;
        localStorage.id_payment_method=response.data.id_payment_method;
        localStorage.payment_method_title=response.data.payment_method_title;
        localStorage.payment_method_value=response.data.payment_method_value;
        localStorage.size=response.data.size;
        localStorage.cookies_accepted=response.data.cookies_accepted;
        localStorage.logged=response.data.logged;
        localStorage.id_client="#W"+response.data.id_client;
        $("#cookies_footer").addClass("hidden");
      }else{
        alert("[get_session] error: "+response.error_code);
      }
    }
  });

}

function addInputListeners(){
  $(".input-data-session-data").change(function(){
    $_index=$(this).attr("input-data-session-data");
    $_value=$(this).val();
    updateSession($_index,$_value);
  });
}
function updateSession($_index,$_value){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/access/model.php",
    data: {
      "action":"update_session",
      "session_key":$_session_data["session_key"],
      "index":$_index,
      "value":$_value
    },
    error: function(data, textStatus, jqXHR) {
      alert("[get_session] error: ajax call error");
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
        localStorage.id_shipping=response.data.id_shipping;
        localStorage.shipping_title=response.data.shipping_title;
        localStorage.shipping_price=response.data.shipping_price;
        localStorage.id_payment_method=response.data.id_payment_method;
        localStorage.payment_method_title=response.data.payment_method_title;
        localStorage.payment_method_value=response.data.payment_method_value;
        localStorage.size=response.data.size;
        localStorage.cookies_accepted=response.data.cookies_accepted;
        localStorage.logged=response.data.logged;
        localStorage.id_client="#W"+response.data.id_client;
        $_session_data["session_key"]=response.data.session_key;
        $_session_data["first_name"]=response.data.first_name;
        $_session_data["last_name"]=response.data.last_name;
        $_session_data["email"]=response.data.email;
        $_session_data["passport"]=response.data.passport;
        $_session_data["street_1"]=response.data.street_1;
        $_session_data["street_2"]=response.data.street_2;
        $_session_data["city"]=response.data.city;
        $_session_data["zip"]=response.data.zip;
        $_session_data["country"]=response.data.country;
        $_session_data["state"]=response.data.state;
        $_session_data["phone"]=response.data.phone;
        $_session_data["id_shipping"]=response.data.id_shipping;
        $_session_data["shipping_title"]=response.data.shipping_title;
        $_session_data["shipping_price"]=response.data.shipping_price;
        $_session_data["id_payment_method"]=response.data.id_payment_method;
        $_session_data["payment_method_title"]=response.data.payment_method_title;
        $_session_data["payment_method_value"]=response.data.payment_method_value;
        $_session_data["size"]=response.data.size;
        $_session_data["cookies_accepted"]=response.data.cookies_accepted;
        $_session_data["logged"]=response.data.logged;
        $_session_data["id_client"]="#W"+response.data.id_client;
        
        if(localStorage.cookies_accepted=="0"){
          $("#cookies_footer").removeClass("hidden");
        }
        get_cart();
      }else{
        alert("[get_session] error: "+response.error_code);
      }
    }
  });
}
