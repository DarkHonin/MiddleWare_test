<?php

namespace DB;
use PDO;

require_once("DataObject.class.php");

class Database extends DataObject{

	private $_pdo;
	private $_last_raw;

	function __construct($name){
		parent::__construct($name, []);
	}

	function connect(){
		$cfg = \CFG\readConfig("database");
		$this->_pdo = \DB_Connect($cfg["password"], $cfg["username"], $cfg["database"]);
	}

	function get_data_fields() : array{
		return [];
	}
	function get_query_string(): string{
		return "";
	}

	function useDatabase(){
		$raw = $this->_pdo->prepare("use ".$this->get_name());
		$raw->execute();
		$raw->closeCursor();
	}

	function send_SQL(DataObject $dt){
		$query = $dt->assemble();
		print_r($query);
		$raw = $this->_pdo->prepare($query);
		$raw->execute();
		return $raw;
	}
}

?>