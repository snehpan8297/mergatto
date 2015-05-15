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

	error_reporting(0);

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS, DATA CHECK AND INCLUDES
  *********************************************************/

	define('PATH', '../../');
	$timestamp=strtotime(date("Y-m-d H:i:s"));
	include(PATH."include/inbd.php");
	$page_path="WS::PostCreditCard";
	debug_log("START");

	/*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

	if ((intval($_POST['Ds_Response'])>=0)&&(intval($_POST['Ds_Response'])<=99)){
		$order=array();
		$order["id_order"]=$_POST['Ds_MerchantData'];

		$table="order_request";
		$filter=array();
		$filter["id_order"]=array("operation"=>"=","value"=>$order["id_order"]);
		$data=array();
		$data["payed"]=1;
		updateInBD($table,$filter,$data);

	}

	/*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  debug_log("END");
  die();
?>
