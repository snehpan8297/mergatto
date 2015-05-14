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

if($_PAGE=="/shop/products/"){
  localStorage.last_product_list="shop/";
  if (!((typeof $_GET["id_category"] == 'undefined')||($_GET["id_category"] == null)||($_GET["id_category"] == "null"))){
    localStorage.last_product_list+="products/index.html?id_category="+$_GET["id_category"];
  }
  if (!((typeof $_GET["id_family"] == 'undefined')||($_GET["id_family"] == null)||($_GET["id_family"] == "null"))){
    localStorage.last_product_list+="&id_family="+$_GET["id_family"];
  }
}
if ((typeof localStorage.last_product_list == 'undefined')||(localStorage.last_product_list == null)||(localStorage.last_product_list == "null")){
  localStorage.last_product_list="shop/";
}

$(".data-ajax-back-to-last-product-list").attr("href",$_PATH+localStorage.last_product_list);

$('#stiky_scroll').affix({
      offset: {
        top: 200
      }
});

$(document).ready(function() {
  setTimeout(function(){
    $("[input-type=password]").each(function(){
      $(this).attr("type","password");
    });
  },1);
});
