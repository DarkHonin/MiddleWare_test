<?php

namespace DB;

class Column extends \App\DataObject{

	private const _FORMAT = ":name :t(:s) :n :d :ai";

	private const _FIELDS = [
		"name" => "",
		"t" => "",
		"s" => "",
		"n" => "NOT NULL",
		"d" => "",
		"ai"=> ""
	];


	function __construct($name, $params){
		$par = Column::_FIELDS;
		foreach($params as $k=>$v)
			if (array_key_exists($k, $par))
				$par[$k] = $v;
		parent::__construct($name, $par);
		$this->add_data($name, "name");
	}

	function get_query_string(): string{
		return Column::_FORMAT;
	}

	function get_data_fields() : array{
		return self::_FIELDS;
	}

	function __toString(){
		return $this->assemble();
	}
}


?>