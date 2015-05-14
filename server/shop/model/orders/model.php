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

      $is_previous_order=false;
      if(@issetandnotempty($action_data["current_id_order"])){
        $table="order_request";
        $filter=array();
        $filter["id_order"]=array("operation"=>"=","value"=>$action_data["current_id_order"]);
        if(isInBD($table,$filter)){
          $is_previous_order=true;
          $order=getInBD($table,$filter);
          $table="lines_order_request";
          $filter=array();
          $filter["id_order_request"]=array("operation"=>"=","value"=>$order["id_order"]);
          if(isInBD($table,$filter)){
            $order_lines=listInBD($table,$filter);
            foreach ($order_lines as $key=>$order_line){
              if($order_line["reserve_stock"]==1){
                $table="stocks";
                $filter=array();
                $filter["id_product"]=array("operation"=>"=","value"=>$order_line["id_product"]);
                $filter["id_color"]=array("operation"=>"=","value"=>$order_line["id_color"]);
                $stock=getInBD($table,$filter);
                $data=array();
                for($i=1;$i<=12;$i++){
                  $data["stock_size_".$i]=$stock["stock_size_".$i]+$order_line["size_".$i];
                }
                updateInBD($table,$filter,$data);
              }
              $table="lines_order_request";
              $filter=array();
              $filter["id_line"]=array("operation"=>"=","value"=>$order_line["id_line"]);
              deleteInBD($table,$filter);
            }
          }
        }
      }
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
      $cart_items=listInBD($table,$filter);



      $table="order_request";
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
      $data["invoice_address_DNI"]=$session["passport"];
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
      $data["shipping_address_DNI"]=$session["passport"];
      $data["shipping_address_address_1"]=$session["street_1"];
      $data["shipping_address_address_2"]=$session["street_2"];
      $data["shipping_address_post_code"]=$session["zip"];
      $data["shipping_address_city"]=$session["city"];
      $data["shipping_address_province"]=$session["state"];
      $data["shipping_address_country"]=$session["country"];
      $data["shipping_address_mobile"]=$session["phone"];

      $data["shipping_method_name"]=$session["shipping_title"];
      $data["shipping_method_price"]=$session["shipping_price"];
      $data["user_type"]=0;
      $data["discount"]=0;
      $data["promo_code"]="";
      $data["promo_code_amount"]=0;
      $data["payment_method"]=$session["payment_method_value"];
      $data["payment_attempt"]=1;
      $data["allow_return"]=0;
      $data["generated_promo"]=0;
      $data["exported"]=0;
      if($is_previous_order){
        $filter=array();
        $filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
        $data["payment_attempt"]=$order["payment_attempt"]+1;
        updateInBD($table,$filter,$data);
      }else{
        $order=array();
        $order["id_order"]=addInBD($table,$data);

      }

      $order["total"]=0;
      $order["total_with_discount"]=0;
      $order["num_clothes"]=0;

      foreach ($cart_items as $key=>$cart_item){
        $table="colors";
        $filter=array();
        $filter["id"]=array("operation"=>"=","value"=>$cart_item["id_color"]);
        $cart_item["color"]=getInBD($table,$filter);
        $table="products";
        $filter=array();
        $filter["id_product"]=array("operation"=>"=","value"=>$cart_item["id_product"]);
        $cart_item["product"]=getInBD($table,$filter);

        $table="lines_order_request";
        $data=array();
        $data["id_order_request"]=$order["id_order"];
        $data["serial_model_code"]=$cart_item["product"]["serial_model_code"];
        $data["id_product"]=$cart_item["product"]["id_product"];
        $data["id_color"]=$cart_item["color"]["id_color"];
        $data["unitary_price"]=$cart_item["product"]["pvp"];
        if($cart_item["product"]["use_discount"]==1){
          $data["unitary_price"]=intval($cart_item["product"]["pvp"]*(100-$cart_item["product"]["discount"])/100);
        }

        $data["subtotal"]=$data["unitary_price"]*$cart_item["quantity"];
        $data["subclothes"]=$cart_item["quantity"];
        for($i=1;$i<=12;$i++){
          $data["size_".$i]=0;
          if($cart_item["size"]==$i){
            $data["size_".$i]=$cart_item["quantity"];
          }

        }
        $data["allsizes"]="34,36,38,40,42,44,46,48,50,52";
        $order_line=array();
        $order_line["id_line"]=addInBD($table,$data);
        $order["total"]+=$data["subtotal"];
        $order["total_with_discount"]+=$data["subtotal"];
        $order["num_clothes"]+=$cart_item["quantity"];

        $table="stocks";
        $filter=array();
        $filter["id_product"]=array("operation"=>"=","value"=>$cart_item["id_product"]);
        $filter["id_color"]=array("operation"=>"=","value"=>$cart_item["id_color"]);
        $stock=getInBD($table,$filter);
        $data=array();
        for($i=1;$i<=12;$i++){
          $data["stock_size_".$i]=$stock["stock_size_".$i];
          if($cart_item["size"]==$i){
            $data["stock_size_".$i]-=$cart_item["quantity"];
          }
        }
        updateInBD($table,$filter,$data);

        $table="lines_order_request";
        $filter=array();
        $filter["id_line"]=array("operation"=>"=","value"=>$order_line["id_line"]);
        $data=array();
        $data["reserve_stock"]=1;
        updateInBD($table,$filter,$data);
      }


      $table="order_request";
      $filter=array();
      $filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
      $data=array();
      $data["total"]=$order["total"];
      $data["total_with_discount"]=$order["total_with_discount"];
      $data["num_clothes"]=$order["num_clothes"];
      $data["reserve_stock"]=1;
      $data["order_key"]=sha1("order".$order["id_order"].$timestamp);
      updateInBD($table,$filter,$data);

      $response["data"]=array();
      $response["data"]["id_order"]=$order["id_order"];
      $response["data"]["total_with_discount"]=$order["total_with_discount"]+intval($order["shipping_method_price"]);

      $table="sessions";
      $filter=array();
      $filter["session_key"]=array("operation"=>"=","value"=>$action_data["session_key"]);
      $data=array();
      $data["current_id_order"]=$order["id_order"];
      updateInBD($table,$filter,$data);

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
