<?php

	/************************************************************
	* Citious
	* Author: Pablo Gutierrez Alfaro <pablo@citious.com>
	* Creation Modification: 28-01-2015
	* Last Modification: 28-01-2015
	* licensed through Copyright 2015
	************************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	$server_option='local';

	switch ($server_option){
		case "local":
			$conf = array(
				'bdtype' => 'mysql',
				'bdserver' => 'localhost',
				'bdport' => '',
				'bd' => 'citious',
				'bduser' => 'root',
				'bdpass' => 'root',
				'bdprefix' => ''
			);
			$url_server = "http://localhost:8888/citious/";

			break;
		case "server":
			$conf = array(
				'bdtype' => 'mysql',
				'bdserver' => 'localhost',
				'bdport' => '',
				'bd' => 'citious',
				'bduser' => 'root',
				'bdpass' => '2CuW2St9c',
				'bdprefix' => ''
			);
			$url_server = "http://www.citious.com/";
			break;
	}


	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

?>
