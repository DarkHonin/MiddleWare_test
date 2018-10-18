<?php

	namespace ACCESS;


	function handle_page_name($d){
		$name = substr($d, 0, strpos($d, "."));
		$idp = "$name::get_ID";
		Entry::$ENTRIES[$idp()] = $name;
	}

	function init(){
		$cfg = \CFG\readConfig("access");
		foreach([$cfg['ENTRIES'], __DIR__."/pages"] as $p)
			if(file_exists($p))
				\APP\load_files($p, "ACCESS\\handle_page_name");
	}

	function parse_get_query($str){
		$art = explode("&",$str);
		$ret = [];
		foreach($art as $a){
			$p = explode("=", $a);
			$ret[$p[0]] = $p[1];
		}
		return $ret;
	}

	function redirect($id){
		header("Location: ".Entry::$ENTRIES[$id]::get_ID());
		die();
	}

	function open_entry($request){
		$parsed = parse_url($request);
		$get = [];
		$id = $parsed["path"];
		if(isset($parsed["query"])){
			$query = $parsed["query"];
			$get = parse_get_query($query);
		}
		if(!isset(Entry::$ENTRIES[$id])){
			header("HTTP/1.0 404 Not Found");
			$id = "/404";
		}
		$class = Entry::$ENTRIES[$id];
		$obj = new $class();
		try {
			switch ($_SERVER["REQUEST_METHOD"]){
				case "POST":
					$obj->post($_POST);
					break;
				case "GET" :
					$obj->get($get);
					break;
			}
		} catch (RestrictError $e){
			redirect("/403");
		}

		$obj->render();
	}

	function getCSRFToken($param){
		$secret_salt = md5("this is a secret");
		if(!session_id())
			session_start();
		return sha1($param.session_id().$secret_salt);
	}

?>