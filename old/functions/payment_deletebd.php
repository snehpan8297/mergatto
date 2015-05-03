<?php
@session_start();
if(!(isset($_SESSION['admin_classics']))) {
    header("location:../admin.php");
}
include("../include/payments.php");
if(isset($_POST["id_payment"])) {
	if(deletePayment($_POST["id_payment"])) {
		echo "OK";
	} else {
		echo "NoOK";
	}
}
?>