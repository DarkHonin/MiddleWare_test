<?php

namespace DB;

abstract class Table extends Query{

	private $_cols = [];
	private $_unique = [];
	private $_primairy = null;

	function __construct($name){
		parent::__construct($name);
		$this->load_cols();
	}

	final function set(array $values){
		foreach($values as $k=>$v)
			$this->$k = $v;
	}

	function create() : Query{
		$this->push_query("CREATE_TABLE");
		$this->add_data($this->get_name(), "tdname");
		$cols = [];
		foreach($this->_cols as $q)
			array_push($cols, $q);
		foreach (array_keys($this->_unique) as $k)
			array_push($cols, "UNIQUE($k)");
		array_push($cols, "PRIMARY KEY (".$this->_primairy->get_name().")");
		$this->add_data(implode(", ",$cols), "cols");
		return $this;
	}

	function select($what="*"):Query{
		$this->push_query("SELECT");
		if (is_array($what))
			$this->add_data(implode(", ", $what), "what");
		else
			$this->add_data($what, "what");
		$this->add_data($this->get_name(), "table");
		return $this;
	}

	function where($query):Query{
		$this->push_query("WHERE");
		$this->add_data($query, "query");
		return $this;
	}

	protected function register_col(Column $col){
		$this->_cols[$col->get_name()] = $col;
	}

	protected function uniqueKey(Column $col){
		if(!isset($this->_cols[$col->get_name()]))
			$this->register_col($col);
		$this->_unique[$col->get_name()] = $col;
	}

	protected function primairyKey(Column $col){
		if(!isset($this->_cols[$col->get_name()]))
			$this->register_col($col);
		if(!$this->_primairy)
			$this->_primairy = $col;
	}

	protected function retrieve(\PDOStatement $a){
		return $a->fetchAll(\PDO::FETCH_CLASS, get_class($this));
	}

	function insert(): Query{
		$this->push_query("INSERT");
		$this->add_data($this->get_name(), "table");
		$keys = array_keys($this->_cols);
		$keys = array_reverse($keys, true);
		array_pop($keys);
		$this->add_data(implode(", ", $keys), "cols");
		$vals = [];
		foreach($keys as $p)
			array_push($vals, $this->$p);
		$this->add_data(implode("\", \"", $vals), "vals");
		return $this;
	}

	function update(): Query{

	}

	function onEmptyReponse(\PDOException $e) : bool{
		echo "Empty response\n";
		switch ($this->get_query_type()){
			case "CREATE_TABLE":
				return false;
		}
		return true;
	}

	abstract function load_cols();
}

?>