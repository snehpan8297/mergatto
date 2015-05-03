<?php
//Lang confirmado
@session_start();
unset($_SESSION['user_classics']);
unset($_SESSION['cart_classics']);
if(isset($_SESSION['mantenimiento'])) {
	unset($_SESSION['mantenimiento']);
}
//@session_destroy();
header("location: ./index.php?action=old");
?>