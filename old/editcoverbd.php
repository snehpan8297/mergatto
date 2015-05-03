<?php
//Lang revisado

@session_start();
include("./functions/get_lang.php");
include("./include/includes.php");

if(isset($_POST["foto"])){
	
    if ($_POST["foto"]=="-5") {
        copy("./tmp/grande.jpg", "./resources/welcome/".$_POST["lang"].".jpg");   
    }
	echo "OK";
}

?>