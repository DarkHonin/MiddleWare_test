<?php

use ACCESS\Entry;

class ERegister extends Entry{

	function __construct(){
		APP\load_module("DB");
		APP\load_module("FRONT");
	}

	static function get_ID(){
		return "/register";
	}

	function render(){
		$form = \DB\Table::$TABLES['Users'];
		$elem = new \FRONT\Runner("app/parts/page.php", [
			"children" => [
				"app/parts/body.php" =>[
					"children" => [
						$form
					]
				]
			]
		]);
		$elem->build();
	}
	
	function get($params){
		
	}
}

?>