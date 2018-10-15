<?php

namespace DB;

abstract class	Table extends DBStructrue{

	private $_fields = [];
	private $_query;

	function __construct($tname, $db){
		parent::__construct($tname);
		$this->_query = new TableQuery($db, $tname);
	}

	function get_query(){
		return $this->_query;
	}

	abstract function migrate(TableQuery $q);

	function __toString(){
		return $this->_query->__toString();
	}
}

?>