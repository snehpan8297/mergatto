$(document).ready(function() {
  $("#session_data_loaded").change(function(){
    if($_session_data["payment_method_value"]=="paypal"){

    }else if($_session_data["payment_method_value"]=="credit_card"){

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
