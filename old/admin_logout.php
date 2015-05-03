<?php
//Lang revisado
@session_start();
unset($_SESSION['admin_classics']);
header("location: ./index.php");
?>