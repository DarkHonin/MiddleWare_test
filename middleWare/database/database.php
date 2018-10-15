<?php

namespace DB;

function createDatabase(){
	$cfg = \CFG\readConfig("database");
	return new Database($cfg);
}

function createMigrations($db){
	$dir = "app/migrations";
	foreach(scandir($dir) as $d){
        $of = strripos($d, ".php");
        if($of > 0){
			require_once($dir."/".$d);
			$tname = substr($d, 1, stripos($d, ".") - 1);
			$table = new $tname($db);
			$query = $table->get_query();
			$table->migrate($query);
			$query->create($table)->send();
		}
	}
}

?>