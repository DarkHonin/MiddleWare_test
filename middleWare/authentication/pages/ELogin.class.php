<?php

use ACCESS\Entry;

class ELogin extends Entry{

	function __construct(){
		APP\load_module("DB");
		APP\load_module("AUTH");
		APP\load_module("FRONT");
	}

	static function get_ID(){
		return "/login";
	}

	function render(){
		$c = "\\AUTH\\LoginForm";
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
		$c = "\\AUTH\\LoginForm";
		$form = new $c();
		if($params['token'] !== $form->get_token())
			die("the page has expired");
		$item = $form->select(["active", "pass"])->where("username='".$params['username']."'")->send();
		if(empty($item))
			die("Username/ password worng");
		$item = $item[0];
		if(hash_equals($item->pass, $params['pass']))
			die("Username/ password worng");
		if(!$item->active)
			die("Youll need to activate your account: check your email");
		session_start();
		$_SESSION['username'] = $params['username'];
		\ACCESS\redirect("/");
	}
}

?>