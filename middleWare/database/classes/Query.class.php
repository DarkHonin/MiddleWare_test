<?php

namespace DB;

abstract class Query extends DataObject{

	private const QUERY_STRINGS = [
		"SELECT" => "SELECT :what FROM :table",
		"WHERE" => "WHERE :query",
		"CREATE_TABLE" => "CREATE TABLE :ine `:tdname`",
		"CREATE_DB" => "CREATE DATABASE :ine `:tdname`",
		"TABLE_ROW_DEF" => "( :cols )"
	];

	private $_query_stack = [];
	private $_table;

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
			"cols" => ""
		];
	}

	function get_query_string(): string{
		return implode(" ", $this->_query_stack);
	}

	protected function push_query($q){
		array_push($this->_query_stack, Query::QUERY_STRINGS[$q]);
	}

	function send(){
		$raw = Database::$DB->send_SQL($this);
		try {
			$data = $raw->fetch();
			var_dump($data);
		}	catch (\PDOException $e){
			echo "Whoops\n";
		}
		$raw->closeCursor();
		$this->_query_stack = [];
	}
	abstract function select($what="*"): Query;
	abstract function insert(Table $table): Query;
	abstract function update(Table $table): Query;
	abstract function create(DataObject $o): Query;

	function create(DataObject $obj){
		if ($obj instanceof Table)
			$this->push_query("CREATE_TABLE");
		if ($obj instanceof Database)
			$this->push_query("CREATE_DB");
		$this->add_data($obj->get_name(), "tdname");
		return $this;
	}

	function if_not_exists(){
		$this->add_data("IF NOT EXISTS", "ine");
		return $this;
	}
}

?>