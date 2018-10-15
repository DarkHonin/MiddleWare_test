<?php

namespace DB;

class TableQuery extends Query{

	private $_tname;
	private $_fields = [];

	function __construct($db, $tableName){
		$this->_tname = $tableName;
		parent::__construct($db);
	}

	function addField(TableData $td){
		array_push($this->_fields, $td);
	}

	function __toString(){

		$ud = [];
		foreach($this->_fields as $f)
			array_push($ud, $f->get_unique());
		foreach($this->_fields as $f)
			array_push($ud, $f->get_primary());
		foreach($this->_fields as $f)
			array_push($ud, $f->get_foreign());

		$ud = array_filter($ud);

		$str = "TABLE ".$this->_tname." (".implode(", ", $this->_fields).", ".implode(", ", $ud).")";

		return $str;
	}

}

function createTableQuery($tname){
	return new TableQuery($tname);
}

?>