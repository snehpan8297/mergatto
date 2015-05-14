$(document).ready(function() {
  $("#session_data_loaded").change(function(){
    if($_session_data["payment_method_value"]=="paypal"){

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
            $_ajax["page"]+="<form id='form' name='compra' action='https://sis.sermepa.es/sis/realizarPago' method='post'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Amount value='"+$_order["total"]+"'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Currency value='978'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Order  value='TEST-"+$_order["id_order"]+"'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Titular  value='Oky Coky Shop'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantCode value='047278643'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantName value='ROTELPA, S.A (\'Fashion Retail\')'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_ConsumerLanguage value='001'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_Terminal value='1'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_TransactionType value='0'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantURL value='http://www.okycoky.net/new/server/shop/model/payments/post_credit_card.php'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_UrlOK value='http://www.okycoky.net/new/shop/payments/success/index.html'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_UrlKO value='http://www.okycoky.net/new/shop/payments/error/index.html'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantSignature value='<?php echo $signature; ?>'>";
            $_ajax["page"]+="  <input type=hidden name=Ds_Merchant_MerchantData value='"+$_order["id_order"]+"'>";
            $_ajax["page"]+="</form>";
            $_ajax["page"]+="";
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
      $_ajax["page"]+="       ROTELPA, S.A ('Fashion Retail')";
      $_ajax["page"]+="     </td>";
      $_ajax["page"]+="   </tr>";
      $_ajax["page"]+="   <tr>";
      $_ajax["page"]+="     <td class='text-right'>";
      $_ajax["page"]+="        <b>Concepto</b>";
      $_ajax["page"]+="     </td>";
      $_ajax["page"]+="     <td class='text-left'>";
      $_ajax["page"]+="       Pedido #<span class='data-ajax' data-ajax='id_order'></span>";
      $_ajax["page"]+="     </td>";
      $_ajax["page"]+="   </tr>";
      $_ajax["page"]+="   <tr>";
      $_ajax["page"]+="     <td class='text-right'>";
      $_ajax["page"]+="        <b>Total</b>";
      $_ajax["page"]+="     </td>";
      $_ajax["page"]+="     <td class='text-left'>";
      $_ajax["page"]+="       <span class='data-ajax' data-ajax='order_total'></span>€";
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
  });
});
