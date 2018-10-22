<?php

final class FRONT{

	private static $PATHS;
	private static $CFG;
	public static $_DATA;
	private static $_WRAP = null;

	static function init(){
		self::$CFG = \CFG\readConfig("frontend");
		self::$PATHS = self::$CFG["PARTS"];
	}

	static function load_part_src($part_name){
		$path = "";
		foreach(self::$PATHS as $p){
			if (file_exists("$p/$part_name.php")){
				$path = "$p/$part_name.php";
			}
		}
		$raw = file_get_contents($path);
		return $raw;
	}

	static function load_part($id) : \FRONT\Part{
		$data = self::load_part_src($id);
		$part = new \FRONT\Part($id, $data);
		if(self::$_WRAP){
			self::$_WRAP->add_data($part->assemble(), self::$_WRAP->get_name());
			$part = self::$_WRAP;
			self::$_WRAP = null;
		}
		return $part;
	}

	// deseg = "part:sectionid"
	static function wrap($deseg){
		$des = explode(":", $deseg);
		$data = self::load_part_src($des[0]);
		$wrapper = new \FRONT\Part($des[1], $data);
		self::$_WRAP = $wrapper;
	}

	static function section($id){
		echo ":$id";
	}

	static function render(){
		echo self::$_BUFFER;
	}

}

?>