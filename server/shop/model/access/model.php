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

    case "get_session":
      // Check Input Data

      $session_key="anonymous";

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $session_key.=$_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $session_key.=$_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
        $session_key.=$_SERVER['REMOTE_ADDR'];
      }
      $session_key.=$timestamp;
      $session_key=sha1($session_key);

      $table="session_keys";
      $data=array();
      $data["session_key"]=$session_key;
      addInBD($table,$data);

      $response["data"]=array();
      $response["data"]["session_key"]=$session_key;


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
