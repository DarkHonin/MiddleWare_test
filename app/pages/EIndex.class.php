<?php

use ACCESS\Entry;

class EIndex extends Entry{

	private $_posts;
	private $_page;
	private const ITEMS_PER_PAGE = 10;

	function __construct(){
		APP\load_module("DB");
		APP\load_module("FRONT");
	}

	static function get_ID(){
		return "/";
	}

	function render(){
		$elem = new \FRONT\Runner("app/parts/page.php", [
			"children" => [
				"app/parts/body.php" => 
				[
					"children" => [
						"app/parts/index.php"=>[
						"posts"=>$this->_posts,
						"children" =>[
							"app\parts\pagenagtion.php" => [
									"pages"=>5,
									"current"=>$this->_page,
									"start"=>1
								]
						]
					],
				"app/parts/sidebar.php"=>[]
				]
				]
				],
		]);
		$elem->build();
	}
	
	function get($params){
		if(isset($params["page"]))
			$this->_page = $params["page"];
		else
			$this->_page = 1;
		$this->_posts = DB\get_table("Posts")->select()->order("post_dt")->send();
	}
}

?>