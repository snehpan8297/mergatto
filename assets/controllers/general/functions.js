/*********************************************************
* FUNCTION: session_destroy
* DATA:
* DESCRIPTION:
*
*********************************************************/

function session_destroy(){
  localStorage.removeItem('session_key');
}

/*********************************************************
* FUNCTION: logout
* DATA:
* DESCRIPTION:
*
*********************************************************/

function logout(){
  session_destroy();
  window.location.href = $_PATH+"access/login/";
}

/*********************************************************
* FUNCTION: check_session
* DATA:
* url (string) => if not empty goes to this url if true.
* DESCRIPTION:
*
*********************************************************/

function check_session(url){

  if ((typeof localStorage.getItem('session_key') == 'undefined')||(localStorage.getItem('session_key') == null)){
    window.location.href = $_PATH+"access/login/";
  }else{
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: $SERVER_PATH+"server/app/model/access/model.php",
      data: {
        "action":"check_session",
        "session_key":localStorage.getItem('session_key')
      },
      error: function(data, textStatus, jqXHR) {
        window.location.href = $_PATH+"access/login/";
      },
      success: function(response) {
        if(response.result){
          if (!((typeof url == 'undefined')||(url == null))) {
            window.location.href = url;
          }
        }else{
          window.location.href = $_PATH+"access/login/";
        }
      }
    });
  }
}
