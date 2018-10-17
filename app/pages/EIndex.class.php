<?php

use ACCESS\Entry;

class EIndex extends Entry{

	function __construct(){
		APP\load_module("FRONT");
	}

	static function get_ID(){
		return "/";
	}

	function render(){
		FRONT::stitch("body");
	}
	
	function get($params){
		
	}

	function post($params){
		
	}
}

?>