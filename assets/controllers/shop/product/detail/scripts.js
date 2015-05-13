$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/categories/model.php",
    data: {
      action: "list_categories"
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_categories] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["categories-list"]="";
        jQuery.each(response.data,function($_key,$_category){
          $_ajax["categories-list"]+="<li><a href='../../shop/products/index.html?id_category="+$_category.id_category+"'><span>"+$_category.name_es+"</span></a></li>";
        });
        $(".data-ajax-categories-list").html($_ajax["categories-list"]);
      }else{
        alert("[list_categories] error: "+response.error_code);
      }
    }
  });
});
$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/categories/model.php",
    data: {
      action: "list_families",
      id_category: $_GET["id_category"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_families] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["families-list"]="";
        $_ajax["families-list"]+="<li><a href='../../shop/products/index.html?id_category="+$_GET["id_category"]+"'><span>Todos</span></a></li>";
        jQuery.each(response.data,function($_key,$_family){
          $_ajax["families-list"]+="<li><a href='../../shop/products/index.html?id_category="+$_family.id_category+"&id_family="+$_family.id_family+"'><span>"+$_family.name+"</span></a></li>";

        });
        $(".data-ajax-families-list").html($_ajax["families-list"]);
      }else{
        //alert("[list_families] error: "+response.error_code);
      }
    }
  });
});
$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $_SERVER_PATH+"server/shop/model/categories/model.php",
    data: {
      action: "get_category",
      id_category: $_GET["id_category"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[get_category] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["category-name"]=response.data.name_es;
        $(".data-ajax-category-name").html($_ajax["category-name"]);
      }else{
        //alert("[list_families] error: "+response.error_code);
      }
    }
  });
});
$(document).ready(function() {

  $_ajax["product-image"]="<img src='../../../media/shop/photos/"+$_GET["serial_model_code"]+"-"+$_GET["index"]+".jpg' style='max-width:100%;'/>";
  $(".data-ajax-product-image").html($_ajax["product-image"]);
  $_ajax["back-button"]="<a href='../../../shop/product/index.html?id_product="+$_GET["id_product"]+"&id_category="+$_GET["id_category"]+"&id_family="+$_GET["id_family"]+"' class='btn btn-outline margin-0' data-lang='back'>Volver</a>";
  $(".data-ajax-back-button").html($_ajax["back-button"]);
});
