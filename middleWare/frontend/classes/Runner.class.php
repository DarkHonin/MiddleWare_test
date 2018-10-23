<?php

namespace FRONT;
use \FRONT\Form;

class Runner{
	static $INTERFACES = [
		"FORM" => Form::class,
		"RUNNER" => self::class
	];
	private $_content = "";
	private $_data = [];

	function __construct($part_path, $data){
		$this->_path = $part_path;
		$this->_data = $data;
	}

	function build(){
		$self = $this;
		include($this->_path);
	}

	function tags(){
		$fields = [
			"id",
			"class",
			"method",
			"action",
			"value",
			"required",
			"name",
			"for",
			"type"
		];

		foreach($fields as $f){
			if($$f = $this->item($f))
				echo "$f='{$$f}' ";
		}
	}

	function children(){
		$data = $this->_data;
		
		if(isset($data['children']))
			foreach($data['children'] as $path=>$i){
				if($i instanceof self::$INTERFACES['RUNNER'])
					$i->build();
				else if($i instanceof self::$INTERFACES['FORM'])
					\FRONT::render_form($i);
				else if(file_exists($path)){
					$r = new Runner($path, $i);
					$r->build();
				}else{
					var_dump($i, "Failed to render: $path");
				}
			}
	}

	function eitem($itemId){
		if(isset($this->_data[$itemId]))
				echo $this->_data[$itemId];
	}

	function item($itemId){
		if(isset($this->_data[$itemId]))
			return $this->_data[$itemId];
	}

	function child($path, $data){
		(new Runner($path, $data))->build();
	}

	function get_data_fields() : array{
		return [];
	}

	function get_query_string(): string{
		return $this->_content;
	}
}

?>