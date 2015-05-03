
$_s = new Array();
$_s["conversation_stages_1"]="Nuevo";
$_s["conversation_stages_2"]="En Proceso";
$_s["conversation_stages_3"]="Cerrado";
$_s["conversation_stages_4"]="Cancelado";

$_styles = new Array();
$_styles["conversation_stages_1"]="badge-warning";
$_styles["conversation_stages_2"]="badge-success";
$_styles["conversation_stages_3"]="badge-info";
$_styles["conversation_stages_4"]="badge-danger";

$_styles["conversation_new_message_0"]="bg-white";
$_styles["conversation_new_message_1"]="bg-white";

$_styles["message_chat_user"]="from-them";
$_styles["message_chat_brand"]="from-me";

$(document).ready(function() {
  $(".data-lang").each(function(){
    $(this).html($_s[$(this).attr("data-lang")]);
  });
});
