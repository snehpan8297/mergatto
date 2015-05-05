/*********************************************************
* FUNCTION: session_destroy
* DATA:
* DESCRIPTION:
*
*********************************************************/

function session_destroy(){
  localStorage.removeItem('session_key');
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
  if ((typeof localStorage.getItem('session_key') == 'undefined')||(localStorage.getItem('session_key') == null)){
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        "action":"add_session"
      },
      error: function(data, textStatus, jqXHR) {
        alert("[get_session] error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.setItem('session_key',response.data.session_key);
          localStorage.setItem('first_name',"");
          localStorage.setItem('second_name',"");
          localStorage.setItem('email',"");
          localStorage.setItem('street_1',"");
          localStorage.setItem('street_2',"");
          localStorage.setItem('city',"");
          localStorage.setItem('zip',"");
          localStorage.setItem('state',"");
          localStorage.setItem('phone',"");
          localStorage.setItem('size',"");
          $_session_data["session_key"]=localStorage.getItem('session_key');
    }else{
          alert("[get_session] error: "+response.error_code);
        }
      }
    });
    //window.location.href = $_PATH+"access/login/";
  }else{
    $_session_data["session_key"]=localStorage.getItem('session_key');

    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        "action":"get_session",
        "session_key":$_session_data["session_key"]
      },
      error: function(data, textStatus, jqXHR) {
        alert("[get_session] error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.setItem('session_key',response.data.session_key);
          localStorage.setItem('first_name',response.data.first_name);
          localStorage.setItem('second_name',response.data.second_name);
          localStorage.setItem('email',response.data.email);
          localStorage.setItem('street_1',response.data.street_1);
          localStorage.setItem('street_2',response.data.street_2);
          localStorage.setItem('city',response.data.city);
          localStorage.setItem('zip',response.data.zip);
          localStorage.setItem('country',response.data.country);
          localStorage.setItem('state',response.data.state);
          localStorage.setItem('phone',response.data.phone);
          localStorage.setItem('size',response.data.size);
        }else{
          if(response.error_code=="session_key_not_valid"){
            localStorage.removeItem('session_key');
            check_session();
          }else{
            alert("[get_session] error: "+response.error_code);
          }
        }
      }
    });
  }
  $_session_data["first_name"]=localStorage.getItem('first_name');
  $_session_data["second_name"]=localStorage.getItem('second_name');
  $_session_data["email"]=localStorage.getItem('email');
  $_session_data["street_1"]=localStorage.getItem('street_1');
  $_session_data["street_2"]=localStorage.getItem('street_2');
  $_session_data["city"]=localStorage.getItem('city');
  $_session_data["zip"]=localStorage.getItem('zip');
  $_session_data["country"]=localStorage.getItem('country');
  $_session_data["state"]=localStorage.getItem('state');
  $_session_data["phone"]=localStorage.getItem('phone');
  $_session_data["size"]=localStorage.getItem('size');

  $(".input-data-session-data").each(function(){
    $_index=$(this).attr("input-data-session-data");
    $(this).val($_session_data[$_index]);
    if($_index=="size"){

    }
  });
  $(".input-data-session-data").change(function(){
    $_index=$(this).attr("input-data-session-data");
    $_value=$(this).val();
    localStorage.setItem($_index,$_value);
    $_session_data[$_index]=localStorage.getItem($_index);

    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/shop/model/access/model.php",
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

        }else{
          alert("[get_session] error: "+response.error_code);
        }
      }
    });
  });

}

function get_cart(){
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "list_cart_items",
      session_key: localStorage.getItem("session_key")
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
          $_ajax["cart-subtotal"]=0;
          $_ajax["cart-items"]=response.data.cart_items;

          jQuery.each(response.data.cart_items,function($_key,$_cart_item){
            $_ajax["cart-items-list"]+="<tr>";
            $_ajax["cart-items-list"]+="  <td class='vert-align'><a href='../../shop/product/index.html?id_product="+$_cart_item.id_product+"'>"+$_cart_item.product.name_es+"</a></td>";
            $_ajax["cart-items-list"]+="  <td class='vert-align'>"+$_cart_item.color.name_es+"</td>";
            $_ajax["cart-items-list"]+="  <td class='vert-align'>"+$_s["sizes_guide_"+$_cart_item.size]+"</td>";
            if($_cart_item.product.use_discount){
              $_ajax["cart-items-list"]+="  <td class='vert-align cart-price'>"+$_cart_item.product.price_with_discount+"€ <span class='original-price'>"+$_cart_item.product.pvp+"€</span></td>";
            }else{
              $_ajax["cart-items-list"]+="  <td class='vert-align cart-price'>"+$_cart_item.product.price_with_discount+"€</td>";
            }
            $_ajax["cart-items-list"]+="  <td class='text-center vert-align'><input type='number' min='1' max='9' class='form-control form-control-inline input-cart-quantity' data-cart-item='"+$_key+"' style='width: 52px!important;' value='"+$_cart_item.quantity+"'></td>";
            $_ajax["cart-items-list"]+="  <td class='text-right vert-align'>"+$_cart_item.total+"€</td>";
            $_ajax["cart-items-list"]+="  <td class='text-center vert-align'><a href='javascript:delete_cart_item("+$_cart_item.id_product+","+$_cart_item.id_color+","+$_cart_item.size+")' class='remove-item'><i class='icon-close'></i></a></td>";
            $_ajax["cart-items-list"]+="</tr>";
            $_ajax["cart-subtotal"]+=$_cart_item.total;
        });

          $(".data-ajax-cart-items-list").html($_ajax["cart-items-list"]);
          $(".input-cart-quantity").change(function(){
            $_key=$(this).attr("data-cart-item");
            $_id_product=$_ajax["cart-items"][$_key]["id_product"];
            $_id_color=$_ajax["cart-items"][$_key]["id_color"];
            $_size=$_ajax["cart-items"][$_key]["size"];
            $_quantity=$(this).val();
            update_quantity_cart_item($_id_product,$_id_color,$_size,$_quantity)
          });
          $(".data-ajax-cart-subtotal").html(parseInt($_ajax["cart-subtotal"]));
          $_ajax["cart-shipping"]=9;
          $(".data-ajax-cart-shipping").html($_ajax["cart-shipping"]);
          $_ajax["cart-total"]=$_ajax["cart-subtotal"]+$_ajax["cart-shipping"];
          $(".data-ajax-cart-total").html($_ajax["cart-total"]);
        }

        if($_PAGE=="/shop/checkout/1/"){
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

          $_ajax["order-shipping"]="9";
          $_ajax["order-shipping"]=parseInt($_ajax["order-shipping"]);

          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td class='vert-align'>Coste de envío</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_ajax["order-shipping"]+"€</td>";
          $_ajax["order-items-list"]+="</tr>";

          $_ajax["cart-total"]=$_ajax["order-subtotal"]+$_ajax["order-shipping"];

          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td class='vert-align'>Coste de envío</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align'></td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>"+$_ajax["cart-total"]+"€</td>";
          $_ajax["order-items-list"]+="</tr>";

          $(".data-ajax-order-items-list").html($_ajax["order-items-list"]);
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
    url: $SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "add_cart_item",
      session_key: localStorage.getItem("session_key"),
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
    url: $SERVER_PATH+"server/shop/model/cart/model.php",
    data: {
      action: "delete_cart_item",
      session_key: localStorage.getItem("session_key"),
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
      url: $SERVER_PATH+"server/shop/model/cart/model.php",
      data: {
        action: "update_quantity_cart_item",
        session_key: localStorage.getItem("session_key"),
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
