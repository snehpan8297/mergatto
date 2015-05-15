
/*********************************************************
* FUNCTION: logout
* DATA:
* DESCRIPTION:
*   Destruye las variables del sistema y cierra la
*   sesión del usuario
*
*********************************************************/

function show_notification($_type,$_message,$_permanent){
  $_notificaton="";
  $_notificaton+="";
  $_notificaton+="<div class='main-nav-alert'>";
  $_notificaton+="  <div class='container-fluid'>";
  $_notificaton+="    <div class='row'>";
  $_notificaton+="      <div class='col-xs-12 text-right alert alert-"+$_type+"'>";
  $_notificaton+="        <div class='alert-content'>";
  $_notificaton+="          "+$_message+"<a href='javascript:hidde_notification()' class='text-"+$_type+" m-l-10'><i class='fa fa-times'></i></a>";
  $_notificaton+="        </div>";
  $_notificaton+="      </div>";
  $_notificaton+="    </div>";
  $_notificaton+="  </div>";
  $_notificaton+="</div>";

  $('body').append($_notificaton);
  if(!$_permanent){
    $('.main-nav-alert').fadeIn().delay(2500).fadeOut('slow',function(){
      $(this).remove();
    });
  }else{
    $('.main-nav-alert').fadeIn();
  }
}

function hidde_notification($_type,$_message){
  $('.main-nav-alert').fadeOut('slow',function(){
    $(this).remove();
  });
}

function show_mobile_notification($_notification_id){
  $(".mobile-notification").fadeOut();
  $("#"+$_notification_id).fadeIn();
  $("#main-page-block").fadeOut();

}
function hidde_mobile_notification($_,$_message){
  $(".mobile-notification").fadeOut();
  $("#main-page-block").fadeIn();
}
function scroll_to($_a_name){
  var aTag = $("a[name='"+$_a_name+"']");
  $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}
