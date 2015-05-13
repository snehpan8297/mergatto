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
  $page_path="WS::Access";
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

    case "login":
      // Check Input Data

      $table="clients";
      $filter=array();
      $filter["email"]=array("operation"=>"=","value"=>$action_data["email"]);
      $filter["password"]=array("operation"=>"=","value"=>md5($action_data["password"]));
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="user_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $client=getInBD($table,$filter);
      $table="clients";
      $filter=array();
      $filter["email"]=array("operation"=>"=","value"=>$action_data["email"]);
      $data=array();
      $data["session_key"]=$action_data["session_key"];
      $data["last_login"]=$timestamp;
      updateInBD($table,$filter,$data);

      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $data=array();
      $data["first_name"]=$client["name"];
      $data["last_name"]=$client["subname"];
      $data["email"]=$client["email"];
      $data["passport"]=$client["DNI"];
      $data["street_1"]=$client["address_1"];
      $data["street_2"]=$client["address_2"];
      $data["city"]=$client["city"];
      $data["zip"]=$client["post_code"];
      $data["country"]=$client["country"];
      $data["state"]=$client["province"];
      $data["phone"]=$client["mobile"];
      $data["size"]=$client["size"];
      $data["last_activity"]=$timestamp;
      $data["logged"]=1;
      $data["id_client"]=$client["id_client"];
      updateInBD($table,$filter,$data);
      $session=getInBD($table,$filter);

      $response["data"]=array();
      $response["data"]=$session;



      break;

    case "add_session":
      // Check Input Data

      $ip="anonymous";

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
        $ip=$_SERVER['REMOTE_ADDR'];
      }

      $table="sessions";
      $data=array();
      $data["created"]=$timestamp;
      $data["ip"]=$ip;
      $id_session=addInBD($table,$data);
      $filter=array();
      $filter["id_session"]=array("operation"=>"=","value"=>$id_session);
      $data=array();
      $data["session_key"]=sha1($ip.$timestamp.$id_session);
      updateInBD($table,$filter,$data);

      $response["data"]=array();
      $response["data"]["session_key"]=$data["session_key"];


      break;

    case "get_session":
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
      $data=array();
      $data["last_activity"]=$timestamp;
      updateInBD($table,$filter,$data);

      $response["data"]=array();
      $response["data"]=$session;


      break;
    case "update_session":
      // Check Input Data

      if($action_data["index"]=="id_shipping"){
        $table="shipping";
        $filter=array();
        $filter["id"]=array("operation"=>"=","value"=>$action_data["value"]);
        $shipping=getInBD($table,$filter);
      }
      if($action_data["index"]=="id_payment_method"){
        $payments=array();
        $payments[1]["id_payment_method"]=1;
        $payments[1]["payment_method_title"]="PayPal";
        $payments[1]["payment_method_value"]="paypal";
        $payments[2]["id_payment_method"]=2;
        $payments[2]["payment_method_title"]="Tarjeta de Crédito";
        $payments[2]["payment_method_value"]="credit_card";
        $payments[3]["id_payment_method"]=3;
        $payments[3]["payment_method_title"]="Transferencia Bancaria";
        $payments[3]["payment_method_value"]="bank_transfer";

        $payment=$payments[$action_data["value"]];
      }

      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $data=array();
      $data[$action_data["index"]]=$action_data["value"];
      if($action_data["index"]=="id_shipping"){
        $data["shipping_title"]=$shipping["name_es"];
        $data["shipping_price"]=intval($shipping["price_es"]);
      }
      if($action_data["index"]=="id_payment_method"){
        $data["payment_method_title"]=$payment["payment_method_title"];
        $data["payment_method_value"]=$payment["payment_method_value"];
      }
      $data["last_activity"]=$timestamp;
      updateInBD($table,$filter,$data);

      $session=getInBD($table,$filter);

      if($session["logged"]==1){
        $table="clients";
        $filter=array();
        $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
        switch ($action_data["index"]){
          case "first_name":
            $data=array();
            $data["name"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "last_name":
            $data=array();
            $data["subname"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "passport":
            $data=array();
            $data["DNI"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "street_1":
            $data=array();
            $data["address_1"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "street_2":
            $data=array();
            $data["address_2"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "city":
            $data=array();
            $data["city"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "zip":
            $data=array();
            $data["post_code"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "state":
            $data=array();
            $data["province"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "country":
            $data=array();
            $data["country"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "phone":
            $data=array();
            $data["mobile"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          case "size":
            $data=array();
            $data["size"]=$action_data["value"];
            updateInBD($table,$filter,$data);
            break;

          default:

        }

      }

      $response["data"]=array();
      $response["data"]=$session;
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
