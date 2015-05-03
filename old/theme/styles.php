<style type='text/css'>
html{
	height:100%;
}

body {
	font-size:14px;
	color:<?php echo $season_color["semilight"]; ?>;
	font-weight: 300;
	margin:0;
	height:100%;
	font-family: "Open Sans", sans-serif;
	height:100%;
	color:#888;
}
a{
	color:<?php echo $season_color["semilight"]; ?>;
	text-decoration:none;
}
a:hover{
	color:<?php echo $season_color["dark"]; ?>;
}
b{
	color:<?php echo $season_color["semidark"]; ?>;
	font-weight: 300;
	color:#000;
}
img {
	border: none;
}
.image_link{
	padding:5px;
}

.image_link:hover{
}

.image_link_selected{
	padding:5px;
}
.care_symbol{
	width:30px;
}

.acc_rej_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/accept_button.png");
	background-position:0px 18px;
	margin:auto;
}
.acc_lim_rej_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/acc_lim_button.png");
	background-position:top;
	margin:auto;
}
.acc_lim_rej_button:hover{
	background:url("./img/interface/reject_button.png");
	background-position:0px 18px;
}
.rej_acc_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/reject_button.png");
	background-position:0px 18px;
	margin:auto;
}


.acc_lim_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/acc_lim_button.png");
	background-position:top;
}

.reject_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/reject_button.png");
	background-position:0px 18px;
}
.reject_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/reject_button.png");
	background-position:0px 18px;
	margin:auto;
}
.reject_button:hover{
	background-position:top;
}
.card_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/card_button.png");
	background-position:0px 18px;
}
.card_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/card_button.png");
	background-position:0px 18px;
	margin:auto;
}
.no_card_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/card_button.png");
	background-position:top;
	margin:auto;
}
.accept_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/accept_button.png");
	background-position:0px 18px;
}
.accept_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/accept_button.png");
	background-position:0px 18px;
	margin:auto;
}
.accept_button:hover{
	background-position:top;
}
.no_accept_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/accept_button.png");
	background-position:top;
}
.no_accept_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/accept_button.png");
	background-position:top;
	margin:auto;
}
.no_accept_button:hover{
	background-position:0px 18px;
}
.edit_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/edit_button.png");
	background-position:0px 18px;
}
.edit_acc_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/edit_acc_button.png");
	background-position:top;
}
.edit_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/edit_button.png");
	background-position:top;
	margin:auto;
}
.edit_button:hover{
	background-position:0px 18px;
}
.delete_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/delete_button.png");
	background-position:0px 18px;
}
.delete_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/delete_button.png");
	background-position:0px 18px;
	margin:auto;
}

.bd_reload_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/bd_reload_button.png");
	background-position:top;
}
.bd_reload_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/bd_reload_button.png");
	background-position:top;
	margin:auto;
}
.bd_reload_button:hover{
	background-position:0px 18px;
}
.state_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 120px;
	height:22px;
	background:url("./img/interface/state_button.png");
	background-position:0px 46px;
}
.state_button:hover{
	background-position:0px 37px;
}
.state_button:focus{
	background-position:0px 18px;
}
.details_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/details_button.png");
	background-position:0px 18px;
}
.details_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/details_button.png");
	background-position:0px 18px;
	margin:auto;
}
.payment_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/payment_button.png");
	background-position:0px 18px;
}
.no_payment_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/payment_button.png");
	background-position:top;
}
.visible_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/visible_button.png");
	background-position:0px 18px;
}
.no_visible_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/visible_button.png");
	background-position:top;
}
.visible_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/visible_button.png");
	background-position:0px 18px;
}

.no_visible_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/visible_button.png");
	background-position:top;
}

.finish_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/finish_button.png");
	background-position:top;
}
.delevery_label{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/delevery_button.png");
	background-position:0px 18px;
}
.delevery_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 18px;
	height:18px;
	background:url("./img/interface/delevery_button.png");
	background-position:top;
}
.delevery_button:hover{
	background-position:0px 18px;
}
.left_decoration{
}
.right_decoration{
}

.multi_selection_arrow{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	width: 16px;
	height:18px;
	background:url("./img/interface/multi_selection_arrow.png");
	background-position:top;
}
h1{
	text-transform: uppercase;
	font-size:16px;
	font-weight: 300;
	color:#000;
	margin:0;
}
h2{
	color:<?php echo $season_color["semidark"]; ?>;
	text-transform: uppercase;
	font-size:16px;
	font-weight: 300;
	margin:0;

}
h3{
	text-transform: uppercase;
	font-size:18px;
	font-weight: 300;
	margin:0;
	color:#000 !important;
}
h4{
	text-transform: uppercase;
	font-size:16px;
	font-weight: 300;
	color:#000 !important;
	margin:0;
}
h4 a{
	text-transform: uppercase;
	font-size:16px;
	font-weight: 300;
	color:#000 !important;
	margin:0;
}
ul{
	margin:0;
	padding:0;
}

table{
	font-size:12px;
	white-space: none;
}		

.uppercase{
	text-transform: uppercase;
}
#top_menu{
	position: absolute;
	top:0;
	background: #fff;
	height:70px;
	width:100%;
	min-width:950px;
	margin-top:10px;
}
#top_menu .logo{
	padding-top: 15px;
	display: block;
	height:30px;
	margin-left: 50px;
	float:left;
}
#top_menu .logo img{
	height:30px;
}

#top_menu .user_panel{
	float:right;
	font-size: 13px;
	text-transform: uppercase;
	font-weight: 300;
	color:#999 !important;
	padding-top: 10px;
	padding-right: 50px;
	text-align: right;
}
#top_menu .user_panel{
	
}


#line_separator{
	display:none;
}

#line_separator_2{
		display:none;
	
}

#line_separator_3{
		display:none;
	
}

.icon_arrow_down{
	background:url('./img/interface/icon_arrow_down.png') no-repeat right 3px;
	padding-right:12px;
}
.tachado{
	text-decoration:line-through;
	color:#dddddd !important;
}
.underline{
	text-decoration:underline;
}
.romanlist li{
	list-style:lower-roman;
	margin-bottom:2px;
}
.decimallist li{
	list-style:decimal;
	margin-bottom:2px;
}
.latinlist li{
	list-style:lower-latin;
	margin-bottom:2px;
}
.dotlist li{
	list-style:disc;
	margin-bottom:2px;
}

#main {
	min-height:800px;
	margin:auto;
	background-color: #fefefe;
	margin-top:120px;
	min-width: 950px;
}
#lateral_logo{
	float:right;
	margin-right:-30px;
}
#lateral_logo img{
	width:70px;
	padding:10px;
	padding-left:5px;
	padding-top:0px;
}

#menu{
	position: absolute;
	top:130px;
	left:50px;	
}
#logo{
	padding-top:10px;
	padding-bottom:20px;
}
#logo img{
	width:180px;
}
#menu_item{

}
#menu_item li{
	padding:2px 0px 2px 20px;
}
#menu_item.title{
	padding:10px;
	text-transform:uppercase;
	
}
#menu_item.title a{
	font-weight: 300 !important;
	color:#000;
	font-size:13px;
}
a.menu_title{
}
a.menu_title:hover{
	color:<?php echo $season_color["dark"]; ?>;
}
a.menu_subtitle{
	font-weight:none;
	font-size:14px;
}

#menu_item.separator{
	height:5px;
	width:80px;
}
#menu_item.list{
}
#menu_item.list ul{
	margin:0px;
	padding:0px;
	list-style:none;
}
#menu_item.list li{
	font-size: 14px;
}

#menu_item.list a{
	font-size: 12px;
	font-weight: lighter;
	color:#444;
	text-transform: uppercase;
}
#menu_item.list a:hover{
	color:#000;
}
#search input{
	background-color: #fff !important;
	font-size:14px;
	font-weight: 300 !important;
	border:1px solid #d4d4d4;
	width: 170px !important;
	padding: 5px;
		color:#000;
		margin-top: 7px;
		margin-left:15px;

}
#search input:focus{
	border:1px solid #a4a4a4;
	outline: none;
}
#user_menu{
	background-color: #fff;
	text-align:right;
	position: absolute;
	top:50px;
	width:100%;
	min-width: 950px;
}
#cartspan{
	padding-top:10px;
	font-size:14px;
	color:#fff !important;
	margin-left: 10px;
}
#cartspan form{
	padding:0;
	margin:0;
	float:left;
	margin-left:50px;
	margin-top:0px;
}
#cartspan a.icon_cart{
	color:#000;
	margin-right: 10px;
}
.left_space{
	padding-left:10px;
}
#user_menu div{
	padding:10px 0px 10px 0px;
}
#content{
	margin-left: 250px;
	padding-top: 10px !important;	
	padding-right:50px;
	padding-bottom: 80px;
	min-height: 1050px;
}
#index{
	text-align:center;
	margin:auto;
}
#navigator{
	float:left;
	margin-top:250px;
	font-size:24px;
	color:<?php echo $season_color["semilight"]; ?>;
	padding-left:2px;
	padding-right:2px;
}
#item_list{
	overflow: auto;
}

#item{
	float:left;
	padding:2px 0px;
	width:33%;
	min-width: 215px;
}
#item .image{
	text-align:center;
}
#item .image img{
	width:90%;
}


#item .description{
	text-align: center;
	margin-top:10px;
	font-size: 14px;
	color:#333;
}
#item .description a{
	color:#666;
}
#item .description p{
	text-align: center !important;
	padding: 0 !important;
	margin-right: 0 !important;
}
#item .item_name{
	font-weight:300;
	text-transform:uppercase;
	color:#000;
}
.image_selector{
	height:280px;
	overflow-y:scroll;
	border:1px solid <?php echo $season_color["semilight"]; ?>;
}
.small_item{
	float:left;
	padding:10px 10px;
	min-width:86px;
	max-width:86px;
	height:155px;
}
.small_item .image_link{
	border:1px solid <?php echo $season_color["light"]; ?>;
}
.small_item .image_link:hover{
	border:1px solid <?php echo $season_color["dark"]; ?>;
}
.small_item .image img{
	width:74px;
	
}
.image_preview{

}
.image_preview img{
	width:150px;
}
.image_selected{
	background-color:<?php echo $season_color["light"]; ?>;
	border:1px solid <?php echo $season_color["dark"]; ?>;
}


#page_header{
	display:none;
	overflow: auto;
	background-color: #f4f4f4;
	position: absolute;
	top: 126px;
	width: 100%;
	left: 0;
}
#section_header{
	overflow: auto;
	background-color: #f4f4f4;
	position: absolute;
	top: 80px;
	width: 100%;
	left: 0;
	text-align:right;
	min-height: 30px;
}
#section_header .inner{
	margin: 8px 50px;
	
}
#section_header .inner a{
	color:#666;
	font-size:12px;
	text-transform: uppercase;
	
}
#page_navigator{
	font-size:16px ;
	font-weight:100;
	color:#333 !important;
	float:right;
	margin-left: 10px;
	text-transform:uppercase;
}
#page_navigator a{

	color:#333 !important;
}
#page_information{
	float:right;
	font-size:16px;
	font-weight: 300;
}
#page_filters a{
	margin-right:10px;
	text-transform:uppercase;
	float:left;
}
#page_pages{
	overflow: auto;

	text-transform:uppercase;
	float:right;
}

#page_pages li{
	display: inline-block;
	vertical-align: top;
	margin-right: 5px;
	text-align: right;
}
.page_arrow{
	background: url('./img/interface/arrows_pager.png') no-repeat 0 0;
	display: block;
	float: left;
	width: 8px;
	height: 10px;
	line-height: 10px;
	margin-right: 0px;
	position: relative;
	top: 2px;
}
.prev_disabled{
	background-position: 0 -20px;
}
.prev{
	background-position: 0px 0px;
}
.prev:hover{
	background-position: 0px -10px;
}
.next_disabled{
	background-position: -8px -20px;
}
.next{
	background-position: -8px 0px;
}
.next:hover{
	background-position: -8px -10px;
}

#product{
	overflow:auto;
	padding: 0 !important;
}
#product .preview{
	float:left;
	width:370px;
}
#product .preview table{
	width: 380px !important;
}
#product .preview .principal img{
	width:370px;
}
#product .information{
	padding-left: 400px;
}
#product .information h1{
	font-size: 16px !important;
}
#product .information .information_header{
	height:0px;
	margin:10px 0px;
}
#product .information .name{
	margin:10px 5px 10px 0px;
	font-size: 12px !important;
}
#product .information .name h2{
	font-size: 12px !important;
}
#product .information .price{
	margin:10px 0px 10px 0px;
}
#product .information .price .old_price{
}
#product .information .price h3{
	font-size: 20px;
	color:#000;
	font-weight: 300;
	margin-top: 10px;
}
#product .information .collection{
	margin:0px 0px 10px 0px;
}
#product .information .color_selector{
	
}
#product .information .color_selector ul{
	list-style: none;
}
#product .information .color_selector li{
	display:inline;
}
#product .information .color_selector img{
	padding:2px;
	width:20px;
	border: 1px solid <?php echo $season_color["light"]; ?>;

}
#product .information .color_selector .no_image_color{
	display:block;
	background-color:<?php echo $season_color["light"]; ?>;
	border: 1px solid <?php echo $season_color["light"]; ?>;
	padding:2px;
	width:20px;
	height:20px;
}

#product .information .size_selector{
	margin-top:15px;
	width:66px;
	float:left;
	margin-right: 30px;
	
}
.color_selector li table {
	font-size:12px !important;

}
.color_selector li table{
	border-collapse: collapse;
	width:100%;
}
.color_selector li td{
	text-align: left;
}
.color_selector li td:first-child{
	width:30px;
}
.color_selector li.selected table{
	border:1px solid #d4d4d4;
}
.color_selector li.selected tr{
	font-weight: bold !important;
	color: <?php echo $season_color["dark"]; ?> !important;
	background-color: #f4f4f4;
}
.color_selector li td{
	padding:5px 10px;
}

.color_selector li.selected a{
	font-weight: 300 !important;
	color: <?php echo $season_color["dark"]; ?> !important;
}
.color_selector li.selected .image_link_selected{
	border: 1px solid <?php echo $season_color["dark"]; ?> !important;

}
.select_head{
	width:100%;
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	background-color:#ffffff;
	padding:10px;
}
.select_head .text{
	font-size: 12px;
}
.select_head .arrow{
	float:right;
	height:15px;
	width:15px;
}
.select_child{
	width:76px;

	border:1px solid <?php echo $season_color["semilight"]; ?>;
	background-color:#ffffff;
	padding:5px;
	border-top:none;
	position:absolute;
	z-index:1;
	
}
.select_child li{
	list-style: none;
	font-size: 12px;
	
}
.select_child a{
	width:100%;
	display:block;
	padding:5px 0px 5px 0px;
}
.select_child a:hover{
	width:100%;
	display:block;
	background-color:<?php echo $season_color["semilight"]; ?>;
	color:#ffffff;
}
.select_child span{
	width:100%;
	display:block;
	padding:5px 0px 5px 0px;
	color:#cccccc;
}

#product .information .add_to_cart{
	margin:15px 0px;
	overflow:auto;

}

.button{
	padding:10px 20px;
	background-color:<?php echo $season_color["semilight"]; ?>;
	text-align: center;
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	color:#ffffff;
	font-size:12px;
	text-transform:uppercase;
	font-weight: bold;
	min-width: 200px;
}
.button:hover{
	background-color: <?php echo $season_color["semidark"]; ?>;
	cursor: pointer;
}
.button:focus{
	background-color: <?php echo $season_color["dark"]; ?>;
}
.form_submit{
	overflow:auto;
}

.small{
width:200px !important;
}
.smalltext{
width:180px !important;
}


#product .information .tags{
	margin-bottom:15px;
}

.tags li{
	display: inline;
	list-style: none;
}

#product .information .more_info{
	margin-bottom:15px;
}
#more_info_panel{
	
}
#more_info_panel .title{
	border-bottom:1px solid <?php echo $season_color["semilight"]; ?>;
	padding:5px 0px;
	
	text-transform: uppercase;
	font-style: italic;
	
}
#more_info_panel .more{
	font-size: 12px;
	padding-top: 10px;
}
#more_info_panel .content{
	display:none;
	position:relative;
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	border-top:none;
	padding:10px;
	background-color:#ffffff;
}

#product .secondaries{
	margin-top:5px;
	text-align:center;
	overflow: auto;
}

#product .secondaries li{
	display: block;
	float:left;
}
#product .secondaries img{
	height: 100px;
	
}

.zoom_icon{
	position: relative;
	top:500px;
	left:10px;
	font-size:40px;
	z-index: 200;
}

#super_zoom{
	position:absolute;
	top:0px;
	margin:auto;
	z-index:999;
	display:none;

}

#super_zoom img{
	min-height:980px;
	height:100%;
	margin:auto;
}
#suggestions{
	
}
#suggestions .title{
	margin:10px 0px 5px 0px;
}
#suggestions .suggestions_list ul{ * 
 */
	list-style: none;
}
#suggestions .suggestions_list li{
	display: inline;
}
#suggestions .suggestions_list img{
	height:90px;
	margin-right: 5px;
}
#index_logo{
	margin-top:15px; 
	text-align: center;
}
#slideshow{
	margin:10px 0px;
	text-align:center;
}
#slideshow img{
	height:650px;
	margin-left:5px;
}
#slideshow .logo{
	background:url("../img/interface/slide_show_logo.png") no-repeat right;
	display:block;
	width:650px;
	height:300px;
	position:absolute;
	top:100px;

}

#content .infobox_error{
	color:red;
}
#content .infobox_success{
	text-align: justify;
	border: 1px solid green;
	padding:10px;
	margin: 10px 0px;
	color:green;
	background-color:#eeffff;
}
#content .infobox_info{
	text-align: justify;
	margin: 10px 0px;
}
.form_entry .label{
	display: block;
	padding:10px 0px 5px 0px;
}
.form_entry .form_isrequired{
	color:red;
}
.form_entry .text{
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	padding:10px;
	font-size: 12px;
	width: 350px;

}
.form_entry .text_disabled{
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	padding:5px;
	width: 300px;
	color:<?php echo $season_color["semidark"]; ?>;
	background-color:#f4f4f4;


}
.form_entry .field_confirm{
	margin:1px 0px;
	padding:6px;
	border:1px solid <?php echo $season_color["semilight"]; ?>;

	width: 300px;
	display: block;
	color:<?php echo $season_color["semidark"]; ?>;
	background-color:<?php echo $season_color["light"]; ?>;
	font-size:11px;
}
.form_entry .text:hover{
	border:1px solid <?php echo $season_color["dark"]; ?>;
	
}
.form_entry .text:focus{
	border:1px solid <?php echo $season_color["semidark"]; ?>;
	outline: none;
	
}
.form_entry textarea{
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	padding:5px;
	width: 300px;
	max-width: 300px;
	min-width: 300px;
	height: 150px;
	max-height: 150px;
	min-height: 150px;
	resize: none;
	color:<?php echo $season_color["semidark"]; ?>;
}
.form_entry textarea:hover{
	border:1px solid <?php echo $season_color["dark"]; ?>;
	
}
.form_entry textarea:focus{
	border:1px solid <?php echo $season_color["semidark"]; ?>;
	outline: none;
	
}
.form_entry .label_right{
	padding-left:5px;
}
#content .form_submit{
	padding:30px 0px 10px 0px;
}
.form_entry .form_entry_alert{
	color:red;
}
#content .ticket .ticket_content{
	border: 1px solid <?php echo $season_color["semilight"]; ?>;
	background:url('./img/interface/sello.png') no-repeat right center <?php echo $season_color["light"]; ?>;
	color:<?php echo $season_color["semidark"]; ?>;
	padding:50px 10px 10px 10px;
	width:400px;
}
#content .ticket .title{
	border-bottom: 1px solid <?php echo $season_color["semilight"]; ?>;
	margin-bottom: 20px;
	padding-bottom: 5px;
}
#content .ticket .ticket_content .label{
	display:block;
	text-transform: uppercase;
	margin-bottom: 5px;
}
#content .ticket .ticket_content .content{
	display: block;
	margin-bottom:15px;
}
#content .ticket .ticket_content .moreinfo{
	margin-bottom:0px;
	margin-top:35px;
	text-align: justify;
	color:<?php echo $season_color["semilight"]; ?>;
	display: block;
}
.data_table{
	border-collapse:collapse;
	width:100%;
}
.data_table th{
	font-size: 16px;
	font-weight: 300;
	color:#000;
	padding:20px 0px;
		background-color:#f4f4f4;

}
.data_table th.image_header{
	width:60px;
}
.data_table th.name_selector_header{
	width:300px;
	text-align: left;
}
.data_table th.amount_header{
	width:160px;
	text-align: right;
}
.data_table th.delete_header{
	width:100px;
}
.data_table th.client_icon_data{
	width:0px;
}
.data_table th.client_small_data{
	width:100px;
}
.data_table th.client_medium_data{
	width:200px;
}
.data_table th.client_large_data{
	width:250px;
}
.data_table th.client_max_data{
	width:100%;
}
.data_table .selected{
	background-color:#f4f4f4;
	color:<?php echo $season_color["dark"];?> !important;
}
.data_table .total td{
	background-color:#f4f4f4 !important;
	color:#000 !important;
	border:none !important;
}
.data_table .total td h2{
	color:#000 !important;
}
.data_table .revision{
	background-color:#fff4f4;
}
.data_table .clickable:hover{
	background-color:#f4f4f4;
	color:<?php echo $season_color["dark"];?> !important;
}
.data_table .code_data{
	text-align:center;
}
.data_table .text_data{
	text-align:right;
}
.data_table .image_data{
	text-align:center;
	padding:10px 4px;
}
.data_table .name_product_data{
	text-align:left;
}
.data_table .icon_data{
	text-align:center;
}

.data_table .general_options td{
	border-top:1px solid <?php echo $season_color["light"];?>;
	padding:10px 0px;

}
.data_table .filter_options td{
	padding:10px 0px;
	text-align:right;

}
.data_table .pagination_options td{
	padding:10px 0px;
	text-align:left;

}
.paginate_button{
	padding:5px 5px;
	text-decoration: underline;
	color:<?php echo $season_color["semidark"]; ?>;
}
.paginate_button_disabled{
	text-decoration: line-through;
	color:<?php echo $season_color["light"]; ?>;
}

.dataTables_paginate span a{
	padding:5px;
	margin:0px 5px;
	text-decoration: none;
	border:1px solid white;

}
.dataTables_paginate span a:hover{
	border:1px solid <?php echo $season_color["semidark"]; ?>;

}
.paginate_active{
	border:1px solid <?php echo $season_color["semidark"]; ?> !important;
}
#list_clients{
	margin-top:10px;
}
#order_list{
	margin-top:10px;
}
#paymentstable{
	margin-top:10px;
}
#products_list{
	margin-top: 10px;
}
.show_line td{
	border-bottom:1px solid <?php echo $season_color["light"]; ?>;
}
.main_option{
	padding:10px 0px;
	overflow: auto;
}
.main_option .likeabutton{
	float:right;
}
.cart_options{

}
.cart_options a{

}
.cart_options span{

}
.old_price{
	text-decoration:line-through;
	color:red;
}
.new_price{
	font-size: 18px;
	padding-top:20px;
	color:black;
}

#footer{
	background-color: #222222;
	padding:55px 50px 45px 50px;
	overflow: auto;
}

.deep_fooer{
	background-color: #000;
	padding:20px;
	color:white;
	
}

.footer_menus{
	overflow:auto;
	width: 800px;
	margin: auto;
}
#footer_menu{
	float:left;
	padding:0px 5px;
}
#footer_title{
	text-transform:uppercase;
	padding:5px 10px 2px 10px;
	text-align: center;

}
#footer_separator{
	height:7px;
}
#footer_separator_3{
	background:url("./img/interface/footer_separator_3_bg.png") no-repeat center;
	height:7px;
}
#footer_links{
	margin:0;
	padding:5px 10px;
	list-style: none;
	text-transform: uppercase;
}
#footer_links{
	
}

.checkbox{
	display:block;
	float:left;
	min-width: 100px;
}
.checkbox_list{
	display:block;
}

.checkbox_content{
	overflow:auto;
	
}
.season_color_preview{
	display:block;
	float:left;
	margin-right:5px;
	border:1px solid <?php echo $season_color["light"]; ?>;
	width:25px;
	height:25px;
}

#slider {
	margin-top:10px;
	margin-left:0px;
	height: 500px;
	width: 780px;
}
.choco-title {
  position:absolute;
  left:0px;
  bottom:0px;
  background:#ffffff;
  color:<?php echo $season_color["semidark"]; ?>;
  width:100%;
  z-index:89;
  text-transform:uppercase;
}

.stockOut {
    background-color:#ffeeee;
    color:red;
}
.stockIn {
    background-color:#eeffee;
    color:green;
}
.cartStockOut {
    background-color:#ffeeee;

}
.unitbox-disabled{
	background-color: #f0f0f0;
}
.window {
	left: 50%;
}

.sizes_table{
	border-collapse: collapse;
	margin:10px 0px;
	width:600px;
}
.sizes_table th{
    background-color:<?php echo $season_color["dark"]; ?>;
    padding:5px 10px;
    text-aling:center;
    color:#ffffff !important;

}
.sizes_table td.first{
    padding:5px 10px;
    background-color:<?php echo $season_color["semilight"]; ?>;
    color:#ffffff;

}
.sizes_table td{
    padding:5px 10px;
    text-align:center;

}
.sizes_table tr:hover{
    background-color:<?php echo $season_color["light"]; ?>;
    color:<?php echo $season_color["dark"]; ?>;
}





/* Buttons Overwride */

.close_button {
    display: inline-block;
    *display: inline;
     padding: 9px 40px;
	 padding-top:7px ;
    margin-bottom: 0;
    margin-left: 5px;
    *margin-left: .3em;
    font-size: 14px;
    line-height: 20px;
    color: #5e5e5e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #d1dade;
    *border: 0;
    -webkit-border-radius: 3px;
     -webkit-border-radius: 3px;
     -webkit-border-radius: 3px; 
	background-image:none !important;
	border: none;
	text-shadow: none;
	box-shadow:none;	
    transition: all 0.12s linear 0s !important;
	font-family: "Open Sans", sans-serif;
	color: #fff !important;
    background-color: #000;
	border:1px solid #000;
	text-transform: uppercase;
	padding:3px 12px;
    font-size: 11.9px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    color: #5e5e5e !important;
    background-color: #fff;
	border:1px solid #e5e9ec;
}
.close_button:focus{
	outline:none;
}
.close_button:hover, .close_button:focus {
    background-color: #fbfcfd;
    *background-color: #fbfcfd;
	border:1px solid #b4b9be;
}
.likeabutton a {
    display: inline-block;
    *display: inline;
     padding: 9px 40px;
	 padding-top:7px ;
    margin-bottom: 0;
    margin-left: 5px;
    *margin-left: .3em;
    font-size: 14px;
    line-height: 20px;
    color: #5e5e5e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #d1dade;
    *border: 0;
    -webkit-border-radius: 3px;
     -webkit-border-radius: 3px;
     -webkit-border-radius: 3px; 
	background-image:none !important;
	border: none;
	text-shadow: none;
	box-shadow:none;	
    transition: all 0.12s linear 0s !important;
	font-family: "Open Sans", sans-serif;
	color: #fff !important;
    background-color: #000;
	border:1px solid #000;
	text-transform: uppercase;
}
.likeabutton a:focus{
	outline:none;
}
.likeabutton a:hover, .likeabutton a:focus, .likeabutton a:active, .likeabutton.active, .likeabutton.disabled, .likeabutton[disabled] {
	background-color: #666;
	border:1px solid #666;
	color:white;
}
.likeabutton input {
    display: inline-block;
    *display: inline;
     padding: 9px 40px;
	 padding-top:7px ;
    margin-bottom: 0;
    margin-left: 5px;
    *margin-left: .3em;
    font-size: 14px;
    line-height: 20px;
    color: #5e5e5e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #d1dade;
    *border: 0;
    -webkit-border-radius: 3px;
     -webkit-border-radius: 3px;
     -webkit-border-radius: 3px; 
	background-image:none !important;
	border: none;
	text-shadow: none;
	box-shadow:none;	
    transition: all 0.12s linear 0s !important;
	font-family: "Open Sans", sans-serif;
	color: #fff !important;
    background-color: #000;
	border:1px solid #000;
	text-transform: uppercase;
}
.likeabutton input:focus{
	outline:none;
}
.likeabutton input:hover, .likeabutton input:focus, .likeabutton input:active, .likeabutton.active, .likeabutton.disabled, .likeabutton[disabled] {
	background-color: #666;
	border:1px solid #666;
	color:white;
}

.btn {
	text-transform: uppercase;
    display: inline-block;
    *display: inline;
     padding: 9px 12px;
	 padding-top:7px ;
    margin-bottom: 0;
    *margin-left: .3em;
    font-size: 14px;
    line-height: 20px;
    color: #5e5e5e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #d1dade;
    *border: 0;
    -webkit-border-radius: 3px;
     -webkit-border-radius: 3px;
     -webkit-border-radius: 3px; 
	background-image:none !important;
	border: none;
	text-shadow: none;
	box-shadow:none;	
    transition: all 0.12s linear 0s !important;
	font-family: "Open Sans", sans-serif;
}
.btn:focus{
	outline:none;
}
.btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled, .btn[disabled] {
    background-color: #c1cace;
    *background-color: #c1cace;
}
.btn-cons{	
	margin-right: 5px;
	min-width: 120px;
	margin-bottom: 8px;
}
/* only for demonstration */
.btn-demo-space{
  margin-bottom: 8px;
}
.demo-placeholder{
	width:100%;
	height:250px;
}
/* */
.btn-social{
	font-size: 20px;
    margin: 10px;
	
}
.btn-social:hover, .btn-social:focus, .btn-social:active, .btn-social.active, .btn-social.disabled, .btn-social[disabled] {
	color:#2d8ebf;
	text-decoration:none;
}
.btn-primary{
	color: #fff;
    background-color: #0aa699;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {
    background-color: #0b9c8f;
    *background-color: #0b9c8f;
}
.btn-success{
	color: #fff;
    background-color: #0090d9;
}
.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.disabled, .btn-success[disabled] {
    background-color: #1285d1;
    *background-color: #1285d1;
}
.btn-info{
	color: #fff;
    background-color: #1f3853;
}
.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .btn-info.disabled, .btn-info[disabled] {
    background-color: #152639;
    *background-color: #152639;
}
.btn-warning{
	color: #fff;
    background-color: #FBB05E;
}
.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .btn-warning.disabled, .btn-warning[disabled] {
    background-color: #f8a142;
    *background-color: #f8a142;
    color:white;
}

.btn-danger{
	color: #fff;
    background-color: #f35958;
}
.text-danger{
	color: #f35958;
}
.text-danger:hover{
	color: #f35958;
}
.btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .btn-danger.disabled, .btn-danger[disabled] {
	color: #fff;
    background-color: #e94847;
    *background-color: #e94847;
}

.btn-danger-dark{
	color: #fff;
    background-color: #b94141;
}
.btn-danger-dark:hover, .btn-danger-dark:focus, .btn-danger-dark:active, .btn-danger-dark.active, .btn-danger-dark.disabled, .btn-danger-dark[disabled] {
    background-color: #e94847;
    *background-color: #e94847;
	color: #fff;
}
.btn-dark{
	color: #fff;
    background-color: #000;
	border:1px solid #000;
}
.btn-dark:hover, .btn-dark:focus, .btn-dark:active, .btn-dark.active, .btn-dark.disabled, .btn-dark[disabled] {
	background-color: #666;
	border:1px solid #666;
	color:white;
}
.btn-white{
	color: #5e5e5e;
    background-color: #fff;
	border:1px solid #e5e9ec;
}
.btn-white:hover, .btn-white:focus, .btn-white:active, .btn-white.active, .btn-white.disabled {
    background-color: #fbfcfd;
    *background-color: #fbfcfd;
	border:1px solid #b4b9be;
}
.btn-white[disabled]{
	color: #d4d4d4;
    background-color: #fff;
	border:1px solid #d4d4d4;	
}
.btn-link{
	color: #5e5e5e;
    background-color: transparent;
	border:none;
}
.btn-large {
    padding: 11px 19px;
    font-size: 16px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}

.btn-link:hover, .btn-link:focus, .btn-link:active, .btn-link.active, .btn-link.disabled, .btn-link[disabled] {
    background-color: transparent;
    *background-color: transparent;
}
.btn-large [class^="icon-"], .btn-large [class*=" icon-"] {
    margin-top: 4px;
}
.btn-small {
    padding:3px 12px;
    font-size: 11.9px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.btn-small [class^="icon-"], .btn-small [class*=" icon-"] {
    margin-top: 0;
}
.btn-mini [class^="icon-"], .btn-mini [class*=" icon-"] {
    margin-top: -1px;
}
.btn-mini {
    padding:2px 9px;
    font-size: 10.5px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}

.btn-group.open .btn.dropdown-toggle {
    background-color: #e6e6e6;
}
.btn-group.open .btn-primary.dropdown-toggle {
    background-color: #0b9c8f;
}
.btn-group.open .btn-warning.dropdown-toggle {
    background-color: #fbc01e;
}
.btn-group.open .btn-danger.dropdown-toggle {
    background-color: #e94847;
}
.btn-group.open .btn-success.dropdown-toggle {
    background-color: #0090d9;
}
.btn-group.open .btn-info.dropdown-toggle {
    background-color: #152639;
}
.btn-group.open .btn-inverse.dropdown-toggle {
    background-color: #222;
}

.btn-group.open .btn-white.dropdown-toggle {
    background-color: #fbfcfd;
}
.btn-group > .btn + .dropdown-toggle{
	-webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
	border-left:1px #f7f7f7 solid;
}
.btn-block + .btn-block {
	margin-top: 8px;
}
.btn .caret{
	margin-left: 3px;
}
.btn .caret.single{
	margin-left: 0px;
}
.btn-group > .dropdown-menu{
	font-size:13px;
}
.btn-group > .dropdown-menu li{
	 padding-left: 0px;
}

select{
	height:20px;
	margin:12px 0px;
}
.cart_address{
	width:45% !important;
	float:left;
}
.items_row{
	overflow: auto;
}
.footer_block{
	width:25%;
	float:left;
}
#footer .menu{
	list-style: none;
}
#footer .menu li{
line-height: 23px;
text-transform: uppercase;
font-size: 11px;
}
#footer .menu a:hover{
	color:white;
}

.social_menu li{	
	margin: 0px 10px 0px 0px;
}

.social_menu {
	list-style-type: none;
	margin: 0;
	padding: 0;
	display: inline-block;
	overflow: hidden;
}
.social_menu li {
	display: inline;
	float: left;
	margin: 0 10px 0 0;
	padding: 0;
	width: auto;
}
.social_menu li a {
	overflow: hidden;
	display: block;
	float: left;
	height: 26px;
	width: 26px;
	background-color: #fff;
	border-radius: 30px;
	-moz-border-radius: 30px;
	-webkit-border-radius: 30px;
	-o-border-radius: 30px;
	text-align: center;
	vertical-align: middle;
	text-indent: -9999px;
	margin: 0;
	padding: 0;
	-webkit-transition: all .25s ease 0s;
	-moz-transition: all .25s ease 0s;
	-o-transition: all .25s ease 0s;
}
.social_menu li a:hover {
	background-color: #000000;
}
.social_menu li a span.inner {
	overflow: hidden;
	background-repeat: no-repeat;
	background-image: url(theme/img/social_icons_sprite.png);
	width: 26px;
	height: 26px;
	position: relative;
	margin: -1px 0 0 -1px;
	display: block;
	-webkit-transition: all .25s ease 0s;
	-moz-transition: all .25s ease 0s;
	-o-transition: all .25s ease 0s;
}
@media only screen and (-webkit-min-device-pixel-ratio:1.5), only screen and (min--moz-device-pixel-ratio:1.5), only screen and (-o-min-device-pixel-ratio:150/100), only screen and (min-device-pixel-ratio:1.5), only screen and (min-resolution:160dpi) {
	.social_menu li a span.inner {
	width: 28px;
	height: 28px;
	background-repeat: no-repeat;
	-o-background-size: 644px 56px;
	-webkit-background-size: 644px 56px;
	-moz-background-size: 644px 56px;
	background-size: 644px 56px;
	background-image: url(theme/img/social_icons_sprite@1_5x.png);
}
}@media only screen and (-webkit-min-device-pixel-ratio:2.0), only screen and (min--moz-device-pixel-ratio:2.0), only screen and (-o-min-device-pixel-ratio:200/100), only screen and (min-device-pixel-ratio:2.0), only screen and (min-resolution:210dpi) {
	.social_menu li a span.inner {
	width: 28px;
	height: 28px;
	background-repeat: no-repeat;
	-o-background-size: 644px 56px;
	-webkit-background-size: 644px 56px;
	-moz-background-size: 644px 56px;
	background-size: 644px 56px;
	background-image: url(theme/img/social_icons_sprite@2x.png);
}
}.social_menu li.twitter a .inner {
	background-position: 0 0;
}
.social_menu li.facebook a .inner {
	background-position: -28px 0;
}
.social_menu li.pinterest a .inner {
	background-position: -56px 0;
}
.social_menu li.forrst a .inner {
	background-position: -84px 0;
}
.social_menu li.dribbble a .inner {
	background-position: -112px 0;
}
.social_menu li.flickr a .inner {
	background-position: -140px 0;
}
.social_menu li.linkedin a .inner {
	background-position: -169px 0;
}
.social_menu li.lastfm a .inner {
	background-position: -196px 0;
}
.social_menu li.vimeo a .inner {
	background-position: -224px 0;
}
.social_menu li.yahoo a .inner {
	background-position: -252px 0;
}
.social_menu li.tumblr a .inner {
	background-position: -280px 0;
}
.social_menu li.apple a .inner {
	background-position: -309px 0;
}
.social_menu li.blogger a .inner {
	background-position: -337px 0;
}
.social_menu li.wordpress a .inner {
	background-position: -365px 0;
}
.social_menu li.windows a .inner {
	background-position: -394px 0;
}
.social_menu li.youtube a .inner {
	background-position: -422px 0;
}
.social_menu li.rss a .inner {
	background-position: -448px 0;
}
.social_menu li.instagram a .inner {
	background-position: -477px 0;
}
.social_menu li.google a .inner {
	background-position: -505px 0;
}
.social_menu li.bechance a .inner {
	background-position: -532px 0;
}
.social_menu li.android a .inner {
	background-position: -558px 0;
}
.social_menu li.skype a .inner {
	background-position: -586px 0;
}
.social_menu li.digg a .inner {
	background-position: -614px 0;
}
.social_menu li.twitter a:hover .inner {
	background-position: 0 -28px;
}
.social_menu li.facebook a:hover .inner {
	background-position: -28px -28px;
}
.social_menu li.pinterest a:hover .inner {
	background-position: -56px -28px;
}
.social_menu li.forrst a:hover .inner {
	background-position: -84px -28px;
}
.social_menu li.dribbble a:hover .inner {
	background-position: -112px -28px;
}
.social_menu li.flickr a:hover .inner {
	background-position: -140px -28px;
}
.social_menu li.linkedin a:hover .inner {
	background-position: -169px -28px;
}
.social_menu li.lastfm a:hover .inner {
	background-position: -196px -28px;
}
.social_menu li.vimeo a:hover .inner {
	background-position: -224px -28px;
}
.social_menu li.yahoo a:hover .inner {
	background-position: -252px -28px;
}
.social_menu li.tumblr a:hover .inner {
	background-position: -280px -28px;
}
.social_menu li.apple a:hover .inner {
	background-position: -309px -28px;
}
.social_menu li.blogger a:hover .inner {
	background-position: -337px -28px;
}
.social_menu li.wordpress a:hover .inner {
	background-position: -365px -28px;
}
.social_menu li.windows a:hover .inner {
	background-position: -394px -28px;
}
.social_menu li.youtube a:hover .inner {
	background-position: -422px -28px;
}
.social_menu li.rss a:hover .inner {
	background-position: -448px -28px;
}
.social_menu li.instagram a:hover .inner {
	background-position: -477px -28px;
}
.social_menu li.google a:hover .inner {
	background-position: -505px -28px;
}
.social_menu li.bechance a:hover .inner {
	background-position: -532px -28px;
}
.social_menu li.android a:hover .inner {
	background-position: -558px -28px;
}
.social_menu li.skype a:hover .inner {
	background-position: -586px -28px;
}
.social_menu li.digg a:hover .inner {
	background-position: -614px -28px;
}
.cart_button{
	float: left;
	margin-right:5px;
}
#cart_menu{
	height:28px;
}
.text-muted{
	color:#d4d4d4 !important;
}
.badge {
    display: inline-block;
    color: #fff;
    background-color: #999;
    
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    
	background-color:#f4f4f4;	
	border: 1px solid #d4d4d4;
	
	color: #5E5E5E;
	padding:10px 15px;
}
.return_address input{
	padding:5px 5px;
	font-size:14px;
	border:1px solid #999;
	width:200px;
}
.return_address input:focus{
	border:1px solid #333;
	outline: none;
}
.or_badge{
	text-shadow:none;
	background-color:#D1DADE;	
	font-size:12px;
	padding-left: 6px;
    padding-right: 6px;
	padding-bottom:4px;
	padding-top:4px;
	color: #5E5E5E;
	-webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
}
.or_badge_left_menu{
	font-size:12px;
	font-weight: 100;
	padding-left: 7px;
    padding-right: 7px;
	padding-bottom: 2px;
	padding-top:2px;
	color:#666;
	background-color:#f4f4f4;
	border:1px solid #d4d4d4;
}
.or_badge-success{
	background-color:#0aa699;
	color:#fff;
}

.or_badge-warning{
	background-color:#e59500;
	color:#fff;
}

.or_badge-important{
	background-color:#f35958;
	color:#fff;
}

.or_badge-info{
	background-color:#0090d9;
	color:#fff;
}

.or_badge-inverse{
	background-color:#1f3853;
	color:#fff;
}

.or_badge-white{
	background-color:#fff;
	color: #5E5E5E;
}

.or_badge-disable{
	background-color:#2a2e36;
	color:#8b91a0;
}
.box-warning{
	color: #fba000;
	background-color: #fff5e5;
    border:1px solid #fba000;

}

.or_badge_product{
	position:absolute;
	top:100px;
	right:-50px;
	width:60px;
	text-shadow:none;
	font-size:20px;
	padding-left: 7px;
    padding-right: 7px;
	padding-bottom: 25px;
	padding-top: 25px;
	-webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    -ms-transform: rotate(-10deg); /* IE 9 */
    -webkit-transform: rotate(-10deg); /* Chrome, Safari, Opera */
    transform: rotate(-10deg);
}

.ship{
	background: #fff;
	border:1px solid #fff;
	padding:10px;
}
.shipping_offer{
	background: #f4f4f4;
	border:1px solid #d4d4d4;
	padding:10px;
}

.no_stock .image img {
	-webkit-filter: grayscale(100%);
	-moz-filter: grayscale(100%);
	filter: grayscale(100%);
}
#zoom_image{
	max-width:90%;
}
</style>
