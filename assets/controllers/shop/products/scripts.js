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
      action: "list_products",
      id_category: $_GET["id_category"],
      id_family: $_GET["id_family"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_products] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["product-list"]="<div class='row'>";
        jQuery.each(response.data,function($_key,$_product){
          $_ajax["product-list"]+="<div class='col-sm-3 padding-20'>";
          $_ajax["product-list"]+=" <a href='../../shop/product/index.html?id_product="+$_product.id_product+"&id_category="+$_GET["id_category"]+"'>";
          $_ajax["product-list"]+="   <img src='../../media/shop/photos/"+$_product.serial_model_code+"-1.jpg' class='img-responsive full-width' alt='item'>";
          if($_product.use_discount==1){
            $_ajax["product-list"]+="   <span class='productlist-label'>";
            $_ajax["product-list"]+="     <span class='sale-label'>-"+$_product.discount+"% Descuento</span>";
            $_ajax["product-list"]+="   </span>";
          }
          $_ajax["product-list"]+="   <span class='productlist-price-container'>";
          $_ajax["product-list"]+="     <span class='product-price'>";
          $_ajax["product-list"]+="      <span class='price'>"+$_product.price_with_discount+"€</span>";
          if($_product.use_discount==1){
            $_ajax["product-list"]+="   <span class='original-price'>";
            $_ajax["product-list"]+="     <span class='price'>"+$_product.pvp+"€</span>";
            $_ajax["product-list"]+="   </span>";
          }
          $_ajax["product-list"]+="    </span>";
          $_ajax["product-list"]+="   </span>";
          $_ajax["product-list"]+=" </a>";
          $_ajax["product-list"]+="</div>";

        });
        $_ajax["product-list"]+="</div>";

        $(".data-ajax-product-list").html($_ajax["product-list"]);
      }else{
        alert("[list_products] error: "+response.error_code);
      }
    }
  });
});
