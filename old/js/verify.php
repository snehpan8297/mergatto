 <?php
  require_once('../include/recaptchalib.php');
  $privatekey = "6Lcon_ASAAAAAGB6NU8XyuCkEHXXa5zPZOv1WBup";
  error_log( $_SERVER["REMOTE_ADDR"]." ".$_POST["recaptcha_challenge_field"]." ".$_POST["recaptcha_response_field"]);
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
  error_log($resp->is_valid);
  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    $response["result"]=false;
  } else {
    // Your code here to handle a successful verification
    $response["result"]=true;
   }
    echo json_encode($response);
?>