
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
function scroll_to($_a_name){
  var aTag = $("a[name='"+$_a_name+"']");
  $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}
