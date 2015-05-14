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
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="id_order_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();

      }
      $order=getInBD($table,$filter);

      $order["gateway_code"]= "0000000000".$order["id_order"];

    	if(strlen($order["gateway_code"])>8){
    		$order["gateway_code"]=substr( $order["gateway_code"], strlen($order["gateway_code"])-7, strlen($order["gateway_code"]));
    	}else{
    		$order["gateway_code"]="";
    		for($i=strlen($order["gateway_code"]);$i<7;$i++){
    			$order["gateway_code"].=0;
    		}
    		$order["gateway_code"].=$action_data["id_order"];
    	}
      $order["gateway_code"]="CL-".$order["payment_attempt"]."-".$order["gateway_code"];

      $order["total_with_discount"]+=intval($order["shipping_method_price"]);
      $order["total_with_discount"]*=100;
      $order["total_with_discount"]=intval($order["total_with_discount"]);

      $gateway=array();
      $gateway["code"]="047278643";
      $gateway["currency_tpv"]="978";
      $gateway["transactionType"]="0";
      $gateway["urlMerchant"]="http://www.okycoky.net/new/server/shop/model/payments/post_credit_card.php";
      $gateway["password"]="O651R804125P0063";


      $message = $order["total_with_discount"].$order["gateway_code"].$gateway["code"].$gateway["currency_tpv"].$gateway["transactionType"].$gateway["urlMerchant"].$gateway["password"];
      $order["signature"]=strtoupper(sha1($message));

      $response["data"]=array();
      $response["data"]["total"]=$order["total_with_discount"];
      $response["data"]["gateway_code"]=$order["gateway_code"];
      $response["data"]["signature"]=$order["signature"];

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
