<?php

use DB\Table;
use DB\Column;

class User extends Table{

	function __construct(){
		parent::__construct("Users");
	}

	function load_cols(){
		$this->primairyKey(new Column("id",[
			"t" => "INT",
			"s" => 32,
			"ai" => "AUTO_INCREMENT"
		]));
		$this->uniqueKey(new Column("username",[
			"t" => "VARCHAR",
			"s" => 32
		]));
	}
}


?>