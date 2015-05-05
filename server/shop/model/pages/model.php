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
  $page_path="WS::Cover";
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

    case "get_page":
      // Check Input Data
      switch ($action_data["page"]){
        case "shop":

          $response["data"]["content"]="<img src='../media/www/photos/shop.jpg' class='product-img img-responsive full-width'/>";

          break;

        case "posts":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>


          ";

          break;

        case "about":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>

          ";

          break;

        case "contact":

          $response["data"]["content"]="
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-sm-12' >
                <p class='text-center big-text padding-40'>Ups!</p>
                <h1 class='text-center' data-lang='404-title'>Esta página no está disponible</h1>
                <p class='text-center' data-lang='404-content'>Nuestro equipo está trabajando para activarla en unos momentos.</p>
                <br/><br/><br/><br/><br/>
              </div>
            </div>
          </div>
          ";
          break;

        case "lookbook":

          $response["data"]["content"]="
          <div class='container-fluid'>
          <h1 class='text-center'>Workbook Spring/Summer 2015</h1>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-001-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-002-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-003-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-004-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-005-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-006-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-007-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-008-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-009-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-010-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-011-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-012-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-013-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-014-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-015-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-016-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-017-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-018-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-019-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-020-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-021-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-022-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-023-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-024-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-025-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-026-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-027-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-028-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-029-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-030-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-031-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-032-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-033-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-034-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-035-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-036-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-037-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-038-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-039-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-040-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-041-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-042-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-043-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-044-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-045-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-046-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-047-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-048-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-049-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-050-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-051-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-052-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-053-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-054-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-055-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-056-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-057-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-058-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-059-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-060-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-061-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-062-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-063-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-064-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-065-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-066-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-067-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-068-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-069-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-070-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-071-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-072-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-073-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-074-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-075-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-076-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-077-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-078-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-079-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-080-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-081-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-082-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-083-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-084-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-085-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-086-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-087-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-088-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-089-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-090-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-091-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-092-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-093-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-094-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-095-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-096-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-097-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-098-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-099-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-100-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-101-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-102-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-103-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-104-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-105-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-106-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-107-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-108-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-109-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-110-1.jpg'/></div>
          <div class='col-md-4 padding-20'><img class='product-img img-responsive full-width' alt='' src='http://www.okycoky.net/img/ss15/okycoky/small/okycokyss14-111-1.jpg'/></div>
          </div>
          ";

          break;
        default:
          $response["data"]=array();
          $response["data"]["content"]="";

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
