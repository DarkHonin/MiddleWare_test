<?php

use ACCESS\Entry;

class EError extends Entry{

    private $_message;
    private $_code;

	static function get_ID(){
		return "/error";
	}

	function render(){
		echo $this->_message;
	}
	
	function get($params){
        $this->_message = ($params['message']);
        $this->_code = ($params['code']);
	}
}

?>