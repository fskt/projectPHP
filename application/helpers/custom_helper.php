<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('clean_text')){
	/*
	function clean_text($text){ 
		$text = trim(str_replace('&nbsp;', '', strip_tags($text)));
		$text = str_replace(' ', '-', $text);
		$clean = @ereg_replace('[^A-Za-z0-9\-]', '_', $text);
		return $clean;
	}
	*/
	
	function clean_text($str){
		$separator = '-';
		$lowercase = TRUE;
		$q_separator = preg_quote($separator);
		$trans = array(
			'&.+?;'                 => '',
			'[^a-z0-9 _-]'          => '',
			'\s+'                   => $separator,
			'('.$q_separator.')+'   => $separator
		);
		$str = strip_tags($str);
		foreach ($trans as $key => $val){
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE){
			$str = strtolower($str);
		}
		return trim($str, $separator);
	}
	
}

if ( ! function_exists('date_range')){
	function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {
		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
		while( $current <= $last ) {
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
		return $dates;
	}
}	

if ( ! function_exists('check_session')){
	function check_session($name='identitas') {
		$CI =& get_instance();
		$CI->load->library('session');	
		$session = $CI->session->userdata($name);
		return $session;
	}
}

if ( ! function_exists('filter_keywords')){
	function filter_keywords($keywords) {
		$arr = array();
		$text = explode(' ',strip_tags(strtolower($keywords)));
		foreach($text as $v){
			if(strlen($v)>2){
				$arr[] = $v;
			}
		}
		return implode(' ',$arr);
	}
}