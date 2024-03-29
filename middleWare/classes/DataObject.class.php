<?php

namespace App;

abstract class DataObject{

	private $_name;
	private $_data;

	function __construct($name, array $data){
		$this->_name = $name;
		$par = $this->get_data_fields();
		foreach($data as $k=>$v)
			if (array_key_exists($k, $par))
				$par[$k] = $v;
		$this->_data = $par;
	}

	function get_name(){return $this->_name;}

	function get_data(){return $this->_data;}

	final function add_data($data, $key){
		$this->_data[$key] = $data;
	}

	function get_open_delim(){ return ":"; }

	abstract function get_data_fields() : array;

	abstract function get_query_string(): string;

	function assemble(){
		$str = $this->get_query_string();
		foreach($this->get_data() as $k=>$v)
			$str = str_replace($this->get_open_delim()."$k", $v, $str);
		return ($str);
	}
}


?>