$(document).ready(function() {
  $("#session_data_loaded").change(function(){
    if(!isset_and_not_empty(localStorage.current_id_order)){
      $_session_data["current_id_order"]=0;
    }else{
      $_session_data["current_id_order"]=localStorage.current_id_order;
    }
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/orders/model.php",
      data: {
        action: "add_order",
        session_key: $_session_data["session_key"],
        current_id_order:$_session_data["current_id_order"]
      },
      error: function(data, textStatus, jqXHR) {
        alert("Ha ocurrido un error en el servidor, vuelva a intentarlo más tarde.");
      },
      success: function(response) {

        if(response.result){
          $_session_data["current_id_order"]=response.data.id_order;
          localStorage.current_id_order=response.data.id_order;
          $_ajax["order_total_with_discount"]=response.data.total_with_discount;

          if($_session_data["payment_method_value"]=="paypal"){
            $.ajax({
              type: "POST",
              dataType: 'json',
              url: $_SERVER_PATH+"server/shop/model/payments/model.php",
              data: {
                action: "get_paypal_signature",
                id_order: $_session_data["current_id_order"]
              },
              error: function(data, textStatus, jqXHR) {
                alert("[get_paypal_signature] error: ajax call error");
              },
              success: function(response) {
                if(response.result){
                  $_ajax["page"]="";
                  $_ajax["page"]+="<form id='gateway-form' action='https://www.paypal.com/cgi-bin/webscr' method='POST'>";
                  $_ajax["page"]+="  <input type='hidden' name='cancel_return' value='http://www.okycoky.net/new/shop/payment/error/index.html'>";
                  $_ajax["page"]+="  <input type='hidden' name='return' value='http://www.okycoky.net/new/shop/payment/success/index.html'>";
                  $_ajax["page"]+="  <input type='hidden' name='notify_url' value='http://www.okycoky.net/new/server/shop/model/payments/post_paypal.php'>";
                  $_ajax["page"]+="  <input type='hidden' name='cmd' value='_xclick'>";
                  $_ajax["page"]+="  <input type='hidden' name='business' value='K3BRJAETH8GJ2'>";
                  $_ajax["page"]+="  <input type='hidden' name='item_name' value='"+response.data.gateway_code+"'>";
                  $_ajax["page"]+="  <input type='hidden' name='currency_code' value='EUR'>";
                  $_ajax["page"]+="  <input type='hidden' name='amount' value='"+response.data.total+"'>";
                  $_ajax["page"]+="  <input type='hidden' name='custom' value='"+$_session_data["current_id_order"]+"'>";
                  $_ajax["page"]+="</form>";
                  $_ajax["page"]+="";
                  $(".data-ajax-page").append($_ajax["page"]);
                  $("#gateway-form").submit();

                }else{
                  alert("[get_paypal_signature] error: "+response.error_code);
                }
              }
            });


          }else if($_session_data["payment_method_value"]=="credit_card"){
            $.ajax({
              type: "POST",
              dataType: 'json',
              url: $_SERVER_PATH+"server/shop/model/payments/model.php",
              data: {
                action: "get_credit_card_signature",
                id_order: $_session_data["current_id_order"]
              },
              error: function(data, textStatus, jqXHR) {
                alert("[get_credit_card_signature] error: ajax call error");
              },
              success: function(response) {
                if(response.result){
                  $_ajax["page"]="";
                  $_ajax["page"]+="<form id='gateway-form' name='gateway-form' action='https://sis.sermepa.es/sis/realizarPago' method='post'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Amount value='"+response.data.total+"'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Currency value='978'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Order  value='"+response.data.gateway_code+"'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Titular  value='Oky Coky Shop'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantCode value='047278643'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantName value='ROTELPA, S.A (Fashion Retail)'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_ConsumerLanguage value='001'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Terminal value='1'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_TransactionType value='0'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantURL value='http://www.okycoky.net/new/server/shop/model/payments/post_credit_card.php'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_UrlOK value='http://www.okycoky.net/new/shop/payment/success/index.html'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_UrlKO value='http://www.okycoky.net/new/shop/payment/error/index.html'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantSignature value='"+response.data.signature+"'>";
                  $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantData value='"+$_session_data["current_id_order"]+"'>";
                  $_ajax["page"]+="</form>";
                  $_ajax["page"]+="";
                  $(".data-ajax-page").append($_ajax["page"]);
                  $("#gateway-form").submit();

                }else{
                  alert("[get_credit_card_signature] error: "+response.error_code);
                }
              }
            });
          }else if($_session_data["payment_method_value"]=="bank_transfer"){
            $_ajax["page"]="";
            $_ajax["page"]+="<div class='row m-b-40'>";
            $_ajax["page"]+=" <div class='col-sm-12 text-center'>";
            $_ajax["page"]+="   <p class='icon-xl m-b-20'><i class='fa fa-check'></i></p>";
            $_ajax["page"]+="   <h4>Pedido Aceptado</h4>";
            $_ajax["page"]+=" </div>";
            $_ajax["page"]+="</div>";

            $_ajax["page"]+="<div class='row'>";
            $_ajax["page"]+="<div class='col-sm-3'>";
            $_ajax["page"]+="</div>";
            $_ajax["page"]+="<div class='col-sm-6'>";
            $_ajax["page"]+="<p class='alert alert-warning text-center'><b>IMPORTANTE</b><br/>PARA TENER TUS PRENDAS LO ANTES POSIBLE.<br/>Envíanos el justificante de pago a classics@okycoky.com, también puedes hacerle una foto con el móvil.</p>"
            $_ajax["page"]+="<table class='table'>";
            $_ajax["page"]+="  <thead>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <th colspan='2' class='text-center'>";
            $_ajax["page"]+="        Datos para realizar la transferencia Bancaria";
            $_ajax["page"]+="     </th>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="  </thead>";
            $_ajax["page"]+="  <tbody>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>Banco</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       La Caixa, Caja de Ahorros y Pensiones de Barcelona";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>SWIFT</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       CAIXESBB";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>IBAN</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       ES7021002178030200148419";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>Número de Cuenta</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       2100 2178 03 0200148419";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>Beneficiario</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       ROTELPA, S.A (Fashion Retail)";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>Concepto</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       Pedido #"+$_session_data["current_id_order"];
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="   <tr>";
            $_ajax["page"]+="     <td class='text-right'>";
            $_ajax["page"]+="        <b>Total</b>";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="     <td class='text-left'>";
            $_ajax["page"]+="       "+$_session_data["order_total_with_discount"]+"€";
            $_ajax["page"]+="     </td>";
            $_ajax["page"]+="   </tr>";
            $_ajax["page"]+="  </tbody>";
            $_ajax["page"]+="</table>";
            $_ajax["page"]+="<div class='col-sm-3'>";
            $_ajax["page"]+="</div>";
            $_ajax["page"]+="</div>";
            $_ajax["page"]+="<div class='row'>";
            $_ajax["page"]+=" <div class='col-sm-12 text-center'>";
            $_ajax["page"]+="   <p><a href='../../shop/' class='btn btn-outline' data-lang='back-to-cart'>Volver a la tienda</a></p>";
            $_ajax["page"]+=" </div>";
            $_ajax["page"]+="</div>";
            $(".data-ajax-page").html($_ajax["page"]);
          }


        }else{
          alert("Ha ocurrido en los datos enviados a nuestro servidor, vuelva a intentarlo más tarde.");

        }
      }
    });

  });
});
