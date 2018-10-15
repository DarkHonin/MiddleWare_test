<?php

namespace DB;

abstract class DBStructrue{
	private $_name;
	private $_charset = "utf8";

	function __construct($name){
		$this->_name = $name;
	}

	function get_name(){
		return $this->_name;
	}

	function get_charset(){return $this->_charset;}
}

?>