
<?php

use ACCESS\Entry;

class ESetup extends Entry{
	
	function __construct(){
		APP\load_module("DB");
	}

	static function get_ID(){
		return "/setup";
	}

	function render(){
		
	}
	
	function post($params){
		if(!isset($params['username']) || !isset($params['password']))
			\ACCESS\redirect("/403");
		if($params['username'] === "Admin" && md5($params['password']) === md5("password"))
		require_once("config/setup.php");
	}
}

?>