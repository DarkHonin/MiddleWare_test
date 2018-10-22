<?php
use DB\Column;
class Post extends DB\Table{
	function __construct(){
		parent::__construct("Posts");
	}

	function load_cols(){
		$this->primairyKey(new Column("id",[
			"t" => "INT",
			"s" => 32,
			"ai" => "AUTO_INCREMENT"
		]));
		$this->register_col(new Column("title",[
			"t" => "VARCHAR",
			"s" => 32
		]));
		$this->register_col(new Column("post_dt",[
			"t" => "DATETIME"
		]));
		$this->foreignKey(new Column("author", [
			"t" => "INT",
			"s" => 32
		]), "Users(id)");
	}
}


?>