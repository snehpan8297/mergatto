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
	$server_option='server';

	switch ($server_option){
		case "local":
			$conf = array(
				'bdtype' => 'mysql',
				'bdserver' => 'localhost',
				'bdport' => '',
				'bd' => 'okycoky',
				'bduser' => 'root',
				'bdpass' => 'root',
				'bdprefix' => 'classic_'
			);
			$url_server = "http://localhost:8888/okycoky/";

			break;
		case "server":
			$conf = array(
				'bdtype' => 'mysql',
				'bdserver' => 'localhost',
				'bdport' => '',
				'bd' => 'okycoky_classics',
				'bduser' => 'root',
				'bdpass' => 'n1nkt3c',
				'bdprefix' => 'classic_'
			);
			$url_server = "http://www.okycoky.com/";
			break;
	}


	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

?>
