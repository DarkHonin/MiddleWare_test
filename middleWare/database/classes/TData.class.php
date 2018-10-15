<?php

namespace DB;

class TableData{
	private $_col_name;
	private $_type;

	private $_opts = [
		"SIZE" => 1,
		"NULL" => false,
		"DEFAULT" => null,
		"AUTO_INCREMENT" => false,
		"UNIQUE" => null,
		"PRIMARY" => null,
		"COMMENT" => null,
		"FOREIGN" => null
	];

	function __toString(){
		$parts = $this->_opts;
		$str = $this->_col_name." ".$this->_type;
		$str .= "(".$parts['SIZE'].")";
		$str .= ($parts['NULL'] ? " NULL" : " NOT NULL");
		$str .= ($parts['DEFAULT'] ? " DEFAULT ".$parts['DEFAILT'] : "");
		$str .= ($parts['AUTO_INCREMENT'] ? " AUTO_INCREMENT" : "");
		$str .= ($parts['COMMENT'] ? " COMMENT '".$parts['COMMENT']."'" : "");
		return $str;
	}

	function get_primary(){
		if($this->_opts["PRIMARY"])
			return "PRIMARY KEY ($this->_col_name)";
	}

	function get_unique(){
		if($this->_opts["UNIQUE"])
			return "UNIQUE ($this->_col_name)";
	}

	function get_foreign(){
		if($this->_opts["FOREIGN"])
			return "FOREIGN KEY ($this->_col_name) REFERENCES ".$this->_opts["FOREIGN"];
	}

	function __construct($name, $type){
		$this->_col_name = $name;
		$this->_type = $type;
	}

	function size($s = 1){
		$this->_opts["SIZE"] = $s;
		return $this;
	}

	function Comment($comment = null){
		$this->_opts["COMMENT"] = $comment;
		return $this;
	}

	function P($tf = true){
		$this->_opts["PRIMARY"] = $tf;
		return $this;
	}

	function U($tf = true){
		$this->_opts["UNIQUE"] = $tf;
		return $this;
	}

	function nul($tf = true){
		$this->_opts["NULL"] = $tf;
		return $this;
	}

	function F($to){
		$this->_opts["FOREIGN"] = $to;
		return ($this);
	}

	function default($defult){
		$this->_opts["DEFAULT"] = $defult;
		return $this;
	}

	function AI($tf = true){
		$this->_opts["AUTO_INCREMENT"] = $tf;
		return $this;
	}
}

?>