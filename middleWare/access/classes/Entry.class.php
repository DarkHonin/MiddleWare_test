<?php

namespace ACCESS;

abstract class Entry{

	public static $ENTRIES = [];

	function __construct(){
		
	}

	abstract function render();
	function get($params){throw new RestrictError("Illigal get request");}
	function post($params){throw new RestrictError("Illigal post request");}

}

?>