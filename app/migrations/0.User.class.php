<?php

use DB\Table;
use DB\Column;
use App\Form;

class User extends Table implements Form{

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
			"t" => "INT",
			"s" => 32,
			"ai" => "AUTO_INCREMENT"
		]));
		$this->uniqueKey(new Column("username",[
			"t" => "VARCHAR",
			"s" => 32
		]));
		$this->uniqueKey(new Column("email",[
			"t" => "VARCHAR",
			"s" => 125
		]));
		$this->register_col(new Column("pass",[
			"t" => "VARCHAR",
			"s" => 255
		]));
		$this->register_col(new Column("active",[
			"t" => "BOOL",
			"d" => false
		]));
		$this->register_col(new Column("token",[
			"t" => "VARCHAR",
			"s" => 255
		]));
		
	}

	function get_create_fields() : array{
		return ["Username"=>$this->get_col("username"), "Email"=>$this->get_col("email"), "Password"=>$this->get_col("pass")];
	}
    function get_method(){
		return "POST";
	}
    function get_token(){
		return md5($this->get_name());
	}

	function validate(){
		
	}
}


?>