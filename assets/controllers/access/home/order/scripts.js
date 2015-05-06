
$(document).ready(function() {

  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/orders/model.php",
    data: {
      action: "get_order",
      session_key: localStorage.session_key,
      id_order: $_GET["id_order"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_order_items] error: ajax call error");
    },
    success: function(response) {
      if(response.result){

        $_ajax["order-title"]="Pedido #"+response.data.id_order;
        $_ajax["order-id-order"]=response.data.id_order;
        $(".data-ajax-order-id-order").html($_ajax["order-id-order"]);
        $_ajax["order-date"]=timestamp_to_date(response.data.date);
        $(".data-ajax-order-date").html($_ajax["order-date"]);
        $_ajax["order-delivery-date"]=timestamp_to_date(response.data.date);
        $(".data-ajax-order-delivery-date").html($_ajax["order-delivery-date"]);
        $_ajax["order-deadline-date"]=timestamp_to_date(response.data.date);
        $(".data-ajax-order-deadline-date").html($_ajax["order-deadline-date"]);
        $_ajax["order-agent"]="WEB SHOP";
        $(".data-ajax-order-agent").html($_ajax["order-agent"]);
        $_ajax["order-user-comment"]=response.data.user_comment;
        $(".data-ajax-order-user-comment").html($_ajax["order-user-comment"]);

        $_ajax["order-invoice-address"]="";
        $_ajax["order-invoice-address"]+="<b>"+response.data.invoice_address_name+" "+response.data.invoice_address_subname+"</b> #"+response.data.client.id_elastic+"<br/>";
        $_ajax["order-invoice-address"]+=""+response.data.invoice_address_DNI+"<br/>";
        $_ajax["order-invoice-address"]+=""+response.data.invoice_address_address_1+"<br/>";
        if(response.data.invoice_address_address_2!=""){
          $_ajax["order-invoice-address"]+=""+response.data.invoice_address_address_2+"<br/>";
        }
        $_ajax["order-invoice-address"]+="("+response.data.invoice_address_post_code+") "+response.data.invoice_address_city+" "+response.data.invoice_address_province+" <br/>";
        $_ajax["order-invoice-address"]+=""+response.data.invoice_address_country+"<br/>";
        $_ajax["order-invoice-address"]+="tfl.: "+response.data.invoice_address_mobile+" "+response.data.invoice_address_other+"<br/>";


        $_ajax["order-shipping-address"]="";
        $_ajax["order-shipping-address"]+="<b>"+response.data.shipping_address_name+" "+response.data.shipping_address_subname+"</b><br/>";
        $_ajax["order-shipping-address"]+=""+response.data.shipping_address_address_1+"<br/>";
        if(response.data.shipping_address_address_2!=""){
          $_ajax["order-shipping-address"]+=""+response.data.shipping_address_address_2+"<br/>";
        }
        $_ajax["order-shipping-address"]+="("+response.data.shipping_address_post_code+") "+response.data.shipping_address_city+" "+response.data.shipping_address_province+" <br/>";
        $_ajax["order-shipping-address"]+=""+response.data.shipping_address_country+"<br/>";
        $_ajax["order-shipping-address"]+="tfl.: "+response.data.shipping_address_mobile+" "+response.data.shipping_address_other+"<br/>";


        $_ajax["order-items-list"]="";

        jQuery.each(response.data.order_items,function($_key,$_order_item){
          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td class='vert-align'>"+$_order_item.serial_model_code+" "+$_order_item.name_color+"</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_order_item.unitary_price+"€</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_order_item.subclothes+"x</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+$_order_item.subtotal+"€</td>";
          $_ajax["order-items-list"]+="</tr>";
        });

        $_ajax["order-items-list"]+="<tr>";
        $_ajax["order-items-list"]+="  <td  colspan='3' class='vert-align text-right'>Coste de Envío</td>";
        $_ajax["order-items-list"]+="  <td class='vert-align text-right'>"+response.data.shipping_method_price+"€</td>";
        $_ajax["order-items-list"]+="</tr>";


        if(response.data.discount>0){
          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td  colspan='3' class='vert-align text-right'>Descuento</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>"+response.data.total_with_discount+"€</td>";
          $_ajax["order-items-list"]+="</tr>";
          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td  colspan='3' class='vert-align text-right'>Total</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>"+response.data.total_with_discount+"€</td>";
          $_ajax["order-items-list"]+="</tr>";
        }else{
          $_ajax["order-items-list"]+="<tr>";
          $_ajax["order-items-list"]+="  <td  colspan='3' class='vert-align text-right'>Total</td>";
          $_ajax["order-items-list"]+="  <td class='vert-align text-right' id='total'>"+response.data.total_with_discount+"€</td>";
          $_ajax["order-items-list"]+="</tr>";
        }


        $(".data-ajax-order-items-list").html($_ajax["order-items-list"]);
        $(".data-ajax-order-invoice-address").html($_ajax["order-invoice-address"]);
        $(".data-ajax-order-shipping-address").html($_ajax["order-shipping-address"]);
        $(".data-ajax-order-title").html($_ajax["order-title"]);


      }else{
        alert("[list_order_items] error: "+response.error_code);

      }
    }
  });

});
