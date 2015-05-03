<style type='text/css'>
html{
	height:100%;
}

body {
	font-size:12px;
	color:<?php echo $season_color["semilight"]; ?>;
	margin:0;
	height:100%;
	font-family: Arial !important;
	height:100%;
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
.close_button{
	margin:2px 4px;
	display:block; 
	overflow: hidden;
	background-color: <?php echo $season_color["light"]; ?>;
	color:#ffffff;
	padding:5px;
	text-align:center;
	text-transform: uppercase;
}
.close_button:hover{
	color:#ffffff;
	background-color: <?php echo $season_color["semidark"]; ?>;

}
.close_button:focus{
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
	color:<?php echo $season_color["semidark"]; ?>;
	text-transform: uppercase;
	font-size:18px;
	font-weight: bold;
	margin:0;
}
h2{
	color:<?php echo $season_color["semidark"]; ?>;
	text-transform: uppercase;
	font-size:16px;
	font-weight: bold;
	margin:0;

}
h3{
	text-transform: uppercase;
	font-size:14px;
	font-weight: bold;
	margin:0;
}
h4{
	text-transform: uppercase;
	font-size:12px;
	font-weight: bold;
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


.important{
	color:<?php echo $season_color["semidark"]; ?>;
}
.uppercase{
	text-transform: uppercase;
}
#line_separator{
	background:url('./img/interface/line_separator_bg.png') no-repeat center;
	height:20px;
	margin-bottom: 10px;	
}

#line_separator_2{
	background:url('./img/interface/line_separator_2_bg.png') no-repeat center;
	height:20px;
	margin-bottom: 10px;	
}

#line_separator_3{
	background:url('./img/interface/line_separator_3_bg.png') no-repeat center;
	height:20px;
	margin-bottom: 10px;	
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
	width:1000px;
	min-height:708px;
	margin:auto;
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
	float:left;
	width:130px;
	height:100%;
	padding-left:10px;
}
#logo{
	padding-top:10px;
	padding-bottom:20px;
}
#logo img{
	width:180px;
}
#menu_item.title{
	padding:5px 0px 5px 0px;
	text-transform:uppercase;
}
a.menu_title{
	color:<?php echo $season_color["semidark"]; ?>;
	font-weight:bold;
	font-size:14px;
}
a.menu_title:hover{
	color:<?php echo $season_color["dark"]; ?>;
}
a.menu_subtitle{
	font-weight:none;
	font-size:11px;
}

#menu_item.separator{
	height:5px;
	width:80px;
}
#menu_item.list{
	margin-left:10px;
	padding-bottom:10px;
}
#menu_item.list ul{
	margin:0px;
	padding:0px;
	list-style:none;
}
#menu_item.list li{
	margin:5px 0px;
	font-size: 14px;
}

#menu_item.list a{
	font-size: 14px;
	font-weight: lighter;
}
#user_menu{
	float:right;
	padding:10px;
	text-align:right;
}
.left_space{
	padding-left:10px;
}
#user_menu div{
	padding:5px 0px 5px 0px;
}
#content{
	padding-left:140px;
	padding-top:80px;
	padding-right:8px;
	min-height: 400px;
	width:795px;
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
	min-width:195px;
	max-width:195px;
	height:460px;
}

#item .image img{
	width:190px;
}
.index #item{
	padding:0;
	min-width:190px;
	max-width:190px;
	height:368px;
}
.index #item .image img{
	width:190px;
	max-height: 368px;
	height: 368px;
}

#item .description{
	margin-top:10px;
}
#item .item_name{
	font-weight:bold;
	text-transform:uppercase;
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
	overflow: auto;
	padding-bottom:5px;
}
#page_navigator{
	font-size:20px;
	font-weight:bold;
	float:left;
	text-transform:uppercase;
}
#page_information{
	float:right;
	font-size:20px;
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
	margin-top:10px;
	overflow:auto;

}
#product .preview{
	float:left;
	width:245px;
}
#product .preview .principal img{
	width:235px;
}
#product .information{
	width:520px;
	float:right;
}
#product .information .information_header{
	height:0px;
	margin:10px 0px;
}
#product .information .name{
	margin:0px 0px 5px 0px;
}
#product .information .price{
	margin:0px 0px 10px 0px;
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
	width:266px;
}
.color_selector li table {
	font-size:12px !important;

}
.color_selector li table{
	border-collapse: collapse;
	width:250px;
}
.color_selector li td{
	text-align: left;
}
.color_selector li.selected table{
	border:1px solid #999;
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
	font-weight: bold !important;
	color: <?php echo $season_color["dark"]; ?> !important;
}
.color_selector li.selected .image_link_selected{
	border: 1px solid <?php echo $season_color["dark"]; ?> !important;

}
.select_head{
	width:100%;
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	background-color:#ffffff;
	padding:5px;
}
.select_head .arrow{
	float:right;
	height:15px;
	width:15px;
}
.select_child{
	width:266px;

	border:1px solid <?php echo $season_color["semilight"]; ?>;
	background-color:#ffffff;
	padding:5px;
	border-top:none;
	position:absolute;
	z-index:1;
	
}
.select_child li{
	list-style: none;
	
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
.likeabutton a{
	padding:9px;
	background-color:<?php echo $season_color["semilight"]; ?>;
	text-align: center;
	display:block;
	width: 220px;
}
.likeabutton span.loading{
	padding:9px;
	background:url('./img/interface/bg_button.jpg');
	text-align: center;
	display:block;
	width: 220px;
}
.small{
width:200px !important;
}
.smalltext{
width:180px !important;
}
.likeabutton{
	float:left;
	margin-right:10px;
}
.likeabutton a:hover{
	background-color:<?php echo $season_color["semidark"]; ?>
		cursor:pointer;
}
.likeabutton input{
	padding:10px;
	background-color:<?php echo $season_color["semilight"]; ?>;
	text-align: center;
	display:block;
	width: 240px;
	height:32px;
	text-transform: uppercase;
	color:#ffffff;
	font-family: Arial !important;
	font-weight: bold;
	border:none;
	font-size:12px;

}
.likeabutton input:hover{
	background-color:<?php echo $season_color["semidark"]; ?>
	cursor:pointer;
}

.likeabutton .text{
	color:#ffffff;
	font-size:12px;
	text-transform:uppercase;
	font-weight: bold;
}
.likeabutton_dark a{
	background-color:<?php echo $season_color["dark"]; ?>;
}
.likeabutton_dark a:hover{
	background-color: <?php echo $season_color["semidark"]; ?>;
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
}

#product .secondaries li{
	display: block;
	margin:0px 4px 5px 7px;
	float:left;
}
#product .secondaries img{
	height: 115px;
	
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
	padding:5px;
	width: 300px;
	color:<?php echo $season_color["semidark"]; ?>;
	font-family: Arial !important;

}
.form_entry .text_disabled{
	border:1px solid <?php echo $season_color["semilight"]; ?>;
	padding:5px;
	width: 300px;
	color:<?php echo $season_color["semidark"]; ?>;
	background-color:#f4f4f4;

	font-family: Arial !important;

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
	font-family: Arial !important;
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
	width:770px;
}
.data_table th{
	border-top:1px solid <?php echo $season_color["light"];?>;
	border-bottom:1px solid <?php echo $season_color["light"];?>; 
	color:<?php echo $season_color["dark"];?>; 
	padding:10px 0px;
}
.data_table th.image_header{
	width:60px;
}
.data_table th.name_selector_header{
	width:300px;
}
.data_table th.amount_header{
	width:160px;
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
	display:block;
	text-align:center;
	width:15px;
	height:15px;
	font-size:14px;
	margin:2px 0px;
	background-color: <?php echo $season_color["semilight"]; ?> ;
	color: #ffffff ;

}
.cart_options span{
	display:block;
	text-align:center;
	width:15px;
	height:15px;
	font-size:14px;
	margin:2px 0px;
	background-color: #dddddd ;
	color: #ffffff ;

}
.old_price{
	text-decoration:line-through;
	color:red;
}
.new_price{
	font-weight:bold;

}
.a


#footer{
	margin-left:200px;
	padding-top:0px;
	padding-bottom:10px;
	width:780px;
	/*height:120px;*/
}
.footer_menus{
	overflow:auto;
	width: 680px;
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
</style>