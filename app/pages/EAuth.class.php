<?php

use ACCESS\Entry;

class EAuth extends Entry{

	function __construct(){
		APP\load_module("DB");
	}

	static function get_ID(){
		return "/auth";
	}

	function render(){
		include_once("app/parts/auth.php");
	}
	
	function post($params){
		
	}
}

?>