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
  $page_path="WS::Posts";
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

    case "list_posts":
      // Check Input Data
      $table="posts";
      $filter=array();
      $fields=array();
      $order="created desc";
      $offset=$action_data["offset"];
      $limit=5;
      $response["data"]=array();
      $response["data"]["posts"]=listInBD($table,$filter,$fields,$order,$offset,$limit);
      $response["data"]["has_previous_page"]=false;
      if($offset>=5){
        $response["data"]["has_previous_page"]=true;
      }
      $response["data"]["has_next_page"]=false;
      if(($offset+$limit)<=countInBD($table,$filter)){
        $response["data"]["has_next_page"]=true;
      }


      break;

    case "get_posts":
      // Check Input Data
      $table="posts";
      $filter=array();
      $filter["id_post"]=array("operation"=>"=","value"=>$action_data["id_post"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="id_post_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      $response["data"]=array();
      $response["data"]=getInBD($table,$filter);

      break;

    case "add_post":
      // Check Input Data
      $table="posts";
      $filter=array();
      foreach ($action_data as $key=>$value){
        $data[$key]=$value;
      }
      $data["created"]=$timestamp;
      addInBD($table,$filter,$data);


      break;

    case "update_post":
      // Check Input Data
      $table="posts";
      $filter=array();
      $filter["id_post"]=array("operation"=>"=","value"=>$action_data["id_post"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="id_post_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      unset($action_data["id_post"]);
      foreach ($action_data as $key=>$value){
        $data[$key]=$value;
      }
      updateInBD($table,$filter,$data);
      $response["data"]=array();
      $response["data"]=getInBD($table,$filter);

      break;

    case "delete_post":
      // Check Input Data
      $table="posts";
      $filter=array();
      $filter["id_post"]=array("operation"=>"=","value"=>$action_data["id_post"]);
      if(!isInBD($table,$filter)){
        $response["result"]=false;
        $response["error_code"]="id_post_not_valid";
        debug_log($response["error_code"],"ERROR");
        echo json_encode($response);
        die();
      }
      deleteInBD($table,$filter);
      $response["result"]=true;

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
