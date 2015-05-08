$(document).ready(function() {
  if(localStorage.logged==1){
    $(".tab-pane.in").toggleClass("in");
    $(".tab-pane.active").toggleClass("active");
    $("#shipping_address").toggleClass("in");
    $("#shipping_address").toggleClass("active");
  }
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

  $("#login-form").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        action: "login",
        session_key: $_session_data["session_key"],
        email: $("#login-form #email").val(),
        password: $("#login-form #password").val()
      },
      error: function(data, textStatus, jqXHR) {
        alert("error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          localStorage.session_key=response.data.session_key;
          localStorage.first_name=response.data.first_name;
          localStorage.last_name=response.data.last_name;
          localStorage.email=response.data.email;
          localStorage.street_1=response.data.street_1;
          localStorage.street_2=response.data.street_2;
          localStorage.city=response.data.city;
          localStorage.zip=response.data.zip;
          localStorage.country=response.data.country;
          localStorage.state=response.data.state;
          localStorage.phone=response.data.phone;
          localStorage.size=response.data.size;
          localStorage.cookies_accepted=response.data.cookies_accepted;
          localStorage.logged=response.data.logged;
          $(".tab-pane.in").toggleClass("in");
          $(".tab-pane.active").toggleClass("active");
          $("#shipping_address").toggleClass("in");
          $("#shipping_address").toggleClass("active");
          check_session();
          scroll_to("top");
        }else{
          //alert("error: "+response.error_code);
        }
      }
    });
  });
});
function validate_shipping_address(){
  $(".tab-pane.in").toggleClass("in");
  $(".tab-pane.active").toggleClass("active");
  $("#shipping_address").toggleClass("in");
  $("#shipping_address").toggleClass("active");
  scroll_to("top");
}
function edit_shipping_address(){
  $(".tab-pane.in").toggleClass("in");
  $(".tab-pane.active").toggleClass("active");
  $("#shipping_address_form").toggleClass("in");
  $("#shipping_address_form").toggleClass("active");
  scroll_to("top");
}
