<?php

use ACCESS\Entry;

class ERegister extends Entry{

	function __construct(){
		APP\load_module("DB");
		APP\load_module("AUTH");
		APP\load_module("FRONT");
	}

	static function get_ID(){
		return "/register";
	}

	function render(){
		$c = "\\AUTH\\RegisterForm";
		$form = new $c();
		$elem = new \FRONT\Runner("app/parts/structure/page.php", [
			"children" => [
				"app/parts/structure/body.php" =>[
					"class"=>"auth-form",
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

	function post($params){
		$c = "\\AUTH\\RegisterForm";
		$form = new $c();
		if($params['token'] !== $form->get_token())
			die("the page has expired");
		$params['pass'] = crypt($params['pass'], md5($params['username']));
		$form->set($params);
		$form->set(["token" => md5("token"),
					"active"=>0]);
		if($form->insert()->send())
			die("OK");
	}
}

?>