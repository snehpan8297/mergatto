<?php
@session_start();
include_once ("./include/users.php");
include_once ("./include/products.php");
include ("./include/bdOC.php");
include ('./include/front_settings.php');

if (sizeof($_SESSION["cart"]) > 0) {
    $nitems = sizeof($_SESSION["cart"]);
    //Datos de usuario
    $user["id_client"] = $_SESSION['user']['id_client'];
    $userdata = userData($user);

    $currency["name"] = "Euro";
    $currency["symbol"] = "€";
    $currency["exchange"] = 1;

    //Calculo del total
    $total_amount = 0;
    $total_num = 0;

    //Sacado de la Cookie
    $icart = 0;
    foreach ($_SESSION["cart"] as $key => $cartitem) {
        //datos da cookie;
        $cart[$icart]["key"] = $key;
        $cart[$icart]["serial_model_code"] = $cartitem["serial_model_code"];
        $cart[$icart]["id_color"] = $cartitem["id_color"];
        $cart[$icart]["elements"] = $cartitem["sizes"];

        //datos doproducto;
        $productdata = productDataFromSerialModel($cartitem["serial_model_code"]);
        $cart[$icart]["name"] = $productdata["name"];
        $cart[$icart]["id_product"] = $productdata["id_product"];
        $cart[$icart]["id_family"] = $productdata["id_family"];
        $sizes = productSizes($productdata["id_sizing"]);
        array_shift($sizes);
        $cart[$icart]["sizes"] = $sizes;
        //$cart[$icart]["sizes"]=array_shift($cart[$icart]["sizes"]);
        $cart[$icart]["name_color"] = getColorName($cartitem["id_color"]);
        for ($i = 1; $i <= 12; $i++)
            $cart[$icart]["pvps"] = $productdata["pvp"];
        $rimages = productImages($productdata["id_product"]);
        $images = db_fetch($rimages);
        $cart[$icart]["image"] = $images["id_image"];

        $cart[$icart]["subtotal_amount"] = 0;
        $cart[$icart]["subtotal_num"] = 0;
        for ($i = 0; $i < sizeof($cart[$icart]["elements"]); $i++) {
            $cart[$icart]["subtotal_amount"] += ($cart[$icart]["elements"][$i] * $cart[$icart]["pvps"]);
            $cart[$icart]["subtotal_num"] += $cart[$icart]["elements"][$i];
        }
        $cart[$icart]["subtotal_amount"] *= $currency["exchange"];

        //Calculo Total
        $total_amount += $cart[$icart]["subtotal_amount"];
        $total_num += $cart[$icart]["subtotal_num"];
        $icart++;

        error_log("TEST 1000 >>>>>> ".$total_amount);

    }
    $temporad = getTemporada($cart[0]["serial_model_code"]);
    $temporada = $temporad[1];
    //$nextnumber = getNextNumber($temporad[1]);
    $nextnumber++;
    $parsventa = getSellTypes($user["code"]);
    $taxes=getSellTaxes($parsventa["iva"]);
    $iva=$total_amount*$taxes["iva"];
    $req=$total_amount*$taxes["req"];
    $total=$total_amount+$req+$iva;

    error_log("TEST 1000 >>>>>> ".$total);


    $propuesta = array("ID_PROPUESTA" => 0, "ID_LINEA" => 1, "CODCLI" => $user["id_client"]);
    $propuesta["total"] = $total;
    $propuesta["subtotal"] = $total_amount;
    $propuesta["comments"]=$_POST["comments"];
    $propuesta["iva"] = $iva;
    $propuesta["req"] = $req;
    $propuesta["products"] = $total_num;
    $propuesta["tipo"] = $temporad[0]. "OK";
    //$maxlins = aumentaContadorProp();
    //$lineprops = $maxlins[1] - sizeof($cart) + 1;

    //$countlines[$key]["propuesta"]=$propuesta;
    $propuesta["ID_PROPUESTA"]=creaPropPed($propuesta);

    $datoslinea = array("ID_TIPO_IVA" => $parsventa["iva"], "ID_PROPUESTA" => $propuesta["ID_PROPUESTA"]);
    foreach ($cart as $keytest => $indicecarrito) {
        //$lineprops = aumentaContadorLinProp();
        $linea = getProductLinea($indicecarrito["serial_model_code"]);
        $datoslinea["ID_LINEA_PROPUESTA"] = $lineprops;
        $datoslinea["CANTIDAD_LINEA"] = $indicecarrito["subtotal_num"];
        $datoslinea["COD_SERIE_MODELO"] = $indicecarrito["serial_model_code"];
        $datoslinea["PRECIO"] = $indicecarrito["pvps"];
        $datoslinea["ID_COLOR_PROD"] = $indicecarrito["id_color"];
        $datoslinea["indicecarrito"] = $indicecarrito;
        for ($w = 0; $w < 12; $w++) {
            $datoslinea["TALLA_" . ($w + 1)] = $indicecarrito["elements"][$w];
        }
        //print_r($datoslinea);
        addLinePropPed($datoslinea);
    }

    //***********************************************************************************
    /*
    $lineas[$linea][] = $icart;

    //print_r($parsventa);
    foreach ($lineas as $key => $value) {
        $tot_amount_line = 0;
        $tot_count_line = 0;
        $item = array();
        foreach ($value as $key2 => $icarti) {
            $tot_amount_line += $cart[$icarti]["subtotal_amount"];
            $tot_count_line += $cart[$icarti]["subtotal_num"];
            $item[] = $icarti;
        }

        $countlines[$key] = array("tipoiva" => $parsventa["iva"], "subtotal" => $tot_amount_line, "total" => $total, "iva" => $iva, "req" => $req, "products" => $tot_count_line, "items" => $item);
    }
    //print_r($countlines);
    $propuesta = array("ID_PROPUESTA" => 0, "ID_LINEA" => $key, "CODCLI" => $user["code"]);
    foreach ($countlines as $key => $lineprop) {
        $propuesta["total"] = $lineprop["total"];
        $propuesta["subtotal"] = $lineprop["subtotal"];
        $propuesta["iva"] = $lineprop["iva"];
        $propuesta["req"] = $lineprop["req"];
        $propuesta["products"] = $lineprop["products"];
        $propuesta["tipo"] = $temporada . "OK";
        $propuesta["numbers"] = $nextnumber;
        $nitemslin = sizeof($lineprop["items"]);
        $maxlins = aumentaContadores(sizeof($lineprop["items"]));
        $propuesta["ID_PROPUESTA"] = $maxlins[0];
        $lineprops = $maxlins[1] - sizeof($lineprop["items"]) + 1;
        //print_r($propuesta);
        $countlines[$key]["propuesta"] = $propuesta;
        creaPropPed($propuesta);
        $datoslinea = array("ID_TIPO_IVA" => $parsventa["iva"], "ID_PROPUESTA" => $maxlins[0]);

        $nextnumber++;
    }
    print_r($countlines);
     *
     */


    include("./functions/email_order_request.php");

    unset($_SESSION["cart"]);
    echo "OK";
} else
    echo "NOK|noitems";
?>
