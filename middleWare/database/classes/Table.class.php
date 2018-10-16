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

	function create(DataObject $obj){
		parent::create($obj);
		$this->push_query("TABLE_ROW_DEF");
		$cols = [];
		foreach($this->_cols as $q)
			array_push($cols, $q);
		foreach (array_keys($this->_unique) as $k)
			array_push($cols, "UNIQUE($k)");

		array_push($cols, "PRIMARY KEY (".$this->_primairy->get_name().")");
		$this->add_data(implode(", ",$cols), "cols");
		return $this;
	}

	function select($what="*"){
		$this->push_query("SELECT");
		if (is_array($what))
			$this->add_data(implode(", ", $what), "what");
		else
			$this->add_data($what, "what");
		$this->add_data($this->get_name(), "table");
		return $this;
	}

	function where($query){
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

	abstract function load_cols();
}

?>