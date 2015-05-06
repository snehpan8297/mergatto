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
  $page_path="WS::Orders";
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

    case "list_orders":
      // Check Input Data

      $table="clients";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="session_key_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $client=getInBD($table,$filter);

      $table="order_request";
      $filter=array();
      $filter["id_client"]=array("operation"=>"=","value"=>$client["id_client"]);

      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="orders_list_empty";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }

      $orders=listInBD($table,$filter);
      $response["data"]=array();
      foreach ($orders as $key=>$order){
        $response["data"][]=$order;
      }

      break;

    case "get_order":
      // Check Input Data

      $table="clients";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="session_key_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $client=getInBD($table,$filter);

      $table="order_request";
      $filter=array();
      $filter["id_client"]=array("operation"=>"=","value"=>$client["id_client"]);
      $filter["id_order"]=array("operation"=>"=","value"=>$action_data["id_order"]);

      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="order_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $order=getInBD($table,$filter);
      $response["data"]=array();
      $response["data"]=$order;
      $response["data"]["client"]=array();
      $response["data"]["client"]=$client;

      $table="lines_order_request";
      $filter=array();
      $filter["id_order_request"]=array("operation"=>"=","value"=>$action_data["id_order"]);

      $order_lines=listInBD($table,$filter);
      $response["data"]["order_items"]=array();
      foreach ($order_lines as $key=>$order_line){
        $response["data"]["order_items"][]=$order_line;
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
