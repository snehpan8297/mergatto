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
  $page_path="WS::Categories";
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

    case "list_categories":
      debug_log($action." START");
      // Check Input Data

      //Temporal Code
      $id_user_groups=array();
      $id_user_groups[]=0;

      $table="categories";
      $filter=array();
      $filter["type"]=array("operation"=>"=","value"=>"normal");
      $filter["show_in_menu"]=array("operation"=>"=","value"=>1);

      $filter["complex"]="";
      $or="";
      foreach ($id_user_groups as $key=>$id_user_group){
        $filter["complex"].=$or."id_client_group = ".$id_user_group;
        $or=" OR ";
      }
      $fields=array();
      $order="position asc";
      $categories=listInBD($table,$filter,$fields,$order);
      $response["data"]=$categories;

      break;

    case "list_families":
      debug_log($action." START");
      // Check Input Data

      //Temporal Code
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
              if(!in_array($product["id_family"],$list_families)){
                $list_families[]=$product["id_family"];
              }
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
      }else{
        $response["data"]=array();
        foreach ($list_families as $key=>$id_family){
          $table="family";
          $filter=array();
          $filter["id_family"]=array("operation"=>"=","value"=>$id_family);
          $family=getInBD($table,$filter);
          $family["id_category"]=$action_data["id_category"];
          $response["data"][]=$family;
        }
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
