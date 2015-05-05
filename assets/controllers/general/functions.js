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
  if ((typeof localStorage.getItem('session_key') == 'undefined')||(localStorage.getItem('session_key') == null)){
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        "action":"get_session"
      },
      error: function(data, textStatus, jqXHR) {
        alert("[get_session] error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.setItem('session_key',response.data.session_key);
        }else{
          alert("[get_session] error: "+result.error_code);
        }
      }
    });
    //window.location.href = $_PATH+"access/login/";
  }
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
