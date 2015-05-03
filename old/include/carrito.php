<?php
/************************************************************************
 *		Libreria de funciones para manejo de carro de la compra
 *		Modificado: 09/03/2012 2:51
 ************************************************************************/

/*
 * Funcion mete un item al carrito
 * Parametros:
 *		$item: datos del elemento
 * Salidas:
 */
function addItem($item) {
	if(!empty($item["serial_model_code"])) {
		if(!isset($_SESSION['cart_classics'])) {
			$_SESSION['cart_classics'] = array();
			$a[$item["serial_model_code"].$item["id_color"]] = $item;
			$a[$item["serial_model_code"].$item["id_color"]]["stockout"]=0;
			$_SESSION['cart_classics'] = $a;
		} else {
			$a = $_SESSION['cart_classics'];
			$masuno = 0;
			if(isset($a[$item["serial_model_code"].$item["id_color"]])) {
				foreach ($a[$item["serial_model_code"].$item["id_color"]]["sizes"] as $key=>$value) {
					$a[$item["serial_model_code"].$item["id_color"]]["sizes"][$key] += $item["sizes"][$key];
				}
				$masuno = 1;
			}
			if(!$masuno) {
				$a[$item["serial_model_code"].$item["id_color"]] = $item;
			}
			$a[$item["serial_model_code"].$item["id_color"]]["stockout"]=0;
			$_SESSION['cart_classics'] = $a;
		}
	}
}

function addItem_n($item) {
	if(!empty($item["id_product"])) {
		if(!isset($_SESSION['cart_classics'])) {
			$_SESSION['cart_classics'] = array();
			$a[$item["id_product"].$item["id_color"]] = $item;
			$a[$item["id_product"].$item["id_color"]]["stockout"]=0;
			$_SESSION['cart_classics'] = $a;
		} else {
			$a = $_SESSION['cart_classics'];
			$masuno = 0;
			if(isset($a[$item["id_product"].$item["id_color"]])) {
				foreach ($a[$item["id_product"].$item["id_color"]]["sizes"] as $key=>$value) {
					$a[$item["id_product"].$item["id_color"]]["sizes"][$key] += $item["sizes"][$key];
				}
				$masuno = 1;
			}
			if(!$masuno) {
				$a[$item["id_product"].$item["id_color"]] = $item;
			}
			$a[$item["id_product"].$item["id_color"]]["stockout"]=0;
			$_SESSION['cart_classics'] = $a;
		}
	}
}

/*
 * Funcion quita un item del carrito
 * Parametros:
 *		$item: datos del elemento
 * Salidas:
 */
function removeItem($item) {
	if(!empty($item["serial_model_code"])) {
		$cesta = $_SESSION['cart_classics'];
		unset($cesta[$item["serial_model_code"].$item["id_color"]]);
		$_SESSION['cart_classics'] = array_merge($cesta);
		unset($cesta);
	}
}

/*
 * Funcion que vacia el carrito
 * Parametros:
 * Salidas:
 */
function emptyCart() {
	unset($_SESSION['cart_classics']);
}
?>