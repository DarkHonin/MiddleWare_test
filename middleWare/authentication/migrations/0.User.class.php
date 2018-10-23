<?php

use DB\Table;
use DB\Column;

use FRONT\Form;
class User extends Table{

	public $id;
	public $username;
	public $email;
	public $pass;
	public $token;

	function __construct(){
		parent::__construct("Users");
	}

	function load_cols(){
		$this->primairyKey(new Column("id",[
			"t" => \App\DataType::$INT,
			"s" => 32,
			"ai" => "AUTO_INCREMENT"
		]));
		$this->uniqueKey(new Column("username",[
			"t" => \App\DataType::$TEXT,
			"s" => 32
		]));
		$this->uniqueKey(new Column("email",[
			"t" => \App\DataType::$EMAIL,
			"s" => 125
		]));
		$this->register_col(new Column("pass",[
			"t" => \App\DataType::$PASSWORD,
			"s" => 255,
			"is_password" => true
		]));
		$this->register_col(new Column("active",[
			"t" => "BOOL",
			"d" => false
		]));
		$this->register_col(new Column("token",[
			"t" => \App\DataType::$TOKEN,
			"s" => 255
		]));
		
	}


}


?>