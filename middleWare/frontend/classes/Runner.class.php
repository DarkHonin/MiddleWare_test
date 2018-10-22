<?php

namespace FRONT;

class Runner{

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

	function children(){
		$data = $this->_data;
		if(isset($data['children']))
			foreach($data['children'] as $path=>$data){
				$r = new Runner($path, $data);
				$r->build();
			}
	}

	function eitem($itemId){
		echo $this->_data["data"][$itemId];
	}

	function item($itemId){
		return $this->_data["data"][$itemId];
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