<?php

  /************************************************************
  * Mergatto
  * Author: Pablo Gutierrez Alfaro <enrealidadeshotmail@gmail.com.com>
  * Creation Modification:
  * Last Modification:
  * licensed through Copyright 2015
  *
  ************************************************************/


  /*********************************************************
  * ACTIONS
  *
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS, DATA CHECK AND INCLUDES
  *********************************************************/

  define('PATH', '../../');
  $timestamp=strtotime(date("Y-m-d H:i:s"));
  include(PATH."include/inbd.php");
  $page_path="WS::Cart";
  debug_log("START");
  $response=array();

  // Data Checks
  //if(!checkClosed()){echo json_encode($response);die();}
  //if(!checkBDConnection()){echo json_encode($response);die();}
  if(!checkAction()){echo json_encode($response);die();}
  // Get Action Data
  getActionData();


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  switch ($action){

    case "add_cart_item":
      // Check Input Data

      $table="cart_items";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $filter["id_product"]=array("operation"=>"=","value"=>$action_data["id_product"]);
      $filter["id_color"]=array("operation"=>"=","value"=>$action_data["id_color"]);
      $filter["size"]=array("operation"=>"=","value"=>$action_data["size"]);
      if(isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="is_in_cart";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }

      $data=array();
      $data["session_key"]=$action_data["session_key"];
      $data["id_product"]=$action_data["id_product"];
      $data["id_color"]=$action_data["id_color"];
      $data["size"]=$action_data["size"];
      $data["quantity"]=$action_data["quantity"];
      addInBD($table,$data);


      break;

    case "update_quantity_cart_item":
      // Check Input Data

      $table="cart_items";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $filter["id_product"]=array("operation"=>"=","value"=>$action_data["id_product"]);
      $filter["id_color"]=array("operation"=>"=","value"=>$action_data["id_color"]);
      $filter["size"]=array("operation"=>"=","value"=>$action_data["size"]);
      $data=array();
      $data["quantity"]=$action_data["quantity"];
      updateInBD($table,$filter,$data);

      break;

    case "delete_cart_item":
      // Check Input Data

      $table="cart_items";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $filter["id_product"]=array("operation"=>"=","value"=>$action_data["id_product"]);
      $filter["id_color"]=array("operation"=>"=","value"=>$action_data["id_color"]);
      $filter["size"]=array("operation"=>"=","value"=>$action_data["size"]);
      deleteInBD($table,$filter);

      break;

    case "list_cart_items":
      // Check Input Data

      $table="cart_items";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="cart_items_list_empty";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();

      }
      $cart_items=listInBD($table,$filter);
      $response["data"]=array();
      $response["data"]["cart_items"]=array();
      $response["data"]["cart_items_count"]=0;
      foreach ($cart_items as $key=>$cart_item){
        $table="products";
        $filter=array();
        $filter["id_product"]=array("operation"=>"=","value"=>$cart_item["id_product"]);
        $cart_item["product"]=getInBD($table,$filter);
        $cart_item["product"]["price_with_discount"]=intval($cart_item["product"]["pvp"]);
        if($cart_item["product"]["use_discount"]==1){
          $cart_item["product"]["price_with_discount"]=intval($cart_item["product"]["pvp"]*(100-$cart_item["product"]["discount"])/100);
        }
        $cart_item["total"]=$cart_item["product"]["price_with_discount"]*$cart_item["quantity"];

        $table="colors";
        $filter=array();
        $filter["id"]=array("operation"=>"=","value"=>$cart_item["id_color"]);
        $cart_item["color"]=getInBD($table,$filter);
        $response["data"]["cart_items_count"]+=$cart_item["quantity"];
        $response["data"]["cart_items"][]=$cart_item;
      }

      $response["data"]["shipping"]=array();
      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $session=getInBD($table,$filter);
      $response["data"]["shipping"]["has_alternatives"]=false;
      if(issetandnotempty($session["country"])){
        $table="shipping";
        $filter=array();
        $filter["country"]=array("operation"=>"=","value"=>$session["country"]);
        if(isInBD($table,$filter)){
          $response["data"]["shipping"]["has_alternatives"]=true;
          $shippings=listInBD($table,$filter);
          $response["data"]["shipping"]["alternatives"]=array();
          foreach ($shippings as $key=>$shipping){
            $tmp=array();
            $tmp["id_shipping"]=$shipping["id"];
            $tmp["shipping_title"]=$shipping["name_es"];
            $tmp["shipping_price"]=$shipping["price_es"];
            $response["data"]["shipping"]["alternatives"][]=$tmp;
          }
        }
      }
      $response["data"]["shipping"]["is_selected"]=false;
      if(issetandnotempty($session["shipping_title"])){
        $response["data"]["shipping"]["is_selected"]=true;
        $response["data"]["shipping"]["selected"]=array();
        $response["data"]["shipping"]["selected"]["shipping_title"]=$session["shipping_title"];
        $response["data"]["shipping"]["selected"]["shipping_price"]=$session["shipping_price"];
      }


      $response["data"]["payment_method"]=array();
      $response["data"]["payment_method"]["has_alternatives"]=true;
      $response["data"]["payment_method"]["alternatives"][1]["id_payment_method"]=1;
      $response["data"]["payment_method"]["alternatives"][1]["payment_method_title"]="PayPal";
      $response["data"]["payment_method"]["alternatives"][1]["payment_method_value"]="paypal";
      $response["data"]["payment_method"]["alternatives"][2]["id_payment_method"]=2;
      $response["data"]["payment_method"]["alternatives"][2]["payment_method_title"]="Tarjeta de Crédito";
      $response["data"]["payment_method"]["alternatives"][2]["payment_method_value"]="credit_card";
      $response["data"]["payment_method"]["alternatives"][3]["id_payment_method"]=3;
      $response["data"]["payment_method"]["alternatives"][3]["payment_method_title"]="Transferencia Bancaria";
      $response["data"]["payment_method"]["alternatives"][3]["payment_method_value"]="bank_transfer";

      $response["data"]["payment_method"]["is_selected"]=false;
      if(issetandnotempty($session["id_payment_method"])){
        $response["data"]["payment_method"]["is_selected"]=true;
        $response["data"]["payment_method"]["selected"]=array();
        $response["data"]["payment_method"]["selected"]["id_payment_method"]=$session["id_payment_method"];
        $response["data"]["payment_method"]["selected"]["payment_method_title"]=$session["payment_method_title"];
        $response["data"]["payment_method"]["selected"]["payment_method_value"]=$session["payment_method_value"];
      }


      break;

    case "list_shipping_methods":

      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $session=getInBD($table,$filter);
      $response["data"]["shipping"]["has_alternatives"]=false;
      if(issetandnotempty($session["country"])){
        $table="shipping";
        $filter=array();
        $filter["country"]=array("operation"=>"=","value"=>$session["country"]);
        if(isInBD($table,$filter)){
          $response["data"]["shipping"]["has_alternatives"]=true;
          $shippings=listInBD($table,$filter);
          $response["data"]["shipping"]["alternatives"]=array();
          foreach ($shippings as $key=>$shipping){
            $tmp=array();
            $tmp["id_shipping"]=$shipping["id"];
            $tmp["shipping_title"]=$shipping["name_es"];
            $tmp["shipping_price"]=$shipping["price_es"];
            $response["data"]["shipping"]["alternatives"][]=$tmp;
          }
        }
      }
      $response["data"]["shipping"]["is_selected"]=false;
      if(issetandnotempty($session["shipping_title"])){
        $response["data"]["shipping"]["is_selected"]=true;
        $response["data"]["shipping"]["selected"]=array();
        $response["data"]["shipping"]["selected"]["shipping_title"]=$session["shipping_title"];
        $response["data"]["shipping"]["selected"]["shipping_price"]=$session["shipping_price"];
      }

      break;

    default:
      notValidAction();echo json_encode($response);die();

  }

  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  debug_log("END");
  echo json_encode($response);
  die();


?>
