<?php

use ACCESS\Entry;

class EIndex extends Entry{

	private $_posts;

	function __construct(){
		APP\load_module("FRONT");
		APP\load_module("DB");
	}

	static function get_ID(){
		return "/";
	}

	function render(){
		FRONT::load_part("content")->post();
	}
	
	function get($params){
		$this->_posts = DB\get_table("Post")->select()->send();
	}
}

?>