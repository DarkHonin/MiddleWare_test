<?php

use ACCESS\Entry;

class E404 extends Entry{


	static function get_ID(){
		return "/404";
	}

	function render(){
		echo "Error 404";
	}
	
	function get($params){

	}

	function post($params){

	}
}

?>