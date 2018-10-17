<?php

final class FRONT{

	private static $PATHS;
	private static $CFG;

	static function init(){
		self::$CFG = \CFG\readConfig("frontend");
		self::$PATHS = self::$CFG["PARTS"];
	}

	static function stitch($part_name){
		foreach(self::$PATHS as $p){
			if (file_exists("$p/$part_name.php")){
				return include("$p/$part_name.php");
			}
	}
}
}

?>