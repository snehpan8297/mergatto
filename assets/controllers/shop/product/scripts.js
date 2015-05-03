$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/shop/model/categories/model.php",
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
    url: $SERVER_PATH+"server/shop/model/categories/model.php",
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
        alert("[list_families] error: "+response.error_code);
      }
    }
  });
});

$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/shop/model/products/model.php",
    data: {
      action: "get_product",
      id_category: $_GET["id_product"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_products] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $(".data-ajax-product-name").html(response.data.name_es);
        $(".data-ajax-product").html($_ajax["product_"+$_GET["id_product"]]);
      }else{
        alert("[list_products] error: "+response.error_code);
      }
    }
  });
});
