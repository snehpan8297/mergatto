
$(document).ready(function() {

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
          window.location.href="../home/";
        }else{
          alert("error: "+response.error_code);
        }
      }
    });
  });
  $("#signup-form").submit(function(e){
    e.preventDefault();
    localStorage.first_name=$("#signup-form #first_name").val();
    localStorage.last_name=$("#signup-form #last_name").val();
    localStorage.email=$("#signup-form #email").val();
    localStorage.password=$("#signup-form #password").val();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $_SERVER_PATH+"server/shop/model/access/model.php",
      data: {
        action: "signup",
        session_key: $_session_data["session_key"],
        first_name: $("#signup-form #first_name").val(),
        last_name: $("#signup-form #last_name").val(),
        email: $("#signup-form #email").val(),
        password: $("#signup-form #password").val()
      },
      error: function(data, textStatus, jqXHR) {
        alert("error: ajax call error");
      },
      success: function(response) {
        if(response.result){
          window.location.href="../welcome/index.html";
        }else{
          alert("error: "+response.error_code);
        }
      }
    });
    alert("temporalmente deshabilitado");
  });
});
