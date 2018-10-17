<?php

namespace DB;

function handle_migration_name($d){
	$name = substr($d, strpos($d, ".") + 1, strpos($d, ".", strpos($d, ".") + 1) - 2);
	$table = new $name();
	Table::$TABLES[$name] = $table;
}

function init(){
	$cfg = \CFG\readConfig("database");
	DataObject::$DB = new MySQLDB("Camagru");
	DataObject::$DB->connect($cfg['username'], $cfg['password']);
	DataObject::$DB->useDatabase();
	foreach($cfg["migrations"] as $m)
		if(file_exists($m))
			\APP\load_files($m, "DB\\handle_migration_name");
}

function install(){
	DataObject::$DB->create(DataObject::$DB)->if_not_exists()->send();
	DataObject::$DB->useDatabase();
	foreach(Table::$TABLES as $id=>$table)
		$table->create()->if_not_exists()->send();
}


?>