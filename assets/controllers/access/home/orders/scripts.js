
$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/orders/model.php",
    data: {
      action: "list_orders",
      session_key: localStorage.session_key
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_cart_items] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["orders-list"]="";
        jQuery.each(response.data,function($_key,$_order){
          $_ajax["orders-list"]+="<tr>";
          $_ajax["orders-list"]+="  <td class='vert-align'><a href='../../../access/home/order/index.html?id_order="+$_order.id_order+"'>#"+$_order.id_order+"</a></td>";
          $_ajax["orders-list"]+="  <td class='vert-align'>"+timestamp_to_str($_order.date)+"</td>";
          $_ajax["orders-list"]+="  <td class='vert-align text-right'>"+$_order.num_clothes+"</td>";
          $_ajax["orders-list"]+="  <td class='vert-align text-right'><b>"+$_order.total_with_discount+"€</b></td>";
          $_ajax["orders-list"]+="  <td class='vert-align text-center'>"+$_s["payment_"+$_order.payed]+"</td>";
          $_ajax["orders-list"]+="  <td class='vert-align text-right'>"+$_s["order_status_"+$_order.order_state]+"</td>";
          $_ajax["orders-list"]+="</tr>";
        });
        $(".data-ajax-orders-list").html($_ajax["orders-list"]);

      }else{
        if(response.error_code=="orders_list_empty"){
          $_ajax["orders-list"]="";
          $_ajax["orders-list"]+="<tr>";
          $_ajax["orders-list"]+="  <td colspan='5'>";
          $_ajax["orders-list"]+="    <h2 class='text-center'><span>No hay Pedidos</span></h2>";
          $_ajax["orders-list"]+="  </td>";
          $_ajax["orders-list"]+="</tr>";
          $(".data-ajax-orders-list").html($_ajax["orders-list"]);
        }
      }
    }
  });

});
