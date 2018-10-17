<?php

use ACCESS\Entry;

class E403 extends Entry{


	static function get_ID(){
		return "/403";
	}

	function render(){
		echo "Error 403";
	}
	
	function get($params){

	}

	function post($params){

	}
}

?>