<?php

use ACCESS\Entry;

class ERegister extends Entry{

	function __construct(){
		APP\load_module("DB");
	}

	static function get_ID(){
		return "/register";
	}

	function render(){
		require_once("app/parts/body.php");
	}
	
	function get($params){
		var_dump($params);
	}

	function post($params){
		
	}
}

?>