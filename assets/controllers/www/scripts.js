
$(document).ready(function() {
 $("#tab_"+$_GET["title"]).addClass("active");
});

$(document).ready(function() {
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/shop/model/pages/model.php",
    data: {
      action: "get_page",
      page: $_GET["title"]
    },
    error: function(data, textStatus, jqXHR) {
      alert("error: ajax call error");
    },
    success: function(response) {
      if(response.result){
        $_ajax["page"]=response.data.content;
        $(".data-ajax-page").html($_ajax["page"]);
      }else{
        alert("error: "+response.error_code);
      }
    }
  });
});
