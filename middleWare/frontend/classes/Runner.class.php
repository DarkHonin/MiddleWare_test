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
			foreach($data['children'] as $path=>$i){
				if($i instanceof \FRONT\Runner)
					$i->build();
				else if($i instanceof Form)
					FRONT::render_form($i);
				else if(file_exists($path)){
					$r = new Runner($path, $i);
					$r->build();
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