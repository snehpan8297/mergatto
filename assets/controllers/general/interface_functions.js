
/*********************************************************
* FUNCTION: logout
* DATA:
* DESCRIPTION:
*   Destruye las variables del sistema y cierra la
*   sesión del usuario
*
*********************************************************/

function show_notification($_type,$_message){
  $('body').pgNotification({
      style: 'bar',
      message: $_message,
      position: "top",
      timeout: 3000,
      type: $_type
  }).show();
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
