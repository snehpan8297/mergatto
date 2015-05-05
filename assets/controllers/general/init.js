include($_PATH+"assets/lang/lang_es.js");

var $_GET_STR="";
var delimiter="";

(function (){
  window.$_GET = [];
  if(location.search){
    var params = decodeURIComponent(location.search).match(/[a-z_]\w*(?:=[^&]*)?/gi);
    if(params){
      var pm, i = 0;
      for(; i < params.length; i++){
        pm = params[i].split('=');
        $_GET[pm[0]] = pm[1] || '';
        $_GET_STR+=delimiter+pm[0]+"||"+pm[1];
        delimiter="//";
      }
    }
  }
})();

var $_ajax = new Array();

check_session();

get_cart();
