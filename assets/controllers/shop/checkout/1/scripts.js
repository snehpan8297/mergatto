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
          $_ajax["categories-list"]+="<li><a href='../../../shop/products/index.html?id_category="+$_category.id_category+"'><span>"+$_category.name_es+"</span></a></li>";
        });
        $(".data-ajax-categories-list").html($_ajax["categories-list"]);
      }else{
        alert("[list_categories] error: "+response.error_code);
      }
    }
  });
});
