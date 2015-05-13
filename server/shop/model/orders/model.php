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

    case "add_order":
      // Check Input Data

      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="session_key_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $session=getInBD($table,$filter);

      $table="cart_items";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="cart_empty";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $cart_items=getInBD($table,$filter);



      $table="order_requests";
      $data=array();
      $data["id_client"]=$session["id_client"];
      $data["date"]=$timestamp;
      $data["payed"]=0;
      $data["order_state"]=0;
      $data["user_comment"]="";
      $data["order_comment"]="";

      $data["invoice_address_name"]=$session["first_name"];
      $data["invoice_address_subname"]=$session["last_name"];
      $data["invoice_address_email"]=$session["email"];
      $data["invoice_address_DNI"]=$session["country_id"];
      $data["invoice_address_address_1"]=$session["street_1"];
      $data["invoice_address_address_2"]=$session["street_2"];
      $data["invoice_address_post_code"]=$session["zip"];
      $data["invoice_address_city"]=$session["city"];
      $data["invoice_address_province"]=$session["state"];
      $data["invoice_address_country"]=$session["country"];
      $data["invoice_address_mobile"]=$session["phone"];

      $data["shipping_address_name"]=$session["first_name"];
      $data["shipping_address_subname"]=$session["last_name"];
      $data["shipping_address_email"]=$session["email"];
      $data["shipping_address_DNI"]=$session["country_id"];
      $data["shipping_address_address_1"]=$session["street_1"];
      $data["shipping_address_address_2"]=$session["street_2"];
      $data["shipping_address_post_code"]=$session["zip"];
      $data["shipping_address_city"]=$session["city"];
      $data["shipping_address_province"]=$session["state"];
      $data["shipping_address_country"]=$session["country"];
      $data["shipping_address_mobile"]=$session["phone"];

      $data["shipping_method_name"]=$session["shipping"];
      $data["shipping_method_price"]=$session["shipping_price"];
      $data["user_type"]=0;
      $data["discount"]=0;
      $data["promo_code"]="";
      $data["promo_code_amount"]=0;
      $data["payment_method"]="no";
      $data["allow_return"]=0;
      $data["generated_promo"]=0;
      $data["exported"]=0;
      addInBD($table,$data);

      $table="order_requests";
      $data=array();
      $data["total"]=;
      $data["total_with_discount"]=;
      $data["num_clothes"]=;

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
