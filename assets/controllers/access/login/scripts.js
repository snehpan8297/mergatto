
$(document).ready(function() {

  $("#login-form").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/shop/model/access/model.php",
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
          localStorage.setItem('session_key',response.data.session_key);
          localStorage.setItem('first_name',response.data.first_name);
          localStorage.setItem('second_name',response.data.second_name);
          localStorage.setItem('email',response.data.email);
          localStorage.setItem('street_1',response.data.street_1);
          localStorage.setItem('street_2',response.data.street_2);
          localStorage.setItem('city',response.data.city);
          localStorage.setItem('zip',response.data.zip);
          localStorage.setItem('country',response.data.country);
          localStorage.setItem('state',response.data.state);
          localStorage.setItem('phone',response.data.phone);
          localStorage.setItem('size',response.data.size);
          window.location.href="../home/";
        }else{
          alert("error: "+response.error_code);
        }
      }
    });
  });
  $("#signup-form").submit(function(e){
    e.preventDefault();
    alert("temporalmente deshabilitado");
  });
});
