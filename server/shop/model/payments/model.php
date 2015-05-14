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
  $page_path="WS::Payments";
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

    case "get_credit_card_signature":
      // Check Input Data

      $table="order_request";
      $filter=array();
      $filter["id_order"]=array("operation"=>"=","value"=>$action_data["id_order"]);
      $order=getInBD($table,$filter);
      $order["total"]*=100;
      $order["order_code"]="TEST-".$order["id_order"];

      $gateway=array();
      $gateway["code"]="047278643";
      $gateway["currency_tpv"]="978";
      $gateway["transactionType"]="0";
      $gateway["urlMerchant"]="http://www.okycoky.net/new/shop/payments/post_credit_card.php";
      $gateway["password"]="O651R804125P0063";

      $message = $order["total"].$order["order_code"].$gateway["code"].$gateway["currency_tpv"].$gateway["transactionType"].$gateway["urlMerchant"].$action_data["password"];
      $result["data"]=strtoupper(sha1($message));

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
