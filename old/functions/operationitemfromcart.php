<?php
//Lang confirm
	@session_start();
	if($_POST["action"]=="increase"){
		$_SESSION['cart_classics'][$_POST["index"]]["sizes"][$_POST["element"]] +=1;
		echo "OK";
	}else if($_POST["action"]=="decrease"){
		$_SESSION['cart_classics'][$_POST["index"]]["sizes"][$_POST["element"]] -=1;
		echo "OK";
	}
?>