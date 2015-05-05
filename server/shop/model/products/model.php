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
  $page_path="WS::Products";
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

    case "list_products":
      // Check Input Data

      if(!isset($action_data["id_category"])){
        $action_data["id_category"]=0;
      }
      //Temporal Code
      $id_user_groups=array();
      $id_user_groups[]=0;

      $table="categories";
      $filter=array();
      $filter["type"]=array("operation"=>"=","value"=>"normal");
      $filter["show_in_menu"]=array("operation"=>"=","value"=>1);
      $filter["id_category"]=array("operation"=>"=","value"=>$action_data["id_category"]);

      $filter["complex"]="";
      $or="";
      foreach ($id_user_groups as $key=>$id_user_group){
        $filter["complex"].=$or."id_client_group = ".$id_user_group;
        $or=" OR ";
      }
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="category_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $table="product_categories";
      $filter=array();
      $filter["id_category"]=array("operation"=>"=","value"=>$action_data["id_category"]);
      $product_categories=listInBD($table,$filter);
      $response["data"]=array();
      $list_empty=true;
      $list_families=array();
      foreach ($product_categories as $key=>$product_category){
        $table="products";
        $filter=array();
        $filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
        $filter["visible"]=array("operation"=>"=","value"=>1);
        if(isset($action_data["id_family"])){
          $filter["id_family"]=array("operation"=>"=","value"=>$action_data["id_family"]);
        }
        if(isInBD($table,$filter)){
          $table="colors";
          $filter=array();
          $filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
          $filter["use_color"]=array("operation"=>"=","value"=>1);
          if(isInBD($table,$filter)){
            $colors=listInBD($table,$filter);
            $table="stocks";
            $filter=array();
            $filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
            $filter["complex"]="(false";
            $or=" or ";
            foreach ($colors as $key=>$color){
              $filter["complex"].=$or."id_color = ".$color["id"];
            }
            $filter["complex"].=") and (false";
            $or=" or ";
            for($i=1;$i<=12;$i++){
              $filter["complex"].=$or."stock_size_".$i." > 0";
            }
            $filter["complex"].=")";

            if(isInBD($table,$filter)){
              $table="products";
              $filter=array();
              $filter["id_product"]=array("operation"=>"=","value"=>$product_category["id_product"]);
              $product=getInBD($table,$filter);
              $product["price_with_discount"]=intval($product["pvp"]);
              if($product["use_discount"]==1){
                $product["price_with_discount"]=intval($product["pvp"]*(100-$product["discount"])/100);
              }
              $product["price_with_discount"]=$product["price_with_discount"];
              $response["data"][]=$product;

              $list_empty=false;
            }
          }
        }



      }
      if($list_empty){
        $response["result"]=false;
        $response["error_code"]="list_empty";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }

      break;

    case "get_product":
      // Check Input Data



      $table="products";
      $filter=array();
      $filter["id_product"]=array("operation"=>"=","value"=>$action_data["id_product"]);
      $filter["visible"]=array("operation"=>"=","value"=>1);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="product_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $product=getInBD($table,$filter);
      $product["price_with_discount"]=intval($product["pvp"]);
      if($product["use_discount"]==1){
        $product["price_with_discount"]=intval($product["pvp"]*(100-$product["discount"])/100);
      }
      $product["colors"]=array();

      $table="stocks";
      $filter=array();
      $filter["id_product"]=array("operation"=>"=","value"=>$product["id_product"]);
      $filter["complex"]="false";
      $or=" or ";
      for($i=1;$i<=12;$i++){
        $filter["complex"].=$or."stock_size_".$i." > 0";
      }
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="product_no_stock";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $stocks=listInBD($table,$filter);
      foreach ($stocks as $key=>$stock){
        $table="colors";
        $filter=array();
        $filter["id"]=array("operation"=>"=","value"=>$stock["id_color"]);
        if(isInBD($table,$filter)){
          $color=getInBD($table,$filter);
          for($i=1;$i<=12;$i++){
            $color["stock_size_".$i]=$stock["stock_size_".$i];
          }
          $product["colors"][]=$color;
        }
      }
      $product["images"]=array();
      for($i=1;$i<=12;$i++){
        if(file_exists(PATH."../../media/shop/photos/".$product["serial_model_code"]."-".$i.".jpg")){
          $product["images"][]["index"]=$i;
        }
      }
      $response["data"]=array();
      $response["data"]=$product;


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
