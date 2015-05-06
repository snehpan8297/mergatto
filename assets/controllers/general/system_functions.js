function debug_log($_message){

  if($_CONFIG["debug_mode"]){
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/app/controler/general/controler.php",
      data: {
        "action":"javascript_debug_log",
        "message":$_message
      },
      error: function(data, textStatus, jqXHR) {
      },
      success: function(response) {
      }
    });
    console.error("["+$_PAGE+"] "+$_message);
  }

}

function include($_script) {
  $.ajax({
    url: $_script,
    dataType: "script",
    async: false,
    success: function () {
    },
    error: function () {
    }
  });
}


function time() {
  return Math.floor(new Date()
    .getTime() / 1000);
}
function timestamp_to_date($_timestamp){
  $_date=new Date($_timestamp*1000)
  return $_date.getDate()+" / "+$_date.getMonth()+" / "+$_date.getFullYear();

}
function timestamp_to_str($_timestamp){

  $_from_now = time() - $_timestamp;
  if ($_from_now < 1){
    return '0 seconds';
  }

  $_s["pre_time_str"] = "Hace";
  $_s["post_time_str"] = "";
  $_timestamp_to_str ="Ahora";

  $_d = $_from_now / (60);
  if ($_d >= 1){
    $_timestamp_to_str=$_s["pre_time_str"];
    $_r = Math.round($_d);
    $_timestamp_to_str+=" "+$_r;
    if($_r > 1){
      $_timestamp_to_str+=" segundos";
    }else{
      $_timestamp_to_str+=" segundo";
    }
  }

  $_d = $_from_now / (60*60);
  if ($_d >= 1){
    $_timestamp_to_str=$_s["pre_time_str"];
    $_r = Math.round($_d);
    $_timestamp_to_str+=" "+$_r;
    if($_r > 1){
      $_timestamp_to_str+=" minutos";
    }else{
      $_timestamp_to_str+=" minuto";
    }
  }

  $_d = $_from_now / (24 * 60 * 60);
  if ($_d >= 1){
    $_timestamp_to_str=$_s["pre_time_str"];
    $_r = Math.round($_d);
    $_timestamp_to_str+=" "+$_r;
    if($_r > 1){
      $_timestamp_to_str+=" días";
    }else{
      $_timestamp_to_str+=" día";
    }
  }

  $_d = $_from_now / (30*24*60*60);
  if ($_d >= 1){
    $_timestamp_to_str=$_s["pre_time_str"];
    $_r = Math.round($_d);
    $_timestamp_to_str+=" "+$_r;
    if($_r > 1){
      $_timestamp_to_str+=" meses";
    }else{
      $_timestamp_to_str+=" mes";
    }
  }

  $_d = $_from_now / (365*24*60*60);

  if ($_d >= 1){
    $_timestamp_to_str=$_s["pre_time_str"];
    $_r = Math.round($_d);
    $_timestamp_to_str+=" "+$_r;
    if($_r > 1){
      $_timestamp_to_str+=" años";
    }else{
      $_timestamp_to_str+=" año";
    }
  }

  return $_timestamp_to_str;

}
