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
		$form = \DB\Table::$TABLES['Users'];
		include_once("app/parts/register.php");
	}
	
	function get($params){
		
	}
}

?>