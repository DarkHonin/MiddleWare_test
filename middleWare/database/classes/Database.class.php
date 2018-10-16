<?php

namespace DB;
use PDO;

require_once("Query.class.php");

abstract class Database extends Query{

	private $_pdo;
	private $_last_raw;
	private $_DB_OK = false;

	function __construct($name){
		parent::__construct($name);
	}

	function connect($username, $password){
		$this->_pdo = \DB_Connect($password, $username, $this->get_name());
	}

	function useDatabase(){
		$raw = $this->_pdo->prepare("use ".$this->get_name());
		try {
			$raw->execute();
			$this->_DB_OK = true;
		}catch (\PDOException $e){
			if($e->getCode() == 42000)
				echo ("The database does not exist\n");
			$this->_DB_OK = false;
		}
		$raw->closeCursor();
	}

	function send_SQL(Query $dt){
		if(!$this->_DB_OK && $dt->get_query_type() != "CREATE_DB"){
			echo ("The database is not ready, please run install\n");
			die();
		}
		$query = $dt->assemble();
		print_r($query);
		$raw = $this->_pdo->prepare($query);
		$raw->execute();
		return $raw;
	}

	function onEmptyReponse(\PDOException $e) : bool{
		echo "Empty response\n";
		switch ($this->get_query_type()){
			case "CREATE_DB":
				return false;
		}
		return true;
	}

	protected function retrieve(\PDOStatement $a){
		return $a->fetch();
	}

	function select($what="*"): Query{
		die("Invalid option for ".get_class($this));
	}
	function insert(): Query{
		die("Invalid option for ".get_class($this));
	}
	function update(): Query{
		die("Invalid option for ".get_class($this));
	}

	function create(): Query{
		$this->push_query("CREATE_DB");
		$this->add_data($this->get_name(), "tdname");
		return $this;
	}
}

?>