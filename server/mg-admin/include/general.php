<?php

	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	function normalize_str($string)
	{
		$string = str_replace("?","",$string);
		$string = str_replace("�","",$string);
		$string = str_replace("!","",$string);
		$string = str_replace("*","",$string);
		$string = str_replace(",","",$string);
		$string = str_replace("-","",$string);
		$string = str_replace("_","",$string);
		$string = str_replace("�","a",$string);
		$string = str_replace("�","e",$string);
		$string = str_replace("�","i",$string);
		$string = str_replace("�","o",$string);
		$string = str_replace("�","u",$string);
		$string = str_replace("�","u",$string);
		$string = str_replace("�","n",$string);
		$string = str_replace("�","c",$string);
		$string = str_replace("�","A",$string);
		$string = str_replace("�","E",$string);
		$string = str_replace("�","I",$string);
		$string = str_replace("�","O",$string);
		$string = str_replace("�","U",$string);
		$string = str_replace("�","U",$string);
		$string = str_replace("�","N",$string);
		$string = str_replace("�","C",$string);
		$string = str_replace("\xc3\xa1","a",$string);
		$string = str_replace("\xc3\xa9","e",$string);
		$string = str_replace("\xc3\xad","i",$string);
		$string = str_replace("\xc3\xb3","o",$string);
		$string = str_replace("\xc3\xba","u",$string);
		$string = str_replace("\xc3\xbc","u",$string);
		$string = str_replace("\xc3\xb1","n",$string);
		$string = str_replace("\xc3\xa7","c",$string);
		$string = str_replace("\xc3\x81","A",$string);
		$string = str_replace("\xc3\x89","E",$string);
		$string = str_replace("\xc3\x8d","I",$string);
		$string = str_replace("\xc3\x93","O",$string);
		$string = str_replace("\xc3\x9a","U",$string);
		$string = str_replace("\xc3\x9c","U",$string);
		$string = str_replace("\xc3\x91","N",$string);
		$string = str_replace("\xc3\x87","C",$string);
		return $string;
	}
	function debug_log($str,$code="DEBUG",$show_path=true){
		global $_CONFIG;
		global $page_path;

		if($_CONFIG["debug_mode"]==1){
			$path_str="";
			if($show_path){
				$path_str="[".$page_path."]";
			}
			error_log("[".$code."]".$path_str." ".$str);

		}
	}
	function print_debug_log($array,$code=""){
		global $_CONFIG;
		global $page_path;

		foreach ($array as $key=>$value){
			debug_log("[".$key."]=".$value);
		}
	}
	function debug_log_input_data(){
		global $_CONFIG;
		global $page_path;

		if($_CONFIG["debug_mode"]==1){
			if(issetandnotempty($_GET)){
				debug_log("GET DATA : ");
			}
			if(issetandnotempty($_POST)){
				debug_log("POST DATA : ");
			}
		}
	}
	function issetandnotempty($var){
		if((isset($var))&&(!empty($var))&&($var!="undefined")){
			return true;
		}
		return false;
	}
	function timestamp_to_str($timestamp){
		global $s;

		$from_now = time() - $timestamp;
		if ($from_now < 1){
			return '0 seconds';
		}

		$a = array(
			365 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60  =>  'month',
			24 * 60 * 60  =>  'day',
			60 * 60  =>  'hour',
			60  =>  'minute',
			1  =>  'second'
		);

		$a_plural = array(
			'year'   => 'years',
			'month'  => 'months',
			'day'    => 'days',
			'hour'   => 'hours',
			'minute' => 'minutes',
			'second' => 'seconds'
		);

		foreach ($a as $secs => $str){
				$d = $from_now / $secs;
				if ($d >= 1){
						$r = round($d);
						return $s["pre_time_str"].$r.' '.($r > 1 ? $s[$a_plural[$str]] : $s[$str]).$s["post_time_str"];
				}
		}
	}

	function substr_dots($str,$limit){
		if ($limit<4){
			return $str;
			die;
		}
		if(strlen($str)>$limit){
			$res=substr($str,0, $limit-3);
			$res.="...";
			return $res;
			die;
		}
		return $str;
	}

?>
