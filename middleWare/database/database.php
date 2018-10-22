<?php

namespace DB;

function handle_migration_name($d){
	$name = substr($d, strpos($d, ".") + 1, strpos($d, ".", strpos($d, ".") + 1) - 2);
	$table = new $name();
	Table::$TABLES[$table->get_name()] = $table;
}

function init(){
	$cfg = \CFG\readConfig("database");
	Database::$DB = new MySQLDB("Camagru");
	Database::$DB->connect($cfg['username'], $cfg['password']);
	Database::$DB->useDatabase();
	foreach($cfg["migrations"] as $m)
		if(file_exists($m))
			\APP\load_files($m, "DB\\handle_migration_name");
}

function install(){
	echo "Installing database\n";
	Database::$DB->create(Database::$DB)->if_not_exists()->send();
	Database::$DB->useDatabase();
	foreach(Table::$TABLES as $id=>$table)
		$table->create()->if_not_exists()->send();
}

function get_table($name){
	return clone Table::$TABLES[$name];
}
?>