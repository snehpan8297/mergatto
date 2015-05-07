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
    url: $_SERVER_PATH+"server/shop/model/products/model.php",
    data: {
      action: "get_product",
      id_product: $_GET["id_product"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("[list_products] error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $(".data-ajax-product-name").html(response.data.name_es);
        $(".data-ajax-product-serial").html("Ref.:"+response.data.serial_model_code);

        $_ajax["product-price"]="";
        if(response.data.use_discount==1){
          $_ajax["product-price"]="<span class='price'>"+response.data.price_with_discount+"€</span><span class='original-price'>"+response.data.pvp+"€</span>";
        }else{
          $_ajax["product-price"]="<span class='price'>"+response.data.price_with_discount+"€</span>";
        }
        $(".data-ajax-product-price").html($_ajax["product-price"]);

        $_ajax["product-mark"]="";
        if(response.data.use_discount==1){
          $_ajax["product-mark"]="<span class='sale-label'>-"+response.data.discount+"% Descuento</span>";
        }
        $(".data-ajax-product-mark").html($_ajax["product-mark"]);

        $_ajax["product-images"]="";
        jQuery.each(response.data.images,function($_key,$_image){
          $_ajax["product-images"]+="<img src='../../media/shop/photos/"+response.data.serial_model_code+"-"+$_image.index+".jpg' class='product-img img-responsive full-width' alt='item'>";
        });

        $(".data-ajax-product-images").html($_ajax["product-images"]);

        $_ajax["product-colors"]="";
        $_ajax["product-sizes"]="";
        jQuery.each(response.data.colors,function($_key,$_color){
          $_ajax["product-colors"]+="<option value='"+$_color.id+"'>"+$_color.name_es+"</option>";
          $_ajax["product-sizes"]+="<select class='form-control hidden product-sizes' id='product-sizes-"+$_color.id+"'>";
          if($_color.stock_size_1>0){$_ajax["product-sizes"]+="  <option value='1'>34</option>";}
          if($_color.stock_size_2>0){$_ajax["product-sizes"]+="  <option value='2'>36</option>";}
          if($_color.stock_size_3>0){$_ajax["product-sizes"]+="  <option value='3'>38</option>";}
          if($_color.stock_size_4>0){$_ajax["product-sizes"]+="  <option value='4'>40</option>";}
          if($_color.stock_size_5>0){$_ajax["product-sizes"]+="  <option value='5'>42</option>";}
          if($_color.stock_size_6>0){$_ajax["product-sizes"]+="  <option value='6'>44</option>";}
          if($_color.stock_size_7>0){$_ajax["product-sizes"]+="  <option value='7'>46</option>";}
          if($_color.stock_size_8>0){$_ajax["product-sizes"]+="  <option value='8'>48</option>";}
          if($_color.stock_size_9>0){$_ajax["product-sizes"]+="  <option value='9'>50</option>";}
          if($_color.stock_size_10>0){$_ajax["product-sizes"]+="  <option value='10'>52</option>";}
          $_ajax["product-sizes"]+="</select>";

        });
        $_ajax["product-colors"]+="</select>";
        $(".data-ajax-product-colors").html($_ajax["product-colors"]);
        $(".data-ajax-product-sizes").html($_ajax["product-sizes"]);
        $_color_selected=$(".data-ajax-product-colors select").val();
        $("#product-sizes-"+$_color_selected).removeClass("hidden");
        $("#product-color").change(function(){
          $_color_selected=$("#product-color").val();
          $(".product-sizes").addClass("hidden");
          $("#product-sizes-"+$_color_selected).removeClass("hidden");
        });


        $("#add-to-cart").click(function(){
          add_to_cart($_GET["id_product"],$("#product-color").val(),$("#product-sizes-"+$_color_selected).val(),1);
        });
        $("#add-product-request").click(function(){
          $.ajax({
            type: "POST",
            dataType: 'json',
            url: $_SERVER_PATH+"server/shop/model/products/model.php",
            data: {
              action: "add_product_request",
              id_product: $_GET["id_product"],
              id_color: $("#product-request-form #product-request-id-color").val(),
              size: $("#product-request-form #product-request-size").val(),
              email: $("#product-request-form #product-request-email").val()
            },
            error: function(data, textStatus, jqXHR) {
              alert("[list_categories] error: ajax call error");
              $("#product-request-form").toggleClass("hidden");
              $("#product-request-form-error").toggleClass("hidden");
              scroll_to("product-request");
            },
            success: function(response) {
              if(response.result){
                $("#product-request-form").toggleClass("hidden");
                $("#product-request-form-success").toggleClass("hidden");
                scroll_to("product-request");
              }else{
                $("#product-request-form").toggleClass("hidden");
                $("#product-request-form-error").toggleClass("hidden");
                scroll_to("product-request");
              }
            }
          });
        });

      }else{
        alert("[list_products] error: "+response.error_code);
      }
    }
  });
});
