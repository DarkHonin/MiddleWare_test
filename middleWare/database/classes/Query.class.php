<?php

namespace DB;

abstract class Query extends DataObject{

	private const QUERY_STRINGS = [
		"SELECT" => "SELECT :what FROM :table",
		"WHERE" => "WHERE :query",
		"CREATE_TABLE" => "CREATE TABLE :ine `:tdname` ( :cols )",
		"CREATE_DB" => "CREATE DATABASE :ine `:tdname`",
		"INSERT" =>	"INSERT INTO :table ( :cols ) VALUES ( \":vals \")"
	];

	private $_query_stack = [];
	private $_query = null;
	private $_table;

	private $_errorhanlders = [
		"HY000" => "onEmptyReponse"
	];

	function __construct($name){
		parent::__construct($name, []);
	}


	function get_data_fields() : array{
		return [
			"what" => "",
			"table" => "",
			"query" => "",
			"ine" => "",
			"tdname" => "",
			"cols" => "",
			"vals" => ""
		];
	}

	function get_query_string(): string{
		return implode(" ", $this->_query_stack);
	}

	protected function push_query($q){
		array_push($this->_query_stack, Query::QUERY_STRINGS[$q]);
		$this->_query = $q;
	}

	function send(){
		$raw = Database::$DB->send_SQL($this);
		$data = null;
		try {
			$data = $this->retrieve($raw);
		}	catch (\PDOException $e){
			print_r($e->getCode());
			$str = $this->_errorhanlders[$e->errorInfo[0]];
			if($this->$str($e)) die ("Crittical error :: $str");
		}
		$raw->closeCursor();
		$this->_query_stack = [];
		return $data;
	}

	protected function get_query_type(){
		return $this->_query;
	}

	abstract function onEmptyReponse(\PDOException $e) : bool;

	abstract function select($what="*"): Query;
	abstract function insert(): Query;
	abstract function update(): Query;
	abstract function create(): Query;
	protected abstract function retrieve(\PDOStatement $a);

	/*
	function create(DataObject $obj){
		if ($obj instanceof Table)
			$this->push_query("CREATE_TABLE");
		if ($obj instanceof Database)
			$this->push_query("CREATE_DB");
		$this->add_data($obj->get_name(), "tdname");
		return $this;
	}
*/
	function if_not_exists(){
		$this->add_data("IF NOT EXISTS", "ine");
		return $this;
	}
}

?>